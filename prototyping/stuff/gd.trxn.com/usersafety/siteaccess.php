<?php require_once("../_controls/classes/_core.php"); ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title zgd.bkgimg="/gd.trxn.com/mimes/images/backgrounds/scaled/02841_theroadtonowhere_1440x900.jpg">Site Access</title>
<meta charset="UTF-8">
<?php gdinc("/_controls/ui/css/core.php") ?>
<link rel="stylesheet" href="/mimes/css/siteaccess.css">
<style>
</style>
<?php gdinc("/_controls/ui/js/core.php") ?>
<script>
function gdFuncRegisterData()
{
    gdOutputMessagePrepend("#AccountAccess", "&nbsp;");
    gdSetControllerKey("RegisterFrm", "REGISTER_USER");
    var formdata = $("#RegisterFrm").serialize();
    $.post("_controls/ajax/USER_ACCESS.php",
    formdata, function(data) {
            if(isDataMatch(data, "EMAIL_IN_USE"))
                gdOutputMessagePrepend("#AccountAccess", "E-Mail already is Use");
            else if(isDataMatch(data, "ACCOUNT_CREATED"))
                gdOutputMessagePrepend("#AccountAccess", "Account was created.  Please chekc your email to activate the account.");
            else
                gdOutputMessagePrepend("#AccountAccess", "Unknown Error:" + data);
        });
}

function gdFuncLoginData(frm)
{
    gdSetControllerKey("LoginFrm", "LOGIN_USER");
    $("#LoginFrm").submit();    
}

function gdFuncForgotPasswordData(frm)
{
    //$("#" + frm).submit();    
}
</script>
</head>
<body>
<div id="ContentWrapper">
    <div id="AccountAccess"><ul>
        <li id="CBlogin"><form id="LoginFrm" class="form" action="_controls/ajax/USER_ACCESS.php" method="post">
            <ul>
            <li class="cbheader">Login - E-Mail</li>
            <li class="user"><input class="rounded" type="text" id="user_email" name="user_email" value="Email"/></li>
            <li class="user"><input class="rounded" type="text" id="user_password" name="user_password" value="Password"/></li>
            <li class="button"><a class="buttonBlue" name="navtop" onclick="gdFuncLoginData();">Login</a></li>
<?php
if(isset($_SESSION["AUTH_ERROR_CODE"])) { ?>
            <li class="user"><?php echo $_SESSION["AUTH_ERROR_MSG"]; ?></li>
<?php 
unset($_SESSION["AUTH_ERROR_CODE"]);
unset($_SESSION["AUTH_ERROR_MSG"]);
} ?>
            </ul>
            </form></li>
        <li id="CBforgotpassword"><form id="ForgotPasswordFrm" class="form" action="useraccount_s.php" method="post">
            <ul>
            <li class="cbheader">Forgot Password</li>
            <li class="user"><input class="rounded" type="text" id="user_email" name="user_email" value="Email"/></li>
            <li class="button"><a class="buttonBlue" name="navtop" onclick="gdFuncForgotPasswordData('ForgotPasswordFrm');">Forgot Password</a></li>
            </ul>
            </form></li>
        <li id="CBregister"><form id="RegisterFrm" class="form">
            <ul>
            <li class="cbheader">Register User Account</li>
            <li class="user"><input class="rounded" type="text" id="user_email" name="user_email" value="Email"/></li>
            <li class="user"><input class="rounded" type="text" id="user_password" name="user_password" value="Password"/></li>
            <li class="user"><input class="rounded" type="text" id="user_firstname" name="user_firstname" value="First Name"/></li>
            <li class="user"><input class="rounded" type="text" id="user_lastname" name="user_lastname" value="Last Name"/></li>
            <li class="cbheader">User Profile</li>
            <li class="user"><input class="rounded" type="text" id="user_city" name="user_city" value="City"/></li>
            <li class="user"><input class="rounded" type="text" id="user_state" name="user_state" value="State"/></li>
            <li class="user"><input class="rounded" type="text" id="user_country" name="user_country" value="Country"/></li>
            <li class="user"><input class="rounded" type="text" id="user_nickname" name="user_nickname" value="Nickname"/></li>
            <li class="button"><a class="buttonBlue" name="navtop" onclick="gdFuncRegisterData();">Register</a></li>
            </ul>
            </form></li>
    </ul></div>
</div>
</body>
</html>