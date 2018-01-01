<?php
require_once "database.php";
class FunctionList extends Crud{
	function sex($alias) {
		$sex = $this->selectWhere("sex","m_sex",array('alias'=>$alias));
		return $sex->sex;
	}
	function active($alias) {
		$status = $this->selectWhere("status","m_active_status",array('alias'=>$alias));
		return $status->status;
	}
}