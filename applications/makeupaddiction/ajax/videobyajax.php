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
$POST = new Posts;
$POST_COMMENT = new PostComment;

$userId = $_SESSION['user_id'];
$video_id = $_POST["vid"];
$post_data = $POST->getPost(array("post_id" => $video_id, "userid" => $userId));
$post_deatil = $post_data['posts'];
//print_r($post_deatil); die;
$comment_data = $POST_COMMENT->PostComments(array("post_id" => $video_id, "userid" => $userId));
$comment_deatil = $comment_data['comments']; 
 $user_profile = $USER->getProfile((object) array("userid" => $userId, "friendid" => $userId));
?>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>

        <div class="modal-body">
            <div class="M_Left">
                <img src="<?php echo $post_deatil['image'] ?>" alt=""/>
            </div>

            <div class="postDetails">             
                <span class="post_thumb"><img src="<?php echo $user_profile['userdetail']['user_thumbimage'] ?>" alt=""/></span>	
                <section class="right_postinfo">
                    <h5><a href="#"><?php echo $post_deatil['user_name'] ?></a></h5>				        
                    <p><?php echo $post_deatil['title'] ?></p>
                </section>
                <div class="clearfix"></div>
                <section class="like_details">
                    <a href="#"><?php echo $post_deatil['post_total_like'] ?></a> people like this post		
                </section>
                <section class="post_comments">
                    <ul>
                        <?php
                        $comments = $comment_deatil;
//                      print_r($comments[0]); die;
                        for ($i = 0; $i < count($comments); $i++) {
                            ?>
                            <li>   
                                <span><img src="<?php echo $comments[$i]['user_thumbimage']; ?>" alt=""/></span>	
                                <h6><a href="#"><?php echo $comments[$i]['user_name']; ?></a></h6>
                                <p><?php echo $comments[$i]['comment']; ?></p>
                            </li>	
                        <?php } ?>
                       
                    </ul>	
						<div class="inputCommentBx">
			<form id="addcomment">
			<textarea name="comment" placeholder="Enter text Here" class="commentboxpost" id="commentboxpost" onkeyup="textAreaAdjust(this)"></textarea>
		
			<input type="hidden" value="<?php echo $post_deatil['post_id'] ?>" name="post_id" id="commentpostid">
			<input type="submit" name="submit" value="">
							</form>
						</div>
                </section>
            </div>
        </div>


        <div class="clr"></div>

    </div>

</div>
