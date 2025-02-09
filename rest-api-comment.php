<?php
    /**
    * REST API Comment
    *
    * REST API Comment is free software: you can redistribute it and/or modify
    * it under the terms of the GNU General Public License as published by
    * the Free Software Foundation, either version 2 of the License, or
    * any later version.
    *
    * REST API Comment is distributed in the hope that it will be useful,
    * but WITHOUT ANY WARRANTY; without even the implied warranty of
    * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
    * GNU General Public License for more details.
    *
    * You should have received a copy of the GNU General Public License
    * along with REST API Comment. If not, see http://www.gnu.org/licenses/gpl-2.0.html
    *
    * @package           rest-api-comment
    * @author            Joaquim Domingos António
    * @copyright         2021 Appsdabanda
    * @license           GPL - 2.0-or-later
    * @since             1.0.0
    * 
    * Plugin Name:       REST API Comment
    * Description:       Create comments via REST API, this plugin allows comments from mobile, desktop and other web Applications
    * Version:           1.0.2
    * Requires at least: 5.5
    * Tested up to:      5.8.1
    * Requires PHP:      7.0
    * Author:            Joaquim Domingos António
    * Author URI:        https://appsdabanda.com
    * License:           GPL v2 or later
    * License URI:       http://www.gnu.org/licenses/gpl-2.0.html
    * Text Domain:       rest-api-comment
    * Domain Path:       /languages
    */

    // If this file is called directly, abort.
    if (!defined('WPINC')) {
        die;
    }

    /**
    * Currently plugin version 1.0.2.
    * Start at version 1.0.0 
    */
    define('REST_API_COMMENT_VERSION', '1.0.2');

    /**
    * The code that runs during plugin activation.
    * This action is documented in includes/class-wp-rest-comment-activator.php
    */
    function activate_rest_api_comment() {
        require_once plugin_dir_path(__FILE__) . 'includes/class-rest-api-comment-activator.php';
        Rest_Api_Comment_Activator::activate();
    }

    /**
    * The code that runs during plugin deactivation.
    * This action is documented in includes/class-wp-rest-comment-deactivator.php
    */
    function deactivate_rest_api_comment() {
        require_once plugin_dir_path(__FILE__) . 'includes/class-rest-api-comment-deactivator.php';
        Rest_api_Comment_Deactivator::deactivate();
    }

    register_activation_hook(__FILE__, 'activate_rest_api_comment');
    register_deactivation_hook(__FILE__, 'deactivate_rest_api_comment');

    /**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-rest-api-comment.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_rest_api_comment() {

	$plugin = new Rest_Api_Comment();
	$plugin->run();

}
run_rest_api_comment();

?>