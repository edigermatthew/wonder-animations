<?php
/**
 * Wonder animations functions.
 * 
 * Uitility functions for wonder animiations.
 * 
 * @since 0.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Get animate.css names.
 * 
 * Get the animate.css names.
 * 
 * @see   animate.style/#attention_seekers
 * 
 * @since 1.6.2  Fixed zoomOuts label.
 * @since 0.11.0
 * 
 * @return array The animate.css names.
 */
function wonder_animations_get_animate_css_names() {
	return array(
		'bounce',
		'flash',
		'pulse',
		'rubberBand',
		'shakeX',
		'shakeY',
		'headShake',
		'swing',
		'tada',
		'wobble',
		'jello',
		'heartBeat',
		'backInDown',
		'backInLeft',
		'backInRight',
		'backInUp',
		'backOutDown',
		'backOutLeft',
		'backOutRight',
		'backOutUp',
		'bounceIn',
		'bounceInDown',
		'bounceInLeft',
		'bounceInRight',
		'bounceInUp',
		'bounceOut',
		'bounceOutDown',
		'bounceOutLeft',
		'bounceOutRight',
		'bounceOutUp',
		'fadeIn',
		'fadeInDown',
		'fadeInDownBig',
		'fadeInLeft',
		'fadeInLeftBig',
		'fadeInRight',
		'fadeInRightBig',
		'fadeInUp',
		'fadeInUpBig',
		'fadeInTopLeft',
		'fadeInTopRight',
		'fadeInBottomLeft',
		'fadeInBottomRight',
		'fadeOut',
		'fadeOutDown',
		'fadeOutDownBig',
		'fadeOutLeft',
		'fadeOutLeftBig',
		'fadeOutRight',
		'fadeOutRightBig',
		'fadeOutUp',
		'fadeOutUpBig',
		'fadeOutTopLeft',
		'fadeOutTopRight',
		'fadeOutBottomRight',
		'fadeOutBottomLeft',
		'flip',
		'flipInX',
		'flipInY',
		'flipOutX',
		'flipOutY',
		'lightSpeedInRight',
		'lightSpeedInLeft',
		'lightSpeedOutRight',
		'lightSpeedOutLeft',
		'rotateIn',
		'rotateInDownLeft',
		'rotateInDownRight',
		'rotateInUpLeft',
		'rotateInUpRight',
		'rotateOut',
		'rotateOutDownLeft',
		'rotateOutDownRight',
		'rotateOutUpLeft',
		'rotateOutUpRight',
		'hinge',
		'jackInTheBox',
		'rollIn',
		'rollOut',
		'zoomIn',
		'zoomInDown',
		'zoomInLeft',
		'zoomInRight',
		'zoomInUp',
		'zoomOut',
		'zoomOutDown',
		'zoomOutLeft',
		'zoomOutRight',
		'zoomOutUp',
		'slideInDown',
		'slideInLeft',
		'slideInRight',
		'slideInUp',
		'slideOutDown',
		'slideOutLeft',
		'slideOutRight',
		'slideOutUp'
	);
}

/**
 * Get animations.
 * 
 * Utility function to retreive the animations.
 * 
 * @since 0.11.0 Deprecated.
 * @since 0.5.0  Moved to separate file.
 * @since 0.3.0
 * 
 * @return array The animations.
 */
function wonder_animations_get_animations() {
	$return     = array();
	$types      = array( 'fade-in', 'slide-in' );
	$directions = array( 'top', 'right', 'bottom', 'left' );

	foreach ( $types as $type ) {
		foreach ( $directions as $direction ) {
			$slug          = $type . '-' . $direction;
			$return[] = array(
				'slug'  => $slug,
				'label' => ucwords( str_replace( '-', ' ', $slug ) )
			);
		}
	}
	
	return $return;
}