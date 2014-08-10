<?php gdreqonce("/gd.trxn.com/_controls/classes/dbconnection.php"); ?>
<?php
$sdesc = filter_var($_GET["sdesc"], FILTER_SANITIZE_STRING);
$display = filter_var($_GET["display"], FILTER_SANITIZE_STRING);
$ldesc = filter_var($_GET["ldesc"], FILTER_SANITIZE_STRING);
if(isset($_GET["dependentuid"]))
    $dependentuid = filter_var($_GET["dependentuid"], FILTER_SANITIZE_STRING);
else
    $dependentuid = "";

$sqlstmnt = "INSERT INTO core_help_values SET ".
"uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
"sdesc=:sdesc, display=:display, ldesc=:ldesc, dependentuid=:dependentuid";

$dbcontrol = new Z_GDDBConnection();
$dbcontrol->setCrossAppConn();
$dbcontrol->setStatement($sqlstmnt);

$dbcontrol->bindParam(":sdesc", $sdesc);
$dbcontrol->bindParam(":display", $display);
$dbcontrol->bindParam(":ldesc", $ldesc);
$dbcontrol->bindParam(":dependentuid", $dependentuid);

$dbcontrol->execUpdate();

if($dbcontrol->getTransactionGood())
    $dbcontrol->saveActivityLog("Help Data is added to system. ".$searchkey."-".$display."-".$ldesc."-".$dependentuid."-");

$dbcontrol->rollbackcommit();

echo $dbcontrol->getErrorContainerJSAlert();
?>