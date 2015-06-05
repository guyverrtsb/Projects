<?php
	require_once('../includes/app_top.php');
	require_once('../includes/mysql.class.php');
	require_once('../includes/global.inc.php');
	require_once('../includes/functions_general.php');
	require_once('../includes/user.class.php');
	require_once('../includes/image_functions.php');
	require_once('../includes/follow.class.php');
	require_once('../includes/push-notification.php');

	 	//http://demo2server.com/sites/mobile/expressit/services/ws-post.php?type=add&data=[{"userid":"1","title":"test","posttype":"IMAGE","mediafile":"test.jpg","thumfile":"test.jpg}]

//posttype	=	IMAGE / VIDEO / AUDIO / TEXT

//http://demo2server.com/sites/mobile/expressit/services/ws-post.php?type=list&data=[{"userid":"3","pageno":"1"}]
//http://demo2server.com/sites/mobile/expressit/services/ws-post.php?type=get&data=[{"userid":"1","postid":"1"}]
//http://demo2server.com/sites/core/expressit/services/ws-post.php?type=delete&data=[{"userid":"1","postid":"1"}]
//http://demo2server.com/sites/mobile/expressit/services/ws-post.php?type=FOLLOWPOSTLIST&data=[{"userid":"3","pageno":"1"}]

//http://demo2server.com/sites/mobile/expressit/services/ws-post.php?type=RESET&data=[{"userid":"2"}]
	//http://demo2server.com/sites/mobile/expressit/services/ws-notification.php?type=VIEWLAST&data=[{"userid":"3","deviceid":"465454545445454545465456456"}]
//$NOTIFI	=	new NOTIFICATION;
//$NOTIFI->postNotification(16,'TEXT','expressnews');
//die;
function createDir($path){
	return ((!is_dir($path)) ? @mkdir($path, 0777):TRUE); 
}
function addNewPost($rs,$img,$filetype,$imgName,$thumtmp,$thumname,$thumtype){
		global $db;
		
		$USER			=	new USER_CLASS;
		$NOTIFI			=	new NOTIFICATION;
		$status			=	"false";
		$msg			=	'';
		$checkfile		=	true;
		
		$userid			=	$rs['userid'];
		$posttype		=	escapeChars($rs['posttype']);
		$from			=	escapeChars($rs['from']);
		if($from == '')
			$from	=	'expressnews';
		$title			=	specialCharRemove(trim($rs['title']));
		$duration		=	trim(escapeChars($rs['duration']));
		$location		=	trim(escapeChars($rs['location']));
		$gpsstatus		=	trim(escapeChars($rs['gpsstatus']));
		
		$city			=	trim(escapeChars($rs['city']));
		$state			=	trim(escapeChars($rs['state']));
		$country		=	trim(escapeChars($rs['country']));
		$lat			=	trim(escapeChars($rs['lat']));
		$lng			=	trim(escapeChars($rs['lng']));
		
		$thumpath		=	'';
		$fullpath		=	'';
		$videopath		=	'';
		//echo $filetype;die;
		if ($userid=="" || $userid<=0)
			$msg="Invalid selected user";
		else{
			
			if($posttype != 'TEXT')
			{
				$filePath="";
				$photo_dir="../uploads";
				$dirCreated=(createDir($photo_dir)); 
				$filePath .="uploads/";
				$photo_dir.="/".$userid;
				$dirCreated=(createDir($photo_dir)); 
				$filePath .=	$userid."/";
				$photo_dir.="/post";
				$dirCreated=(createDir($photo_dir)); 
				$filePath .="post/";
				
				
				if ($img == "")
				{
					$msg="File not found";
					$checkfile	=	false;
				}
				else if (!$dirCreated){
					$msg="An error occured to upload image! please try again";
					$checkfile	=	false;
				}else
				{
				  if (count(glob($photo_dir.$imgName))>0){  
	 				  $random_digit=rand(000,999);
					  $ext=pathinfo($imgName, PATHINFO_EXTENSION);
  					  $flName= basename($imgName,".".$ext).$random_digit;
  					  $flName= ($imgName.".".$ext);
  				  }
  				  else
  					  $flName	=	rand(000,999).$imgName;
  				  	 
  				 $photo_dir	=	$photo_dir."/";
 
				  $target_ori="{$photo_dir}{$flName}";	 
				  $bigphoto="{$flName}"; 
				 
				  $target_smal="{$photo_dir}thm_{$flName}";		  
				  $smalphoto="thm_{$flName}";
				   
  				  $image = new UploadImage();  
				  $image->load($img);  
				 
				  if($posttype=="VIDEO")
  				  {
  					  if( $thumtype!="video/mp4" Xor $thumtype!="video/quicktime" Xor $thumtype!="video/mov")
  					  {
  						  $msg="An error occurred to upload media file! not a valid media file ". $thumtype;
  						  $status="false";
  						  $checkfile	=	false;
  					  }
  					  
  
				  }
				  elseif($posttype=="AUDIO")
  				  {// $filetype != "audio/mpeg" Xor 
  					  if($thumtype!="audio/mp4a-latm")
  					  {
  						  $msg="An error occurred to upload audio file! not a valid audio file ". $filetype;
  						  $status="false";
  						  $checkfile	=	true;
  					  }
  					  
  
				  }
  				  elseif($posttype=="IMAGE"){
  					  if ($image->validate==0){  
						  $msg="An error occurred to upload image file! not a valid image file";  
						  $status="false";  
						  $checkfile	=	false;
  					  }
  				  }
				}
				}
  
				  if($checkfile==true) 
				  {
					  if($posttype != 'TEXT')
					  {  
						  if($posttype=="VIDEO")  
						  {
							  $thumname	=	rand(0000,9999).$thumname; 
							//  move_uploaded_file($img,$target_ori);  
							  move_uploaded_file($thumtmp,$photo_dir.$thumname);
							  
							  $videopath	=	$filePath.$thumname;
							  
							  $image->save($target_ori,100); 
							  $image->resizeToWidth(600);
							  $image->save($target_smal,95);
							  
							  $thumpath		=	$filePath.$smalphoto;
							  $fullpath		=	$filePath.$bigphoto;
							  
						  } 
						  elseif($posttype=="AUDIO")  
						  { 
							  move_uploaded_file($img,$target_ori);
							    
							  $thumpath		=	$filePath.$bigphoto;
							  $fullpath		=	$filePath.$bigphoto;
						  }
						  elseif($posttype=="IMAGE") 
						  {
							 
							  $image->save($target_ori,100); 
							  $image->resize(200,200);
							  $image->save($target_smal,95);
							  
							  $thumpath		=	$filePath.$smalphoto;
							  $fullpath		=	$filePath.$bigphoto;
						  }
					  }
  
					   $sql	=	" INSERT INTO post SET ".  
								" userid	=	'".$userid."',".
								" location	=	'".$location."',".
								" gpsstatus	=	'".$gpsstatus."',".
								" city		=	'".$city."',".
								" state		=	'".$state."',".
								" country	=	'".$country."',".
								" `from`	=	'".$from."',".
								" lat		=	'".$lat."',".
								" lng		=	'".$lng."',".
								" thumpath	=	'".$thumpath."',".
								" fullpath	=	'".$fullpath."',".
								" videopath	=	'".$videopath."',".
								" title		=	'".$title."',".
								" duration	=	'".$duration."',".
								" posttype	=	'".$posttype."',".
								" dtdate	=	'".nowDateTime()."' ";

			  			$db->query($sql);
						$NOTIFI->postNotification($userid,$posttype,$from);
						addCountNewPost($userid);
						$status		=	"true";
						$msg		=	"Post has been posted successfully";
			  }
		  
		
			
	}
	$arr=array("message"=>$msg,"status"=>$status);
	return $arr;
}
function getTotalCount($userid){
	global $db;
	$cnt=0;
	
	$sql="select count(id) as cnt from notification where ((mainid in(select postid from post where userid=".$userid.") and type!='FOLLOW')  or (ref_id in(select id from user_follow where following_id=".$userid." and status=1) and type='FOLLOW'))  and userid !=".$userid." order by dtdate DESC";
	
	$result = $db->query($sql);
	if ($result->size()>0){
		$rs=$result->fetch();
		if (!is_null($rs['cnt']))
			$cnt=$rs['cnt'];
	}
	return $cnt;
}
function addCountNewPost($userid)
{
	global $db;
	$total	=	0;
	$sql="select userid from users where userid != '".$userid."'";
	$result = $db->query($sql);
	if($result->size() > 0)
	{
		while($rs=$result->fetch())
		{
			$sql1="select total from user_new_post where userid = '".$rs['userid']."'";
			$result1 = $db->query($sql1);
			if($result1->size() > 0)
			{
				$rs1=$result1->fetch();
				$total	=	$rs1['total'];
				
				$sql1="UPDATE `user_new_post` SET `total`='".($total+1)."' WHERE userid = '".$rs['userid']."'";
				$db->query($sql1);
			}else
			{
				$sql1="INSERT INTO `user_new_post` SET `total`='1', userid = '".$rs['userid']."'";
				$db->query($sql1);
			}
		}
	}
	return true;
}

function totalNewPostReset($userid)
{
	global $db;
	$status			=	"false";
	$msg			=	'';
	
	if ($userid=="" || $userid<=0)
		$msg="Invalid selected user";
	else{
		$sql="UPDATE `user_new_post` SET `total`='0' WHERE userid = '".$userid."'";
		$result = $db->query($sql);
		
		$status		=	"true";
		$msg		=	"Successfully";
	}
	$arr=array("message"=>$msg,"status"=>$status);
	return $arr;
	
}
function getTotalNewPost($userid)
{
	global $db;
	$total	=	0;
	$sql="select total from user_new_post where userid = '".$userid."'";
	$result = $db->query($sql);
	if($result->size() > 0)
	{
		$rs=$result->fetch();
		$total	=	$rs['total'];
	}
	return intval($total);
}
function viewLastSeen($userid){
	global $db;
	$status = "false";
	$arr= array();
	$msg= "";
	
	if (($userid=="" || $userid<=0) )
		$msg="Invalid user id";
	else{
		$count=getTotalCount($userid);
		
		$sql = "select * from last_seen where userid=".$userid."";

		$result = $db->query($sql);
		if ($result->size()>0){
			$rs=$result->fetch();
			$last_view 	=	$rs['totallastseen'];
		}
		else
			$last_view 	=	0;
		if ($count<$last_view){
				addLastSeen($userid,$count);
				viewLastSeen($userid);
		}
		
		$arr['total']		=	$count."";
		$arr['last_view']	=	$last_view."";
		$total	=	($count-$last_view);
		
		if($total <= 0)
			$total	=	0;
		
		$arr['new']			=	$total."";
		
		$newcount=getTotalNewPost($userid);
		$arr['newpost']			=	$newcount."";
		
		$status="true";
	}
	return $arr;	
		
}
function addLastSeen($userid,$total){
	global $db;
	$status = "false";
	$msg= "";
	if (($userid=="" || $userid<=0) )
		$msg="Invlid user id";
	else{
		
			$sql = "select * from last_seen where userid=".$userid."";
			$result = $db->query($sql);
			if ($result->size()<=0){
				$sql_insrt = "insert into last_seen(userid,totallastseen,lastseendate)VALUES(".
				"".$userid.",".
				"".$total.",".
				"NOW())";
			
				$result_updt=$db->query($sql_insrt);
				
			}
			else{
			$sql_insrt 		= "update last_seen set totallastseen=".$total.",lastseendate=NOW() where userid=".$userid." ";
			$result_updt	=	$db->query($sql_insrt);
			}
		
		$status="true";
		$msg="Recorded successfully";
	}
	$arr=array("message"=>$msg,"status"=>$status);
	return $arr;	
		
}

function getAllPost($userid,$pageNo){
	global $db;
	$status ="false";
	$msg	=	'';
	$USER = new USER_CLASS;
	$FOLLOW	=	new FOLLOW_CLASS;
	$comment = array();
	$pageSize	=	15;
	$total_rows	=	0;
	$latestcomment	=array();
	if ($userid<=0 || $userid=="")
		$msg="Invlid user or post";
	else{
		if($pageNo == 1)
			totalNewPostReset($userid);
		$sql="select * from post where  userid in(select userid from users) ORDER BY postid DESC";
		$result1 = $db->query($sql);
		
		$total_rows	=	$result1->size();
		$lastPage 	= ceil($total_rows / $pageSize);
		if ($pageNo<=1)
				$limit=" limit 0, ".$pageSize;
			else
				$limit=" limit ".($pageNo-1)*$pageSize.", ".$pageSize;
		$selectsql	=	$sql.$limit;
		$result = $db->query($selectsql);
		
		if ($result->size()>0){
			while ($rs=$result->fetch($sql)){
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
				$comment[] =  $rs;
		
			}
			
			sort($comment);
			
			$msg	=	'Successfully';
			$status="true";
		}
		else
			$msg="Posts not found.";
	}
		$arr=array("message"=>$msg,"data"=>$comment,"totalpost" => "".$total_rows."","totalpage" => "".$lastPage."","pagesize" => "".$pageSize."","lastseen"=>viewLastSeen($userid),"status"=>$status);
		return $arr;
}
function getAllFollowPost($userid,$pageNo){
	global $db;
	$status ="false";
	$msg	=	'';
	$USER = new USER_CLASS;
	$FOLLOW	=	new FOLLOW_CLASS;
	$comment = array();
	$pageSize	=	15;
	$total_rows	=	0;
	$latestcomment	=array();
	if ($userid<=0 || $userid=="")
		$msg="Invlid user or post";
	else{
		$sql="select * from post where userid in (select following_id from user_follow WHERE follower_id = '".$userid."' AND status = '1' ) or userid = '".$userid."' ORDER BY postid DESC";
		$result1 = $db->query($sql);
		$total_rows	=	$result1->size();
		$lastPage 	= ceil($total_rows / $pageSize);
		if ($pageNo<=1)
				$limit=" limit 0, ".$pageSize;
			else
				$limit=" limit ".($pageNo-1)*$pageSize.", ".$pageSize;
		$selectsql	=	$sql.$limit;
		$result = $db->query($selectsql);
		if ($result->size()>0){
			while ($rs=$result->fetch($sql)){
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
				$comment[] =  $rs;
		
			}
			
			sort($comment);
			
			$msg	=	'Successfully';
			$status="true";
		}
		else
			$msg="Posts not found.";
	}
		$arr=array("message"=>$msg,"data"=>$comment,"totalpost" => "".$total_rows."","totalpage" => "".$lastPage."","pagesize" => "".$pageSize."","status"=>$status);
		return $arr;
}
function getPost($loginid,$userid,$postid){
	global $db;
	$status ="false";
	$msg	=	'';
	$USER = new USER_CLASS;
	$FOLLOW	=	new FOLLOW_CLASS;
	$comment = array();
	$latestcomment	=array();
	if ($userid<=0 || $userid=="")
		$msg="Invlid user or post";
	else{
		$sql="select * from post where userid = '".$userid."' AND postid =".$postid;
		$result = $db->query($sql);
		if ($result->size()>0){
			while ($rs=$result->fetch($sql)){
				$userInfo			=	$USER->getUserInfo($rs['userid']);
				$rs['name']			=	$userInfo['name'];
				$rs['username']		=	$userInfo['username'];
				$rs['userphoto']	=	$userInfo['user_thumbimage'];
				
				$rs['totalcomment']	=	$USER->countTotalComment($rs['postid']);
				$rs['totallike']	=	$USER->getTotalLike($rs['postid']);
				$rs['totaldislike']	=	$USER->getTotalDislike($rs['postid']);
				$rs['likestatus']	=	$USER->getLikeStatus($loginid,$rs['postid']);
				$rs['reportstatus']	=	$USER->getReportStatus($loginid,$rs['postid']);
				$rs['follow_status'] =	"". $FOLLOW->getUserStatus($loginid,$userid,"FOLLOWING")."";
				$rs['time_text']	=	$USER->getTimeInfo($rs['dtdate'], date("Y-m-d H:i:s"), "x");
				$rs['comment']		=	$USER->getPostComment($rs['postid']);
				$comment[] =  $rs;
		
			}
			
			$msg	=	'Successfully';
			$status="true";
		}
		else
			$msg="Posts not found.";
	}
		$arr=array("message"=>$msg,"data"=>$comment,"status"=>$status);
		return $arr;
}

function deletePost($userid,$postid)
{
	global $db;
	$status="false";
	$msg="";

	if ($userid<=0 || $postid<=0)
		$msg="Invalid selected user or post";
	else{
			$sqllike="delete from postlike where postid =".$postid;
			$db->query($sqllike);
			
			$sqlComment="delete from comment where postid =".$postid;
			$db->query($sqlComment);
			
			$sql="delete from report where postid =".$postid;
			$db->query($sql);
			
			$sql="delete from post where postid=".$postid;
			$db->query($sql);
			
			$msg="Post has been deleted successfully";
			$status="true";
		}
	$arr=array("message"=>$msg,"status"=>$status);
	return $arr;
}


$arr=array();
if (isset($_REQUEST['type']) && $_REQUEST['type']!=""){
	$data=array();
	if (strtoupper($_REQUEST['type'])=="ADD"){
		
		$image		=	$_FILES['mediafile']['tmp_name'];
		$filename	=	$_FILES['mediafile']['name'];
		$filetype	=	$_FILES['mediafile']['type'];
		
		$thumtmp	=	$_FILES['thumfile']['tmp_name'];
		$thumname	=	$_FILES['thumfile']['name'];
		$thumtype	=	$_FILES['thumfile']['type'];
		
		
		$arr=addNewPost($_POST,$image,$filetype,$filename,$thumtmp,$thumname,$thumtype);
		echo json_encode($arr);
	}
	if (strtoupper($_REQUEST['type'])=="LIST"){
		$data=json_decode(str_replace("\\","",$_GET['data']));
		$userid		=	intval(trim($data[0]->userid));
		$pageno		=	intval($data[0]->pageno);
		$arr=getAllPost($userid,$pageno);
		echo json_encode($arr);
	}
	if (strtoupper($_REQUEST['type'])=="FOLLOWPOSTLIST"){
		$data=json_decode(str_replace("\\","",$_GET['data']));
		$userid		=	intval(trim($data[0]->userid));
		$pageno		=	intval($data[0]->pageno);
		$arr=getAllFollowPost($userid,$pageno);
		echo json_encode($arr);
	}
	if (strtoupper($_REQUEST['type'])=="GET"){
		$data=json_decode(str_replace("\\","",$_GET['data']));
		$loginid		=	intval(trim($data[0]->loginid));
		$userid		=	intval(trim($data[0]->userid));
		$postid		=	intval(trim($data[0]->postid));
		$arr=getPost($loginid,$userid,$postid);
		echo json_encode($arr);
	}
	if (strtoupper($_REQUEST['type'])=="DELETE"){
		$data=json_decode(str_replace("\\","",$_GET['data']));
		$userid		=	intval(trim($data[0]->userid));
		$postid		=	intval(trim($data[0]->postid));
		$arr=deletePost($userid,$postid);
		echo json_encode($arr);
	}
	if (strtoupper($_REQUEST['type'])=="RESET")
	{
		$data		=	json_decode(str_replace("\\","",$_GET['data']));
		$userid		=	($data[0]->userid);
		$arr		=	totalNewPostReset($userid);
		echo json_encode($arr);
	}
	if (strtoupper($_REQUEST['type'])=="VIEWLAST")
	{
		$data		=	json_decode(str_replace("\\","",$_GET['data']));
		
		$userid		=	($data[0]->userid);
		$arr		=	viewLastSeen($userid);
		echo json_encode($arr);
	}
	if (strtoupper($_REQUEST['type'])=="ADDLAST"){
		$data=json_decode(str_replace("\\","",$_GET['data']));
		$userid			=	(trim($data[0]->userid));
		$total			=	(trim($data[0]->total));
		$arr=addLastSeen($userid,$total);
		echo json_encode($arr);
	}
	
}
