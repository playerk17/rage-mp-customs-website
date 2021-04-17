<?php

namespace Kaizen_Coders\Url_Shortify\Admin\Controllers;

use Kaizen_Coders\Url_Shortify\Admin\DB\Links;
use Kaizen_Coders\Url_Shortify\Common\Utils;
use Kaizen_Coders\Url_Shortify\Helper;

class Links_Controller extends Base_Controller {

	/**
	 * @var Links|null
	 *
	 * @since 1.1.5
	 */
	public $db = null;

	/**
	 * Links_Controller constructor.
	 *
	 * @since 1.1.3
	 */
	public function __construct() {

		$this->db = new Links();

		parent::__construct();
	}

	/**
	 * Create Short Link
	 *
	 * @param array $data
	 *
	 * @return array|string[]
	 *
	 * @since 1.1.3
	 */
	public function create( $data = [] ) {

		$post_id = Helper::get_data( $data, 'post_id', 0 );

		$slug = Utils::get_valid_slug();

		$link_id = $this->db->create_link_from_post( $post_id, $slug );

		if ( $link_id ) {

			$link = Helper::get_short_link( $slug );

			$response = [
				'status' => 'success',
				'link'   => $link,
				'html'   => Helper::create_copy_short_link_html( $link, $post_id )
			];

		} else {
			$response = [
				'status' => 'error'
			];
		}

		return $response;

	}

	/**
	 * Get Short Link by CPT id
	 *
	 * @param int $cpt_id
	 *
	 * @return bool|string
	 *
	 * @since 1.1.5
	 */
	public function get_short_link_by_cpt_id( $cpt_id = 0 ) {

		$link = $this->db->get_by_cpt_id( $cpt_id );

		if ( ! empty( $link ) ) {
			return Helper::get_short_link( $link['slug'] );
		}

		return false;
	}

}