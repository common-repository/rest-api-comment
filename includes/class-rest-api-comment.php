<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://appsdabanda.com
 * @since      1.0.0
 *
 * @package    Rest_Api_Comments
 * @subpackage Rest_Api_Comments/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Rest_Api_Comments
 * @subpackage Rest_Api_Comments/includes
 * @author     workcompany, Appsdabanda, Joaquim Interesting <support@appsdabanda.com>
 */
if(! class_exists('Rest_Api_Comment')){
	class Rest_Api_Comment {

		/**
		 * The loader that's responsible for maintaining and registering all hooks that power
		 * the plugin.
		 *
		 * @since    1.0.0
		 * @access   protected
		 * @var      Rest_Api_Comment_Loader    $loader    Maintains and registers all hooks for the plugin.
		 */
		protected $loader;

		/**
		 * The unique identifier of this plugin.
		 *
		 * @since    1.0.0
		 * @access   protected
		 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
		 */
		protected $plugin_name;

		/**
		 * The current version of the plugin.
		 *
		 * @since    1.0.0
		 * @access   protected
		 * @var      string    $version    The current version of the plugin.
		 */
		protected $version;

		/**
		 * Define the core functionality of the plugin.
		 *
		 * Set the plugin name and the plugin version that can be used throughout the plugin.
		 * Load the dependencies, define the locale, and set the hooks for the admin area and
		 * the public-facing side of the site.
		 *
		 * @since    1.0.0
		 */
		public function __construct() {
			if (defined('REST_API_COMMENT_VERSION')) {
				$this->version = REST_API_COMMENT_VERSION;
			} else {
				$this->version = '1.0.2';
			}
			$this->plugin_name = 'rest-api-comment';

			$this->load_dependencies();
			$this->set_locale();
			$this->define_admin_hooks();
			$this->define_public_hooks();

		}

		/**
		 * Load the required dependencies for this plugin.
		 *
		 * Include the following files that make up the plugin:
		 *
		 * - Rest_Api_comment_Loader. Orchestrates the hooks of the plugin.
		 * - Rest_Api_comment_i18n. Defines internationalization functionality.
		 * - Rest_Api_comment_Admin. Defines all hooks for the admin area.
		 * - Rest_Api_comment_Public. Defines all hooks for the public side of the site.
		 *
		 * Create an instance of the loader which will be used to register the hooks
		 * with WordPress.
		 *
		 * @since    1.0.0
		 * @access   private
		 */
		private function load_dependencies() {

			/**
			 * The class responsible for orchestrating the actions and filters of the
			 * core plugin.
			 */
			require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-rest-api-comment-loader.php';

			/**
			 * The class responsible for defining internationalization functionality
			 * of the plugin.
			 */
			require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-rest-api-comment-i18n.php';

			/**
			 * The class responsible for defining all actions that occur in the admin area.
			 */
			require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-rest-api-comment-admin.php';

			/**
			 * The class responsible for defining all actions that occur in the public-facing
			 * side of the site.
			 */
			require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-rest-api-comment-public.php';

			$this->loader = new Rest_Api_Comment_Loader();

		}

		/**
		 * Define the locale for this plugin for internationalization.
		 *
		 * Uses the Wp_Rest_comments_i18n class in order to set the domain and to register the hook
		 * with WordPress.
		 *
		 * @since    1.0.0
		 * @access   private
		 */
		private function set_locale() {

			$plugin_i18n = new Rest_Api_Comment_i18n();

			$this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');

		}

		/**
		 * Register all of the hooks related to the admin area functionality
		 * of the plugin.
		 *
		 * @since    1.0.0
		 * @access   private
		 */
		private function define_admin_hooks() {

			$plugin_admin = new Rest_Api_Comment_Admin($this->get_plugin_name(), $this->get_version());

			// Adds Admin Menu for comment creation
			// $this->loader->add_action('admin_menu', $plugin_admin, 'add_settings_menu');

			$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
			$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');

		}

		/**
		 * Register all of the hooks related to the public-facing functionality
		 * of the plugin.
		 *
		 * @since    1.0.0
		 * @access   private
		 */
		private function define_public_hooks() {

			$plugin_public = new Rest_Api_Comment_Public($this->get_plugin_name(), $this->get_version());

			// Adds REST API Route for comment creation
			$this->loader->add_action('rest_api_init', $plugin_public, 'add_api_route');

			$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
			$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');

		}

		/**
		 * Run the loader to execute all of the hooks with WordPress.
		 *
		 * @since    1.0.0
		 */
		public function run() {
			$this->loader->run();
		}

		/**
		 * The name of the plugin used to uniquely identify it within the context of
		 * WordPress and to define internationalization functionality.
		 *
		 * @since     1.0.0
		 * @return    string    The name of the plugin.
		 */
		public function get_plugin_name() {
			return $this->plugin_name;
		}

		/**
		 * The reference to the class that orchestrates the hooks with the plugin.
		 *
		 * @since     1.0.0
		 * @return    Rest_Api_Comment_Loader    Orchestrates the hooks of the plugin.
		 */
		public function get_loader() {
			return $this->loader;
		}

		/**
		 * Retrieve the version number of the plugin.
		 *
		 * @since     1.0.0
		 * @return    string    The version number of the plugin.
		 */
		public function get_version() {
			return $this->version;
		}
	}
}
