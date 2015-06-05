<?php zReqOnce("/_controls/classes/dataobjects/base/object.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class DeleteObject
    extends ObjectBase
{
    function __construct()
    {
    }
    
    function bySdesc($sdesc)
    {
        zLog()->LogStartDATAOBJECTFUNCTION("bySdesc");
        
        $sqlstmnt = "DELETE FROM object ".
            "WHERE sdesc=:sdesc";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":sdesc", $sdesc);
        $appcon->execSelect();

        $this->resultDeleteRecord($appcon);

        zLog()->LogEndDATAOBJECTFUNCTION("bySdesc");
    }
}
?>