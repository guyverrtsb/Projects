<?php gdreqonce("/gd.trxn.com/upload/_controls/classes/base/mimebase.php"); ?>
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
    function registerMimeBlobDocument($dbconfigkey
                                    , $appl_table_name
                                    , $filesize
                                    , $filepath)
    {
        $this->gdlog()->LogInfoStartFUNCTION("registerMimeBlobDocument()");
        $fr;

        $fieldname = $this->getFieldNametoUploadTo($filesize);

        $sqlstmnt = "INSERT INTO ".$appl_table_name." SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            $fieldname."=:filedata";
        
        $this->gdlog()->LogInfo("File Path{".$filepath."}");
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB($dbconfigkey);
        $dbcontrol->setStatement($sqlstmnt);
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
                    ":filedata:".$fieldname);

                $row = $dbcontrol->getRowfromLastId($dbcontrol, $appl_table_name, $lid);
                $this->setAppl_uid($row["uid"]);
                $this->gdlog()->LogInfo("registerMimeBlobDocument():MIME_BLOB_REGISTERED".
                    ":appl_table_name:".$appl_table_name.
                    ":filedata:".$fieldname);
                $fr = "MIME_BLOB_REGISTERED";
            }
            else
            {
                $this->gdlog()->LogInfo("registerMimeBlobDocument():MIME_BLOB_REGISTERED");
                $fr = "MIME_BLOB_REGISTERED";
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