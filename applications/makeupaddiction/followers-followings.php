<?php
include_once './config.php';

if (!isset($_SESSION['user_id'])) {
    cheader("../index.php");
}
$userId = $_SESSION['user_id'];
?>
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
            <section class="outer_container">
                <div role="tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Followers</a></li>
                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Followings</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">

                            <?php
                            if (isset($_GET['user_id']) && ($_GET['user_id']) > 0) {
                                $userId = $_GET['user_id'];
                            }
                            $obj = (object) array('userid' => $userId, 'friend_id' => $userId);

                            $arr = Follow::userFollowers((array) $obj);
                            $followers_list = ($arr['followers_list']);

                            for ($i = 0; $i < $arr['total_records']; $i++) {

                                $user_thumbimage = $followers_list[$i]['user_thumbimage'];
                                $user_name = $followers_list[$i]['user_name'];
                                $allow_follow = $followers_list[$i]['allow_follow'];
                                $is_following = $followers_list[$i]['is_following'];
                                if ($is_following == '1') {
                                    $class_follow = "check";
                                } else if ($is_following == '0') {
                                    $class_follow = "plus";
                                } else if ($is_following == '-1') {
                                    $class_follow = "exclamation";
                                }
                                ?>
                                <div class="follower">
                                    <div class="flwr_pic"><img src="<?php echo $user_thumbimage ?>"></div>
                                    <div class="fl_detail">
                                        <h3><?php echo $user_name ?></h3>
                                        <a href="#" class="btn btn-default rqst frnd_send">
                                            <i class="fa fa-<?php echo $class_follow ?>"></i>
                                            <i class="fa fa-user "></i>
                                        </a>
                                    </div>
                                    <div class="clr"></div>
                                </div>
                                <?php
                            }
                            ?>



                            <div class="loadMore"></div>
                            <?php if ($arr['total_records'] > 10) { ?>
                                <div class="lomere"><a class="load_more" onclick="loadMore('<?php echo $arr['total_records'] ?>', 'lomere3', 'morepost3')" href="javascript:;">Load More</a></div>
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
                                if ((testo - 1) * 5 > actual_count) {
                                    $("." + loadid).hide();
                                } else {
                                    $('.loading_texts').show();
                                    $('.' + loadid).hide();
                                    $.ajax({
                                        type: "POST",
                                        url: "<?php echo base_path ?>ajax/getmyfollowers.php",
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

                            <?php
                            if (isset($_GET['user_id']) && ($_GET['user_id']) > 0) {
                                $userId = $_GET['user_id'];
                            }
                            $obj = (object) array('userid' => $userId, 'friend_id' => $userId);

                            $arr = Follow::userFollowings((array) $obj);

                            $following_list = ($arr['followers_list']);

                            for ($i = 0; $i < $arr['total_records']; $i++) {

                                $user_thumbimage = $following_list[$i]['user_thumbimage'];
                                $user_name = $following_list[$i]['user_name'];
                                $allow_follow = $following_list[$i]['allow_follow'];
                                $is_following = $following_list[$i]['is_following'];
                                if ($is_following == '1') {
                                    $class_follow = "check";
                                } else if ($is_following == '0') {
                                    $class_follow = "plus";
                                } else if ($is_following == '-1') {
                                    $class_follow = "exclamation";
                                }
                                ?>


                                <div class="follower">
                                    <div class="flwr_pic"><img src="<?php echo $user_thumbimage ?>"></div>
                                    <div class="fl_detail">
                                        <h3><?php echo $user_name ?></h3>
                                        <a href="#" class="btn btn-default rqst frnd_send">
                                            <i class="fa fa-<?php echo $class_follow ?>"></i>
                                            <i class="fa fa-user "></i>
                                        </a>
                                    </div>
                                    <div class="clr"></div>
                                </div>
                            <?php } ?>

                            <div class="loadMore1"></div>
                            <?php if ($arr['total_records'] > 5) { ?>
                                <div class="lomere"><a class="load_more" onclick="loadMore1('<?php echo $arr['total_records'] ?>', 'lomere3', 'morepost3')" href="javascript:;">Load More</a></div>
                                <div class="loading_texts" style="display:none"><img src="<?php echo base_path ?>images/loading.gif" width="30" height="30" /></div>
                                <?php } ?>

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
                                            url: "<?php echo base_path ?>ajax/getmyfollowing.php",
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
