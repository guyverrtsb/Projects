<?php gdreqonce("/gd.trxn.com/_controls/classes/base/baseobject.php"); ?>
<?php
class zMimesBaseObject
    extends zBaseObject
{
    var $ffolder, $fpath, $fname, $fext, $fsize, $ftype;

    function getFileFolder()
    {
        return $this->ffolder;
    }    
    function getFilePath()
    {
        return $this->fpath;
    }
    function getFileName()
    {
        return $this->fname;
    }
    function getFileExt()
    {
        return $this->fext;
    }
    function getFileSize()
    {
        return $this->fsize;
    }
    function getFileType()
    {
        return $this->ftype;
    }
    
    function setMimeData()
    {
        $this->fsize = filesize($this->getFilePath());
        $p = explode("/", $this->fpath);
        $p = explode(".",$p[count($p)-1]);
        $this->fext = $p[count($p)-1];
    }
    
    function logMimeData()
    {
        $this->gdlog()->LogInfo("Path{".$this->getFilePath()."}");
        $this->gdlog()->LogInfo("Folder{".$this->getFileFolder()."}");
        $this->gdlog()->LogInfo("Name{".$this->getFileName()."}");
        $this->gdlog()->LogInfo("Extension{".$this->getFileExt()."}");
        $this->gdlog()->LogInfo("Size{".$this->getFileSize()."}");
    }
}
?>