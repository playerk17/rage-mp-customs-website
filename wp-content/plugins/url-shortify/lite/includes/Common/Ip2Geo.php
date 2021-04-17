<?php

namespace Kaizen_Coders\Url_Shortify\Common;

use GeoIp2\Database\Reader;

class Ip2Geo {
	/**
	 * IP Address
	 *
	 * @var null
	 *
	 * @since 1.0.3
	 */
	public $ip = null;

	/**
	 * Database Reader
	 *
	 * @var Reader|null
	 *
	 * @since 1.0.3
	 */
	public $reader = null;

	/**
	 * Country Database Path
	 *
	 * @var string
	 *
	 * @since 1.0.3
	 */
	public $db_path = KC_US_GEO_COUNTRY_DB_PATH;

	/**
	 * Ip2Geo constructor.
	 *
	 * @param null $ip
	 *
	 * @throws \MaxMind\Db\Reader\InvalidDatabaseException
	 *
	 * @since 1.0.3
	 */
	public function __construct( $ip = null ) {

		$this->ip = $ip;

		$this->reader = new Reader( $this->db_path );
	}

	/**
	 * Get country ISO code
	 *
	 * @return string|null
	 * @throws \GeoIp2\Exception\AddressNotFoundException
	 * @throws \MaxMind\Db\Reader\InvalidDatabaseException
	 *
	 * @since 1.0.3
	 */
	public function get_country_iso_code() {
		$record = $this->reader->country( $this->ip );

		return $record->country->isoCode;
	}

}
