<?php

namespace RadiusTheme\RadiusDirectory\Customizer;

use RadiusTheme\RadiusDirectory\Customizer\Settings\Blog;
use RadiusTheme\RadiusDirectory\Customizer\Settings\Blog_Layout;
use RadiusTheme\RadiusDirectory\Customizer\Settings\Color;
use RadiusTheme\RadiusDirectory\Customizer\Settings\Contact_Info;
use RadiusTheme\RadiusDirectory\Customizer\Settings\Error;
use RadiusTheme\RadiusDirectory\Customizer\Settings\Error_Layout;
use RadiusTheme\RadiusDirectory\Customizer\Settings\General;
use RadiusTheme\RadiusDirectory\Customizer\Settings\Header;
use RadiusTheme\RadiusDirectory\Customizer\Settings\Footer;
use RadiusTheme\RadiusDirectory\Customizer\Settings\Listing_Archive_Layout;
use RadiusTheme\RadiusDirectory\Customizer\Settings\Listing_Single_Layout;
use RadiusTheme\RadiusDirectory\Customizer\Settings\Listings;
use RadiusTheme\RadiusDirectory\Customizer\Settings\Page_Layout;
use RadiusTheme\RadiusDirectory\Customizer\Settings\Post;
use RadiusTheme\RadiusDirectory\Customizer\Settings\Post_Layout;
use RadiusTheme\RadiusDirectory\Customizer\Typography\Typography;

class Init {
	protected static $instance = null;

	/**
	 * Create an inaccessible constructor.
	 */
	private function __construct() {
		$this->includes();
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function includes() {
		new General();
		new Header();
		new Footer();
		new Blog();
		new Post();
		new Error();
		new Contact_Info();
		new Typography();
		new Color();
		// Layout
		new Blog_Layout();
		new Post_Layout();
		new Page_Layout();
		new Error_Layout();
		// Listings
		if ( class_exists( 'Rtcl' ) ) {
			new Listings();
			new Listing_Archive_Layout();
			new Listing_Single_Layout();
		}
	}
}