<?php


namespace Kaizen_Coders\Url_Shortify\Admin\Controllers;


class Tools_Controller extends Base_Controller {

	public function __construct() {

		parent::__construct();
	}

	public function render() {

		include_once KC_US_ADMIN_TEMPLATES_DIR . '/tools.php';
	}
}