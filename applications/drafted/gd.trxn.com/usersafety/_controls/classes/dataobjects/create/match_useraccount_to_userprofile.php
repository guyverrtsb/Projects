<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/base/user.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class CreateMatchUserAccounttoUserProfile
    extends UserBase
{
    function __construct()
    {
    }
    
    function full($useraccount_uid,
                $userprofile_uid)
    {
        zLog()->LogInfoStartDATAOBJECTFUNCTION("basic");
        
        $sqlstmnt = "INSERT INTO match_useraccount_to_userprofile SET 
            uid=UUID(), createddt=NOW(), changeddt=NOW(),
            useraccount_uid=:useraccount_uid,
            userprofile_uid=:userprofile_uid";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":useraccount_uid", $useraccount_uid);
        $appcon->bindParam(":userprofile_uid", $userprofile_uid);
        $appcon->execUpdate();
        
        $this->resultCreateRecord($appcon, "match_useraccount_to_userprofile");
        
        zLog()->LogInfoEndDATAOBJECTFUNCTION("basic");
    }
}
?>