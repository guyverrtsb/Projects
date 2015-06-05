<?php
require_once('../includes/app_top.php');
require_once('../includes/mysql.class.php');
require_once('../includes/global.inc.php');
require_once('../includes/functions_general.php');
require_once('../includes/user.class.php');
require_once('../includes/signature.class.php');


$SIGNATURE = new SIGNATURE;

$dateformat = "%m-%d-%Y";

//http://projectmanager/selfieheat/services/ws-notification.php?type=get&signature=1d56b5cdc733a198f71ca96525eaed086ced723a&data=[{"userid":"1"}]
//http://demo2server.com/sites/mobile/expressit/services/ws-notification.php?type=ADDLAST&data=[{"total":"2","userid":"2"}]
//http://demo2server.com/sites/mobile/expressit/services/ws-notification.php?type=VIEWLAST&data=[{"userid":"2"}]



function tag($string) {

	$string = str_replace("(", ' ', $string);

	$string = str_replace(')', ' ', $string);



	return $string;
}

function getAllNotification($userid) {

	global $db;

	$status = "false";

	$msg = '';

	$USER = new USER_CLASS;

	$comment = array();

	$i = 0;

	$latestcomment = array();

	if ($userid <= 0 || $userid == "")
		$msg = "Invlid user or post";

	else {



		//$sql = "select id as notificationid, dtdate,userid,mainid as postid, msg, type, isread from user_notification where ((post_id in(select post_id from post where userid=" . $userid . ") and type!='FOLLOW')  or (user_id in(select id from user_follow where following_id=" . $userid . " and status=1) and type='FOLLOW'))  and userid !=" . $userid . " order by dtdate DESC";

		$sql = "SELECT * FROM user_notification WHERE user_id='" . $userid . "'";



		$result = $db->query($sql);

		if ($result->size() > 0) {

			while ($rs = $result->fetch($sql)) {

				$i++;

				$posttype = '';

				$userInfo = $USER->getUserInfo($rs['user_id']);

				//print_r($userInfo);

				if (strtoupper($rs['type']) == "VOTE" || strtoupper($rs['type']) == "COMMENT") {

					$sqlpost = "select thumb_image,image, user_id from post where post_id=" . $rs['post_id'];

					$resultpost = $db->query($sqlpost);

					$rows = $resultpost->fetch();

					$rs['postuserid'] = $rows['user_id'];

					$rs['post_thumpath'] = $rows['thumb_image'];

					$rs['post_fullpath'] = $rows['image'];





					$posttype = strtolower($posttype);
				}



				if (strtoupper($rs['type']) == "VOTE")
					$rs['text'] = $userInfo['name'] . ": voted on your post ";

				/* if (strtoupper($rs['type']) == "UNLIKE")
				  $rs['text'] = $userInfo['username'] . ": unliked your " . $posttype; */

				elseif (strtoupper($rs['type']) == "COMMENT")
					$rs['text'] = $userInfo['name'] . ": commented on your post ";

				elseif (strtoupper($rs['type']) == "FOLLOW")
					$rs['text'] = $userInfo['name'] . ": started following you";



				$rs['name'] = ($userInfo['name'] != '') ? $userInfo['name'] : '';

				$rs['username'] = ($userInfo['user_name'] != '') ? $userInfo['user_name'] : '';

				$rs['userphoto'] = ($userInfo['user_thumbimage'] != '') ? $userInfo['user_thumbimage'] : '';

				$rs['time_text'] = $USER->getTimeInfo_notification($rs['dtdate'], date("Y-m-d H:i:s"), "x");

				$rs['dtdate'] = date("Y-m-d H:i:s", strtotime($rs['dtdate']));

				$comment[] = $rs;



				$db->query("UPDATE `user_notification` SET `is_view`='1' WHERE id =" . $rs['id']);
			}

			$msg = 'Successfully';

			$status = "true";
		} else
			$msg = "There is no recent activity on your posts.";
	}

	$arr = array("message" => $msg, "data" => $comment, "total_record" => "" . $i . "", "status" => $status);

	return $arr;
}

$arr = array();



if (isset($_REQUEST['type']) && $_REQUEST['type'] != "") {

	$data = array();



	if (strtoupper($_REQUEST['type']) == "GET") {

		$data = json_decode(str_replace("\\", "", $_GET['data']));



		$userid = (trim($data[0]->userid));
		if ($SIGNATURE->checkValidRequest($_REQUEST)) {
			$arr = getAllNotification($userid);
		}



		echo json_encode($arr);
	}
}



