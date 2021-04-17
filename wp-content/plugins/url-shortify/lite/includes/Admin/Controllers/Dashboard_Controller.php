<?php


namespace Kaizen_Coders\Url_Shortify\Admin\Controllers;


class Dashboard_Controller extends Base_Controller {

	public function __construct() {

		parent::__construct();
	}

	/**
	 * Render dashboard
	 *
	 * @since 1.1.5
	 */
	public function render() {

		$total_links = US()->db->links->count();

		$show_kpis = false;
		if ( $total_links > 0 ) {


			$total_groups  = US()->db->groups->count();
			$total_clicks  = US()->db->clicks->count();
			$unique_clicks = US()->db->clicks->get_total_unique_clicks();

			$links_url  = admin_url( 'admin.php?page=us_links' );
			$groups_url = admin_url( 'admin.php?page=us_groups' );

			$template_data = [
				'kpis' => [
					'total_links' => [
						'title' => __( 'Total Links', 'url-shortify' ),
						'count' => $total_links,
						'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>',
						'url'   => $links_url
					],

					'total_groups' => [
						'title' => __( 'Total Groups', 'url-shortify' ),
						'count' => $total_groups,
						'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>',
						'url'   => $groups_url
					],

					'total_clicks' => [
						'title' => __( 'Total Clicks', 'url-shortify' ),
						'count' => $total_clicks,
						'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path>',
						'url'   => ''
					],

					'unique_clicks' => [
						'title' => __( 'Unique Clicks', 'url-shortify' ),
						'count' => $unique_clicks,
						'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path>',
						'url'   => ''
					],
				]
			];


			$data = $this->prepare_data();

			$template_data['reports'] = $data['reports'];

			/*
			$click_report = $this->prepare_data_for_click_report();
			$template_data['click_data_for_graph'] = $click_report;
			*/

			$show_kpis = true;
		}

		$template_data['show_kpis']     = $show_kpis;
		$template_data['new_link_url']  = admin_url( 'admin.php?page=us_links&action=new' );
		$template_data['new_group_url'] = admin_url( 'admin.php?page=us_groups&action=new' );

		include_once KC_US_ADMIN_TEMPLATES_DIR . '/dashboard.php';
	}

	/**
	 * Prepare data for report
	 *
	 * @return array|object|void|null
	 *
	 * @since 1.1.5
	 */
	public function prepare_data() {

		// Click History for last 7 days
		$days = apply_filters( 'click_history_for_days', 3 );

		$clicks_data = $this->get_clicks_data( $days );

		$data['reports']['clicks'] = $clicks_data;

		return $data;
	}

	/**
	 * Get Clcks data
	 *
	 * @param int $days
	 *
	 * @return array
	 *
	 * @since 1.1.5
	 */
	public function get_clicks_data( $days = 7 ) {
		return US()->db->clicks->get_click_history( $days );
	}

	public function prepare_data_for_click_report() {

		$result = US()->db->clicks->get_data_by_day();

		return $result;
	}


}