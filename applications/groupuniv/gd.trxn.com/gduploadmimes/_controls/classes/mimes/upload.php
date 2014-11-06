<?php gdreqonce("/gd.trxn.com/gduploadmimes/_controls/classes/base/mimesbase.php"); ?>
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
class zUploadMime
    extends zMimesBaseObject
{
    var $form_file = null;
    var $fileext = "";
    var $filerror = "";
    var $file = null;
    
    
    function __construct($form_file)
    {
        gdlog()->LogInfoStartFUNCTION("__construct()");
        $this->form_file = $form_file;
        if ($this->form_file["error"] > 0)
        {
            gdlog()->LogInfo("Return Code: " . $this->form_file["error"]);
            $this->filerror = "FILE_ERROR:".$this->form_file["error"];
        }
        else
        {
            $temp = explode(".", $this->form_file["name"]);
            $this->fileext = strtolower(end($temp));
            $this->filerror = "FILE_NOT_ERROR";
        }
        gdlog()->LogInfoEndFUNCTION("__construct()");
    }
    
    function isImageValid($target_image_size)
    {
        gdlog()->LogInfoStartFUNCTION("isImageValid()");
        $r = $this->filerror;
        if($this->filerror == "FILE_NOT_ERROR"
            && (($this->form_file["type"] == "image/gif") || ($this->form_file["type"] == "image/jpeg")
            || ($this->form_file["type"] == "image/jpg") || ($this->form_file["type"] == "image/pjpeg")
            || ($this->form_file["type"] == "image/x-png") || ($this->form_file["type"] == "image/png"))
            && $this->form_file["size"] <= $target_image_size
            && in_array($this->fileext, array("gif", "jpeg", "jpg", "png")))
        {
            $this->file = new \stdClass();
            $this->file->name = $this->form_file["name"];
            $this->file->size = $this->form_file["size"];
            $this->file->type = $this->form_file["type"];
            $r = "VALID";
        }
        else if($this->form_file["size"] > $target_image_size)
        {
            $r = "INVALID_FILE_SIZE";
        }
        else if(in_array($this->fileext, array("gif", "jpeg", "jpg", "png")))
        {
            $r = "INVALID_FILE_EXTENSION";
        }
        else if($this->filerror == "FILE_NOT_ERROR")
        {
            $r = "INVALID_FILE_ERROR";
        }
        else if((($this->form_file["type"] == "image/gif") || ($this->form_file["type"] == "image/jpeg")
            || ($this->form_file["type"] == "image/jpg") || ($this->form_file["type"] == "image/pjpeg")
            || ($this->form_file["type"] == "image/x-png") || ($this->form_file["type"] == "image/png")))
        {
            $r = "INVALID_FILE_TYPE";
        }
        gdlog()->LogInfoEndFUNCTION("isImageValid()");
        return $r;
    }
    
    function uploadFile()
    {
        gdlog()->LogInfoStartFUNCTION("uploadFile()");
        $r = "FAILURE";
        if (file_exists($this->osfolder . $this->file->name))
        {
            gdlog()->LogInfo($this->osfolder . $this->file->name . " already exists.");
            $r = "FILE_ALREADY_EXISTS";
        }
        else
        {
            gdlog()->LogInfo("file path{".$this->osfolder . $this->file->name."}");
            move_uploaded_file($this->form_file["tmp_name"], $this->osfolder . $this->file->name);
            
            $this->setGDProperties($this->file);
            $this->dumpProperties($this->file);
            $r = "FILE_UPLOADED_SUCCESSFULY";
        }
        gdlog()->LogInfoEndFUNCTION("uploadFile()");
        return $r;
    }
    
    function getFile()
    {
        return $this->file;
    }
}
?>