<?php
require_once('../includes/app_top.php');
require_once('../includes/mysql.class.php');
require_once('../includes/global.inc.php');
require_once('../includes/misc.class.php');
require_once('../includes/functions_general.php');
//This stops SQL Injection in POST vars
require_once('../includes/ws-user.class.php');

if (isset($_SESSION['user_id'])) {
    cheader("../dashboard.php");
}

foreach ($_POST as $key => $value) {
    $_POST[$key] = mysql_real_escape_string($value);
}
//This stops SQL Injection in GET vars
foreach ($_GET as $key => $value) {
    $_GET[$key] = mysql_real_escape_string($value);
} 
if ($_POST['email'] == "" ) {
    $msg= "Please provide email";
    echo json_encode(array("message"=>"$msg","status"=>"false"));
    exit("aaaa");
}

if (isset($_POST['email']) ) { // if first
    $rs['email'] = $_POST['email'];
   

    $USER = new USER_CLASS;
    $obj = (object) array('email' => $_POST['email']);
    $arr = $USER->forgotPassword($obj);
    
    echo json_encode($arr);
    
    
}
?>
