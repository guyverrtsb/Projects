<?php require_once("../gd.trxn.com/_controls/classes/_core.php"); ?>
<?php gdreqonce("/_controls/ui/header.php") ?>
<?php gdreqonce("/_controls/classes/authorize.php"); ?>
<?php
$zauth = new zAuthorize();
if($zauth->isSiteUser())
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
<script>

</script>
</head>
<body>
<div id="zgdbkgimg" value="/mimes/images/backgrounds/scaled/02841_theroadtonowhere_1440x900.jpg"></div>
<div id="ContentWrapper">
<ul id="CBHorizWorkArea">
<li><ul id="CBWorkAreaLeft">
    <li class="cbheader">Menu</li>
    <?php gdinc("/_controls/ui/menu_left_siteuser.php") ?>
    </ul></li>
<li><ul id="CBWorkAreaCenter">
    <li class="cbheader">Account Info</li>
    <li id="CEResultsTOP">&nbsp;</li>
    <li id="CEResultsBOTTOM">&nbsp;</li>
    </ul></li>
<li><ul id="CBWorkAreaRight">
    <li class="cbheader">Notifcations</li>
    <?php gdinc("/_controls/ui/menu_right_siteuser.php") ?>
    </ul></li>
</ul>
</div>
</body>
</html>
<?php } // Authentication End ?>