<?php zReqOnce("/_controls/classes/dataobjects/base/groupmatch.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class CreateMatchUsersafetyUseraccountGroupaccounttoUserrole
    extends GroupMatchBase
{
    function __construct()
    {
    }
    
    function full($usersafety_useraccount_uid,
                $groupaccount_uid,
                $configurations_sdesc_userrole)
    {
        zLog()->LogStart_DataObjectFunction("full");
        
        $sqlstmnt = "INSERT INTO match_usersafety_useraccount_to_groupaccount_to_userrole SET 
            uid=UUID(), createddt=NOW(), changeddt=NOW(),
            usersafety_useraccount_uid=:usersafety_useraccount_uid,
            groupaccount_uid=:groupaccount_uid,
            configurations_sdesc_userrole=:configurations_sdesc_userrole";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":usersafety_useraccount_uid", $usersafety_useraccount_uid);
        $appcon->bindParam(":groupaccount_uid", $groupaccount_uid);
        $appcon->bindParam(":configurations_sdesc_userrole", $configurations_sdesc_userrole);
        $appcon->execUpdate();
        
        $this->resultCreateRecord($appcon, "match_usersafety_useraccount_to_groupaccount_to_userrole");
        
        zLog()->LogEnd_DataObjectFunction("full");
    }
}
?>