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
if ($_POST['username'] == "" && $_POST['password'] == "") {
    echo "Please provide email and password";
    die;
}

if (isset($_POST['password']) && (isset($_POST['username']))) { // if first
    $rs['username'] = $_POST['username'];
    $rs['password'] = $_POST['password'];

    $USER = new USER_CLASS;
    $obj = (object) array('username' => $_POST['username'], 'password' => $_POST['password']);

    $arr = $USER->login($obj);
    $user_id = $arr['userid'];
    $arr['message'];
    $_SESSION['user_id'] = $user_id;
    $token = sha1(SALT . $_SESSION['user_id']);
    setcookie("token", $token, time() + (86400 * 2), "/"); // 86400 = 1 day
    setcookie("user_id", $_SESSION['user_id'], time() + (86400 * 2), "/"); // 86400 = 1 day
    if ($arr['status'] == "false") {
        $arr['message'];
    }
}
?>
