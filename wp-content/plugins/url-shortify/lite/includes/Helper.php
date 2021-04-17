<?php

namespace Kaizen_Coders\Url_Shortify;

use Kaizen_Coders\Url_Shortify\Admin\Stats;
use Kaizen_Coders\Url_Shortify\Common\Utils;

/**
 * Plugin_Name
 *
 * @package   Url_Shortify
 * @author    Kaizen Coders <hello@kaizencoders.com>
 * @link      https://kaizencoders.com
 */

/**
 * Helper Class
 */
class Helper {

	/**
	 * Whether given user is an administrator.
	 *
	 * @param \WP_User $user The given user.
	 *
	 * @return bool
	 */
	public static function is_user_admin( \WP_User $user = null ) {
		if ( is_null( $user ) ) {
			$user = wp_get_current_user();
		}

		if ( ! $user instanceof WP_User ) {
			_doing_it_wrong( __METHOD__, 'To check if the user is admin is required a WP_User object.', '1.0.0' );
		}

		return is_multisite() ? user_can( $user, 'manage_network' ) : user_can( $user, 'manage_options' );
	}

	/**
	 * What type of request is this?
	 *
	 * @param string $type admin, ajax, cron, cli or frontend.
	 *
	 * @return bool
	 * @since 1.0.0
	 *
	 */
	public function request( $type ) {
		switch ( $type ) {
			case 'admin_backend':
				return $this->is_admin_backend();
			case 'ajax':
				return $this->is_ajax();
			case 'installing_wp':
				return $this->is_installing_wp();
			case 'rest':
				return $this->is_rest();
			case 'cron':
				return $this->is_cron();
			case 'frontend':
				return $this->is_frontend();
			case 'cli':
				return $this->is_cli();
			default:
				_doing_it_wrong( __METHOD__, esc_html( sprintf( 'Unknown request type: %s', $type ) ), '1.0.0' );

				return false;
		}
	}

	/**
	 * Is installing WP
	 *
	 * @return boolean
	 */
	public function is_installing_wp() {
		return defined( 'WP_INSTALLING' );
	}

	/**
	 * Is admin
	 *
	 * @return boolean
	 * @since 1.0.0
	 *
	 */
	public function is_admin_backend() {
		return is_user_logged_in() && is_admin();
	}

	/**
	 * Is ajax
	 *
	 * @return boolean
	 * @since 1.0.0
	 *
	 */
	public function is_ajax() {
		return ( function_exists( 'wp_doing_ajax' ) && wp_doing_ajax() ) || defined( 'DOING_AJAX' );
	}

	/**
	 * Is rest
	 *
	 * @return boolean
	 * @since 1.0.0
	 *
	 */
	public function is_rest() {
		return defined( 'REST_REQUEST' );
	}

	/**
	 * Is cron
	 *
	 * @return boolean
	 * @since 1.0.0
	 *
	 */
	public function is_cron() {
		return ( function_exists( 'wp_doing_cron' ) && wp_doing_cron() ) || defined( 'DOING_CRON' );
	}

	/**
	 * Is frontend
	 *
	 * @return boolean
	 * @since 1.0.0
	 *
	 */
	public function is_frontend() {
		return ( ! $this->is_admin_backend() || ! $this->is_ajax() ) && ! $this->is_cron() && ! $this->is_rest();
	}

	/**
	 * Is cli
	 *
	 * @return boolean
	 * @since 1.0.0
	 *
	 */
	public function is_cli() {
		return defined( 'WP_CLI' ) && WP_CLI;
	}

	/**
	 * Define constant
	 *
	 * @param $name
	 * @param $value
	 *
	 * @since 1.0.0
	 */
	public static function maybe_define_constant( $name, $value ) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}

	/**
	 * Get current date time
	 *
	 * @return false|string
	 */
	public static function get_current_date_time() {
		return gmdate( 'Y-m-d H:i:s' );
	}


	/**
	 * Get current date time
	 *
	 * @return false|string
	 *
	 */
	public static function get_current_gmt_timestamp() {
		return strtotime( gmdate( 'Y-m-d H:i:s' ) );
	}

	/**
	 * Get current date
	 *
	 * @return false|string
	 *
	 */
	public static function get_current_date() {
		return gmdate( 'Y-m-d' );
	}

	/**
	 * Format date time
	 *
	 * @param $date
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public static function format_date_time( $date ) {
		$convert_date_format = get_option( 'date_format' );
		$convert_time_format = get_option( 'time_format' );

		return ( $date !== '0000-00-00 00:00:00' ) ? date_i18n( "$convert_date_format $convert_time_format", strtotime( get_date_from_gmt( $date ) ) ) : '<i class="dashicons dashicons-es dashicons-minus"></i>';
	}

	/**
	 * Clean String or array using sanitize_text_field
	 *
	 * @param $var data to sanitize
	 *
	 * @return array|string
	 *
	 * @sinc 1.0.0
	 *
	 */
	public static function clean( $var ) {
		if ( is_array( $var ) ) {
			return array_map( 'self::clean', $var );
		} else {
			return is_scalar( $var ) ? sanitize_text_field( $var ) : $var;
		}
	}

	/**
	 * Get IP
	 *
	 * @return mixed|string|void
	 *
	 */
	public static function get_ip() {

		// Get real visitor IP behind CloudFlare network
		if ( isset( $_SERVER['HTTP_CF_CONNECTING_IP'] ) ) {
			$ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
		} elseif ( isset( $_SERVER['HTTP_X_REAL_IP'] ) ) {
			$ip = $_SERVER['HTTP_X_REAL_IP'];
		} elseif ( isset( $_SERVER['HTTP_CLIENT_IP'] ) ) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} elseif ( isset( $_SERVER['HTTP_X_FORWARDED'] ) ) {
			$ip = $_SERVER['HTTP_X_FORWARDED'];
		} elseif ( isset( $_SERVER['HTTP_FORWARDED_FOR'] ) ) {
			$ip = $_SERVER['HTTP_FORWARDED_FOR'];
		} elseif ( isset( $_SERVER['HTTP_FORWARDED'] ) ) {
			$ip = $_SERVER['HTTP_FORWARDED'];
		} else {
			$ip = isset( $_SERVER['REMOTE_ADDR'] ) ? $_SERVER['REMOTE_ADDR'] : 'UNKNOWN';
		}

		return $ip;
	}

	/**
	 * Get GMT Offset
	 *
	 * @param bool $in_seconds
	 * @param null $timestamp
	 *
	 * @return float|int
	 *
	 */
	public static function get_gmt_offset( $in_seconds = false, $timestamp = null ) {

		$offset = get_option( 'gmt_offset' );

		if ( $offset == '' ) {
			$tzstring = get_option( 'timezone_string' );
			$current  = date_default_timezone_get();
			date_default_timezone_set( $tzstring );
			$offset = date( 'Z' ) / 3600;
			date_default_timezone_set( $current );
		}

		// check if timestamp has DST
		if ( ! is_null( $timestamp ) ) {
			$l = localtime( $timestamp, true );
			if ( $l['tm_isdst'] ) {
				$offset ++;
			}
		}

		return $in_seconds ? $offset * 3600 : (int) $offset;
	}

	/**
	 * Insert $new in $array after $key
	 *
	 * @param $array
	 * @param $key
	 * @param $new
	 *
	 * @return array
	 *
	 */
	public static function array_insert_after( $array, $key, $new ) {
		$keys  = array_keys( $array );
		$index = array_search( $key, $keys );
		$pos   = false === $index ? count( $array ) : $index + 1;

		return array_merge( array_slice( $array, 0, $pos ), $new, array_slice( $array, $pos ) );
	}

	/**
	 * Insert a value or key/value pair before a specific key in an array.  If key doesn't exist, value is prepended
	 * to the beginning of the array.
	 *
	 * @param array $array
	 * @param string $key
	 * @param array $new
	 *
	 * @return array
	 */
	public static function array_insert_before( array $array, $key, array $new ) {
		$keys = array_keys( $array );
		$pos  = (int) array_search( $key, $keys );

		return array_merge( array_slice( $array, 0, $pos ), $new, array_slice( $array, $pos ) );
	}


	/**
	 * Insert $new in $array after $key
	 *
	 * @param $array
	 *
	 * @return boolean
	 *
	 */
	public static function is_forechable( $array = array() ) {

		if ( ! is_array( $array ) ) {
			return false;
		}

		if ( empty( $array ) ) {
			return false;
		}

		if ( count( $array ) <= 0 ) {
			return false;
		}

		return true;

	}

	/**
	 * Get current db version
	 *
	 * @since 1.0.0
	 */
	public static function get_db_version() {
		return Option::get( 'db_version', '0.0.1' );
	}

	/**
	 * Get all Plugin admin screens
	 *
	 * @return array|mixed|void
	 *
	 * @since 1.0.0
	 */
	public static function get_plugin_admin_screens() {

		// TODO: Can be updated with a version check when https://core.trac.wordpress.org/ticket/18857 is fixed
		$prefix = sanitize_title( __( 'URL Shortify', 'url-shortify' ) );

		$screens = array(
			'toplevel_page_url_shortify',
			"{$prefix}_page_us_links",
			"{$prefix}_page_us_groups",
			"{$prefix}_page_us_domains",
			"{$prefix}_page_us_tools",
			"{$prefix}_page_kc-us-settings",
			"{$prefix}_page_kc-us-tools-settings",
			"{$prefix}_page_url_shortify-account",
		);

		$screens = apply_filters( 'kc_us_admin_screens', $screens );

		return $screens;
	}

	/**
	 * Is es admin screen?
	 *
	 * @param string $screen_id Admin screen id
	 *
	 * @return bool
	 *
	 * @since 1.0.0
	 */
	public static function is_plugin_admin_screen( $screen_id = '' ) {

		$current_screen_id = self::get_current_screen_id();
		// Check for specific admin screen id if passed.
		if ( ! empty( $screen_id ) ) {
			if ( $current_screen_id === $screen_id ) {
				return true;
			} else {
				return false;
			}
		}

		$plugin_admin_screens = self::get_plugin_admin_screens();

		if ( in_array( $current_screen_id, $plugin_admin_screens ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Get Current Screen Id
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public static function get_current_screen_id() {

		$current_screen = function_exists( 'get_current_screen' ) ? get_current_screen() : false;

		if ( ! $current_screen instanceof \WP_Screen ) {
			return '';
		}

		$current_screen = get_current_screen();

		return ( $current_screen ? $current_screen->id : '' );
	}

	/**
	 * Get data from array
	 *
	 * @param array $array
	 * @param string $var
	 * @param string $default
	 * @param bool $clean
	 *
	 * @return array|string
	 *
	 * @since 1.0.0
	 */
	public static function get_data( $array = array(), $var = '', $default = '', $clean = false ) {

		if ( empty( $array ) ) {
			return $default;
		}

		if ( ! empty( $var ) || ( 0 === $var ) ) {
			$value = isset( $array[ $var ] ) ? wp_unslash( $array[ $var ] ) : $default;
		} else {
			$value = wp_unslash( $array );
		}

		if ( $clean ) {
			$value = self::clean( $value );
		}

		return $value;
	}

	/**
	 * Get POST | GET data from $_REQUEST
	 *
	 * @param string $var
	 * @param string $default
	 * @param bool $clean
	 *
	 * @return array|string
	 *
	 * @since 1.0.0
	 */
	public static function get_request_data( $var = '', $default = '', $clean = true ) {
		return self::get_data( $_REQUEST, $var, $default, $clean );
	}

	/**
	 * Get POST data from $_POST
	 *
	 * @param string $var
	 * @param string $default
	 * @param bool $clean
	 *
	 * @return array|string
	 *
	 * @since 1.0.0
	 */
	public static function get_post_data( $var = '', $default = '', $clean = true ) {
		return self::get_data( $_POST, $var, $default, $clean );
	}

	/**
	 * Get Current blog url
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public static function get_blog_url() {
		$blog_id = null;
		if ( function_exists( 'is_multisite' ) && is_multisite() && function_exists( 'get_current_blog_id' ) ) {
			$blog_id = get_current_blog_id();
		}

		return get_home_url( $blog_id );
	}

	/**
	 * Get Short link
	 *
	 * @param string $slug
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public static function get_short_link( $slug = '' ) {

		if ( empty( $slug ) ) {
			return '';
		}

		return trailingslashit( self::get_blog_url() ) . $slug;
	}

	/**
	 * Get short link by link id
	 *
	 * @param string $id
	 *
	 * @return string
	 *
	 * @since 1.2.10
	 */
	public static function get_short_link_by_id( $id = '' ) {
		if ( empty( $id ) ) {
			return '';
		}

		$link = US()->db->links->get_by_id( $id );

		return self::get_short_link( $link['slug'] );
	}

	/**
	 * Get redirection types
	 *
	 * @return mixed|void
	 *
	 * @since 1.0.0
	 */
	public static function get_redirection_types() {

		$types = array(
			'307' => __( '307 (Temporary)', 'url-shorify' ),
			'302' => __( '302 (Temporary)', 'url-shorify' ),
			'301' => __( '301 (Permanent)', 'url-shorify' )
		);

		$additional_types = apply_filters( 'kc_us_redirection_types', array() );

		if ( is_array( $additional_types ) && count( $additional_types ) > 0 ) {
			$types = $types + $additional_types;
		}

		return $types;
	}

	/**
	 * Get custom domains
	 *
	 * @return array|void
	 *
	 * @since 1.3.8
	 */
	public static function get_domains() {

		$domains = array(
			'home' => site_url(),
		);

		$custom_domains = apply_filters( 'kc_us_custom_domains', array() );

		if ( is_array( $custom_domains ) && count( $custom_domains ) > 0 ) {
			$domains = Helper::array_insert_before( $domains, 'home', array( 'any' => __( 'All my domains', 'url-shorify' ) ) );
			$domains = $domains + $custom_domains;
		}

		return $domains;
	}

	/**
	 * Create Copy Link HTML
	 *
	 * @param $link
	 * @param $id
	 * @param string $html
	 *
	 * @return string
	 *
	 * @since 1.1.3
	 */
	public static function create_copy_short_link_html( $link, $id, $html = '' ) {
		if ( ! empty( $html ) ) {
			return '<span class="kc-flex kc-us-copy-to-clipboard" data-clipboard-text="' . $link . '" id="link-' . $id . '">' . $html . '<svg class="kc-us-link-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><title>' . __( 'Copy',
					'url-shortify' ) . '</title><path d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg><p id="copied-text-link-' . $id . '"></p></span>';
		} else {
			return '<span class="kc-flex kc-us-copy-to-clipboard" data-clipboard-text="' . $link . '" id="link-' . $id . '"><svg class="kc-us-link-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><title>' . __( 'Copy',
					'url-shortify' ) . '</title><path d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg><p id="copied-text-link-' . $id . '"></p></span>';
		}
	}

	/**
	 * Create Link Stats URL
	 *
	 * @param int $link_id
	 *
	 * @return string|void
	 *
	 * @since 1.1.3
	 */
	public static function create_link_stats_url( $link_id = 0 ) {

		if ( empty( $link_id ) ) {
			return '#';
		}

		return self::get_link_action_url( $link_id, 'statistics' );
	}

	/**
	 * Prpare clicks column
	 *
	 * @param $link_ids
	 * @param string $stats_url
	 *
	 * @return string
	 *
	 * @since 1.1.3
	 *
	 * @modified 1.2.4
	 */
	public static function prepare_clicks_column( $link_ids, $stats_url = '' ) {

		$total_clicks  = Stats::get_total_clicks_by_link_ids( $link_ids );
		$unique_clicks = Stats::get_total_unique_clicks_by_link_ids( $link_ids );

		if ( 0 == $total_clicks || empty( $stats_url ) ) {
			return $unique_clicks . ' / ' . $total_clicks;
		} else {
			return '<a href="' . $stats_url . '"  title="' . __( 'Unique Clicks / Total Clicks', 'url-shortify' ) . '" class="kc-us-link"/>' . $unique_clicks . ' / ' . $total_clicks . '</a>';
		}

	}

	/**
	 * Get link action url
	 *
	 * @param null $link_id
	 * @param string $action
	 *
	 * @return string
	 *
	 * @since 1.1.5
	 */
	public static function get_link_action_url( $link_id = null, $action = 'edit' ) {
		if ( empty( $link_id ) || empty( $action ) ) {
			return '#';
		}

		return self::get_action_url( $link_id, 'links', $action );
	}

	/**
	 * Get Group action url
	 *
	 * @param null $group_id
	 * @param string $action
	 *
	 * @return string
	 *
	 * @since 1.1.7
	 */
	public static function get_group_action_url( $group_id = null, $action = 'edit' ) {
		if ( empty( $group_id ) || empty( $action ) ) {
			return '#';
		}

		return self::get_action_url( $group_id, 'groups', $action );
	}

	/**
	 * Get Group action url
	 *
	 * @param null $group_id
	 * @param string $action
	 *
	 * @return string
	 *
	 * @since 1.3.8
	 */
	public static function get_domain_action_url( $id = null, $action = 'edit' ) {
		if ( empty( $id ) || empty( $action ) ) {
			return '#';
		}

		return self::get_action_url( $id, 'domains', $action );
	}

	/**
	 * Get action url
	 *
	 * @param null $id
	 * @param string $type
	 * @param string $action
	 *
	 * @return string
	 *
	 * @since 1.1.7
	 */
	public static function get_action_url( $id = null, $type = 'links', $action = 'edit' ) {
		if ( empty( $id ) || empty( $action ) ) {
			return '#';
		}

		if ( 'links' === $type ) {
			$page = 'us_links';
		} elseif ( 'groups' === $type ) {
			$page = 'us_groups';
		} elseif ( 'domains' === $type ) {
			$page = 'us_domains';
		} else {
			$page = 'us_links';
		}

		$args = array(
			'page'     => $page,
			'id'       => $id,
			'action'   => $action,
			'_wpnonce' => wp_create_nonce( 'us_action_nonce' )
		);

		return add_query_arg( $args, admin_url( 'admin.php' ) );
	}

	/**
	 * Get Start & End date based on $days
	 *
	 * @param int $days
	 *
	 * @return array
	 *
	 * @since 1.1.6
	 */
	public static function get_start_and_end_date_from_last_days( $days = 7 ) {
		$end_date = date( 'Y-m-d', time() );

		$start_date = date( 'Y-m-d', strtotime( "- $days days" ) );

		return array(
			'start_date' => $start_date,
			'end_date'   => $end_date
		);
	}

	/**
	 * Return string with specific length
	 *
	 * @param $x
	 * @param $length
	 *
	 * @return string
	 *
	 * @since 1.2.0
	 */
	public static function str_limit( $x, $length ) {
		if ( strlen( $x ) <= $length ) {
			return $x;
		} else {
			$y = substr( $x, 0, $length ) . '...';

			return $y;
		}
	}

	/**
	 * Get Post Type from Post ID
	 *
	 * @param int $cpt_id
	 *
	 * @return string
	 *
	 * @since 1.2.5
	 */
	public static function get_cpt_type_from_cpt_id( $cpt_id = 0 ) {

		if ( empty( $cpt_id ) ) {
			return '';
		}

		$post = get_post( $cpt_id );

		if ( $post instanceof \WP_Post ) {

			return $post->post_type;
		}

		return '';
	}

	/**
	 * Get CPT Info
	 *
	 * @param string $cpt_type
	 *
	 * @return array
	 *
	 * @since 1.2.5
	 */
	public static function get_cpt_info( $cpt_type = '' ) {

		$cpt_info = array(

			'post' => array(
				'title' => __( 'Post', 'url-shortify' ),
				'icon'  => KC_US_PLUGIN_ASSETS_DIR_URL . '/images/cpt/post-24x24.png'
			),

			'page' => array(
				'title' => __( 'Page', 'url-shortify' ),
				'icon'  => KC_US_PLUGIN_ASSETS_DIR_URL . '/images/cpt/page-24x24.png'
			),

			'product' => array(
				'title' => __( 'WooCommerce', 'url-shortify' ),
				'icon'  => KC_US_PLUGIN_ASSETS_DIR_URL . '/images/cpt/woocommerce-24x24.png'
			),

			'download' => array(
				'title' => __( 'Easy Digital Download', 'url-shortify' ),
				'icon'  => KC_US_PLUGIN_ASSETS_DIR_URL . '/images/cpt/download-24x24.png'
			),

			'event' => array(
				'title' => __( 'Events Manager', 'url-shortify' ),
				'icon'  => KC_US_PLUGIN_ASSETS_DIR_URL . '/images/cpt/event-24x24.png'
			),

			'tribe_events' => array(
				'title' => __( 'The Events Calendar', 'url-shortify' ),
				'icon'  => KC_US_PLUGIN_ASSETS_DIR_URL . '/images/cpt/tribe_events-24x24.png'
			),

			'docs' => array(
				'title' => __( 'Betterdocs', 'url-shortify' ),
				'icon'  => KC_US_PLUGIN_ASSETS_DIR_URL . '/images/cpt/docs-24x24.png'
			),

			'kbe_knowledgebase' => array(
				'title' => __( 'WordPress Knowledgebase', 'url-shortify' ),
				'icon'  => KC_US_PLUGIN_ASSETS_DIR_URL . '/images/cpt/kbe_knowledgebase-24x24.png'
			),

			'mec-events' => array(
				'title' => __( 'Modern Events', 'url-shortify' ),
				'icon'  => KC_US_PLUGIN_ASSETS_DIR_URL . '/images/cpt/mec-events-24x24.png'
			),

		);

		return ! empty( $cpt_info[ $cpt_type ] ) ? $cpt_info[ $cpt_type ] : $cpt_info['post'];
	}

	public static function get_all_cpt_data() {
		return get_post_types( array( '_builtin' => false, 'public' => true ), 'objects', 'and' );
	}

	/**
	 * Check whether ip fall into excluded ips
	 *
	 * @param $ip
	 * @param $range
	 *
	 * @return bool
	 *
	 * @since 1.3.0
	 */
	public static function is_ip_in_range( $ip, $range ) {

		$ip    = trim( $ip );
		$range = trim( $range );

		if ( $ip === $range ) {
			return true;
		}

		if ( strpos( $range, '/' ) !== false ) {
			// $range is in IP/NETMASK format
			list( $range, $netmask ) = explode( '/', $range, 2 );
			if ( strpos( $netmask, '.' ) !== false ) {
				// $netmask is a 255.255.0.0 format
				$netmask     = str_replace( '*', '0', $netmask );
				$netmask_dec = ip2long( $netmask );

				return ( ( ip2long( $ip ) & $netmask_dec ) == ( ip2long( $range ) & $netmask_dec ) );
			} else {
				// $netmask is a CIDR size block
				// fix the range argument
				$x = explode( '.', $range );
				while ( count( $x ) < 4 ) {
					$x[] = '0';
				}
				list( $a, $b, $c, $d ) = $x;
				$range     = sprintf( "%u.%u.%u.%u", empty( $a ) ? '0' : $a, empty( $b ) ? '0' : $b, empty( $c ) ? '0' : $c, empty( $d ) ? '0' : $d );
				$range_dec = ip2long( $range );
				$ip_dec    = ip2long( $ip );

				# Strategy 1 - Create the netmask with 'netmask' 1s and then fill it to 32 with 0s
				#$netmask_dec = bindec(str_pad('', $netmask, '1') . str_pad('', 32-$netmask, '0'));

				# Strategy 2 - Use math to create it
				$wildcard_dec = pow( 2, ( 32 - $netmask ) ) - 1;
				$netmask_dec  = ~$wildcard_dec;

				return ( ( $ip_dec & $netmask_dec ) == ( $range_dec & $netmask_dec ) );
			}
		} else {
			// range might be 255.255.*.* or 1.2.3.0-1.2.3.255
			if ( strpos( $range, '*' ) !== false ) { // a.b.*.* format
				// Just convert to A-B format by setting * to 0 for A and 255 for B
				$lower = str_replace( '*', '0', $range );
				$upper = str_replace( '*', '255', $range );
				$range = "$lower-$upper";
			}

			if ( strpos( $range, '-' ) !== false ) { // A-B format
				list( $lower, $upper ) = explode( '-', $range, 2 );
				$lower_dec = (float) sprintf( "%u", ip2long( $lower ) );
				$upper_dec = (float) sprintf( "%u", ip2long( $upper ) );
				$ip_dec    = (float) sprintf( "%u", ip2long( $ip ) );

				return ( ( $ip_dec >= $lower_dec ) && ( $ip_dec <= $upper_dec ) );
			}


			return false;
		}

	}

	/**
	 * Prpeare Social share widget
	 *
	 * @param null $link_id
	 * @param string $share_icon_size
	 *
	 * @return string
	 *
	 * @since 1.3.2
	 */
	public static function get_social_share_widget( $link_id = null, $share_icon_size = '1' ) {

		$html = '';

		$socials = array();
		$socials = apply_filters( 'kc_us_filter_social_sharing', $socials, $link_id );

		if ( Helper::is_forechable( $socials ) ) {

			$html .= '<div class="share-button sharer pointer" style="display: block;">';
			$html .= '<span class="fa fa-share-alt text-indigo-600 fa-' . $share_icon_size . 'x share-btn cursor-pointer"></span>';
			$html .= '<div class="social bottom center networks-5 us-social" >';

			foreach ( $socials as $social => $data ) {

				$url   = Helper::get_data( $data, 'url', '' );
				$icon  = Helper::get_data( $data, 'icon', '' );
				$title = Helper::get_data( $data, 'title', '' );

				$html .= sprintf( '<a class="fbtn share %s" href="%s" title="%s" target="_blank">%s</i></a>', $social, $url, $title, $icon );
			}

			$html .= '</div></div>';
		}

		return $html;
	}

	/**
	 * Check Pretty Links Exists
	 *
	 * @return bool|int
	 *
	 * @since 1.3.4
	 */
	public static function is_pretty_links_table_exists() {
		global $wpdb;

		$links_table = "{$wpdb->prefix}prli_links";

		return US()->is_table_exists( $links_table );
	}

	/**
	 * Check MTS Short Links Exists
	 *
	 * @return bool|int
	 *
	 * @since 1.3.4
	 */
	public static function is_mts_short_links_table_exists() {
		global $wpdb;

		$links_table = "{$wpdb->prefix}short_links";

		return US()->is_table_exists( $links_table );
	}

	/**
	 * Gets the current action selected from the bulk actions dropdown.
	 *
	 * @return string|false The action name. False if no action was selected.
	 * @since 1.3.4
	 *
	 */
	public static function get_current_action() {
		if ( isset( $_REQUEST['filter_action'] ) && ! empty( $_REQUEST['filter_action'] ) ) {
			return false;
		}

		if ( isset( $_REQUEST['action'] ) && - 1 != $_REQUEST['action'] ) {
			return $_REQUEST['action'];
		}

		if ( isset( $_REQUEST['action2'] ) && - 1 != $_REQUEST['action2'] ) {
			return $_REQUEST['action2'];
		}

		return false;
	}

	/**
	 * Get group string
	 *
	 * @param $group_ids
	 * @param $groups
	 *
	 * @return string
	 *
	 * @since 1.3.7
	 */
	public static function get_group_str_from_ids( $group_ids, $groups ) {
		if ( empty( $group_ids ) ) {
			return '';
		}

		if ( is_int( $group_ids ) ) {
			$group_ids = array( $group_ids );
		}

		if ( empty( $groups ) ) {
			$groups = US()->db->groups->get_id_name_map();
		}

		$group_str = array();
		foreach ( $group_ids as $group_id ) {
			$group_str[] = Helper::get_data( $groups, $group_id, '' );
		}

		return implode( $group_str, ', ' );
	}

	/**
	 * Is shortlink request coming from same domain
	 *
	 * @return bool
	 *
	 * @sicne 1.3.8
	 */
	public static function is_request_from_same_domain() {

		$site_url = get_site_url();

		return self::is_request_from_specific_domain( $site_url );
	}

	/**
	 * Is request coming from specific domain?
	 *
	 * @param $domain
	 *
	 * @return bool
	 *
	 * @since 1.3.8
	 */
	public static function is_request_from_specific_domain( $domain ) {

		$current_page_url = Utils::get_current_page_url();

		$clean_site_host    = Utils::get_the_clean_domain( $domain );
		$clean_request_host = Utils::get_the_clean_domain( $current_page_url );

		return $clean_site_host === $clean_request_host;

	}

}
