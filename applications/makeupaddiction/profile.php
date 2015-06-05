<?php
include_once './config.php';
require_once './includes/ws-user.class.php';
$USER = new USER_CLASS;

if (!isset($_SESSION['user_id'])) {
    cheader("../index.php");
}
$userId = $_SESSION['user_id'];

$user_profile = $USER->getProfile((object) array("userid" => $userId, "friendid" => $userId));
//print_r($user_profile);
//die;
?>
<!doctype html>
<!--<html>

    <head>
        <meta charset="utf-8">
        <title>::Instanine::</title>
         Mobile Specific Metas 
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">		
        <link href="OverTribe_files/css/bootstrap.css" rel="stylesheet"> 
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link href="OverTribe_files/css/css.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="OverTribe_files/css/timeline.css" />
        <link href="OverTribe_files/css/style.css" rel="stylesheet">  
         Responsive CSS 
        <link href="OverTribe_files/css/responsive.css" rel="stylesheet"> 
        <script src="OverTribe_files/jquery-2.js" type="text/javascript"></script>
    </head>-->

<body>
<main>
    <!-- Header Starts -->
    <section class="outer_header">
        <div class="navbar">	
            <?php include './header.php'; ?>
        </div>
    </section>	<!-- Header Ends -->	
    <!-- Main Container Starts -->        
    <section class="main_container">
        <section class="container">
            <section class="center_profile">
                <section class="profile_outer">
                    <span><img src="<?php echo $user_profile['userdetail']['user_thumbimage'] ?>" alt=""/></span>	
                    <section class="right_profile">
                        <label><?php echo $user_profile['userdetail']['fname'] ?><a class="frnd_rqst" href="#"><img src="OverTribe_files/images/frnd_rqst.png" alt=""/></a></label>
                        <p class="button_follow">                   
                            <a href="#"><span><?php echo $user_profile['userdetail']['totalfollower'] ?></span> followers</a>
                            <a href="#"><span><?php echo $user_profile['userdetail']['totalfollowing'] ?></span> following</a>
                        </p>
                        <ul class="detail_info">
                            <li>
                                <b><i class="fa fa-user"></i></b>
                                <span>Username :</span>			
                                <p><?php echo $user_profile['userdetail']['user_name'] ?></p>
                            </li>
                            <li>
                                <b><i class="fa fa-envelope"></i></b>
                                <span>Email :</span>			
                                <p><?php echo $user_profile['userdetail']['email'] ?></p>
                            </li>
                            <li>
                                <b><i class="fa fa-ellipsis-h"></i></b>
                                <span>Description :</span>			
                                <p><?php echo $user_profile['userdetail']['user_bio'] ?>.</p>
                            </li>
                        </ul>
                    </section>

                    <div role="tabpanel">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><?php echo $user_profile['userdetail']['posts']['total_image_data'] ?> Images</a></li>
                            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><?php echo $user_profile['userdetail']['posts']['total_video_data'] ?> Videos</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="home">
                                <ul class="gallery">
                                    <?php
                                    foreach ($user_profile['userdetail']['posts']['image_data'] as $data) {
                                        ?>

                                        <li><a href="#"><img src="<?php echo $data['thumb_image'] ?>" alt=""/></a></li>
    <!--                                        <li><a href="#"><img src="OverTribe_files/images/gallery_thumb1.png" alt=""/></a></li>
    <li><a href="#"><img src="OverTribe_files/images/gallery_thumb2.jpg" alt=""/></a></li>
    <li><a href="#"><img src="OverTribe_files/images/gallery_thumb3.jpg" alt=""/></a></li>
    <li><a href="#"><img src="OverTribe_files/images/gallery_thumb4.jpg" alt=""/></a></li>
    <li><a href="#"><img src="OverTribe_files/images/gallery_thumb1.png" alt=""/></a></li>
    <li><a href="#"><img src="OverTribe_files/images/gallery_thumb4.jpg" alt=""/></a></li>
    <li><a href="#"><img src="OverTribe_files/images/gallery_thumb3.jpg" alt=""/></a></li>
    <li><a href="#"><img src="OverTribe_files/images/gallery_thumb2.jpg" alt=""/></a></li>-->

                                    <?php } ?>
                                </ul>        
                            </div>


                            <div role="tabpanel" class="tab-pane" id="profile">
                                <ul class="gallery">
                                    <?php
                                    foreach ($user_profile['userdetail']['posts']['video_data'] as $vdata) {
                                        ?>                     
                                        <li><a href="#"><img src="<?php echo $vdata['thumb_image'] ?>" alt=""/></a></li>
    <!--                                        <li><a href="#"><img src="OverTribe_files/images/gallery_thumb2.jpg" alt=""/></a></li>
                                        <li><a href="#"><img src="OverTribe_files/images/gallery_thumb3.jpg" alt=""/></a></li>
                                        <li><a href="#"><img src="OverTribe_files/images/gallery_thumb4.jpg" alt=""/></a></li>
                                        <li><a href="#"><img src="OverTribe_files/images/gallery_thumb1.png" alt=""/></a></li>
                                        <li><a href="#"><img src="OverTribe_files/images/gallery_thumb4.jpg" alt=""/></a></li>
                                        <li><a href="#"><img src="OverTribe_files/images/gallery_thumb3.jpg" alt=""/></a></li>
                                        <li><a href="#"><img src="OverTribe_files/images/gallery_thumb2.jpg" alt=""/></a></li>
                                        <li><a href="#"><img src="OverTribe_files/images/gallery_thumb4.jpg" alt=""/></a></li>-->


                                    <?php } ?>
                                </ul>    	 
                            </div>

                        </div>


                    </div>

                </section>				
            </section>
        </section>
    </section><!-- Main Container Ends -->
</main>	
<script src="OverTribe_files/bootstrap.js" type="text/javascript"></script>	     
</body>
</html>
