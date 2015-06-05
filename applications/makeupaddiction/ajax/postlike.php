<?php

require_once '../services/ws-post.php';
if (!isset($_SESSION['user_id'])) {
    die("Please login");
}
$userId = $_SESSION['user_id'];
if ((int) $_POST['postId'] > 0) {

//    $data=postLikeDislike($userId,$_POST['postId'],$_POST['likeType'],$_POST['reason']);
    $obj = (object) array('userid' => $userId, 'post_id' => $_POST['postId'], 'status' => $_POST['likeType']);

    $data = PostLike::like((array) $obj);
} else {
    $data['status'] = "false";
}
echo json_encode($data);

