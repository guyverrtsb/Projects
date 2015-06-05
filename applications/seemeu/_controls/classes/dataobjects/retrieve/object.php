<?php zReqOnce("/_controls/classes/dataobjects/base/object.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class RetrieveObject
    extends ObjectBase
{
    function __construct()
    {
    }
    
    /**
     * Retrieve Record by Email
     */
    function bySdesc($sdesc)
    {
        zLog()->LogStartDATAOBJECTFUNCTION("bySdesc");
        
        $sqlstmnt = "SELECT * FROM object ".
            "WHERE sdesc=:sdesc";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":sdesc", $sdesc);
        $appcon->execSelect();

        $this->resultRetrieveRecord($appcon);

        zLog()->LogEndDATAOBJECTFUNCTION("bySdesc");
    }
    
    /**
     * Retrieve Record by Nickname
     */
    function byUid($uid)
    {
        zLog()->LogStartDATAOBJECTFUNCTION("byUid");
        
        $sqlstmnt = "SELECT * FROM object ".
            "WHERE uid=:uid";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":uid", $uid);
        $appcon->execSelect();

        $this->resultRetrieveRecord($appcon);

        zLog()->LogEndDATAOBJECTFUNCTION("byUid");
    }
}
?>