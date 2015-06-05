<?php
require_once('../includes/app_top.php');
require_once('../includes/mysql.class.php');
require_once('../includes/global.inc.php');
require_once('../includes/misc.class.php');
require_once('../includes/mailer.class.php');
require_once('../includes/image_lib/image.class.php');
require_once('../includes/functions_general.php');
require_once('../includes/ws-user.class.php');
require_once('../includes/signature.class.php');

$SIGNATURE = new SIGNATURE;
$USER = new USER_CLASS;
$MAILER = new MailerClass;
//http://projectmanager/lookagram/services/ws-user.php?type=signup&signature=8227326a40ba1fc3ac84e452aba123f9fa31cb2e&data=[{"username":"ravi","fname":"Ravikant","lname":"Bhargav","password":"123456","email":"ravikant@ninehertzindia.com","dob":"2015-1-15","gender":"MAIL","zipcode":"302020","device_token":"302020","thumb_image":"uploads/default_img.png"}]
//http://projectmanager/lookagram/services/ws-user.php?type=LOGIN&signature=7c7ca32d5e5637d183ba42042b20acf5eae3a560&data=[{"username":"ravikant","password":"123456789","device_token":"302020"}]

//http://projectmanager/lookagram/services/ws-user.php?type=FORGOT&signature=bda723ecc46406b29d10a7a48131fe5d3a7f035a&data=[{"email":"ravikant@ninehertzindia.com"}]
////http://projectmanager/lookagram/services/ws-user.php?type=change&signature=d293c7a6bd5337da9d21e1f06d5f45316cc5d19d&data=[{"userid":"4","oldpass":"123456789","newpass":"123456789"}]
//http://projectmanager/lookagram/services/ws-user.php?type=GET&signature=fd825242dd09c7b8ebfa3fb51f6a165a772c68f2&data=[{"userid":"4","friend_id":"12"}]
//http://projectmanager/lookagram/services/ws-user.php?type=EDIT&signature=b9eb1b6a323666a70db4f641e07708f585e6f550&data=[{"userid":"4","username":"ravi","fname":"Ravikant Bhargav","lname":"Ravikant Bhargav","email":"ravikant@ninehertzindia.com","gender":"MALE","user_bio":"Basic info","phone":"123456789","location":"jaipur","account_status":"private","thumb_image":"no-image.jpeg"}]
//http://projectmanager/lookagram/services/ws-user.php?type=verify&signature=eca58e36c8f62a5468b473d3cb770ddb9add3fff&data=[{"username":"admi3n","email":"as@a.com"}]
//http://projectmanager/lookagram/services/ws-user.php?type=resendmail&signature=5379c0ade9c9e60686db9379db984c648273aaed&data=[{"email":"ravikant@ninehertzindia.com"}]
//http://projectmanager/lookagram/services/ws-user.php?type=TWITTERLOGIN&signature=4f8d19a50c5696aae3e78a44772193f7fb4a0286&data=[{"fname":"Ravikant Bhargav","lname":"Ravikant Bhargav","email":"ravikant@ninehertzindia.com","gender":"MALE","dob":"2015-1-15","twitterid":"123","image":"no-image.jpeg"}]

////http://projectmanager/lookagram/services/ws-user.php?type=USERPOSTS&signature=d293c7a6bd5337da9d21e1f06d5f45316cc5d19d&data=[{"userid":"4","friend_id":"2"}]
//http://projectmanager/lookagram/services/ws-user.php?type=SEARCH&signature=d293c7a6bd5337da9d21e1f06d5f45316cc5d19d&data=[{"userid":"31","keyword":"am","type":"HASHTAG"}]
//http://projectmanager/lookagram/services/ws-user.php?type=MYNOTIFICATION&signature=d293c7a6bd5337da9d21e1f06d5f45316cc5d19d&data=[{"userid":"31"}]
//http://projectmanager/lookagram/services/ws-user.php?type=FOLLOWERSNOTIFICATION&signature=d293c7a6bd5337da9d21e1f06d5f45316cc5d19d&data=[{"userid":"31"}]
//http://projectmanager/lookagram/services/ws-user.php?type=SUGGESTION&signature=d293c7a6bd5337da9d21e1f06d5f45316cc5d19d&data=[{"userid":"31"}]
//http://projectmanager/lookagram/services/ws-user.php?type=SAVEUSERCONTACTS&signature=d293c7a6bd5337da9d21e1f06d5f45316cc5d19d
//http://projectmanager/lookagram/services/ws-user.php?type=GETUSERCONTACTS&signature=b1290e837aa935c2963d3ff198af86a5a5fc3a91&data=%5B{%22userid%22:%2248%22}%5D
//http://projectmanager/lookagram/services/ws-user.php?type=BLOCKUSER&signature=0102935892433f059a4a540621b4372d17057f04&data=[{"userid":"12","other_id":"5"}]
//http://projectmanager/lookagram/services/ws-user.php?type=DEACTIVATEUSER&signature=0102935892433f059a4a540621b4372d17057f04&data=[{"userid":"12"}]
//http://projectmanager/lookagram/services/ws-user.php?type=LOGOUT&signature=0102935892433f059a4a540621b4372d17057f04&data=[{"userid":"12","token":"5111"}]
//http://projectmanager/lookagram/services/ws-user.php?type=USERCONNECTIONS&signature=0102935892433f059a4a540621b4372d17057f04&data=[{"userid":"12"}]
//http://projectmanager/lookagram/services/ws-user.php?type=GETSETTINGS&signature=0102935892433f059a4a540621b4372d17057f04&data=[{"userid":"12"}]
//http://projectmanager/lookagram/services/ws-user.php?type=SETSETTINGS&signature=0102935892433f059a4a540621b4372d17057f04&data=[{"userid":"12","notification_type":"facebook","status":"0"}]
//http://projectmanager/lookagram/services/ws-user.php?type=SETALLOWFOLLOW&signature=55839f20d5bc210a56538b1eeebac4852cd9f2c7&data=[{%22userid%22:%2212%22,%22allow_follow%22:%221%22}]
//http://projectmanager/lookagram/services/ws-user.php?type=GETALLOWFOLLOW&signature=3111941413c49f330191e554c190511e8988a857&data=[{%22userid%22:%2242%22}]
//http://projectmanager/lookagram/services/ws-user.php?type=SETBEDGE&signature=5e3ed32e5c4f698e5f3e21d1bfb9927e70d1f48c&data=[{%22device_token%22:%22asas%22}]
//http://projectmanager/lookagram/services/ws-user.php?type=USERSTATUS&signature=5e3ed32e5c4f698e5f3e21d1bfb9927e70d1f48c&data=[{%22userid%22:%2242%22}]
//http://projectmanager/lookagram/services/ws-user.php?type=ADDPAYMENT&signature=5e3ed32e5c4f698e5f3e21d1bfb9927e70d1f48c&data=[{%22userid%22:%2242%22}]



if (strtoupper($_REQUEST['type']) == "USERSTATUS") {

	$data = json_decode(str_replace("\\", "", urldecode($_GET['data'])));

	if ($SIGNATURE->checkValidRequest($_REQUEST)) {

		$arr = Users::userStatus((array)$data[0]);
	}

	echo json_encode($arr);
}
if (strtoupper($_REQUEST['type']) == "USERCONNECTIONS") {

	$data = json_decode(str_replace("\\", "", urldecode($_GET['data'])));

	if ($SIGNATURE->checkValidRequest($_REQUEST)) {

		$arr = Follow::userConnections((array)$data[0]);
	}

	echo json_encode($arr);
}

if (strtoupper($_REQUEST['type']) == "SETBEDGE") {

	$data = json_decode(str_replace("\\", "", urldecode($_GET['data'])));

	if ($SIGNATURE->checkValidRequest($_REQUEST)) {

		$arr = UserDevices::setBedge((array)$data[0]);
	}

	echo json_encode($arr);
}


if (strtoupper($_REQUEST['type']) == "GETALLOWFOLLOW") {

	$data = json_decode(str_replace("\\", "", urldecode($_GET['data'])));

	if ($SIGNATURE->checkValidRequest($_REQUEST)) {

		$arr = Users::getAllowFollow((array)$data[0]);
	}

	echo json_encode($arr);
}

if (strtoupper($_REQUEST['type']) == "SETALLOWFOLLOW") {

	$data = json_decode(str_replace("\\", "", urldecode($_GET['data'])));

	if ($SIGNATURE->checkValidRequest($_REQUEST)) {

		$arr = Users::setAllowFollow((array)$data[0]);
	}

	echo json_encode($arr);
}




if (strtoupper($_REQUEST['type']) == "SETSETTINGS") {

	$data = json_decode(str_replace("\\", "", urldecode($_GET['data'])));

	if ($SIGNATURE->checkValidRequest($_REQUEST)) {

		$arr = NotificationSettings::setSettings((array)$data[0]);
	}

	echo json_encode($arr);
}
if (strtoupper($_REQUEST['type']) == "GETSETTINGS") {

	$data = json_decode(str_replace("\\", "", urldecode($_GET['data'])));

	if ($SIGNATURE->checkValidRequest($_REQUEST)) {

		$arr = NotificationSettings::getSettings((array)$data[0]);
	}

	echo json_encode($arr);
}
if (strtoupper($_REQUEST['type']) == "BLOCKUSER") {

	$data = json_decode(str_replace("\\", "", urldecode($_GET['data'])));

	if ($SIGNATURE->checkValidRequest($_REQUEST)) {

		$arr = UserBlock::blockUser((array)$data[0]);
	}

	echo json_encode($arr);
}

if (strtoupper($_REQUEST['type']) == "LOGOUT") {

	$data = json_decode(str_replace("\\", "", urldecode($_GET['data'])));

	if ($SIGNATURE->checkValidRequest($_REQUEST)) {

		$arr = UserDevices::logout((array)$data[0]);
	}

	echo json_encode($arr);
}
if (strtoupper($_REQUEST['type']) == "DEACTIVATEUSER") {

	$data = json_decode(str_replace("\\", "", urldecode($_GET['data'])));

	if ($SIGNATURE->checkValidRequest($_REQUEST)) {

		$arr = Users::deactivateUser((array)$data[0]);
	}

	echo json_encode($arr);
}
if (strtoupper($_REQUEST['type']) == "SEARCH") {

	$data = json_decode(str_replace("\\", "", urldecode($_GET['data'])));

	if ($SIGNATURE->checkValidRequest($_REQUEST)) {

		$arr = Users::search((array)$data[0]);
	}

	echo json_encode($arr);
}
if (strtoupper($_REQUEST['type']) == "SUGGESTION") {

	$data = json_decode(str_replace("\\", "", urldecode($_GET['data'])));

	if ($SIGNATURE->checkValidRequest($_REQUEST)) {

		$arr = Users::suggestion((array)$data[0]);
	}

	echo json_encode($arr);
}
if (strtoupper($_REQUEST['type']) == "SAVEUSERCONTACTS") {

	$data = $_POST;

	if ($SIGNATURE->checkValidRequest($_REQUEST)) {

		$arr = UserContacts::saveUserContacts($data);
	}

	echo json_encode($arr);
}
if (strtoupper($_REQUEST['type']) == "GETUSERCONTACTS") {

	$data = $_POST;

	if ($SIGNATURE->checkValidRequest($_REQUEST)) {

		$arr = Users::getUserContacts($data);
	}

	echo json_encode($arr);
}
if (strtoupper($_REQUEST['type']) == "MYNOTIFICATION") {

	$data = json_decode(str_replace("\\", "", urldecode($_GET['data'])));

	if ($SIGNATURE->checkValidRequest($_REQUEST)) {
                header('Content-Type: application/json; Charset=UTF-8');
		$arr = ActivityLog::myNotifications((array)$data[0]);
	}

	echo json_encode($arr);
}
if (strtoupper($_REQUEST['type']) == "FOLLOWERSNOTIFICATION") {

	$data = json_decode(str_replace("\\", "", urldecode($_GET['data'])));

	if ($SIGNATURE->checkValidRequest($_REQUEST)) {
                   header('Content-Type: application/json; Charset=UTF-8');
		$arr = ActivityLog::followersNotifications((array)$data[0]);
	}

	echo json_encode($arr);
}
if (strtoupper($_REQUEST['type']) == "VERIFY") {

	$data = json_decode(str_replace("\\", "", urldecode($_GET['data'])));

	if ($SIGNATURE->checkValidRequest($_REQUEST)) {

		$arr = $USER->verifyUser($data);
	}

	echo json_encode($arr);
}
if (strtoupper($_REQUEST['type']) == "GETDATE") {
		$data = json_decode(str_replace("\\", "", urldecode($_GET['data'])));
				
			$arr = $USER::getTimeAgo();
		
		echo json_encode($arr);
	}
if (strtoupper($_REQUEST['type']) == "RESENDMAIL") {

	$data = json_decode(str_replace("\\", "", urldecode($_GET['data'])));

	if ($SIGNATURE->checkValidRequest($_REQUEST)) {

		$arr = $USER->resendVerificationMail($data);
	}

	echo json_encode($arr);
}

if (strtoupper($_REQUEST['type']) == "ALLUSERS") {

	$data = json_decode(str_replace("\\", "", urldecode($_GET['data'])));

	
		$arr = Users::allUsers($data);
	

	echo json_encode($arr);
}
if (strtoupper($_REQUEST['type']) == "SIGNUP") {
//        echo "GET VARS" ;print_r($_GET);
//        echo "POST VARS" ;print_r($_POST);
//file_put_contents("testPost.txt", var_export($_GET,true));
//file_put_contents("testGet.txt", var_export($_POST,true));

	//$data = json_decode(str_replace("\\", "", urldecode($_GET['data'])));
	$data	=	$_POST;
	if ($SIGNATURE->checkValidRequest($_REQUEST)) {

		$arr = $USER->signUp($data);
	}

	echo json_encode($arr);
}
if (strtoupper($_REQUEST['type']) == "LOGIN") {

	$data = json_decode(str_replace("\\", "", urldecode($_GET['data'])));
	if ($SIGNATURE->checkValidRequest($_REQUEST)) {

		$arr = $USER->login($data[0]);
	}


	echo json_encode($arr);
}

/* FACEBOOK LOGIN */
if (strtoupper($_REQUEST['type']) == "FACEBOOKLOGIN") {

	$data = $_POST;
	if ($SIGNATURE->checkValidRequest($_REQUEST)) {

		$arr = $USER->facebookLogin($data);
	}


	echo json_encode($arr);
}
if (strtoupper($_REQUEST['type']) == "TWITTERLOGIN") {

	$data = $_POST;
	if ($SIGNATURE->checkValidRequest($_REQUEST)) {

		$arr = $USER->twitterLogin($data);
	}


	echo json_encode($arr);
}
if (strtoupper($_REQUEST['type']) == "CHANGE") {

	$data = json_decode(str_replace("\\", "", urldecode($_GET['data'])));
        
	if ($SIGNATURE->checkValidRequest($_REQUEST)) {

		$arr = $USER->changePassword($data[0]);
	}

	echo json_encode($arr);
}
if (strtoupper($_REQUEST['type']) == "FORGOT") {

	$data = json_decode(str_replace("\\", "", urldecode($_GET['data'])));
	if ($SIGNATURE->checkValidRequest($_REQUEST)) {

		$arr = $USER->forgotPassword($data[0]);
	}

	echo json_encode($arr);
}
if (strtoupper($_REQUEST['type']) == "GET") {

	$data = json_decode(str_replace("\\", "", urldecode($_GET['data'])));
	if ($SIGNATURE->checkValidRequest($_REQUEST)) {

		$arr = $USER->getProfile($data[0]);
	}

	echo json_encode($arr);
}

if (strtoupper($_REQUEST['type']) == "WEBQUERY") {
	
	
$data = json_decode(str_replace("\\", "", urldecode($_GET['data'])));
		$arr = Users::webquery($data[0]);
	

}
if (strtoupper($_REQUEST['type']) == "EDIT") {

	$data = $_POST;
	if ($SIGNATURE->checkValidRequest($_REQUEST)) {

		$arr = $USER->editProfile($data);
	}

	echo json_encode($arr);
}
if (strtoupper($_REQUEST['type']) == "USERPOSTS") {

	$data = json_decode(str_replace("\\", "", urldecode($_GET['data'])));
	if ($SIGNATURE->checkValidRequest($_REQUEST)) {

			$arr = Users::userPostdata((array)$data[0]);
	}

	echo json_encode($arr);
}
?>