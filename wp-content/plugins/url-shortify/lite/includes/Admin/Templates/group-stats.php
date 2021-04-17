<?php

use Kaizen_Coders\Url_Shortify\Admin\Controllers\ClicksController;
use Kaizen_Coders\Url_Shortify\Admin\Controllers\LinksTableController;
use Kaizen_Coders\Url_Shortify\Helper;
use Kaizen_Coders\Url_Shortify\Common\Utils;

$page_refresh_url = Utils::get_current_page_refresh_url();

$reports     = Helper::get_data( $data, 'reports', array() );
$clicks_data = Helper::get_data( $reports, 'clicks', array() );

$click_data_for_graph = Helper::get_data( $data, 'click_data_for_graph', array() );

$labels       = $values = '';
$total_clicks = 0;
if ( ! empty( $click_data_for_graph ) ) {
	$labels = json_encode( array_keys( $click_data_for_graph ) );

	$clicks = array_values( $click_data_for_graph );

	$total_clicks = array_sum( $clicks );

	$values = json_encode( $clicks );
}

$last_updated_on = Helper::get_data( $data, 'last_updated_on', time() );

$elapsed_time = Utils::get_elapsed_time( $last_updated_on );


$columns = array(
	'ip'         => array( 'title' => __( 'IP', 'url-shortify' ) ),
	'uri'        => array( 'title' => __( 'URI', 'url-shortify' ) ),
	'link'       => array( 'title' => __( 'Link', 'url-shortify' ) ),
	'host'       => array( 'title' => __( 'Host', 'url-shortify' ) ),
	'referrer'   => array( 'title' => __( 'Referrer', 'url-shortify' ) ),
	'clicked_on' => array( 'title' => __( 'Clicked On', 'url-shortify' ) ),
	'info'       => array( 'title' => __( 'Info', 'url-shortify' ) ),
);

$click_history = new ClicksController();
$click_history->set_columns( $columns );

$links = Helper::get_data( $data, 'links', array() );

$links_columns = array(
	'name'       => array( 'title' => __( 'Title', 'url-shortify' ) ),
	'clicks'     => array( 'title' => __( 'Clicks', 'url-shortify' ) ),
	'created_at' => array( 'title' => __( 'Created On', 'url-shortify' ) ),
	'link'       => array( 'title' => __( 'Link', 'url-shortify' ) )
);

$links_table_controller = new LinksTableController();
$links_table_controller->set_columns( $links_columns );

?>

<div class="wrap">
	<div class="font-sans bg-grey-lighter flex flex-col min-h-screen w-full">

        <!-- Upgrade Banner -->
		<?php if ( ! US()->is_pro() ) { ?>
            <div class="relative bg-red-500 mb-4">
                <div class="max-w-7xl mx-auto py-3 px-3 sm:px-6 lg:px-8">
                    <div class="pr-16 sm:text-center sm:px-16">
                        <p class="font-medium text-white">
                            <span class="hidden md:inline">
                                <?php _e('Your plugin plan is limited to 1 week of historical data. Upgrade your plan to see all historical data', 'url-shortify'); ?>
                            </span>
                            <span class="block sm:ml-2 sm:inline-block">
                                <a href="<?php echo esc_url( US()->get_pricing_url() ); ?>" class="flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-500 hover:bg-indigo-50"><?php _e('Upgrade Now', 'url-shortify'); ?><span aria-hidden="true">&nbsp;&rarr;</span></a>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
		<?php } ?>

		<div class="w-full border-b border-gray-300 pb-5">
			<div class="md:block mt-3">
				<div class="container mx-auto">
					<div class="md:flex">
						<div class="flex inline -mb-px mr-8 w-9/12">
							<span class="flex">
								<strong class="text-2xl">
									 <?php echo stripslashes( $data['name'] ); ?>
								</strong>
							</span>
						</div>
						<div class="w-3/12">
							<span class="rounded-md shadow-sm float-right">
								<button type="button" class="kc-us-primary-button w-full bg-green-500 hover:bg-green-400 text-white" title="<?php echo sprintf(__('Last Updated On: %s', 'url-shortify'), $elapsed_time ); ?>">
									<a href="<?php echo $page_refresh_url; ?>" class="text-white hover:text-white"><?php _e('Refresh', 'url-shortify'); ?></a>
								</button>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Click History Report -->
		<div class="mt-5">
			<div class="grid grid-cols-1">
				<div class="mt-2 flex w-full border-b-2 border-gray-100">
					<div class="w-9/12">
						<span class="text-xl leading-6 font-medium text-gray-900"><?php _e( 'Clicks History', 'url-shortify' ); ?></span>
						<p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500 mb-2"><?php echo sprintf( __( '%d Total Clicks', 'url-shortify' ), $total_clicks ); ?></p>
					</div>
				</div>
				<div class="bg-white mt-2" id="click-chart">

				</div>
			</div>
		</div>

		<!-- Country & Referrer Info -->
		<div class="mt-6">
			<div class="grid md:grid-cols-2 md:grid-cols-2 sm:grid-cols-1 gap-4">
				<!-- Country Info -->
				<div class="overflow-hidden  rounded-lg">

					<div class="mb-4">
						<span class="text-xl leading-6 font-medium text-gray-900"><?php _e( 'Top Locations', 'url-shortify' ); ?></span>
					</div>

					<div class="bg-white border-2">
						<?php 
						if ( US()->is_pro() ) {
							do_action( 'kc_us_render_country_info', $data );
						} else { 
							?>
							<div class="w-full h-64 p-10 bg-green-50">
								<div class="">
									<div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100">
										<svg class="h-12 w-12 text-green-600" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
											<path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
										</svg>
									</div>
									<div class="mt-3 text-center sm:mt-5">
										<h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
											<?php echo sprintf( __( '<a href="%s">Upgrade Now</a>', 'url-shortify' ), US()->get_pricing_url() ); ?>
										</h3>
										<div class="mt-2">
											<p class="text-sm leading-5 text-gray-500">
												<?php _e( 'Get insights about top locations from where people are clicking on your links.', 'url-shortify' ); ?>
											</p>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>

				<!-- Referrer Info -->
				<div class="overflow-hidden rounded-lg h-px-400">
					<div class="mb-4">
						<span class="text-xl leading-6 font-medium text-gray-900"><?php _e( 'Referrers', 'url-shortify' ); ?></span>
					</div>
					<div class="bg-white border-2" id="">
						<?php 
						if ( US()->is_pro() ) {
							do_action( 'kc_us_render_referrer_info', $data );
						} else { 
							?>
							<div class="w-full h-64 p-10 bg-green-50">
								<div class="">
									<div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100">
										<svg class="h-12 w-12 text-green-600" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
											<path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
										</svg>
									</div>
									<div class="mt-3 text-center sm:mt-5">
										<h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
											<?php echo sprintf( __( '<a href="%s">Upgrade Now</a>', 'url-shortify' ), US()->get_pricing_url() ); ?>
										</h3>
										<div class="mt-2">
											<p class="text-sm leading-5 text-gray-500">
												<?php _e( 'Know who are your top referrers.', 'url-shortify' ); ?>
											</p>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>

		<!-- Device Info, Browser Info & Platforms Info -->
		<div class="mt-6">
			<div class="grid md:grid-cols-3 sm:grid-cols-1 gap-4">

				<!-- Device Info -->
				<div class="overflow-hidden rounded-lg h-px-400">
					<div class="mb-4">
						<span class="text-xl leading-6 font-medium text-gray-900"><?php _e( 'Top Devices', 'url-shortify' ); ?></span>
					</div>
					<?php 
					if ( US()->is_pro() ) {
						do_action( 'kc_us_render_device_info', $data );
					} else { 
						?>
						<div class="w-full h-64 p-10 bg-green-50">
							<div class="">
								<div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100">
									<svg class="h-12 w-12 text-green-600" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
										<path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
									</svg>
								</div>
								<div class="mt-3 text-center sm:mt-5">
									<h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
										<?php echo sprintf( __( '<a href="%s">Upgrade Now</a>', 'url-shortify' ), US()->get_pricing_url() ); ?>
									</h3>
									<div class="mt-2">
										<p class="text-sm leading-5 text-gray-500">
											<?php _e( 'Want to know which devices were used to access your links?', 'url-shortify' ); ?>
										</p>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>

				<!-- Browser Info -->
				<div class="overflow-hidden rounded-lg h-px-400">
					<div class="mb-4">
						<span class="text-xl leading-6 font-medium text-gray-900"><?php _e( 'Top Browsers', 'url-shortify' ); ?></span>
					</div>
					<?php 
					if ( US()->is_pro() ) {
						do_action( 'kc_us_render_browser_info', $data );
					} else { 
						?>
						<div class="w-full h-64 p-10 bg-green-50">
							<div class="">
								<div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100">
									<svg class="h-12 w-12 text-green-600" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
										<path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
									</svg>
								</div>
								<div class="mt-3 text-center sm:mt-5">
									<h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
										<?php echo sprintf( __( '<a href="%s">Upgrade Now</a>', 'url-shortify' ), US()->get_pricing_url() ); ?>
									</h3>
									<div class="mt-2">
										<p class="text-sm leading-5 text-gray-500">
											<?php _e( 'Get information about browsers.', 'url-shortify' ); ?>
										</p>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>


				<!-- OS Info -->
				<div class="overflow-hidden rounded-lg h-px-400">
					<div class="mb-4">
						<span class="text-xl leading-6 font-medium text-gray-900"><?php _e( 'Top Platforms', 'url-shortify' ); ?></span>
					</div>
					<?php 
					if ( US()->is_pro() ) {
						do_action( 'kc_us_render_os_info', $data );
					} else { 
						?>
						<div class="w-full h-64 p-10 bg-green-50">
							<div class="">
								<div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100">
									<svg class="h-12 w-12 text-green-600" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
										<path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
									</svg>
								</div>
								<div class="mt-3 text-center sm:mt-5">
									<h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
										<?php echo sprintf( __( '<a href="%s">Upgrade Now</a>', 'url-shortify' ), US()->get_pricing_url() ); ?>
									</h3>
									<div class="mt-2">
										<p class="text-sm leading-5 text-gray-500">
											<?php _e( 'Know more about which devices people used to access your links.', 'url-shortify' ); ?>
										</p>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>

		<!-- Links Details -->
		<div class="mt-6 flex w-full">
			<div class="w-8/12">
				<span class="text-xl leading-6 font-medium text-gray-900"><?php _e( 'Links Info', 'url-shortify' ); ?></span>
			</div>
		</div>

		<div class="bg-white flex-grow container mx-auto sm:px-4 mt-4 pt-6 pb-8">

			<div>
				<table id="links-data" class="display" style="width:100%">
					<thead>
					<?php $links_table_controller->render_header(); ?>
					</thead>
					<tbody>
					<?php 
					foreach ( $links as $link ) {
						$links_table_controller->render_row( $link );
					} 
					?>
					</tbody>
					<tfoot>
					<?php $links_table_controller->render_footer(); ?>
					</tfoot>
				</table>
			</div>
		</div>

		<!-- Click Info -->
		<div class="mt-10 flex w-full">
			<div class="w-8/12">
				<span class="text-xl leading-6 font-medium text-gray-900"><?php _e( 'Clicks Details', 'url-shortify' ); ?></span>
			</div>
		</div>
		<div class="bg-white flex-grow container mx-auto sm:px-4 mt-4 pt-6 pb-8">

			<div>
				<table id="clicks-data" class="display" style="width:100%">
					<thead>
					<?php $click_history->render_header(); ?>
					</thead>
					<tbody>
					<?php 
					foreach ( $clicks_data as $click ) {
						$click_history->render_row( $click );
					} 
					?>
					</tbody>
					<tfoot>
					<?php $click_history->render_footer(); ?>
					</tfoot>
				</table>
			</div>
		</div>

	</div>

</div>

<script type="text/javascript">

	(function ($) {

		$(document).ready(function () {

			var labels = 
			<?php 
			if ( ! empty( $labels ) ) {
				echo $labels;
			} else {
				echo "''";
			} 
			?>
			;

			var values = 
			<?php 
			if ( ! empty( $values ) ) {
				echo $values;
			} else {
				echo "''";
			} 
			?>
			;

			if (labels != '' && values != '') {
				const data = {
					labels: labels,
					datasets: [
						{
							values: values
						},
					]
				};

				const chart = new frappe.Chart("#click-chart", {
					title: "",
					data: data,
					type: 'axis-mixed',
					colors: ['#5850ec'],
					lineOptions: {
						hideDots: 1,
						regionFill: 1
					},
					height: 250,
					axisOptions: {
						xIsSeries: true
					}
				});
			}

		});

	})(jQuery);

</script>
