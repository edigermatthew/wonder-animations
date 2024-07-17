<?php
/**
 * Plugin Name:       Wonder Animations
 * Description:       Animations for your blocks.
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.2.0
 * Author:            Matthew Ediger
 * Author URI:        https:wonderjarcreative.com
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wonder-animations
 *
 * @package CreateBlock
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Define constants.
 * 
 * As this is a block filter plugin, there isn't a php class. Set requried paramaters
 * as constants.
 */
define( 'WONDER_ANIMATIONS_PLUGIN_NAME', 'wonder-animations' );
define( 'WONDER_ANIMATIONS_PLUGIN_VERSION', '0.2.0' );

/**
 * Include the block filter.
 * 
 * This sets the rest of the plugin into motion.
 */
function wonder_animations_enqueue_assets() {
    wp_enqueue_script(
        WONDER_ANIMATIONS_PLUGIN_NAME,
        plugin_dir_url( __FILE__ ) . 'build/index.js',
        array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'lodash' ),
        WONDER_ANIMATIONS_PLUGIN_VERSION
    );
    wp_add_inline_script(
        WONDER_ANIMATIONS_PLUGIN_NAME,
        'const wonderAnimations = ' . json_encode( wonder_animations_get_animations() ), 'before'
    );
}
add_action( 'enqueue_block_editor_assets', 'wonder_animations_enqueue_assets', 99 );

/**
 * Get animations.
 * 
 * Utility function to get the animations.
 * 
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