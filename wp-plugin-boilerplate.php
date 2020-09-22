<?php
/**
 * Main plugin file.
 *
 * @package   ColoredCow\WP_Plugin_Boilerplate
 * @copyright 2020 ColoredCow
 * @license   https://www.gnu.org/licenses/gpl-3.0-standalone.html GPL-3.0-or-later
 * @link      https://github.com/abhishek-pokhriyal/wp-plugin-boilerplate
 *
 * Plugin Name: WP Plugin Boilerplate
 * Description: Yet another boilerplate to create WordPress plugin.
 * Plugin URI: https://github.com/abhishek-pokhriyal/wp-plugin-boilerplate
 * Author: ColoredCow
 * Author URI: https://coloredcow.com/
 * Version: 1.2.0
 * Requires at least: 5.3
 * Requires PHP: 5.6
 * Text Domain: wp-plugin-boilerplate
 * License: GPL-3.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-3.0-standalone.html
 */

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'WPB_PLUGIN_FILE' ) ) {
	define( 'WPB_PLUGIN_FILE', __FILE__ );
}

// Include the main WpPluginBoilerplate class.
if ( ! class_exists( 'Wp_Plugin_Boilerplate', false ) ) {
	include_once dirname( WPB_PLUGIN_FILE ) . '/includes/class-wp-plugin-boilerplate.php';
}

/**
 * Returns the main instance of WPB.
 *
 * @since  1.0
 * @return Wp_Plugin_Boilerplate
 */
function WPB() {
	return Wp_Plugin_Boilerplate::instance();
}

WPB();
