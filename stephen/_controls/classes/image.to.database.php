<?php gdinc("/gd.trxn.com/_controls/classes/dbconnection.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
*
*/
class Z_GD_ImageDatabase
{
    var $mime_uid;
    // * Table mimes   
    function setMime($filesize, $filename, $filetype, $fileextension)
    {
        $sqlstmnt = "INSERT INTO mimes SET ".
        "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
        "filesize=:filesize, filename=:filename, filetype=:filetype, fileextension=:fileextension";
        
        $dbcontrol = new Z_GDDBConnection();
        $dbcontrol->setCrossAppConn();
        $dbcontrol->setStatement($sqlstmnt);
        
        $dbcontrol->bindParam(":filesize", $filesize);
        $dbcontrol->bindParam(":filename", $filename);
        $dbcontrol->bindParam(":filetype", $filetype);
        $dbcontrol->bindParam(":fileextension", $fileextension);
        
        $dbcontrol->execUpdate();
        
        if($dbcontrol->getTransactionGood())
            $dbcontrol->saveActivityLog("Image Uploaded. ".$filesize."-".$filename."-".$filetype."-".$fileextension."-");
        
        $lid = $dbcontrol->getLastInsertID();
        
        $dbcontrol->rollbackcommit();
        
        $sqlstmnt = "SELECT `uid` FROM mimes ".
        "WHERE lid=:lid";

        $dbcontrol->setCrossAppConn();
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":lid", $lid);
        $numrows = $dbcontrol->execSelect();
        $row = $dbcontrol->getStatement()->fetch(PDO::FETCH_ASSOC);
        $this->mime_uid = $row["uid"];
    }

    function getMimeUid()
    {
        return $this->mime_uid;
    }
}
?>
    