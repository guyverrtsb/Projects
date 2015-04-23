<?php zReqOnce("/gd.trxn.com/crossapplication/_controls/classes/dataobjects/base/taskcontrol.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class UpdateTaskControl
    extends TaskControlBase
{
    function __construct()
    {
    }
    
    function deactivateTasklink($uid)
    {
        zLog()->LogInfoStartDATAOBJECTFUNCTION("deactivateTasklink");
        $mr = "NA"; //Method Return;
        
        $sqlstmnt = "UPDATE taskcontrollink SET ".
            "changeddt=NOW(), ".
            "isactive=:isactive ".
            "WHERE uid=:uid";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("CROSSAPPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":uid", $uid);
        $appcon->bindParam(":isactive", "F");
        $appcon->execUpdate();

        $this->resultUpdateRecord($appcon, "taskcontrollink");
        
        zLog()->LogInfoEndDATAOBJECTFUNCTION("deactivateTasklink");
    }
}
?>