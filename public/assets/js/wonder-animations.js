/**
 * Wonder animations js.
 * 
 * The public facing javascript file.
 * 
 * @since 0.7.0
 */
(function($){

	/**
	 * Wonder animations.
	 * 
	 * The main javscript object for wonder animations.
	 */
	const wonderAnimations = {
		$elems: $( '.wa-element' ),
		init: function(){
			$(window).on( 'scroll', this.checkForElemsInViewport );
		},
		checkForElemsInViewport: function(e){
			wonderAnimations.$elems.each(function(){
				let $this = $(this);

				console.log( $this.isInViewport() );
				
				if ( $this.isInViewport() ) {
					$this.addClass( 'in-view' );
				} else {
					$this.removeClass( 'in-view' );

					if ( $this.hasClass( 'wa-repeat' ) ) {
						// Swap out the keyframes.
						wonderAnimations.swapOutKeyframes( $this );
					}
				}
			});
		},
		swapOutKeyframes: function( element ) {
			const thisAnimName = element.css( 'animation-name' );

			if ( thisAnimName.indexOf( '-1' ) !== -1 ) {
				element.css( 'animation-name', element.css( 'animation-name' ).replace( '1', '2' ) );
			} else {
				element.css( 'animation-name', element.css( 'animation-name' ).replace( '2', '1' ) );
			
			}
		}
	};
	wonderAnimations.init();
	
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

})(jQuery);