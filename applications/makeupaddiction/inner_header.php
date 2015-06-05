<link href="OverTribe_files/css/bootstrap.css" rel="stylesheet"> 
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link href="OverTribe_files/css/css.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="OverTribe_files/css/timeline.css" />
        <link href="OverTribe_files/css/style.css" rel="stylesheet">  
        <link href="OverTribe_files/css/fbphotobox.css" rel="stylesheet">  
        <!-- Responsive CSS -->
        <link href="OverTribe_files/css/responsive.css" rel="stylesheet"> 
        <script src="OverTribe_files/jquery-2.js" type="text/javascript"></script>
        <script src="OverTribe_files/common.js" type="text/javascript"></script>

        <section class="outer_header">
            <div class="navbar">	

    
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


                </div>

            </div>
        </section>