<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://appsdabanda.com
 * @since      1.0.0
 *
 * @package    Rest_Api_Comment
 * @subpackage Rest_Api_Comment/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Rest_Api_Comment
 * @subpackage Rest_Api_Comment/admin
 * @author     Workcompany, Appsdabanda, joaquiminteresting <support@appsdabanda.com>
 */
if(! class_exists('Rest_Api_Comment_Admin')){
	class Rest_Api_Comment_Admin {

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
		public function __construct($plugin_name, $version) {

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
			 * defined in Wp_Rest_Comment_Loader as all of the hooks are defined
			 * in that particular class.
			 *
			 * The Wp_Rest_Comment_Loader will then create the relationship
			 * between the defined hooks and the functions defined in this
			 * class.
			 */

			wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/rest-api-comment-admin.css', array(), $this->version, 'all');

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
			 * defined in Wp_Rest_Comment_Loader as all of the hooks are defined
			 * in that particular class.
			 *
			 * The Wp_Rest_Comment_Loader will then create the relationship
			 * between the defined hooks and the functions defined in this
			 * class.
			 */

			wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/rest-api-comment-admin.js', array('jquery'), $this->version, false);

		}

	}
}
