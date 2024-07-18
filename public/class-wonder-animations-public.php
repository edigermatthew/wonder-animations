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
			'wa-element',
			isset( $block['attrs']['repeat_animation'] ) ? 'wa-repeat' : ''
		);
		$classes = implode( ' ', $classes );
		
		// Set the style attributes.
		$atts  = array(
			'animation-name'      => $block['attrs']['animation_name'],
			'animation-duration'  => isset( $block['attrs']['animation_duration'] ) ? $block['attrs']['animation_duration'] . 'ms' : '400ms',
			'animation-play-state' => 'paused'
		);

		if ( isset( $block['attrs']['animation_delay'] ) ) {
			$atts['animation-delay'] = $block['attrs']['animation_delay'] . 'ms';
		}
		
		if ( isset( $block['attrs']['animation_iteration_count'] ) ) {
			$atts['animation-iteration-count'] = $block['attrs']['animation_iteration_count'];
		}
		
		$att_string = '';
		foreach ( $atts as $declaration => $value ) {
			$att_string .= $declaration . ':' . $value . ';';
		}

		/**
		 * Doing this in two separate preg_replaces for now.
		 * 
		 * Could not determine how to place the class and the style at once.
		 */
		$block_content  = preg_replace( "/(<.+ class=\".+)(\".+)/", "$1 {$classes}$2" , $block_content );
		
		// If has style already.
		if ( preg_match( "/<.+ class=\".+{$classes}\".+style=\".+\"/", $block_content ) ) {
			$block_content = preg_replace( "/(<.+ class=\".+{$classes}\".+style=\".+)(\".+)/", "$1 {$att_string}$2", $block_content );
		} else {
			$block_content = preg_replace( "/(<.+ class=\".+{$classes}\")(.+)/", "$1 style=\"{$att_string}\" $2", $block_content );
		}

		return $block_content;
	}
}