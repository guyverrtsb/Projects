<?php require_once("../_controls/classes/_core.php"); ?>
<?php gdauth()->isAuthorized("GD_USER"); ?>
<!DOCTYPE HTML><!-- HTML 5 -->
</html>
<head>
<title zgd.bkgimg="/mimes/images/backgrounds/scaled/02841_theroadtonowhere_1440x900.jpg">Site Access</title>
<?php gdinc("/gd.trxn.com/_controls/ui/css/core.php") ?>
<?php gdinc("/gd.trxn.com/_controls/ui/js/core.php") ?>
<script>
</script>
</head>
<body>
<div id="container">
<?php gdinc("/gd.trxn.com/_controls/ui/header.php") ?>
    <!-- CONTENT_AREA -->
    <div id="content_area">
        <?php gdinc("/_controls/ui/banner.php") ?>
        <div id="left_column"><?php gdinc("/gd.trxn.com/_controls/ui/left_menu/s_menu.php") ?></div>
        <div id="workarea">
            <div id="workarea_col_01">
            </div>
            <div id="workarea_col_02">
            </div>
        </div>
        <div id="right_column"><?php gdinc("/gd.trxn.com/_controls/ui/right_menu/s_menu.php") ?></div>
    </div>
<?php gdinc("/gd.trxn.com/_controls/ui/footer.php") ?>
</div>
</body>
</html>