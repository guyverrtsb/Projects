<?php
require_once('../includes/app_top.php');
require_once('../includes/mysql.class.php');
require_once('../includes/global.inc.php');
require_once('../includes/misc.class.php');
require_once('../includes/mailer.class.php');
require_once('../includes/image_lib/image.class.php');
require_once('../includes/functions_general.php');
require_once('../includes/ws-user.class.php');

if (!isset($_SESSION['user_id'])) {
    die("Please login to view this page");
}
$USER = new USER_CLASS;
$data = array();
$data1 = array();

$requested_page = $_REQUEST['page_num'];

$userId = $_SESSION['user_id'];
$user_profile = $USER->getUserInfo($userId);
$user_thumbimage = $user_profile['user_thumbimage'];

$obj = (object) array('userid' => $userId, 'friend_id' => $userId, 'page' => $requested_page);

 $arr = Follow::userFollowings((array) $obj);

$followers_list = ($arr['followers_list']);

for ($i = 0; $i < $arr['total_records']; $i++) {

    $user_thumbimage = $followers_list[$i]['user_thumbimage'];
    $user_name = $followers_list[$i]['user_name'];
    $allow_follow = $followers_list[$i]['allow_follow'];
    $is_following = $followers_list[$i]['is_following'];
    if ($is_following == '1') {
        $class_follow = "check";
    } else if ($is_following == '0') {
        $class_follow = "plus";
    } else if ($is_following == '-1') {
        $class_follow = "exclamation";
    }
    
    $data[] = '<div class="follower">'
            . ' <div class="flwr_pic"><img src="' . $user_thumbimage . '" alt=""/></div>'
            . '<div class="fl_detail">'
            . '<h3>' . $user_name . '</h3>'
            . '<a href="#" class="btn btn-default rqst frnd_send">'
            . '<i class="fa fa-'.$class_follow.'"></i>'
            . ' <i class="fa fa-user "></i>'
            . '</a>'
            . '</div>'
            . '<div class="clr"></div>'
            . '</div>';
}
if(count($followers_list) > 0){
$data1['detail'] = $data;
$data1['status'] = "true";
}else{
    $data1['detail'] = "No record found";
$data1['status'] = "false";
}
echo json_encode($data1);

?>
