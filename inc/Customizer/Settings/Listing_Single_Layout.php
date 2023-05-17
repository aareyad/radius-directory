<?php
/**
 * @author  RadiusTheme
 * @since   1.0.0
 * @version 1.0.0
 */

namespace RadiusTheme\RadiusDirectory\Customizer\Settings;

use RadiusTheme\RadiusDirectory\Customizer\Customizer;
use RadiusTheme\RadiusDirectory\Helper;

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class Listing_Single_Layout extends Customizer {

	public function __construct() {
		parent::instance();
		$this->populated_default_data();
		// Register Page Controls
		add_action( 'customize_register', [ $this, 'register_listing_single_layout_controls' ] );
	}

	public function register_listing_single_layout_controls( $wp_customize ) {

		// Top bar
		$wp_customize->add_setting( 'listing_single_top_bar',
			[
				'default'           => $this->defaults['listing_single_top_bar'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_text_sanitization',
			]
		);
		$wp_customize->add_control( 'listing_single_top_bar', [
			'type'    => 'select',
			'section' => 'listing_single_layout_section',
			'label'   => esc_html__( 'Top Bar', 'radius-directory' ),
			'choices' => [
				'default' => esc_html__( 'Default', 'radius-directory' ),
				'on'      => esc_html__( 'Enable', 'radius-directory' ),
				'off'     => esc_html__( 'Disable', 'radius-directory' ),
			],
		] );

		// Header Layout
		$wp_customize->add_setting( 'listing_single_header_style',
			[
				'default'           => $this->defaults['listing_single_header_style'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_text_sanitization',
			]
		);
		$wp_customize->add_control( 'listing_single_header_style', [
			'type'    => 'select',
			'section' => 'listing_single_layout_section',
			'label'   => esc_html__( 'Header Layout', 'radius-directory' ),
			'choices' => Helper::get_header_list(),
		] );

		// Menu Alignment
		$wp_customize->add_setting( 'listing_single_menu_alignment', [
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'rttheme_text_sanitization',
			'default'           => $this->defaults['menu_alignment'],
		] );

		$wp_customize->add_control( 'listing_single_menu_alignment', [
			'type'    => 'select',
			'section' => 'listing_single_layout_section', // Add a default or your own section
			'label'   => esc_html__( 'Menu Alignment', 'radius-directory' ),
			'choices' => [
				'default'     => esc_html__( 'Default', 'radius-directory' ),
				'menu-left'   => esc_html__( 'Left Alignment', 'radius-directory' ),
				'menu-center' => esc_html__( 'Center Alignment', 'radius-directory' ),
				'menu-right'  => esc_html__( 'Right Alignment', 'radius-directory' ),
			],
		] );

		// Header width
		$wp_customize->add_setting( 'listing_single_header_width', [
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'rttheme_text_sanitization',
			'default'           => $this->defaults['listing_single_header_width'],
		] );

		$wp_customize->add_control( 'listing_single_header_width', [
			'type'    => 'select',
			'section' => 'listing_single_layout_section', // Add a default or your own section
			'label'   => esc_html__( 'Header Width', 'radius-directory' ),
			'choices' => [
				'default'   => esc_html__( 'Default', 'radius-directory' ),
				'box-width' => esc_html__( 'Box width', 'radius-directory' ),
				'fullwidth' => esc_html__( 'Fullwidth', 'radius-directory' ),
			],
		] );

		// Transparent Header
		$wp_customize->add_setting( 'listing_single_tr_header',
			[
				'default'           => $this->defaults['listing_single_tr_header'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_text_sanitization',
			]
		);
		$wp_customize->add_control( 'listing_single_tr_header', [
			'type'    => 'select',
			'section' => 'listing_single_layout_section',
			'label'   => esc_html__( 'Transparent Header', 'radius-directory' ),
			'choices' => [
				'default' => esc_html__( 'Default', 'radius-directory' ),
				'on'      => esc_html__( 'Enable', 'radius-directory' ),
				'off'     => esc_html__( 'Disable', 'radius-directory' ),
			],
		] );

		// Breadcrumb
		$wp_customize->add_setting( 'listing_single_breadcrumb',
			[
				'default'           => $this->defaults['listing_single_breadcrumb'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_text_sanitization',
			]
		);
		$wp_customize->add_control( 'listing_single_breadcrumb', [
			'type'    => 'select',
			'section' => 'listing_single_layout_section',
			'label'   => esc_html__( 'Breadcrumb', 'radius-directory' ),
			'choices' => [
				'default' => esc_html__( 'Default', 'radius-directory' ),
				'on'      => esc_html__( 'Enable', 'radius-directory' ),
				'off'     => esc_html__( 'Disable', 'radius-directory' ),
			],
		] );

		// Banner Search
		$wp_customize->add_setting( 'listing_single_banner_search',
			[
				'default'           => $this->defaults['listing_single_banner_search'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_text_sanitization',
			]
		);
		$wp_customize->add_control( 'listing_single_banner_search', [
			'type'    => 'select',
			'section' => 'listing_single_layout_section',
			'label'   => esc_html__( 'Banner Search', 'radius-directory' ),
			'choices' => [
				'default' => esc_html__( 'Default', 'radius-directory' ),
				'on'      => esc_html__( 'Enable', 'radius-directory' ),
				'off'     => esc_html__( 'Disable', 'radius-directory' ),
			],
		] );


		// Padding Top
		$wp_customize->add_setting( 'listing_single_padding_top',
			[
				'default'           => $this->defaults['listing_single_padding_top'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_text_sanitization',
			]
		);
		$wp_customize->add_control( 'listing_single_padding_top',
			[
				'label'       => esc_html__( 'Content Padding Top', 'radius-directory' ),
				'description' => esc_html__( 'Listing Single Content Padding Top ', 'radius-directory' ),
				'section'     => 'listing_single_layout_section',
				'type'        => 'text',
			]
		);

		// Padding Bottom
		$wp_customize->add_setting( 'listing_single_padding_bottom',
			[
				'default'           => $this->defaults['listing_single_padding_bottom'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_text_sanitization',
			]
		);
		$wp_customize->add_control( 'listing_single_padding_bottom',
			[
				'label'       => esc_html__( 'Content Padding Bottom', 'radius-directory' ),
				'description' => esc_html__( 'Listing Single Content Padding Bottom', 'radius-directory' ),
				'section'     => 'listing_single_layout_section',
				'type'        => 'text',
			]
		);

		// Footer Layout
		$wp_customize->add_setting( 'listing_single_footer_style',
			[
				'default'           => $this->defaults['listing_single_footer_style'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_text_sanitization',
			]
		);
		$wp_customize->add_control( 'listing_single_footer_style', [
			'type'    => 'select',
			'section' => 'listing_single_layout_section',
			'label'   => esc_html__( 'Footer Layout', 'radius-directory' ),
			'choices' => Helper::get_footer_list(),
		] );
	}
}