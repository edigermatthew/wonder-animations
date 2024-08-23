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
	 * @see https://stackoverflow.com/questions/123999/how-can-i-tell-if-a-dom-element-is-visible-in-the-current-viewport?page=1&tab=scoredesc#tab-top
	 * @see https://stackoverflow.com/questions/52220491/jquery-detecting-if-element-is-in-viewport
	 * 
	 * @param {Object} element 
	 * @returns True if in viewport; false otherwise.
	 */
	$.fn.isInViewport = function() {
		let elementTop = $(this).offset().top;
		let elementBottom = elementTop + $(this).outerHeight();

		let viewportTop = $(window).scrollTop();
		let viewportBottom = viewportTop + window.innerHeight;

		return elementBottom > viewportTop && elementTop < viewportBottom;
	};

	/**
	 * Wonder animations.
	 * 
	 * The main javscript object for wonder animations.
	 * 
	 * @since 1.6.1  Changed object method.
	 * @since 1.6.0  Reworking glich. Removing finish.
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

				if ( $this.hasClass( 'transitioning' ) ) {
					console.log( 'stuck at transitioning' );
					return;
				}

				if ( $this.isInViewport() ) {
					let timeout = wonderAnimations.getAnimationDuration( $this );

					$this.addClass( 'in-view transitioning' );

					setTimeout(function(){
						$this.removeClass( 'transitioning' );
					}, timeout );
				} else if ( $this.hasClass( 'in-view' ) ) {
					if ( $this.hasClass( 'reset-view' ) ) {
						// Repeat animation.
						wonderAnimations.repeatAnimation( $this );
					}

					$this.removeClass( 'in-view' );
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
		getAnimationDuration: function( element ){
			const duration = element.css( 'animation-duration' ).replace( 's', '' ),
				delay = element.css( 'animation-delay' ).replace( 's', '' ),
				timeout = parseFloat( duration ) + parseFloat( delay ) * 1000 + 10;

			return timeout;
		}
	};
	wonderAnimations.init();

})(jQuery);