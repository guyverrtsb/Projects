<?php zReqOnce("/_controls/classes/dataobjects/base/match.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class CreateMatchGamertoGrouptoObject
    extends MatchBase
{
    function __construct()
    {
    }
    
    function full($gameraccount_uid,
                $groupaccount_uid,
                $object_uid)
    {
        zLog()->LogInfoStartDATAOBJECTFUNCTION("full");
        
        $sqlstmnt = "INSERT INTO match_gameraccount_to_groupaccount_to_object SET 
            uid=UUID(), createddt=NOW(), changeddt=NOW(),
            gameraccount_uid=:gameraccount_uid,
            groupaccount_uid=:groupaccount_uid,
            object_uid=:object_uid";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":gameraccount_uid", $gameraccount_uid);
        $appcon->bindParam(":groupaccount_uid", $groupaccount_uid);
        $appcon->bindParam(":object_uid", $object_uid);
        $appcon->execUpdate();
        
        $this->resultCreateRecord($appcon, "match_gameraccount_to_groupaccount_to_object");
        
        zLog()->LogInfoEndDATAOBJECTFUNCTION("full");
    }
}
?>