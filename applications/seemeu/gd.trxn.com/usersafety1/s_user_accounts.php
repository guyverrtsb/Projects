<?php require_once("../_controls/classes/_core.php"); ?>
<?php if(gdauth()->isAuthorized("GD_ADMIN")) { ?>
<!DOCTYPE HTML><!-- HTML 5 -->
</html>
<head>
<title zgd.bkgimg="/gd.trxn.com/mimes/images/backgrounds/scaled/02841_theroadtonowhere_1440x900.jpg">Site Access</title>
<?php gdinc("/gd.trxn.com/_controls/ui/css/core.php") ?>
<?php gdinc("/gd.trxn.com/_controls/ui/js/core.php") ?>
<script src="s_user_accounts.js"></script>
<script>
</script>
</head>
<body>
<div id="container">
<?php gdinc("/gd.trxn.com/_controls/ui/header.php") ?>
    <!-- CONTENT_AREA -->
    <div id="content_area">
<?php gdinc("/gd.trxn.com/_controls/ui/banner.php") ?>
<?php gdinc("/gd.trxn.com/_controls/ui/messageline.php") ?>
<?php
if(isset($_GET["LEFT_MENU"])) {
?>
        <div id="left_column"><?php gdinc($_GET["LEFT_MENU"]) ?></div>
<?php
} else {
?>
        <div id="left_column"><?php gdinc("/gd.trxn.com/_controls/ui/left_menu/s_menu.php") ?></div>
<?php
}
?>
        <div id="workarea" dyncontentkey="LIST_OF_USER_ACCOUNTS" apppath="/gd.trxn.com">

        </div>
        <div id="right_column">Right Column</div>
    </div>
<?php gdinc("/gd.trxn.com/_controls/ui/footer.php") ?>
</div>
</body>
</html>
<?php } ?>