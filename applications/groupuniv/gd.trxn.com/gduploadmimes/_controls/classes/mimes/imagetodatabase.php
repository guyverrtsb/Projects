<?php gdreqonce("/gd.trxn.com/gduploadmimes/_controls/classes/base/mimesbase.php"); ?>
<?php
/*
* File: image.manipulation.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
* 
*/
class zImagetoDatabase
    extends zMimesBaseObject
{
    /**
     * Register the Mime Record.  This is basic File Information.
     * Also the Table that the Mime exists in
     */
    function registerMimeMeta($mimes_table_name
                            , $appl_table_name
                            , $filename
                            , $filetype
                            , $fileextension
                            , $filesize
                            , $filepath
                            , $filefolder
                            , $tablename
                            , $sitepackage
                            , $sitealias)
    {
        $this->gdlog()->LogInfoStartFUNCTION("registerMimeMeta()");
        $fr;
        
        $this->mimes_table_name = $mimes_table_name;
        $this->appl_table_name = $appl_table_name;
        $this->filepath = $filepath;
        $this->filesize = $filesize;
        
        $sqlstmnt = "INSERT INTO ". $this->mimes_table_name ." SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "filename=:filename, filetype=:filetype, ".
            "fileextension=:fileextension, filesize=:filesize, ".
            "filepath=:filepath, filefolder=:filefolder, ".
            "tablename=:tablename, sitepackage=:sitepackage, sitealias=:sitealias";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("CROSSAPPDATA");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":filename", $filename);
        $dbcontrol->bindParam(":filetype", $filetype);
        $dbcontrol->bindParam(":fileextension", $fileextension);
        $dbcontrol->bindParam(":filesize", $this->filesize);
        $dbcontrol->bindParam(":filepath", $this->filepath);
        $dbcontrol->bindParam(":filefolder", $filefolder);
        $dbcontrol->bindParam(":tablename", $this->tablename);
        $dbcontrol->bindParam(":sitepackage", $sitepackage);
        $dbcontrol->bindParam(":sitealias", $sitealias);
        $dbcontrol->execUpdate();

        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $lid = $dbcontrol->getLastInsertID();
                $this->saveActivityLog("MIME_REGISTERED","Account has been registered".
                    ":lid:".$lid.
                    ":filename:".$filename.":".
                    ":filetype:".$filetype.":".
                    ":fileextension:".$fileextension.":".
                    ":filesize:".$filesize.":".
                    ":filepath:".$filepath.":".
                    ":filefolder:".$filefolder.":".
                    ":tablename:".$tablename.":".
                    ":sitepackage:".$sitepackage.":".
                    ":sitealias:".$sitealias.":");

                $row = $dbcontrol->getRowfromLastId($dbcontrol, "mimes", $lid);
                $this->mimes_uid = $row["uid"];
                $this->gdlog()->LogInfo("registerMime():MIME_REGISTERED");
                $fr = "MIME_REGISTERED";
            }
            else
            {
                $this->gdlog()->LogInfo("registerMime():MIME_NOT_REGISTERED");
                $fr = "MIME_NOT_REGISTERED";
            }
        }
        else
        {
            $this->gdlog()->LogError("registerMime():TRANSACTION_FAIL");
            $fr = "TRANSACTION_FAIL";
        }
        $this->gdlog()->LogInfoEndFUNCTION("registerMimeMeta()");
        return $fr;
    }

    /*
     * Register Image Original BLOB
     */
    function registerMimeBlobOrigImage($filepath, $filesize)
    {
        $this->gdlog()->LogInfoStartFUNCTION("registerMimeBlobOrigImage()");
        $fr;

        $fieldname = $this->getFieldNametoUploadTo($filesize);

        $sqlstmnt = "INSERT INTO ".$this->appl_table_name." SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            $fieldname."=:filedata";
        
        $this->gdlog()->LogInfo("File Path{".$filepath."}");
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB();
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParamBlob(":filedata", file_get_contents($filepath));
        $dbcontrol->execUpdate();

        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $lid = $dbcontrol->getLastInsertID();
                $this->saveActivityLog("MIME_BLOB_ORIGINAL_REGISTERED","Mimes Original Blob has been registered into".
                    ":lid:".$lid.
                    ":filedata:".$fieldname);

                $row = $dbcontrol->getRowfromLastId($dbcontrol, $this->tablename, $lid);
                $this->mimesorig_uid = $row["uid"];
                $this->gdlog()->LogInfo("MIME_BLOB_REGISTERED".
                    ":table_name:".$this->tablename.
                    ":filedata:".$fieldname);
                $fr = "MIME_BLOB_REGISTERED";
            }
            else
            {
                $this->gdlog()->LogInfo("MIME_BLOB_NOT_REGISTERED");
                $fr = "MIME_BLOB_NOT_REGISTERED";
            }
        }
        else
        {
            $this->gdlog()->LogError("TRANSACTION_FAIL");
            $fr = "TRANSACTION_FAIL";
        }
        $this->gdlog()->LogInfoEndFUNCTION("registerMimeBlobOrigImage()");
        return $fr;
    }

    /*
     * Register Image Scaled BLOB
     */
    function registerMimeBlobScaledImage($filepath, $filesize)
    {
        $this->gdlog()->LogInfoStartFUNCTION("registerMimeBlobScaledImage()");
        $fr;

        $fieldname = $this->getFieldNametoUploadTo($filesize);

        $sqlstmnt = "INSERT INTO ".$this->appl_table_name." SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            $fieldname."=:filedata";
        
        $this->gdlog()->LogInfo("File Path{".$filepath."}");
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB();
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParamBlob(":filedata", file_get_contents($filepath));
        $dbcontrol->execUpdate();

        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $lid = $dbcontrol->getLastInsertID();
                $this->saveActivityLog("MIME_BLOB_SCALED_REGISTERED","Mimes Scaled Blob has been registered into".
                    ":lid:".$lid.
                    ":filedata:".$fieldname);

                $row = $dbcontrol->getRowfromLastId($dbcontrol, $this->tablename, $lid);
                $this->mimesscaled_uid = $row["uid"];
                $this->gdlog()->LogInfo("MIME_BLOB_REGISTERED".
                    ":table_name:".$this->tablename.
                    ":filedata:".$fieldname);
                $fr = "MIME_BLOB_REGISTERED";
            }
            else
            {
                $this->gdlog()->LogInfo("MIME_BLOB_NOT_REGISTERED");
                $fr = "MIME_BLOB_NOT_REGISTERED";
            }
        }
        else
        {
            $this->gdlog()->LogError("TRANSACTION_FAIL");
            $fr = "TRANSACTION_FAIL";
        }
        $this->gdlog()->LogInfoEndFUNCTION("registerMimeBlobScaledImage()");
        return $fr;
    }

    /*
     * Register Image Scaled BLOB
     */
    function registerMimeBlobThumbImage($filepath, $filesize)
    {
        $this->gdlog()->LogInfoStartFUNCTION("registerMimeBlobThumbImage()");
        $fr;

        $fieldname = $this->getFieldNametoUploadTo($filesize);

        $sqlstmnt = "INSERT INTO ".$this->appl_table_name." SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            $fieldname."=:filedata";
        
        $this->gdlog()->LogInfo("File Path{".$filepath."}");
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB();
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParamBlob(":filedata", file_get_contents($filepath));
        $dbcontrol->execUpdate();

        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $lid = $dbcontrol->getLastInsertID();
                $this->saveActivityLog("MIME_BLOB_THUMB_REGISTERED","Mimes Thumb Blob has been registered into".
                    ":lid:".$lid.
                    ":filedata:".$fieldname);

                $row = $dbcontrol->getRowfromLastId($dbcontrol, $this->tablename, $lid);
                $this->mimesthumb_uid = $row["uid"];
                $this->gdlog()->LogInfo("MIME_BLOB_REGISTERED".
                    ":table_name:".$this->tablename.
                    ":filedata:".$fieldname);
                $fr = "MIME_BLOB_REGISTERED";
            }
            else
            {
                $this->gdlog()->LogInfo("MIME_BLOB_NOT_REGISTERED");
                $fr = "MIME_BLOB_NOT_REGISTERED";
            }
        }
        else
        {
            $this->gdlog()->LogError("TRANSACTION_FAIL");
            $fr = "TRANSACTION_FAIL";
        }
        $this->gdlog()->LogInfoEndFUNCTION("registerMimeBlobThumbImage()");
        return $fr;
    }

    function getMimesOrigUid()
    {
        return $this->mimesorig_uid;
    }
    
    function getMimesScaledUid()
    {
        return $this->mimesscaled_uid;
    }
    
    function getMimesThumbUid()
    {
        return $this->mimesthumb_uid;
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