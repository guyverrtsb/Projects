<?php zReqOnce("/_controls/classes/dataobjects/base/group.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class RetrieveGroupProfile
    extends GroupBase
{
    function __construct()
    {
    }
    
    /**
     * Retrieve Record by Nickname
     */
    function byUid($uid)
    {
        zLog()->LogInfoStartDATAOBJECTFUNCTION("byUid");
        
        $sqlstmnt = "SELECT * FROM groupprofile ".
            "WHERE uid=:uid";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":uid", $uid);
        $appcon->execSelect();

        $this->resultRetrieveRecord($appcon);

        zLog()->LogInfoEndDATAOBJECTFUNCTION("byUid");
    }
}
?>