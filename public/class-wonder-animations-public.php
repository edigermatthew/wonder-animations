<?php
/**
 * Public plugin class.
 * 
 * This file contains the public plugin class for wonder-animations.
 * 
 * @since 0.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Wonder animations public.
 * 
 * The class responsible for the public handlings of the plugin.
 */
class Wonder_Animations_Public {

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
	 * Enqueue scripts.
	 * 
	 * Add the scripts we need on the frontend.
	 * 
	 * @see   animate.style for npm controlled aniate.css.
	 * @since 
	 * @since 0.11.0 Using external animate.css stylesheet.
	 */
	public function enqueue_scripts() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/css/wonder-animations.css', array(), $this->version );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/js/wonder-animations.js', array( 'jquery' ), $this->version, true );
	}

	/**
	 * Render block.
	 * 
	 * Render our blocks with animations.
	 * 
	 * @since 0.12.0 Changed preg_replaces for str_replaces.
	 * @since 0.9.0  Checking for boolean true for reset_view.
	 * 
	 * @param  string   $block_content Content of the block. 
	 * @param  array    $block         The full block.
	 * @param  WP_Block $instance      The block instance.
	 * @return array The block content.
	 */
	public function render_block( $block_content, $block, $instance ) {
		if ( ! isset( $block['attrs']['animation_name'] ) || empty( $block['attrs']['animation_name'] ) ) {
			return $block_content;
		}

		// Set the element classes.
		$classes = array(
			'animate__animated',
			'animate__' . $block['attrs']['animation_name'], // Name.
			! empty( $block['attrs']['animation_delay'] ) ? 'animate__' . $block['attrs']['animation_delay'] : '', // Delay.
			! empty( $block['attrs']['animation_duration'] ) ? 'animate__' . $block['attrs']['animation_duration'] : '', // Duration.
			! empty( $block['attrs']['animation_repeat'] ) ? 'animate__' . $block['attrs']['animation_repeat'] : '', // Repeat.
			! empty( $block['attrs']['reset_view'] ) && true === $block['attrs']['reset_view'] ? 'reset-view' : '' // Reset view.
		);
		$classes = str_replace( "  ", " ", implode( ' ', $classes ) );

		// Check for classes.
		if ( strpos( $block_content, 'class=' ) !== false ) {
			// Add to classes.
			$block_content = str_replace( "class=\"", "class=\"{$classes} ", $block_content );
		} else {
			// Add classes.
			$block_content = str_replace( ">", "class=\"{$classes}\">", $block_content );
		}	

		return $block_content;
	}
}