<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php gdreqonce("/gd.trxn.com/upload/_controls/classes/handler/UploadHandler.php"); ?>
<?php gdreqonce("/gd.trxn.com/upload/_controls/classes/meta/metatodatabase.php"); ?>
<?php gdreqonce("/gd.trxn.com/upload/_controls/classes/mimes/documenttodatabase.php"); ?>
<?php gdreqonce("/gd.trxn.com/upload/_controls/classes/mimes/imagetodatabase.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class gdUploadData
    extends zAppBaseObject
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
     */
    function uploadFile($options = null)
    {
        $this->gdlog()->LogInfoStartFUNCTION("uploadFile");
        $fr = "UNKNOWN_ERROR";
        
        error_reporting(E_ALL | E_STRICT);
        
        $upload_handler;
        if($options == null)
            $upload_handler = new UploadHandler();
        else
            $upload_handler = new UploadHandler($options);
            
        $response = $upload_handler->getResponse();
        
        $this->setOutputData("UPLOAD_RESPONSE", $response);
        if($options == null)
        {
            $this->setOutputData("UPLOAD_RESPONSE_FILES", $response["files"]);
            $this->gdlog()->LogInfo("UPLOAD UPLOAD_RESPONSE_FILES:{files:".json_encode($response["files"])."}");
        }
        else
        {
            $this->setOutputData("UPLOAD_RESPONSE_FILES", $response[$options["param_name"]]);
            $this->gdlog()->LogInfo("UPLOAD_RESPONSE_FILES:{".$options["param_name"].":".json_encode($response[$options["param_name"]])."}");
        }
        $this->gdlog()->LogInfoEndFUNCTION("uploadFile");
        return $fr;
    }
    
    function registerToDB($appl_table_key = "mimes_standard"
                        , $dbconfigkey = "CROSSAPPDATA")
    {
        $this->gdlog()->LogInfoStartFUNCTION("registerToDB");
        gdlog()->LogInfo("appl_table_key{".$appl_table_key."}");
        gdlog()->LogInfo("dbconfigkey{".$dbconfigkey."}");
        $fr = "UNKNOWN_ERROR";
        
        $files = $this->getOutputData("UPLOAD_RESPONSE_FILES");
        gdlog()->LogInfo("FILES:NAME{".$files[0]->name."}");
        
        
        $this->findConfigurationfromSdesc("MIME_TYPES_".$files[0]->gdOSFileext, "CROSSAPPDATA");
        $docType = $this->getConfigurationGroupKey();
        $this->gdlog()->LogInfo("CONFIG_DATA{".$this->getConfigurationGroupKey()."}");       
      
        /*
         * Load Mime BLOB
         * Load Mime Meta
         */
        if($docType == "MIME_TYPES_DOCUMENT")
        {
            $zdtdb = new zDocumenttoDatabase();
            $fr = $zdtdb->registerMimeBlobDocument($appl_table_key."_appl_document"
                                                , $files[0]->size
                                                , $files[0]->gdOSPath);
            if($fr == "MIME_BLOB_REGISTERED")
            {
                $zmtdb = new zMetatoDatabase();
                $fr = $zmtdb->registerMetaDataDocument($dbconfigkey
                                                    , $appl_table_key."_meta_document"
                                                    , $this->getGDConfig()->getSite()
                                                    , $this->getGDConfig()->getSiteAlias()
                                                    , $appl_table_key."_appl_document"
                                                    , $zdtdb->getAppl_uid()
                                                    , $files[0]->name
                                                    , $files[0]->size
                                                    , $files[0]->type
                                                    , $files[0]->url
                                                    , $files[0]->gdOSFolder
                                                    , $files[0]->gdOSPath
                                                    , $files[0]->gdUrlfolder
                                                    , $files[0]->gdUrlPath
                                                    , $files[0]->gdOSFileext);
                                            
                if($fr == "META_DATA_REGISTERED")
                {
                    $fr = "UPLOAD_COMPLETED";
                }
                else
                {
                    $fr = "UPLOAD_META_FAILED";
                }
            }
            else
            {
                $fr = "UPLOAD_BLOB_FAILED";
            }
        }
        else if($docType == "MIME_TYPES_IMAGE")
        {
            $zdtdb = new zImagetoDatabase();
            $fr = $zdtdb->registerMimeBlobImage($dbconfigkey
                                            , $appl_table_key."_appl_image"
                                            , $files[0]->size
                                            , $files[0]->gdOSPath);
            $zdtdbScaled = new zImagetoDatabase();
            $fr = $zdtdbScaled->registerMimeBlobImage($dbconfigkey
                                            , $appl_table_key."_appl_image_scaled"
                                            , $files[0]->mediumSize
                                            , $files[0]->mediumOSPath);
            $zdtdbThumbnail = new zImagetoDatabase();
            $fr = $zdtdbThumbnail->registerMimeBlobImage($dbconfigkey
                                            , $appl_table_key."_appl_image_thumbnail_100x100"
                                            , $files[0]->thumbnailSize
                                            , $files[0]->thumbnailOSPath);
            if($fr =="MIME_BLOB_REGISTERED")
            {
                $zmtdb = new zMetatoDatabase();
                $fr = $zmtdb->registerMetaDataImage($dbconfigkey
                                                    , $appl_table_key."_meta_image"
                                                    , $this->getGDConfig()->getSite()
                                                    , $this->getGDConfig()->getSiteAlias()
                                                    , $appl_table_key."_appl_document"
                                                    , $zdtdb->getAppl_uid()
                                                    , $files[0]->name
                                                    , $files[0]->size
                                                    , $files[0]->type
                                                    , $files[0]->url
                                                    , $files[0]->gdOSFolder
                                                    , $files[0]->gdOSPath
                                                    , $files[0]->gdUrlfolder
                                                    , $files[0]->gdUrlPath
                                                    , $files[0]->gdOSFileext
                                                    
                                                    , $appl_table_key."_appl_image_scaled"
                                                    , $zdtdbScaled->getAppl_uid()
                                                    , $files[0]->mediumSize
                                                    , $files[0]->mediumUrl
                                                    , $files[0]->mediumOSPath
                                                    , $files[0]->mediumOSFolder
                                                    
                                                    , $appl_table_key."_appl_image_thumbnail_100x100"
                                                    , $zdtdbThumbnail->getAppl_uid()
                                                    , $files[0]->thumbnailSize
                                                    , $files[0]->thumbnailUrl
                                                    , $files[0]->thumbnailOSPath
                                                    , $files[0]->thumbnailOSFolder);
                                            
                if($fr == "META_DATA_REGISTERED")
                {
                    $this->setOutputData("META_UID", $zmtdb->getMeta_uid());
                    $this->setOutputData("MIME_TYPE_GROUP", $docType);
                    $fr = "UPLOAD_COMPLETED";
                }
                else
                {
                    $fr = "UPLOAD_META_FAILED";
                }
            }
            else
            {
                $fr = "UPLOAD_BLOB_FAILED";
            }
            $fr = "UPLOAD_COMPLETED";
        }
        else
        {
        	
        }
        $this->gdlog()->LogInfoEndFUNCTION("registerToDB");
        return $fr;
    }
    
    function metaDatatoDB()
    {
        $this->gdlog()->LogInfoStartFUNCTION("metaDatatoDB");
        $fr = "UNKNOWN_ERROR";
        
        $zmtdb = new zMetatoDatabase();
        $zmtdb->registerMetaData($meta_table_name
                                , $appl_table_name
                                , $sitepackage
                                , $sitealias
                                , $ref_meta_uid
                                , $mime_type);
        
        
        $this->gdlog()->LogInfoEndFUNCTION("metaDatatoDB");
        return $fr;
    }
}
?>