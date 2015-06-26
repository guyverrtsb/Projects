<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php
class zMimeBaseObject
    extends AppSysBaseObject
{
    var $meta_uid;
    var $appl_uid;
    var $osfolder;
    var $urlfolder;
    var $mimepath;
    // Folder Location on Upload Server
    function setUrlfolder()
    {
        zLog()->LogStart_DataObjectFunction("setUrlfolder()");
        $sitealias = explode(".", $_SESSION["GUYVERDESIGNS_SITE_ALIAS"]);
        
        if(strtoupper($sitealias[0]) == "WWW")
            $applpath = str_replace("www", "mimes", $_SESSION["GUYVERDESIGNS_SITE_ALIAS"])."/";
        else
            $applpath = str_replace($sitealias[0], $sitealias[0]."mimes", $_SESSION["GUYVERDESIGNS_SITE_ALIAS"])."/";

        zLog()->LogDebug($applpath);
        
        if($this->mimepath == "")
        {
            $this->mimepath = date("Y")."_".date("m")."_".date("d")."/".date("H")."_".date("i")."_".date("s")."/";
        }
        $applpath = $applpath.$this->mimepath;
        zLog()->LogDebug($applpath);
        
        $https = !empty($_SERVER['HTTPS']) && strcasecmp($_SERVER['HTTPS'], 'on') === 0 ||
            !empty($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
                strcasecmp($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') === 0;
        $applpath = ($https ? 'https://' : 'http://') . $applpath;
        zLog()->LogDebug($applpath);
        
        $this->urlfolder = $applpath;
        zLog()->LogEnd_DataObjectFunction("setUrlfolder()");
    }
    
    function getUrlfolder()
    {
        return $this->urlfolder;
    }
    
    function setOSfolder($foldername_subdirectory = "")
    {
        zLog()->LogStart_DataObjectFunction("setOSfolder()");
        $ospathroot = "";
        if($_SESSION['GUYVERDESIGNS_SERVER_ENVIRONMENT'] == "DEV")
            $ospathroot = $_SERVER["SUBDOMAIN_DOCUMENT_ROOT"]."/../../mimes/root/";
        else if($_SESSION['GUYVERDESIGNS_SERVER_ENVIRONMENT'] == "QLT")
            $ospathroot = $_SERVER["SUBDOMAIN_DOCUMENT_ROOT"]."/../../mimes/root/";
        else if($_SESSION['GUYVERDESIGNS_SERVER_ENVIRONMENT'] == "PRD")
            $ospathroot = $_SERVER["SUBDOMAIN_DOCUMENT_ROOT"]."/../../mimes/root/";
        else if($_SESSION['GUYVERDESIGNS_SERVER_ENVIRONMENT'] == "LCL")
            $ospathroot = $_SERVER["CONTEXT_DOCUMENT_ROOT"]."/../../mimes/root/";
        zLog()->LogDebug($ospathroot);
        
        //if($_SESSION['GUYVERDESIGNS_SERVER_ENVIRONMENT'] == "LCL")
        //    $ospathroot = $ospathroot.$_SESSION["GUYVERDESIGNS_SITE_ALIAS"]."/";
        zLog()->LogDebug($ospathroot);
            
        if(trim($foldername_subdirectory) != "")
            $ospathroot = $ospathroot.$foldername_subdirectory."/";
        zLog()->LogDebug($ospathroot);
                    
        if($this->mimepath == "")
        {
            $this->mimepath = date("Y")."_".date("m")."_".date("d")."/".date("H")."_".date("i")."_".date("s")."/";
        }
        $ospathroot = $ospathroot.$this->mimepath;
        zLog()->LogDebug($ospathroot);
        
        if (!file_exists($ospathroot))
        {
            mkdir($ospathroot, 0777, true);
        }
        zLog()->LogDebug($ospathroot);

        $this->osfolder = $ospathroot;
        
        zLog()->LogEnd_DataObjectFunction("setOSfolder()");
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
    
    function setZProperties($file)
    {
        zLog()->LogStart_DataObjectFunction("setZProperties()");
        $file->gdOSFilename = $file->name;
        $file->gdOSFolder = $this->getOSfolder();
        $file->gdOSPath = $this->getOSfolder() . $file->name;
        $file->gdUrlfolder = $this->getUrlfolder();
        $file->gdUrlPath = $file->url;
        
        $filenameparts = explode(".", $file->gdOSFilename);
        $file->gdOSFileext = strtoupper($filenameparts[(sizeof($filenameparts) - 1)]);
        
        zLog()->LogEnd_DataObjectFunction("setZProperties()");
    }
    
    function getUid() { return $this->getResult_RecordField("uid"); }
    
    function getConfigSdescMimetype() { return $this->getResult_RecordField("configurations_sdesc_mimetype"); }
}
?>