<?php require_once("../../../../gd.trxn.com/_controls/classes/_core.php"); ?>
<?php gdreqonce("/gd.trxn.com/upload/_controls/classes/upload.php"); ?>
<?php
$echoret = "";
$action = getControlKey();
if($action != "INVALID")
{
    gdlog()->LogInfo("GD_CONTROLLER_KEY{".$action."}");
    if($action == "DEFAULT")
    {
        $r = "UPLOAD_GOOD";
        $gdud = new gdUploadData();
        $gdud->uploadFile();
        $response = $gdud->getOutputData("UPLOAD_RESPONSE");
        $files = $gdud->getOutputData("UPLOAD_RESPONSE_FILES");
        gdlog()->LogInfo("FILES:NAME{".$files[0]->name."}");

        if(!isset($files[0]->error))
        {
            $r = $gdud->registerToDB();
            gdlog()->LogInfo("UPLOAD_RETURN{".$r."}");
            if($r == "UPLOAD_COMPLETED")
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "SUCCESS"
                                                    ,"RETURN_SHOW_PASS_MSG", "FALSE"
                                                    ,"RETURN_MSG", "post_max_size:". ini_get ( "post_max_size" ) .
                                                    ":upload_max_filesize:". ini_get ( "upload_max_filesize" ) .
                                                    ":memory_limit:". ini_get ( "memory_limit" )
                                                    ,"FILE_UPLOAD_INFO", $response));
            }
            else
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "UPLOAD_FAILED"
                                                    ,"RETURN_SHOW_PASS_MSG", "FALSE"
                                                    ,"RETURN_MSG", "Upload failed"));
            }
        }
        else
        {
            $echoret = json_encode(buildReturnArray("RETURN_KEY", "UPLOAD_FAILURE"
                                        ,"RETURN_SHOW_PASS_MSG", "TRUE"
                                        ,"RETURN_MSG", $files[0]->error));
        }
    }
    else
    {
        $echoret = json_encode(buildReturnArray("RETURN_KEY", "GD_CONTROLLER_KEY_NOT_VALID"
                                            ,"RETURN_SHOW_PASS_MSG", "FALSE"
                                            ,"RETURN_MSG", "GD_CONTROLLER_KEY Not valid"));
    }
}
else
{
    $echoret = json_encode(buildReturnArray("RETURN_KEY", "GD_CONTROLLER_KEY_NOT_FOUND"
                                        ,"RETURN_SHOW_PASS_MSG", "FALSE"
                                        ,"RETURN_MSG", "GD_CONTROLLER_KEY Not found"));
}
gdLogEchoReturn($echoret);
echo $echoret;

function validateLargeFileUploadForm()
{
    $fv = true;  // Form is Valid Key T=Valid; anything else is invalid;
    if (!isset($_POST["GDFileDescription"]) || $_POST["GDFileDescription"] == "")
        $fv = formValidationLogging(false, "validateLargeFileUploadForm", "GDFileDescription");
    return $fv;
}