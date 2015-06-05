<?php
require_once('../includes/app_top.php');
require_once('../includes/mysql.class.php');
require_once('../includes/global.inc.php');
require_once('../includes/functions_general.php');
require_once('../includes/user.class.php');
//require_once('../includes/push-notification.php');
require_once('../includes/signature.class.php');


$SIGNATURE = new SIGNATURE;

//http://projectmanager/selfieheat/services/ws-like.php?type=like&signature=a99a62087345044cb15eb0654bf82e3d6a249d3d&data=[{"userid":"1","postid":"1","status":"1"}]


function setNotificationLike($type, $userid, $postid) {
	global $db;

	$type = $type;

	$userid = intval($userid);
	$postid = intval($postid);
	$chk_sql = "SELECT * FROM user_notification WHERE user_id='" . $userid . "' AND post_id='" . $postid . "' AND type='" . $type . "'";
	$exe_sql = $db->query($chk_sql);
	if ($exe_sql->size() <= 0) {

		$sql_notifi = "INSERT INTO user_notification (type,user_id,post_id,dtdate) VALUES (" .
				"'" . $type . "'," .
				"" . $userid . "," .
				"" . $postid . "," .
				"NOW())";
		$db->query($sql_notifi);
	}



	//return "1";
}

function updateLikeDislike($userid, $postid, $likeStatus) {

	global $db;

	$USER = new USER_CLASS;

	//$NOTIFI = new NOTIFICATION;

	$status = "false";

	$info = array();

	if (($userid == "" || $userid <= 0) || ($postid <= 0 || $postid == ""))
		$msg = "Invalid user or post";
	else
		$sql1 = "select * from post where post_id=" . $postid . "  ";

	$result1 = $db->query($sql1);



	if ($result1->size() > 0) {

		$sql = "select * from post_like where user_id=" . $userid . " and post_id=" . $postid . "  ";

		$result = $db->query($sql);



		if ($result->size() > 0) {

			$rows = $result->fetch();

			$likeid = $rows['id'];

			$lkstatus = $rows['like_status'];


			$sql = "UPDATE post_like SET like_status = '" . $likeStatus . "' WHERE user_id=" . $userid . " and post_id=" . $postid . "";

			$result = $db->query($sql);
		} else {

			$sql = "INSERT INTO post_like (post_id,user_id,like_status,dtdate)VALUES(" .
					"'" . $postid . "'," .
					"'" . $userid . "'," .
					"'" . $likeStatus . "'," .
					"NOW())";



			$result = $db->query($sql);

			$likeid = $result->insertID();
		}
		$type = "vote";
		setNotificationLike($type, $userid, $postid);

		if ($result) {

			/*$info['totallike'] = $USER->getTotalLike($postid);

			$info['totaldislike'] = $USER->getTotalDislike($postid);*/

			$info['totalvote'] = $USER->getTotalVote($postid);

			$info['likestatus'] = $USER->getLikeStatus($userid, $postid);

			$status = "true";



			$msg = "Successfully update like status";
		}
	} else
		$msg = "Post not found.";

	$arr = array("message" => $msg, "data" => $info, "status" => $status);

	return $arr;
}

$arr = array();



if (isset($_REQUEST['type']) && $_REQUEST['type'] != "") {

	$data = array();

	if (strtoupper($_REQUEST['type']) == "LIKE") {

		$data = json_decode(str_replace("\\", "", $_GET['data']));

		$userid = (trim($data[0]->userid));

		$postid = (trim($data[0]->postid));

		$status = (trim($data[0]->status));
		if ($SIGNATURE->checkValidRequest($_REQUEST)) {
			$arr = updateLikeDislike($userid, $postid, $status);
		}

		echo json_encode($arr);
	}
}



