<?php gdreqonce("/gd.trxn.com/gduploadmimes/_controls/classes/base/mimesbase.php"); ?>
<?php gdreqonce("/gd.trxn.com/gduploadmimes/_controls/classes/mimes/upload.php"); ?>
<?php gdreqonce("/gd.trxn.com/gduploadmimes/_controls/classes/mimes/resizeimage.php"); ?>
<?php gdreqonce("/gd.trxn.com/gduploadmimes/_controls/classes/mimes/imagetodatabase.php"); ?>
<?php
/*
* File: mimes/upload.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/12/21
* This Class is designed to control the uploading of files.
* It will only do uploading on mimes of all types into a defiend
* folder structure on the server.  
* this class will return the location of the saved file for further
* manipulation such as scaling and creation of other files and also
* for uploading to a database.
*/
class zImageUploadControl
    extends zMimesBaseObject
{
    var $formfieldname;
    var $target_h_pxl;
    var $target_w_pxl;
    var $target_image_size;
    var $orig_mimes_uid, $thmb_mimes_uid, $appl_mimes_uid;
    
    var $mimes_table_name;
    var $orig_table_name = "mimes_original_image";
    var $thmb_table_name = "mimes_thumbnail_image_100x100";
    var $appl_table_name;
    
    function __construct($formfieldname = "GDUploadImageFile", 
                        $mimes_table_name = "mimes_standard", 
                        $appl_table_name = "mimes_standard_image", 
                        $target_h_pxl = "500", 
                        $target_w_pxl = "500",
                        $target_image_size = "2097152")
    {
        $this->formfieldname = $formfieldname;
        $this->appl_table_name = $appl_table_name;
        $this->target_h_pxl = $target_h_pxl;
        $this->target_w_pxl = $target_w_pxl;
        $this->target_image_size = $target_image_size;
    }
    
    /*
     * GDUploadImageFile
     */
    function executeControl()
    {
        $return_mimes_data = "";
        $uploadmime = new zUploadMime($_FILES[$this->formfieldname]);
        $r = $uploadmime->isImageValid($this->target_image_size);
        if($r == "VALID")
        {
            $r = $uploadmime->uploadFile();
            if($r == "FILE_UPLOADED_SUCCESSFULY")
            {
                
                gdlog()->LogInfo("LOAD_ORIGINAL_IMAGE");
                $origimg = new zImageResize($uploadmime->getSaveFolderLocation(),
                    $uploadmime->getSaveFileName(),
                    $uploadmime->getAltFileSaveFileName("_ORIG"));
                $origimg->loadOriginalFile();
                
                gdlog()->LogInfo("LOAD_THUMBNAIL_IMAGE");
                $thmbimg = new zImageResize($uploadmime->getSaveFolderLocation(),
                    $uploadmime->getSaveFileName(),
                    $uploadmime->getAltFileSaveFileName("_THUMB"));
                $thmbimg->loadOriginalFile();
                
                gdlog()->LogInfo("LOAD_APPLICATION_IMAGE");
                $applimg = new zImageResize($uploadmime->getSaveFolderLocation(),
                    $uploadmime->getSaveFileName(),
                    $uploadmime->getAltFileSaveFileName("_APPLI"));
                $applimg->loadOriginalFile();
        
                gdlog()->LogInfo("RESIZE_IMAGES");
                if($origimg->getOrigWidth() > $origimg->getOrigHeight())    // Landscape
                {
                    $thmbimg->resizeToWidth(100);
                    $applimg->resizeToWidth($this->target_w_pxl);
                }
                else    // Portrait or Square
                {
                    $thmbimg->resizeToHeight(100);
                    $applimg->resizeToHeight($this->target_h_pxl);
                }
                
                $thmbimg->saveConfiguredFile();
                $applimg->saveConfiguredFile();
                
                gdlog()->LogInfo("THUMB_IMAGE_DATA");
                $thmbimg->logImageData();
                $thmbimg->logMimeData();
                
                gdlog()->LogInfo("APPLI_IMAGE_DATA");
                $applimg->logImageData();
                $applimg->logMimeData();
                
                gdlog()->LogInfo("LOAD_TO DB_ORIGINAL");
                $zitdorig = new zImagetoDatabase();
                $r = $zitdorig->registerMime($this->mimes_table_name,
                                    $this->orig_table_name,
                                    $origimg->getOrigFileName(),
                                    $origimg->getOrigType(),
                                    $origimg->getOrigFileExt(),
                                    $origimg->getOrigSize(),
                                    $origimg->getOrigFilePath(),
                                    $origimg->getOrigFileFolder(),
                                    $_SESSION["GUYVERDESIGNS_SITE"],
                                    $_SESSION["GUYVERDESIGNS_SITE_ALIAS"]);
                if($r == "MIME_REGISTERED")
                {
                    $this->orig_mimes_uid = $zitdorig->getMimesUid();
                    gdlog()->LogInfo("ORIGINAL_MIME_DATA{".$zitdorig->getMimesUid()."}");
                    $r = $zitdorig->registerMimeBlobImage($origimg->getOrigWidth(),
                                                        $origimg->getOrigHeight());
                    if($r == "MIME_BLOB_REGISTERED")
                    {
                        gdlog()->LogInfo("ORIGINAL_MIME_BLOB_UPLOADED{".$zitdorig->getMimesApplUid()."}");
                        $return_mimes_data = $return_mimes_data.":ORIG:".$zitdorig->getMimesUid();
                        
                        gdlog()->LogInfo("LOAD_TO DB_THUMBNAIL");
                        $zitdthmb = new zImagetoDatabase();
                        $r = $zitdthmb->registerMime($this->mimes_table_name,
                                            $this->thmb_table_name,
                                            $thmbimg->getFileName(),
                                            $thmbimg->getType(),
                                            $thmbimg->getFileExt(),
                                            $thmbimg->getFileSize(),
                                            $thmbimg->getFilePath(),
                                            $thmbimg->getFileFolder(),
                                            $_SESSION["GUYVERDESIGNS_SITE"],
                                            $_SESSION["GUYVERDESIGNS_SITE_ALIAS"]);
                        if($r == "MIME_REGISTERED")
                        {
                            gdlog()->LogInfo("THUMBNAIL_MIME_DATA{".$zitdthmb->getMimesUid()."}");
                            $r = $zitdthmb->registerMimeBlobImage($thmbimg->getWidth(),
                                                                $thmbimg->getHeight());
                            if($r == "MIME_BLOB_REGISTERED")
                            {
                                $this->thmb_mimes_uid = $zitdthmb->getMimesUid();
                                gdlog()->LogInfo("THUMBNAIL_MIME_BLOB_UPLOADED{".$zitdthmb->getMimesApplUid()."}");
                                $return_mimes_data = $return_mimes_data.":THMB:".$zitdthmb->getMimesUid();
                                
                                gdlog()->LogInfo("LOAD_TO DB_APPLICATION");
                                $zitdappl = new zImagetoDatabase();
                                $r = $zitdappl->registerMime($this->mimes_table_name,
                                                    $this->$appl_table_name,
                                                    $applimg->getFileName(),
                                                    $applimg->getType(),
                                                    $applimg->getFileExt(),
                                                    $applimg->getFileSize(),
                                                    $applimg->getFilePath(),
                                                    $applimg->getFileFolder(),
                                                    $_SESSION["GUYVERDESIGNS_SITE"],
                                                    $_SESSION["GUYVERDESIGNS_SITE_ALIAS"]);
                                if($r == "MIME_REGISTERED")
                                {
                                    $this->appl_mimes_uid = $zitdappl->getMimesUid();
                                    gdlog()->LogInfo("APPLICATION_MIME_DATA{".$zitdappl->getMimesUid()."}");
                                    $r = $zitdappl->registerMimeBlobImage($applimg->getWidth(),
                                                                        $applimg->getHeight());
                                    if($r == "MIME_BLOB_REGISTERED")
                                    {
                                        gdlog()->LogInfo("APPLICATION_MIME_BLOB_UPLOADED{".$zitdappl->getMimesApplUid()."}");
                                        $return_mimes_data = $return_mimes_data.":APPL:".$zitdappl->getMimesUid();
                                    }
                                }
                            }
                        }
                    }
                }
                return $r;
            }
            else
            {
                return $r;
            }
        }
        else
        {
            return $r;
        }
    }

    function getOrigMimeUid()
    {
        return $this->orig_mimes_uid;
    }
    function getThumbMimeUid()
    {
        return $this->thmb_mimes_uid;
    }
    function getApplMimeUid()
    {
        return $this->appl_mimes_uid;
    }
}
?>