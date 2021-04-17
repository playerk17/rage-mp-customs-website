<?php

namespace Kaizen_Coders\Url_Shortify;


class Admin_Ajax {

	public function initialize() {
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
