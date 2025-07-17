<?php
/**
 * @author  RadiusTheme
 * @since   1.0.0
 * @version 1.0.0
 */

if ( ! isset( $content_width ) ) {
	$content_width = 1240;
}

add_action( 'init', 'radius_directory_load_textdomain' );
add_action( 'after_setup_theme', 'radius_directory_theme_load' );
function radius_directory_load_textdomain() {
	load_theme_textdomain( 'radius-directory', get_template_directory() . '/languages' );
}

function radius_directory_theme_load() {
	do_action( 'radius_directory_theme_init' );
}

define( 'RADIUS_DIRECTORY_VERSION', '1.5.1' );


require_once 'lib/updater/theme-updater.php';
require_once 'lib/class-tgm-plugin-activation.php';
require_once 'inc/init.php';
require_once 'inc/Customizer/sanitization.php';