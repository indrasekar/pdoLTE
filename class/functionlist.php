<?php

function sex($type) {
	if ($type == "l") {
		$sex = "Laki-laki";
	} elseif ($type == "p") {
		$sex = "Perempuan";
	}
	return $sex;
}

function active($type) {
	if ($type == "1") {
		$status = "Active";
	} elseif ($type == "0") {
		$status = "Inactive";
	}
	return $status;
}