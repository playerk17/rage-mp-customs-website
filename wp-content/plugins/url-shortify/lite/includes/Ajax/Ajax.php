<?php

namespace Kaizen_Coders\Url_Shortify\Ajax;

/**
 * Class Ajax
 *
 * Handle Ajax request
 *
 * @package Kaizen_Coders\Url_Shortify\Ajax
 *
 * @since 1.0.3
 */
class Ajax {

	public function init() {
		add_action( 'wp_ajax_nopriv_your_method', array( $this, 'your_method' ) );
	}

	public function your_method() {
		$return = array(
			'message' => 'Saved',
			'ID'      => 1,
		);

		wp_send_json_success( $return );
	}

}