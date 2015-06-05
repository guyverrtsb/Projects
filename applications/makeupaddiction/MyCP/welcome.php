<?php
$PageTitle = "Welcome";
include('header.php');

function totalUser($tp = false) {
    global $db;
    $count = 0;
    if ($tp == false)
        $sql = "select userid from users";
    else {
        $today = date("Y-m-d", strtotime("today"));
        $sql = "SELECT userid FROM users where dtdate like '%" . $today . "%'";
    }

    $res = $db->query($sql);
    if ($res->size() > 0) {
        $count = $res->size();
    }
    return $count;
}

function totalPost($tp = false) {
    global $db;
    $count = 0;
    if ($tp == false)
        $sql = "select post_id from post";
    else {
        $today = date("Y-m-d", strtotime("today"));
        $sql = "SELECT post_id from post where dtdate like '%" . $today . "%'";
    }

    $res = $db->query($sql);
    if ($res->size() > 0) {
        $count = $res->size();
    }
    return $count;
}

function totalDeal($tp = false) {
    global $db;
    $count = 0;
    if ($tp == false)
        $sql = "select deal_id from deal_post";
    else {
        $today = date("Y-m-d", strtotime("today"));
        $sql = "SELECT post_id from post where dtdate like '%" . $today . "%'";
    }

    $res = $db->query($sql);
    if ($res->size() > 0) {
        $count = $res->size();
    }
    return $count;
}
?>


<div id="content-box">
    <div class="dash">
        <div class="row">

            <div class="col-md-6">
                <div class="mini-stat clearfix"> 
                    <a href="manage-users.php"> <span class="mini-stat-icon pink"><i class="fa fa-user"></i></span>
                    	<div class="inC_in">
                        <div class="v_lue"><?php echo totalUser(); ?></div>
                        <div class="mini-stat-info"> Users </div>
                        </div>
                        <div class="g_go"><i class="fa fa-angle-double-right"></i></div>
                        <div class="clr"></div>
                    </a> 
                </div>
            </div>


            <div class="col-md-6">
                <div class="mini-stat clearfix"> 
                    <a href="post.php"> <span class="mini-stat-icon tar"><i class="fa  fa-paste"></i></span>
                    <div class="inC_in">
                        <div class="v_lue"><?php echo totalPost(); ?></div>
                        <div class="mini-stat-info"> Posts </div>
                        </div>
                        <div class="g_go"><i class="fa fa-angle-double-right"></i></div>
                        <div class="clr"></div>
                    </a> 
                </div>
            </div>

<!--            <div class="col-md-6">
                <div class="mini-stat clearfix"> 
                    <a href="deal.php"> <span class="mini-stat-icon orange"><i class="fa fa-thumbs-up"></i></span>
                    <div class="inC_in">
                        <div class="v_lue">12 </div>
                        <div class="mini-stat-info"> Deals  </div>
                        </div>
                        <div class="g_go"><i class="fa fa-angle-double-right"></i></div>
                        <div class="clr"></div>
                    </a> 
                </div>
            </div>-->
            
<!--            <div class="col-md-6">
                <div class="mini-stat clearfix"> 
                    <a href="deal.php"> <span class="mini-stat-icon yellow-b"><i class="fa fa-bullhorn"></i></span>
                    <div class="inC_in">
                        <div class="v_lue">495</div>
                        <div class="mini-stat-info"> Advertisement  </div>
                        </div>
                      <div class="g_go"><i class="fa fa-angle-double-right"></i></div>  
                        <div class="clr"></div>
                    </a> 
                </div>
            </div>-->
              
              
            <div class="clr"></div>
            
            
        </div>    

     

            <div class="clr"></div>
        </div>
     <div class="win_s">   
    <div class="row">
<!--<div class="col-md-6">
                <div class="mini-stat clearfix sky hght"> 
                    <a href="deal.php"> <span class="mini-stat-icon inone"><i class="fa fa-flag"></i></span>
                    <div class="inC_in">
                        <div class="v_lue">495</div>
                        <div class="mini-stat-info"> Winners  </div>
                        </div>
                      <div class="g_go"><i class="fa fa-angle-double-right"></i></div>  
                        <div class="clr"></div>
                    </a> 
                </div>
            </div>-->
            
          
          
            
            
            
<div class="col-md-6" style="margin-bottom:30px;">       
<div class="content-box">
<div class="content-box-header">
<h3 style="cursor: s-resize;">Overview <span class="tools pull-right">
<a class="fa fa-chevron-down" href="javascript:void(0)"></a>
</span></h3>

</div>
<!-- End .content-box-header -->



<div class="content-box-content">

<div style="display: block;" class="tab-content default-tab">
<p style="padding-left:14px">
<a href="<?php echo base_path ?>MyCP/manage-users.php"><span><?php echo totalUser(); ?></span> Total Users</a>
</p>
</div>


<div style="display: block;" class="tab-content default-tab">
<p style="padding-left:14px">
<a href="<?php echo base_path ?>MyCP/post.php"><span><?php echo totalPost(); ?></span> Total post</a>
</p>
</div>

</div>

</div>
</div>

<div class="col-md-6">       
<div class="content-box">
<div class="content-box-header">
<h3 style="cursor: s-resize;">What you should do <span class="tools pull-right">
<a class="fa fa-chevron-down" href="javascript:void(0)"></a>
</span></h3><br />
</div>




<div class="content-box-content">

<div style="display: block;" class="tab-content default-tab">
<p style="padding-left:14px">
<a href="<?php echo base_path ?>MyCP/manage-users.php?type=today"><span><?php echo totalUser(true); ?></span>  User added today</a>
</p>
</div>

<div style="display: block;" class="tab-content default-tab">
<p style="padding-left:14px">
<a href="<?php echo base_path ?>MyCP/post.php?type=today"><span><?php echo totalPost(true); ?></span>  Post added today</a>
</p>
</div>

</div>


</div>
</div>


 
<!--<div class="col-md-6">
<div class="mini-stat clearfix hght">
<div class="flow">
<h2>Twitter Feed</h2>
<ul class="fl_w">
<li><a href="#" class="fb"><i class="fa fa-facebook"></i></a></li>
<li><a href="#" class="tweet"><i class="fa fa-twitter"></i></a></li>
<li><a href="#" class="lnkd"><i class="fa fa-linkedin"></i></a></li>
<li><a href="#" class="g_pls"><i class="fa fa-google-plus"></i></a></li>
<li><a href="#" class="ytbe"><i class="fa fa-youtube"></i></a></li>
</ul>
</div>
</div>
</div>-->


<div class="clr"></div>
 </div>
 </div>
 
    </div>


     
</div>
<div class="clr"></div>
<?php include('footer.php'); ?>
