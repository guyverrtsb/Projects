<?php require_once("../../gd.trxn.com/_controls/classes/_core.php"); ?>
<?php if(gdauth()->isAuthorized("GD_PUBLISHER")) { ?>
<?php setpagekey("PROJECT"); ?>
<!DOCTYPE HTML><!-- HTML 5 -->
</html>
<head>
<title zgd.bkgimg="/gd.trxn.com/mimes/images/backgrounds/scaled/02841_theroadtonowhere_1440x900.jpg">Site Access</title>
<?php gdinc("/_controls/ui/css/core.php") ?>
<?php gdinc("/_controls/ui/js/core.php") ?>
<?php gdinc("/_controls/ui/js/tools.php") ?>
<script src="s_timesheet.js"></script>
<script>
</script>
</head>
<body>
<div id="container">
<?php gdinc("/_controls/ui/header.php") ?>
    <!-- CONTENT_AREA -->
    <div id="content_area">
        <div id="banner">Banner</div>
        <?php gdinc("/_controls/ui/messageline.php") ?>
        <div id="left_column"><?php gdinc("/_controls/ui/left_menu/s_menu.php") ?></div>
        <div id="workarea">
            <div id="workarea_col_left_scrolling" dyncontentkey="LIST_OF_TIMESHEETS_FOR_PROJECT" funcname="buildTimesheetList">

            </div>
            <div id="workarea_col_right">

            </div>
        </div>
        <div id="right_column"><?php gdinc("/_controls/ui/right_menu/s_menu.php") ?></div>
    </div>
<?php gdinc("/_controls/ui/footer.php") ?>
</div>
</body>
</html>
<?php } ?>