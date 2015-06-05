<?php zReqOnce("/_controls/classes/dataobjects/base/battle.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class CreateBattleMap
    extends BattleBase
{
    function __construct()
    {
    }
    
    function full($connectionkey,
                $tablekey,
                $groupaccount_uid)
    {
        zLog()->LogStartDATAOBJECTFUNCTION("full");
        
        $sqlstmnt = "INSERT INTO battlestage SET 
            uid=UUID(), createddt=NOW(), changeddt=NOW(),
            connectionkey=:connectionkey,
            tablekey=:tablekey,
            groupaccount_uid=:groupaccount_uid";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":connectionkey", $connectionkey);
        $appcon->bindParam(":tablekey", $tablekey);
        $appcon->bindParam(":groupaccount_uid", $groupaccount_uid);
        $appcon->execUpdate();
        
        $this->resultCreateRecord($appcon, "battlestage");
        
        zLog()->LogEndDATAOBJECTFUNCTION("full");
    }
}
?>