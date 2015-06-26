<?php zReqOnce("/_controls/classes/dataobjects/base/universitymatch.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class CreateMatchUsersafetyUseraccounttoUniversityaccounttoUsertype
    extends UniversityMatchBase
{
    function __construct()
    {
    }
    
    function full($usersafety_useraccount_uid,
                $universityaccount_uid,
                $configurations_sdesc_usertype)
    {
        zLog()->LogStart_DataObjectFunction("full");
        
        $sqlstmnt = "INSERT INTO match_usersafety_useraccount_to_universityaccount_to_usertype SET 
            uid=UUID(), createddt=NOW(), changeddt=NOW(),
            usersafety_useraccount_uid=:usersafety_useraccount_uid,
            universityaccount_uid=:universityaccount_uid,
            configurations_sdesc_usertype=:configurations_sdesc_usertype";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":usersafety_useraccount_uid", $usersafety_useraccount_uid);
        $appcon->bindParam(":universityaccount_uid", $universityaccount_uid);
        $appcon->bindParam(":configurations_sdesc_usertype", $configurations_sdesc_usertype);
        $appcon->execUpdate();
        
        $this->resultCreateRecord($appcon, "match_usersafety_useraccount_to_universityaccount_to_usertype");
        
        zLog()->LogEnd_DataObjectFunction("full");
    }
}
?>