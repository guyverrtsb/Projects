<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/base/match_user.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class RetrieveMatchUser
    extends MatchUserBase
{
    function __construct()
    {
    }
    
    /**
     * Retrieve Record by Email
     */
    function byUid($match_user_uid)
    {
        zLog()->LogStart_DataObjectFunction("byUid");
        
        $sqlstmnt = "SELECT 
                lid,
                uid,
                createddt,
                changeddt,
                useraccount_uid,
                userprofile_uid
            FROM match_user 
            WHERE uid=:match_user_uid";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":match_user_uid", $match_user_uid);
        $appcon->execSelect();
        
        $this->resultRetrieveRecord($appcon);
        
        zLog()->LogEnd_DataObjectFunction("byUid");
    }
}
?>