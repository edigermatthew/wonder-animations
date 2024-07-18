<?php
/**
 * Main plugin class.
 * 
 * This file contains the main plugin class for wonder-animations.
 * 
 * @since 0.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Wonder Animations.
 */
class Wonder_Animations {

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
	 */
	public function __construct() {
		$this->plugin_name = WONDER_ANIMATIONS_PLUGIN_NAME;
		$this->version     = WONDER_ANIMATIONS_VERSION;

		$this->require_dependencies();
	}

	/**
	 * Require dependencies.
	 * 
	 * Require the necessary files for the rest of the plugin.
	 * 
	 * @access private
	 */
	private function require_dependencies() {
		/**
		 * Wonder animations functions.
		 */
		require_once plugin_dir_path( __FILE__ ) . 'wonder-animations-functions.php';

		/**
		 * Wonder animations admin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wonder-animations-admin.php';

		/**
		 * Wonder animations public.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-wonder-animations-public.php';
	}

	/**
	 * Init.
	 * 
	 * Initialize the class.
	 */
	public function init() {
		$this->fire_admin_hooks();
		$this->fire_public_hooks();
	}

	/**
	 * Fire admin hooks.
	 * 
	 * Fire the admin hooks.
	 * 
	 * @access private
	 */
	private function fire_admin_hooks() {
		$plugin_admin = new Wonder_Animations_Admin( $this->plugin_name, $this->version );

		add_action( 'enqueue_block_editor_assets', array( $plugin_admin, 'enqueue_block_editor_assets' ) );
	}

	/**
	 * Fire public hooks.
	 * 
	 * Fire the public hooks.
	 * 
	 * @access private
	 */
	private function fire_public_hooks() {
		$plugin_public = new Wonder_Animations_Public( $this->plugin_name, $this->version );

		add_action( 'wp_enqueue_scripts', array( $plugin_public, 'enqueue_scripts' ) );
		add_filter( 'render_block', array( $plugin_public, 'render_block' ), 99, 3 );
	}
}