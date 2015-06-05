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
        zLog()->LogStartFUNCTION("updateActivatebyUid");
        
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
        
        zLog()->LogEndFUNCTION("updateActivatebyUid");
    }
    
    function updateActivatebyGamertag($gamertag)
    {
        zLog()->LogStartFUNCTION("updateActivatebyGamertag");
        
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
        
        zLog()->LogEndFUNCTION("updateActivatebyGamertag");
    }
    
    function updateDeactivatebyUid($uid)
    {
        zLog()->LogStartFUNCTION("updateDeactivatebyUid");
        
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
        
        zLog()->LogEndFUNCTION("updateDeactivatebyUid");
    }
    
    function updateDeactivatebyGamertag($gamertag)
    {
        zLog()->LogStartFUNCTION("updateDeactivatebyGamertag");
        
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
        
        zLog()->LogEndFUNCTION("updateDeactivatebyGamertag");
    }
}
?>