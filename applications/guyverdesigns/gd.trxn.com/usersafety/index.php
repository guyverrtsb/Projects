<?php require_once("../_controls/classes/_core.php"); ?>
<!DOCTYPE HTML><!-- HTML 5 -->
</html>
<head>
<title zgd.bkgimg="/gd.trxn.com/mimes/images/backgrounds/scaled/02841_theroadtonowhere_1440x900.jpg">Site Access</title>
<?php gdinc("/gd.trxn.com/_controls/ui/css/core.php") ?>
<?php gdinc("/gd.trxn.com/_controls/ui/js/core.php") ?>
<script src="index.js"></script>
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
    $.post("_controls/ajax/USER_ACCESS.php", gdSerialize("register"), function(data)
    {
        data = eval("(" + data + ")");
        if(data.USER_TYPE == "SITE_USER")
        {
            if(buildContentBlockReturnMessage(data, "ACCOUNT_IS_PENDING"))
            {
                if(data.ENV_KEY != null && data.ENV_KEY == "LCL")
                {
                    appendContentBlockReturnMessageObject("ACCOUNT_IS_PENDING", $("<a/>").text("Activate User Override").attr("href",data.TRXN_URL));
                }
            }
        }
        else
        {
            buildContentBlockReturnMessage(data, true);
        }
    });
}

function gdFuncSupportData()
{
    buildContentBlockReturnMessage();
    $.post("_controls/ajax/USER_ACCESS.php", gdSerialize("support"), function(data)
    {
        data = eval("(" + data + ")");
        if(buildContentBlockReturnMessage(data, "ACCOUNT_IS_PENDING"))
        {
            if(data.ENV_KEY != null && data.ENV_KEY == "LCL")
            {
                appendContentBlockReturnMessageObject($("<a/>").text("Activate User Override").attr("href",data.TRXN_URL));
            }
        }
        else
        {
            buildContentBlockReturnMessage(data, true);
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
        <div id="left_column">Left Column</div>
        <div id="workarea">
            <div id="workarea_col_left">

            </div>
            <div id="workarea_col_right">

            </div>
        </div>
        <div id="right_column">Right Column</div>
    </div>
<?php gdinc("/gd.trxn.com/_controls/ui/footer.php") ?>
</div>
</body>
</html>