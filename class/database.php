<?php
class Crud {
	public $isConn;
	public $datab;
	public $fetchType;
	public $span1;
	public $span2;

	//connect to DB
	public function __construct($username = "root", $password = "", $host = "localhost", $dbname = "pdolte", $options = array()) {
		$this->isConn = TRUE;
		try {
			$this->datab = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options);

			$this->datab->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->datab->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
			$this->datab->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		} catch (PDOException $e) {
			throw new Exception($e->getMessage());
		}

	}

	//disconnect from DB
	public function disconnect() {
		$this->datab  = NULL;
		$this->isConn = FALSE;

	}

	public function select($tblName, $fetchType = PDO::FETCH_OBJ) {
		$query = "SELECT * FROM ".$tblName."";

		if ($fetchType == "assoc") {
			$fetchType = PDO::FETCH_ASSOC;
		}

		try {
			$stmt = $this->datab->prepare($query);
			$stmt->execute();
			return $stmt->fetchAll($fetchType);
		} catch (PDOException $e) {
			throw new Exception($e->getMessage());
		}

	}

	public function selectWhere($fields, $tblName, $whereParams = array(), $fetchType = PDO::FETCH_OBJ) {
		$condition = "";
		$params    = array();

		foreach ($whereParams as $key => $value) {
			$condition .= $key." = ? AND ";
			$params[] = $value;
		}
		$condition = substr($condition, 0, -5);
		$query     = "SELECT ".$fields." FROM ".$tblName." WHERE ".$condition;

		if ($fetchType == "assoc") {
			$fetchType = PDO::FETCH_ASSOC;
		}

		try {
			$stmt = $this->datab->prepare($query);
			$stmt->execute($params);
			return $stmt->fetch($fetchType);
			// return $query;
		} catch (PDOException $e) {
			throw new Exception($e->getMessage());
		}

	}

	public function insert($tblName, $fields = array()) {
		$fieldValue = array();
		$fieldBind  = "";
		$query      = "";
		foreach ($fields as $key => $value) {
			array_push($fieldValue, $value);
			$fieldBind .= "?,";
		}

		$fieldBind = substr($fieldBind, 0, -1);

		$query = "INSERT INTO ".$tblName." ( ";
		$query .= implode(",", array_keys($fields)).") VALUES (".$fieldBind.")";
		try {
			$stmt = $this->datab->prepare($query);
			$stmt->execute($fieldValue);
			return TRUE;
		} catch (PDOException $e) {
			throw new Exception($e->getMessage());
		}
	}

	public function update($tblName, $fields = array(), $whereParams = array()) {
		$fieldToUpdate = "";
		$where         = "";
		$valueToUpdate = array();

		foreach ($fields as $key => $value) {
			$fieldToUpdate .= $key." = ? , ";
			array_push($valueToUpdate, $value);
		}

		foreach ($whereParams as $key => $value) {
			$where .= $key." = ? AND ";
			array_push($valueToUpdate, $value);
		}

		$fieldToUpdate = substr($fieldToUpdate, 0, -2);
		$fieldToUpdate = substr($where, 0, -5);
		$query         = "UPDATE ".$tblName." SET ".$fieldToUpdate." WHERE ".$fieldToUpdate."";

		try {
			$stmt = $this->datab->prepare($query);
			$stmt->execute($valueToUpdate);
			return true;
		} catch (PDOException $e) {
			throw new Exception($e->getMessage());
		}

	}

	public function delete($tblName, $where = array()) {
		$condition = "";
		$params    = array();

		foreach ($where as $key => $value) {
			$condition .= $key." = ? AND ";
			$params[] = $value;
		}
		$condition = substr($condition, 0, -5);
		$query     = "DELETE FROM ".$tblName." WHERE ".$condition;
		try {
			$stmt = $this->datab->prepare($query);
			$stmt->execute($params);
			return TRUE;
		} catch (PDOException $e) {
			throw new Exception($e->getMessage());
		}
	}

	public function isiContent($category = array()) {
		$query = "SELECT * FROM nav_menu WHERE url= ? ";

		try {
			$stmt = $this->datab->prepare($query);
			$stmt->execute($category);
			$data = $stmt->fetch();

			if (isset($data->id)) {
				if (file_exists($data->file.".php")) {
					include $data->file.".php";
				} else {
					include "404.php";
				}

			} else {
				include "404.php";
			}
		} catch (PDOException $e) {
			throw new Exception($e->getMessage());
		}
		// return true;
	}

	function dataMenu($params = array('ACTIVE', 'possition')) {
		$data  = array();
		$query = "SELECT * FROM nav_menu WHERE active = ? ORDER BY ? ASC";
		$stmt  = $this->datab->prepare($query);
		$stmt->execute($params);
		$rsMn = $stmt->fetchAll();
		foreach ($rsMn as $smn) {
			$data[$smn->parent_id][] = $smn;
		}
		return $data;
	}

	function getMenu($data, $parent = 0) {
		static $i = 1;
		$html     = "";
		$span1    = "";
		$span2    = "";
		$tab      = str_repeat("\t\t", $i);
		if (isset($data[$parent])) {
			if ($i == 1) {
				$html = "\n$tab<ul class='sidebar-menu' data-widget='tree'>";
				$html .= "<li class='header'>Menu</li>";

			} else {
				if ($parent == 0) {
					$html .= "\n$tab<ul class='treeview'>";

				} else {

					$html .= "\n$tab<ul class='treeview-menu'>";

				}

			}

			$i++;
			foreach ($data[$parent] as $v) {
				if ($v->parent_id == "0") {
					// $treeMenu = "treeview";
					$span1 = "<span>";
					$span2 = "</span>";
				} else {
					$treeMenu = "";
				}
				$child                 = $this->getMenu($data, $v->id);
				if ($child) {$treeMenu = "treeview";} else { $treeMenu = "";}
				$html .= "\n\t$tab<li class='$treeMenu'>";
				if ($v->file == '#') {
					// use icon ==> $html .= '<a href="#"><span class="ui-icon ui-icon-home"></span>'.$v->menu_name.'</a>';
					$html .= '<a href="#">';
				} else {
					// use icon ==> $html .= '<a href="'.$_SERVER['PHP_SELF']."?ct=".$v->category.'"><span class="ui-icon ui-icon-home"></span>'.$v->menu_name.'</a>';
					$html .= "<a href='index.php?page=$v->url'>";
				}
				$html .= "\n\t$tab<i class='$v->i_class'></i>";
				$html .= "\n\t".$tab.$span1.$v->name." ".$span2;
				if ($child) {
					$html .= "\n\t$tab<span class='pull-right-container'>";
					$html .= "\n\t$tab<i class='fa fa-angle-left pull-right'></i>";
					$html .= "\n\t$tab</span>";
				}

				$html .= "</a>";
				if ($child) {
					$i--;
					$html .= $child;
					$html .= "\n\t$tab";
				}
				$html .= '</li>';
			}
			$html .= "\n$tab</ul>";
			return $html;
		} else {
			return false;
		}
	}

}