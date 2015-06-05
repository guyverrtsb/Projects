<?php
require_once('../includes/app_top.php');
require_once('../includes/mysql.class.php');
require_once('../includes/global.inc.php');
require_once('../includes/functions_general.php');
require_once('../includes/user.class.php');
require_once('../includes/signature.class.php');


$SIGNATURE = new SIGNATURE;

$dateformat = "%m-%d-%Y";

///for add space by post method
//url : http://projectmanager/selfieheat/services/ws-report.php?type=add&signature=6c231dc4bbbccfed9e2f494caafde1c4cb829707&data=[{"userid":"4","postid":"1","report_txt":"test"}]

function addReport($rs) {

	global $db;

	$status = "false";



	$userid = security(trim($rs[0]->userid));

	$postid = security(trim($rs[0]->postid));

	$report = escapeChars(trim($rs[0]->report_txt));





	if ($userid <= 0 || $postid <= 0)
		$msg = "Invalid selected user & post";

	else {



		$sql1 = "select * from post_report where user_id = '" . $userid . "' AND post_id =" . $postid;

		$result1 = $db->query($sql1);

		if ($result1->size() <= 0) {



			$sql = "INSERT INTO post_report(user_id,post_id,report_txt,dtdate)VALUES(" .
					"'" . $userid . "'," .
					"'" . $postid . "'," .
					"'" . $report . "'," .
					" NOW() " .
					")";

			$db->query($sql);





			$msg = "Report has been sent successfully";

			$status = "true";
		} else
			$msg = "You cannot report the same post more than once.";
	}

	$arr = array("message" => $msg, "status" => $status);

	return $arr;
}

$arr = array();

if (strtoupper($_REQUEST['type']) == "ADD") {

	$data = json_decode(str_replace("\\", "", $_GET['data']));
	if ($SIGNATURE->checkValidRequest($_REQUEST)) {
		$arr = addReport($data);
	}
	echo json_encode($arr);
}







