<?php

namespace Kaizen_Coders\Url_Shortify\Admin;

use Kaizen_Coders\Url_Shortify\Admin\DB\Groups;
use Kaizen_Coders\Url_Shortify\Admin\DB\Links;
use Kaizen_Coders\Url_Shortify\Helper;

class Group_Stats {
	/**
	 * Group ID
	 *
	 * @var null
	 *
	 * @since 1.1.3
	 */
	public $group_id = null;

	/**
	 * Groups db object
	 *
	 * @var Groups|null
	 *
	 * @since 1.1.3
	 */
	public $db = null;

	/**
	 * Link_Stats constructor.
	 *
	 * @param null $group_id
	 *
	 * @since 1.0.4
	 */
	public function __construct( $group_id = null ) {

		$this->group_id = $group_id;

		$this->db = new Groups();

	}

	/**
	 * Render Link stats page
	 *
	 * @since 1.0.4
	 */
	public function render() {

	}


}
