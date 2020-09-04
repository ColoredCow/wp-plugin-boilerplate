<?php
/**
 * Plugin Name: WP Plugin Boilerplate
 * Plugin URI: https://coloredcow.com/
 * Description: A boilerplate to create WordPress plugin.
 * Version: 1.0.0
 * Author: ColoredCow
 * Author URI: https://coloredcow.com
 * Text Domain: wp-plugin-boilerplate
 * Domain Path: /i18n/languages/
 * Requires at least: 5.2
 * Requires PHP: 7.0
 *
 * @package WpPluginBoilerplate
 */

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'WPB_PLUGIN_FILE' ) ) {
	define( 'WPB_PLUGIN_FILE', __FILE__ );
}

// Include the main WpPluginBoilerplate class.
if ( ! class_exists( 'WpPluginBoilerplate', false ) ) {
	include_once dirname( WPB_PLUGIN_FILE ) . '/includes/class-wp-plugin-boilerplate.php';
}

/**
 * Returns the main instance of WPB.
 *
 * @since  1.0
 * @return WpPluginBoilerplate
 */
function WPB() {
	return WpPluginBoilerplate::instance();
}

WPB();
