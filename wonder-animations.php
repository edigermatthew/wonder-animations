<?php
/**
 * Plugin Name:       Wonder Animations
 * Description:       Animations for your blocks.
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.6.0
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
 * 
 * @since 0.5.0 Dropped plugin from version constant.
 */
define( 'WONDER_ANIMATIONS_PLUGIN_NAME', 'wonder-animations' );
define( 'WONDER_ANIMATIONS_VERSION', '0.6.0' );

/**
 * Kickoff main class.
 * 
 * Kickoff the main plugin class.
 * 
 * @since 0.5.0
 */
function wonder_animations_kickoff_main_class() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-wonder-animations.php';
    $class = new Wonder_Animations();
    $class->init();
}
add_action( 'init', 'wonder_animations_kickoff_main_class' );