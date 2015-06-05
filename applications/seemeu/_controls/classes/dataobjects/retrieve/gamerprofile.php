<?php zReqOnce("/_controls/classes/dataobjects/base/gamer.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class RetrieveGamerProfile
    extends GamerBase
{
    function __construct()
    {
    }
    
    /**
     * Retrieve Record by Nickname
     */
    function byUid($uid)
    {
        zLog()->LogStartDATAOBJECTFUNCTION("byUid");
        
        $sqlstmnt = "SELECT * FROM gamerprofile ".
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