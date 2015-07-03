<?php zReqOnce("/_controls/classes/dataobjects/base/match_group.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class CreateMatchGroup
    extends MatchGroupBase
{
    function __construct()
    {
    }
    
    function basic($groupaccount_uid,
                $groupprofile_uid,
                $match_entity_uid,
                $match_usersafety_user_uid,
                $configurations_sdesc_grouprole)
    {
        zLog()->LogStart_DataObjectFunction("basic");
        
        $sqlstmnt = "INSERT INTO match_group SET 
            uid=UUID(), createddt=NOW(), changeddt=NOW(),
            groupaccount_uid=:groupaccount_uid,
            groupprofile_uid=:groupprofile_uid,
            match_entity_uid=:match_entity_uid,
            match_usersafety_user_uid=:match_usersafety_user_uid,
            configurations_sdesc_grouprole=:configurations_sdesc_grouprole";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":groupaccount_uid", $groupaccount_uid);
        $appcon->bindParam(":groupprofile_uid", $groupprofile_uid);
        $appcon->bindParam(":match_entity_uid", $match_entity_uid);
        $appcon->bindParam(":match_usersafety_user_uid", $match_usersafety_user_uid);
        $appcon->bindParam(":configurations_sdesc_grouprole", $configurations_sdesc_grouprole);
        $appcon->execUpdate();
        
        $this->resultCreateRecord($appcon, "match_group");
        
        zLog()->LogEnd_DataObjectFunction("basic");
    }
}
?>