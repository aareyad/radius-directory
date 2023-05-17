<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RadiusTheme\RadiusDirectory\Customizer\Settings;

use RadiusTheme\RadiusDirectory\Customizer\Controls\Color;
use RadiusTheme\RadiusDirectory\Customizer\Controls\Image_Radio;
use RadiusTheme\RadiusDirectory\Customizer\Controls\Switcher;
use RadiusTheme\RadiusDirectory\Customizer\Customizer;
use RadiusTheme\RadiusDirectory\Helper;

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class Header extends Customizer {

	public function __construct() {
		parent::instance();
		$this->populated_default_data();
		// Add Controls
		add_action( 'customize_register', [ $this, 'register_header_controls' ] );
	}

	public function register_header_controls( $wp_customize ) {
		// Header Style
		$wp_customize->add_setting( 'header_style',
			[
				'default'           => $this->defaults['header_style'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_radio_sanitization',
			]
		);
		$wp_customize->add_control( new Image_Radio( $wp_customize, 'header_style',
			[
				'label'       => esc_html__( 'Header Layout', 'radius-directory' ),
				'description' => esc_html__( 'Select the header style', 'radius-directory' ),
				'section'     => 'header_main_section',
				'choices'     => Helper::get_header_list( 'header' ),
			]
		) );

		//Menu Alignment
		$wp_customize->add_setting( 'menu_alignment', [
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'rttheme_text_sanitization',
			'default'           => $this->defaults['menu_alignment'],
		] );

		$wp_customize->add_control( 'menu_alignment', [
			'type'    => 'select',
			'section' => 'header_main_section', // Add a default or your own section
			'label'   => esc_html__( 'Menu Alignment', 'radius-directory' ),
			'choices' => [
				'menu-left'   => esc_html__( 'Left Alignment', 'radius-directory' ),
				'menu-center' => esc_html__( 'Center Alignment', 'radius-directory' ),
				'menu-right'  => esc_html__( 'Right Alignment', 'radius-directory' ),
			],
		] );

		//Header width
		$wp_customize->add_setting( 'header_width', [
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'rttheme_text_sanitization',
			'default'           => $this->defaults['header_width'],
		] );

		$wp_customize->add_control( 'header_width', [
			'type'    => 'select',
			'section' => 'header_main_section', // Add a default or your own section
			'label'   => esc_html__( 'Header Width', 'radius-directory' ),
			'choices' => [
				'box-width' => esc_html__( 'Box width', 'radius-directory' ),
				'fullwidth' => esc_html__( 'Fullwidth', 'radius-directory' ),
			],
		] );

		// Top bar
		$wp_customize->add_setting( 'top_bar',
			[
				'default'           => $this->defaults['top_bar'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_switch_sanitization',
			]
		);
		$wp_customize->add_control( new Switcher( $wp_customize, 'top_bar',
			[
				'label'   => esc_html__( 'Top Bar', 'radius-directory' ),
				'section' => 'header_main_section',
			]
		) );

		// Sticky Header Control
		$wp_customize->add_setting( 'sticky_header',
			[
				'default'           => $this->defaults['sticky_header'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_switch_sanitization',
			]
		);
		$wp_customize->add_control( new Switcher( $wp_customize, 'sticky_header',
			[
				'label'       => esc_html__( 'Sticky Header', 'radius-directory' ),
				'description' => esc_html__( 'Show header at the top when scrolling down', 'radius-directory' ),
				'section'     => 'header_main_section',
			]
		) );

		// Transparent Header
		$wp_customize->add_setting( 'tr_header',
			[
				'default'           => $this->defaults['tr_header'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_switch_sanitization',
			]
		);
		$wp_customize->add_control( new Switcher( $wp_customize, 'tr_header',
			[
				'label'       => esc_html__( 'Transparent Header', 'radius-directory' ),
				'description' => esc_html__( 'You have to enable Banner or Slider in page to make it work properly', 'radius-directory' ),
				'section'     => 'header_main_section',
			]
		) );

		// Transparent Header BG Color
		$wp_customize->add_setting( 'header_transparent_color',
			[
				'default'           => $this->defaults['header_transparent_color'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_text_sanitization',
			]
		);
		$wp_customize->add_control( new Color( $wp_customize, 'header_transparent_color',
			[
				'label'           => esc_html__( 'Transparent Background Color', 'radius-directory' ),
				'section'         => 'header_main_section',
				'active_callback' => [ '\RadiusTheme\RadiusDirectory\Helper', 'is_trheader_enable' ],
			]
		) );

		// Button Control
		$wp_customize->add_setting( 'header_btn',
			[
				'default'           => $this->defaults['header_btn'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_switch_sanitization',
			]
		);
		$wp_customize->add_control( new Switcher( $wp_customize, 'header_btn',
			[
				'label'   => esc_html__( 'Header Right Button', 'radius-directory' ),
				'section' => 'header_main_section',
			]
		) );

		// Button Text
		$wp_customize->add_setting( 'header_btn_txt',
			[
				'default'           => $this->defaults['header_btn_txt'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_text_sanitization',
			]
		);
		$wp_customize->add_control( 'header_btn_txt',
			[
				'label'           => esc_html__( 'Button Text', 'radius-directory' ),
				'section'         => 'header_main_section',
				'type'            => 'text',
				'active_callback' => [ '\RadiusTheme\RadiusDirectory\Helper', 'is_header_btn_enabled' ],
			]
		);
		// Button URL
		$wp_customize->add_setting( 'header_btn_url',
			[
				'default'           => $this->defaults['header_btn_url'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_url_sanitization',
			]
		);
		$wp_customize->add_control( 'header_btn_url',
			[
				'label'           => esc_html__( 'Button Link', 'radius-directory' ),
				'section'         => 'header_main_section',
				'type'            => 'url',
				'active_callback' => [ '\RadiusTheme\RadiusDirectory\Helper', 'is_header_btn_enabled' ],
			]
		);

		// Header Login Icon Visibility
		$wp_customize->add_setting( 'header_login_icon',
			[
				'default'           => $this->defaults['header_login_icon'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_switch_sanitization',
			]
		);
		$wp_customize->add_control( new Switcher( $wp_customize, 'header_login_icon',
			[
				'label'   => esc_html__( 'Header Login Icon Visibility', 'radius-directory' ),
				'section' => 'header_main_section',
			]
		) );

		// Header Chat Icon
		$wp_customize->add_setting( 'header_chat_icon',
			[
				'default'           => $this->defaults['header_chat_icon'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_switch_sanitization',
			]
		);
		$wp_customize->add_control( new Switcher( $wp_customize, 'header_chat_icon',
			[
				'label'   => esc_html__( 'Header Chat Icon Visibility', 'radius-directory' ),
				'section' => 'header_main_section',
			]
		) );

		// Breadcrumb
		$wp_customize->add_setting( 'breadcrumb',
			[
				'default'           => $this->defaults['breadcrumb'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_switch_sanitization',
			]
		);
		$wp_customize->add_control( new Switcher( $wp_customize, 'breadcrumb',
			[
				'label'   => esc_html__( 'Breadcrumb Visibility', 'radius-directory' ),
				'section' => 'header_main_section',
			]
		) );

	}
}