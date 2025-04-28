<?php
/**
 * @author        RadiusTheme
 * @package       classified-listing/templates
 * @version       1.0.0
 *
 * @var Listing $listing
 */

use Rtcl\Models\Listing;

?>
<?php do_action( 'rtcl_before_user_info', $listing ); ?>
<div class="rtcl-listing-user-info">
    <div class="rtcl-listing-side-title">
        <h3><?php esc_html_e( "Information", 'radius-directory' ); ?></h3>
    </div>
    <div class="rtcl-list-group">
		<?php do_action( 'rtcl_listing_seller_information', $listing ); ?>
    </div>
</div>
<?php do_action( 'rtcl_after_user_info', $listing ); ?>
<!-- Social Profile  -->
<?php do_action( 'rtcl_single_listing_social_profiles' ) ?>
