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
    var $orig_table_name = "mimes_standard_appl_image";
    var $thmb_table_name = "mimes_standard_appl_image_thumbnail_100x100";
    var $appl_table_name = "mimes_standard_appl_image_scaled";
    
    function __construct($formfieldname = "GDUploadImageFile",
                        $target_h_pxl = "500", 
                        $target_w_pxl = "500",
                        $target_image_size = "2097152")
    {
        $this->formfieldname = $formfieldname;
        $this->target_h_pxl = $target_h_pxl;
        $this->target_w_pxl = $target_w_pxl;
        $this->target_image_size = $target_image_size;
    }
    
    /*
     * GDUploadImageFile
     */
    function executeControl()
    {
        $uploadmime = new zUploadMime($_FILES[$this->formfieldname]);
        $r = $uploadmime->isImageValid($this->target_image_size);
        if($r == "VALID")
        {
            $uploadmime->setUrlfolder();
            $uploadmime->setOSfolder();
            $r = $uploadmime->uploadFile();
            if($r == "FILE_UPLOADED_SUCCESSFULY")
            {
                
                gdlog()->LogInfo("LOAD_ORIGINAL_IMAGE");
                $origimg = new zImageResize($uploadmime->getSaveFolderLocation(),
                    $uploadmime->getSaveFileName(),
                    $uploadmime->getAltFileSaveFileName(""));
                $origimg->loadOriginalFile();
                
                gdlog()->LogInfo("LOAD_THUMBNAIL_IMAGE");
                $thmbimg = new zImageResize($uploadmime->getSaveFolderLocation(),
                    $uploadmime->getSaveFileName(),
                    $uploadmime->getAltFileSaveFileName("thumbnail"));
                $thmbimg->loadOriginalFile();
                
                gdlog()->LogInfo("LOAD_APPLICATION_IMAGE");
                $applimg = new zImageResize($uploadmime->getSaveFolderLocation(),
                    $uploadmime->getSaveFileName(),
                    $uploadmime->getAltFileSaveFileName("medium"));
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
}
?>