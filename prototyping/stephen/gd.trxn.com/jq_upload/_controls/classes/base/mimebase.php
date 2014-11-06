<?php gdreqonce("/gd.trxn.com/_controls/classes/base/baseobject.php"); ?>
<?php
class zMimeBaseObject
    extends zBaseObject
{
    var $meta_uid;
    var $appl_uid;
    var $osfolder;
    var $urlfolder;
    
    var $path, $name, $ext, $size, $type, $namebase, $mimepath = "";
    // Folder Location on Upload Server
    function setUrlfolder()
    {
        gdlog()->LogInfoStartFUNCTION("setUrlApplpath()");
        
        $applpath = str_replace("www", "mimes", $_SESSION["GUYVERDESIGNS_SITE_ALIAS"]) . "/" . $_SESSION["GUYVERDESIGNS_SITE_ALIAS"]."/";
        gdlog()->LogInfo($applpath);
        
        if($this->mimepath == "")
            $this->mimepath = date("Y")."_".date("m")."_".date("d")."/".date("H")."_".date("i")."_".date("s")."/";
        
        $applpath = $applpath.$this->mimepath;
        gdlog()->LogInfo($applpath);
        
        $https = !empty($_SERVER['HTTPS']) && strcasecmp($_SERVER['HTTPS'], 'on') === 0 ||
            !empty($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
                strcasecmp($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') === 0;
        $applpath = ($https ? 'https://' : 'http://') . $applpath;
        gdlog()->LogInfo($applpath);
        
        $this->urlfolder = $applpath;
        gdlog()->LogInfoEndFUNCTION("setUrlApplpath()");
    }
    
    function getUrlfolder()
    {
        return $this->urlfolder;
    }
    
    function setOSfolder($foldername_subdirectory = "")
    {
        gdlog()->LogInfoStartFUNCTION("setOSfolder()");
        $ospathroot = "";
        if($_SESSION['GUYVERDESIGNS_SERVER_ENVIRONMENT'] == "LCL")
            $ospathroot = $_SERVER["CONTEXT_DOCUMENT_ROOT"]."/../mimes/";
        else
            $ospathroot = $_SERVER["SUBDOMAIN_DOCUMENT_ROOT"]."/../../../../zzzproduction/websites/mimes/";
        gdlog()->LogInfo($ospathroot);
        
        $ospathroot = $ospathroot
            /*.$_SESSION["GUYVERDESIGNS_SITE"]."/"*/
            .$_SESSION["GUYVERDESIGNS_SITE_ALIAS"]."/";
        gdlog()->LogInfo($ospathroot);
            
        if(trim($foldername_subdirectory) != "")
            $ospathroot = $ospathroot.$foldername_subdirectory."/";
        gdlog()->LogInfo($ospathroot);
                    
        if($this->mimepath == "")
            $this->mimepath = date("Y")."_".date("m")."_".date("d")."/".date("H")."_".date("i")."_".date("s")."/";
        
        $ospathroot = $ospathroot.$this->mimepath;
        gdlog()->LogInfo($ospathroot);
        
        if (!file_exists($ospathroot))
        {
            mkdir($ospathroot, 0777, true);
        }
        gdlog()->LogInfo($ospathroot);

        $this->osfolder = $ospathroot;
        
        gdlog()->LogInfoEndFUNCTION("setOSfolder()");
    }
    
    function getOSfolder()
    {
        return $this->osfolder;
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
    
    function setGDProperties($file)
    {
        gdlog()->LogInfoStartFUNCTION("setGDProperties()");
        $file->gdOSfileame = $file->name;
        $file->gdOSFolder = $this->getOSfolder();
        $file->gdOSPath = $this->getOSfolder() . $file->name;
        $file->gdUrlfolder = $this->getUrlfolder();
        $file->gdUrlPath = $file->url;
        gdlog()->LogInfoEndFUNCTION("setGDProperties()");
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