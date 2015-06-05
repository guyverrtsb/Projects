<?php
	require_once('../includes/app_top.php');
	require_once('../includes/mysql.class.php');
	require_once('../includes/global.inc.php');
	require_once('../includes/functions_general.php');
	require_once('../includes/user.class.php');
	require_once('../includes/follow.class.php');
	
	
//http://demo2server.com/sites/mobile/expressit/services/ws-search.php?type=search&data=[{"userid":"1","country":"india"}]	


function userSearch($userid,$country)
{
	global $db;
	$msg=	'';
	$status="false";
	$USER	=	new USER_CLASS;
	$FOLLOW = new FOLLOW_CLASS;
	$userinfo	=	array();
	if ($userid=="")
		$msg="Invalid userid";
	else{
				
			$sql		=	"select * from post where UPPER(country) like  '%".strtoupper($country)."%' order by  postid ASC ";
			$result		=	$db->query($sql);
			if($result->size()>0)
			{
				while($rs	=	$result->fetch())
				{
					$userInfo			=	$USER->getUserInfo($rs['userid']);
					$rs['name']			=	$userInfo['name'];
					$rs['username']		=	$userInfo['username'];
					$rs['userphoto']	=	$userInfo['user_thumbimage'];
					
					$rs['totalcomment']	=	$USER->countTotalComment($rs['postid']);
					$rs['totallike']	=	$USER->getTotalLike($rs['postid']);
					$rs['totaldislike']	=	$USER->getTotalDislike($rs['postid']);
					$rs['likestatus']	=	$USER->getLikeStatus($userid,$rs['postid']);
					$rs['reportstatus']	=	$USER->getReportStatus($userid,$rs['postid']);
					$rs['follow_status'] =	"". $FOLLOW->getUserStatus($userid,$rs['userid'],"FOLLOWING")."";
					$rs['time_text']	=	$USER->getTimeInfo($rs['dtdate'], date("Y-m-d H:i:s"), "x");
					
					$userinfo[]	=	$rs;
				}
					
					$msg="Successfully";
					$status="true";
				
			}else
				$msg="No post in this area";
		}
	
		
		$arr=array("message"=>$msg,"data"=>$userinfo,"status"=>$status);
		return $arr;
		
}

$arr=array();
if (strtoupper($_REQUEST['type'])=="SEARCH")
{
	$data		=	json_decode(str_replace("\\","",$_GET['data']));
	$userid		=	escapeChars($data[0]->userid);
	$country	=	escapeChars($data[0]->country);
	$arr		=	userSearch($userid,$country);
	echo json_encode($arr);
}
