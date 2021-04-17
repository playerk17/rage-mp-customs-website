<?php

namespace Kaizen_Coders\Url_Shortify\Admin\Controllers;

use Kaizen_Coders\Url_Shortify\Common\Utils;
use Kaizen_Coders\Url_Shortify\Helper;

class Click_History_Controller extends Base_Controller {
	/**
	 * @var array
	 *
	 * @since 1.1.5
	 */
	public $columns = [];

	/**
	 * Click_History_Controller constructor.
	 *
	 * @since 1.1.5
	 */
	public function __construct() {

		parent::__construct();
	}

	/**
	 * Set columns
	 *
	 * @param array $columns
	 *
	 * @since 1.1.5
	 */
	public function set_columns( $columns = [] ) {
		$this->columns = $columns;
	}

	/**
	 * Render columns
	 *
	 * @since 1.1.5
	 */
	public function render_columns() {
		echo "<tr>";
		foreach ( $this->columns as $key => $column ) {
			echo "<th>" . $column['title'] . "</th>";
		}
		echo "</tr>";
	}

	/**
	 * Render header
	 *
	 * @since 1.1.5
	 */
	public function render_header() {
		$this->render_columns();
	}

	/**
	 * Render IP column
	 *
	 * @param array $click
	 *
	 * @since 1.1.5
	 */
	public function column_ip( $click = [] ) {
		$country = $click['country'];

		$country_name = '';
		if ( $country ) {
			$country_name = Utils::get_country_name_from_iso_code( $country );
		}

		$td = '';

		$td .= "<td data-search='" . $country_name . "'>";

		$td .= "<span class='flex inline'>";
		$td .= "<p class='w-6 mr-3'>";
		if ( $country ) {

			$country_icon = Utils::get_country_icon_url( $click['country'] );

			if ( ! empty( $country_icon ) ) {
				$td .= "<img src='{$country_icon}' title='{$country_name}' alt='{$country_name}' class='h-6 w-6 mr-4'/>";
			}
		}

		$td .= "</p><p class='pt-1'>";
		$td .= $click['ip'];

		$td .= "</p></span>";

		$td .= "</td>";

		echo $td;

	}

	/**
	 * Render info column
	 *
	 * @param array $click
	 *
	 * @since 1.1.5
	 */
	public function column_info( $click = [] ) {

		$device = $click['device'];

		$browser = $click['browser_type'];

		$td = '';

		$td .= "<td data-search='" . $device . "|" . $browser . "'";

		$td .= "<span class='flex inline'>";

		$device_icon = Utils::get_device_icon_url( $device );

		$td .= "<img src='{$device_icon}' title='{$device}' alt='{$device}' class='h-6 w-6 mr-4'/>";

		$browser_icon = Utils::get_browser_icon_url( $browser );

		$td .= "<img src='{$browser_icon}' title='{$browser}' alt='{$browser}' class='h-6 w-6 mr-4'/>";

		if ( $click['is_robot'] == 1 ) {
			$robot_icon = KC_US_PLUGIN_ASSETS_DIR_URL . '/images/browsers/robot.svg';

			$td .= "<img src='{$robot_icon}' title='Robot' alt='Robot' class='h-6 w-6' />";
		}

		$td .= "</span>";

		$td .= "</td>";

		echo $td;

	}

	/**
	 * Render ROW
	 *
	 * @param array $click
	 *
	 * @since 1.1.5
	 */
	public function render_row( $click = [] ) {

		echo "<tr>";

		foreach ( $this->columns as $key => $column ) {

			switch ( $key ) {
				case 'ip':
					$this->column_ip( $click );
					break;
				case 'host':
					echo "<td>" . $click['host'] . "</td>";
					break;
				case 'referrer':
					echo "<td>" . $click['referer'] . "</td>";
					break;
				case 'uri':
					echo "<td><b>" . $click['uri'] . "</b></td>";
					break;
				case 'link':
					$link_id = $click['link_id'];
					$link_stats_url = Helper::get_link_action_url($link_id, 'statistics');
					echo "<td><a href='" . $link_stats_url ."'>" . $click['name'] . "</a></td>";
					break;
				case 'clicked_on':
					echo "<td>" . $click['created_at'] . "</td>";
					break;
				case 'info':
					$this->column_info( $click );
					break;
			}

		}

		echo "</tr>";


	}

	/**
	 * Render Footer
	 *
	 * @since 1.1.5
	 */
	public function render_footer() {
		$this->render_columns();
	}


}