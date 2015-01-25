<?php require_once("../../../gd.trxn.com/_controls/classes/_core.php"); ?>
<?php gdreqonce("/gd.trxn.com/upload/_controls/classes/mimes/upload.php"); ?>
<?php gdreqonce("/gd.trxn.com/upload/_controls/classes/controls/document.php"); ?>
<?php
$echoret = "";
$action = getControlKey();
if($action != "INVALID")
{
    gdlog()->LogInfo("GD_CONTROLLER_KEY{".$action."}");
    if($action == "UPLOAD_LARGE_FILE")
    {
        // Do File Upload
        if(validateLargeFileUploadForm())
        {
            // Upload File
            $uploadmime = new zUploadMime();
            $r = $uploadmime->setUploadFileDetail($_FILES[$uploadmime->getFormfieldname()]);
            if($r == "FILE_NOT_ERROR")
            {
                $r = $uploadmime->uploadFile();
                if($r == "FILE_UPLOADED_SUCCESSFULLY")
                {
                    // Logic Control
                    $zduc = new zDocumentUploadControl();
                    $r = $zduc->executeControl($uploadmime);
                    if($r == "DOCUMENT_BLOB_REGISTERED")
                    {
                        gdlog()->LogInfoTaskLabel("Register Large File Information");
                        $description = filter_var($_POST["GDFileDescription"], FILTER_SANITIZE_STRING);
                        $echoret = json_encode(buildReturnArray("RETURN_KEY", "SUCCESS"
                                                    ,"RETURN_SHOW_PASS_MSG", "FALSE"
                                                    ,"RETURN_MSG", "post_max_size:". ini_get ( "post_max_size" ) .
                                                    ":upload_max_filesize:". ini_get ( "upload_max_filesize" ) .
                                                    ":memory_limit:". ini_get ( "memory_limit" )));
                    }
                    else
                    {
                        $echoret = json_encode(buildReturnArray("RETURN_KEY", "LOAD_TO_DB_FAILURE"
                                                    ,"RETURN_SHOW_PASS_MSG", "TRUE"
                                                    ,"RETURN_MSG", "The Mime was not loaded to DB correctly.  Please try again."));
                    }
                }
                else
                {
                    $echoret = json_encode(buildReturnArray("RETURN_KEY", "UPLOAD_FAILURE"
                                                ,"RETURN_SHOW_PASS_MSG", "FALSE"
                                                ,"RETURN_MSG", "File Upload Failure"));
                }
            }
            else if($r == "FILE_TOO_LARGE")
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "FILE_TOO_LARGE"
                                            ,"RETURN_SHOW_PASS_MSG", "FALSE"
                                            ,"RETURN_MSG", "File Upload Failure due to file being too large"));
            }
            else
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "FORM_UPLOAD_FIELD_INVALID"
                                                    ,"RETURN_SHOW_PASS_MSG", "FALSE"
                                                    ,"RETURN_MSG", "Erorr with Form Upload field"));
            }
        }
        else
        {
            $echoret = json_encode(buildReturnArray("RETURN_KEY", "FORM_FIELDS_NOT_VALID"
                                                ,"RETURN_SHOW_PASS_MSG", "FALSE"
                                                ,"RETURN_MSG", "Please fill in all fields."));
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