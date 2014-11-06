<?php gdreqonce("/gd.trxn.com/gduploadmimes/_controls/classes/base/mimebase.php"); ?>
<?php
class zUploadBaseObject
    extends zMimeBaseObject
{
    var $formfieldname = "GDFileUploadMimeFile";
    var $target_mime_size = "2097152";
    function __construct()
    {
        $sz = substr(ini_get("upload_max_filesize"), 0, (strlen(ini_get("upload_max_filesize")) - 1));
        $this->target_mime_size = ($sz * 1000000);
    }
    
    function setFormfieldname($formfieldname)
    {
        $this->formfieldname = $formfieldname;
    }
    
    function getFormfieldname()
    {
        return $this->formfieldname;
    }
    
    function setTarget_mime_size($target_mime_size)
    {
        $this->target_mime_size = $target_mime_size;
    }
    
    function getTarget_mime_size()
    {
        return $this->target_mime_size;
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
            && in_array($this->getFileExt(), array("gif", "jpeg", "jpg", "png")))
        {
            $r = "VALID";
        }
        else if($this->file["size"] < $target_image_size)
        {
            $r = "INVALID_FILE_SIZE";
        }
        else if(in_array($this->getFileExt(), array("gif", "jpeg", "jpg", "png")))
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
        gdlog()->LogInfoEndFUNCTION("setValidImageInfo()");
        return $r;
    }
    
    function isDocumentValid($target_image_size)
    {
        gdlog()->LogInfoStartFUNCTION("isDocumentValid()");
        $r = $this->filerror;
        if($this->filerror == "FILE_NOT_ERROR"
            && (($this->file["type"] == "image/gif") || ($this->file["type"] == "image/jpeg")
            || ($this->file["type"] == "image/jpg") || ($this->file["type"] == "image/pjpeg")
            || ($this->file["type"] == "image/x-png") || ($this->file["type"] == "image/png"))
            && $this->file["size"] < $target_image_size
            && in_array($this->getFileExt(), array("gif", "jpeg", "jpg", "png")))
        {
            $r = "VALID";
        }
        else if($this->file["size"] < $target_image_size)
        {
            $r = "INVALID_FILE_SIZE";
        }
        else if(in_array($this->getFileExt(), array("gif", "jpeg", "jpg", "png")))
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
        gdlog()->LogInfoEndFUNCTION("isDocumentValid()");
        return $r;
    }

    function getErrorMessage($errnum)
    {
        $error_types = array(
        1=>'The uploaded file exceeds the upload_max_filesize directive in php.ini.{'. ini_get ( "upload_max_filesize" ) .'}',
        'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.',
        'The uploaded file was only partially uploaded.',
        'No file was uploaded.',
        6=>'Missing a temporary folder.',
        'Failed to write file to disk.',
        'A PHP extension stopped the file upload.'
        );
        
        return $error_types[$errnum];
    }
    
    function setFilefolder($foldername_subdirectory = "")
    {
        gdlog()->LogInfoStartFUNCTION("setFileFolder()");
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
        gdlog()->LogInfo("Folder: " . $ospathroot);
                if (!file_exists($ospathroot))
        {
            mkdir($ospathroot, 0777, true);
        }
        $this->ffolder = $ospathroot;
        gdlog()->LogInfoEndFUNCTION("setFileFolder()");
    }
}
