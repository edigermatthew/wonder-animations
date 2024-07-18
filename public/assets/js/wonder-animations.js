/**
 * Wonder animations js.
 * 
 * The public facing javascript file.
 * 
 * @since 0.7.0
 */
(function($){

	/**
	 * Is in viewport.
	 * 
	 * jQuery utility function to check if an element
	 * is in the viewport.
	 * 
	 * @param {Object} element 
	 * @returns True if in viewport; false otherwise.
	 */
	$.fn.isInViewport = function() {
		var elementTop = $(this).offset().top;
		var elementBottom = elementTop + $(this).outerHeight();
	
		var viewportTop = $(window).scrollTop();
		var viewportBottom = viewportTop + $(window).height();
	
		return elementBottom > viewportTop && elementTop < viewportBottom;
	};

	/**
	 * Wonder animations.
	 * 
	 * The main javscript object for wonder animations.
	 * 
	 * @since 0.12.0 Changing to use animate.css functionality.
	 * @since 0.11.0 Adding a finish.
	 * @since 0.10.0 Changing method of repeating animation.
	 * @since 0.8.0  Adding resize.
	 */
	const wonderAnimations = {
		$elems: $( '.animate__animated' ),
		init: function(){
			this.checkForElemsInViewport();
			$(window).on( 'scroll resize', this.checkForElemsInViewport );
		},
		checkForElemsInViewport: function(e){
			wonderAnimations.$elems.each(function(){
				let $this = $(this);
				
				if ( $this.isInViewport() ) {
					$this.addClass( 'in-view' );

					// Check for finish.
					if ( ! $this.hasClass( 'reset-view' ) ) {
						wonderAnimations.finishAnimation( $this );
					}
				} else {
					if ( $this.hasClass( 'in-view' ) ) {
						$this.removeClass( 'in-view' );

						if ( $this.hasClass( 'reset-view' ) ) {
							// Repeat animation.
							wonderAnimations.repeatAnimation( $this );
						}
					}
				}
			});
		},
		repeatAnimation: function( element ){
			const thisAnimName = element.css( 'animation-name' );

			// Set animation name to data.
			element.attr( 'data-animation-name', thisAnimName );

			// Set element animation to none.
			element.css( 'animation-name', 'none' );

			// Set elmement animation name to blank.
			setTimeout(function(){
				element.css( 'animation-name', '' );
			}, 200);

			// Set elmement animation name to data animation name.
			setTimeout(function(){
				element.css( 'animation-name', element.data( 'animation-name' ) );
			}, 400);
		},
		finishAnimation: function( element ){
			const duration = element.css( 'animation-duration' ).replace( 's', '' ),
				delay = element.css( 'animation-delay' ).replace( 's', '' ),
				timeout = parseFloat( duration ) + parseFloat( delay ) * 1000 + 10;

			setTimeout(function(){
				element.addClass( 'animate__finished' );
			}, timeout )
		}
	};
	wonderAnimations.init();

})(jQuery);