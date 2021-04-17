<style type="text/css">
    .kc_us_offer {
        width: 55%;
        margin: 0 auto;
        text-align: center;
        padding-top: 1.2em;
    }

</style>
<?php

$timezone_format = _x( 'Y-m-d', 'timezone date format' );
$current_date = strtotime( date_i18n( $timezone_format ) );

// Halloween 2020 Campaign
if ( ( get_option( 'kc_us_offer_halloween_2020_dismissed' ) !== 'yes' ) && ( $current_date >= strtotime( "2020-10-27" ) ) && ( $current_date <= strtotime( "2020-11-02" ) ) ) { ?>
	<div class="kc_us_offer">
		<a target="_blank" href="?kc_us_dismiss_admin_notice=1&option_name=offer_halloween_2020"><img src="<?php echo KC_US_PLUGIN_ASSETS_DIR_URL; ?>/images/promo/halloween.png"/></a>
	</div>
<?php } ?>