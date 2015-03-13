<?php require_once("../gd.trxn.com/_controls/classes/_syscore.php"); ?>
<!DOCTYPE HTML><!-- HTML 5 -->
</html>
<head>
<title>Test Gamer Account</title>
<script>
</script>
</head>
<body>
<?php zReqOnce("/_controls/classes/accesspoints/object.php"); ?>
<?php
$output = ""; $return = null;

$object = new Object();
$object->assignObjectToGamer($_GET["GAMER_EMAIL"], $_GET["OBJECT_SDESC"]);
if($object->getSysReturnCode() == "GAMER_ASSIGNED_TO_HAZARD")
{
    $output = "Here is the return info for the New Record:".$object->getSysReturnCode();
    $return = $object;
}
else
{
    $output = "Here is the return info for the New Record:".$object->getSysReturnCode();
    $return = $object;
}
?>
<div>
<?php printf($output); ?>
<hr>
<?php printf("JSON:%s:", $return->getSysReturnAryJSON()); ?>
</div>
</body>
</html>