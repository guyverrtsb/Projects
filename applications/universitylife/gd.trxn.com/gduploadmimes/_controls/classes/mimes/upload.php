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
    var $allowedExts;
    var $file;
    var $extension;
    var $mimepath;
    var $savefolderlocation = "";
    var $savefilename = "";
    var $filerror = "";
    var $fileurl = "";
    var $filenamebase = "";
    
    function __construct($form_file)
    {
        gdlog()->LogInfoStartFUNCTION("__construct()");
        $this->file = $form_file;
        if ($this->file["error"] > 0)
        {
            gdlog()->LogInfo("Return Code: " . $this->file["error"]);
            $this->filerror = "FILE_ERROR:".$this->file["error"];
        }
        else
        {
            $temp = explode(".", $this->file["name"]);
            $this->extension = strtolower(end($temp));
            $this->filerror = "FILE_NOT_ERROR";
            $this->filenamebase = date("H-i-s")."_".session_id();
        }
    }
    
    function isImageValid($target_image_size)
    {
        gdlog()->LogInfoStartFUNCTION("setValidImageInfo()");
        $r = $this->filerror;
        if($this->filerror == "FILE_NOT_ERROR"
            && (($this->file["type"] == "image/gif") || ($this->file["type"] == "image/jpeg")
            || ($this->file["type"] == "image/jpg") || ($this->file["type"] == "image/pjpeg")
            || ($this->file["type"] == "image/x-png") || ($this->file["type"] == "image/png"))
            && $this->file["size"] < $target_image_size
            && in_array($this->extension, array("gif", "jpeg", "jpg", "png")))
        {
            $r = "VALID";
        }
        else if($this->file["size"] < $target_image_size)
        {
            $r = "INVALID_FILE_SIZE";
        }
        else if(in_array($this->extension, array("gif", "jpeg", "jpg", "png")))
        {
            $r = "INVALID_FILE_EXTENSION";
        }
        else if($this->filerror == "FILE_NOT_ERROR")
        {
            $r = "INVALID_FILE_ERROR";
        }
        else if((($this->file["type"] == "image/gif") || ($this->file["type"] == "image/jpeg")
            || ($this->file["type"] == "image/jpg") || ($this->file["type"] == "image/pjpeg")
            || ($this->file["type"] == "image/x-png") || ($this->file["type"] == "image/png")))
        {
            $r = "INVALID_FILE_TYPE";
        }
        return $r;
    }
    
    function uploadFile()
    {
        gdlog()->LogInfoStartFUNCTION("uploadFile()");
        $r = "FAILURE";
        /** Define Folder Path **/
        $ospathroot = $this->getSaveFolderLocation();
        /** Get New File Name **/
        $savefilename = $this->getSaveFileName();

        if (file_exists($ospathroot . $savefilename))
        {
            gdlog()->LogInfo($ospathroot . $savefilename . " already exists.");
            $r = "FILE_ALREADY_EXISTS";
        }
        else
        {
            move_uploaded_file($this->file["tmp_name"], $ospathroot . $savefilename);
            $this->logUploadFileData($ospathroot . $savefilename);
            $this->setFileURL();
            $r = "FILE_UPLOADED_SUCCESSFULY";
            $this->ffolder = $ospathroot;
            $this->fname = $savefilename;
            $this->ffolder = $ospathroot . $savefilename;
            $this->setMimeData();
        }
        return $r;
    }
    
    function setSaveFolderLocation($foldername_subdirectory = "")
    {
        gdlog()->LogInfoStartFUNCTION("setSaveFolderLocation()");
        $ospathroot = "";
        if($_SESSION['GUYVERDESIGNS_SERVER_ENVIRONMENT'] == "LCL")
            $ospathroot = $_SERVER["CONTEXT_DOCUMENT_ROOT"]."/../mimes/";
        else
            $ospathroot = $_SERVER["SUBDOMAIN_DOCUMENT_ROOT"]."/../../../../zzzproduction/websites/crossdomain/mimes/";
        
        $ospathroot = $ospathroot
            .$_SESSION["GUYVERDESIGNS_SITE"]."/"
            .$_SESSION["GUYVERDESIGNS_SITE_ALIAS"]."/";
            
        if(trim($foldername_subdirectory) != "")
            $ospathroot = $ospathroot.$foldername_subdirectory."/";
        
        $this->mimepath = date("Y")."/".date("m")."/".date("d")."/".date("H")."/";
        
        $ospathroot = $ospathroot.$this->mimepath;
        gdlog()->LogInfo("FolderPath: " . $ospathroot);
                if (!file_exists($ospathroot))
        {
            mkdir($ospathroot, 0777, true);
        }
        
        $this->savefolderlocation = $ospathroot;
    }
    
    function getSaveFolderLocation()
    {
        gdlog()->LogInfoStartFUNCTION("getSaveFolderLocation()");
        return $this->savefolderlocation;
    }    
    
    function setSaveFileName($filename_suffix = "_ORIG")
    {
        gdlog()->LogInfoStartFUNCTION("setSaveFileName()");
        $this->savefilename = $this->filenamebase.$filename_suffix.".".$this->extension;
    }
    
    function getSaveFileName()
    {
        gdlog()->LogInfoStartFUNCTION("getSaveFileName()");
        return $this->savefilename;
    }
    
    function getFileURI()
    {
        gdlog()->LogInfoStartFUNCTION("getFileURI()");
        return $this->getSaveFolderLocation() . $this->getSaveFileName();
    }
    
    function getAltFileSaveFileName($filename_suffix = "_NEW")
    {
        gdlog()->LogInfoStartFUNCTION("getAltFileSaveFileName()");
        return $this->filenamebase.$filename_suffix.".".$this->extension;
    }
    
    function setFileURL()
    {
        gdlog()->LogInfoStartFUNCTION("setFileURL()");
        $temp = explode(".", $_SESSION["GUYVERDESIGNS_SITE_ALIAS"]);
        $this->fileurl = "mimes"."."
            .$temp[1]."."
            .$temp[2]."/"
            .$_SESSION["GUYVERDESIGNS_SITE"]."/"
            .$_SESSION["GUYVERDESIGNS_SITE_ALIAS"]."/"
            .$this->mimepath
            .$this->getSaveFileName();
        gdlog()->LogInfo("setFileURL():this->fileurl{".$this->fileurl."}");
    }
    
    function getFileURL()
    {
        gdlog()->LogInfoStartFUNCTION("getFileURL()");
        return $this->fileurl;
    }
    
    function logUploadFileData($newfilelocation)
    {
        gdlog()->LogInfo("Upload: " . $this->file["name"]);
        gdlog()->LogInfo("New File: " . $newfilelocation);
        gdlog()->LogInfo("Type: " . $this->file["type"]);
        gdlog()->LogInfo("Size: " . ($this->file["size"] / 1024) . " kB");
        gdlog()->LogInfo("Temp file: " . $this->file["tmp_name"]);
    }
}
?>