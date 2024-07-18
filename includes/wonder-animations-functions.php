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
 * Get animations.
 * 
 * Utility function to retreive the animations.
 * 
 * @since 0.5.0 Moved to separate file.
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