<?php gdreqonce("/gd.trxn.com/gduploadmimes/_controls/classes/base/mimesbase.php"); ?>
<?php
/*
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
* 
*/
class zImagefromDatabase
    extends zMimesBaseObject
{
    var $metaRecord = "";
    var $mimeblob = "";
    /**
     * Find the Mime record.
     */
    function findMimeMetaRecord($appl_table
                                , $appl_table_uid
                                , $dbconfigkey = "CROSSAPPDATA")
    {
        $this->gdlog()->LogInfoStartFUNCTION("findMimeMetaRecord()");
        $fr;
        $sqlstmnt = "select * ".
            "from ".$appl_table." ".
            "where uid=:uid";

        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB($dbconfigkey);
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":uid", $appl_table_uid);
        $dbcontrol->execSelect();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->gdlog()->LogInfo("IME_FOUND");
                $this->metaRecord = $dbcontrol->getStatement()->fetch(PDO::FETCH_ASSOC);
                $fr = "MIME_FOUND";
            }
            else
            {
                $this->gdlog()->LogInfo("MIME_NOT_FOUND");
                $fr = "MIME_NOT_FOUND";
            }
        }
        else
        {
            $this->gdlog()->LogError("TRANSACTION_FAIL");
            $fr = "TRANSACTION_FAIL";
        }
        $this->gdlog()->LogInfoEndFUNCTION("findMimeMetaRecord()");
        return $fr;
    }

    /**
     * Get the Size of the Mime.  This is done to get the correct BLOB Field
     */
    function findMimeBlob($appl_table
                        , $appl_table_uid
                        , $appl_table_size
                        , $dbconfigkey = "CROSSAPPDATA")
    {
        $this->gdlog()->LogInfoStartFUNCTION("findMimeBlob()");
        $fr;
        
        $fieldname = $this->getFieldNametoUploadTo($appl_table_size);
        
        $sqlstmnt = "select ".$fieldname." ".
            "from ".$appl_table." ".
            "where uid=:uid";

        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("CROSSAPPDATA");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":uid", $appl_table_uid);
        $dbcontrol->execSelect();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->gdlog()->LogInfo(":MIME_BLOB_FOUND");
                $row = $dbcontrol->getStatement()->fetch(PDO::FETCH_ASSOC);
                $this->mimeblob = $row[$fieldname];
                $fr = "MIME_BLOB_FOUND";
            }
            else
            {
                $this->gdlog()->LogInfo("MIME_BLOB_NOT_FOUND");
                $fr = "MIME_BLOB_NOT_FOUND";
            }
        }
        else
        {
            $this->gdlog()->LogError("TRANSACTION_FAIL");
            $fr = "TRANSACTION_FAIL";
        }
        $this->gdlog()->LogInfoEndFUNCTION("findMimeBlob()");
        return $fr;
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
    
    function getMetaRecord()
    {
        return $this->metaRecord;
    }
    
    function getResult_MimesBlob()
    {
        return $this->mimeblob;
    }
}
?>