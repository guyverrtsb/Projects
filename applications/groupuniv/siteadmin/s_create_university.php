<?php require_once("../gd.trxn.com/_controls/classes/_core.php"); ?>
<?php gdreqonce("/_controls/ui/header.php") ?>
<?php gdreqonce("/_controls/classes/authorize.php"); ?>
<?php
$zauth = new zAuthorize();
if($zauth->isSiteAdmin())
{
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>University Meet</title>
<meta charset="UTF-8">
<?php gdinc("/_controls/ui/css/core.php") ?>
<style>
</style>
<?php gdinc("/_controls/ui/js/core.php") ?>
<script src="/mimes/js/menu_left.js"></script>
<script src="/mimes/js/menu_right.js"></script>
<script>
$(document).ready( function()
{
});
function gdFuncRegisterData()
{
    buildContentBlockReturnMessage();
    var formdata = gdSerialize("Register");
    $.post("/_controls/ajax/UNIVERSITY.php",
    formdata, function(data)
    {
        data = eval("(" + data + ")");
        if(buildContentBlockReturnMessage(data, "UNIVERSITY_CREATED"))
        {
            loadDynamicContent("LIST_OF_UNIVERSITIES");
        }
    });
}
</script>
</head>
<body>
<div id="zgdbkgimg" value="/mimes/images/backgrounds/scaled/02841_theroadtonowhere_1440x900.jpg"></div>
<div id="ContentWrapper">
<ul id="CBHorizWorkArea">
<li><ul id="CBWorkAreaLeft">
<li class="cbheader">Menu</li>
<?php gdinc("/_controls/ui/menu_left_siteadmin.php") ?>
</ul></li>
<li><ul id="CBWorkAreaCenter">
<li class="cbheader">WorkArea for Administrators</li>
<li><ul id="CBUniversityRegister">
    <form id="FORM_Register" class="form">
    <li class="cbheader">Register</li>
    <li class="cbsubheader">University Account</li>
    <li id="TransactionOutput"></li>
    <li class="user"><input class="rounded" type="text" id="univ_emailkey" name="univ_emailkey" value="ncsu.edu"/></li>
    <li class="user"><input class="rounded" type="text" id="univ_sdesc" name="univ_sdesc" value="NCSU"/></li>
    <li class="cbsubheader">University Profile</li>
    <li class="user"><select class="rounded" id="univ_country" name="univ_country" configuration="COUNTRIES|COUNTRY_US|user_region"></select></li>
    <li class="user"><select class="rounded" id="univ_region" name="univ_region" configuration="COUNTRY_US|REGION_NC"></select></li>
    <li class="user"><input class="rounded" type="text" id="univ_city" name="univ_city" value="Raleigh"/></li>
    <li class="user"><input class="rounded" type="text" id="univ_name" name="univ_name" value="North Carolina State University"/></li>
    <li class="button"><a class="buttonBlue" name="navtop" onclick="gdFuncRegisterData();">Register</a></li>
    <li class="hidden" style="clear:both"><input type="hidden" class="rounded" id="GD_CONTROL_KEY" name="GD_CONTROL_KEY" value="REGISTER_UNIVERSITY"/></li>
    </form>
    </ul>
</li>
</ul></li>
<li><ul id="CBWorkAreaRight">
<li class="cbheader">Notifcations</li>
</ul></li>
</div>
</body>
</html>
<?php } // Authentication End ?>