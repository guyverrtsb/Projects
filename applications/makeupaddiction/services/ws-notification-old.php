<?php
	require_once('../includes/app_top.php');
	require_once('../includes/mysql.class.php');
	require_once('../includes/global.inc.php');
	require_once('../includes/functions_general.php');
	require_once('../includes/user.class.php');
	$dateformat="%m-%d-%Y";
//http://www.demo2server.com/sites/mobile/expressit/services/ws-notification.php?type=get&data=[{"userid":"1"}]
//http://demo2server.com/sites/mobile/expressit/services/ws-notification.php?type=ADDLAST&data=[{"total":"2","userid":"2"}]
//http://demo2server.com/sites/mobile/expressit/services/ws-notification.php?type=VIEWLAST&data=[{"userid":"2"}]

function tag($string)
{
	  $string = str_replace ( "(", ' ', $string );
	  $string = str_replace ( ')', ' ', $string );
	 
	  return $string;
}

function getAllNotification($userid){
	global $db;
	$status ="false";
	$msg	=	'';
	$USER = new USER_CLASS;
	$comment = array();
	$i=0;
	$latestcomment	=array();
	if ($userid<=0 || $userid=="")
		$msg="Invlid user or post";
	else{
			
			$sql="select id as notificationid, dtdate,userid,mainid as postid, msg, type, isread from notification where ((mainid in(select postid from post where userid=".$userid.") and type!='FOLLOW')  or (ref_id in(select id from user_follow where following_id=".$userid." and status=1) and type='FOLLOW'))  and userid !=".$userid." order by dtdate DESC";
			
		$result = $db->query($sql);
		if ($result->size()>0){
			while ($rs=$result->fetch($sql)){
				$i++;
				$posttype	=	'';
				$userInfo	=	$USER->getUserInfo($rs['userid']);
				//print_r($userInfo);
				if($rs['type'] == "LIKE" || $rs['type'] == "UNLIKE" || $rs['type'] == "COMMENT")
				{
					$sqlpost	=	"select thumpath,fullpath,posttype, userid from post where postid=".$rs['postid'];
					$resultpost	=	$db->query($sqlpost);
					$rows		=	$resultpost->fetch();
					$rs['postuserid']	=	$rows['userid'];
					$rs['thumpath']	=	$rows['thumpath'];
					$rs['fullpath']	=	$rows['fullpath'];
					$posttype		=	$rows['posttype'];
					$rs['posttype']	=	$posttype;
					
					if($posttype == "TEXT")
						$posttype	=	"post";
					elseif($posttype == "IMAGE")
						$posttype	=	"photo";
					
					$posttype	=	strtolower($posttype);
					
				}
				
				if (strtoupper($rs['type'])=="LIKE")
					$rs['text']	=	$userInfo['username'].": liked your ".$posttype;
				if (strtoupper($rs['type'])=="UNLIKE")
					$rs['text']	=	$userInfo['username'].": unliked your ".$posttype;
				elseif (strtoupper($rs['type'])=="COMMENT")
					$rs['text']	=	$userInfo['username'].": commented on your ".$posttype;
				elseif (strtoupper($rs['type'])=="FOLLOW")
					$rs['text']	=	$userInfo['username'].": started following you";
					
				$rs['name']			=	$userInfo['name'];
				$rs['username']		=	$userInfo['username'];
				$rs['userphoto']	=	$userInfo['user_thumbimage'];
				$rs['time_text']	=	$USER->getTimeInfo_notification($rs['dtdate'], date("Y-m-d H:i:s"), "x");
				$rs['dtdate']		=	date("Y-m-d H:i:s",strtotime($rs['dtdate']));
				$comment[] =  $rs;
				
				$db->query("UPDATE `notification` SET `isread`='1' WHERE id =".$rs['notificationid']);
			}
			$msg	=	'Successfully';
			$status="true";
		}
		else
			$msg="There is no recent activity on your posts.";
	}
		$arr=array("message"=>$msg,"data"=>$comment,"total_record"=>"".$i."","status"=>$status);
		return $arr;
}


$arr=array();

if (isset($_REQUEST['type']) && $_REQUEST['type']!=""){
	$data=array();
	
	if (strtoupper($_REQUEST['type'])=="GET"){
		$data=json_decode(str_replace("\\","",$_GET['data']));

		$userid		=	(trim($data[0]->userid));
		$arr=getAllNotification($userid);
		//echo "<pre>";
		//print_r($arr);die;
		echo json_encode($arr);
	}
	
}

