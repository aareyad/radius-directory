<?php
/**
 * @author  RadiusTheme
 * @since   1.0.0
 * @version 1.0.0
 */

if ( ! isset( $content_width ) ) {
	$content_width = 1240;
}

add_action( 'after_setup_theme', 'radius_directory_load_textdomain' );
function radius_directory_load_textdomain() {
	load_theme_textdomain( 'radius-directory', get_template_directory() . '/languages' );
}

define( 'RADIUS_DIRECTORY_VERSION', '1.2.2' );

if ( ! defined('RT_DEBUG') ) {
    require_once 'lib/updater/theme-updater.php';
}
require_once 'lib/class-tgm-plugin-activation.php';
require_once 'inc/init.php';
require_once 'inc/Customizer/sanitization.php';

do_action( 'radius_directory_theme_init' );