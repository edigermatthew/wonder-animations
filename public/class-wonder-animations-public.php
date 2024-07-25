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
	 * @since 1.5.0  Adding backwards compatibility for old attribute names.
	 * @since 1.4.0  Using new attribute names.
	 * @since 1.3.0  Change to preg_match.
	 * @since 1.2.0  Changed preg_replace again.
	 * @since 1.1.3  Fixed preg_replaces.
	 * @since 1.1.2  Not on gravityforms blocks.
	 * @since 1.1.1  Attributes are prefixed by wa.
	 * @since 0.12.0 Changed preg_replaces for str_replaces.
	 * @since 0.9.0  Checking for boolean true for reset_view.
	 * 
	 * @param  string   $block_content Content of the block. 
	 * @param  array    $block         The full block.
	 * @param  WP_Block $instance      The block instance.
	 * @return array 	The block content.
	 */
	public function render_block( $block_content, $block, $instance ) {
		if ( strpos( $block['blockName'], 'gravityforms' ) !== false || ! isset( $block['attrs']['waAnimationName'] ) || empty( $block['attrs']['waAnimationName'] ) ) {
			return $block_content;
		}

		// Set the element classes.
		$classes = array(
			'animate__animated',
			'animate__' . $block['attrs']['waAnimationName'], // Name.
			! empty( $block['attrs']['waAnimationDelay'] ) ? 'animate__' . $block['attrs']['waAnimationDelay'] : '', // Delay.
			! empty( $block['attrs']['waAnimationDuration'] ) ? 'animate__' . $block['attrs']['waAnimationDuration'] : '', // Duration.
			! empty( $block['attrs']['waAnimationRepeat'] ) ? 'animate__' . $block['attrs']['waAnimationRepeat'] : '', // Repeat.
			! empty( $block['attrs']['waResetView'] ) && true === $block['attrs']['waResetView'] ? 'reset-view' : '' // Reset view.
		);

		// Backwards compatibility.
		$_classes = array(
			! empty( $block['attrs']['wa_animation_name'] ) ? 'animate__' . $block['attrs']['wa_animation_name'] : '', // Name.
			! empty( $block['attrs']['wa_animation_delay'] ) ? 'animate__' . $block['attrs']['wa_animation_delay'] : '', // Delay.
			! empty( $block['attrs']['wa_animation_duration'] ) ? 'animate__' . $block['attrs']['wa_animation_duration'] : '', // Duration.
			! empty( $block['attrs']['wa_animation_repeat'] ) ? 'animate__' . $block['attrs']['wa_animation_repeat'] : '', // Repeat.
			! empty( $block['attrs']['wa_reset_view'] ) && true === $block['attrs']['wa_reset_view'] ? 'reset-view' : '' // Reset view.
		);
		
		if ( ! empty( $_classes ) ) {
			$classes = array_merge( $_classes, $classes );
		}

		$classes = str_replace( "  ", " ", implode( ' ', $classes ) );

		if ( preg_match( "/^<[a-z1-9]|[a-z1-9]+\sclass=\"[^\"]+\"(\sstyle=\"[^\"]+\">)|(>)/", $block_content ) === 1 ) {
			$block_content = preg_replace( "/(^<[a-z1-9]|[a-z1-9]+\sclass=\"[^\"]+)(\"\sstyle=\"[^\"]+\">)|(\">)/", "$1 {$classes}$2$3", $block_content, 1 );
		} else {
			$block_content = preg_replace( "/(^<[a-z1-9]|[a-z1-9]+)(>)/", "$1 class=\"{$classes}\"$2", $block_content, 1 );
		}

		return $block_content;
	}
}