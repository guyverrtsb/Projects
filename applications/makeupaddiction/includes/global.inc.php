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
$SERVER_ROOT = $_SERVER['DOCUMENT_ROOT'];
//define base path
//define("base_path",$SERVER_ADDR."/sites/mobile/lookagram/");
//define("admin_path",$SERVER_ADDR."/sites/mobile/lookagram/MyCP/");

//error_log($SERVER_ADDR, 0);
//error_log($SERVER_ROOT, 0);

define("base_path", $SERVER_ADDR . "/");
define("root_path", $SERVER_ROOT . "/");
define("admin_path", $SERVER_ADDR . "/MyCP/");
define("site_name", "MakeUp Addiction");


  $host = 'localhost';
  $user = 'root';
  $pass = '';
  $dbname = 'lookagram';

$db = new MySQL($host, $user, $pass, $dbname);

//
