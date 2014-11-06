<?php gdreqonce("/gd.trxn.com/_controls/classes/base/baseobject.php"); ?>
<?php
class zMimeBaseObject
    extends zBaseObject
{
    var $meta_uid;
    var $appl_uid;
    
    var $ffolder, $fpath, $fname, $fext, $fsize, $ftype, $fnamebase;
    // Folder Location on Upload Server
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
    
    function getFilefolder()
    {
        return $this->ffolder;
    } 
    
    // Full Path to file combination of Folder and filenamebawse and filename
    function getFilepath()
    {
        return $this->fpath;
    }
    // Name of file at upload
    function getFilename()
    {
        return $this->fname;
    }
    
    // Extension of file at upload
    function getFileext()
    {
        return $this->fext;
    }
    // size of file
    function getFilesize()
    {
        return $this->fsize;
    }
    // Type of File not extension
    function getFiletype()
    {
        return strtoupper($this->fext);
    }
    // Applies uniqueness to the filename
    function getFilenamebase()
    {
        return $this->fnamebase;
    }

    function setMeta_uid($meta_uid)
    {
        $this->meta_uid = $meta_uid;
    }
    
    function getMeta_uid()
    {
        return $this->meta_uid;
    }
    
    function setAppl_uid($appl_uid)
    {
        $this->appl_uid = $appl_uid;
    }
    
    function getAppl_uid()
    {
        return $this->appl_uid;
    }
    
    function getFieldNametoUploadTo($file_size)
    {
        if($file_size <= "255")
            return "objecttiny";
        else if($file_size <= "65535")
            return "objectsmall";
        else if($file_size <= "16777215")
            return "objectmedium";
        else if($file_size <= "4294967295")
            return "objectlong";
        return "objectmedium";
    }
    
    function logMimeData()
    {
        $this->gdlog()->LogInfo("Path{".$this->getFilepath()."}");
        $this->gdlog()->LogInfo("Folder{".$this->getFilefolder()."}");
        $this->gdlog()->LogInfo("Name{".$this->getFilename()."}");
        $this->gdlog()->LogInfo("Extension{".$this->getFileext()."}");
        $this->gdlog()->LogInfo("Size{".$this->getFilesize()."}");
        $this->gdlog()->LogInfo("Type{".$this->getFiletype()."}");
        $this->gdlog()->LogInfo("Base{".$this->getFilenamebase()."}");
    }
}
?>