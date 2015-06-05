<?php
require_once('../includes/app_top.php');
require_once('../includes/mysql.class.php');
require_once('../includes/global.inc.php');
require_once('../includes/functions_general.php');
require_once('../includes/user.class.php');
require_once('../includes/follow.class.php');
//require_once('../includes/push-notification.php');
require_once('../includes/signature.class.php');

$SIGNATURE = new SIGNATURE;
////http://projectmanager/lookagram/services/ws-follow.php?type=FOLLOWREQUEST&signature=ae003e9ceb116287e6ff55e7a418e18690421977&data=[{"userid":"38","other_id":"30","status":"-1"}]
////http://projectmanager/lookagram/services/ws-follow.php?type=REQUESTLIST&signature=17fcf49e9f8023b3a402d70b85ceb3c2222118ac&data=%5B{%22userid%22:%2264%22}%5D
//http://projectmanager/lookagram/services/ws-follow.php?type=USERFOLLOWERS&signature=957c1e16e62d4b19150c2439c744423ac5ba04b9&data=%5B{%22userid%22:%2230%22}%5D
//http://projectmanager/lookagram/services/ws-follow.php?type=USERFOLLOWING&signature=b4c3488f1aaa6c7e4ce808f39b660928f41417f6&data=%5B{%22userid%22:%2238%22}%5D
//http://projectmanager/lookagram/services/ws-follow.php?type=REQUESTACTION&signature=ae003e9ceb116287e6ff55e7a418e18690421977&data=[{"userid":"38","other_id":"30","status":"-1"}]
//http://projectmanager/lookagram/services/ws-follow.php?type=FOLLOWALL&signature=ae003e9ceb116287e6ff55e7a418e18690421977

if (strtoupper($_REQUEST['type']) == "FOLLOWALL") {
        $data = $_POST;
        if ($SIGNATURE->checkValidRequest($_REQUEST)) {
                $arr = Follow::followAll($_REQUEST);
                echo json_encode($arr);
        }
}
if (strtoupper($_REQUEST['type']) == "FOLLOWREQUEST") {
$data = json_decode(str_replace("\\", "", urldecode($_GET['data'])));
        if ($SIGNATURE->checkValidRequest($_REQUEST)) {
                $arr = Follow::followRequest((array)$data[0]);
                echo json_encode($arr);
        }
}
if (strtoupper($_REQUEST['type']) == "REQUESTLIST") {
$data = json_decode(str_replace("\\", "", urldecode($_GET['data'])));
        if ($SIGNATURE->checkValidRequest($_REQUEST)) {
                $arr = Follow::requestList((array)$data[0]);
                echo json_encode($arr);
        }
}
if (strtoupper($_REQUEST['type']) == "USERFOLLOWERS") {
$data = json_decode(str_replace("\\", "", urldecode($_GET['data'])));
        if ($SIGNATURE->checkValidRequest($_REQUEST)) {
                $arr = Follow::userFollowers((array)$data[0]);
                echo json_encode($arr);
}
}
if (strtoupper($_REQUEST['type']) == "REQUESTACTION") {
$data = json_decode(str_replace("\\", "", urldecode($_GET['data'])));
        if ($SIGNATURE->checkValidRequest($_REQUEST)) {
                $arr = Follow::requestAction((array)$data[0]);
                echo json_encode($arr);
}
}

if (strtoupper($_REQUEST['type']) == "USERFOLLOWING") {
$data = json_decode(str_replace("\\", "", urldecode($_GET['data'])));
        if ($SIGNATURE->checkValidRequest($_REQUEST)) {
                $arr = Follow::userFollowings((array)$data[0]);
                echo json_encode($arr);
}        
}




