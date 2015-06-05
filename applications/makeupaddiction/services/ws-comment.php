<?php
require_once('../includes/app_top.php');
require_once('../includes/mysql.class.php');
require_once('../includes/global.inc.php');
require_once('../includes/functions_general.php');
require_once('../includes/user.class.php');
require_once('../includes/signature.class.php');


$SIGNATURE = new SIGNATURE;



if (isset($_REQUEST['type']) && $_REQUEST['type'] != "") {

	$data = array();



	if (strtoupper($_REQUEST['type']) == "ADD") {

		$data = json_decode($_GET['data']);



		$userid = (trim($data[0]->userid));

		$postid = (trim($data[0]->postid));


		$comment = specialCharRemove(trim($data[0]->comment));
		if ($SIGNATURE->checkValidRequest($_REQUEST)) {
			$arr = addComment($userid, $postid, $comment, $type, $gpsstatus, $location, $city, $state, $country, $lat, $lng);
		}

		echo json_encode($arr);
	}



	if (strtoupper($_REQUEST['type']) == "GET") {

		$data = json_decode(str_replace("\\", "", $_GET['data']));

		$userid = (trim($data[0]->userid));

		$postid = (trim($data[0]->postid));

		$arr = getAllComment($userid, $postid, $type);

		echo json_encode($arr);
	}
}



