<?php
/**
 * Class WPB_Autoloader
 *
 * @package   ColoredCow\WP_Plugin_Boilerplate
 * @copyright 2020 ColoredCow
 * @license   https://www.gnu.org/licenses/gpl-3.0-standalone.html GPL-3.0-or-later
 * @link      https://github.com/abhishek-pokhriyal/wp-plugin-boilerplate
 */

defined( 'ABSPATH' ) || exit;

/**
 * Autoloader class.
 */
class WPB_Autoloader {

	/**
	 * Path to the includes directory.
	 *
	 * @var string
	 */
	private $include_path = '';

	/**
	 * The Constructor.
	 */
	public function __construct() {
		if ( function_exists( '__autoload' ) ) {
			spl_autoload_register( '__autoload' );
		}

		spl_autoload_register( array( $this, 'autoload' ) );

		$this->include_path = untrailingslashit( plugin_dir_path( WPB_PLUGIN_FILE ) ) . '/includes/';
	}

	/**
	 * Take a class name and turn it into a file name.
	 *
	 * @param  string $class Class name.
	 * @return string
	 */
	private function get_file_name_from_class( $class ) {
		return 'class-' . str_replace( '_', '-', $class ) . '.php';
	}

	/**
	 * Include a class file.
	 *
	 * @param  string $path File path.
	 * @return bool Successful or not.
	 */
	private function load_file( $path ) {
		if ( $path && is_readable( $path ) ) {
			include_once $path;
			return true;
		}
		return false;
	}

	/**
	 * Auto-load WPB classes on demand to reduce memory consumption.
	 *
	 * @param string $class Class name.
	 */
	public function autoload( $class ) {
		$class = strtolower( $class );

		if ( 0 !== strpos( $class, 'wpb_' ) ) {
			return;
		}

		$file = $this->get_file_name_from_class( $class );
		$path = '';

		if ( 0 === strpos( $class, 'wpb_some_class_' ) ) {
			$path = $this->include_path . 'some_class_dir/';
		} elseif ( 0 === strpos( $class, 'wpb_another_class_' ) ) {
			$path = $this->include_path . 'another_class_dir/';
		}

		if ( empty( $path ) || ! $this->load_file( $path . $file ) ) {
			$this->load_file( $this->include_path . $file );
		}
	}
}

new WPB_Autoloader();
