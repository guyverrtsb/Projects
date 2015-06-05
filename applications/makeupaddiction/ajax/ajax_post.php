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

$data = array();
$data1 = array();
$data2 = array();
$requested_page = $_REQUEST['page_num'];

$userid = $_SESSION['user_id'];
$obj = (object) array('userid' => $userid, 'page' => $requested_page);

$arr = Posts::homePosts((array) $obj);

$post_data = $arr['posts'];

$post_count = count($post_data);

for ($i = 0; $i < $post_count; $i++) {
//for ($i = 0; $i < $arr['total_records']; $i++) {

    $data1['date'] = $post_data[$i]['dtdate'];
    $time_ago = $post_data[$i]['time_ago'];

    $userimagethumb = $post_data[$i]['user_image'];
    $username = $post_data[$i]['user_name'];
    $data1['title'] = '<span class="feed_thumb"><img alt="" src="' . $userimagethumb . '"></span><h3><a href="profile_guest.php?user_id='.$post_data[$i]['user_id'].'">' . $username . '</a>'
            . '<span class="time_posted"><i class="fa fa-clock-o"></i>' . $time_ago . '</span></h3>';

    $data1['media'] = 'IMAGE';
    $data1['load_next'] = true;
    $comment_count = count($post_data[$i]['last_three_comments']);
    $comments = array();
    for ($j = 0; $j < $comment_count; $j++) {
        $comment_user = $post_data[$i]['last_three_comments'][$j]['user_name'];
        $user_comment = $post_data[$i]['last_three_comments'][$j]['comment'];
        $comments[] = "<li><a>$comment_user  </a>  " . $user_comment . "</li>";
    }

    $comment = $comments;
    $image = array();
    $image[] = $post_data[$i]['thumb_image'];

    $post_id = $post_data[$i]['post_id'];

    $data1['images'] = $image;
    $data1['type'] = 'blog_post';

    $isLike = $post_data[$i]['is_post_liked'];

    $totallike = $post_data[$i]['post_total_like'];
    $totalcomment = $post_data[$i]['post_total_comment'];

    if ($isLike == 1) {
        $class_like = "dislikepost";
        $type = 0;
    } else {
        $class_like = "likepost";
        $type = 1;
    }


    $data1['content'] = '<a data-target=".modal" data-toggle="modal"  href="#">'
            . '<div class="votes">'
            . '<a href="javascript:;" ' . $isLike . ' class="lk2 postlike likepost dislikepost ' . "$type" . " " . $post_id . '" data-post="' . $post_id . '" data-type="' . $type . '">'
            . '<i class="fa fa-heart"></i> <span class="totallikepost' . $post_id . ' popup" data=' . $post_id . '>' . $totallike . ' Total voters'
            . '</span>'
            . '</a>'
            . '<a href="#" class="cmt2"><i class="fa fa-comment"></i> <span class="totalcommentpost' . $post_id . '">' . $totalcomment . ' comments</a></div></a>'
            . '<div class="vote_comments" onclick="showDetail(' . $post_id . ')" id="' . $post_id . '"  data-toggle="modal" data-target="#largeModal"  data-post="' . $post_id . '" >'
?><?php
if($comment_count > 0){
    for ($j = 0; $j < $comment_count; $j++) {
        $comment_user = $post_data[$i]['last_three_comments'][$j]['user_name'];
        $user_comment = $post_data[$i]['last_three_comments'][$j]['comment'];

        $data1['content'] .= "<li><span>$comment_user  </span>  <abbr>". $user_comment . "</abbr></li>";
    }
}else{
    $data1['content'] .= "<img src='images/no-comment.jpg'/>";
}
    '</div>';
//    $data1['content'] .=  " <div class='inputCommentBx' ><form id='addcomment' >"
//            ." <textarea onKeyUp='textAreaAdjust(this)' id='commentboxpost' class='commentboxpost form-control' placeholder='Enter text Here' name='comment'></textarea>"
//            ."<input id='commentpostid'  type='hidden' name='post_id' value='".$post_id."' />"
//                ."<input type='submit' class='btn btn-default btn-submit' value='post' name='submit' />"
//            ."</form></div>";


    $data2[] = $data1;
    $data = $data2;
}

print json_encode($data);
?>
