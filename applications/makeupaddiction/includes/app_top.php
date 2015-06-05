<?php ob_start();
session_start();
//ini_set('display_errors', 1);
//error_reporting(E_ERROR);
session_cache_expire(10);
ini_set('session.gc_maxlifetime', 24 * 60 * 60);
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 1);
$sessionCookieExpireTime = 24 * 60 * 60;
session_set_cookie_params($sessionCookieExpireTime);
define("SALT", "lookagram!@#321");

function cheader($url) {
	$url = admin_path . $url;
	if (ereg("Microsoft", $_SERVER['SERVER_SOFTWARE'])) {
		header("Refresh: 0; URL=$url");
	} else {
		header("Location: $url");
	}
	exit();
}
function __autoload($class) {
    if(file_exists("../includes/classes/$class.class.php")){
        include_once "../includes/classes/$class.class.php";
    }
    if(file_exists("includes/classes/$class.class.php")){
        include_once "includes/classes/$class.class.php";
    }
}

function fheader($url) {
	$url = base_path . $url;
	if (ereg("Microsoft", $_SERVER['SERVER_SOFTWARE'])) {
		header("Refresh: 0; URL=$url");
	} else {
		header("Location: $url");
	}
	exit();
}

if ($PageTitle == "")
	$PageTitle = "Lookagram";

function send_mail($mailto, $mailubject, $mailbody, $mailfrom = '') {
	 $mailbody = stripslashes($mailbody);

	$mailfrom = "testtesting308@gmail.com";

	$headers = "MIME-Version: 1.0" . "\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1" . "\n";
	$headers .= "X-Priority: 1 (Higuest)\n";
	$headers .= "X-MSMail-Priority: High\n";
	$headers .= "Importance: High\n";

	$headers .= "From: <$mailfrom>" . "\n";
	$headers .= "Return-Path: <$mailfrom>" . "\n";
	$headers .= "Reply-To: <$mailfrom>";


	//echo "mail to : ".$mailto;
//		echo "<br>mail from : ".$mailfrom;
//		echo "<br>mail sub : ".$mailubject;
//		echo "<br>mail body : ".$mailbody;
//		echo "<br><br><br><br>";
	@mail($mailto, $mailubject, $mailbody, $headers);
}


?>