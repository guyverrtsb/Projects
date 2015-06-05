<?php

	require_once('../includes/app_top.php');

	require_once('../includes/mysql.class.php');

	require_once('../includes/global.inc.php');

	require_once('../includes/functions_general.php');

	require_once('../includes/user.class.php');

	require_once('../includes/image_functions.php');



//services/ws-facebook.php?type=FACEBOOK&data=[{"name":"test","email":"test@gmail.com","user_image":"test.jpg","fbid":"31321132132":"username":"test","deviceid":"dsfgsdgsdgsdfgdsg"}]



//type	=	FACEBOOK / TWITTER



	

function createDir($path){

	return ((!is_dir($path)) ? @mkdir($path, 0777):TRUE); 

}

function uploadImg($img,$img_name,$userid,$tp=""){

	global $db;

	$status="false";

	$USER= new USER_CLASS;

	$userName=$userid;

	$filePath="";

	if ($userid==""){

		$msg="Invalid operation userid or box not found";

		$status="false";

	}

	else{

		$photo_dir="../uploads";

		$dirCreated=(createDir($photo_dir)); 

		$filePath .="uploads";

		

		$photo_dir.="/$userName/";

		$dirCreated=(createDir($photo_dir)); 

		$filePath .="/".$userName."/";

		

			

		if ($img==""){

			$msg="File not found";

			return array("message"=>$msg,"status"=>$status);

		}

			

		if (!$dirCreated){

			$msg="An error occured to upload image! please try again";

			$status="false";

		}

		else{

			if (count(glob($photo_dir.$img_name))>0){

				$random_digit=rand(000,999);

				$ext=pathinfo($img_name, PATHINFO_EXTENSION);

				$flName= basename($img_name,".".$ext).$random_digit;

				$flName= ($flName.".".$ext);

			}

			else

				$flName=$img_name;



			$target_ori="{$photo_dir}{$flName}";		

			$bigphoto="{$flName}";

			

			$target_thm="{$photo_dir}_thm{$flName}";		

			$tnmphoto="_thm{$flName}";

			

			$image = new UploadImage();

			$image->load($img);

	

			if ($image->validate==0){

				$msg="An error occured to upload image file! not a valid image file";

				$status="false";

			}

			else {

				$image->save($target_ori,100);

				$image->resize(200,200);

				$image->save($target_thm,100);

				

				$sql	=	" UPDATE users SET ".

							" imgstatus		=	'upload',".

							" user_image	=	'".$filePath.$bigphoto."',".

							" user_thumbimage	=	'".$filePath.$tnmphoto."' ".

							" where 	userid	=".$userid;

							

				$result=$db->query($sql);

				

				$status="true";

				$msg="Image added successfully";

				}

	}

		$arr=array("message"=>$msg,"path"=>$filePath.$flName, "status"=>$status);

		return $arr;

	}

}



function checkFacebookUser($fb_id,$type='FACEBOOK'){

	global $db;

	$userid=-1;

	$sql="select userid from users where fbid='".$fb_id."' and logintype='".$type."'";

	$result=$db->query($sql);

	if ($result->size()>0){

		$rs=$result->fetch();

		$userid=$rs['userid'];	

	}

	return $userid;

}

function getUniqueUser($name){

	$i = rand(1,100);

	$name		 	= strtolower($name);

	$uniqueUser 	= str_replace(" ",".",$name);

	global $db;

	$sql="select userid from users where username='".$uniqueUser."'";



	$result = $db->query($sql);

	if ($result->size()>0){

		$uniqueUser = $uniqueUser.$i;

		getUniqueUser($uniqueUser);

	}

	

	return $uniqueUser;

}

function facebookLogin($rs,$type,$img,$imgName){

		global $db;

		$USER=new USER_CLASS;

		$status="false";

		$userInfo	=	array();

		$name	=	security($rs['name']);

		$image	=	'uploads/pro_pic_default.png';

		

		
		

		if($userName == '')

			$userName	=	getUniqueUser("styleblox");

			

		$email			=	security($rs['email']);

		$fb_id			=	($rs['fbid']);

		$token			=	trim($rs['deviceid']);



		if ($fb_id=="" && $fb_id<=0)

			$msg="Invalid Facebook id";

		else{

			$userid =   checkFacebookUser($fb_id,$type);

							

			if ($userid>=0){
				
				$userInfo	=	$USER->getUserInfo($userid);
				if($userInfo['status'] > 0)
				{
					saveDeviceToken($userid,$token);
	
					$resp=uploadImg($img,$imgName,$userid);
	
					
	
					$msg="Successfully Login";
	
					$status="true";
				}else
				{
					$msg="Your account is deactived!"; 
				}

			}

			else{

				//if($type == '')

					//$type	=	'FACEBOOK';

				$sql="insert into users(username,pass,name,fbid,logintype,device_id,email,dtdate)VALUES(".

				"'".$userName."',".

				"'".md5('expressIt')."',".

				"'".$name."',".

				"'".$fb_id."',".

				"'".$type."',".

				"'".$token."',".

				"'".$email."',".

				" NOW() ".

				")";

				

				$result=$db->query($sql);

				$insertId=$result->insertID();

				saveDeviceToken($insertId,$token);

				$userid	=$insertId;		

				$userInfo	=	$USER->getUserInfo($userid);

				$resp=uploadImg($img,$imgName,$userid);

				if ($resp['status']=="false"){

					$status="true";

					if ($imgName!="")

						$msg="An error occurred to upload profile image but profile updated successfully";

					else

					{

						$msg="Your profile has been successfully updated";

					}

				}

				elseif ($resp['status']=="true"){

					$status="true";

					$msg="Has been successfully created.";

				}

			}

		}

			

			$arr=array("message"=>$msg,"userid"=>"".$userid."","detail"=>$userInfo,"status"=>$status);

			return $arr;

		

			

}

function saveDeviceToken($userid,$deviceid){

	global $db;

	$status=false;

		

	if ($userid!="" && $deviceid!=""){

		

		$sqlDevice	=	"SELECT * FROM user_token WHERE UPPER(deviceid) = '".strtoupper($deviceid)."'";

		$queryDev	=	$db->query($sqlDevice);

		

		if($queryDev->size() <= 0)

		{

			$sqlup	=	" INSERT INTO user_token SET userid= '".$userid."', deviceid = '".$deviceid."'";

			$db->query($sqlup);

		}else

		{

			$db->query("DELETE FROM `user_token` WHERE UPPER(deviceid) = '".strtoupper($deviceid)."'");

			$sqlup	=	" UPDATE user_token SET userid= '".$userid."' WHERE UPPER(deviceid) = '".strtoupper($deviceid)."'";

			$db->query($sqlup);

		}

	}

	return true;

}



$arr=array();





if (isset($_REQUEST['type']) && $_REQUEST['type']!=""){

	$data=array();

	if (strtoupper($_REQUEST['type'])=="FACEBOOK" ){

		$image=$_FILES['user_image']['tmp_name'];

		$filename=$_FILES['user_image']['name'];

		$type=strtoupper($_REQUEST['type']);

		

		$arr=facebookLogin($_REQUEST,$type='facebook',$image,$filename);

		echo json_encode($arr);

	}

}



