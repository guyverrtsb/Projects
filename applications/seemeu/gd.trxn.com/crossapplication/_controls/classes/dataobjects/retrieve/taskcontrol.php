<?php zReqOnce("/gd.trxn.com/crossapplication/_controls/classes/dataobjects/base/taskcontrol.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class RetrieveTaskControl
    extends TaskControlBase
{
    function __construct()
    {
    }
    
    /**
     * Retrieve Record by Uid 1 Uid 2 Uid 3
     */
    function byUid123($uid1,
                    $uid2,
                    $uid3)
    {
        zLog()->LogStart_DataObjectFunction("byUid123");
        
        $sqlstmnt = "SELECT * 
            FROM taskcontrollink 
            WHERE uid1=:uid1 AND uid2=:uid2 AND uid3=:uid3";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("CROSSAPPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":uid1", $uid1);
        $appcon->bindParam(":uid2", $uid2);
        $appcon->bindParam(":uid3", $uid3);
        $appcon->execSelect();
        
        $this->resultRetrieveRecord($appcon);
        
        zLog()->LogEnd_DataObjectFunction("byUid123");
    }
}
?>