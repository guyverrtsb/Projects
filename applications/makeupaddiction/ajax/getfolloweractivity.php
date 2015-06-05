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
//$data = array();

$requested_page = $_REQUEST['page_num'];

$userId = $_SESSION['user_id'];
$user_profile = $USER->getUserInfo($userId);
$user_thumbimage = $user_profile['user_thumbimage'];
$obj = (object) array('userid' => $userId, 'page' => $requested_page);

  $arr = ActivityLog::followersNotifications((array) $obj);

$notifications = ($arr['notifications']);


for ($i = 0; $i < $arr['total_current_record']; $i++) {
    $message = $notifications[$i]->message;
    $all_user = $notifications[$i]->all_users;
    $time_ago = $notifications[$i]->time_ago;


  
    $data[] = '<div class="activity_list">'
            . '<span><img src="' . $all_user[0]["user_thumbimage"] . '" alt=""/></span>'
            . '<div class="right_info">'
            . ' <label><a href="#">' . $all_user[0]["user_name"] . '</a></label>		
                                            <p>' . $message . '</p>
                                        </div>
                                        <div class="followed_info">
                                            <i class="right_arrow"></i>	
                                        </div>
                                        <span class="next_span"><img src="' . base_path . $user_thumbimage . '" alt=""/></span>	
                                        <p class="date"><i class="fa fa-clock-o"></i><span>' . $time_ago . '</span></p>
                                    </div>';
}

print_r($data);
?>
