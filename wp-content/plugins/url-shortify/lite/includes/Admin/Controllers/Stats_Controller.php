<?php


namespace Kaizen_Coders\Url_Shortify\Admin\Controllers;


class Stats_Controller extends Base_Controller {

	public function __construct() {

		parent::__construct();
	}

	public function get_clicks_data( $start_date = '', $end_date = '',  $link_id = null ) {

		$clicks_data = US()->db->clicks->get_data_by_day('2020-06-01', '2020-06-14');

	}

}