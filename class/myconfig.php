<?php
require_once "database.php";
class Config extends Crud {
	public $data;
	public function __construct() {
		parent::__construct();
	}

	public function siteConfig($params) {
		$fields      = 'value';
		$tblName     = 'site_config';
		$whereParams = array('name' => "$params");
		$data        = $this->selectWhere($fields, $tblName, $whereParams, null);
		return $data->value;
	}

}