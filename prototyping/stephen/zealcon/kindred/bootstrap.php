<?php require_once("../../gd.trxn.com/_controls/classes/_syscore.php"); ?>
<!DOCTYPE HTML><!-- HTML 5 -->
</html>
<head>
<title zgd.bkgimg="/gd.trxn.com/mimes/images/backgrounds/scaled/02841_theroadtonowhere_1440x900.jpg">Site Access</title>
<?php zInc("/gd.trxn.com/_controls/ui/css/core.php") ?>
<?php zInc("/_controls/ui/css/core.php") ?>
<style>
.zcnavi { border:1px red solid; }
.zcnavi { /*height:40px;*/ }
.zcnavilink { padding-left:10px; padding-right:10px; }
#zcnavileft { float:left; }
#zcnavicontainer { float:left; width:96%; overflow:hidden; }
#zcnavicarousel { width:6000px; }
#zcnaviright { float:left; }
.zcnavibox_lvl1 { background-color:#cecece; display: inline-block; float:left; }
.zcnavilink { color:#000000; }
</style>
</head>
<body>
<div id="container">
    <!-- HEADER -->
    <div id="header">
        <div id="logo"><img src="/mimes/images/logos/gdLogo_w45h70.png"/></div>
        <div id="top_info">Top Info</div>
        <div id="navbar">
<div id="zcnavileft" class="zcnavi"><a href="javascript:zcRatchet('L');"><</a></div>
<div id="zcnavicontainer" class="zcnavi"></div>
<div id="zcnaviright" class="zcnavi"><a href="javascript:zcRatchet('R');">></a></div>
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