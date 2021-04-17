<?php

namespace Kaizen_Coders\Url_Shortify\Admin\Controllers;

use Kaizen_Coders\Url_Shortify\Helper;

class ImportController extends BaseController {

	public function __construct() {


		parent::__construct();
	}

	/**
	 * Import links from prettylink WordPress plugin
	 *
	 * @param array $data
	 *
	 * @since 1.3.4
	 */
	public function import_pretty_links() {

		global $wpdb;

		$current_user_id = get_current_user_id();
		$links_table     = "{$wpdb->prefix}prli_links";

		$links_table_exists = US()->is_table_exists( $links_table );

		if ( $links_table_exists > 0 ) {

			$query = "SELECT * FROM {$links_table}";

			$links = $wpdb->get_results( $query, ARRAY_A );

			if ( Helper::is_forechable( $links ) ) {

				@set_time_limit( 0 );

				$values = array();

				$key = 0;

				foreach ( $links as $link ) {

					$values[ $key ]['slug']              = Helper::get_data( $link, 'slug', '' );
					$values[ $key ]['name']              = ! empty( Helper::get_data( $link, 'name', '' ) ) ? Helper::get_data( $link, 'name', '' ) : Helper::get_data( $link, 'url', '' );
					$values[ $key ]['description']       = Helper::get_data( $link, 'description', '' );
					$values[ $key ]['url']               = Helper::get_data( $link, 'url', '' );
					$values[ $key ]['nofollow']          = Helper::get_data( $link, 'nofollow', '' );
					$values[ $key ]['track_me']          = Helper::get_data( $link, 'track_me', '' );
					$values[ $key ]['sponsored']         = Helper::get_data( $link, 'sponsored', '' );
					$values[ $key ]['params_forwarding'] = Helper::get_data( $link, 'param_forwarding', '' );
					$values[ $key ]['params_structure']  = Helper::get_data( $link, 'params_struct', '' );
					$values[ $key ]['redirect_type']     = Helper::get_data( $link, 'redirect_type', '' );
					$values[ $key ]['status']            = ( 'enabled' === Helper::get_data( $link, 'link_status', 'enabled' ) ) ? 1 : 0;
					$values[ $key ]['type']              = 'direct';
					$values[ $key ]['type_id']           = null;
					$values[ $key ]['password']          = null;
					$values[ $key ]['expires_at']        = null;
					$values[ $key ]['cpt_id']            = Helper::get_data( $link, 'link_cpt_id', '' );
					$values[ $key ]['cpt_type']          = Helper::get_data( $link, 'link_cpt_type', '' );
					$values[ $key ]['rules']             = null;
					$values[ $key ]['created_at']        = Helper::get_data( $link, 'created_at', '' );
					$values[ $key ]['created_by_id']     = $current_user_id;
					$values[ $key ]['updated_at']        = Helper::get_data( $link, 'updated_at', '' );;
					$values[ $key ]['updated_by_id'] = $current_user_id;

					$key ++;
				}

				return US()->db->links->bulk_insert( $values );
			}
		}

		return true;
	}

	/**
	 * Import links from My theme shop short links WordPress plugin
	 *
	 * @param array $data
	 *
	 * @since 1.3.4
	 */
	public function import_mts_short_links() {

		global $wpdb;

		$links_table = "{$wpdb->prefix}short_links";

		$links_table_exists = US()->is_table_exists( $links_table );

		if ( $links_table_exists > 0 ) {

			$query = "SELECT * FROM {$links_table}";

			$links = $wpdb->get_results( $query, ARRAY_A );

			if ( Helper::is_forechable( $links ) ) {

				@set_time_limit( 0 );

				$values = array();

				$key = 0;

				foreach ( $links as $link ) {

					$values[ $key ]['slug']              = Helper::get_data( $link, 'link_name', '' );
					$values[ $key ]['name']              = ! empty( Helper::get_data( $link, 'link_title', '' ) ) ? Helper::get_data( $link, 'link_title', '' ) : Helper::get_data( $link, 'link_url', '' );
					$values[ $key ]['description']       = Helper::get_data( $link, 'link_description', '' );
					$values[ $key ]['url']               = Helper::get_data( $link, 'link_url', '' );
					$values[ $key ]['nofollow']          = ( "nofollow" === Helper::get_data( $link, 'link_attr_rel', 'nofollow' ) ) ? 1 : 0;
					$values[ $key ]['track_me']          = 1;
					$values[ $key ]['sponsored']         = 0;
					$values[ $key ]['params_forwarding'] = Helper::get_data( $link, 'link_forward_parameters', 0 );
					$values[ $key ]['params_structure']  = null;
					$values[ $key ]['redirect_type']     = Helper::get_data( $link, 'link_redirection_method', 307 );
					$values[ $key ]['status']            = ( 'publish' === Helper::get_data( $link, 'link_status', 'publish' ) ) ? 1 : 0;
					$values[ $key ]['type']              = 'direct';
					$values[ $key ]['type_id']           = null;
					$values[ $key ]['password']          = null;
					$values[ $key ]['expires_at']        = null;
					$values[ $key ]['cpt_id']            = null;
					$values[ $key ]['cpt_type']          = null;
					$values[ $key ]['rules']             = null;
					$values[ $key ]['created_at']        = Helper::get_data( $link, 'link_created', '' );
					$values[ $key ]['created_by_id']     = Helper::get_data( $link, 'link_owner', '' );;
					$values[ $key ]['updated_at'] = Helper::get_data( $link, 'link_updated', '' );;
					$values[ $key ]['updated_by_id'] = Helper::get_data( $link, 'link_owner', '' );

					$key ++;
				}

				return US()->db->links->bulk_insert( $values );
			}
		}

		return true;
	}

}
