<?php
include_once './config.php';

if (!isset($_SESSION['user_id'])) {
    cheader("../index.php");
}
?>
<!doctype html>



<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link href="OverTribe_files/css/css.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="OverTribe_files/css/timeline.css" />
<link href="OverTribe_files/css/style.css" rel="stylesheet">  
<!-- Responsive CSS -->
<link href="OverTribe_files/css/responsive.css" rel="stylesheet"> 
<script src="OverTribe_files/jquery-2.js" type="text/javascript"></script>
<!--Timeline-->
<link rel="stylesheet" type="text/css" href="OverTribe_files/css/demo.css" />
<link href="OverTribe_files/css/owl.css" rel="stylesheet">	
<script type="text/javascript" src="OverTribe_files/timeline.min.js"></script>
<script language="javascript" type="text/javascript" src="OverTribe_files/common.js"></script>
<script src="OverTribe_files/bootstrap.js" type="text/javascript"></script>
<link href="OverTribe_files/css/bootstrap.css" rel="stylesheet"> 

</head>

<body>
<main>
    <!-- Header Starts -->
    <section class="outer_header">
        <div class="navbar">
            <?php include './header.php'; ?>  
        </div>
    </section>	<!-- Header Ends -->	


    <?php // include './header_top.php'; ?>
  

  

    <link href="OverTribe_files/css/fbphotobox.css" rel="stylesheet">  
    <!-- Responsive CSS -->
    
    <script src="OverTribe_files/jquery-2.js" type="text/javascript"></script>
    <script src="OverTribe_files/common.js" type="text/javascript"></script>

    <!-- Main Container Starts -->        
    <section class="main_container">
        <section class="container">
            <section class="col-md-10">
                <div id="menu">
                    <div>2015</div>
                    <!--<div><?php echo date("Y"); ?></div>--> 
                </div>
                <div id="timeline" style="width:100%;max-width:100%;margin:auto;"></div>

                <div id="loadmore">Load More</div>

            </section>
            <section class="col-md-2 fixed_section">   
                <ul class="month_post filterpost">
                    <?php

                    function getMonthPost() {
                        global $db;
                        $arr = array();
                        $sqlchk = "select * from(SELECT * FROM post WHERE 1 group by Year(dtdate),Month(dtdate) ORDER BY Month(dtdate)   DESC) tbl order by Year(dtdate) DESC";
                        $resultchk = $db->query($sqlchk);
                        while ($rs = $resultchk->fetch($sqlchk)) {
                            $month = date("F", strtotime($rs['dtdate']));
                            $year = date("Y", strtotime($rs['dtdate']));

                            $arr[$year][] = $month;
                        }

                        return $arr;
                    }

                    foreach (getMonthPost() as $Year => $month) {
                        foreach ($month as $YearVal => $monthVal) {
                            $monthnum = date("m", strtotime($monthVal));
                            echo ' <li data-month="' . $monthnum . '" data-year="' . $Year . '"><a href="#"  >' . $Year . ' ' . $monthVal . '</a></li>';
                        }
                    }
                    ?>

                </ul>

            </section>

        </section>
    </section><!-- Main Container Ends -->
</main>	

<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-lbelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>

<!--            <div class="modal-body">
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

<script>

    function showDetail(post_id) {
        var dataImageId = $(this).attr('data');

        $.ajax({
            url: '<?php echo base_path; ?>ajax/image_popupbyajax.php',
            type: 'POST',
            data: {
                imgid: post_id

            },
            success: function(data)
            {
                $('#largeModal').html(data);
            }


        });

    }

</script>


<script src="OverTribe_files/bootstrap.js" type="text/javascript"></script>	
<script src="OverTribe_files/owl.js" type="text/javascript"></script>	
<script type="text/javascript">
    var timeline;
    var year = 2015;
    var page = 1;
    function firstTimeline(animate, saprator, order)
    {
        timelinedata = $("#timeline").html("");
        if (animate == undefined) {
            animate = false;
        }
        var button = $("#loadmore");

        if (button.hasClass('loading')) {
            return;
        }

        if ($(".feedtype li a").eq(0).hasClass("active") && $(".filterpost li").has("a.active").data('month') == undefined) {
            saprator = "month_year";
            order = "desc";
        }
        else if ($(".feedtype li a").eq(0).hasClass("active") && $(".filterpost li").has("a.active").data('month') != undefined) {
            saprator = "month_year";
            order = "desc";
        }
        else if (!$(".feedtype li a").eq(0).hasClass("active") && $(".filterpost li").has("a.active").data('month') != undefined) {
            saprator = "month_year";
            order = false;
        }
        else {
            saprator = false;
            order = false;
        }




        button.addClass('loading').text('Loading...');

        $.ajax('ajax/ajax_post.php', {
            type: 'POST',
            dataType: 'json',
            global: false,
            data: {year: 2015, page_num: 1,
                type: $(".feedtype li a.active").data('type'),
                dtmonth: $(".filterpost li").has("a.active").data('month'),
                dtyear: $(".filterpost li").has("a.active").data('year')
            },
            success: function(data) {
                // remove loading
                if (data[0] != undefined) {
                    if (data[0].load_next == false) {
                        button.remove();
                    }
                }
                else {
                    $("#timeline").html("<div class='nodata' style='text-align:center'>Sorry there is no feed content </div><div class='nodatabtn'><a class='active resetfilter' ></a></div>");
                    button.remove();
                }

                button.removeClass('loading').text('Load More');

                timeline = new Timeline($('#timeline'), data);
                timeline.setOptions({
                    dateFormat: 'DD MMMM YYYY HH:mm',
                    animation: true,
                    lightbox: true,
                    order: order,
                    first_separator: true,
                    separator: 'month_year',
                    columnMode: 'dual',
                    responsive_width: 700

                });

                timeline.display();
            }
        });
    }
    function reArrange() {
        $(".timeline_element").each(function() {
            if ($(this).hasClass("timeline_element_left")) {
                $(this).removeClass("timeline_element_left");
                $(this).addClass("timeline_element_right");

            }
            else {
                $(this).removeClass("timeline_element_right");
                $(this).addClass("timeline_element_left");
            }
        })
    }
    $(document).ready(function() {

        firstTimeline(true);

        // menu click
//                $(document).on('click', '#menu > div', function(e) {
//                    $.scrollTo('#timeline_date_separator_' + $(this).text(), 500);
//                });

        // load more click


        $('#loadmore').on('click', function(e) {
            var button = $(this);

            if (button.hasClass('loading')) {
                return;
            }

//                    year--;
            button.addClass('loading').text('Loading...');

            var testo;
            page++;
            testo = page;

            $.ajax('ajax/ajax_post.php', {
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {year: year, page_num: testo,
                    type: $(".feedtype li a.active").data('type'),
                    dtmonth: $(".filterpost li").has("a.active").data('month'),
                    dtyear: $(".filterpost li").has("a.active").data('year')
                },
                success: function(data) {

                    if (data[0] != undefined) {
                        if (data[0].load_next == false) {
                            button.remove();
                        }
                    }

                    button.removeClass('loading').text('Load More');
                    // append new data
//                            timeline.appendData(data);
                    timeline = new Timeline($('#timeline'), data);

                    timeline.display();
                }
            });
        });






    });

</script>
<script>
    $(document).ready(function() {
        $(".owl-carousel").owlCarousel({
            autoPlay: 3000, //Set AutoPlay to 3 seconds
            items: 1,
            pagination: true,
            itemsDesktop: [1199, 3],
            itemsDesktopSmall: [979, 3]
        });

        // Variable Data
        var data = '<span class="feed_thumb"><img alt="" src="OverTribe_files/images/tml-user.jpg"></span><h3><a href="#">Etiam vitae dictum</a><span class="time_posted"><i class="fa fa-clock-o"></i>15 d ago</span></h3>'
        $(data).appendTo('.timeline_title');
        $('.timeline_title_label, .timeline_title_date').hide();
        var like_comment = '<div class="vote_comments"><a href="#"><i class="fa fa-heart"></i>Total voters</a><a href="#"><i class="fa fa-comment"></i>comments</a></div>'
        $(like_comment).appendTo('.timeline_element_box');

        //Right Fixed Section
        var offset = $(".fixed_section").offset();
        var topPadding = 15;
        $(window).scroll(function() {
            if ($(window).scrollTop() > offset.top) {
                $(".fixed_section").stop().animate({
                    marginTop: $(window).scrollTop() - offset.top + topPadding
                });
            } else {
                $(".fixed_section").stop().animate({
                    marginTop: 0
                });
            }
        });
    });
</script>
</body>
</html>
