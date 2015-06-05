<?php 
include_once './config.php';
if(isset($_SESSION['user_id']) ){
    cheader("../dashboard.php");
}
?>


<!-- HEADER
============================================= -->
<header id="header">		
    <div class="navbar navbar-fixed-top">	
        <?php include './header.php'; ?>
        <?php // include './header_top.php'; ?>
    </div>		<!-- End navbar fixed top  -->		
</header>	<!-- END HEADER -->



<!-- INTRO
============================================= -->
<section id="intro">
    <div class="container">
        <div class="row">


            <!-- Intro Description -->
            <div id="intro_description" class="col-md-7">

                <h1>Keep Up With Your Tribe</h1>
                <!--<h2>get social with your local community</h2>-->
                <h2>Stay connected with you local community of people who share common culture, customs, traditions, language, beliefs and more.</h2>
                <!--<p>
small text
                </p>-->

                <!-- Intro Stores Buttons -->
                <div id="intro_stores">
                    <a href="#"><img src="OverTribe_files/images/appstore.png" alt="appstore_icon"></a>			
                    <a href="#"><img src="OverTribe_files/images/google.png" alt="google_icon"></a>									
                    <!--<a href="#"><img src="img/icons/amazon.png" alt="amazon_icon" /></a>-->
                    <!-- <a href="#"><img src="img/icons/windows.png" alt="windows_icon" /></a> -->
                </div>

            </div>	<!-- End Intro Description -->

            <!-- Intro Image -->
            <div id="intro_image" class="col-md-5 text-center">						
                <img class="img-responsive" src="OverTribe_files/images/intro_image.png" alt="intro_image">							
            </div>									



        </div>	  <!-- End row -->					
    </div>	   <!-- End container -->
</section>	 <!-- END INTRO -->

<!-- VIDEO
============================================= -->		
<section id="video">
    <div class="container">
        <!-- Section Title -->
        <div class="row">			
            <div class="col-md-12 titlebar">
                <h2>Watch Instanine in action</h2>
                <p>See what Instanine is all about</p>
            </div>
        </div>
        <!-- Video Content -->				
        <div class="row">	
            <div id="video_content" class="col-lg-2"></div>
            <div id="video_holder" class="col-lg-8 triggerAnimation animated" >
                <!-- Video Link -->	
                <div class="video-block">													
                    <video width="640" height="360" id="player1" preload="none">
                        <source type="video/youtube" src="https://www.youtube.com/watch?v=knRqTB7nsLM" />
                    </video>
                </div>	
            </div>	
            <div id="video_content" class="col-lg-2"></div>
        </div>	<!-- End Video Content -->					
    </div>	  <!-- End container -->
</section>	<!-- END VIDEO -->


<!-- FEATURES
============================================= -->
<section id="features">
    <div class="container">	


        <!-- Section Title -->			
        <div class="row">
            <div class="col-sm-12 titlebar">
                <h2>Join Your Tribe</h2>	
                <p>Find and join your local Tribe based on your <strong>Nationality</strong>, <strong>Language</strong> and <strong>Faith</strong>.</p>				
                <!--<h2>Be part of your Tribe</h2>-->
                <!--<p>Everything about your community in one place.</p>-->
                                        <!--<p>Find. Join. Share. Stay Connected.</p>-->	
            </div>
        </div>


        <!-- Features Content Holder -->
        <div class="row">

            <!-- Left Side Content -->	
            <div id="features_left_content" class="col-md-4">

                <!-- Modern Design -->
                <div style="" class="feature-box triggerAnimation animated fadeInLeft" data-animate="fadeInLeft">	
                    <h4>Community Feed <i class="fa fa-users"></i></h4>
                    <p>Up-to-date feed displaying recent activities taking place in your tribe. See what your friends and followers are up to.</p>
                </div>

                <!-- Powerful Options -->	
                <div style="" class="feature-box triggerAnimation animated fadeInLeft" data-animate="fadeInLeft">	
                    <h4>News &amp; Alerts <i class="fa fa-newspaper-o"></i></h4>
                    <p>Inform your tribe with important news and alerts that matters. Keep your tribe well informed.</p>
                </div>	

                <!-- Bootstrap Grid -->
                <div style="" class="feature-box triggerAnimation animated fadeInLeft" data-animate="fadeInLeft">	
                    <h4>Spread The Word <i class="fa fa-bullhorn"></i></h4>
                    <p>Post your experiences, stories, questions and more. Announce events, programs, news and more.</p>
                </div>	

            </div>	 <!-- End Left Side Content -->		


            <!-- Features Image -->
            <div style="" id="features_image" class="col-md-4 text-center triggerAnimation animated clearfix bounceIn" data-animate="bounceIn">	
                <img class="img-responsive" src="OverTribe_files/images/i-phone.png" alt="features_image">
            </div>


            <!-- Right Side Content -->							
            <div id="features_right_content" class="col-md-4">	

                <!-- jQuery Effects -->
                <div style="" class="feature-box triggerAnimation animated fadeInRight" data-animate="fadeInRight">
                    <h4><i class="fa fa-calendar"></i> What's Happeing?</h4>
                    <p>Share your experience at local events. Figure out what's happening on the weekends, what the local specials are. 
                    </p>
                </div>

                <!-- Easy to Modify -->
                <div style="" class="feature-box triggerAnimation animated fadeInRight" data-animate="fadeInRight">
                    <h4><i class="fa fa-comments"></i> Make New Friends</h4>
                    <p>Find, invite, follow and connect with people you may know in your community. Expand your circle. </p>
                </div>	

                <!-- Premium Support -->
                <div style="" class="feature-box triggerAnimation animated fadeInRight" data-animate="fadeInRight">
                    <h4><i class="fa fa-glass"></i> Share Your Party</h4>
                    <p>Let your tribe know how you party. Post craziest moments of your parties and get-togethers.</p>						
                </div>	

            </div>	 <!-- End Right Side Content -->	

        </div>	 <!-- End Features Content Holder -->


    </div>		<!-- End container -->
</section>	 <!-- END FEATURES -->

<!-- BLACK PROMO LINE
============================================= -->	
<div id="black_promo_line">
    <div class="container">
        <div class="row">


            <div class="col-md-12 text-center">
                <h3 style="" class="triggerAnimation animated bounceIn" data-animate="bounceIn">Instanine is the <span>best landing page</span> and you can buy it today on Themeforest!</h3>
            </div>


        </div>	 <!-- End row -->
    </div>	 <!-- End container -->
</div>	  <!-- END BLACK PROMO LINE -->		

<!-- CALL TO ACTION
============================================= -->
<div style="" id="call_to_action" class="parallax hide">
    <div class="container">			
        <div class="row">


            <!-- Call To Action Slogan -->
            <div id="cta_slogan" class="col-md-9">
                <h2><span>Everything</span> about your <span>community</span> in one place.</h2>
                <!--<p>Use OverTribe to showcase your mobile app, services or business projects</p>-->
            </div>


            <!-- Call To Action Button -->
            <div id="cta_button" class="col-md-3 text-right hide">
                <a href="#" class="btn btn-theme">Purchase Now</a>
            </div>


        </div>	<!-- End row -->				
    </div>	  <!-- End container -->	
</div>	    <!-- END CALL TO ACTION -->



<!-- MORE FEATURES
============================================= -->
<div id="more_features" class="hide">
    <div class="container">				
        <div class="row">


            <!-- More Features Description -->
            <div id="more_features_description" class="col-md-6 col-lg-7">

                <h2 style="" class="triggerAnimation animated flipInX" data-animate="flipInX">Discover more amazing features</h2>

                <p style="" class="triggerAnimation animated flipInX" data-animate="flipInX">Maecenas sodales massa nec massa ultrices, nec bibendum ligula bibendum. Mauris id pharetra massa. 
                    Nullam varius purus molestie viverra dictum. Donec adipiscing consectetur neque nec consectetur.
                    Nam libero tortor, volutpat eget dictum 
                </p>


                <div class="row">

                    <!-- More Features List #1 -->
                    <div style="" class="col-xs-6 more_feature_box triggerAnimation animated bounceIn" data-animate="bounceIn">	
                        <div class="feature-box-icon">
                            <i class="fa fa-cog"></i>
                        </div>

                        <div class="feature-box-content">
                            <h4>Responsive Design</h4>
                            <p>Lorem ipsum dolor adipisicing tempor</p>
                        </div>							
                    </div>

                    <!-- More Features List #2 -->
                    <div style="" class="col-xs-6 more_feature_box triggerAnimation animated bounceIn" data-animate="bounceIn">	
                        <div class="feature-box-icon">
                            <i class="fa fa-language"></i>
                        </div>

                        <div class="feature-box-content">
                            <h4>Multi-language</h4>
                            <p>Lorem ipsum dolor adipisicing tempor</p>
                        </div>							
                    </div>

                </div>


                <div class="row">

                    <!-- More Features List #3 -->
                    <div style="" class="col-xs-6 more_feature_box triggerAnimation animated bounceIn" data-animate="bounceIn">	
                        <div class="feature-box-icon">
                            <i class="fa fa-leaf"></i>
                        </div>

                        <div class="feature-box-content">
                            <h4>Fresh Colors</h4>
                            <p>Lorem ipsum dolor adipisicing tempor</p>
                        </div>							
                    </div>

                    <!-- More Features List #4 -->
                    <div style="" class="col-xs-6 more_feature_box triggerAnimation animated bounceIn" data-animate="bounceIn">	
                        <div class="feature-box-icon">
                            <i class="fa fa-database"></i>
                        </div>

                        <div class="feature-box-content">
                            <h4>Cross-Browser</h4>
                            <p>Lorem ipsum dolor adipisicing tempor</p>
                        </div>							
                    </div>

                </div>

            </div>	<!-- End More Features Description -->


            <!-- More Features Image -->
            <div style="" class="col-md-6 col-lg-5 text-center triggerAnimation animated fadeInRight" data-animate="fadeInRight">
                <img class="img-responsive" src="OverTribe_files/images/tablet.png" alt="more_features_image">
            </div>


        </div>	<!-- End row -->				
    </div>	 <!-- End container -->
</div>	  <!-- END MORE FEATURES -->



<!-- STATISTIC BANNER
============================================= -->
<div style="" id="statistic_banner" class="parallax hide">
    <div class="container">


        <!-- Statistic Holder -->
        <div id="statistic-holder" class="row">

            <div class="col-md-12">
                <div class="row">
                    <!-- Statistic Element #1 -->
                    <div class="col-xs-3 col-sm-3 col-md-3 statistic-block">

                        <div class="statistic-number">1123</div>
                        <div class="statistic-text">Downloads</div>
                    </div>

                    <!-- Statistic Element #2 -->
                    <div class="col-xs-3 col-sm-3 col-md-3 statistic-block">

                        <div class="statistic-number">96</div>
                        <div class="statistic-text">Winning Awards</div>
                    </div>

                    <!-- Statistic Element #3 -->
                    <div class="col-xs-3 col-sm-3 col-md-3 statistic-block">

                        <div class="statistic-number">836</div>
                        <div class="statistic-text">People Rated 5</div>
                    </div>

                    <!-- Statistic Element #4 -->
                    <div class="col-xs-3 col-sm-3 col-md-3 statistic-block">

                        <div class="statistic-number">875</div>
                        <div class="statistic-text">Followers</div>
                    </div>

                </div>
            </div>

        </div>	<!-- End Statistic Holder -->


    </div>	<!-- End container -->		
</div>	<!-- END STATISTIC BANNER -->



<!-- CONTENT SLIDER
============================================= -->
<div id="content_slider" class="hide">
    <div class="container">	

        <!-- Content Slider -->	
        <div class="content_slider">	

            <div style="overflow: hidden; position: relative;" class="flex-viewport"><ul style="width: 1000%; transition-duration: 0s; transform: translate3d(0px, 0px, 0px);" class="slides"><li style="width: 0px; float: left; display: block;" class="slide_3 clone">
                        <div class="row">

                            <!-- Slide #3 Image -->	
                            <div class="col-md-5 col-lg-6 text-center">
                                <img class="img-responsive" src="OverTribe_files/images/slide_3_image.png" alt="slide_3_image">													
                            </div>	

                            <!-- Slide #3 Text -->
                            <div class="col-md-7 col-lg-6">

                                <h2>Fusce tempus amet scelerisque volutpat nulla dolor sapien fringilla risus</h2>

                                <p>Praesent semper, lacus sed cursus porta, odio augue feugiat tincidunt ligula massa. 
                                    Vestibulum ante ipsum primis
                                </p>

                                <p>Praesent semper, lacus sed cursus porta, odio augue feugiat eros, ac tincidunt ligula odio 
                                    augue feugiat eros posuere
                                </p>

                                <p>Praesent semper, lacus sed cursus porta, odio augue feugiat eros, ac tincidunt ligula odio 
                                    augue feugiat eros posuere
                                </p>

                                <!-- Read More Button -->
                                <a href="#" class="btn btn-theme btn-lg">Read More</a>

                            </div>	<!-- End Slide #3 Text -->																														

                        </div>	<!-- End row -->			
                    </li>	

                    <!-- Slide #1 -->
                    <li style="width: 0px; float: left; display: block;" class="slide_1 flex-active-slide">
                        <div class="row">

                            <!-- Slide #1 Image -->
                            <div class="col-md-5 col-lg-6 text-center">
                                <img class="img-responsive" src="OverTribe_files/images/slide_1_image.png" alt="slide_1_image">													
                            </div>

                            <!-- Slide #1 Text -->
                            <div class="col-md-7 col-lg-6">

                                <h2>Scelerisque volutpat dolor sapien</h2>

                                <p>Praesent semper, lacus sed cursus porta, odio augue feugiat eros, ac tincidunt ligula massa in est. 
                                    Vestibulum ante ipsum primis faucibus
                                </p>	

                                <!-- Banner One Feature List -->
                                <ul id="content_slider_list" class="clearfix">

                                    <!-- List Item #1 -->
                                    <li><i class="fa fa-check-square"></i>Vestibulum bibendum ullamcorper hend tellus</li>

                                    <!-- List Item #2 -->	
                                    <li><i class="fa fa-check-square"></i>Aliquam a suscipit, bibendum hendrerit tellus</li>

                                    <!-- List Item #3 -->
                                    <li><i class="fa fa-check-square"></i>Aliquam rhoncus bibendum ullamcorper hendrerit</li>

                                    <!-- List Item #4 -->
                                    <li><i class="fa fa-check-square"></i>Bibendum luctus neque laoreet rhoncus hendrerit</li>						

                                </ul>	<!-- End Banner One Feature List -->

                                <!-- Read More Button -->
                                <a href="#" class="btn btn-theme btn-lg">Read More</a>

                            </div>	<!-- End Slide #1 Text -->

                        </div>	<!-- End row -->			
                    </li>	<!-- End Slide #1 -->


                    <!-- Slide #2 -->
                    <li style="width: 0px; float: left; display: block;" class="slide_2">
                        <div class="row">	

                            <!-- Slide #2 Text -->
                            <div class="col-md-7 col-lg-6">

                                <h2>Fusce tempus amet scelerisque volutpat nulla dolor sapien fringilla</h2>

                                <p>Praesent semper, lacus sed cursus porta, odio augue feugiat eros, ac tincidunt ligula odio 
                                    augue feugiat eros posuere cubilia
                                </p>

                                <p>Massa in vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.
                                    Praesent semper, lacus sed cursus porta, odio augue feugiat eros, ac tincidunt ligula massa in est. 
                                    Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.
                                </p>

                                <!-- Read More Button -->
                                <a href="#" class="btn btn-theme btn-lg">Read More</a>

                            </div>	<!-- End Slide #2 Text -->

                            <!-- Slide #2 Image -->
                            <div class="col-md-5 col-lg-6 text-center">
                                <img class="img-responsive" src="OverTribe_files/images/slide_2_image.png" alt="slide_2_image">												
                            </div>	

                        </div>	<!-- End row -->			
                    </li>	<!-- End Slide #2 -->


                    <!-- Slide #3 -->
                    <li style="width: 0px; float: left; display: block;" class="slide_3">
                        <div class="row">

                            <!-- Slide #3 Image -->	
                            <div class="col-md-5 col-lg-6 text-center">
                                <img class="img-responsive" src="OverTribe_files/images/slide_3_image.png" alt="slide_3_image">													
                            </div>	

                            <!-- Slide #3 Text -->
                            <div class="col-md-7 col-lg-6">

                                <h2>Fusce tempus amet scelerisque volutpat nulla dolor sapien fringilla risus</h2>

                                <p>Praesent semper, lacus sed cursus porta, odio augue feugiat tincidunt ligula massa. 
                                    Vestibulum ante ipsum primis
                                </p>

                                <p>Praesent semper, lacus sed cursus porta, odio augue feugiat eros, ac tincidunt ligula odio 
                                    augue feugiat eros posuere
                                </p>

                                <p>Praesent semper, lacus sed cursus porta, odio augue feugiat eros, ac tincidunt ligula odio 
                                    augue feugiat eros posuere
                                </p>

                                <!-- Read More Button -->
                                <a href="#" class="btn btn-theme btn-lg">Read More</a>

                            </div>	<!-- End Slide #3 Text -->																														

                        </div>	<!-- End row -->			
                    </li>	<!-- End Slide #3 -->

                    <li style="width: 0px; float: left; display: block;" class="slide_1 clone">
                        <div class="row">

                            <!-- Slide #1 Image -->
                            <div class="col-md-5 col-lg-6 text-center">
                                <img class="img-responsive" src="OverTribe_files/images/slide_1_image.png" alt="slide_1_image">													
                            </div>

                            <!-- Slide #1 Text -->
                            <div class="col-md-7 col-lg-6">

                                <h2>Scelerisque volutpat dolor sapien</h2>

                                <p>Praesent semper, lacus sed cursus porta, odio augue feugiat eros, ac tincidunt ligula massa in est. 
                                    Vestibulum ante ipsum primis faucibus
                                </p>	

                                <!-- Banner One Feature List -->
                                <ul id="content_slider_list" class="clearfix">

                                    <!-- List Item #1 -->
                                    <li><i class="fa fa-check-square"></i>Vestibulum bibendum ullamcorper hend tellus</li>

                                    <!-- List Item #2 -->	
                                    <li><i class="fa fa-check-square"></i>Aliquam a suscipit, bibendum hendrerit tellus</li>

                                    <!-- List Item #3 -->
                                    <li><i class="fa fa-check-square"></i>Aliquam rhoncus bibendum ullamcorper hendrerit</li>

                                    <!-- List Item #4 -->
                                    <li><i class="fa fa-check-square"></i>Bibendum luctus neque laoreet rhoncus hendrerit</li>						

                                </ul>	<!-- End Banner One Feature List -->

                                <!-- Read More Button -->
                                <a href="#" class="btn btn-theme btn-lg">Read More</a>

                            </div>	<!-- End Slide #1 Text -->

                        </div>	<!-- End row -->			
                    </li></ul></div><ol class="flex-control-nav flex-control-paging"><li><a class="flex-active">1</a></li><li><a>2</a></li><li><a>3</a></li></ol><ul class="flex-direction-nav"><li><a class="flex-prev" href="#">Previous</a></li><li><a class="flex-next" href="#">Next</a></li></ul></div>


    </div>	  <!-- End container -->
</div>	<!-- END CONTENT SLIDER -->



<!-- PROMO BANNER
============================================= -->
<div style="" id="promo_banner" class="parallax hide">
    <div class="container">	


        <!-- Banner Tittle -->
        <div class="row">
            <div style="" class="col-sm-12 text-center triggerAnimation animated fadeInDown" data-animate="fadeInDown">
                <h2>EVERYTHING ABOUT YOUR COMMUNITY IN ONE PLACE</h2>
                <h3>Get involved. See if you can make it on your tribe feed today!</h3>
            </div>
        </div>


        <!-- Banner Image -->
        <div class="row">
            <div style="" class="col-sm-12 text-center triggerAnimation animated fadeInUp" data-animate="fadeInUp">
                <img class="img-responsive" src="OverTribe_files/images/promo_image.png" alt="promo_image">
            </div>
        </div>


    </div>	<!-- End container -->	
</div>	  <!-- END PROMO BANNER -->		



<!-- SCREENS
============================================= -->
<section id="screens">
    <div class="container">	


        <!-- Section Title -->				
        <div class="row">
            <div class="col-sm-12 titlebar">
                <h2>Screenshots</h2>
                <p>Check out what Instanine is all about!</p>
            </div>
        </div>


        <!-- Screens Row -->		
        <div class="row">
            <div class="col-md-12">
                <!-- Screenshots carousel holder -->
                <div id="screens_carousel" class="owl-carousel owl-theme">
                    <!-- Screenshot Image #1-->
                    <div class="item">
                        <div class="hover-overlay"> 
                            <img class="img-responsive" src="OverTribe_files/images/01Splash.png" alt="screenshot_image">

                            <!-- Image Zoom -->
                            <a class="prettyPhoto image_zoom" href="OverTribe_files/images/01Splash.png" title="News Feed">									
                                <div class="item-overlay">
                                    <div class="overlay-content">
                                        <h4>News Feed</h4>
                                    </div>
                                </div>	  
                            </a>
                        </div>	
                    </div>		
                    <!-- Screenshot Image #2-->

                    <div class="item">
                        <div class="hover-overlay"> 
                            <img class="img-responsive" src="OverTribe_files/images/02Home.png" alt="screenshot_image">

                            <!-- Image Zoom -->
                            <a class="prettyPhoto image_zoom" href="files/images/02Home.png" title="Post Detail">									
                                <div class="item-overlay">
                                    <div class="overlay-content">
                                        <h4>Post Detail</h4>
                                    </div>
                                </div>	  
                            </a>
                        </div>	
                    </div>

                    <!-- Screenshot Image #3-->

                    <div class="item">
                        <div class="hover-overlay"> 
                            <img class="img-responsive" src="OverTribe_files/images/01Splash.png" alt="screenshot_image">

                            <!-- Image Zoom -->
                            <a class="prettyPhoto image_zoom" href="OverTribe_files/images/01Splash.png" title="Profile">									
                                <div class="item-overlay">
                                    <div class="overlay-content">
                                        <h4>Profile</h4>
                                    </div>
                                </div>	  
                            </a>
                        </div>	
                    </div>

                    <!-- Screenshot Image #4-->

                    <div class="item">
                        <div class="hover-overlay"> 
                            <img class="img-responsive" src="OverTribe_files/images/02Home.png" alt="screenshot_image">

                            <!-- Image Zoom -->
                            <a class="prettyPhoto image_zoom" href="OverTribe_files/images/02Home.png" title="Invite Friends">									
                                <div class="item-overlay">
                                    <div class="overlay-content">
                                        <h4>Invite Friends</h4>
                                    </div>
                                </div>	  
                            </a>
                        </div>	
                    </div>

                    <!-- Screenshot Image #5-->

                    <div class="item">
                        <div class="hover-overlay"> 
                            <img class="img-responsive" src="OverTribe_files/images/01Splash.png" alt="screenshot_image">

                            <!-- Image Zoom -->
                            <a class="prettyPhoto image_zoom" href="OverTribe_files/images/01Splash.png" title="Select Photos & Video">									
                                <div class="item-overlay">
                                    <div class="overlay-content">
                                        <h4>Select Photos & Video</h4>
                                    </div>
                                </div>	  
                            </a>
                        </div>	
                    </div>

                    <!-- Screenshot Image #6-->

                    <div class="item">
                        <div class="hover-overlay"> 
                            <img class="img-responsive" src="OverTribe_files/images/02Home.png" alt="screenshot_image">

                            <!-- Image Zoom -->
                            <a class="prettyPhoto image_zoom" href="OverTribe_files/images/02Home.png" title="Select Video">									
                                <div class="item-overlay">
                                    <div class="overlay-content">
                                        <h4>Select Video</h4>
                                    </div>
                                </div>	  
                            </a>
                        </div>	
                    </div>

                    <!-- Screenshot Image #7-->

                    <div class="item">
                        <div class="hover-overlay"> 
                            <img class="img-responsive" src="OverTribe_files/images/01Splash.png" alt="screenshot_image">

                            <!-- Image Zoom -->
                            <a class="prettyPhoto image_zoom" href="OverTribe_files/images/01Splash.png" title="Video">									
                                <div class="item-overlay">
                                    <div class="overlay-content">
                                        <h4>Video</h4>
                                    </div>
                                </div>	  
                            </a>
                        </div>	
                    </div>

                    <!-- Screenshot Image #8-->

                    <div class="item">
                        <div class="hover-overlay"> 
                            <img class="img-responsive" src="OverTribe_files/images/02Home.png" alt="screenshot_image">

                            <!-- Image Zoom -->
                            <a class="prettyPhoto image_zoom" href="OverTribe_files/images/02Home.png" title="Find Members">									
                                <div class="item-overlay">
                                    <div class="overlay-content">
                                        <h4>Find Members</h4>
                                    </div>
                                </div>	  
                            </a>
                        </div>	
                    </div>

                    <!-- Screenshot Image #9-->
                    <div class="item">
                        <div class="hover-overlay"> 
                            <img class="img-responsive" src="OverTribe_files/images/01Splash.png" alt="screenshot_image">

                            <!-- Image Zoom -->
                            <a class="prettyPhoto image_zoom" href="OverTribe_files/images/01Splash.png" title="Login">									
                                <div class="item-overlay">
                                    <div class="overlay-content">
                                        <h4>Login</h4>
                                    </div>
                                </div>	  
                            </a>
                        </div>	
                    </div>

                    <div class="owl-controls clickable"><div class="owl-buttons"><div class="owl-prev"></div><div class="owl-next"></div></div></div></div>	<!-- End screenshots carousel holder -->


                <!-- Screenshots Carousel Navigation-->
                <div class="customNavigation text-center">
                    <a class="prev"></a>
                    <a class="next"></a>
                </div>


            </div>	<!-- End col-md-12 -->	
        </div>	<!-- End Screens Row -->	


    </div>		<!-- End container -->
</section>	 <!-- END SCREENS  -->


<!-- TESTIMONIALS ROTATOR
============================================= -->
<div style="background-position: 50% 0px;" id="testimonials_rotator" class="parallax hide">
    <div class="container text-center">
        <div class="row">					
            <div class="col-md-12">


                <!-- Rotator Content -->
                <div class="flexslider">											
                    <ul class="slides">

                        <!--Testimonial #1 -->
                        <li class="flex-active-slide" style="width: 100%; float: left; margin-right: -100%; position: relative; display: list-item;">
                            <div class="testimonials">

                                <!--Testimonial Message -->
                                <div class="client-msg">										
                                    <p>« Etiam condimentum sapien sem condimentum accumsan. Proin in adipiscing elit. Suspendisse dignissim sollicitudin 
                                        ornare at sagittis elementum vulputate congue »												   
                                    </p>												
                                </div>

                                <p class="author">Jonathan Doe <span>Programmer</span></p>

                            </div>
                        </li>

                        <!--Testimonial #2 -->	
                        <li style="width: 100%; float: left; margin-right: -100%; position: relative;">
                            <div class="testimonials">

                                <!--Testimonial Message -->
                                <div class="client-msg">													
                                    <p>« Suspendisse cursus risus laoreet turpis auctor, pharetra massa varius. Suspendisse dignissim sollicitudin aliquam.
                                        Nullam vehicula pharetra ultrices sapien gravida »
                                    </p>													
                                </div>

                                <p class="author">Karen Olson <span>Housewife</span></p>

                            </div>
                        </li>

                        <!--Testimonial #3 -->
                        <li style="width: 100%; float: left; margin-right: -100%; position: relative;">
                            <div class="testimonials">

                                <!--Testimonial Message -->
                                <div class="client-msg">	
                                    <p>« In eget urna nisl bibendum dapibus. Phasellus nec euismod mauris. Morbi vitae rutrum turpis.
                                        Phasellus molestie posuere ligula ligula aliquet imperdiet vitae »
                                    </p>													
                                </div>

                                <p class="author">Jonathan Doe <span>Manager</span></p>

                            </div>
                        </li>

                        <!--Testimonial #4 -->
                        <li style="width: 100%; float: left; margin-right: -100%; position: relative;">
                            <div class="testimonials">

                                <!--Testimonial Message -->
                                <div class="client-msg">													
                                    <p>« Vivamus a purus lacus tempor volutpat. Etiam odio purus, placerat interdum vestibulum rutrum aliquet vulputate.
                                        Proin euismod pulvinar aliquam » 
                                    </p>													
                                </div>

                                <p class="author">Hannah Brown <span>Internet Surfer</span></p>

                            </div>
                        </li>

                    </ul>												
                    <ol class="flex-control-nav flex-control-paging"><li><a class="flex-active">1</a></li><li><a>2</a></li><li><a>3</a></li><li><a>4</a></li></ol></div>	 <!-- End Rotator Content -->


            </div>	<!-- End col-sm-12 -->							
        </div>	<!-- End row -->  						
    </div>	 <!-- End container -->
</div>	   <!-- END TESTIMONIALS ROTATOR -->	



<!-- FAQs
============================================= -->		
<section id="faq">
    <div class="container">


        <!-- Section Title -->	
        <div class="row">
            <div class="col-md-12 titlebar">
                <h2>Have a few questions?</h2>
                <p>Of course you do. We've got answers! We've collected frequently asked questions</p>
            </div>
        </div>


        <div class="row">

            <div class="col-md-6">	

                <!-- Question #1-->
                <div style="" class="question triggerAnimation animated undefined">
                    <h4>Aliquam dapibus interdum lobortis ornare?</h4>
                    <p>Praesent semper, lacus sed cursus porta, odio augue feugiat eros, ac tincidunt ligula massa integer congue leo metus</p>
                </div>	

                <!-- Question #2-->
                <div style="" class="question triggerAnimation animated undefined">
                    <h4>Aliquam lobortis pretium ornare erat?</h4>
                    <p>Praesent semper, lacus sed cursus porta, odio augue feugiat eros, ac tincidunt ligula massa in est. 
                        Vestibulum ante ipsum primis in faucibus. Integer congue leo metus, eu mollis lorem viverra nec.
                    </p>
                </div>

                <!-- Question #3-->
                <div style="" class="question triggerAnimation animated undefined">
                    <h4>Aliquam interdum, lobortis pretium ornare erat?</h4>
                    <p>Praesent semper, lacus sed cursus porta, odio augue feugiat eros. Vestibulum ipsum primis in faucibus orci luctus et 
                        ultrices posuere cubilia Integer congue leo metus, mollis lorem viverra.
                    </p>
                </div>

            </div>


            <div class="col-md-6">	

                <!-- Question #4-->
                <div style="" class="question triggerAnimation animated undefined">
                    <h4>Aliquam lobortis pretium ornare erat?</h4>
                    <p>Praesent semper, lacus sed cursus porta, odio augue feugiat eros, ac tincidunt ligula massa in est. 
                        Vestibulum ante ipsum primis in faucibus. Integer congue leo metus, eu mollis lorem viverra nec.
                    </p>
                </div>

                <!-- Question #5-->
                <div style="" class="question triggerAnimation animated undefined">
                    <h4>Aliquam dapibus interdum turpis, lobortis pretium?</h4>
                    <p>Cursus porta, odio augue feugiat eros, ac tincidunt ligula 
                        massa. Praesent semper, lacus sed cursus porta, odio augue feugiat eros</p>
                </div>		

                <!-- Question #6-->
                <div style="" class="question triggerAnimation animated undefined">
                    <h4>Aliquam dapibus interdum turpis, lobortis?</h4>
                    <p>Praesent semper, lacus sed cursus porta, odio augue feugiat eros, ac tincidunt ligula massa in est. 
                        Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.
                    </p>
                </div>									

            </div>

        </div>	<!-- End row -->	


    </div>	  <!-- End container -->
</section>	<!-- END FAQs-->	



<!-- NEWSLETTER
============================================= -->		
<section id="newsletter">
    <div class="container hide">


        <!-- Newsletter Title -->		
        <div class="row">
            <div style="" class="col-sm-12 text-center triggerAnimation animated flipInX" data-animate="flipInX">
                <h1>Sign up for our newsletter now</h1>
                <p>Be amongst the first to know about news and upcoming features</p>
            </div>
        </div>


        <!-- Newsletter Form -->	
        <div class="row">

            <div class="col-md-12 text-center">

                <!-- Newsletter Form Message -->	
                <div class="message"></div>

                <form style="" id="newsletter_form" method="post" action="subscribe.php" class="triggerAnimation animated flipInX" data-animate="flipInX">
                    <div id="newsletterfields">
                        <input id="s_email" name="email" placeholder="Enter your email address" type="email">
                        <input value="Notify Me" type="submit">
                    </div>
                </form>	

            </div>					

        </div>	<!-- End row -->


    </div>	  <!-- End container -->
</section>	<!-- END NEWSLETTER -->



<!-- FOOTER
============================================= -->
<footer id="footer">
    <div class="container">


        <!-- Footer Social Icons -->
        <div class="row">									
            <div id="footer_icons" class="col-md-12 text-center">																	
                <ul class="footer-socials clearfix">
                    <li><a class="foo_social ico-facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a class="foo_social ico-twitter" href="#"><i class="fa fa-twitter"></i></a></li>	
                    <li><a class="foo_social ico-google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
                    <li><a class="foo_social ico-behance" href="#"><i class="fa fa-behance"></i></a></li>								
                    <li><a class="foo_social ico-dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>

                    <!--
                            <li><a class="foo_social ico-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a class="foo_social ico-digg" href="#"><i class="fa fa-digg"></i></a></li>
                            <li><a class="foo_social ico-deviantart" href="#"><i class="fa fa-deviantart"></i></a></li>
                            <li><a class="foo_social ico-envelope" href="#"><i class="fa fa-envelope-square"></i></a></li>							
                            <li><a class="foo_social ico-delicious" href="#"><i class="fa fa-delicious"></i></a></li>
                            <li><a class="foo_social ico-instagram" href="#"><i class="fa fa-instagram"></i></a></li>
                            <li><a class="foo_social ico-pinterest" href="#"><i class="fa fa-pinterest"></i></a></li>	
                            <li><a class="foo_social ico-dropbox" href="#"><i class="fa fa-dropbox"></i></a></li>
                            <li><a class="foo_social ico-skype" href="#"><i class="fa fa-skype"></i></a></li>
                            <li><a class="foo_social ico-youtube" href="#"><i class="fa fa-youtube"></i></a></li>
                            <li><a class="foo_social ico-tumblr" href="#"><i class="fa fa-tumblr"></i></a></li>
                            <li><a class="foo_social ico-vimeo" href="#"><i class="fa fa-vimeo-square"></i></a></li>
                            <li><a class="foo_social ico-flickr" href="#"><i class="fa fa-flickr"></i></a></li>
                            <li><a class="foo_social ico-github" href="#"><i class="fa fa-github-alt"></i></a></li>
                            <li><a class="foo_social ico-renren" href="#"><i class="fa fa-renren"></i></a></li>
                            <li><a class="foo_social ico-vk" href="#"><i class="fa fa-vk"></i></a></li>
                            <li><a class="foo_social ico-xing" href="#"><i class="fa fa-xing"></i></a></li>
                            <li><a class="foo_social ico-weibo" href="#"><i class="fa fa-weibo"></i></a></li>
                            <li><a class="foo_social ico-rss" href="#"><i class="fa fa-rss"></i></a></li>										
                    -->									

                </ul>
            </div>	 <!-- End Footer Social Icons -->	
        </div>


        <!-- Footer Copy-->
        <div class="row">	
            <div id="footer_copy" class="col-sm-12 text-center">	
                <p>Copyright 2015 <span>Instanine</span>. All Rights Reserved.</p>	
                <p><a href="#">About</a> 
                    <a href="#">FAQ </a> 
                    <a href="#">Terms of Use</a> 
                    <a href="#">Privacy Policy</a>  
                    <a href="#">Contact Us</a>     
                  
                </p>
            </div>	
        </div> 


    </div>	

    <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog modal-md" id="loginpopbox">
            <div class="modal-content myModel">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    <h4 class="modal-title" id="myModalLabel">Sign in</h4>
                </div>

                <div class="modal-body ">

                    <div class="alert alert-danger" style="display: none"></div>
                    <form action="index.php" name="frmlogin" id="frmlogin" method="post">

                        <div class="form-group"><label>Email:</label> <input class="form-control" name="username" value="admin" type="text"> </div>
                        <div class="form-group"><label>Password:</label> <input class="form-control" name="password" value="" type="password"> </div>

                        <span>
                            <a href="javascript:;" id="forgetpass">Forgot your password?</a>
                            <button type="submit" class="btn btn-primary">Sign in</button></span>         <div class="clr"></div>
                        <br>

                        <div align="center"><img src="OverTribe_files/images/orSep.png"></div>
                        <br>
                        <div class="clr"></div>

                        <div class="connectBtns"><a href="#" class="fbBtn"><img src="OverTribe_files/images/fbConnectBtn.png"></a>
                            <a href="#" class="googleP">
                            <!--<a href="https://accounts.google.com/o/oauth2/auth?response_type=code&amp;redirect_uri=http%3A%2F%2Fovertribe.com&amp;client_id=805489849732-26g16d1gubu86fvo5n7qlic7isb76g4o.apps.googleusercontent.com&amp;scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.email&amp;access_type=online&amp;approval_prompt=auto" class="googleP">-->
                                <img src="OverTribe_files/images/googleConnectBtn.png"></a></div>
                        <div style="clear:both" class="clr"></div> 
                    </form>
                </div>



            </div>
        </div>

        <div class="modal-dialog modal-md" id="forgetpop" style="display: none">
            <div class="modal-content myModel">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    <h4 class="modal-title" id="myModalLabel">Forgot Password</h4>
                </div>

                <div class="modal-body ">

                    <div class="alert alert-danger" style="display: none"></div>
                    <div class="alert alert-success" style="display: none"></div>
                    <form action="#" name="frmlogin" id="frmforget" method="post">

                        <div class="form-group"><label>Email:</label> <input class="form-control" name="email" type="text"> </div>

                        <span><a href="javascript:;" id="backtologin">Back to login</a>
                            <button type="submit" class="btn btn-primary">Submit</button></span>
                    </form>

                </div>
                <br>
                <div class="clr"></div>

            </div>
        </div>
    </div>
    <!-- End container -->							
</footer>	<!-- END FOOTER -->	



<script>
    $(function() {
        $('video').mediaelementplayer({
            success: function(media, node, player) {

                $('#' + node.id + '-mode').html('mode: ' + media.pluginType);
            }
        });
        $("#loginpop").click(function() {
            $("#loginpopbox").show();
            $("#forgetpop").hide();

        });
        $(document).on("submit", "#frmlogin", function() {
            $.post("ajax/login.php", $(this).serialize(), function(data) {

                if (data != "") {
                    $(".alert-danger").fadeIn();
                    $(".alert-danger").html(data);
                    setTimeout(function() {
                        $(".alert-danger").show();
                        $(".alert-danger").fadeOut();

                    }, 3000);


                }
                else {
                    window.location = "index.php";
                }

            });
            return false;
        });
        $(document).on("submit", "#frmforget", function() {
            $.post("ajax/forgetpass.php", $(this).serialize(), function(data) {
               data= JSON.parse(data);
                if (data.status == "false") { 
                    $(".alert").hide();
                    $(".alert-danger").fadeIn();
                    $(".alert-danger").html(data.message);
                    setTimeout(function() {
                        $(".alert-danger").show();
                        $(".alert-danger").fadeOut();

                    }, 3000);


                }
                else {
                    $(".alert").hide();
                    $(".alert-success").fadeIn();
                    $(".alert-success").html(data.message);
                    setTimeout(function() {
                        $(".alert-success").show();
                        $(".alert-success").fadeOut();

                    }, 3000);
                }

            });
            return false;
        })


//        $(".fbBtn").click(function() {
//            FB.login(function(response) {
//
//                if (response.status === 'connected') {
//                    FB.api('/me', function(response1) {
//
//                        console.log(response1);
//                        $.post("ajax/loginsocial.php", {email: response1.email, fb_id: response1.id, fbtoken: response.authResponse.accessToken, type: "Facebook"}, function(data) {
//                            if (data.trim() != "") {
//                                $(".alert-danger").fadeIn();
//                                $(".alert-danger").html(data);
//                                setTimeout(function() {
//                                    $(".alert-danger").show();
//
//
//                                });
//
//
//                            }
//                            else {
//                                window.location = "index.php";
//                            }
//
//                        })
//                    });
//                    // Logged into your app and Facebook.
//                } else if (response.status === 'not_authorized') {
//                    // The person is logged into Facebook, but not your app.
//                } else {
//                    // The person is not logged into Facebook, so we're not sure if
//                    // they are logged into this app or not.
//                }
//            }, {scope: 'public_profile,email'});
//        });




    })
</script>
<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId: '600759993400935',
            xfbml: true,
            version: 'v2.2'
        });

    };

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>	
<script>
    $(function() {
        $("#forgetpass").click(function() {
            $("#loginpopbox").slideUp();
            $("#forgetpop").slideDown()


        });
        $("#backtologin").click(function() {
            $("#forgetpop").slideUp();
            $("#loginpopbox").slideDown()


        });
        error = '';

        if (error != "")
        {
            $(".loginpop").click();
            $(".alert-danger").fadeIn();
            $(".alert-danger").html(error);
            setTimeout(function() {
                $(".alert-danger").show();


            });
        }
    })
</script>


<a style="position: fixed; z-index: 2147483647; display: none;" title="" href="#top" id="scrollUp"></a><div class=" fb_reset" id="fb-root"><div style="position: absolute; top: -10000px; height: 0px; width: 0px;"><div><iframe src="OverTribe_files/6Dg4oLkBbYq.htm" style="border: medium none;" tabindex="-1" title="Facebook Cross Domain Communication Frame" aria-hidden="true" id="fb_xdm_frame_http" scrolling="no" allowtransparency="true" name="fb_xdm_frame_http" frameborder="0"></iframe><iframe src="OverTribe_files/6Dg4oLkBbYq_002.htm" style="border: medium none;" tabindex="-1" title="Facebook Cross Domain Communication Frame" aria-hidden="true" id="fb_xdm_frame_https" scrolling="no" allowtransparency="true" name="fb_xdm_frame_https" frameborder="0"></iframe>
        </div>
    </div>
    <div style="position: absolute; top: -10000px; height: 0px; width: 0px;"><div>

        </div>

    </div>

</div>
<?php include './footer.php'; ?>