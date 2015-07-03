<?php zReqOnce("/_controls/classes/dataobjects/base/entity.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class RetrieveUniversityAccount
    extends EntityBase
{
    function __construct()
    {
    }
    
    function byUid($uid)
    {
        zLog()->LogStart_DataObjectFunction("byUid");
        
        $sqlstmnt = "SELECT * FROM entityaccount WHERE uid=:uid";
        
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