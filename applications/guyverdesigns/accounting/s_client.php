<?php require_once("../gd.trxn.com/_controls/classes/_core.php"); ?>
<?php gdauth()->isAuthorized("GD_PUBLISHER"); ?>
<?php setpagekey("CLIENT"); ?>
<!DOCTYPE HTML><!-- HTML 5 -->
</html>
<head>
<title zgd.bkgimg="/gd.trxn.com/mimes/images/backgrounds/scaled/02841_theroadtonowhere_1440x900.jpg">Site Access</title>
<?php gdinc("/_controls/ui/css/core.php") ?>
<?php gdinc("/_controls/ui/js/core.php") ?>
<<?php gdinc("/_controls/ui/js/accounting.php") ?>
script src="s_client.js"></script>
<script>
function RegisterTestData(companyname, contactname, contactemail, contactnumber, address, city)
{
    $("#registercompanyname").val(companyname);
    $("#registercontactname").val(contactname);
    $("#registercontactemail").val(contactemail);
    $("#registercontactnumber").val(contactnumber);
    $("#registeraddress").val(address);
    $("#registercity").val(city);
}
</script>
</head>
<body>
<div id="container">
<?php gdinc("/_controls/ui/header.php") ?>
    <!-- CONTENT_AREA -->
    <div id="content_area">
        <?php gdinc("/_controls/ui/banner.php") ?>
        <div id="left_column"><?php gdinc("/_controls/ui/left_menu/s_menu.php") ?></div>
        <div id="workarea">
            <div id="workarea_col_left">
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