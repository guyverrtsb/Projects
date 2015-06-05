<?php
require_once('includes/app_top.php');
require_once('includes/mysql.class.php');
require_once('includes/global.inc.php');
require_once('includes/functions_general.php');
require_once('includes/user.class.php');

//activation account

$USER = new USER_CLASS;

$actmsg = '';

$actemail = trim(strtolower($_GET['email']));

$actverifycode = ($_REQUEST['token']); /* Get varify code */
$type = strtoupper($_REQUEST['type']);

function checkValidPass($email,$pass)
{
	global $db;
	$pass	=	md5($pass);
	$sql_user	=	"SELECT * FROM users WHERE email='".$email."' AND pass='".$pass."'";
	$exe_user	=	$db->query($sql_user);
	if($exe_user->size()<=0)
	{
		return false;
	}
	else
	{
		return true;
	}
	
}

if(isset($_REQUEST['btn_submit']))
{
	

$email	=	trim($_REQUEST['email']);
$token	=	trim($_REQUEST['token']);
$type	=	trim($_REQUEST['type']);
$old_pass	=	trim($_REQUEST['old_pass']);
$new_pass	=	trim($_REQUEST['new_pass']);
$confirm_pass	=	trim($_REQUEST['confirm_pass']);

/*if($old_pass=='')
{
	echo "<h1>Old password cannot be blank.</h1>"."<br>";
	return false;
}
else if(!checkValidPass($email,$old_pass))
{
echo "<h1>Old password does not match.</h1>"."<br>";
	return false;	
}*/
$str	=	true;
 if($new_pass=='')
{
	$msg .= "<h1>New password cannot be blank.</h1>"."<br>";
	$str	=	false;
}
else if((strlen($new_pass)<6) || (strlen($new_pass)>16) )
{
	$msg .= "<h1>New password length should be between 6 to 16 character .</h1>"."<br>";
	$str	=	false;
}
 else if($confirm_pass=='')
{
	$msg .= "<h1>Confirm password cannot be blank.</h1>"."<br>";
	$str	=	false;
}
else if((strlen($confirm_pass)<6) || (strlen($confirm_pass)>16) )
{
	$msg .= "<h1>Confirm password length should be between 6 to 16 character .</h1>"."<br>";
	$str	=	false;
}
else if($new_pass!=$confirm_pass)
{
$msg .= "<h1>New password and confirm password does not match.</h1>"."<br>";
	$str	=	false;
}


if($str)
{
	$_chk_user = " SELECT * from reset_password " .
			" WHERE  token  = '" . $token . "' AND email = '" . $email . "'"; 


	$user_check = $db->query($_chk_user);

	if ($user_check->size() > 0) {

		$rows = $user_check->fetch();
		$reqdate = $rows["dtdate"];

		$expdate = date("Ymd", strtotime($reqdate . " +3 day"));
		$cdate = date('Ymd');

		$diff = (strtotime($expdate) - strtotime($cdate));
		if ($diff >= 0) {
			$sqlup = "UPDATE  users SET
							pass 	=	'" . md5($new_pass) . "'
							WHERE userid	= '" . $rows['userid'] . "' ";
			$db->query($sqlup);

			$userInfo = $USER->getUserInfo($rows['userid']);

			$post = '';
			$post.="<div style=' width:700px; margin:0 auto'> ";
			$post.="<div style='background:#fff; border:#888 solid 1px; border-radius:15px; margin-top:20px; padding:20px; box-shadow:0 0 8px #999'>";
			$post.="<div style='border-bottom:1px solid #ccc; padding-bottom:18px; background:none repeat scroll 0 0 #aeaeae;'> ";
			//$post.="<img style=' width:250px;' src='" . base_path . "/uploads/logo.png' /></div> ";
            $post.="Lookagram";
			$post.="<div style='font-size:16px; padding-top:20px;'>";
			$post.="<p>Hello " . $userInfo['name'] . ",</p>";
			
			$post.="<p>Your registered email is: " . $userInfo['email'] . "</p>";
			$post.="<p>Your password has been reset and your new password is:</p>";
			$post.="<p>'" . $new_pass . "'</p>";
			$post.="<p>Thank you,</p>";
			$post.="<p>Lookagram Team</p>";
			$post.="</div> </div> </div> ";

//echo $post; die;
			send_mail($userInfo['email'], "Password Info", $post);

			$sqldele = "delete from reset_password where userid =" . $rows['userid'];
			$db->query($sqldele);
			
			$msg	.= "<h1>Lookagram: <span>Password successfully changed , please check your inbox for the new password.</span></h1>";
			$str= false;
			//fheader("success.php");
		} else {

			$msg	.= "<h1>Lookagram: <span>Your link has been expired. Please request for another verification email.</span></h1>";
			$str=false;
		}
	} else {

		$msg	.= "<h1>Lookagram: <span>Invalid Request</span></h1>";
		$str= false;
	}
	
}



}

$msgafteractive = '';
/*if(strtoupper($type)=='CHANGE'){
if ($actverifycode != '' && $actemail != '') {

	$_chk_user = " SELECT * from reset_password " .
			" WHERE  token  = '" . $actverifycode . "' AND email = '" . $actemail . "'";


	$user_check = $db->query($_chk_user);

	if ($user_check->size() > 0) {

		$rows = $user_check->fetch();
		$reqdate = $rows["dtdate"];

		$expdate = date("Ymd", strtotime($reqdate . " +3 day"));
		$cdate = date('Ymd');

		$diff = (strtotime($expdate) - strtotime($cdate));
		if ($diff >= 0) {
			$sqlup = "UPDATE  users SET
							pass 	=	'" . md5($rows['pass']) . "'
							WHERE userid	= '" . $rows['userid'] . "' ";
			$db->query($sqlup);

			$userInfo = $USER->getUserInfo($rows['userid']);

			$post = '';
			$post.="<div style=' width:700px; margin:0 auto'> ";
			$post.="<div style='background:#fff; border:#888 solid 1px; border-radius:15px; margin-top:20px; padding:20px; box-shadow:0 0 8px #999'>";
			$post.="<div style='border-bottom:1px solid #ccc; padding-bottom:18px;'> ";
			$post.="<img style=' width:250px;' src='" . base_path . "/uploads/logo.png' /></div> ";
			$post.="<div style='font-size:16px; padding-top:20px;'>";
			$post.="<p>Hello " . $userInfo['name'] . ",</p>";
			//$post.="<p>Date: ".date("m-d-Y h:i:s A")."</p> ";
			//$post.="<p>Name: ".$userInfo['name']."</p>";
			$post.="<p>Your registered email is: " . $userInfo['email'] . "</p>";
			$post.="<p>Your password has been reset and your new password is:</p>";
			$post.="<p>'" . $rows['pass'] . "'</p>";
			$post.="<p>Thank you,</p>";
			$post.="<p>Selfieheat Team</p>";
			$post.="</div> </div> </div> ";


			send_mail($userInfo['email'], "Password Info", $post);

			$sqldele = "delete from reset_password where userid =" . $rows['userid'];
			$db->query($sqldele);
			
			echo "<h1>Selfieheat: <span>Password successfully changed , please check your inbox for the new password.</span></h1>";
			return false;
		} else {

			echo "<h1>Selfieheat: <span>Your link has been expired. Please request for another verification email.</span></h1>";
			return false;
		}
	} else {

		echo "<h1>Selfieheat: <span>Invalid Request</span></h1>";
		return false;
	}
} else {

	echo "<h1>Selfieheat: <span>Invalid Request.</span></h1>";
	return false;
}
}*/
 
$msgafteractive = "YES"
?>



<div style=" width:700px; margin:0 auto">
 <div style="background:#fff; border:#888 solid 1px; border-radius:15px; margin-top:20px; padding:20px; box-shadow:0 0 8px #999"><div style="border-bottom:1px solid #ccc; padding-bottom:18px;">
<!--  <img src="http://projectmanager/selfieheat//uploads/logo.png" style=" width:250px;">-->
     Lookagram
     </div>
  <span style="color:#930; font-size:12px"><?php  echo $msg ?></span>
   <div style="font-size:16px; padding-top:20px;">
   <form name="myform" method="GET" action="change-password.php">
<input type="hidden" name="email" value="<?php echo $_REQUEST['email'] ?>" />
<input type="hidden" name="token" value="<?php echo $_REQUEST['token'] ?>" />
<input type="hidden" name="type" value="<?php echo $_REQUEST['type'] ?>" />

    <div class="container top_gap">
    <table width="100%">
   <!-- <tr>
    <th>Old Password</th>
    <td> <input type="password" name="old_pass" id="old_pass" required="required" /></td>
    </tr>-->
     <tr>
    <th style="text-align:right; padding-right:15px;">New Password</th>
    <td>  <input type="password" name="new_pass" id="new_pass" required="required" minlength="6" maxlength="16" /></td>
    </tr>
     <tr>
       <th style="text-align:right; "></th>
       <td height="10;"></td>
     </tr>
     <tr>
    <th style="text-align:right; padding-right:15px;">Confirm Password</th>
    <td>  <input type="password" name="confirm_pass" id="confirm_pass" equalTo="new_pass" required="required" minlength="6" maxlength="16" /></td>
    </tr>
     <tr>
    <th>&nbsp;</th>
    <td> <input type="submit" name="btn_submit" id="btn_submit" value="Change Password" /></td>
    </tr>
    
    
   </table>
    
    </div>
    </form>
   </div> 
   </div> 
   </div>
   





