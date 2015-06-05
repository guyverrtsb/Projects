<?php
include_once './config.php';

if (!isset($_SESSION['user_id'])) {
    cheader("../index.php");
}
?>
<body>
<main>

  <?php include './inner_header.php'; ?>

    <?php
    $userId = $_SESSION['user_id'];
    $obj = (object) array('userid' => $userId);
    $user_profile = $USER->getUserInfo($userId);
    $user_thumbimage = $user_profile['user_thumbimage'];
    ?>
    <!-- Main Container Starts -->        
    <section class="main_container">
        <section class="container">
            <section class="outer_container">
                <div role="tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Follower activity</a></li>
                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">your activity</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <?php
                            $obj = (object) array('userid' => $userId, 'page' => '1');
                            $arr = ActivityLog::myNotifications((array) $obj);
                            $notifications = ($arr['notifications']);


                            for ($i = 0; $i < $arr['total_current_record']; $i++) {
                                $message = $notifications[$i]->message;
                                $all_user = $notifications[$i]->all_users;
                                $time_ago = $notifications[$i]->time_ago;
//                                  
                                ?>
                                <div class="activity_list">
                                    <span><img src="<?php echo $all_user[0]['user_thumbimage'] ?>" alt=""/></span>	
                                    <div class="right_info">
                                        <label><a href="#"><?php echo $all_user[0]['user_name'] ?></a><!--<span><i class="fa fa-clock-o"></i>6 hours ago</span>--></label>		
                                        <p>
                                            <?php
                                            echo $message;
                                            ?>
                                        </p>
                                    </div>
                                    <div class="followed_info">
                                        <i class="right_arrow"></i>	
                                    </div>
                                    <span class="next_span"><img src="<?php echo base_path . $user_thumbimage ?>" alt=""/></span>	
                                    <p class="date"><i class="fa fa-clock-o"></i><span><?php echo $time_ago ?></span></p>
                                </div>
                                <?php
                            }
                            ?>
                            <div class="loadMore"></div>
                            <?php if ($arr['notification_total_record'] > 15) { ?>
                                <div class="lomere"><a class="load_more" onclick="loadMore('<?php echo $arr['notification_total_record'] ?>', 'lomere3', 'morepost3')" href="javascript:;">Load More</a></div>
                                <div class="loading_texts" style="display:none"><img src="<?php echo base_path ?>images/loading.gif" width="30" height="30" /></div>
                            <?php } ?>


                        </div>
                        <script>
                            var page = 1;
                            function loadMore(total, loadid, appendid) {

                                $('.loading_texts').hide();
                                var testo;

                                page++;
                                testo = page;

                                var data = {
                                    page_num: testo,
                                    userid: <?php echo $userId ?>,
                                };
                                var actual_count = total;
                                if ((testo - 1) * 15 > actual_count) {
                                    $("." + loadid).hide();
                                } else {
                                    $('.loading_texts').show();
                                    $('.' + loadid).hide();
                                    $.ajax({
                                        type: "POST",
                                        url: "<?php echo base_path ?>ajax/getmyactivity.php",
                                        data: data,
                                        success: function(res) {

                                            if (typeof res != 'object')
                                            {
                                                res = JSON.parse(res);
                                            }
                                            if (res.status == "true") {
                                            }
                                            $('.loadMore').append(res.detail);

                                            $('.loading_texts').hide();
                                            if ((testo) * 15 > actual_count) {
                                                $("." + loadid).hide();
                                            } else {
                                                $('.' + loadid).show();
                                            }
                                        },
                                        error: function() {
                                            alert('error');
                                            $('.loading_texts').hide();
                                        }
                                    });

                                }
                            }
                            ;
                        </script>
                        <div role="tabpanel" class="tab-pane" id="profile">
                            <!--                                <div class="gallery_like">
                                                                <a href="#"><img src="OverTribe_files/images/gallery_thumb1.png" alt=""/></a>	
                                                                <a href="#"><img src="OverTribe_files/images/gallery_thumb2.jpg" alt=""/></a>	
                                                                <a href="#"><img src="OverTribe_files/images/gallery_thumb3.jpg" alt=""/></a>	
                                                                <a href="#"><img src="OverTribe_files/images/gallery_thumb4.jpg" alt=""/></a>	
                                                                <a href="#"><img src="OverTribe_files/images/gallery_thumb2.jpg" alt=""/></a>	
                                                                <a href="#"><img src="OverTribe_files/images/gallery_thumb1.png" alt=""/></a>	
                                                                <a href="#"><img src="OverTribe_files/images/gallery_thumb4.jpg" alt=""/></a>	
                                                                <a href="#"><img src="OverTribe_files/images/gallery_thumb3.jpg" alt=""/></a>	
                                                            </div>-->
                                                            <!--<p class="liked_photos">Scott liked 8 photos.</p>-->
                            <?php
                            $obj = (object) array('userid' => $userId, 'page' => '1');
                            $arr = ActivityLog::followersNotifications((array) $obj);

                            $notifications = ($arr['notifications']);


                            for ($i = 0; $i < $arr['total_current_record']; $i++) {
                                $message = $notifications[$i]->message;
                                $all_user = $notifications[$i]->all_users;
                                $time_ago = $notifications[$i]->time_ago;
//                                  
                                ?>
                                <div class="activity_list">
                                    <span><img src="<?php echo $all_user[0]['user_thumbimage'] ?>" alt=""/></span>	
                                    <div class="right_info">
                                        <label><a href="#"><?php echo $all_user[0]['user_name'] ?></a><!--<span><i class="fa fa-clock-o"></i>6 hours ago</span>--></label>		
                                        <?php
                                        echo $message;
                                        ?>
                                    </div>
                                    <div class="followed_info">
                                        <i class="right_arrow"></i>	
                                    </div>
                                    <span class="next_span"><img src="<?php echo base_path . $user_thumbimage ?>" alt=""/></span>	
                                    <p class="date"><i class="fa fa-clock-o"></i><span><?php echo $time_ago ?></span></p>
                                </div>
                                <?php
                            }
                            ?>

                            <div class="loadMore1"></div>
                            <?php if ($arr['notification_total_record'] > 15) { ?>
                                <div class="lomere"><a class="load_more" onclick="loadMore1('<?php echo $arr['notification_total_record'] ?>', 'lomere3', 'morepost3')" href="javascript:;">Load More</a></div>
                                <div class="loading_texts" style="display:none"><img src="<?php echo base_path ?>images/loading.gif" width="30" height="30" /></div>
                                <?php } ?>


                        </div>
                        <script>
                            var page = 1;
                            function loadMore1(total, loadid, appendid) {

                                $('.loading_texts').hide();
                                var testo;

                                page++;
                                testo = page;

                                var data = {
                                    page_num: testo,
                                    userid: <?php echo $userId ?>,
                                };
                                var actual_count = total;
                                if ((testo - 1) * 15 > actual_count) {
                                    $("." + loadid).hide();
                                } else {
                                    $('.loading_texts').show();
                                    $('.' + loadid).hide();
                                    $.ajax({
                                        type: "POST",
                                        url: "<?php echo base_path ?>ajax/getfolloweractivity.php",
                                        data: data,
                                        success: function(res) {


                                            $('.loadMore1').append(res);

                                            $('.loading_texts').hide();
                                            if ((testo) * 15 > actual_count) {
                                                $("." + loadid).hide();
                                            } else {
                                                $('.' + loadid).show();
                                            }
                                        },
                                        error: function() {
                                            alert('error');
                                            $('.loading_texts').hide();
                                        }
                                    });

                                }
                            }
                            ;
                        </script>


                    </div>
                </div>
                </div>			
            </section>
        </section>
    </section><!-- Main Container Ends -->
</main>	
<script src="OverTribe_files/bootstrap.js" type="text/javascript"></script>	     
</body>
</html>
