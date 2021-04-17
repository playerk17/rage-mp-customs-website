<style type="text/css">
    .kc_us_offer {
        width: 55%;
        margin: 0 auto;
        text-align: center;
        padding-top: 1.2em;
    }

</style>
<?php

// On the 3rd day of installation & more than 3 short links created
$installed_on = \Kaizen_Coders\Url_Shortify\Option::get('installed_on', time());
$total_links = US()->db->links->count();

$days_after_installation = (time() - $installed_on) / 86400;

// Welcome Campaign
if ( ( get_option( 'kc_us_welcome_offer_dismissed' ) !== 'yes' )  &&  $days_after_installation >= 10 && $days_after_installation <= 14 && $total_links >= 3 ) { ?>
	<div class="kc_us_offer">
		<a target="_blank" href="?kc_us_dismiss_admin_notice=1&option_name=welcome_offer"><img src="<?php echo KC_US_PLUGIN_ASSETS_DIR_URL; ?>/images/promo/welcome.png"/></a>
	</div>
<?php } ?>