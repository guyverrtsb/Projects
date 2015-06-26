<?php require_once("/gd.trxn.com/_controls/classes/_core.php"); ?>
<?php gdinc("/gd.trxn.com/_controls/classes/database.connections/default.php"); ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title zgd.bkgimg="/gd.trxn.com/mimes/images/backgrounds/scaled/02841_theroadtonowhere_1440x900.jpg">Guyver Designs - Solutions through Research and Imagination</title>
<meta charset="UTF-8">
<?php gdinc("/_controls/ui/css/core.php") ?>
<style>
</style>
<?php gdinc("/_controls/ui/js/core.php") ?>
<script>
$(document).ready(function()
{

});
</script>
</head>
<body>
<div id="ContentWrapper">
    <?php gdinc("/gd.trxn.com/_controls/ui/gdHeader.php") ?>
    <div id="gdContent"><ul><?php
    $servervars = "";
    foreach($_SERVER as $var => $value) 
    {
        printf("<li>%s : %s : %s</li>", $servervars,$var,$value);
    }
    ?></ul></div>
    <?php gdinc("/gd.trxn.com/_controls/ui/gdFooter.php") ?>
</div>
</body>
</html>