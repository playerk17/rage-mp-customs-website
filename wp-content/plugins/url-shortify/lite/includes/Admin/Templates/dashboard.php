<?php

use Kaizen_Coders\Url_Shortify\Admin\Controllers\ClicksController;
use Kaizen_Coders\Url_Shortify\Common\Utils;
use Kaizen_Coders\Url_Shortify\Helper;

$page_refresh_url = Utils::get_current_page_refresh_url();

$last_updated_on = Helper::get_data( $data, 'last_updated_on', time() );

$elapsed_time = Utils::get_elapsed_time( $last_updated_on );

$show_kpis     = Helper::get_data( $data, 'show_kpis', false );
$new_link_url  = Helper::get_data( $data, 'new_link_url', '' );
$new_group_url = Helper::get_data( $data, 'new_group_url', '' );

if ( $show_kpis ) {

	$kpis = Helper::get_data( $data, 'kpis', array() );

	$clicks_data = $data['reports']['clicks'];

	$click_data_for_graph = $data['click_data_for_graph'];

	$labels = $values = '';
	if ( ! empty( $click_data_for_graph ) ) {
		$labels = json_encode( array_keys( $click_data_for_graph ) );

		$clicks = array_values( $click_data_for_graph );

		$total_clicks = array_sum( $clicks );

		$values = json_encode( $clicks );

	}

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

	?>

	<div class="wrap" id="">
		<header class="mx-auto max-w-7xl">
			<div class="md:flex md:items-center md:justify-between  border-b border-gray-300 pb-5">
				<div class="flex-1 min-w-0">
					<h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate">
						<?php _e( 'Dashboard', 'url-shortify' ); ?>
					</h2>
				</div>
				<div class="flex mt-4 md:mt-0 md:ml-4" x-data="dropdown()">
					<span class="rounded-md shadow-sm">
						<button type="button" class="kc-us-primary-button w-full bg-green-500 hover:bg-green-400 text-white" title="<?php echo sprintf(__('Last Updated On: %s', 'url-shortify'), $elapsed_time ); ?>">
							<a href="<?php echo $page_refresh_url; ?>" class="text-white hover:text-white"><?php _e('Refresh', 'url-shortify'); ?></a>
						</button>
					</span>
					<span class="ml-3 rounded-md shadow-sm">
						<div id="kc-us-create-button" class="relative inline-block text-left">
							<div>
							  <span class="rounded-md shadow-sm">
								<button type="button" class="w-full kc-us-primary-button" x-on:click="open">
								  <?php _e( 'Create', 'url-shortify' ); ?>
								  <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20">
									<path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
								  </svg>
								</button>
							  </span>
							</div>
							<div x-show="isOpen()" id="kc-us-create-dropdown" class="absolute right-0 hidden w-56 mt-2 origin-top-right rounded-md shadow-lg">
							  <div class="bg-white rounded-md shadow-xs">
								<div class="py-1">
								  <a href="<?php echo $new_link_url; ?>" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900"><?php _e( 'New Link', 'url-shortify' ); ?></a>
								  <a href="<?php echo $new_group_url; ?>" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900"><?php _e( 'New Group', 'url-shortify' ); ?></a>
								</div>
							  </div>
							</div>
						</div>
					</span>
				</div>
			</div>
		</header>

		<!-- KPI -->
		<div class="mt-5">
			<div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
				<?php foreach ( $kpis as $kpi ) { ?>
					<?php 
					if ( ! empty( $kpi['url'] ) ) {
						?>
						<a href="<?php echo $kpi['url']; ?>" target="_blank"> <?php } ?>
					<div class="bg-white overflow-hidden shadow rounded-lg">
						<div class="px-4 py-5 sm:p-6">
							<div class="flex items-center">
								<div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
									<svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
										<?php echo $kpi['icon']; ?>
									</svg>
								</div>
								<div class="ml-5 w-0 flex-1">
									<dl>
										<dt class="text-sm leading-5 font-medium text-gray-500 truncate">
											<?php echo $kpi['title']; ?>
										</dt>
										<dd class="flex items-baseline">
											<div class="text-2xl leading-8 font-semibold text-gray-900">
												<?php echo $kpi['count']; ?>
											</div>
										</dd>
									</dl>
								</div>
							</div>
						</div>
					</div>
					<?php 
					if ( ! empty( $kpi['url'] ) ) {
						?>
						 </a> <?php } ?>
				<?php } ?>
			</div>
		</div>
		<!-- KPI END -->

		<!-- Click History Report -->
		<div class="mt-4">
			<div class="mt-5 grid grid-cols-1">
				<div class="mt-2 flex w-full border-b-2 border-gray-100">
					<div class="w-9/12">
						<span class="text-xl leading-6 font-medium text-gray-900"><?php _e( 'Clicks History', 'url-shortify' ); ?></span>
						<?php 
						if ( ! US()->is_pro() ) {
							?>
							 <span class="pl-5 text-xl text-red-600">[<?php echo sprintf( __( 'Last %d days', 'url-shortify' ), 7 ); ?>]</span> <?php } ?>
						<p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500 mb-2"><?php echo sprintf( __( '%d Total Clicks', 'url-shortify' ), $total_clicks ); ?></p>
					</div>
					<?php if ( ! US()->is_pro() ) { ?>
						<div class="w-3/12">
							<div class="flex rounded">
								<div class="flex-shrink-0">
									<svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
										<svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
											<path d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
										</svg>
									</svg>
								</div>
								<div class="ml-3">
									<h3 class="text-sm leading-5 font-medium text-green-800">
										<?php echo sprintf( __( '<a href="%s">Unlock Full Click History</a>', 'url-shortify' ), US()->get_pricing_url() ); ?>
									</h3>
								</div>
							</div>
						</div>
					<?php } ?>
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

		<!-- Click History -->
		<div class="mt-6 flex w-full">
			<div class="w-8/12">
				<span class="text-xl leading-6 font-medium text-gray-900"><?php _e( 'Clicks Details', 'url-shortify' ); ?></span>
				<?php 
				if ( ! US()->is_pro() ) {
					?>
					 <span class="pl-5 text-xl text-red-600">[<?php echo sprintf( __( 'Last %d days', 'url-shortify' ), 3 ); ?>]</span> <?php } ?>
			</div>
			<?php if ( ! US()->is_pro() ) { ?>
				<div class="w-4/12">
					<div class="flex rounded">
						<div class="flex-shrink-0">
							<svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
								<svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
									<path d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
								</svg>
							</svg>
						</div>
						<div class="ml-3">
							<h3 class="text-sm leading-5 font-medium text-green-800">
								<?php echo sprintf( __( '<a href="%s">Upgrade to <b">PRO</b> & Unlock Full Click History</a>', 'url-shortify' ), US()->get_pricing_url() ); ?>
							</h3>
						</div>
					</div>
				</div>
			<?php } ?>
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


<?php } else { ?>
	<div class="wrap">
		<div id="" class="">
			<div class="relative overflow-hidden bg-gray-50">
				<div class="hidden sm:block sm:absolute sm:inset-y-0 sm:h-full sm:w-full">
					<div class="relative h-full max-w-screen-xl mx-auto">
						<svg class="absolute transform right-full translate-y-1/4 translate-x-1/4 lg:translate-x-1/2" width="404" height="784" fill="none" viewBox="0 0 404 784">
							<defs>
								<pattern id="f210dbf6-a58d-4871-961e-36d5016a0f49" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
									<rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor"/>
								</pattern>
							</defs>
							<rect width="404" height="784" fill="url(#f210dbf6-a58d-4871-961e-36d5016a0f49)"/>
						</svg>
						<svg class="absolute transform left-full -translate-y-3/4 -translate-x-1/4 md:-translate-y-1/2 lg:-translate-x-1/2" width="404" height="784" fill="none" viewBox="0 0 404 784">
							<defs>
								<pattern id="5d0dd344-b041-4d26-bec4-8d33ea57ec9b" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
									<rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor"/>
								</pattern>
							</defs>
							<rect width="404" height="784" fill="url(#5d0dd344-b041-4d26-bec4-8d33ea57ec9b)"/>
						</svg>
					</div>
				</div>

				<div class="relative pt-6 pb-12 sm:pb-16 md:pb-20 lg:pb-28 xl:pb-32">
					<div class="max-w-screen-xl px-4 mx-auto sm:px-6">
						<nav class="relative flex items-center justify-between sm:h-10 md:justify-center">
							<div class="flex items-center flex-1 md:absolute md:inset-y-0 md:left-0">
								<div class="flex items-center justify-between w-full md:w-auto">

									<div class="flex items-center -mr-2 md:hidden">
										<button type="button" class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
											<svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
											</svg>
										</button>
									</div>
								</div>
							</div>

							<div class="hidden md:absolute md:flex md:items-center md:justify-end md:inset-y-0 md:right-0">
		  <span class="inline-flex rounded-md shadow">
			<a href="https://wordpress.org/plugins/url-shortify" target="_blank" class="inline-flex items-center px-4 py-2 text-base font-medium leading-6 text-indigo-600 transition duration-150 ease-in-out bg-white border border-transparent rounded-md hover:text-indigo-500 focus:outline-none focus:shadow-outline-blue active:bg-gray-50 active:text-indigo-700">
			  <?php echo 'Version: ' . KC_US_PLUGIN_VERSION; ?>
			</a>
		  </span>
							</div>
						</nav>
					</div>


					<div class="absolute inset-x-0 top-0 p-2 transition origin-top-right transform md:hidden">
						<div class="rounded-lg shadow-md">
							<div class="overflow-hidden bg-white rounded-lg shadow-xs">
								<div class="flex items-center justify-between px-5 pt-4">

									<div class="-mr-2">
										<button type="button" class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
											<svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
											</svg>
										</button>
									</div>
								</div>

							</div>
						</div>
					</div>

					<div class="max-w-screen-xl px-4 mx-auto mt-10 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 xl:mt-28">
						<div class="text-center">
							<h2 class="text-4xl font-extrabold leading-10 tracking-tight text-gray-900 sm:text-5xl sm:leading-none md:text-6xl">
								Welcome to
								<br class="xl:hidden"/>
								<span class="text-indigo-600">URL Shortify</span>
							</h2>
							<p class="max-w-md mx-auto mt-3 text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
								<?php _e( 'Convert your long, ugly links into clean, memorable, shareable links', 'url-shortify' ); ?>
							</p>
							<div class="max-w-md mx-auto mt-5 sm:flex sm:justify-center md:mt-8">
								<div class="rounded-md shadow">
									<a href="<?php echo $new_link_url; ?>" class="flex items-center justify-center w-full px-8 py-3 text-base font-medium leading-6 text-white transition duration-150 ease-in-out bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-500 hover:text-white focus:outline-none focus:shadow-outline-indigo md:py-4 md:text-lg md:px-10">
										<?php _e( 'Get Started', 'url-shortify' ); ?>
									</a>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>


<?php } ?>


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
