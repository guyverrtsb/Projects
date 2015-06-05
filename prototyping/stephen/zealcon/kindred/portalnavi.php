<?php require_once("../../gd.trxn.com/_controls/classes/_syscore.php"); ?>
<!DOCTYPE HTML><!-- HTML 5 -->
</html>
<head>
<title zgd.bkgimg="/gd.trxn.com/mimes/images/backgrounds/scaled/02841_theroadtonowhere_1440x900.jpg">Site Access</title>
<?php zInc("/gd.trxn.com/_controls/ui/css/core.php") ?>
<?php zInc("/_controls/ui/css/core.php") ?>
<style>
.zcnavi { border:0px red solid; }
.zcnavi { /*height:40px;*/ }
.zcnavilvl1_link { padding-left:10px; padding-right:10px; }
#zcnavileft { float:left; width:20px; font-weight:bold; font-size:20px; color:#ffffff; }
#zcnavicontainer { float:left; width: 1060px; height:30px; overflow:hidden; }
#zcnavicarousel { width:6000px; }
#zcmegamenu { width:1100px; background-color:#ffffff; 
    margin-left:0px; margin-top:0px;
    position:absolute; z-index:50000; }
#zcnaviright { float:left; width:20px; font-weight:bold; font-size:20px; color:#ffffff; text-align:right;}
.zcnavilvl1_block { /*background-color:#ffffff; */display: inline-block; float:left; }
.zcnavilvl1_link {  }
.zcnavilvl2_block { background-color:#ffffff; display: inline-block; float:left; width:200px;
    margin-left:50px; margin-top:20px; margin-right:20px; margin-bottom:30px;
    border:1px red solid; }
</style>
</head>
<body>
<div id="zcportalnavigation">


<div portalnavlevel="1"><a href="http://localhost:50000/irj/portal?NavigationTarget=navurl://f00c42bd7cdbea2c9190eb155fce448f" target='_top'>Content Administration</a></div>

<div portalnavlevel="1"><a href="http://localhost:50000/irj/portal?NavigationTarget=navurl://631c127e4710538c99e4aeb58b928ec8" target='_top'>User Administration</a></div>

<div portalnavlevel="1"><a href="http://localhost:50000/irj/portal?NavigationTarget=navurl://0863931c4c779de6599e6227b82375e0" target='_top'>System Administration</a></div>


</div>
<div id="container">
    <!-- HEADER -->
    <div id="header">
        <div id="logo"><img src="/gd.trxn.com/mimes/images/logos/gdLogo_w45h70.png"/></div>
        <div id="top_info">Top Info</div>
        <div id="navbar">
<div id="zcnavileft" class="zcnavi"><a class="zcnaviscrollink" href="javascript:zcRatchet('L');"><</a></div>
<div id="zcnavicontainer" class="zcnavi"></div>
<div id="zcnaviright" class="zcnavi"><a class="zcnaviscrollink" href="javascript:zcRatchet('R');">></a></div>
        </div>
    </div>
    <div id="content_area"><!-- S-CONTENT_AREA -->
<?php zInc("/gd.trxn.com/_controls/ui/banner.php") ?>
<?php zInc("/gd.trxn.com/_controls/ui/messageline.php") ?>
        <div id="left_column"><?php zInc("/_controls/ui/left_menu/s_menu.php") ?></div>
        <div id="workarea">
            <span id="menuitemdiag">aasdfasf</span>
        </div>
        <div id="right_column"><?php zInc("/_controls/ui/right_menu/s_menu.php") ?></div>
    </div><!-- E-CONTENT_AREA -->
<?php zInc("/_controls/ui/footer.php") ?>
</div>
<?php zInc("/gd.trxn.com/_controls/ui/js/core.php") ?>
<?php zInc("/_controls/ui/js/core.php") ?>
<script src="index.js"></script>
</body>
</html>