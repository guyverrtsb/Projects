<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/base/usermatch.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class RetrieveMatchUserAccounttoUserProfile
    extends UserMatchBase
{
    function __construct()
    {
    }
    
    function basic($useraccount_uid)
    {
        zLog()->LogStartDATAOBJECTFUNCTION("basic");
        
        $sqlstmnt = "SELECT * FROM match_useraccount_to_userprofile ".
            "WHERE useraccount_uid=:useraccount_uid";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":useraccount_uid", $useraccount_uid);
        $appcon->execUpdate();
        
        $this->resultCreateRecord($appcon, "match_useraccount_to_userprofile");
        
        zLog()->LogEndDATAOBJECTFUNCTION("basic");
    }
}
?>