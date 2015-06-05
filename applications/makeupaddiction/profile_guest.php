<?php
include_once './config.php';

$POST = new Posts;
if (!isset($_SESSION['user_id'])) {
    cheader("../index.php");
}
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>::Instanine::</title>
        <!-- Mobile Specific Metas -->

    </head>

    <body>
    <main>

        <?php include './inner_header.php'; ?>




        <!-- Main Container Starts -->        
        <section class="main_container">
            <!--Top container Starts-->
            <section class="top_content">
                <section class="container">

<!--                    <section class="top_contentinner">

                    <?php
                    $i = 0;
                    foreach ($user_profile['userdetail']['posts']['image_data'] as $data) {
                        $i++;
                        ?>     
             <section class="thumb<?php echo $i ?> prfl_thumb">
                 <a data-target=".modal" data-toggle="modal"  href="#">
                     <img class="popup" data="<?php echo $data['post_id'] ?>" src="<?php echo $data['thumb_image'] ?>" alt=""/>
                 </a>

             </section>

                    <?php } ?>

 </section>        -->

                    <section class="top_contentinner">
                        <section class="thumb1 prfl_thumb">
                            <a href="#">
                                <!--<a data-toggle="modal" data-target=".modal" href="#">-->
                                <img src="OverTribe_files/images/banner_2.jpg" alt=""/>
                            </a>
                        </section>	
                        <section class="thumb2 prfl_thumb">
                            <a href="#"><img src="OverTribe_files/images/banner_1.jpg" alt=""/></a>
                        </section>	
                        <section class="thumb3 prfl_thumb">
                            <a href="#"><img src="OverTribe_files/images/banner_3.jpg" alt=""/></a>
                        </section>	
                        <section class="thumb4 prfl_thumb">
                            <a href="#"><img src="OverTribe_files/images/banner_4.jpg" alt=""/></a>
                        </section>	
                        <section class="thumb5 prfl_thumb">
                            <a href="#"><img src="OverTribe_files/images/banner_5.jpg" alt=""/></a>
                        </section>	
                        <section class="thumb6 prfl_thumb">
                            <a href="#"><img src="OverTribe_files/images/banner_7.jpg" alt=""/></a>
                        </section>	
                        <section class="thumb7 prfl_thumb">
                            <a href="#"><img src="OverTribe_files/images/banner_6.jpg" alt=""/></a>
                        </section>	
                    </section>        
                </section>
            </section>
            <!--Top container Ends-->
            <?php
            require_once './includes/ws-user.class.php';
            $USER = new USER_CLASS;
            $userId = $_SESSION['user_id'];

            if (isset($_GET['user_id']) && ($_GET['user_id']) > 0) {
                $userId = $_GET['user_id'];
            }
            $user_profile = $USER->getProfile((object) array("userid" => $userId, "friendid" => $userId));
            ?>

            <!--Profile Info Starts-->
            <section class="container profile_info">
                <div class="profile_thumb">
                    <span>
                        <img src="<?php echo $user_profile['userdetail']['user_thumbimage'] ?>" alt="" />
                    </span>	
                    <!--<button>Following</button>-->
                </div>
                <div class="profile_inforight">
                    <a href="#"><?php echo $user_profile['userdetail']['fname'] ?></a>	
                    <p><?php echo $user_profile['userdetail']['user_bio'] ?> <a href="<?php echo $user_profile['userdetail']['email'] ?>"><?php echo $user_profile['userdetail']['email'] ?></a></p>
                    <div class="follow_panel">
                        <?php
                        if (isset($_GET['user_id']) && ($_GET['user_id']) > 0) {
                            ?>
                            <a href="followers-followings.php?user_id=<?php echo $_GET['user_id']; ?>"><span><?php echo $user_profile['userdetail']['totalfollower'] ?></span>followers</a>
                        <?php } else {
                            ?>
                            <a href="followers-followings.php"><span><?php echo $user_profile['userdetail']['totalfollower'] ?></span>followers</a>
                            <?php }
                        ?>
                    </div>
                    <div class="follow_panel">
                        <?php
                        if (isset($_GET['user_id']) && ($_GET['user_id']) > 0) {
                            ?>
                        <a href="followers-followings.php?user_id=<?php echo $_GET['user_id']; ?>"><span><?php echo $user_profile['userdetail']['totalfollowing'] ?></span>following</a>
                         <?php } else {
                            ?>
                        <a href="followers-followings.php"><span><?php echo $user_profile['userdetail']['totalfollowing'] ?></span>following</a>
                          <?php }
                        ?>
                        
                    </div>
                    <?php $totalpost = $user_profile['userdetail']['posts']['total_image_data'] + $user_profile['userdetail']['posts']['total_video_data']; ?>
                    <div class="follow_panel">
                        <span><?php echo $totalpost ?></span>posts	
                    </div>
                </div>
            </section>

            <script>
                function quick_view(id)
                {
                    $('#zymId').val($('#zymId' + id).val());
                    $('#zymname').val($('#zymname' + id).val());

                    $('#location').val($('#location' + id).val());
                    $('#address').val($('#address' + id).val());
                    $('#phone').val($('#phone' + id).val());
                    $('#website').val($('#website' + id).val());
                    $('#timing').val($('#timing' + id).val());


                    $('#review').val($('#review' + id).val());
                    $('#theimage').wPopup();
                    $('#reviewId').val(id);
                }


            </script>
            <!--Profile Info Ends-->
            <!--Bottom Content Starts-->
            <section class="infocontent">
                <section class="container">
                    <div role="tabpanel">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-image"></i><?php echo $user_profile['userdetail']['posts']['total_image_data'] ?> Images</a></li>
                            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-video-camera"></i><?php echo $user_profile['userdetail']['posts']['total_video_data'] ?> Videos</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="home">  
                                <?php
                                foreach ($user_profile['userdetail']['posts']['image_data'] as $data) {
                                    ?>     
                                    <section class="col-md-3">
                                        <section class="content_thumbs">
                                            <a data-target=".modal" data-toggle="modal"  href="#">
                                                <img class="popup" data="<?php echo $data['post_id'] ?>" src="<?php echo $data['thumb_image'] ?>" alt=""/></a>
                                            <section class="data_info">
                                                <?php
                                                $tot = $POST->getPost(array("post_id" => $data['post_id'], "userid" => $userId));
//                                                echo '<pre>';
//                                                print_r($tot);
//                                                die;
                                                $post_id = $tot['posts']['post_id'];

                                                $isLike = $tot['posts']['is_post_liked'];

                                                $totallike = $tot['posts']['post_total_like'];
                                                $totalcomment = $tot['posts']['post_total_comment'];

                                                if ($isLike == 1) {
                                                    $class_like = "dislikepost";
                                                    $type = 0;
                                                } else {
                                                    $class_like = "likepost";
                                                    $type = 1;
                                                }
                                                ?>	
                                                <a href="javascript:;" <?php echo $isLike ?> class="postlike likepost dislikepost <?php echo $type . ' ' . $post_id ?>" data-post="<?php echo $post_id ?>" data-type="<?php echo $type ?>">
                                                    <i class="fa fa-heart"></i><span class="totallikepost<?php echo $post_id ?> popup" data='<?php echo $post_id ?>'><?php echo $tot['posts']['post_total_like'] ?>
                                                    </span>
                                                </a>
                                                <a href="javascript:;" class="totalcommentpost<?php echo $post_id ?>" data-post="<?php echo $post_id ?>">
                                                    <i class="fa fa-comments"></i><?php echo $tot['posts']['post_total_comment'] ?></a>    
                                                <span><?php echo $tot['posts']['time_ago'] ?></span>
                                            </section>
                                        </section>
                                    </section>	
                                <?php } ?>

                            </div>
                            <div role="tabpanel" class="tab-pane" id="profile">
                                <?php
                                foreach ($user_profile['userdetail']['posts']['video_data'] as $vdata) {
                                    ?> 
                                    <section class="col-md-3">
                                        <section class="content_thumbs">
                                            <a data-target=".modal" data-toggle="modal" href="#"><img class="videopopup" data="<?php echo $vdata['post_id'] ?>" src="<?php echo $vdata['thumb_image'] ?>" alt=""/></a>
                                            <section class="data_info">
                                                <?php
                                                $tot = $POST->getPost(array("post_id" => $vdata['post_id'], "userid" => $userId));
//						echo '<pre>'; print_r($tot); die;
                                                ?>	
                                                <a href="#"><i class="fa fa-heart"></i><?php echo $tot['posts']['post_total_like'] ?></a>    
                                                <a href="#"><i class="fa fa-comments"></i><?php echo $tot['posts']['post_total_comment'] ?></a>    
                                                <span><?php echo $tot['posts']['time_ago'] ?></span>
                                            </section>
                                        </section>
                                    </section>	
                                <?php } ?>

                            </div>
                        </div>
                    </div>	
                </section>	
            </section>
            <!--Bottom Content Endss-->
        </section><!-- Main Container Ends -->
    </main>	
    <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-lbelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>

                <!--                                <div class="modal-body">
                                                    <div class="M_Left">
                                                        <img src="OverTribe_files/images/banner_2.jpg" alt=""/>
                                                    </div>
                                
                                                    <div class="postDetails">             
                                                        <span class="post_thumb"><img src="OverTribe_files/images/banner_6.jpg" alt=""/></span>	
                                                        <section class="right_postinfo">
                                                            <h5><a href="#">Lucas Bernanrd</a></h5>				        
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam pellentesque et lacus et semper. Morbi cursus felis quis leo consequat, ut tristique orci sollicitudin. Nam maximus dolor quis odio volutpat sagittis. Maecenas sit amet suscipit nunc, eget rhoncus lectus. Vestibulum commodo tempor est, ac convallis metus rhoncus ut.</p>
                                                        </section>
                                                        <div class="clearfix"></div>
                                                        <section class="like_details">
                                                            <a href="#">32,58,749</a> people like this post		
                                                        </section>
                                                        <section class="post_comments">
                                                            <ul>
                                                                <li>
                                                                    <span><img src="OverTribe_files/images/gallery_thumb1.png" alt=""/></span>	
                                                                    <h6><a href="#">Beast_121990</a></h6>
                                                                    <p>Nullam a consequat libero. Ut justo nulla</p>
                                                                </li>	
                                                                <li>
                                                                    <span><img src="OverTribe_files/images/gallery_thumb2.jpg" alt=""/></span>	
                                                                    <h6><a href="#">Beast_121990</a></h6>
                                                                    <p>Nullam a consequat libero. Ut justo nulla</p>
                                                                </li>	
                                                                <li>
                                                                    <span><img src="OverTribe_files/images/gallery_thumb3.jpg" alt=""/></span>	
                                                                    <h6><a href="#">Beast_121990</a></h6>
                                                                    <p>Nullam a consequat libero. Ut justo nulla</p>
                                                                </li>	
                                                                <li>
                                                                    <span><img src="OverTribe_files/images/gallery_thumb4.jpg" alt=""/></span>	
                                                                    <h6><a href="#">Beast_121990</a></h6>
                                                                    <p>Nullam a consequat libero. Ut justo nulla</p>
                                                                </li>	
                                                                <li>
                                                                    <span><img src="OverTribe_files/images/gallery_thumb1.png" alt=""/></span>	
                                                                    <h6><a href="#">Beast_121990</a></h6>
                                                                    <p>Nullam a consequat libero. Ut justo nulla</p>
                                                                </li>	
                                                                <li>
                                                                    <span><img src="OverTribe_files/images/gallery_thumb2.jpg" alt=""/></span>	
                                                                    <h6><a href="#">Beast_121990</a></h6>
                                                                    <p>Nullam a consequat libero. Ut justo nulla</p>
                                                                </li>	
                                                                <li>
                                                                    <span><img src="OverTribe_files/images/gallery_thumb3.jpg" alt=""/></span>	
                                                                    <h6><a href="#">Beast_121990</a></h6>
                                                                    <p>Nullam a consequat libero. Ut justo nulla</p>
                                                                </li>	
                                                                <li>
                                                                    <span><img src="OverTribe_files/images/gallery_thumb4.jpg" alt=""/></span>	
                                                                    <h6><a href="#">Beast_121990</a></h6>
                                                                    <p>Nullam a consequat libero. Ut justo nulla</p>
                                                                </li>	
                                                            </ul>				
                                                        </section>
                                                    </div>
                                                </div>-->


                <div class="clr"></div>

            </div>

        </div>
    </div>
</div>
<script>

    $(document).ready(function() {
        $(".popup").click(function() {
            var dataImageId = $(this).attr('data');

            $.ajax({
                url: '<?php echo base_path; ?>ajax/image_popupbyajax.php',
                type: 'POST',
                data: {
                    imgid: dataImageId

                },
                success: function(data)
                {
                    $('#largeModal').html(data);
                }


            });

        });

    });





    $(document).ready(function() {
        $(".videopopup").click(function() {
            var datavideoId = $(this).attr('data');

            $.ajax({
                url: '<?php echo base_path; ?>ajax/videobyajax.php',
                type: 'POST',
                data: {
                    vid: datavideoId

                },
                success: function(data)
                {
                    $('#largeModal').html(data);
                }


            });

        });

    });



</script>
<script src="OverTribe_files/bootstrap.js" type="text/javascript"></script>	     
</body>
</html>
