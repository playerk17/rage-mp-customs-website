<?php

namespace Kaizen_Coders\Url_Shortify\Ajax;

/**
 * Class Admin_Ajax
 *
 * Handle Admin Ajax request
 *
 * @package Kaizen_Coders\Url_Shortify\Ajax
 *
 * @since 1.0.3
 */
class Admin_Ajax {

	public function init() {
		add_action( 'wp_ajax_your_method', array( $this, 'your_method' ) );
	}

	public function your_method() {
		$return = array(
			'message' => 'Saved',
			'ID'      => 1,
		);

		wp_send_json_success( $return );
	}

}