<?php
	require_once('../includes/app_top.php');
	require_once('../includes/mysql.class.php');
	require_once('../includes/global.inc.php');
	require_once('../includes/functions_general.php');
	require_once('../includes/user.class.php');
	require_once("../includes/follow.class.php");
	
	$dateformat="%m-%d-%Y";
	///for add space by post method
	
	//http://demo2server.com/sites/mobile/expressit/services/ws-user-profile.php?type=get&data=[{"userid":"1"}]
//http://demo2server.com/sites/mobile/expressit/services/ws-user-profile.php?type=VERIFY&data=[{"email":"ramniwas@ninehertzindia.com"}]	
//http://demo2server.com/sites/mobile/expressit/services/ws-user-profile.php?type=DEACTIVE&data=[{"userid":"1"}]
//http://demo2server.com/sites/mobile/expressit/services/ws-user-profile.php?type=delete&data=[{"userid":"1"}]
//http://demo2server.com/sites/mobile/expressit/services/ws-user-profile.php?type=update&data=[{"userid":"1","location":"test"}]
//http://demo2server.com/sites/mobile/expressit/services/ws-user-profile.php?type=logout&data=[{"token":"ef1313e3a3c11eb2e425b1fd30367af95fe81fdf4f125c1356ef1a854febd3a8"}]
//url : services/ws-user-profile.php?type=RESET&data=[{"token":"1321321"}]
//http://demo2server.com/sites/mobile/expressit/services/ws-user-profile.php?type=updatenotifi&data=[{"token":"1","notification":"1","notifitype":"LIKE"}]
//http://demo2server.com/sites/mobile/expressit/services/ws-user-profile.php?type=GETNOTIFI&data=[{"userid":"1"}]
function getProfile($userid)
{
	global $db;
	$USER = new USER_CLASS;
	$userArray=	array();
	
	$text	=	array();
	$audio	=	array();
	$video	=	array();
	$image	=	array();
	
	$msg=	'';
	$status="false";
	if (($userid=="" || $userid<=0))
		$msg="Invalid User Id";
	else{
			$userArray=	$USER->getUserInfo($userid);
			
			$userArray['totalfollower']	=	'0';
			$userArray['totalfollowing']	=	'0';
			$userArray['totalimage']	=	'0';
			$userArray['totalvideo']	=	'0';
			$userArray['totalaudio']	=	'0';
			
			$sql		=	"select * from post where userid=".$userid."";
			$result		=	$db->query($sql);
			if($result->size()>0)
			{
				while($rs	=	$result->fetch())
				{
					$rs['time_text']	=	$USER->getTimeInfo($rs['dtdate'], date("Y-m-d H:i:s"), "x");
					if($rs['posttype'] == "TEXT")
						$text[]		=	$rs;
					if($rs['posttype'] == "AUDIO")
						$audio[]	=	$rs;
					if($rs['posttype'] == "VIDEO")
						$video[]	=	$rs;
					if($rs['posttype'] == "IMAGE")
						$image[]	=	$rs;
				}
			}
			
			$msg="Successfully";
			$status="true";
		}
	
		
		$arr=array("message"=>$msg,"detail"=>$userArray,"text"=>$text,"audio"=>$audio,"video"=>$video,"image"=>$image,"status"=>$status);
		return $arr;
		
}
function getNotification($token)
{
	global $db;
	$USER = new USER_CLASS;
	$data=	array();
	
	$msg=	'';
	$status="false";
	if ($token=="")
		$msg="Invalid token";
	else{
			
			$sql		=	"select notification AS follow, is_comment, is_like, is_chainnotify, expressnews, myworld from user_token where UPPER(deviceid)='".strtoupper($token)."'";
			$result		=	$db->query($sql);
			if($result->size()>0)
			{
				while($rs	=	$result->fetch())
				{
					$data[]	=	$rs;
				}
				$msg="Successfully";
				$status="true";
			}else
				$msg=	'Please logout and try again';
		}
		$arr=array("message"=>$msg,"detail"=>$data,"status"=>$status);
		return $arr;
		
}
function emailResend($email)
{
	global $db;
	$msg=	'';
	$status="false";
	if ($email=="")
		$msg="Invalid email";
	else{
			$sql		=	"select * from users where UPPER(email)='".strtoupper($email)."'";
			$result		=	$db->query($sql);
			if($result->size()>0)
			{
				$rs	=	$result->fetch();
				if($rows['email_verify']==1)
				{
					$msg	=	"Email already activated. ";
				}else
				{
					$code	=	randomcode(50);
					$sql="UPDATE users SET token ='".$code."' WHERE userid = ".$rs['userid'];
					$result=$db->query($sql);
					
					$link	=	base_path."activate.php?email=".$email."&token=".$code;
					$post	=	'';
					$post.="<div style=' width:700px; margin:0 auto'> ";
					$post.="<div style='background:#fff; border:#888 solid 1px; border-radius:15px; margin-top:20px; padding:20px; box-shadow:0 0 8px #999'>";					
					$post.="<div style='border-bottom:1px solid #ccc; padding-bottom:18px;'> ";
					$post.="<img style=' width:250px;' src='".base_path."/uploads/logo.png' /></div> ";
					$post.="<div style='font-size:16px; padding-top:20px;'>";
					$post.="<p>Hi ".$rs['name'].",</p>";
					//$post.="<p>Date: ".date("m-d-Y h:i:s A")."</p> ";
					//$post.="<p>Name: ".$rs['name']."</p>";
					$post.="<p>Your registered email is: ".$email."</p>";
					$post.="<p>Please click the link below to confirm the activation of you account.</p>";
					$post.="<p>Link: ".$link."</p>";
					$post.="<p>Best,</p>";
					$post.="<p>Express It Team</p>";
					$post.="</div> </div> </div> ";
						
					send_mail($email, "Registration Confirmation Required", $post);
					
					
					$msg="Verification email sent.";
					$status="true";
				}
			}else
				$msg="Email ID does'nt exist .";
		}
	
		
		$arr=array("message"=>$msg,"status"=>$status);
		return $arr;
		
}
function userDelete($userid)
{
	global $db;
	$USER = new USER_CLASS;
	$msg=	'';
	$status="false";
	if (($userid=="" || $userid<=0))
		$msg="Invalid User Id";
	else{
			$code	=	randomcode(40);
			$sql	=	" UPDATE users SET  ".
						" token 	= 	'".$code."', status = '0', ".
						" ac_delete_date = NOW() WHERE userid = ".$userid;
			$db->query($sql);
			$userArray=	$USER->getUserInfo($userid);
			$deletelink	=	base_path."user-delete.php?type=delete&token=".$code;
			$activelink	=	base_path."user-delete.php?type=active&token=".$code;
			
			$post	=	'';
			$post.="<div style=' width:700px; margin:0 auto'> ";
			$post.="<div style='background:#fff; border:#888 solid 1px; border-radius:15px; margin-top:20px; padding:20px; box-shadow:0 0 8px #999'>";					
			$post.="<div style='border-bottom:1px solid #ccc; padding-bottom:18px;'> ";
			$post.="<img style=' width:250px;' src='".base_path."/uploads/logo.png' /></div> ";
			$post.="<div style='font-size:16px; padding-top:20px;'>";
			$post.="<p>Hi ".$userArray['name'].",</p>";
			//$post.="<p>Date: ".date("m-d-Y h:i:s A")."</p> ";
			//$post.="<p>Name: ".$userArray['name']."</p>";
			$post.="<p>Your registered email is: ".$userArray['email']."</p>";
			$post.="<p>This link is only valid for THE next 72 hours.</p>";
			$post.="<p>Delete Link: ".$deletelink."</p>";
			$post.="<p>Active Link: ".$activelink."</p>";
			$post.="<p>Thank you,</p>";
			$post.="<p>Express It Team</p>";
			$post.="</div> </div> </div> ";
			send_mail($userArray['email'], "Account Delete", $post);
			/*$sqllike="delete from postlike where userid =".$userid;
			$db->query($sqllike);
			$sqllike="delete from postlike where postid in (select postid from post where userid =".$userid.")";
			$db->query($sqllike);
			$sqlComment="delete from comment where userid =".$userid;
			$db->query($sqlComment);
			$sql="delete from report where userid =".$userid;
			$db->query($sql);
			$sql="delete from report where postid in (select postid from post where userid =".$userid.")";
			$db->query($sql);
			$sql="delete from post where userid=".$userid;
			$db->query($sql);
			$sql="delete from user_follow where follower_id=".$userid." OR following_id=".$userid;
			$db->query($sql);
			$sql="delete from users where userid=".$userid;
			$db->query($sql);*/
			$msg="Successfully";
			$status="true";
		}
		$arr=array("message"=>$msg,"status"=>$status);
		return $arr;
}
function accountDeActive($userid)
{
	global $db;
	$USER = new USER_CLASS;
	$msg=	'';
	$status="false";
	if (($userid=="" || $userid<=0))
		$msg="Invalid User Id";
	else{
			$code	=	randomcode(40);
			$sql	=	" UPDATE users SET  ".
						" token 	= 	'".$code."', status = '1', ".
						" ac_delete_date = NOW() WHERE userid = ".$userid;
			$db->query($sql);
			$userArray=	$USER->getUserInfo($userid);
			$activelink	=	base_path."user-deactive.php?token=".$code;
			
			$post	=	'';
			$post.="<div style=' width:700px; margin:0 auto'> ";
			$post.="<div style='background:#fff; border:#888 solid 1px; border-radius:15px; margin-top:20px; padding:20px; box-shadow:0 0 8px #999'>";					
			$post.="<div style='border-bottom:1px solid #ccc; padding-bottom:18px;'> ";
			$post.="<img style=' width:250px;' src='".base_path."/uploads/logo.png' /></div> ";
			$post.="<div style='font-size:16px; padding-top:20px;'>";
			$post.="<p>Hi ".$userArray['name'].",</p>";
			//$post.="<p>Date: ".date("m-d-Y h:i:s A")."</p> ";
			//$post.="<p>Name: ".$userArray['name']."</p>";
			$post.="<p>Your registered email is: ".$userArray['email']."</p>";
			$post.="<p>This link is only valid for THE next 72 hours.</p>";
			$post.="<p>Deactive Link: ".$activelink."</p>";
			$post.="<p>Thank you,</p>";
			$post.="<p>Express It Team</p>";
			$post.="</div> </div> </div> ";
			send_mail($userArray['email'], "Account Deactive", $post);
			
			$msg="Successfully";
			$status="true";
		}
		$arr=array("message"=>$msg,"status"=>$status);
		return $arr;
}
function updateLocation($userid,$location,$city,$state,$country,$lat,$lng)
{
	global $db;
	
	$msg=	'';
	$status="false";
	if (($userid=="" || $userid<=0))
		$msg="Invalid User Id";
	else{
				$sql		=	"select * from users where userid=".$userid."";
                $result		=	$db->query($sql);
                if($result->size()>0)
                {
                    $sqlupdate  =   "UPDATE users SET " .
									" location = '".$location."',".
									" city		 = '".$city."',".
									" state		 = '".$state."',".
									" country	 = '".$country."',".
									" lat		 = '".$lat."',".
									" lng		 = '".$lng."'".
									" WHERE userid = ".$userid;
                    $db->query($sqlupdate);
                        $msg="Successfully";
                        $status="true";
                }else
                    $msg    =   "User not found.";
	}
		
        $arr=array("message"=>$msg,"status"=>$status);
        return $arr;
		
}
function updateNotification($token,$notification,$notifitype)
{
	global $db;
	
	$msg=	'';
	$status="false";
	if ($token=="" || $notifitype == '')
		$msg="Invalid token";
	else{
		
		$feild	=	"notification";
		$notifitype	=	strtoupper($notifitype);
		if($notifitype == "LIKE")
			$feild	=	"is_like";
		elseif($notifitype == "CHAINNOTIFY")
			$feild	=	"is_chainnotify";
		elseif($notifitype == "COMMENT")
			$feild	=	"is_comment";
		elseif($notifitype == "EXPRESSNEWS")
			$feild	=	"expressnews";
		elseif($notifitype == "MYWORLD")
			$feild	=	"myworld";
		
				$sql		=	"select * from user_token where UPPER(deviceid)='".strtoupper($token)."'";
                $result		=	$db->query($sql);
                if($result->size()>0)
                {
                   $sqlupdate  =   "UPDATE user_token SET ".$feild." = '".$notification."' WHERE UPPER(deviceid) = '".strtoupper($token)."'";
                    $db->query($sqlupdate);
                        $msg="Successfully";
                        $status="true";
                }else
                    $msg    =   "User not found.";
	}
		
        $arr=array("message"=>$msg,"status"=>$status);
        return $arr;
		
}
function userLogout($token){
global $db;
$status="false";
$msg	=	'';
if ($token=="")
	$msg="Invalid token";
else{
	
	$sql	=	" DELETE FROM `user_token` WHERE UPPER(`deviceid`) ='".strtoupper($token)."'";
	$db->query($sql);
	$status="true";
	$msg="Logout successfully";
	
}
$arr=array("message"=>$msg,"status"=>$status);
return $arr;		
}
function updateBedge($deviceid){
	global $db;
	$status="false";
	if ($deviceid =="")
		$msg="Invalid credentials";
	else
	{
		$sql="update user_token set bedge=0 where UPPER(deviceid)='".strtoupper($deviceid)."'";
		$query	=	$db->query($sql);
		if ($query)
		{
			$msg="Successfully";
			$status="true";
		}
	}
	$arr=array("message"=>$msg,"token"=>"".$deviceid."","status"=>$status);
	return $arr;
	
}
$arr=array();
if (strtoupper($_REQUEST['type'])=="GET")
{
	$data	=	json_decode(str_replace("\\","",$_GET['data']));
	$userid	=	escapeChars($data[0]->userid);
	$arr	=	getProfile($userid);
	echo json_encode($arr);
}
if (strtoupper($_REQUEST['type'])=="GETNOTIFI")
{
	$data	=	json_decode(str_replace("\\","",$_GET['data']));
	$token	=	escapeChars($data[0]->token);
	$arr	=	getNotification($token);
	echo json_encode($arr);
}
if (strtoupper($_REQUEST['type'])=="UPDATE")
{
	$data	=	json_decode(str_replace("\\","",$_GET['data']));
	$userid	=	escapeChars($data[0]->userid);
    $location=	escapeChars($data[0]->location);
	
	$city	=	escapeChars($data[0]->city);
	$state	=	escapeChars($data[0]->state);
	$country=	escapeChars($data[0]->country);
	$lat	=	escapeChars($data[0]->lat);
	$lng	=	escapeChars($data[0]->lng);
	
	$arr	=	updateLocation($userid,$location,$city,$state,$country,$lat,$lng);
	echo json_encode($arr);
}
if (strtoupper($_REQUEST['type'])=="UPDATENOTIFI")
{
	$data	=	json_decode(str_replace("\\","",$_GET['data']));
	$token		=	escapeChars($data[0]->token);
    $notification=	escapeChars($data[0]->notification);
	$notifitype=	escapeChars($data[0]->notifitype);
	$arr	=	updateNotification($token,$notification,$notifitype);
	echo json_encode($arr);
}
if (strtoupper($_REQUEST['type'])=="DELETE")
{
	$data	=	json_decode(str_replace("\\","",$_GET['data']));
	$userid	=	escapeChars($data[0]->userid);
	$arr	=	userDelete($userid);
	echo json_encode($arr);
}
if (strtoupper($_REQUEST['type'])=="DEACTIVE")
{
	$data	=	json_decode(str_replace("\\","",$_GET['data']));
	$userid	=	escapeChars($data[0]->userid);
	$arr	=	accountDeActive($userid);
	echo json_encode($arr);
}
if (strtoupper($_REQUEST['type'])=="VERIFY")
{
	$data	=	json_decode(str_replace("\\","",$_GET['data']));
	$email	=	escapeChars($data[0]->email);
	$arr	=	emailResend($email);
	echo json_encode($arr);
}
if (strtoupper($_REQUEST['type'])=="LOGOUT")
{
	$data	=	json_decode(str_replace("\\","",$_GET['data']));
	$token	=	escapeChars($data[0]->token);
	$arr	=	userLogout($token);
	echo json_encode($arr);
}
if (strtoupper($_REQUEST['type'])=="RESET")
{
	$data		=	json_decode(str_replace("\\","",$_GET['data']));
	$token		=	escapeChars($data[0]->token);
	$arr		=	updateBedge($token);
	echo json_encode($arr);
}