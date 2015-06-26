<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/retrieve/appconfiguration.php"); ?>
<?php zReqOnce("/gd.trxn.com/crossapplication/_controls/classes/dataobjects/create/upload_core.php"); ?>
<?php zReqOnce("/gd.trxn.com/crossapplication/_controls/classes/dataobjects/create/mime.php"); ?>
<?php zReqOnce("/gd.trxn.com/crossapplication/_controls/classes/dataobjects/create/mime_meta.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class Upload
    extends AppSysBaseObject
{
    function __construct()
    {
    }
    
    /*
     * This Method is used when Creating
     * User Account and User Profile and Matching.
     * This account will be inactive.
     * the Task Control Unique QS will be generated.
     * You may access using the getTaskCountrolQS method
     * 
     * 'image_versions' => array(
     * '' => array('auto_orient' => true),
        'medium' => array('max_width' => 500,'max_height' => 500),
        'thumbnail' => array('max_width' => 100, 'max_height' => 100)
     * ),
                
     */
    function uploadFile($options = null)
    {
        zLog()->LogStart_AccessPointFunction("uploadFile");
        
        error_reporting(E_ALL | E_STRICT);
        if($options["tasktype"] == "MIME_TYPE-IMAGE")
        {
            $this->handleImage($options);
        }
        zLog()->LogEnd_AccessPointFunction("uploadFile");
    }

    private function handleImage($options)
    {
        zLog()->LogStart_AccessPointFunction("handleImage");
        
        $rac = new RetrieveAppConfiguration();
        $rac->byGroupkey("MIME_TYPE-IMAGE-CONFIG", "crossapplication");
        $rac_table = $rac->getResult_Records();
        foreach ($rac_table as $key => $row)
        {
            foreach($row as $fieldname => $fieldvalue)
            {
                if(strtoupper($fieldname) == "SDESC")
                {
                    $versions;
                    $config = substr($fieldvalue, strlen("MIME_TYPE-IMAGE-CONFIG-"));
                    if(strtoupper($config) == "ORIGINAL")
                    {
                        $versions[strtoupper($config)] = array("auto_orient" => true);
                    }
                    else
                    {
                        $hw = explode("X", strtoupper($config));
                        $versions[strtoupper($config)] = array("max_height" => $hw[0], "max_width" => $hw[1]);
                    }
                    $options["image_versions"] = $versions;
                }
            }
        }

        zLog()->LogDebug(json_encode($options));

        $upload_core;
        if($options == null)
            $upload_core = new UploadCore();
        else
            $upload_core = new UploadCore($options);
        
        $response = $upload_core->getResponse();
        $files = $response[$options["param_name"]];
        
        // Create Mime Record        
        $cm = new CreateMime();
        $cm->basic("MIME_TYPE-IMAGE", $files[0]->{"type"});
        
        // Create Mime Meta for Images
        foreach ($rac_table as $keys => $vals)
        {
            $config = substr($vals["sdesc"], strlen("MIME_TYPE-IMAGE-CONFIG-"));
            zLog()->LogDebug($keys."-".$vals["sdesc"]."-".$files[0]->{$config."Url"});

            $cmm = new CreateMimeMeta();
            $cmm->basic($cm->getUid()
                        , $vals["sdesc"]
                        , substr($files[0]->{"gdOSFilename"}, 0, strrpos($files[0]->{"gdOSFilename"}, ".", -1))
                        , $files[0]->{$config."Size"}
                        , $files[0]->{$config."OSFolder"}
                        , $files[0]->{$config."OSPath"}
                        , $files[0]->{"gdOSFileext"}
                        , $files[0]->{"gdUrlfolder"}."/".$config
                        , $files[0]->{$config."Url"}
                        , $files[0]->{"gdOSFileext"});
        }
 
        // Upload Response and add to return Array
        zLog()->LogDebug(json_encode($response));
        foreach ($files as $key => $row)
        {
            foreach($row as $fieldname => $fieldvalu)
            {
                $this->setSysReturnitem($fieldname, $fieldvalu);
            }
        }
        $this->setSysReturnitem("MIME_UID", $cm->getUid());
        zLog()->LogEnd_AccessPointFunction("handleImage");
    }
}
?>