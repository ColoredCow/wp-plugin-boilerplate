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
		add_action( 'wp_plugin_boilerplate_run_update_callback', array( __CLASS__, 'run_update_callback' ) );
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
		if ( ! is_blog_installed() ) {
			return;
		}
		// Check if we are not already running this routine.
		if ( 'yes' === get_transient( 'wp_plugin_boilerplate_installing' ) ) {
			return;
		}
		self::update_wp_plugin_boilerplate_version();
		self::maybe_update_db_version();
		self::create_tables();
	}

	/**
	 * Set up the database tables which the plugin needs to function.
	 * WARNING: If you are modifying this method, make sure that its safe to call regardless of the state of database.
	 *
	 * This is called from `install` method and is executed in-sync when WPB is installed or updated.
	 */
	private static function create_tables() {
		require_once ABSPATH . 'wp-admin/includes/upgrade.php';

		dbDelta( self::get_schema() );
	}

	/**
	 * Get Table schema.
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	private static function get_schema() {
		global $wpdb;

		$collate = '';

		if ( $wpdb->has_cap( 'collation' ) ) {
			$collate = $wpdb->get_charset_collate();
		}

		$tables = '';

		return $tables;
	}

	/**
	 * See if we need to show or run database updates during install.
	 *
	 * @since 1.0.0
	 */
	private static function maybe_update_db_version() {
		if ( self::needs_db_update() ) {
			self::update();
		} else {
			self::update_db_version();
		}
	}

	/**
	 * Is a DB update needed?
	 *
	 * @since  1.0.0
	 * @return boolean
	 */
	public static function needs_db_update() {
		$current_db_version = get_option( 'wp_plugin_boilerplate_db_version', null );
		$updates            = self::get_db_update_callbacks();
		$update_versions    = array_keys( $updates );
		usort( $update_versions, 'version_compare' );

		return ! is_null( $current_db_version ) && version_compare( $current_db_version, end( $update_versions ), '<' );
	}

	/**
	 * Get list of DB update callbacks.
	 *
	 * @since  1.0.0
	 *
	 * @return array
	 */
	public static function get_db_update_callbacks() {
		return self::$db_updates;
	}

	/**
	 * Push all needed DB updates to the queue for processing.
	 *
	 * @since 2.3.2
	 */
	private static function update() {
		$current_db_version = get_option( 'wp_plugin_boilerplate_db_version' );
		$loop               = 0;

		foreach ( self::get_db_update_callbacks() as $version => $update_callbacks ) {
			if ( version_compare( $current_db_version, $version, '<' ) ) {
				foreach ( $update_callbacks as $update_callback ) {
					WC()->queue()->schedule_single(
						time() + $loop,
						'wp_plugin_boilerplate_run_update_callback',
						array(
							'update_callback' => $update_callback,
						),
						'wp-plugin-boilerplate-db-updates'
					);
					$loop++;
				}
			}
		}
	}

	/**
	 * Update DB version to current.
	 *
	 * @param string|null $version New MFM_Athletes DB version or null.
	 */
	public static function update_db_version( $version = null ) {
		update_option( 'wp_plugin_boilerplate_db_version', is_null( $version ) ? wpb()->version : $version );
	}

	/**
	 * Update MFM_Athletes version to current.
	 *
	 * @since 1.0.0
	 */
	private static function update_wp_plugin_boilerplate_version() {
		update_option( 'wp_plugin_boilerplate_version', wpb()->version );
	}

	/**
	 * Run an update callback when triggered by ActionScheduler.
	 *
	 * @since 1.0.0.
	 *
	 * @param string $callback Callback name.
	 */
	public static function run_update_callback( $callback ) {
		include_once dirname( __FILE__ ) . '/wpb-update-functions.php';

		if ( is_callable( $callback ) ) {
			self::run_update_callback_start( $callback );
			$result = (bool) call_user_func( $callback );
			self::run_update_callback_end( $callback, $result );
		}
	}

	/**
	 * Triggered when a callback will run.
	 *
	 * @since 1.0.0
	 *
	 * @param string $callback Callback name.
	 */
	protected static function run_update_callback_start( $callback ) {
		wpb()->define( 'WPB_UPDATING', true );
	}

	/**
	 * Triggered when a callback has ran.
	 *
	 * @since 1.0.0
	 *
	 * @param string $callback Callback name.
	 * @param bool   $result Return value from callback. Non-false need to run again.
	 */
	protected static function run_update_callback_end( $callback, $result ) {
		if ( $result ) {
			WC()->queue()->add(
				'wp_plugin_boilerplate_run_update_callback',
				array(
					'update_callback' => $callback,
				),
				'wp-plugin-boilerplate-db-updates'
			);
		}
	}
}

WPB_Install::init();
