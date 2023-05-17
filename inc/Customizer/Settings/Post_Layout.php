<?php
/**
 * @author  RadiusTheme
 * @since   1.0.0
 * @version 1.0.0
 */

namespace RadiusTheme\RadiusDirectory\Customizer\Settings;

use RadiusTheme\RadiusDirectory\Customizer\Controls\Image_Radio;
use RadiusTheme\RadiusDirectory\Customizer\Customizer;
use RadiusTheme\RadiusDirectory\Helper;

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class Post_Layout extends Customizer {

	public function __construct() {
		parent::instance();
		$this->populated_default_data();
		// Register Page Controls
		add_action( 'customize_register', [ $this, 'register_single_post_layout_controls' ] );
	}

	public function register_single_post_layout_controls( $wp_customize ) {
		// Layout
		$wp_customize->add_setting( 'single_post_layout',
			[
				'default'           => $this->defaults['single_post_layout'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_radio_sanitization',
			]
		);
		$wp_customize->add_control( new Image_Radio( $wp_customize, 'single_post_layout',
			[
				'label'       => esc_html__( 'Layout', 'radius-directory' ),
				'description' => esc_html__( 'Select the default template layout for single post', 'radius-directory' ),
				'section'     => 'single_post_layout_section',
				'choices'     => [
					'left-sidebar'  => [
						'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/sidebar-left.png',
						'name'  => esc_html__( 'Left Sidebar', 'radius-directory' ),
					],
					'full-width'    => [
						'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/sidebar-full.png',
						'name'  => esc_html__( 'Full Width', 'radius-directory' ),
					],
					'right-sidebar' => [
						'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/sidebar-right.png',
						'name'  => esc_html__( 'Right Sidebar', 'radius-directory' ),
					],
				],
			]
		) );
		// Sidebar
		$wp_customize->add_setting( 'single_post_sidebar',
			[
				'default'           => $this->defaults['single_post_sidebar'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_text_sanitization',
			]
		);
		$wp_customize->add_control( 'single_post_sidebar', [
			'type'    => 'select',
			'section' => 'single_post_layout_section',
			'label'   => esc_html__( 'Custom Sidebar', 'radius-directory' ),
			'choices' => Helper::custom_sidebar_fields(),
		] );
		// Top bar
		$wp_customize->add_setting( 'single_post_top_bar',
			[
				'default'           => $this->defaults['single_post_top_bar'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_text_sanitization',
			]
		);
		$wp_customize->add_control( 'single_post_top_bar', [
			'type'    => 'select',
			'section' => 'single_post_layout_section',
			'label'   => esc_html__( 'Top Bar', 'radius-directory' ),
			'choices' => [
				'default' => esc_html__( 'Default', 'radius-directory' ),
				'on'      => esc_html__( 'Enable', 'radius-directory' ),
				'off'     => esc_html__( 'Disable', 'radius-directory' ),
			],
		] );
		// Header Layout
		$wp_customize->add_setting( 'single_post_header_style',
			[
				'default'           => $this->defaults['single_post_header_style'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_text_sanitization',
			]
		);
		$wp_customize->add_control( 'single_post_header_style', [
			'type'    => 'select',
			'section' => 'single_post_layout_section',
			'label'   => esc_html__( 'Header Layout', 'radius-directory' ),
			'choices' => Helper::get_header_list(),
		] );

		//Menu Alignment
		$wp_customize->add_setting( 'single_post_menu_alignment', [
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'rttheme_text_sanitization',
			'default'           => $this->defaults['menu_alignment'],
		] );

		$wp_customize->add_control( 'single_post_menu_alignment', [
			'type'    => 'select',
			'section' => 'single_post_layout_section', // Add a default or your own section
			'label'   => esc_html__( 'Menu Alignment', 'radius-directory' ),
			'choices' => [
				'default'     => esc_html__( 'Default', 'radius-directory' ),
				'menu-left'   => esc_html__( 'Left Alignment', 'radius-directory' ),
				'menu-center' => esc_html__( 'Center Alignment', 'radius-directory' ),
				'menu-right'  => esc_html__( 'Right Alignment', 'radius-directory' ),
			],
		] );

		//Header width
		$wp_customize->add_setting( 'single_post_header_width', [
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'rttheme_text_sanitization',
			'default'           => $this->defaults['single_post_header_width'],
		] );

		$wp_customize->add_control( 'single_post_header_width', [
			'type'    => 'select',
			'section' => 'single_post_layout_section', // Add a default or your own section
			'label'   => esc_html__( 'Header Width', 'radius-directory' ),
			'choices' => [
				'default'   => esc_html__( 'Default', 'radius-directory' ),
				'box-width' => esc_html__( 'Box width', 'radius-directory' ),
				'fullwidth' => esc_html__( 'Fullwidth', 'radius-directory' ),
			],
		] );

		// Transparent Header
		$wp_customize->add_setting( 'single_post_tr_header',
			[
				'default'           => $this->defaults['single_post_tr_header'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_text_sanitization',
			]
		);
		$wp_customize->add_control( 'single_post_tr_header', [
			'type'    => 'select',
			'section' => 'single_post_layout_section',
			'label'   => esc_html__( 'Transparent Header', 'radius-directory' ),
			'choices' => [
				'default' => esc_html__( 'Default', 'radius-directory' ),
				'on'      => esc_html__( 'Enable', 'radius-directory' ),
				'off'     => esc_html__( 'Disable', 'radius-directory' ),
			],
		] );

		// Breadcrumb
		$wp_customize->add_setting( 'single_post_breadcrumb',
			[
				'default'           => $this->defaults['single_post_breadcrumb'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_text_sanitization',
			]
		);
		$wp_customize->add_control( 'single_post_breadcrumb', [
			'type'    => 'select',
			'section' => 'single_post_layout_section',
			'label'   => esc_html__( 'Breadcrumb', 'radius-directory' ),
			'choices' => [
				'default' => esc_html__( 'Default', 'radius-directory' ),
				'on'      => esc_html__( 'Enable', 'radius-directory' ),
				'off'     => esc_html__( 'Disable', 'radius-directory' ),
			],
		] );

		// Banner Search
		$wp_customize->add_setting( 'single_post_banner_search',
			[
				'default'           => $this->defaults['single_post_banner_search'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_text_sanitization',
			]
		);
		$wp_customize->add_control( 'single_post_banner_search', [
			'type'    => 'select',
			'section' => 'single_post_layout_section',
			'label'   => esc_html__( 'Banner Search', 'radius-directory' ),
			'choices' => [
				'default' => esc_html__( 'Default', 'radius-directory' ),
				'on'      => esc_html__( 'Enable', 'radius-directory' ),
				'off'     => esc_html__( 'Disable', 'radius-directory' ),
			],
		] );

		// Padding Top
		$wp_customize->add_setting( 'single_post_padding_top',
			[
				'default'           => $this->defaults['single_post_padding_top'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_text_sanitization',
			]
		);
		$wp_customize->add_control( 'single_post_padding_top',
			[
				'label'       => esc_html__( 'Content Padding Top (rem)', 'radius-directory' ),
				'description' => esc_html__( 'Single Post Content Padding Top ', 'radius-directory' ),
				'section'     => 'single_post_layout_section',
				'type'        => 'text',
			]
		);

		// Padding Bottom
		$wp_customize->add_setting( 'single_post_padding_bottom',
			[
				'default'           => $this->defaults['single_post_padding_bottom'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_text_sanitization',
			]
		);
		$wp_customize->add_control( 'single_post_padding_bottom',
			[
				'label'       => esc_html__( 'Content Padding Bottom (rem)', 'radius-directory' ),
				'description' => esc_html__( 'Single Post Content Padding Bottom', 'radius-directory' ),
				'section'     => 'single_post_layout_section',
				'type'        => 'text',
			]
		);

		// Footer Layout
		$wp_customize->add_setting( 'single_post_footer_style',
			[
				'default'           => $this->defaults['single_post_footer_style'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_text_sanitization',
			]
		);
		$wp_customize->add_control( 'single_post_footer_style', [
			'type'    => 'select',
			'section' => 'single_post_layout_section',
			'label'   => esc_html__( 'Footer Layout', 'radius-directory' ),
			'choices'     => Helper::get_footer_list(),
		] );
	}
}