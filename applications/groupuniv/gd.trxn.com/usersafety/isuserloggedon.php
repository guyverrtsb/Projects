<?php require_once("../_controls/classes/_core.php"); ?>
<?php gdreqonce("/gd.trxn.com/_controls/classes/authenticate.php"); ?>
<?php
$gdauth = new Z_GD_Authorization();
if($gdauth->isAthenticated())
{
?>
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
</script>
</head>
<body>
<div id="ContentWrapper">
    <div id="AccountAccess"><ul>
        <li id="CBlogin"><form id="LoginFrm" class="form" action="useraccount_s.php" method="post">
            <ul>
            <li class="cbheader">Login - E-Mail</li>
            <li class="user"><input class="rounded" type="text" id="user_email" name="user_email" value="<?php echo $_GET["activationlink"] ?>"/></li>
            </ul>
            </form></li>
    </ul></div>
</div>
</body>
</html>
<?php
}
?>