<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( 'You are not allowed to call this page directly.' );
}

?>

<div class="wrap">
	<!-- Success/ Error Message -->
	<div id="kc-us-info-message" style="display: none;"></div>

	<!-- Link Form-->
	<div id="kc-us-create-link-form">

		<form id="kc-us-create-link" method="post">
			<table class="form-table">
				<tr class="form-field">
					<td valign="top"><?php esc_html_e( 'Target URL', 'url-shortify' ); ?></td>
					<td><input type="text" id="kc-us-target-url" name="url" value="">
				</tr>
				<tr>
					<td valign="top"><?php esc_html_e( 'Short URL', 'url-shortify' ); ?></td>
					<td><strong><?php echo esc_html( $blog_url ); ?></strong>/<input type="text" id="kc-us-slug" name="slug" value="<?php echo esc_attr( $slug ); ?>">
				</tr>
			</table>

			<span id="kc-us-dashboard-short-link">
		<input type="submit" name="Submit" value="<?php esc_attr_e( 'Create', 'url-shortify' ); ?>" class="button button-primary" id=""/>
		<p class="kc_us_loading" style="display: none;"><img height="24px" width="24px" src="<?php echo $loading_icon_url; ?>"></p>
		</span>
		</form>
	</div>
</div>
