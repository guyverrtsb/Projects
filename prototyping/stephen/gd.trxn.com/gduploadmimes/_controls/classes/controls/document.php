<?php gdreqonce("/gd.trxn.com/gduploadmimes/_controls/classes/base/documentbase.php"); ?>
<?php gdreqonce("/gd.trxn.com/gduploadmimes/_controls/classes/mimes/metatodatabase.php"); ?>
<?php gdreqonce("/gd.trxn.com/gduploadmimes/_controls/classes/mimes/documenttodatabase.php"); ?>
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
class zDocumentUploadControl
    extends zDocumentBaseObject
{
    var $ref_meta_uid = "";
    var $mime_type = "DOCUMENT";
    /*
     * GDUploadImageFile
     */
    function executeControl($uploadmime)
    {
        $return_mimes_data = "";
        gdlog()->LogInfo("LOAD_TO META_DATA");
        $zmtd = new zMetatoDatabase();
        $r = $zmtd->registerMetaData($this->getMeta_table_name(),
                                    $this->getAppl_table_name(),
                                    $_SESSION["GUYVERDESIGNS_SITE"],
                                    $_SESSION["GUYVERDESIGNS_SITE_ALIAS"],
                                    $this->ref_meta_uid,
                                    $this->mime_type);
                                    
        if($r == "META_DATA_REGISTERED")
        {
            $this->setMeta_uid($zmtd->getMeta_uid());
            gdlog()->LogInfo("META_DATA{".$this->getMeta_uid()."}");
            
            $zdtd = new zDocumenttoDatabase();
            $r = $zdtd->registerMimeBlobDocument($this->getAppl_table_name(),
                                                $this->getMeta_uid(),
                                                $uploadmime->getFilename(),
                                                $uploadmime->getFiletype(),
                                                $uploadmime->getFileext(),
                                                $uploadmime->getFilesize(),
                                                $uploadmime->getFilepath(),
                                                $uploadmime->getFilefolder(),
                                                $uploadmime->getFilenamebase());
            if($r == "DOCUMENT_BLOB_REGISTERED")
            {
                $this->setAppl_uid($zdtd->getAppl_uid());
                gdlog()->LogInfo("APPL_BLOB_REGISTERED{".$this->getAppl_uid()."}");
            }
        }
        return $r;
    }

    function setRefmetauid($ref_meta_uid)
    {
        $this->ref_meta_uid = $ref_meta_uid;
    }

    function setmimetype($mime_type)
    {
        $this->mime_type = strtoupper($mime_type);
    }
}
?>