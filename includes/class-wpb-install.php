<?php
/**
 * Class WPB_Install
 *
 * @package   ColoredCow\WP_Plugin_Boilerplate
 * @copyright 2020 ColoredCow
 * @license   https://www.gnu.org/licenses/gpl-3.0-standalone.html GPL-3.0-or-later
 * @link      https://github.com/abhishek-pokhriyal/wp-plugin-boilerplate
 */

defined( 'ABSPATH' ) || exit;

/**
 * WPB_Install Class.
 */
class WPB_Install {

	/**
	 * Hook in tabs.
	 */
	public static function init() {
		add_action( 'init', array( __CLASS__, 'check_version' ), 5 );
	}

	/**
	 * Check WP Plugin Boilerplate version and run the updater is required.
	 *
	 * This check is done on all requests and runs if the versions do not match.
	 */
	public static function check_version() {
		if ( version_compare( get_option( 'wp_plugin_boilerplate_version' ), WPB()->version, '<' ) ) {
			self::install();
			do_action( 'wp_plugin_boilerplate_updated' );
		}
	}

	/**
	 * Install WPB.
	 */
	public static function install() {
	}
}

WPB_Install::init();
