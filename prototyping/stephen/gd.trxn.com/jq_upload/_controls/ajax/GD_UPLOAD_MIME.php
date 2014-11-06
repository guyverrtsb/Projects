<?php require_once("../../../../gd.trxn.com/_controls/classes/_core.php"); ?>
<?php gdreqonce("/gd.trxn.com/jq_upload/_controls/classes/UploadHandler.php"); ?>
<?php
error_reporting(E_ALL | E_STRICT);
$upload_handler = new UploadHandler();
$response = $upload_handler->getResponse();
$echoret = json_encode($response);

$files = $response["files"];
gdlog()->LogInfo($files[0]->name);
gdLogEchoReturn($echoret);
echo $echoret;
?>