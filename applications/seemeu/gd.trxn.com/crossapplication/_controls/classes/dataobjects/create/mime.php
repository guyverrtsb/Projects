<?php zReqOnce("/gd.trxn.com/crossapplication/_controls/classes/dataobjects/base/mimebase.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class CreateMime
    extends zMimeBaseObject
{
    function __construct()
    {
    }
    
    function basic($configurations_sdesc_mimetype
                , $servermimetype)
    {
        zLog()->LogStart_DataObjectFunction("basic");
        
        $sqlstmnt = "INSERT INTO mime SET 
            uid=UUID(), createddt=NOW(), changeddt=NOW(),
            configurations_sdesc_mimetype=:configurations_sdesc_mimetype,
            servermimetype=:servermimetype";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("CROSSAPPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":configurations_sdesc_mimetype", $configurations_sdesc_mimetype);
        $appcon->bindParam(":servermimetype", $servermimetype);
        $appcon->execUpdate();
        
        $this->resultCreateRecord($appcon, "mime");
        
        zLog()->LogEnd_DataObjectFunction("basic");
    }
}
?>