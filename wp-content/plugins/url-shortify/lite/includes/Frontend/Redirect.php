<?php

namespace Kaizen_Coders\Url_Shortify\Frontend;

use Kaizen_Coders\Url_Shortify\Admin\Click;
use Kaizen_Coders\Url_Shortify\Common\Utils;
use Kaizen_Coders\Url_Shortify\Helper;

class Redirect {

	/**
	 * Redirect constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

	}

	/**
	 * @since 1.0.0
	 */
	public function init() {

		if ( ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) && 'GET' === $_SERVER['REQUEST_METHOD'] && ! is_admin() ) {
			add_action( 'init', array( $this, 'redirect' ), 1 );

		}
	}

	/**
	 * Handle Redirection
	 *
	 * @since 1.0.0
	 */
	public function redirect() {

		// Remove the trailing slash if there is one
		$request_uri = preg_replace( '#/(\?.*)?$#', '$1', rawurldecode( $_SERVER['REQUEST_URI'] ) );

		if ( $link_data = US()->db->links->is_us_link( $request_uri, false ) ) {
			//TODO: Handle parmas

			if ( ! US()->is_qr_request() ) {
				$params = $_GET;

				if ( $this->can_redirect( $link_data ) ) {

					do_action( 'kc_us_before_redirect', $link_data );

					$this->track_click( $link_data );

					$this->do_redirect( $link_data, $params );
				}
			}
		}

	}

	/**
	 * Track click
	 *
	 * @param array $link_data
	 *
	 * @since 1.2.0
	 */
	public function track_click( $link_data = array() ) {

		$track_me = Helper::get_data( $link_data, 'track_me', 0 );

		if ( $track_me ) {
			$link_id = Helper::get_data( $link_data, 'id', 0 );
			$slug    = Helper::get_data( $link_data, 'slug', '' );

			if ( $link_id ) {
				$click = new Click( $link_id, $slug );

				$track_me = apply_filters( 'kc_us_can_track_click', $track_me, $click );

				if ( $track_me ) {
					$click->track();
				}
			}
		}
	}

	/**
	 * Redirect to main URL
	 *
	 * @param array $link_data
	 * @param array $params
	 *
	 * @since 1.0.0
	 *
	 * @modified 1.0.1
	 */
	public function do_redirect( $link_data = array(), $params = array() ) {

		$url               = Helper::get_data( $link_data, 'url', '' );
		$redirect_type     = Helper::get_data( $link_data, 'redirect_type', '' );
		$params_forwarding = Helper::get_data( $link_data, 'params_forwarding', 0 );
		$nofollow          = Helper::get_data( $link_data, 'nofollow', 0 );
		$sponsored         = Helper::get_data( $link_data, 'sponsored', 0 );

		if ( ! empty( $url ) ) {

			// Handle Params Forwarding
			if ( ! empty( $params_forwarding ) && Helper::is_forechable( $params ) ) {

				$param_string = '';

				$params = explode( '?', $_SERVER['REQUEST_URI'] );

				if ( isset( $params[1] ) ) {
					$param_string = ( preg_match( '#\?#', $url ) ? '&' : '?' ) . $params[1];
				}

				$param_string = preg_replace( array( '#%5B#i', '#%5D#i' ), array( '[', ']' ), $param_string );

				$param_string = apply_filters( 'kc_us_redirect_params', $param_string );

				$url .= $param_string;
			}

			$tags = array();

			// Handle Nofollow
			if ( ! empty( $nofollow ) ) {
				$tags[] = 'noindex';
				$tags[] = 'nofollow';
			}

			// Handle Sponsored
			if ( ! empty( $sponsored ) ) {
				$tags[] = 'sponsored';
			}

			if ( ! empty( $tags ) ) {
				header( 'X-Robots-Tag: ' . implode( ', ', $tags ), true );
			}

			header( 'Cache-Control: no-store, no-cache, must-revalidate, max-age=0' );
			header( 'Cache-Control: post-check=0, pre-check=0', false );
			header( 'Pragma: no-cache' );
			header( 'Expires: Mon, 10 Oct 1975 08:09:15 GMT' );
			header( 'X-Redirect-Powered-By: url-shortify ' . KC_US_PLUGIN_VERSION . ' https://kaizencoders.com' );

			if ( ! function_exists( 'wp_redirect' ) ) {
				require_once( ABSPATH . WPINC . '/pluggable.php' );
			}

			switch ( $redirect_type ) {
				case '301':
					wp_redirect( "$url", 301 );
					exit;
					break;
				case '307':
					wp_redirect( "$url", 307 );
					exit;
					break;
				case '302':
					wp_redirect( "$url", 302 );
					exit;
					break;
				default:
					if ( US()->is_pro() ) {
						do_action( 'kc_us_pro_redirect', $redirect_type, $url, $link_data, $params );
					} else {
						wp_redirect( "$url", 302 );
						exit;
					}
					break;
			}

		}
	}

	/**
	 * Should we redirect?
	 *
	 * @param array $link_data
	 *
	 * @return bool
	 *
	 * @since 1.1.9
	 */
	public function can_redirect( $link_data = array() ) {

		if ( US()->is_pro() ) {
			return apply_filters( 'kc_us_can_redirect', true, $link_data );
		} else {
			return Helper::is_request_from_same_domain();
		}

	}

}
