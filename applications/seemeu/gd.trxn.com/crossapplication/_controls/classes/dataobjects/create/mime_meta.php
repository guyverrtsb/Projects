<?php zReqOnce("/gd.trxn.com/crossapplication/_controls/classes/dataobjects/base/mimebase.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class CreateMimeMeta
    extends zMimeBaseObject
{
    function __construct()
    {
    }
    
    function basic($mime_uid
                , $configurations_sdesc_mimetypeconfig
                , $name
                , $size
                , $osfolder
                , $ospath
                , $osfileext
                , $urlfolder
                , $urlpath
                , $urlfileext)
    {
        zLog()->LogStart_DataObjectFunction("basic");
        
        $sqlstmnt = "INSERT INTO mime_meta SET 
            uid=UUID(), createddt=NOW(), changeddt=NOW(),
            mime_uid=:mime_uid,
            configurations_sdesc_mimetypeconfig=:configurations_sdesc_mimetypeconfig,
            name=:name,
            size=:size,
            osfolder=:osfolder,
            ospath=:ospath,
            osfileext=:osfileext,
            urlfolder=:urlfolder,
            urlpath=:urlpath,
            urlfileext=:urlfileext";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("CROSSAPPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":mime_uid", $mime_uid);
        $appcon->bindParam(":configurations_sdesc_mimetypeconfig", $configurations_sdesc_mimetypeconfig);
        $appcon->bindParam(":name", $name);
        $appcon->bindParam(":size", $size);
        $appcon->bindParam(":osfolder", $osfolder);
        $appcon->bindParam(":ospath", $ospath);
        $appcon->bindParam(":osfileext", $osfileext);
        $appcon->bindParam(":urlfolder", $urlfolder);
        $appcon->bindParam(":urlpath", $urlpath);
        $appcon->bindParam(":urlfileext", $urlfileext);
        $appcon->execUpdate();
        
        $this->resultCreateRecord($appcon, "mime_meta");
        
        zLog()->LogEnd_DataObjectFunction("basic");
    }
}
?>