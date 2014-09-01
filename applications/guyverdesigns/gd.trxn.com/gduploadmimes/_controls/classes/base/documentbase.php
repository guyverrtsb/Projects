<?php gdreqonce("/gd.trxn.com/gduploadmimes/_controls/classes/base/mimebase.php"); ?>
<?php
class zDocumentBaseObject
    extends zMimeBaseObject
{
    var $meta_table_name = "mimes_meta_standard";
    var $appl_table_name = "mimes_appl_standard_document";
    var $os_path;
    
    function setMeta_table_name($meta_table_name)
    {
        $this->meta_table_name = $meta_table_name;
    }
    
    function getMeta_table_name()
    {
        return $this->meta_table_name;
    }
        
    function setAppl_table_name($appl_table_name)
    {
        $this->appl_table_name = $appl_table_name;
    }
    
    function getAppl_table_name()
    {
        return $this->appl_table_name;
    }
        
    function setOsPath($os_path)
    {
        $this->os_path = $os_path;
    }
    
    function getOsPath()
    {
        return $this->os_path;
    }
}
?>