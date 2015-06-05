<?php

require_once '../services/ws-comment.php';
if (!isset($_SESSION['user_id'])) {
    die("Please login");
}
$USER = new USER_CLASS;


//
//print_r($_post); die;



$userId = $_SESSION['user_id'];
$user_profile = $USER->getUserInfo($userId);
$post_id = (int) $_POST['post_id'];
$comment_text = $_POST['comment'];
$obj = (object) array('userid' => $userId, 'post_id' => $post_id, 'comment_text' => $comment_text);

// print_r($obj); die;
if ((int) $_POST['post_id'] > 0) {

    $comment = PostComment::makeComment((array) $obj);

    $comment_count = count($comment['comments']);
    $comments_text = $comment['comments'];


    $comment_user = $comments_text[$comment_count - 1]['user_name'];
    $user_comment = $comments_text[$comment_count - 1]['comment'];
    $user_thumbimage = $comments_text[$comment_count - 1]['user_thumbimage'];

    $detail = '<li><span><img src="' . base_path . $user_thumbimage . '"/></span><h6><a href="#">' . $comment_user . '</a></h6><p>' . $user_comment . '</p></li>';
    $data['status'] = "true";
    $data['detail'] = $detail;
    $data['total_comments'] = $comment_count;
} else {
    $data['status'] = "false";
}
echo json_encode($data);

