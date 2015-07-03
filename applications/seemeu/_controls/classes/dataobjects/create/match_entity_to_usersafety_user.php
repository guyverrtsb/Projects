<?php zReqOnce("/_controls/classes/dataobjects/base/match_entity_to_usersafety_user.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class CreateMatchEntitytoUsersafetyUser
    extends MatchEntitytoUsersafetyUserBase
{
    function __construct()
    {
    }
    
    function basic($match_entity_uid,
                $match_usersafety_user_uid,
                $configurations_sdesc_usertype,
                $configurations_sdesc_entityrole)
    {
        zLog()->LogStart_DataObjectFunction("basic");
        
        $sqlstmnt = "INSERT INTO match_entity_to_usersafety_user SET 
            uid=UUID(), createddt=NOW(), changeddt=NOW(),
            match_entity_uid=:match_entity_uid,
            match_usersafety_user_uid=:match_usersafety_user_uid,
            configurations_sdesc_usertype=:configurations_sdesc_usertype,
            configurations_sdesc_entityrole=:configurations_sdesc_entityrole";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":match_entity_uid", $match_entity_uid);
        $appcon->bindParam(":match_usersafety_user_uid", $match_usersafety_user_uid);
        $appcon->bindParam(":configurations_sdesc_usertype", $configurations_sdesc_usertype);
        $appcon->bindParam(":configurations_sdesc_entityrole", $configurations_sdesc_entityrole);
        $appcon->execUpdate();
        
        $this->resultCreateRecord($appcon, "match_entity_to_usersafety_user");
        
        zLog()->LogEnd_DataObjectFunction("basic");
    }
}
?>