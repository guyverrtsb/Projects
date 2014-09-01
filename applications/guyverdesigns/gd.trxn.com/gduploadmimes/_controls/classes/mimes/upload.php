<?php gdreqonce("/gd.trxn.com/gduploadmimes/_controls/classes/base/uploadbase.php"); ?>
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
    extends zUploadBaseObject
{
    var $filetoupload;
    function __construct()
    {
        parent::__construct();
    }
    
    function setUploadFileDetail($form_file)
    {
        gdlog()->LogInfoStartFUNCTION("setUploadFileDetail()");
        $this->filetoupload = $form_file;
        gdlog()->LogInfo("Return Code: File {".$this->filetoupload["size"]."} : allowed {".$this->target_mime_size."}.");
        if ($this->filetoupload["error"] > 0)
        {
            if($this->filetoupload["error"] == 1)
            {
                gdlog()->LogInfo("Return Code: File to Large File is {".$this->filetoupload["size"]."} : needs to be less then {".$this->target_mime_size."}.");
                return "FILE_TOO_LARGE";
            }
            else
            {
                gdlog()->LogInfo("Return Code: " ."[". $this->filetoupload["error"] ."]". $this->getErrorMessage($this->filetoupload["error"]));
                return "FILE_ERROR";
            }
        }
        else
        {
            $temp = explode(".", $this->filetoupload["name"]);
            $this->fname = strtolower(reset($temp));
            $this->fnamebase = date("H-i-s")."_".session_id();
            $this->fext = strtolower(end($temp));
            $this->uploadfsize = $this->filetoupload["size"];
            return "FILE_NOT_ERROR";
        }
    }
    
    function uploadFile($foldername_subdirectory = "")
    {
        gdlog()->LogInfoStartFUNCTION("uploadFile()");
        $r = "FAILURE";
        /** Define Folder Path **/
        $this->setFilefolder($foldername_subdirectory);
        $ospathroot = $this->getFilefolder();
        /** Get New File Name **/
        $savefilename = $this->getFilename() . $this->getFilenamebase() .".". $this->getFileext();
        $this->fpath = $ospathroot . $savefilename;
        gdlog()->LogInfo("file path :{" . $this->getFilepath() . "}");
        if (file_exists($ospathroot . $savefilename))
        {
            $r = "FILE_ALREADY_EXISTS";
        }
        else
        {
            move_uploaded_file($this->filetoupload["tmp_name"], $ospathroot . $savefilename);
            $this->fsize = filesize($this->getFilepath());
            if($this->uploadfsize == $this->fsize)
                $r = "FILE_UPLOADED_SUCCESSFULLY";
            else
            {
                $r = "FILE_UPLOADED_SUCCESSFULLY_SIZE_MISMATCH";
                gdlog()->LogInfo("file size :{" . $this->uploadfsize . "}:{" . $this->fsize . "}");
            }
        }
        gdlog()->LogInfoEndFUNCTION("uploadFile()");
        return $r;
    }
}
?>