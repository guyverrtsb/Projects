<?php require_once("../_controls/classes/_core.php"); ?>
<?php gdreqonce("/gd.trxn.com/testing/_controls/classes/results.php"); ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title zgd.bkgimg="/gd.trxn.com/mimes/images/backgrounds/scaled/02841_theroadtonowhere_1440x900.jpg">Guyver Designs - Solutions through Research and Imagination</title>
<meta charset="UTF-8">
<?php gdinc("/_controls/ui/css/core.php"); ?>
<style>
</style>
<?php gdinc("/_controls/ui/js/core.php"); ?>
<script>
$(document).ready(function()
{
});
</script>
</head>
<body>
<div id="ContentWrapper">
    <?php gdinc("/gd.trxn.com/_controls/ui/gdHeader.php"); ?>
    <div id="GDCBLinks"></div>
    <ul>
<?php
$zgr = new zGetResults();
$zgr->findSiteInformationRecords();
$resultSet = $zgr->getResults_SearchRecordsBySearchObjectsandRecordUID();
while($row = $resultSet->fetch())
{
printf("<li>row0:%s; row1:%s</li>", $row[0], $row[1]);
}
?>
    </ul>
    <?php gdinc("/gd.trxn.com/_controls/ui/gdFooter.php"); ?>
</div>
</body>
</html>

