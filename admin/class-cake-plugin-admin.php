<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://businesslabs.org
 * @since      1.0.0
 *
 * @package    Cake_Plugin
 * @subpackage Cake_Plugin/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Cake_Plugin
 * @subpackage Cake_Plugin/admin
 * @author     Nasiruddin at Businesslabs <nasiruddin@businesslabs.org>
 */
class Cake_Plugin_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Cake_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cake_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cake-plugin-admin.css', array(), $this->version, 'all' );
		// bootstrap
		wp_enqueue_style( 'bootstrap', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Cake_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cake_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cake-plugin-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Add our custom menu
	 *
	 * @since    1.0.0
	 */

	public function add_plugin_admin_menu() {

		add_menu_page( 'Cake Plugin Settings', 'Cake Products', 'manage_options', $this->plugin_name, array($this, 'display_product_page'));

		add_submenu_page( $this->plugin_name, 'Add New Cake', 'Add New', 'manage_options', $this->plugin_name."-add", array($this, 'display_add_new_page'));

		add_submenu_page( $this->plugin_name, 'Categories', 'Categories', 'manage_options', $this->plugin_name."-categories", array($this, 'display_categories_page'));
		add_submenu_page( $this->plugin_name, 'Settings', 'Settings', 'manage_options', $this->plugin_name."-settings", array($this, 'display_settings_page'));
	}
	
	public function display_product_page() {
		include_once( 'partials/cake-plugin-admin-display.php' );
	}

	public function display_add_new_page() {
		include_once( 'partials/cake-plugin-admin-add-new.php' );
	}

	public function display_settings_page() {
		include_once( 'partials/cake-plugin-admin-settings.php' );
	}
	public function display_categories_page() {
		include_once( 'partials/cake-plugin-admin-categories.php' );
	}

	// Register our setting
	public function register_settings() {
		register_setting( 'cake-plugin-settings-group', 'cake_api_key' );
		register_setting( 'cake-plugin-settings-group', 'cake_api_host' );
		register_setting( 'cake-plugin-settings-group', 'cake_asset_url' );
	}

	public function display_products() {
		
	}

		public function register_cake_post_type() {

		/**
		 * Post Type: Cakes.
		 */

		$labels = [
			"name" => esc_html__( "Cakes", "twentytwentytwo" ),
			"singular_name" => esc_html__( "Cake", "twentytwentytwo" ),
		];

		$args = [
			"label" => esc_html__( "Cakes", "twentytwentytwo" ),
			"labels" => $labels,
			"description" => "",
			"public" => true,
			"publicly_queryable" => true,
			"show_ui" => true,
			"show_in_rest" => true,
			"rest_base" => "",
			"rest_controller_class" => "WP_REST_Posts_Controller",
			"rest_namespace" => "wp/v2",
			"has_archive" => false,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"delete_with_user" => false,
			"exclude_from_search" => false,
			"capability_type" => "post",
			"map_meta_cap" => true,
			"hierarchical" => false,
			"can_export" => false,
			"rewrite" => [ "slug" => "cakes", "with_front" => true ],
			"query_var" => true,
			"supports" => [ "title", "editor", "thumbnail" ],
			"show_in_graphql" => false,
		];

		register_post_type( "cakes", $args );
	}
}
