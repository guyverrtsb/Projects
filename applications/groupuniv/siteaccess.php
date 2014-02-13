<?php require_once("gd.trxn.com/_controls/classes/_core.php"); ?>
<?php gdreqonce("/_controls/ui/header.php") ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title zgd.bkgimg="/mimes/images/backgrounds/scaled/02841_theroadtonowhere_1440x900.jpg">Site Access</title>
<meta charset="UTF-8">
<?php gdinc("/_controls/ui/css/core.php") ?>
<link rel="stylesheet" href="/mimes/css/siteaccess.css">
<style>
</style>
<?php gdinc("/_controls/ui/js/core.php") ?>
<script>
function gdFuncRegisterData()
{
    showMessage("#RegisterErr", "&nbsp;");
    var formdata = gdSerialzeControllerKey("#RegisterFrm", "REGISTER_USER");
    $.post("_controls/ajax/USER_ACCESS.php",
    formdata, function(data) {
        if(isDataMatch(data, "UNIVERSITY_NOT_FOUND"))
            showMessage("#RegisterErr", "Univeristy not Valid");
        else if(isDataMatch(data, "EMAIL_IN_USE"))
            showMessage("#RegisterErr", "E-Mail already is Use");
        else if(isDataMatch(data, "ACCOUNT_CREATED"))
            showMessage("#RegisterErr", "Account was created.  Please chekc your email to activate the account.");
        else
            showMessage("#RegisterErr", "Unknown Error:" + data);
    });
}

function gdFuncLoginData()
{
    $("#LoginFrm").submit();    
}

function gdFuncForgotPasswordData()
{
    //$("#" + frm).submit();    
}
</script>
</head>
<body>
<div id="ContentWrapper">
<ul id="CBHorizWorkArea">
<li><ul id="CBUserLogin">
    <form id="LoginFrm" class="form" action="_controls/ajax/USER_ACCESS.php" method="post">
    <li class="cbheader">Login - E-Mail</li>
<?php
if(isset($_SESSION["AUTH_ERROR_CODE"])) {
    printf("<li id=\"LoginErr\" class=\"error\">%s</li>", $_SESSION["AUTH_ERROR_MSG"]);
    unset($_SESSION["AUTH_ERROR_CODE"]);
    unset($_SESSION["AUTH_ERROR_MSG"]);
}else{
    printf("<li id=\"LoginErr\" class=\"error\">&nbsp;</li>");
}
?>
    <li class="user"><input class="rounded" type="text" id="user_email" name="user_email" value="stephen@guyverdesigns.com"/></li>
    <li class="user"><input class="rounded" type="text" id="user_password" name="user_password" value="honkey"/></li>
    <li class="button"><a class="buttonBlue" name="navtop" onclick="gdFuncLoginData();">Login</a></li>
    <input type="hidden" id="GD_CONTROLLER_KEY" name="GD_CONTROLLER_KEY" value="LOGIN_USER"/>
    </form>
    </ul>
</li>
<li><ul id="CBUserRegister">
    <form id="RegisterFrm" class="form">
    <li class="cbheader">Register</li>
    <li id="RegisterErr" class="error">&nbsp;</li>
    <li class="cbsubheader">User Account</li>
    <li class="user"><input class="rounded" type="text" id="user_email" name="user_email" value="stephen@guyverdesigns.com"/></li>
    <li class="user"><input class="rounded" type="text" id="user_password" name="user_password" value="honkey"/></li>
    <li class="cbsubheader">User Profile</li>
    <li class="user"><input class="rounded" type="text" id="user_firstname" name="user_firstname" value="Stephen"/></li>
    <li class="user"><input class="rounded" type="text" id="user_lastname" name="user_lastname" value="Shellenberger"/></li>
    <li class="user"><input class="rounded" type="text" id="user_nickname" name="user_nickname" value="shaggy"/></li>
    <li class="user"><select class="rounded" id="user_country" name="user_country" configuration="COUNTRIES|COUNTRY_US|user_region"></select></li>
    <li class="user"><select class="rounded" id="user_region" name="user_region" configuration="COUNTRY_US|REGION_NC"></select></li>
    <li class="user"><input class="rounded" type="text" id="user_city" name="user_city" value="Raleigh"/></li>
    <li class="button"><a class="buttonBlue" name="navtop" onclick="gdFuncRegisterData();">Register</a></li>
    </form>
    </ul>
</li>
</ul>
</div>
</body>
</html>