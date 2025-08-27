<?php
/**
 * @author  RadiusTheme
 * @since   1.0.1
 * @version 1.0.1
 */

// Includes the files needed for the theme updater
if ( ! class_exists( 'EDD_Theme_Updater_Admin' ) ) {
	include( dirname( __FILE__ ) . '/theme-updater-admin.php' );
}

add_action( 'after_setup_theme', 'rdtheme_edd_theme_updater', 20 );

function rdtheme_edd_theme_updater() {
	$theme_data = wp_get_theme( get_template() );

	// Config settings
	$config = array(
		'remote_api_url' => 'https://www.radiustheme.com', // Site where EDD is hosted
		'item_id'        => 213859, // ID of item in site where EDD is hosted
		'theme_slug'     => '_radius_directory', // Theme slug
		'version'        => $theme_data->get( 'Version' ), // The current version of this theme
		'author'         => $theme_data->get( 'Author' ), // The author of this theme
		'download_id'    => '', // Optional, used for generating a license renewal link
		'renew_url'      => '' // Optional, allows for a custom license renewal link
	);

	// Strings
	$strings = array(
		'theme-license'             => __( 'Theme License', 'radius-directory' ),
		'enter-key'                 => __( 'Enter your theme license key.', 'radius-directory' ),
		'license-key'               => __( 'License Key', 'radius-directory' ),
		'license-action'            => __( 'License Action', 'radius-directory' ),
		'deactivate-license'        => __( 'Deactivate License', 'radius-directory' ),
		'activate-license'          => __( 'Activate License', 'radius-directory' ),
		'status-unknown'            => __( 'License status is unknown.', 'radius-directory' ),
		'renew'                     => __( 'Renew?', 'radius-directory' ),
		'unlimited'                 => __( 'unlimited', 'radius-directory' ),
		'lifetime-license'          => __( 'License type: lifetime.', 'radius-directory' ),
		'license-key-is-active'     => __( 'License key is active.', 'radius-directory' ),
		'expires%s'                 => __( 'Expires %s.', 'radius-directory' ),
		'%1$s/%2$-sites'            => __( 'You have %1$s / %2$s sites activated.', 'radius-directory' ),
		'license-key-expired-%s'    => __( 'License key expired %s.', 'radius-directory' ),
		'license-key-expired'       => __( 'License key has expired.', 'radius-directory' ),
		'license-keys-do-not-match' => __( 'License keys do not match.', 'radius-directory' ),
		'license-is-inactive'       => __( 'License is inactive.', 'radius-directory' ),
		'license-key-is-disabled'   => __( 'License key is disabled.', 'radius-directory' ),
		'site-is-inactive'          => __( 'Site is inactive.', 'radius-directory' ),
		'license-status-unknown'    => __( 'License status is unknown.', 'radius-directory' ),
		'update-notice'             => __( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.",
			'radius-directory' ),
		'update-available'          => __( '<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.',
			'radius-directory' )
	);

	// Loads the updater classes
	$updater = new EDD_Theme_Updater_Admin( $config, $strings );
}