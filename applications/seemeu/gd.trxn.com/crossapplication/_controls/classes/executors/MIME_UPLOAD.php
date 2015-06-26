<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php zReqOnce("/gd.trxn.com/crossapplication/_controls/classes/accesspoints/upload.php"); ?>
<?php
class Executor
    extends AppSysBaseObject
{
    function execute()
    {
        if($this->validate())
        {
            $upload = new Upload();
            $upload->uploadFile(array("tasktype" => "MIME_TYPE-IMAGE"
                , "param_name" => "files"));
                
            //zLog()->LogDebug("FILES:NAME{".json_encode($response)."}");
            
            /*
            $r = $gdud->registerToDB(gdconfig()->getSessUnivTblKey()."mimes_standard"
                                , "CROSSAPPDATA");
            
            gdlog()->LogInfo("IMAGE_VALIDATION:".$r);
            if($r == "UPLOAD_COMPLETED")
            {
            }
             */
            $this->transferSysReturnAry($upload);
            $this->setSysReturnData("GOOD_UPLOAD", "File(s) have been uploaded");
        }
        else
        {
            $this->setSysReturnData("FORM_FIELDS_NOT_VALID", "Please fill in all fields.", "TRUE");
        }
    }

    function validate()
    {
        $fv = true;  // Form is Valid Key T=Valid; anything else is invalid;
        if(!isset($_POST["files"]) || trim($_POST["files"]) == "")
            //$fv = ajaxValidationLogging(false, "uploadFiles", "POST:files");
        return $fv;
    }
}
?>