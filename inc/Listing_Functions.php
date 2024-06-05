<?php
/**
 * @author  RadiusTheme
 * @since   1.0.0
 * @version 1.0.0
 */

namespace RadiusTheme\RadiusDirectory;

use Rtcl\Controllers\Hooks\TemplateHooks;
use Rtcl\Helpers\Functions;
use Rtcl\Helpers\Link;
use Rtcl\Helpers\Text;
use Rtcl\Models\Listing;
use RtclPro\Helpers\Fns;
use RtclStore\Controllers\Hooks\TemplateHooks as StoreHooks;
use RtclPro\Controllers\Hooks\TemplateHooks as ProHooks;

class Listing_Functions {

	protected static $instance = null;

	public function __construct() {
		add_action( 'after_setup_theme', [ $this, 'theme_support' ] );
		add_action( 'wp', [ $this, 'rtcl_action_hook' ], 99 );
		add_action( 'init', [ $this, 'rtcl_filter_hook' ] );
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function theme_support() {
		add_theme_support( 'rtcl' );
	}

	public function rtcl_action_hook() {
		if ( isset( $_GET['view'] ) && in_array( $_GET['view'], [ 'grid', 'list' ] ) ) {
			$view = sanitize_text_field( $_GET['view'] );
		} else {
			$view = Functions::get_option_item( 'rtcl_general_settings', 'default_view', 'list' );
		}
		// remove action
		remove_action( 'rtcl_before_main_content', [ TemplateHooks::class, 'breadcrumb' ], 6 );
		remove_action( 'rtcl_listing_loop_item', [ TemplateHooks::class, 'loop_item_excerpt' ], 70 );
		remove_action( 'rtcl_single_listing_content', [ TemplateHooks::class, 'add_single_listing_gallery' ], 30 );
		remove_action( 'rtcl_single_listing_inner_sidebar', [
			TemplateHooks::class,
			'add_single_listing_inner_sidebar_custom_field'
		], 10 );
		remove_action( 'rtcl_single_listing_inner_sidebar', [
			TemplateHooks::class,
			'add_single_listing_inner_sidebar_action'
		], 20 );
		if ( class_exists( 'RtclStore' ) ) {
			remove_action( 'rtcl_single_store_information', [ StoreHooks::class, 'store_social_media' ], 40 );
			add_action( 'rtcl_single_store_information', [ StoreHooks::class, 'store_social_media' ], 60 );
		}
		remove_action( 'rtcl_listing_meta_buttons', [ TemplateHooks::class, 'add_favourite_button' ], 10 );
		remove_action( 'rtcl_listing_meta_buttons', [ ProHooks::class, 'add_quick_view_button' ], 20 );
		remove_action( 'rtcl_listing_meta_buttons', [ ProHooks::class, 'add_compare_button' ], 30 );
		// add action
		add_action( 'rtcl_after_listing_thumbnail', [ __CLASS__, 'listing_category' ], 10 );
		if ( 'list' === $view ) {
			remove_action( 'rtcl_listing_loop_item', [ TemplateHooks::class, 'listing_price' ], 80 );
			add_action( 'rtcl_listing_loop_item', [ __CLASS__, 'loop_item_action_price' ], 80 );
			add_action( 'rtcl_listing_loop_item', [ TemplateHooks::class, 'loop_item_excerpt' ], 45 );
		} else if ( 'grid' === $view ) {
			add_action( 'rtcl_after_listing_thumbnail', [ __CLASS__, 'loop_item_action_button' ], 20 );
		}
		// Listing seller contact
		remove_action( 'rtcl_listing_seller_information', [ TemplateHooks::class, 'seller_email' ], 30 );
		remove_action( 'rtcl_listing_seller_information', [ TemplateHooks::class, 'seller_website' ], 50 );
		add_action( 'rtcl_before_user_info', [ __CLASS__, 'seller_email' ], 10 );
		add_action( 'rtcl_before_user_info', [ TemplateHooks::class, 'seller_website' ], 30 );
		if ( class_exists( 'RtclPro' ) ) {
			remove_action( 'rtcl_listing_seller_information', [ ProHooks::class, 'add_chat_link' ], 40 );
			add_action( 'rtcl_before_user_info', [ ProHooks::class, 'add_chat_link' ], 20 );
		}
	}

	public function rtcl_filter_hook() {
		add_filter( 'rtcl_listings_shortcode_show_top_listings', '__return_false' );
		add_filter( 'rtcl_bootstrap_dequeue', '__return_false' );
		add_filter( 'rtcl_listing_the_excerpt', function ( $excerpt ) {
			return wp_trim_words( $excerpt, 12 );
		} );
		// Override Related Listing Item Number
		add_filter( 'rtcl_related_slider_options', function ( $slider_options ) {
			$slider_options = [
				"loop"         => false,
				"autoplay"     => [
					"delay"                => 3000,
					"disableOnInteraction" => false,
					"pauseOnMouseEnter"    => true
				],
				"speed"        => 1000,
				"spaceBetween" => 20,
				"breakpoints"  => [
					0    => [
						"slidesPerView" => 1
					],
					500  => [
						"slidesPerView" => 2
					],
					1200 => [
						"slidesPerView" => 3
					]
				]
			];

			return $slider_options;
		} );
	}

	public static function loop_item_action_price() {
		global $listing;
		?>
        <div class="listing-action-price">
			<?php Functions::get_template( 'listing/loop/price' ); ?>
            <div class="listing-meta-action">
				<?php if ( Functions::is_enable_favourite() ) { ?>
                    <div class="rtcl-btn"
                         data-tooltip="<?php esc_attr_e( "Add to favourite", "radius-directory" ) ?>"
                         data-listing_id="<?php echo absint( $listing->get_id() ) ?>">
						<?php echo Functions::get_favourites_link( $listing->get_id() ) ?>
                    </div>
				<?php } ?>
				<?php if ( class_exists( 'RtclPro' ) && Fns::is_enable_quick_view() ) { ?>
                    <div class="rtcl-quick-view rtcl-btn" data-tooltip="<?php esc_html_e( "Quick view", "radius-directory" ) ?>"
                         data-listing_id="<?php echo absint( $listing->get_id() ) ?>">
                        <i class="rtcl-icon rtcl-icon-zoom-in"></i>
                    </div>
				<?php } ?>
				<?php if ( class_exists( 'RtclPro' ) && Fns::is_enable_compare() ) {
					if ( empty( rtcl()->session ) ) {
						rtcl()->initialize_session();
					}
					$compare_ids    = rtcl()->session->get( 'rtcl_compare_ids', [] );
					$selected_class = '';
					if ( is_array( $compare_ids ) && in_array( $listing->get_id(), $compare_ids ) ) {
						$selected_class = ' selected';
					}
					?>
                    <div class="rtcl-compare rtcl-btn<?php echo esc_attr( $selected_class ); ?>"
                         data-tooltip="<?php esc_html_e( "Add to compare list", "radius-directory" ) ?>"
                         data-listing_id="<?php echo absint( $listing->get_id() ) ?>">
                        <i class="rtcl-icon rtcl-icon-exchange"></i>
                    </div>
				<?php } ?>
            </div>
        </div>
		<?php
	}

	public static function loop_item_action_button() {
		global $listing;
		?>
        <div class="rtcl-meta-buttons">
			<?php if ( Functions::is_enable_favourite() ) { ?>
                <div class="rtcl-btn"
                     data-tooltip="<?php esc_attr_e( "Add to favourite", "radius-directory" ) ?>"
                     data-listing_id="<?php echo absint( $listing->get_id() ) ?>">
					<?php echo Functions::get_favourites_link( $listing->get_id() ) ?>
                </div>
			<?php } ?>
			<?php if ( class_exists( 'RtclPro' ) && Fns::is_enable_quick_view() ) { ?>
                <div class="rtcl-quick-view rtcl-btn" data-tooltip="<?php esc_html_e( "Quick view", "radius-directory" ) ?>"
                     data-listing_id="<?php echo absint( $listing->get_id() ) ?>">
                    <i class="rtcl-icon rtcl-icon-zoom-in"></i>
                </div>
			<?php } ?>
			<?php if ( class_exists( 'RtclPro' ) && Fns::is_enable_compare() ) {
				if ( empty( rtcl()->session ) ) {
					rtcl()->initialize_session();
				}
				$compare_ids    = rtcl()->session->get( 'rtcl_compare_ids', [] );
				$selected_class = '';
				if ( is_array( $compare_ids ) && in_array( $listing->get_id(), $compare_ids ) ) {
					$selected_class = ' selected';
				}
				?>
                <div class="rtcl-compare rtcl-btn<?php echo esc_attr( $selected_class ); ?>"
                     data-tooltip="<?php esc_html_e( "Add to compare list", "radius-directory" ) ?>"
                     data-listing_id="<?php echo absint( $listing->get_id() ) ?>">
                    <i class="rtcl-icon rtcl-icon-exchange"></i>
                </div>
			<?php } ?>
        </div>
		<?php
	}

	public static function listing_category() {
		global $listing;
		if ( $listing->has_category() && $listing->can_show_category() ) {
			$category = $listing->get_categories();
			$category = end( $category );
			?>
            <div class="listing-category">
                <a class="listing-categories" href="<?php echo esc_url( get_term_link( $category ) ); ?>">
					<?php echo esc_html( $category->name ); ?>
                </a>
            </div>
			<?php
		}
	}

	public static function seller_email( $listing ) {
		if ( is_a( $listing, Listing::class ) && Functions::get_option_item( 'rtcl_moderation_settings', 'has_contact_form', false, 'checkbox' )
		     && $email = get_post_meta( $listing->get_id(), 'email', true )
		) {
			?>
            <div class="rtcl-listing-user-info contact-form">
                <div class='rtcl-do-email list-group-item'>
                    <div class='media'>
                        <span class='rtcl-icon rtcl-icon-mail mr-2'></span>
                        <div class='media-body'>
                            <a class="rtcl-do-email-link" href='#'>
                                <span><?php echo Text::get_single_listing_email_button_text(); ?></span>
                            </a>
                        </div>
                    </div>
					<?php $listing->email_to_seller_form(); ?>
                </div>
            </div>
			<?php
		}
	}

}