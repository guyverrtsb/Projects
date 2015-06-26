<?php zReqOnce("/_controls/classes/dataobjects/base/gamer.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class UpdateGamerAccount
    extends GamerBase
{
    function __construct()
    {
    }
    
    function updateActivatebyUid($uid)
    {
        zLog()->LogStart_DataObjectFunction("updateActivatebyUid");
        
        $sqlstmnt = "UPDATE gameraccount SET ".
            "changeddt=NOW(), ".
            "isactive=:isactive ".
            "WHERE uid=:uid";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":uid", $uid);
        $appcon->bindParam(":isactive", "T");
        $appcon->execUpdate();

        $this->resultUpdateRecord($appcon, "gameraccount");
        
        zLog()->LogEnd_DataObjectFunction("updateActivatebyUid");
    }
    
    function updateActivatebyGamertag($gamertag)
    {
        zLog()->LogStart_DataObjectFunction("updateActivatebyGamertag");
        
        $sqlstmnt = "UPDATE gameraccount SET ".
            "changeddt=NOW(), ".
            "isactive=:isactive ".
            "WHERE gamertag=:gamertag";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":gamertag", $gamertag);
        $appcon->bindParam(":isactive", "T");
        $appcon->execUpdate();

        $this->resultUpdateRecord($appcon, "gameraccount");
        
        zLog()->LogEnd_DataObjectFunction("updateActivatebyGamertag");
    }
    
    function updateDeactivatebyUid($uid)
    {
        zLog()->LogStart_DataObjectFunction("updateDeactivatebyUid");
        
        $sqlstmnt = "UPDATE gameraccount SET ".
            "changeddt=NOW(), ".
            "isactive=:isactive ".
            "WHERE uid=:uid";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":uid", $uid);
        $appcon->bindParam(":isactive", "F");
        $appcon->execUpdate();

        $this->resultUpdateRecord($appcon, "gameraccount");
        
        zLog()->LogEnd_DataObjectFunction("updateDeactivatebyUid");
    }
    
    function updateDeactivatebyGamertag($gamertag)
    {
        zLog()->LogStart_DataObjectFunction("updateDeactivatebyGamertag");
        
        $sqlstmnt = "UPDATE gameraccount SET ".
            "changeddt=NOW(), ".
            "isactive=:isactive ".
            "WHERE gamertag=:gamertag";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":gamertag", $gamertag);
        $appcon->bindParam(":isactive", "F");
        $appcon->execUpdate();

        $this->resultUpdateRecord($appcon, "gameraccount");
        
        zLog()->LogEnd_DataObjectFunction("updateDeactivatebyGamertag");
    }
}
?>