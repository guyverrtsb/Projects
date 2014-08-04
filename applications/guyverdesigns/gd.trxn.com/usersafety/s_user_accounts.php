<?php require_once("../_controls/classes/_core.php"); ?>
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
        <div id="messageline">
<?php
if(gdconfig()->getUIPageResponseCode() != "")
{
    printf("<p class=\"message\" UIPAGERESSHOW=\"TRUE\" UIPAGERESCODE=\"%s\" UIPAGERESKEY=\"%s\" UIPAGERESMSG=\"%s\">%s</p>", gdconfig()->getUIPageResponseCode(), gdconfig()->getUIPageResponseKey(), gdconfig()->getUIPageResponseMsg(), gdconfig()->getUIPageResponseMsg());
}
?>
<?php gdconfig()->cleanUIPageResponseData() ?>
        </div>
        <div id="left_column"><?php gdinc("/gd.trxn.com/_controls/ui/left_menu/s_menu.php") ?></div>
        <div id="workarea" dyncontentkey="LIST_OF_USER_ACCOUNTS" apppath="/gd.trxn.com">

        </div>
        <div id="right_column">Right Column</div>
    </div>
<?php gdinc("/gd.trxn.com/_controls/ui/footer.php") ?>
</div>
</body>
</html>