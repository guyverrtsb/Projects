<?php require_once("../gd.trxn.com/_controls/classes/_core.php"); ?>
<?php gdreqonce("/_controls/ui/header.php") ?>
<?php gdreqonce("/_controls/classes/authorize.php"); ?>
<?php
$zauth = new zAuthorize();
if($zauth->isUserSiteRoleaUser())
{
$_SESSION["UNIV_MEET_GROUP_ACCOUNT_UID"]="NO_GROUP_DEFINED";
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title zgd.bkgimg="/gd.trxn.com/mimes/images/backgrounds/scaled/02841_theroadtonowhere_1440x900.jpg">University Meet</title>
<meta charset="UTF-8">
<?php gdinc("/_controls/ui/css/core.php") ?>
<link rel="stylesheet" href="/mimes/css/useraccount.css">
<style>

</style>
<?php gdinc("/_controls/ui/js/core.php") ?>
<script>

</script>
</head>
<body>
<div id="ContentWrapper">
<ul id="CBHorizWorkArea">
<li><ul id="CBWorkAreaLeft">
    <li class="cbheader">Menu</li>
    <?php gdinc("/_controls/ui/siteuser_left_menu.php") ?>
    </ul></li>
<li><ul id="CBWorkAreaCenter">
    <li class="cbheader">Work Area</li>
    </ul></li>
<li><ul id="CBWorkAreaRight">
    <li class="cbheader">Notifcations</li>
    <?php gdinc("/_controls/ui/siteuser_right_menu.php") ?>
    </ul></li>
</ul>
</div>
UNIV_MEET_AUTH_USER_UID  :<?php echo $_SESSION["UNIV_MEET_AUTH_USER_UID"]; ?><br/>
UNIV_MEET_AUTH_VALID_TF  :<?php echo $_SESSION["UNIV_MEET_AUTH_VALID_TF"]; ?><br/>
UNIV_MEET_AUTH_UNIV_UID  :<?php echo $_SESSION["UNIV_MEET_AUTH_UNIV_UID"]; ?><br/>
UNIV_MEET_AUTH_UNIV_SDESC:<?php echo $_SESSION["UNIV_MEET_AUTH_UNIV_SDESC"]; ?><br/>
</body>
</html>
<?php } // Authentication End ?>