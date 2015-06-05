<?php 
header('Content-Type: application/json; Charset=UTF-8');
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
//http://projectmanager/lookagram/services/ws-post.php?type=COMMENT&signature=34553c738fc1a7df09a1c8762f1b2326a5cb437d&data=%5B{%22userid%22:%2212%22,%22post_id%22:%228%22,%22comment%22:%22aman%20jain%22}%5D
//http://projectmanager/lookagram/services/ws-post.php?type=POSTLIKE&signature=1970c1180c303fc80e84b79fff427ddaf3df9d47&data=[{"userid":"12","post_id":"8","status"=>"1"}]
//http://projectmanager/lookagram/services/ws-post.php?type=DELETEPOST&signature=ec88cd94ee60db44c1ab1f5c943ccdc94fb31736&data=%5B{%22userid%22:%2212%22,%22post_id%22:%228%22}%5D
//http://projectmanager/lookagram/services/ws-post.php?type=HOMEPOST&signature=cf9bc7ccfe1c3c01afb341e82c5b9d5c08a18c22&data=%5B{%22userid%22:%2212%22,%22page%22:%221%22}%5D
//http://projectmanager/lookagram/services/ws-post.php?type=GETPOST&signature=dedf4284521c6a1639a764b1df12b4ac3bdcbcf0&data=%5B{%22userid%22:%2212%22,%22post_id%22:%226%22}%5D
//http://projectmanager/lookagram/services/ws-post.php?type=POSTCOMMENTS&signature=4f78c9293161ff69e34daf1957e1aef16c40016e&data=%5B{%22userid%22:%2212%22,%22post_id%22:%221%22}%5D
//http://projectmanager/lookagram/services/ws-post.php?type=REPORTPOST&signature=33cf6adbcf34588814ab6faa629deb4208b97c55&data=%5B{%22userid%22:%2212%22,%22post_id%22:%228%22}%5D
//http://projectmanager/lookagram/services/ws-post.php?type=LIKEUSERLIST&signature=33cf6adbcf34588814ab6faa629deb4208b97c55&data=%5B{%22userid%22:%2212%22,%22post_id%22:%228%22,"page":"1"}%5D

//http://projectmanager/lookagram/services/ws-post.php?type=POPULARPOSTS&signature=dedf4284521c6a1639a764b1df12b4ac3bdcbcf0
//http://projectmanager/lookagram/services/ws-post.php?type=HASHPOSTS&signature=621c713788d8adc1dc55bf5a794b3ead89f15610&data=%5B{%22userid%22:%2241%22,%22hashtag%22:%22anil%22}%5D
$SIGNATURE = new SIGNATURE;
function createDir($path) {
		return ((!is_dir($path)) ? @mkdir($path, 0777) : TRUE);
	}

if (isset($_REQUEST['type']) && $_REQUEST['type'] != "") {
	$data = array();
	if (strtoupper($_REQUEST['type']) == "HASHPOSTS") {
		$data = json_decode(str_replace("\\", "", urldecode($_GET['data'])));
		if ($SIGNATURE->checkValidRequest($_REQUEST)) {
				
			$arr = Posts::postByHash((array)$data[0]);
		}
		echo json_encode($arr);
	}
        if (strtoupper($_REQUEST['type']) == "SQLCHECK") {
		$data = json_decode(str_replace("\\", "", urldecode($_GET['data'])));
		
				
			$arr = Posts::postByHash((array)$data[0]);
		
		echo json_encode($arr);
	}
        if (strtoupper($_REQUEST['type']) == "HOMEPOST") {
		$data = json_decode(str_replace("\\", "", urldecode($_GET['data'])));
		if ($SIGNATURE->checkValidRequest($_REQUEST)) {
				
			$arr = Posts::homePosts((array)$data[0]);
		}
		echo json_encode($arr);
	}
         if (strtoupper($_REQUEST['type']) == "POPULARPOSTS") {
		$data = json_decode(str_replace("\\", "", urldecode($_GET['data'])));
		if ($SIGNATURE->checkValidRequest($_REQUEST)) {
				
			$arr = Posts::popularPosts((array)$data[0]);
		}
		echo json_encode($arr);
	}
        if (strtoupper($_REQUEST['type']) == "GETPOST") {
		$data = json_decode(str_replace("\\", "", urldecode($_GET['data'])));
		if ($SIGNATURE->checkValidRequest($_REQUEST)) {
				
			$arr = Posts::getPost((array)$data[0]);
		}
		echo json_encode($arr);
	}
        if (strtoupper($_REQUEST['type']) == "POSTCOMMENTS") {
		$data = json_decode(str_replace("\\", "", urldecode($_GET['data'])));
		if ($SIGNATURE->checkValidRequest($_REQUEST)) {
				
			$arr = PostComment::PostComments((array)$data[0]);
		}
		echo json_encode($arr);
	}
        if (strtoupper($_REQUEST['type']) == "ADDPOST") {
		$data = $_POST;
                
		if ($SIGNATURE->checkValidRequest($_REQUEST)) {
				
			$arr = Posts::addPost($_POST);
		}
		echo json_encode($arr);
	}
        if (strtoupper($_REQUEST['type']) == "COMMENT") { 
		$data = json_decode(str_replace("\\", "", urldecode($_GET['data'])));
               
                if ($SIGNATURE->checkValidRequest($_REQUEST)) {
				
			$arr = PostComment::makeComment((array)$data[0]);
		}
		echo json_encode($arr);
	}
        if (strtoupper($_REQUEST['type']) == "POSTLIKE") { 
		$data = json_decode(str_replace("\\", "", urldecode($_GET['data'])));
               
                if ($SIGNATURE->checkValidRequest($_REQUEST)) {
				
			$arr = PostLike::like((array)$data[0]);
		}
		echo json_encode($arr);
	}
        if (strtoupper($_REQUEST['type']) == "DELETEPOST") { 
		$data = json_decode(str_replace("\\", "", urldecode($_GET['data'])));
               
                if ($SIGNATURE->checkValidRequest($_REQUEST)) {
				
			$arr = Posts::deletePost((array)$data[0]);
		}
		echo json_encode($arr);
	}
        if (strtoupper($_REQUEST['type']) == "REPORTPOST") { 
		$data = json_decode(str_replace("\\", "", urldecode($_GET['data'])));
               
                if ($SIGNATURE->checkValidRequest($_REQUEST)) {
				
			$arr = PostReport::makeReport((array)$data[0]);
		}
		echo json_encode($arr);
	}
        if (strtoupper($_REQUEST['type']) == "LIKEUSERLIST") { 
		$data = json_decode(str_replace("\\", "", urldecode($_GET['data'])));
               
                if ($SIGNATURE->checkValidRequest($_REQUEST)) {
				
			$arr = PostLike::likeUsersList((array)$data[0]);
		}
		echo json_encode($arr);
	}
        
	
	
}
