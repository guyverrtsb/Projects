<?php zReqOnce("/_controls/classes/dataobjects/base/match.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class CreateMatchUserAccounttoGamerAccountProfile
    extends MatchBase
{
    function __construct()
    {
    }
    
    function full($useraccount_uid,
                $gameraccount_uid,
                $gamerprofile_uid)
    {
        zLog()->LogInfoStartDATAOBJECTFUNCTION("full");

        $sqlstmnt = "INSERT INTO match_useraccount_to_gameraccount_to_gamerprofile SET 
            uid=UUID(), createddt=NOW(), changeddt=NOW(),
            useraccount_uid=:useraccount_uid,
            gameraccount_uid=:gameraccount_uid,
            gamerprofile_uid=:gamerprofile_uid";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":useraccount_uid", $useraccount_uid);
        $appcon->bindParam(":gameraccount_uid", $gameraccount_uid);
        $appcon->bindParam(":gamerprofile_uid", $gamerprofile_uid);
        $appcon->execUpdate();
        
        $this->resultCreateRecord($appcon, "match_useraccount_to_gameraccount_to_gamerprofile");
        
        zLog()->LogInfoEndDATAOBJECTFUNCTION("full");
    }
}
?>