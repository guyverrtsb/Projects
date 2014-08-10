<?php gdreqonce("/gd.trxn.com/_controls/classes/dbconnection.php"); ?>
<?php
if(isset($_GET["dependentuid"]))
    $dependentuid = filter_var($_GET["dependentuid"], FILTER_SANITIZE_STRING);
else
    $dependentuid = "dependentuid";

$sqlstmnt = "SELECT `uid`, `srchkey`, `display`, `ldesc`, `dependentuid` FROM core_help_values "."WHERE dependentuid=:dependentuid";

$dbcontrol = new Z_GDDBConnection();
$dbcontrol->setCrossAppConn();
$dbcontrol->setStatement($sqlstmnt);

$dbcontrol->bindParam(":dependentuid", $dependentuid);
$numrows = $dbcontrol->execSelect();
?>
{
    "JSONRESULTS" :
    [
<?php
echo $dbcontrol->getSelectResultJSON("uid", "srchkey", "display", "ldesc", "dependentuid");
?>
    ]
}
<?php
$dbcontrol->rollbackcommit();
?>