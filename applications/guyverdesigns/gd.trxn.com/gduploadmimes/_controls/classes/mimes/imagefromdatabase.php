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
    var $mimes_uid;
    var $mimesappl_uid;
    var $tablename;
    var $width, $height;
    var $sitepackage, $sitealias;
    var $mimeblob;
    /**
     * Find the Mime record.
     */
    function findMimeRecord($uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findMimeRecord()");
        $fr;
        $sqlstmnt = "select * ".
            "from mimes ".
            "where uid=:uid";

        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("CROSSAPPDATA");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":uid", $uid);
        $dbcontrol->execSelect();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->gdlog()->LogInfo("findMimeRecord():MIME_FOUND");
                $row = $dbcontrol->getStatement()->fetch(PDO::FETCH_ASSOC);
                $this->mimes_uid = $row["uid"];
                $this->fname = $row["filename"];
                $this->ftype = $row["filetype"];
                $this->fext = $row["fileextension"];
                $this->tablename = $row["tablename"];
                $this->fsize = $row["filesize"];
                $this->fpath = $row["filepath"];
                $this->ffolder = $row["filefolder"];
                $this->sitepackage = $row["sitepackage"];
                $this->sitealias = $row["sitealias"];
                                
                $fr = "MIME_FOUND";
            }
            else
            {
                $this->gdlog()->LogInfo("findMimeRecord():MIME_NOT_FOUND");
                $fr = "MIME_NOT_FOUND";
            }
        }
        else
        {
            $this->gdlog()->LogError("findMimeRecord():TRANSACTION_FAIL");
            $fr = "TRANSACTION_FAIL";
        }
        $this->gdlog()->LogInfoEndFUNCTION("findMimeRecord()");
        return $fr;
    }
    
    /**
     * Use this method after you call the findMimeRecord
     */
    function findMimeBlobafterMimeSearch()
    {
        return $this->findMimeBlob($this->mimes_uid, $this->tablename);
    }

    /**
     * Get the Size of the Mime.  This is done to get the correct BLOB Field
     */
    function findMimeBlob($mime_uid, $tablename)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findMimeBlob()");
        $fr;
        
        $fieldname = $this->getFieldNametoUploadTo($this->getFileSize());
        
        $sqlstmnt = "select ".$fieldname." ".
            "from ".$tablename." ".
            "where mimes_uid=:mimes_uid";

        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("CROSSAPPDATA");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":mimes_uid", $mime_uid);
        $dbcontrol->execSelect();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->gdlog()->LogInfo("findMimeBlob():MIME_BLOB_FOUND");
                $row = $dbcontrol->getStatement()->fetch(PDO::FETCH_ASSOC);
                $this->mimeblob = $row[$fieldname];
                $fr = "MIME_BLOB_FOUND";
            }
            else
            {
                $this->gdlog()->LogInfo("findMimeBlob():MIME_BLOB_NOT_FOUND");
                $fr = "MIME_BLOB_NOT_FOUND";
            }
        }
        else
        {
            $this->gdlog()->LogError("findMimeBlob():TRANSACTION_FAIL");
            $fr = "TRANSACTION_FAIL";
        }
        $this->gdlog()->LogInfoEndFUNCTION("findMimeBlob()");
        return $fr;
    }
    
    function getResult_MimesBlob()
    {
        return $this->mimeblob;
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
}
?>