<?php require_once("../_controls/classes/_core.php"); ?>
<!DOCTYPE HTML><!-- HTML 5 -->
</html>
<head>
<title zgd.bkgimg="/gd.trxn.com/mimes/images/backgrounds/scaled/02841_theroadtonowhere_1440x900.jpg">Site Access</title>
<?php gdinc("/gd.trxn.com/_controls/ui/css/core.php") ?>
<?php gdinc("/gd.trxn.com/_controls/ui/js/core.php") ?>
<script>
<?php 
$html = "$(document).ready( function()".
    "{".
    "buildContentBlocksUserSupport(\"%s\", \"CB_support\")".
    "});";
    if(gdconfig()->getUIPageResponseKey() != "")
        printf($html, gdconfig()->getUIPageResponseKey());
?>

function gdFuncRegisterData()
{
    buildContentBlockReturnMessage();
    $.post("_controls/ajax/USER_ACCESS.php", gdSerialize("register", "GD_CONTROL_KEY", "REGISTER_USER"), function(data)
    {
        data = eval("(" + data + ")");
        if(data.USER_TYPE == "SITE_USER")
        {
            if(buildContentBlockReturnMessage(data, "ACCOUNT_IS_PENDING", "register"))
            {
                if(data.ENV_KEY != null && data.ENV_KEY == "LCL")
                {
                    appendContentBlockReturnMessageObject("register", $("<a/>").text("Activate User Override").attr("href",data.TRXN_URL));
                }
            }
        }
        else
        {
            buildContentBlockReturnMessage(data, true, "register");
        }
    });
}

function gdFuncSupportData()
{
    buildContentBlockReturnMessage();
    $.post("_controls/ajax/USER_ACCESS.php", gdSerialize("Support"), function(data)
    {
        data = eval("(" + data + ")");
        if(buildContentBlockReturnMessage(data, "ACCOUNT_IS_PENDING", "CBUserSupport"))
        {
            if(data.ENV_KEY != null && data.ENV_KEY == "LCL")
            {
                appendContentBlockReturnMessageObject("support", $("<a/>").text("Activate User Override").attr("href",data.TRXN_URL));
            }
        }
        else
        {
            buildContentBlockReturnMessage(data, true, "support");
        }
    });
}

function gdFuncLoginUser()
{
    $("#FORM_login").submit();
}

function gdFuncTestData(email, pass, fname, lname, nick)
{
    $("#registeremail").val(email);
    $("#registerpassword").val(pass);
    $("#registerfirstname").val(fname);
    $("#registerlastname").val(lname);
    $("#registernickname").val(nick);
}
</script>
</head>
<body>
<div id="container">
<?php gdinc("/gd.trxn.com/_controls/ui/header.php") ?>
    <!-- CONTENT_AREA -->
    <div id="content_area">
        <div id="banner">Banner</div>
        <div id="left_column">Left Column</div>
        <div id="workarea">
            <div id="workarea_col_left">
<form id="FORM_login" class="form" action="_controls/ajax/USER_ACCESS.php" method="post">
<ul id="CB_login" class="content_block">
<li class="header">Login - E-Mail</li>
<?php printf("<li class=\"message\" UIPAGERESSHOW=\"TRUE\" UIPAGERESCODE=\"%s\" UIPAGERESKEY=\"%s\" UIPAGERESMSG=\"%s\"></li>",gdconfig()->getUIPageResponseCode(), gdconfig()->getUIPageResponseKey(), gdconfig()->getUIPageResponseMsg()); ?>
<?php gdconfig()->cleanUIPageResponseData() ?>

<li class="entry"><input class="rounded" type="text" id="loginemail" name="email" value="stephen@guyverdesigns.com"/></li>
<li class="entry"><input class="rounded" type="text" id="loginpassword" name="password" value="honkey"/></li>
<li class="button"><a class="buttonBlue" name="navtop" onclick="gdFuncLoginUser();">Login</a></li>
<li class="entry"><input type="hidden" id="GD_CONTROLKEY" name="GD_CONTROL_KEY" value="LOGIN_USER"/></li>
</ul>
</form>
<form id="FORM_support" class="form" action="_controls/ajax/USER_ACCESS.php" method="post">
<ul id="CB_support" class="content_block">
</ul>
</form>
            </div>
            <div id="workarea_col_right">
<form id="FORM_register" class="form">
<ul id="CB_register" class="content_block">
<li class="header">Register</li>
<li class="message">&nbsp;</li>
<li class="subheader">User Account</li>
<li class="entry"><input class="rounded" type="text" id="registeremail" name="email" value=""/></li>
<li class="entry"><input class="rounded" type="text" id="registerpassword" name="password" value=""/></li>
<li class="subheader">User Profile</li>
<li class="entry"><input class="rounded" type="text" id="registerfirstname" name="firstname" value=""/></li>
<li class="entry"><input class="rounded" type="text" id="registerlastname" name="lastname" value=""/></li>
<li class="entry"><input class="rounded" type="text" id="registernickname" name="nickname" value=""/></li>
<li class="entry"><input class="rounded" type="text" id="registercity" name="city" value="Raleigh"/></li>
<li class="entry"><select class="rounded" id="registercfg_country_sdesc" name="cfg_country_sdesc" configuration="COUNTRIES|COUNTRY_US|user_region"></select></li>
<li class="entry"><select class="rounded" id="registercfg_region_sdesc" name="cfg_region_sdesc" configuration="COUNTRY_US|REGION_NC"></select></li>
<li class="button"><a class="buttonBlue" name="navtop" onclick="gdFuncRegisterData();">Register</a></li>
<li class="button"><a class="buttonBlue" name="navtop" onclick="gdFuncTestData('stephen@guyverdesigns.com', 'honkey', 'Stephen', 'Shellenberger', 'stephen@gd.com');">Stephen @ GD.com</a></li>
<li class="button"><a class="buttonBlue" name="navtop" onclick="gdFuncTestData('stephen@ncsu.edu', 'honkey', 'Stephen', 'Shellenberger', 'guyver');">Stephen @ NCSU.com</a></li>
<li class="button"><a class="buttonBlue" name="navtop" onclick="gdFuncTestData('tiffany@ncsu.edu', 'honkey', 'Tiffany', 'Garner', 'harleygirl');">Tiffany @ NCSU.com</a></li>
<li class="button"><a class="buttonBlue" name="navtop" onclick="gdFuncTestData('earenest@ncsu.edu', 'honkey', 'Earenest', 'Grayson', 'ejg4405');">Earenest @ NCSU.com</a></li>
<li class="button"><a class="buttonBlue" name="navtop" onclick="gdFuncTestData('carlos@ncsu.edu', 'honkey', 'Carlos', 'Ibacache', 'clos');">Carlos @ NCSU.com</a></li>
<li class="button"><a class="buttonBlue" name="navtop" onclick="gdFuncTestData('josh@ncsu.edu', 'honkey', 'Josh', 'Ibacache', 'josh');">Josh @ NCSU.com</a></li>
</ul>
</form>
            </div>
        </div>
        <div id="right_column">Right Column</div>
    </div>
<?php gdinc("/gd.trxn.com/_controls/ui/footer.php") ?>
</div>
</body>
</html>