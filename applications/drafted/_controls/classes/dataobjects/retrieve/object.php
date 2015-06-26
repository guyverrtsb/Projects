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
        zLog()->LogStart_DataObjectFunction("bySdesc");
        
        $sqlstmnt = "SELECT * FROM object ".
            "WHERE sdesc=:sdesc";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":sdesc", $sdesc);
        $appcon->execSelect();

        $this->resultRetrieveRecord($appcon);

        zLog()->LogEnd_DataObjectFunction("bySdesc");
    }
    
    /**
     * Retrieve Record by Nickname
     */
    function byUid($uid)
    {
        zLog()->LogStart_DataObjectFunction("byUid");
        
        $sqlstmnt = "SELECT * FROM object ".
            "WHERE uid=:uid";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":uid", $uid);
        $appcon->execSelect();

        $this->resultRetrieveRecord($appcon);

        zLog()->LogEnd_DataObjectFunction("byUid");
    }
}
?>