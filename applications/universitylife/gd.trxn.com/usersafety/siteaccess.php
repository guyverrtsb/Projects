<?php require_once("../../gd.trxn.com/_controls/classes/_core.php"); ?>
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
    buildContentBlocksReturnMessage();
    var formdata = gdSerialzeControllerKey("#RegisterFrm", "REGISTER_USER");
    $.post("_controls/ajax/USER_ACCESS.php",
    formdata, function(data)
    {
        data = eval("(" + data + ")");
        if(data.USER_TYPE == "GD_ADMIN")
        {
            buildContentBlocksReturnMessage(data, "GDCOM_ADMIN_CREATED");
        }
        else if(data.USER_TYPE == "SITE_USER")
        {
            if(buildContentBlocksReturnMessage(data, "ACCOUNT_IN_PENDING"))
            {
                if(data.ENV_KEY != null && data.ENV_KEY == "LCL")
                {
                    $("<a/>")
                        .text("Activate User Override")
                        .attr("href",data.TRXN_URL)
                        .appendTo($("#TransactionOutput"));
                }
            }
        }
        else
        {
            buildContentBlocksReturnMessage(data, true);
        }
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

function gdFuncRegisterUserData(email, pass, fname, lname, nick, country, region, city)
{
    $("#user_email").val(email);
    $("#user_password").val(pass);
    $("#user_firstname").val(fname);
    $("#user_lastname").val(lname);
    $("#user_nickname").val(nick);
    $("#user_country").val(country);
    $("#user_region").val(region);
    $("#user_city").val(city);
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
    <li class="user"><input class="rounded" type="text" id="login_user_email" name="user_email" value="stephen@guyverdesigns.com"/></li>
    <li class="user"><input class="rounded" type="text" id="login_user_password" name="user_password" value="honkey"/></li>
    <li class="button"><a class="buttonBlue" name="navtop" onclick="gdFuncLoginData();">Login</a></li>
    <input type="hidden" id="GD_CONTROLLER_KEY" name="GD_CONTROLLER_KEY" value="LOGIN_USER"/>
    </form>
    </ul>
</li>
<li><ul id="CBUserRegister">
    <form id="RegisterFrm" class="form">
    <li class="cbheader">Register</li>
    <li id="TransactionOutput">&nbsp;</li>
    <li class="cbsubheader">User Account</li>
    <li class="user"><input class="rounded" type="text" id="user_email" name="user_email" value=""/></li>
    <li class="user"><input class="rounded" type="text" id="user_password" name="user_password" value=""/></li>
    <li class="cbsubheader">User Profile</li>
    <li class="user"><input class="rounded" type="text" id="user_firstname" name="user_firstname" value=""/></li>
    <li class="user"><input class="rounded" type="text" id="user_lastname" name="user_lastname" value=""/></li>
    <li class="user"><input class="rounded" type="text" id="user_nickname" name="user_nickname" value=""/></li>
    <li class="user"><select class="rounded" id="user_country" name="user_country" configuration="COUNTRIES|COUNTRY_US|user_region"></select></li>
    <li class="user"><select class="rounded" id="user_region" name="user_region" configuration="COUNTRY_US|REGION_NC"></select></li>
    <li class="user"><input class="rounded" type="text" id="user_city" name="user_city" value="Raleigh"/></li>
    <li class="button"><a class="buttonBlue" name="navtop" onclick="gdFuncRegisterData();">Register</a></li>
    <li class="button"><a class="buttonBlue" name="navtop" onclick="gdFuncRegisterUserData('stephen@guyverdesigns.com', 'honkey', 'Stephen', 'Shellenberger', 'stephen@gd.com', 'COUNTRY_US', 'REGION_NC', 'raleigh');">Stephen @ GD.com</a></li>
    <li class="button"><a class="buttonBlue" name="navtop" onclick="gdFuncRegisterUserData('stephen@ncsu.edu', 'honkey', 'Stephen', 'Shellenberger', 'guyver', 'COUNTRY_US', 'REGION_NC', 'raleigh');">Stephen @ NCSU.com</a></li>
    <li class="button"><a class="buttonBlue" name="navtop" onclick="gdFuncRegisterUserData('tiffany@ncsu.edu', 'honkey', 'Tiffany', 'Garner', 'harleygirl', 'COUNTRY_US', 'REGION_NC', 'raleigh');">Tiffany @ NCSU.com</a></li>
    <li class="button"><a class="buttonBlue" name="navtop" onclick="gdFuncRegisterUserData('earenest@ncsu.edu', 'honkey', 'Earenest', 'Grayson', 'ejg4405', 'COUNTRY_US', 'REGION_NC', 'raleigh');">Earenest @ NCSU.com</a></li>
    <li class="button"><a class="buttonBlue" name="navtop" onclick="gdFuncRegisterUserData('carlos@ncsu.edu', 'honkey', 'Carlos', 'Ibacache', 'clos', 'COUNTRY_US', 'REGION_NC', 'raleigh');">Carlos @ NCSU.com</a></li>
    <li class="button"><a class="buttonBlue" name="navtop" onclick="gdFuncRegisterUserData('josh@ncsu.edu', 'honkey', 'Josh', 'Ibacache', 'josh', 'COUNTRY_US', 'REGION_NC', 'raleigh');">Josh @ NCSU.com</a></li>
    </form>
    </ul>
</li>
</ul>
</div>
<?php printf("<input type=\"text\" value=\"%s\"/>", preg_replace('/[^a-zA-Z0-9]/', '', 'stephen@gd.com')); ?>
</body>
</html>