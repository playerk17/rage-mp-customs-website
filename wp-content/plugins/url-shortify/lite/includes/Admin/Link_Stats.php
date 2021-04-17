<?php

namespace Kaizen_Coders\Url_Shortify\Admin;

use Kaizen_Coders\Url_Shortify\Admin\DB\Links;
use Kaizen_Coders\Url_Shortify\Helper;

class Link_Stats {
	/**
	 * Link ID
	 *
	 * @var null
	 *
	 * @since 1.0.4
	 */
	public $link_id = null;

	/**
	 * Links db object
	 *
	 * @var Links|null
	 *
	 * @since 1.0.4
	 */
	public $db = null;

	/**
	 * Link_Stats constructor.
	 *
	 * @param null $link_id
	 *
	 * @since 1.0.4
	 */
	public function __construct( $link_id = null ) {

		$this->link_id = $link_id;

		$this->db = new Links();

	}

	/**
	 * Render Link stats page
	 *
	 * @since 1.0.4
	 */
	public function render() {

		$data = $this->prepare_data();

		$data['icon_url'] = "https://www.google.com/s2/favicons?domain={$data['url']}";

		$data['short_url'] = Helper::get_short_link( $data['slug'] );

		include "templates/link-stats.php";
	}

	/**
	 * Prepare data for report
	 *
	 * @return array|object|void|null
	 *
	 * @since 1.0.4
	 */
	public function prepare_data() {

		$data = $this->db->get_by_id( $this->link_id );

		// Click History for last 7 days
		$days = apply_filters( 'click_history_for_days', 7 );

		$clicks_data = $this->get_clicks_data( $this->link_id, $days );

		$data['reports']['clicks'] = $clicks_data;

		return $data;
	}

	/**
	 * Get Clcks data
	 *
	 * @param int $link_id
	 * @param int $days
	 *
	 * @return array
	 *
	 * @since 1.0.4
	 */
	public function get_clicks_data( $link_id = 0, $days = 7 ) {
		return US()->db->clicks->get_data_by_link_id( $link_id, $days );
	}

}
