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

		/*
		echo '<pre>';
		var_dump( serialize( $block ) );
		echo '</pre>';
		*/   

		// Add to outer wrapper class.
		$classes = array(
			'wa-elmement',
			'wa_' . $block['attrs']['when_to_animate']
		);
		
		$atts       = array(
			'animation-name'            => $block['attrs']['animation_name'],
			/*'animation-duration'        => $block['attrs']['animation_duration'],
			'animation-delay'           => $block['attrs']['animation_delay'],
			'animation-iteration-count' => $block['attrs']['animation_iteration_count']*/
		);
		
		$att_string = 'style="';
		foreach ( $atts as $declaration => $value ) {
			$att_string .= $declaration . ': ' . $value . ';';
		}
		$att_string = '"';

		/**
		 * Doing this in two separate preg_replaces.
		 */
		$block_content  = preg_replace( "/(<.+ class=\".+)(\")/", '$1 ' . implode( ' ', $classes ) . ' $2' , $block_content );

		return $block_content;
	}
}