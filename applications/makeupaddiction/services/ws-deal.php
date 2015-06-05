<?php
require_once('../includes/app_top.php');
require_once('../includes/mysql.class.php');
require_once('../includes/global.inc.php');
require_once('../includes/functions_general.php');
require_once('../includes/user.class.php');
//require_once('../includes/push-notification.php');
require_once('../includes/signature.class.php');


$SIGNATURE = new SIGNATURE;

//http://projectmanager/selfieheat/services/ws-deal.php?type=getAllDeals&signature=810c12bd57374d148e9d9df979987d67f1e6a65f
//http://projectmanager/selfieheat/services/ws-deal.php?type=getSingleDeal&signature=875efd3a9a3117e9b9b797f3d5f56fa877a1c123&data=[{"dealid":"1","userid":"4"}]
//http://projectmanager/selfieheat/services/ws-deal.php?type=getDealDetail&signature=86f99c2a428c26116fe584c897cd5eade5cb45b2&data=[{"dealid":"1","userid":"4"}]
//http://projectmanager/selfieheat/services/ws-deal.php?type=getUserDeal&signature=90f833c1c7c9531c6a17be49b483dccb50209f11&data=[{"userid":"4"}]
//http://projectmanager/selfieheat/services/ws-deal.php?type=getAllCategory&signature=3d7915a29b4faee62fbbd7fe5e1b71eeb3d49e70


function setNotificationLike($type, $userid, $postid) {
	global $db;

	$type = $type;

	$userid = intval($userid);
	$postid = intval($postid);
	$chk_sql = "SELECT * FROM user_notification WHERE user_id='" . $userid . "' AND post_id='" . $postid . "' AND type='" . $type . "'";
	$exe_sql = $db->query($chk_sql);
	if ($exe_sql->size() <= 0) {

		$sql_notifi = "INSERT INTO user_notification (type,user_id,post_id,dtdate) VALUES (" .
				"'" . $type . "'," .
				"" . $userid . "," .
				"" . $postid . "," .
				"NOW())";
		$db->query($sql_notifi);
	}

	//return "1";
}

/* GET ALL CLOSED AND OPEN DEAL DETAILS */
function getAllDeals()
{
	global $db;
	$USER = new USER_CLASS;
	$status		=	'false';
	$openinfo	=	array();
	$closeinfo	=	array();
	$opendeal	=	array();
	$closedeal	=	array();
	$today		=	date("Y-m-d H:i:s"); 
	$sqlDeal	=	"SELECT * FROM deal_post WHERE 1 ";
	$exeDeal	=	$db->query($sqlDeal);
	if($exeDeal->size()>0)
	{
		while($resDeal=$exeDeal->fetch())
		{
			
			if($today<=$resDeal['end_date'])
			{
				$info['dealid']			=	$resDeal['deal_id'];
				$info['dealname']		=	$resDeal['deal_name']!=''?$resDeal['deal_name']:'';
				$info['prod_name']		=	$resDeal['prod_name']!=''?$resDeal['prod_name']:'';
				$info['prod_img']		=	$resDeal['prod_img']!=''?$resDeal['prod_img']:'';
				$info['prod_thumb_img']	=	$resDeal['prod_thumb_img']!=''?$resDeal['prod_thumb_img']:'';
				$info['description']	=	$resDeal['description']!=''?$resDeal['description']:'';
				$info['price']			=	$resDeal['price']!=''?$resDeal['price']:'';
				$info['dealdate']		=	$resDeal['dtdate'];
				$info['remainingTime']  =   $USER->getRemainingTimeInfo($resDeal['end_date'], $today, "x");
				$opendeal[]	  =	  $info;
			}
			else
			{
				$closeinfo['dealid']		=	$resDeal['deal_id'];
				$closeinfo['dealname']		=	$resDeal['deal_name']!=''?$resDeal['deal_name']:'';
				$closeinfo['prod_name']		=	$resDeal['prod_name']!=''?$resDeal['prod_name']:'';
				$closeinfo['prod_img']		=	$resDeal['prod_img']!=''?$resDeal['prod_img']:'';
				$closeinfo['prod_thumb_img']	=	$resDeal['prod_thumb_img']!=''?$resDeal['prod_thumb_img']:'';
				$closeinfo['description']	=	$resDeal['description']!=''?$resDeal['description']:'';
				$closeinfo['price']			=	$resDeal['price']!=''?$resDeal['price']:'';
				$closeinfo['dealdate']		=	$resDeal['dtdate'];
				$closeinfo['close']			= $USER->getTimeInfo($resDeal['end_date'], $today, "x");
				$closedeal[]	=	$closeinfo;
			}
		}
		$msg = "Find successfully.";
		$status	=	'true';
	}
	else
	{
		
			$msg = "No deals found.";
			$status	=	'false';
	}
	

	$arr = array("message" => $msg, "opendeal" => $opendeal,"closedeal"=>$closedeal, "status" => $status);

	return $arr;
	
}

/* GET USER DEAL DETAILS */
function getUserDeal($userid)
{
	global $db;
	$USER = new USER_CLASS;
	$status		=	'false';
	$openinfo	=	array();
	$closeinfo	=	array();
	$opendeal	=	array();
	$closedeal	=	array();
	$today		=	date("Y-m-d H:i:s"); 
	$sqlDeal	=	"SELECT * FROM deal_post AS DP INNER JOIN post AS P ON P.dealid=DP.deal_id  WHERE P.user_id='".intval($userid)."'";
	$exeDeal	=	$db->query($sqlDeal);
	if($exeDeal->size()>0)
	{
		while($resDeal=$exeDeal->fetch())
		{
                $info['dealid']			=	$resDeal['deal_id'];
				$info['dealname']		=	$resDeal['deal_name']!=''?$resDeal['deal_name']:'';
				$info['prod_name']		=	$resDeal['prod_name']!=''?$resDeal['prod_name']:'';
				$info['prod_img']		=	$resDeal['prod_img']!=''?$resDeal['prod_img']:'';
				$info['prod_thumb_img']	=	$resDeal['prod_thumb_img']!=''?$resDeal['prod_thumb_img']:'';
				$info['description']	=	$resDeal['description']!=''?$resDeal['description']:'';
				$info['price']			=	$resDeal['price']!=''?$resDeal['price']:'';
				$info['start_date']		=	$resDeal['start_date'];
                $info['end_date']		=	$resDeal['end_date'];
                $info['vote_claim']     = $resDeal['vote_claim'] != '' ? $resDeal['vote_claim'] : '';
                $info['hours_to_get_vote'] = $resDeal['hours_to_perform'] != '' ? $resDeal['hours_to_perform'] : '';
                $info['minute_to_get_vote'] = $resDeal['minute_to_perform'] != '' ? $resDeal['minute_to_perform'] : '';
                $info['deal_start_date']	 =	date('Y-m-d',strtotime($resDeal['start_date']));
                $info['deal_start_time']	 =	date('h:i',strtotime($resDeal['start_date']));
                $info['deal_end_date']	 =	date('Y-m-d',strtotime($resDeal['end_date']));
                $info['deal_end_time']	 =	date('h:i',strtotime($resDeal['end_date']));
				
				
			
			if($today<=$resDeal['end_date'])
			{
                $info['dealtime']  =   $USER->getRemainingTimeInfo($resDeal['end_date'], $today, "x");
				$info['status'] =   "OPEN";
			}
			else
			{
                $info['dealtime']			= $USER->getTimeInfo($resDeal['end_date'], $today, "x");
                $info['status'] =   "CLOSE";
				
			}
            $opendeal[]	  =	  $info;
		}
		$msg = "Find successfully.";
		$status	=	'true';
	}
	else
	{
		
			$msg = "No deals found.";
			$status	=	'false';
	}
	

	$arr = array("message" => $msg, "opendeal" => $opendeal, "status" => $status);

	return $arr;
	
}




/* GET SINGLE DEAL DETAILS */
function getSingleDeal($dealid,$userid)
{
	global $db;
	$USER = new USER_CLASS;
	$status	=	'false';
	$openinfo	=	array();
	$closeinfo	=	array();
	$deal	=	 array();
	
	$today		=	date("Y-m-d H:i:s"); 
   
   
	$sqlDeal	=	"SELECT * FROM deal_post WHERE 1 AND deal_id='".intval($dealid)."'";
	$exeDeal	=	$db->query($sqlDeal);
	if($exeDeal->size()>0)
	{
		while($resDeal=$exeDeal->fetch())
		{
			
			//echo FormatDateSql($resDeal['end_date']);
			//getRemainingTimeInfo
			$info['dealid']     = $resDeal['deal_id'];
            $info['dealname']   = $resDeal['deal_name'] != '' ? $resDeal['deal_name'] : '';
            $info['prod_name']  = $resDeal['prod_name'] != '' ? $resDeal['prod_name'] : '';
            $info['prod_img']   = $resDeal['prod_img'] != '' ? $resDeal['prod_img'] : '';
            $info['prod_thumb_img'] = $resDeal['prod_thumb_img'] != '' ? $resDeal['prod_thumb_img'] : '';
            $info['description'] = $resDeal['description'] != '' ? $resDeal['description'] : '';
            $info['price']       = $resDeal['price'] != '' ? $resDeal['price'] : '';
            $info['vote_claim']  = $resDeal['vote_claim'] != '' ? $resDeal['vote_claim'] : '';
            $info['hours_to_get_vote'] = $resDeal['hours_to_perform'] != '' ? $resDeal['hours_to_perform'] : '';
            $info['minute_to_get_vote'] = $resDeal['minute_to_perform'] != '' ? $resDeal['minute_to_perform'] : '';
            $info['deal_start_date']	 =	date('Y-m-d',strtotime($resDeal['start_date']));
            $info['deal_start_time']	 =	date('h:i',strtotime($resDeal['start_date']));
            $info['deal_end_date']	 =	date('Y-m-d',strtotime($resDeal['end_date']));
            $info['deal_end_time']	 =	date('h:i',strtotime($resDeal['end_date']));
            
             $sql_post   =   "SELECT post_id FROM post WHERE user_id='".intval($userid)."' AND dealid='".intval($resDeal['deal_id'])."'";
             $exe_post   =   $db->query($sql_post);
             if($exe_post->size()>0)
             {
                 $info['participate']   =   "YES";
             }
             else
             {
                 $info['participate']   =   "NO";
             }
            
			
			
			if($today<=$resDeal['end_date'])
			{
				
				$info['remainingTime']  = $USER->getRemainingTimeInfo($resDeal['end_date'], $today, "x");
				$info['status']	=	"OPEN";
				$deal[]	=	$info;
			}
			else
			{
				
				$info['close']	= $USER->getTimeInfo($resDeal['end_date'], $today, "x");
				$info['status']	=	"CLOSE";
				$deal[]	=	$info;
			}
		}
		$msg = "Find successfully.";
		$status	=	'true';
	}
	else
	{
		
			$msg = "No deals found.";
			$status	=	'false';
	}
    
    
	

	$arr = array("message" => $msg, "deal" => $deal, "status" => $status);

	return $arr;
	
}

function getAllCategory()
{
	global $db;
	$USER = new USER_CLASS;
	$status		=	'false';
	$category	=	array();
	
	$today		=	date("Y-m-d h:i:s"); 
	$sqlDeal	=	"SELECT * FROM category WHERE 1 ORDER BY cat_name ASC ";
	$exeDeal	=	$db->query($sqlDeal);
	if($exeDeal->size()>0)
	{
		while($resDeal=$exeDeal->fetch())
		{
			
				$info['cat_id']     =	$resDeal['cat_id'];
				$info['cat_name']	=	$resDeal['cat_name'];
				$info['cat_img']	=	$resDeal['cat_img']!=''?$resDeal['cat_img']:'';
				$category[]	=	$info;
			
		}
		$msg = "find successfully.";
		$status	=	'true';
	}
	else
	{
		
			$msg = "No category found.";
			$status	=	'false';
	}
	

	$arr = array("message" => $msg, "category" => $category, "status" => $status);

	return $arr;
}

$arr = array();


/* GET ALL DEAL DETAILS */
if (isset($_REQUEST['type']) && $_REQUEST['type'] != "") {

	$data = array();

	if (strtoupper($_REQUEST['type']) == "GETALLDEALS") {
		
		if ($SIGNATURE->checkValidRequest($_REQUEST)) {
			$arr = getAllDeals();
		}

		echo json_encode($arr);
	}
	/* GET SINGLE DEAL DETAILS */
	if (strtoupper($_REQUEST['type']) == "GETSINGLEDEAL") {

		$data = json_decode(str_replace("\\", "", $_GET['data']));

		$dealid = (trim($data[0]->dealid));
        $userid = (trim($data[0]->userid));

		if ($SIGNATURE->checkValidRequest($_REQUEST)) {
			$arr = getSingleDeal($dealid,$userid);
		}

		echo json_encode($arr);
	}
	
    /*GET USER DEAL*/
    if (strtoupper($_REQUEST['type']) == "GETUSERDEAL") {

		$data = json_decode(str_replace("\\", "", $_GET['data']));

		$userid = (trim($data[0]->userid));

		if ($SIGNATURE->checkValidRequest($_REQUEST)) {
			$arr = getUserDeal($userid);
		}

		echo json_encode($arr);
	}
    
	
	/* GET ALL DEAL DETAILS */
if (isset($_REQUEST['type']) && $_REQUEST['type'] != "") {

	$data = array();

	if (strtoupper($_REQUEST['type']) == "GETALLCATEGORY") {
		
		if ($SIGNATURE->checkValidRequest($_REQUEST)) {
			$arr = getAllCategory();
		}

		echo json_encode($arr);
	}
	
}
}





