<?php
include_once './config.php';
?>
<?php include_once './header_top.php'; ?>

<html class=" js no-touch" lang="en"><!--<![endif]-->
    <body style="overflow: visible;">

        <style>
            .navbar-default  { background-color:transparent !important; border:none; padding:30px; }	
            .navbar-default .navbar-nav > li > a { color:#FFF; text-transform:uppercase; font-size:16px; font-weight:600; padding:0px; margin:12px 20px; }
            .navbar-default .navbar-nav > li > a:hover, .navbar-default .navbar-nav > li > a.active { color:#ff6600;}


            .modal-dialog.modal-md { margin-top:10%;}
            .myModel .modal-body { background:#f2f2f2; padding:40px 50px; border-bottom-left-radius:10px; border-bottom-right-radius:10px;}
            .myModel .modal-header { padding:20px;}
            .myModel .modal-header h4 { color:#999; }
            .myModel .modal-body .form-group label { display:inline-block; min-width:131px;}
            .myModel .modal-body .form-group input[type="text"] {display:inline-block;  width:69.7%; }
            .myModel .modal-body .form-group input[type="password"] {display:inline-block;  width:69.9%; }
            .myModel .modal-body span { display:block; margin-top:25px;}
            .myModel .modal-body a { float:left; margin-top:10px;}
            .myModel .modal-body button { float:right; }

            .myModel button.btn-primary { background:#0d85e0; padding:7px 20px; font-size:16px; font-weight:600; }

            .myModel .connectBtns { display:block;}
            .myModel .connectBtns a.fbBtn {float:left;}
            .myModel .connectBtns a.googleP {float:right;}

            .clr {clear:both}

        </style>
        <script src="OverTribe_files/mediaelement-and-player.js"></script>
        <link rel="Stylesheet" href="OverTribe_files/css/mediaelementplayer.css">
        <style type="text/css">
            .fb_hidden{position:absolute;top:-10000px;z-index:10001}.fb_invisible{display:none}
            .fb_reset{background:none;border:0;border-spacing:0;color:#000;cursor:auto;direction:ltr;font-family:"lucida grande", tahoma, verdana, arial, sans-serif;font-size:11px;font-style:normal;font-variant:normal;font-weight:normal;letter-spacing:normal;line-height:1;margin:0;overflow:visible;padding:0;text-align:left;text-decoration:none;text-indent:0;text-shadow:none;text-transform:none;visibility:visible;white-space:normal;word-spacing:normal}
            .fb_reset>div{overflow:hidden}.fb_link img{border:none}
            .fb_dialog{background:rgba(82, 82, 82, .7);position:absolute;top:-10000px;z-index:10001}
            .fb_reset .fb_dialog_legacy{overflow:visible}.fb_dialog_advanced{padding:10px;-moz-border-radius:8px;-webkit-border-radius:8px;border-radius:8px}
            .fb_dialog_content{background:#fff;color:#333}.fb_dialog_close_icon{background:url(http://static.ak.fbcdn.net/rsrc.php/v2/yq/r/IE9JII6Z1Ys.png) no-repeat scroll 0 0 transparent;_background-image:url(http://static.ak.fbcdn.net/rsrc.php/v2/yL/r/s816eWC-2sl.gif);cursor:pointer;display:block;height:15px;position:absolute;right:18px;top:17px;width:15px}
            .fb_dialog_mobile .fb_dialog_close_icon{top:5px;left:5px;right:auto}.fb_dialog_padding{background-color:transparent;position:absolute;width:1px;z-index:-1}
            .fb_dialog_close_icon:hover{background:url(http://static.ak.fbcdn.net/rsrc.php/v2/yq/r/IE9JII6Z1Ys.png) no-repeat scroll 0 -15px transparent;_background-image:url(http://static.ak.fbcdn.net/rsrc.php/v2/yL/r/s816eWC-2sl.gif)}
            .fb_dialog_close_icon:active{background:url(http://static.ak.fbcdn.net/rsrc.php/v2/yq/r/IE9JII6Z1Ys.png) no-repeat scroll 0 -30px transparent;_background-image:url(http://static.ak.fbcdn.net/rsrc.php/v2/yL/r/s816eWC-2sl.gif)}
            .fb_dialog_loader{background-color:#f6f7f8;border:1px solid #606060;font-size:24px;padding:20px}.fb_dialog_top_left,.fb_dialog_top_right,.fb_dialog_bottom_left,.fb_dialog_bottom_right{height:10px;width:10px;overflow:hidden;position:absolute}
            .fb_dialog_top_left{background:url(http://static.ak.fbcdn.net/rsrc.php/v2/ye/r/8YeTNIlTZjm.png) no-repeat 0 0;left:-10px;top:-10px}.fb_dialog_top_right{background:url(http://static.ak.fbcdn.net/rsrc.php/v2/ye/r/8YeTNIlTZjm.png) no-repeat 0 -10px;right:-10px;top:-10px}
            .fb_dialog_bottom_left{background:url(http://static.ak.fbcdn.net/rsrc.php/v2/ye/r/8YeTNIlTZjm.png) no-repeat 0 -20px;bottom:-10px;left:-10px}.fb_dialog_bottom_right{background:url(http://static.ak.fbcdn.net/rsrc.php/v2/ye/r/8YeTNIlTZjm.png) no-repeat 0 -30px;right:-10px;bottom:-10px}
            .fb_dialog_vert_left,.fb_dialog_vert_right,.fb_dialog_horiz_top,.fb_dialog_horiz_bottom{position:absolute;background:#525252;filter:alpha(opacity=70);opacity:.7}.fb_dialog_vert_left,.fb_dialog_vert_right{width:10px;height:100%}.fb_dialog_vert_left{margin-left:-10px}.fb_dialog_vert_right{right:0;margin-right:-10px}
            .fb_dialog_horiz_top,.fb_dialog_horiz_bottom{width:100%;height:10px}.fb_dialog_horiz_top{margin-top:-10px}.fb_dialog_horiz_bottom{bottom:0;margin-bottom:-10px}.fb_dialog_iframe{line-height:0}.fb_dialog_content .dialog_title{background:#6d84b4;border:1px solid #3a5795;color:#fff;font-size:14px;font-weight:bold;margin:0}
            .fb_dialog_content .dialog_title>span{background:url(http://static.ak.fbcdn.net/rsrc.php/v2/yd/r/Cou7n-nqK52.gif) no-repeat 5px 50%;float:left;padding:5px 0 7px 26px}body.fb_hidden{-webkit-transform:none;height:100%;margin:0;overflow:visible;position:absolute;top:-10000px;left:0;width:100%}
            .fb_dialog.fb_dialog_mobile.loading{background:url(http://static.ak.fbcdn.net/rsrc.php/v2/ya/r/3rhSv5V8j3o.gif) white no-repeat 50% 50%;min-height:100%;min-width:100%;overflow:hidden;position:absolute;top:0;z-index:10001}
            .fb_dialog.fb_dialog_mobile.loading.centered{max-height:590px;min-height:590px;max-width:500px;min-width:500px}#fb-root #fb_dialog_ipad_overlay{background:rgba(0, 0, 0, .45);position:absolute;left:0;top:0;width:100%;min-height:100%;z-index:10000}#fb-root #fb_dialog_ipad_overlay.hidden{display:none}.fb_dialog.fb_dialog_mobile.loading iframe{visibility:hidden}
            .fb_dialog_content .dialog_header{-webkit-box-shadow:white 0 1px 1px -1px inset;background:-webkit-gradient(linear, 0% 0%, 0% 100%, from(#738ABA), to(#2C4987));border-bottom:1px solid;border-color:#1d4088;color:#fff;font:14px Helvetica, sans-serif;font-weight:bold;text-overflow:ellipsis;text-shadow:rgba(0, 30, 84, .296875) 0 -1px 0;vertical-align:middle;white-space:nowrap}
            .fb_dialog_content .dialog_header table{-webkit-font-smoothing:subpixel-antialiased;height:43px;width:100%}
            .fb_dialog_content .dialog_header td.header_left{font-size:12px;padding-left:5px;vertical-align:middle;width:60px}.fb_dialog_content .dialog_header td.header_right{font-size:12px;padding-right:5px;vertical-align:middle;width:60px}
            .fb_dialog_content .touchable_button{background:-webkit-gradient(linear, 0% 0%, 0% 100%, from(#4966A6), color-stop(.5, #355492), to(#2A4887));border:1px solid #2f477a;-webkit-background-clip:padding-box;-webkit-border-radius:3px;-webkit-box-shadow:rgba(0, 0, 0, .117188) 0 1px 1px inset, rgba(255, 255, 255, .167969) 0 1px 0;display:inline-block;margin-top:3px;max-width:85px;line-height:18px;padding:4px 12px;position:relative}
            .fb_dialog_content .dialog_header .touchable_button input{border:none;background:none;color:#fff;font:12px Helvetica, sans-serif;font-weight:bold;margin:2px -12px;padding:2px 6px 3px 6px;text-shadow:rgba(0, 30, 84, .296875) 0 -1px 0}
            .fb_dialog_content .dialog_header .header_center{color:#fff;font-size:16px;font-weight:bold;line-height:18px;text-align:center;vertical-align:middle}
            .fb_dialog_content .dialog_content{background:url(http://static.ak.fbcdn.net/rsrc.php/v2/y9/r/jKEcVPZFk-2.gif) no-repeat 50% 50%;border:1px solid #555;border-bottom:0;border-top:0;height:150px}
            .fb_dialog_content .dialog_footer{background:#f6f7f8;border:1px solid #555;border-top-color:#ccc;height:40px}#fb_dialog_loader_close{float:left}.fb_dialog.fb_dialog_mobile .fb_dialog_close_button{text-shadow:rgba(0, 30, 84, .296875) 0 -1px 0}
            .fb_dialog.fb_dialog_mobile .fb_dialog_close_icon{visibility:hidden}
            .fb_iframe_widget{
                display:inline-block;position:relative}
            .fb_iframe_widget span{display:inline-block;position:relative;text-align:justify}
            .fb_iframe_widget iframe{position:absolute}.fb_iframe_widget_fluid_desktop,
            .fb_iframe_widget_fluid_desktop span,.fb_iframe_widget_fluid_desktop iframe{max-width:100%}
            .fb_iframe_widget_fluid_desktop iframe{min-width:220px;position:relative}
            .fb_iframe_widget_lift{z-index:1}.fb_hide_iframes iframe{position:relative;left:-10000px}
            .fb_iframe_widget_loader{position:relative;display:inline-block}
            .fb_iframe_widget_fluid{display:inline}.fb_iframe_widget_fluid span{width:100%}
            .fb_iframe_widget_loader iframe{min-height:32px;z-index:2;zoom:1}
            .fb_iframe_widget_loader .FB_Loader{background:url(http://static.ak.fbcdn.net/rsrc.php/v2/y9/r/jKEcVPZFk-2.gif) no-repeat;height:32px;width:32px;margin-left:-16px;position:absolute;left:50%;z-index:4}
        </style>


        <div class="container">


            <!-- Navigation Bar -->
            <div class="navbar-header">

                <!-- Responsive Menu -->
                <button type="button" id="nav-toggle" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-menu">
                    <span class="sr-only">Toggle navigation</span> 
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Logo Image -->
                <a class="navbar-brand" href="index.php"><img src="OverTribe_files/images/logo.png" alt="logo" role="banner"></a>

            </div>	<!-- End Navigation Bar -->


            <!-- Navigation Menu -->
            <nav id="navigation-menu" class="collapse navbar-collapse" role="navigation">
                <ul class="nav navbar-nav navbar-right">
                    <li><a id="GoToHome" class="selected-nav" href="dashboard.php">Home</a></li>
                    <li><a class="" id="GoToFeatures" href="profile_guest.php">Profile</a></li>							
                    <li><a class="" id="GoToScreens" href="activity.php">Activity</a></li>	
                    <!--<li><a class="" id="GoToVideo" href="#video">Video Review</a></li>-->
                   <li><a class="" id="GoToFaq" href="faq.php">FAQ</a></li>

                    <!--<li><a id="GoToSubscribe" href="#Subscribe">Subscribe</a></li>-->


                    <?php
                    require_once './includes/ws-user.class.php';
                        $USER = new USER_CLASS;
                    if (isset($_SESSION['user_id'])) {
                        $userId = $_SESSION['user_id'];
                        
                        $user_profile = $USER->getProfile((object) array("userid" => $userId, "friendid" => $userId));
                        ?>

                        <ul class="nav navbar-nav navbar-right">

                            <li class="dropdown"> <a href="javascript:;"  class="dropdown-toggle" data-toggle="dropdown">
                                    <!--<div class="sm_user"><img src="<?php echo $user_profile['userdetail']['user_thumbimage']; ?>"></div>--> 
                                    <span class="u_name">Hi! <?php echo $user_profile['userdetail']['fname']; ?> <b class="caret"></b></span>
                                    <div class="clr"></div></a>
                                <ul class="dropdown-menu">
                                    <li><a href="profile_guest.php"><i class="fa fa-user"></i> View Profile</a></li>

                                    <li class="divider"></li>
                                    <li><a href="<?= base_path . "logout.php" ?>"><i class="fa fa-sign-out"></i> Sign Out</a></li>
                                </ul>
                            </li>
                        </ul>
                    <?php } else {
                        ?>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown"> <a href="javascript:;"  class="dropdown-toggle" data-toggle="dropdown">
                                    <a id="loginpop" class="loginpop" data-toggle="modal" data-target="#largeModal" href="#newsletter">Sign in</a>
                                    <div class="clr"></div></a>

                            </li>
                        </ul>
                    <?php }
                    ?>

                </ul>
            </nav>  <!-- End Navigation Menu -->


        </div>	  <!-- End container -->
