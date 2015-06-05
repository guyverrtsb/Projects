<?php header('Content-Type: application/json; Charset=UTF-8');
require_once('../includes/app_top.php');
require_once('../includes/mysql.class.php');
require_once('../includes/global.inc.php');
require_once('../includes/functions_general.php');
require_once('../includes/user.class.php');
require_once('../includes/image_functions.php');
require_once('../includes/follow.class.php');
require_once('../includes/signature.class.php');
require_once('../includes/image_lib/image.class.php');
include("../includes/upl_function.php");
//http://projectmanager/lookagram/services/ws-plans.php?type=ALLPLANS&signature=73b3a474d4ea4dbd856e59c3bb6359f0ca05aaec&data=[{%22userid%22:%2212%22}]
//http://projectmanager/lookagram/services/ws-plans.php?type=ADDSUBSCRIBER&signature=f309488949ede2a0150b92b66cdbcf5d0871e3f7&data=[{%22userid%22:%2212%22,%22plan_type%22:%22audio%22,%22plan_id%22:%221%22}]
//http://projectmanager/lookagram/services/ws-plans.php?type=USERPLANSTATUS&signature=f8c9bd26fa474a7f0dbfaadd03648ff54d74e19c&data=[{%22userid%22:%2212%22}]
$SIGNATURE = new SIGNATURE;
function createDir($path) {
		return ((!is_dir($path)) ? @mkdir($path, 0777) : TRUE);
	}

if (isset($_REQUEST['type']) && $_REQUEST['type'] != "") {
	$data = array();
	if (strtoupper($_REQUEST['type']) == "ALLPLANS") {
		$data = json_decode(str_replace("\\", "", urldecode($_GET['data'])));
		if ($SIGNATURE->checkValidRequest($_REQUEST)) {
				
			$arr = Plans::getPlans((array)$data[0]);
		}
		echo json_encode($arr);
	}
        if (strtoupper($_REQUEST['type']) == "USERPLANSTATUS") {
		$data = json_decode(str_replace("\\", "", urldecode($_GET['data'])));
		if ($SIGNATURE->checkValidRequest($_REQUEST)) {
				
			$arr = Subscriptions::userPlanStatus((array)$data[0]);
		}
		echo json_encode($arr);
	}
        if (strtoupper($_REQUEST['type']) == "ADDSUBSCRIBER") {
		$data = json_decode(str_replace("\\", "", urldecode($_GET['data'])));
		if ($SIGNATURE->checkValidRequest($_REQUEST)) {
				
			$arr = Subscriptions::addSubscriber((array)$data[0]);
		}
		echo json_encode($arr);
	}
       
	
	
}
