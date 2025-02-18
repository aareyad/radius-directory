<?php
/**
 * @author  RadiusTheme
 * @since   1.0.0
 * @version 1.0.0
 */

use RadiusTheme\RadiusDirectory\Constants;
use RadiusTheme\RadiusDirectory\TGM_Config;
use RadiusTheme\RadiusDirectory\General;
use RadiusTheme\RadiusDirectory\Layouts;
use RadiusTheme\RadiusDirectory\Listing_Functions;
use RadiusTheme\RadiusDirectory\Scripts;
use RadiusTheme\RadiusDirectory\Options;
use RadiusTheme\RadiusDirectory\Customizer\Init;

require_once get_template_directory() . '/vendor/autoload.php';

final class Includes {
	private $suffix;
	private $version;
	private static $singleton = false;

	/**
	 * Create an inaccessible constructor.
	 */
	private function __construct() {
		$this->suffix  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
		$this->version = ( defined( 'WP_DEBUG' ) && WP_DEBUG ) ? time() : RADIUS_DIRECTORY_VERSION;

		$this->init();
	}

	/**
	 * Fetch an instance of the class.
	 */
	final public static function getInstance() {
		if ( self::$singleton === false ) {
			self::$singleton = new self();
		}

		return self::$singleton;
	}

	/**
	 * Classified Listing Constructor.
	 */
	protected function init() {
		new Constants();
		new TGM_Config();
		Options::instance();
		General::instance();
		Scripts::instance();
		Layouts::instance();
		if ( class_exists( 'WP_Customize_Control' ) ) {
			Init::instance();
		}
		if ( class_exists( 'Rtcl' ) ) {
			Listing_Functions::instance();
		}
	}

}

/**
 * @return bool|Includes
 */
function Includes() {
	return Includes::getInstance();
}

Includes();
