<?php gdreqonce("/gd.trxn.com/gduploadmimes/_controls/classes/base/mimebase.php"); ?>
<?php
/*
* File: image.manipulation.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
* 
*/
class zDocumenttoDatabase
    extends zMimeBaseObject
{    

    /*
     * Register Document BLOB
     */
    function registerMimeBlobDocument($appl_table_name
                                    , $meta_uid
                                    , $filename
                                    , $filetype
                                    , $fileextension
                                    , $filesize
                                    , $filepath
                                    , $filefolder
                                    , $basename)
    {
        $this->gdlog()->LogInfoStartFUNCTION("registerMimeBlobDocument()");
        $fr;

        $fieldname = $this->getFieldNametoUploadTo($filesize);

        $sqlstmnt = "INSERT INTO ".$appl_table_name." SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "mimes_uid=:mimes_uid, ".
            "filename=:filename, filetype=:filetype, ".
            "fileextension=:fileextension, filesize=:filesize, ".
            "filepath=:filepath, filefolder=:filefolder, basename=:basename, ".
            $fieldname."=:filedata";
        
        $this->gdlog()->LogInfo("File Path{".$filepath."}");
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("CROSSAPPDATA");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":mimes_uid", $meta_uid);
        $dbcontrol->bindParam(":filename", $filename);
        $dbcontrol->bindParam(":filetype", $filetype);
        $dbcontrol->bindParam(":fileextension", $fileextension);
        $dbcontrol->bindParam(":filesize", $filesize);
        $dbcontrol->bindParam(":filepath", $filepath);
        $dbcontrol->bindParam(":filefolder", $filefolder);
        $dbcontrol->bindParam(":basename", $basename);
        $dbcontrol->bindParamBlob(":filedata", file_get_contents($filepath));
        $dbcontrol->execUpdate();

        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $lid = $dbcontrol->getLastInsertID();
                $this->saveActivityLog("DOCUMENT_BLOB_REGISTERED","Mimes Blob has been registered into".
                    ":lid:".$lid.
                    ":appl_table_name:".$appl_table_name.
                    ":mimes_uid:".$meta_uid.":".
                    ":filename:".$filename.":".
                    ":filetype:".$filetype.":".
                    ":fileextension:".$fileextension.":".
                    ":filesize:".$filesize.":".
                    ":filepath:".$filepath.":".
                    ":filefolder:".$filefolder.":".
                    ":basename:".$basename.":".
                    ":filedata:".$fieldname);

                $row = $dbcontrol->getRowfromLastId($dbcontrol, $appl_table_name, $lid);
                $this->setAppl_uid($row["uid"]);
                $this->gdlog()->LogInfo("registerMimeBlobDocument():MIME_BLOB_REGISTERED".
                    ":appl_table_name:".$appl_table_name.
                    ":mimes_uid:".$meta_uid.":".
                    ":filename:".$filename.":".
                    ":filetype:".$filetype.":".
                    ":fileextension:".$fileextension.":".
                    ":filesize:".$filesize.":".
                    ":filepath:".$filepath.":".
                    ":filefolder:".$filefolder.":".
                    ":basename:".$basename.":".
                    ":filedata:".$fieldname);
                $fr = "DOCUMENT_BLOB_REGISTERED";
            }
            else
            {
                $this->gdlog()->LogInfo("registerMimeBlobDocument():DOCUMENT_BLOB_NOT_REGISTERED");
                $fr = "DOCUMENT_BLOB_NOT_REGISTERED";
            }
        }
        else
        {
            $this->gdlog()->LogError("registerMimeBlobDocument():TRANSACTION_FAIL");
            $fr = "TRANSACTION_FAIL";
        }
        $this->gdlog()->LogInfoEndFUNCTION("registerMimeBlobDocument()");
        return $fr;
    }
}
?>