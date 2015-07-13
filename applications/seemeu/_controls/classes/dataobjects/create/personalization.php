<?php zReqOnce("/_controls/classes/dataobjects/base/personalization.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class CreatePersonalization
    extends PersonalizationBase
{
    function __construct()
    {
    }
    
    function basic($match_entity_uid,
                $match_usersafety_user_uid)
    {
        zLog()->LogStart_DataObjectFunction("basic");
        
        $sqlstmnt = "INSERT INTO personalization SET 
            uid=UUID(), createddt=NOW(), changeddt=NOW(),
            university_active_match_entity_uid=:match_entity_uid,
            match_usersafety_user_uid=:match_usersafety_user_uid";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":match_entity_uid", $match_entity_uid);
        $appcon->bindParam(":match_usersafety_user_uid", $match_usersafety_user_uid);
        $appcon->execUpdate();
        
        $this->resultCreateRecord($appcon, "personalization");
        
        zLog()->LogEnd_DataObjectFunction("basic");
    }
}
?>