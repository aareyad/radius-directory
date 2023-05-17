<?php
/**
 * @author  RadiusTheme
 * @since   1.0.0
 * @version 1.0.0
 */

use RadiusTheme\RadiusDirectory\Helper;
use RadiusTheme\RadiusDirectory\Options;

?>
<?php if ( Options::$has_banner_search ): ?>
    <section class="banner-search">
        <div class="container">
            <div class="rtcl cl-classified-listing-search">
				<?php Helper::get_custom_listing_template( 'listing-search' ); ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
if ( Options::$has_breadcrumb ):
	do_action( 'radius_directory_breadcrumb' );
endif;