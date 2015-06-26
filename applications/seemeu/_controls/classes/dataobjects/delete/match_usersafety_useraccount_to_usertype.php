<?php zReqOnce("/_controls/classes/dataobjects/base/groupmatch.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class DeleteMatchUsersafetyUseraccounttoUsertype
    extends GroupMatchBase
{
    function __construct()
    {
    }
    
    /**
     * Retrieve Record by uid
     */
    function byUid($uid)
    {
        zLog()->LogStart_DataObjectFunction("byUid");
        
        $sqlstmnt = "DELETE FROM match_usersafety_useraccount_to_usertype ".
            "WHERE uid=:uid";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":uid", $uid);
        $appcon->execSelect();

        $this->resultDeleteRecord($appcon);

        zLog()->LogEnd_DataObjectFunction("byUid");
    }
}
?>