<?php
/**
 * Class Wp_Plugin_Boilerplate
 *
 * @package   ColoredCow\WP_Plugin_Boilerplate
 * @copyright 2020 ColoredCow
 * @license   https://www.gnu.org/licenses/gpl-3.0-standalone.html GPL-3.0-or-later
 * @link      https://github.com/abhishek-pokhriyal/wp-plugin-boilerplate
 */

defined( 'ABSPATH' ) || exit;

/**
 * Main Wp_Plugin_Boilerplate Class.
 *
 * @class Wp_Plugin_Boilerplate
 */
final class Wp_Plugin_Boilerplate {

	/**
	 * Wp_Plugin_Boilerplate version.
	 *
	 * @var string
	 */
	public $version = '1.0.0';

	/**
	 * Wp_Plugin_Boilerplate Schema version.
	 *
	 * @since 1.0.0 started with version string 100.
	 *
	 * @var string
	 */
	public $db_version = '100';

	/**
	 * The single instance of the class.
	 *
	 * @var Wp_Plugin_Boilerplate
	 * @since 1.0.0
	 */
	protected static $_instance = null;

	/**
	 * Main Wp_Plugin_Boilerplate Instance.
	 *
	 * Ensures only one instance of Wp_Plugin_Boilerplate is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see WPB()
	 * @return Wp_Plugin_Boilerplate - Main instance.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Wp_Plugin_Boilerplate Constructor.
	 */
	public function __construct() {
		$this->define_constants();
		$this->includes();
		$this->init_hooks();
	}

	/**
	 * Hook into actions and filters.
	 *
	 * @since 1.0
	 */
	private function init_hooks() {
		register_activation_hook( WPB_PLUGIN_FILE, array( 'WPB_Install', 'install' ) );

		add_action( 'init', array( $this, 'init' ), 0 );
		add_action( 'init', array( 'WPB_Shortcodes', 'init' ) );
	}

	/**
	 * Define WPB Constants.
	 */
	private function define_constants() {
		$this->define( 'WPB_ABSPATH', dirname( WPB_PLUGIN_FILE ) . '/' );
		$this->define( 'WPB_PLUGIN_BASENAME', plugin_basename( WPB_PLUGIN_FILE ) );
		$this->define( 'WPB_VERSION', $this->version );
	}

	/**
	 * Define constant if not already set.
	 *
	 * @param string      $name  Constant name.
	 * @param string|bool $value Constant value.
	 */
	private function define( $name, $value ) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}

	/**
	 * Returns true if the request is a non-legacy REST API request.
	 *
	 * Legacy REST requests should still run some extra code for backwards compatibility.
	 *
	 * @todo: replace this function once core WP function is available: https://core.trac.wordpress.org/ticket/42061.
	 *
	 * @return bool
	 */
	public function is_rest_api_request() {
		if ( empty( $_SERVER['REQUEST_URI'] ) ) {
			return false;
		}

		$rest_prefix         = trailingslashit( rest_get_url_prefix() );
		$is_rest_api_request = ( false !== strpos( $_SERVER['REQUEST_URI'], $rest_prefix ) );

		return apply_filters( 'wp_plugin_boilerplate_is_rest_api_request', $is_rest_api_request );
	}

	/**
	 * What type of request is this?
	 *
	 * @param  string $type admin, ajax, cron or frontend.
	 * @return bool
	 */
	private function is_request( $type ) {
		switch ( $type ) {
			case 'admin':
				return is_admin();
			case 'ajax':
				return defined( 'DOING_AJAX' );
			case 'cron':
				return defined( 'DOING_CRON' );
			case 'frontend':
				return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' ) && ! $this->is_rest_api_request();
		}
	}

	/**
	 * Include required core files used in admin and on the frontend.
	 */
	public function includes() {
		/**
		 * Class autoloader.
		 */
		include_once WPB_ABSPATH . 'includes/class-wpb-autoloader.php';

		// Load Interfaces.

		// Load Core traits.

		// Load Abstract classes.

		// Load Core classes.
		include_once WPB_ABSPATH . 'includes/class-wpb-install.php';
		include_once WPB_ABSPATH . 'includes/class-wpb-shortcodes.php';

		// Load Data stores - used to store and retrieve CRUD object data from the database.

		// Load REST API.

		// Load Libraries and packages.

		if ( $this->is_request( 'admin' ) ) {
			include_once WPB_ABSPATH . 'includes/admin/class-wpb-admin.php';
		}

		if ( $this->is_request( 'frontend' ) ) {
			$this->frontend_includes();
		}
	}

	/**
	 * Include required frontend files.
	 */
	public function frontend_includes() {
		include_once WPB_ABSPATH . 'includes/wpb-template-hooks.php';
		include_once WPB_ABSPATH . 'includes/class-wpb-template-loader.php';
		include_once WPB_ABSPATH . 'includes/class-wpb-frontend-scripts.php';
		include_once WPB_ABSPATH . 'includes/class-wpb-form-handler.php';
	}

	/**
	 * Function used to Init WP Plugin Boilerplate Template Functions - This makes them pluggable by plugins and themes.
	 */
	public function include_template_functions() {
		include_once WPB_ABSPATH . 'includes/wpb-template-functions.php';
	}

	/**
	 * Init WP Plugin Boilerplate when WordPress Initialises.
	 */
	public function init() {
		// Set up localisation.
		$this->load_plugin_textdomain();
	}

	/**
	 * Load Localisation files.
	 */
	public function load_plugin_textdomain() {
		if ( function_exists( 'determine_locale' ) ) {
			$locale = determine_locale();
		} else {
			// @todo Remove when start supporting WP 5.0 or later.
			$locale = is_admin() ? get_user_locale() : get_locale();
		}

		$locale = apply_filters( 'plugin_locale', $locale, 'wp-plugin-boilerplate' );

		unload_textdomain( 'wp-plugin-boilerplate' );
		load_textdomain( 'wp-plugin-boilerplate', WP_LANG_DIR . '/wp-plugin-boilerplate/woocommerce-' . $locale . '.mo' );
		load_plugin_textdomain( 'wp-plugin-boilerplate', false, plugin_basename( dirname( WPB_PLUGIN_FILE ) ) . '/i18n/languages' );
	}

	/**
	 * Get the plugin url.
	 *
	 * @return string
	 */
	public function plugin_url() {
		return untrailingslashit( plugins_url( '/', WPB_PLUGIN_FILE ) );
	}

	/**
	 * Get the plugin path.
	 *
	 * @return string
	 */
	public function plugin_path() {
		return untrailingslashit( plugin_dir_path( WPB_PLUGIN_FILE ) );
	}
}
