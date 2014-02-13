<?php require_once("../_controls/classes/_core.php"); ?>
<?php gdreqonce("/gd.trxn.com/usersafety/_controls/classes/taskcontrol.php"); ?>
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
<?php
$gdact= new Z_GD_TaskControl();
$r = $gdact->isActivated();
if($r == "ACTIVATION_PERFORMED")
{
?>
            <li class="cbheader">Good Activation</li>
            <li class="user">Your Accunt has been activated.</li>
<?php } else { ?>
            <li class="cbheader">Bad Activation</li>
            <li class="user"><?php echo $r; ?></li>
<?php } ?>
            </ul>
            </form></li>
    </ul></div>
</div>
</body>
</html>