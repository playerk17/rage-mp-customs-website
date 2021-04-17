<?php

namespace Kaizen_Coders\Url_Shortify;

use Kaizen_Coders\Url_Shortify\Admin\Controllers\ImportController;
use Kaizen_Coders\Url_Shortify\Admin\Controllers\LinksController;
use Kaizen_Coders\Url_Shortify\Admin\DB\Links;

/**
 * Class Ajax
 *
 * Handle Ajax request
 *
 * @package Kaizen_Coders\Url_Shortify
 *
 * @since 1.1.3
 */
class Ajax {

	public $accessible_commands = array(
		'create_short_link',
		'import_pretty_links'
	);

	/**
	 * Init
	 *
	 * @since 1.1.3
	 */
	public function init() {
		add_action( 'wp_ajax_us_handle_request', array( $this, 'handle_request' ) );
	}

	/**
	 * Handle Ajax Request
	 *
	 * @since 1.1.3
	 */
	public function handle_request() {

		$params = Helper::get_request_data();

		if ( empty( $params ) || empty( $params['cmd'] ) ) {
			return;
		}

		check_ajax_referer( KC_US_AJAX_SECURITY, 'security' );

		$cmd = Helper::get_data( $params, 'cmd', '' );

		if ( in_array( $cmd, $this->accessible_commands ) && is_callable( array( $this, $cmd ) ) ) {
			$this->$cmd( $params );
		}

	}

	/**
	 * Create Short Link
	 *
	 * @param array $data
	 *
	 * @since 1.1.3
	 */
	public function create_short_link( $data = array() ) {

		$link_controller = new LinksController();

		$response = $link_controller->create( $data );

		wp_send_json( $response );
	}

	/**
	 * Import links from pretty link
	 *
	 * @param array $data
	 *
	 * @since 1.1.9
	 */
	public function import_pretty_links( $data = array() ) {

		$import_controller = new ImportController();

		$response = $import_controller->import_pretty_links( $data );

		wp_send_json( $response );

	}




}
