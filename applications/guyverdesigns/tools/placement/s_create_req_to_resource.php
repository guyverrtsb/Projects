<?php require_once("../../gd.trxn.com/_controls/classes/_core.php"); ?>
<?php if(gdauth()->isAuthorized("GD_PUBLISHER")) { ?>
<?php setpagekey("SEND_REQUIREMENT_TO_RESOURCE"); ?>
<!DOCTYPE HTML><!-- HTML 5 -->
<html lang="en">
<head>
<title zgd.bkgimg="/gd.trxn.com/mimes/images/backgrounds/scaled/02841_theroadtonowhere_1440x900.jpg">Site Access</title>
<?php gdinc("/_controls/ui/css/core.php") ?>
<?php gdinc("/_controls/ui/js/core.php") ?>
<?php gdinc("/_controls/ui/js/tools.php") ?>
<script src="s_create_req_to_resource.js"></script>
<script>
</script>
</head>
<body>
<div id="container">
<?php gdinc("/_controls/ui/header.php") ?>
    <!-- CONTENT_AREA -->
    <div id="content_area">
        <?php gdinc("/_controls/ui/banner.php") ?>
        <?php gdinc("/_controls/ui/messageline.php") ?>
        <div id="left_column"><?php gdinc("/_controls/ui/left_menu/s_menu.php") ?></div>
        <div id="workarea" dyncontentkey="REQUIREMENT_FROM_UID" funcname="buildRequirementEmail">
            <?php /*div id="workarea_col_left" dyncontentkey="REQUIREMENT_FROM_UID" funcname="buildRequirementEmail">
            </div>
            <div id="workarea_col_right" dyncontentkey="RESOURCES_CONTACTED" funcname="buildEmailsSent">
            </div */?>
        </div>
        <div id="right_column"><?php gdinc("/_controls/ui/right_menu/s_menu.php") ?></div>
    </div>
<?php gdinc("/_controls/ui/footer.php") ?>
</div>
</body>
</html>
<?php } ?>