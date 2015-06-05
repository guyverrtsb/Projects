<?php

$currency = '$';
$currency_code = "USD";
//$date_format		=	"d-m-Y";
//$date_format_month	=	"M d, Y";
$date_format = "m-d-Y";
$date_format_month = "M d, Y";
$time_format = "h:i a";
$date_time_format = "m-d-Y h:i A";
$SERVER_ADDR = "http://" . $_SERVER['HTTP_HOST'];
//define base path
//define("base_path",$SERVER_ADDR."/sites/mobile/expressit/");
//define("admin_path",$SERVER_ADDR."/sites/mobile/expressit/MyCP/");

define("base_path", $SERVER_ADDR . "/sites/mobile/selfiheat/");
define("admin_path", $SERVER_ADDR . "/sites/mobile/selfiheat/MyCP/");
define("site_name", "selfieheat");
//		 this facebook credential is for

define("appId", "663689253641672");
define("appSecret", "56131dc5e7c2c40d0e475bb17b10cf2f");


$host = 'localhost';
$user = 'heminfo_tech';
$pass = 'hostgator';
$dbname = 'heminfo_selfiheat';
$db = &new MySQL($host, $user, $pass, $dbname);

/* $host = 'localhost';
  $user = 'root';
  $pass = '';
  $dbname = 'selfieheat'; */


$db = new MySQL($host, $user, $pass, $dbname);

//
