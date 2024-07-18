<?php
/**
 * Admin plugin class.
 * 
 * This file contains the admin plugin class for wonder-animations.
 * 
 * @since 0.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Wonder animations admin.
 * 
 * The class responsible for the admin areas of the plugin.
 */
class Wonder_Animations_Admin {

	/**
	 * Plugin name.
	 * 
	 * The plugin name property.
	 * 
	 * @access protected
	 * @var    $plugin_name;
	 */
	protected $plugin_name;

	/**
	 * Version.
	 * 
	 * The version of the plugin.
	 * 
	 * @access protected
	 * @var    $version
	 */
	protected $version;
	
	/**
	 * Construct.
	 * 
	 * @param string $plugin_name The plugin name.
	 * @param string $version	  The version.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version	   = $version;
	}

	/**
	 * Enqueue block editor assets.
	 * 
	 * Add the block editor assets to add animations to blocks.
	 */
	public function enqueue_block_editor_assets() {
		wp_enqueue_script(
			$this->plugin_name . '-admin',
			plugin_dir_url( __FILE__ ) . 'assets/js/build/index.js',
			array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'lodash' ),
			$this->version
		);
		wp_add_inline_script(
			$this->plugin_name . '-admin',
			'const wonderAnimations = ' . json_encode( wonder_animations_get_animations() ), 'before'
		);
	}	
}