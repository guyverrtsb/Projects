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
    var $mimes_uid;
    var $mimesappl_uid;
    var $tablename, $filepath, $filesize;
    
    /**
     * Register the Mime Record.  This is basic File Information.
     * Also the Table that the Mime exists in
     */
    function registerMime($filename, $filetype, $fileextension,
        $filesize, $filepath, $filefolder, $tablename, $sitepackage, $sitealias)
    {
        $this->gdlog()->LogInfoStartFUNCTION("registerMime()");
        $fr;
        
        $this->tablename = $tablename;
        $this->filepath = $filepath;
        $this->filesize = $filesize;
        
        $sqlstmnt = "INSERT INTO mimes SET ".
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
        $this->gdlog()->LogInfoEndFUNCTION("registerMime()");
        return $fr;
    }

    function registerMimeBlobImage($width, $height)
    {
        $this->gdlog()->LogInfoStartFUNCTION("registerMimeBlobImage()");
        $fr;

        $fieldname = $this->getFieldNametoUploadTo($this->filesize);

        $sqlstmnt = "INSERT INTO ".$this->tablename." SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "mimes_uid=:mimes_uid, width=:width, height=:height, ".
            $fieldname."=:filedata";
        
        $this->gdlog()->LogInfo("File Path{".$this->filepath."}");
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("CROSSAPPDATA");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":mimes_uid", $this->getMimesUid());
        $dbcontrol->bindParam(":width", $width);
        $dbcontrol->bindParam(":height", $height);
        $dbcontrol->bindParamBlob(":filedata", file_get_contents($this->filepath));
        $dbcontrol->execUpdate();

        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $lid = $dbcontrol->getLastInsertID();
                $this->saveActivityLog("MIME_BLOB_REGISTERED","Mimes Blob has been registered into".
                    ":lid:".$lid.
                    ":table_name:".$this->tablename.
                    ":filedata:".$fieldname.
                    ":mimes_uid:".$this->getMimesUid().":".
                    ":width:".$width.":".
                    ":height:".$height.":".
                    ":filepath:".$this->filepath.":");

                $row = $dbcontrol->getRowfromLastId($dbcontrol, $this->tablename, $lid);
                $this->mimesappl_uid = $row["uid"];
                $this->gdlog()->LogInfo("registerMimeBlobImage():MIME_BLOB_REGISTERED".
                    ":table_name:".$this->tablename.
                    ":filedata:".$fieldname);
                $fr = "MIME_BLOB_REGISTERED";
            }
            else
            {
                $this->gdlog()->LogInfo("registerMimeBlobImage():MIME_BLOB_NOT_REGISTERED");
                $fr = "MIME_BLOB_NOT_REGISTERED";
            }
        }
        else
        {
            $this->gdlog()->LogError("registerMimeBlobImage():TRANSACTION_FAIL");
            $fr = "TRANSACTION_FAIL";
        }
        $this->gdlog()->LogInfoEndFUNCTION("registerMimeBlobImage()");
        return $fr;
    }

    function getMimesUid()
    {
        return $this->mimes_uid;
    }
    
    function getMimesApplUid()
    {
        return $this->mimesappl_uid;
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