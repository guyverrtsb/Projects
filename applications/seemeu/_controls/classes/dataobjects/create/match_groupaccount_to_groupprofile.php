<?php zReqOnce("/_controls/classes/dataobjects/base/groupmatch.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class CreateMatchGroupAccountProfile
    extends GroupMatchBase
{
    function __construct()
    {
    }
    
    function full($groupaccount_uid,
                $groupprofile_uid)
    {
        zLog()->LogStart_DataObjectFunction("full");
        
        $sqlstmnt = "INSERT INTO match_groupaccount_to_groupprofile SET 
            uid=UUID(), createddt=NOW(), changeddt=NOW(),
            groupaccount_uid=:groupaccount_uid,
            groupprofile_uid=:groupprofile_uid";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":groupaccount_uid", $groupaccount_uid);
        $appcon->bindParam(":groupprofile_uid", $groupprofile_uid);
        $appcon->execUpdate();
        
        $this->resultCreateRecord($appcon, "match_groupaccount_to_groupprofile");
        
        zLog()->LogEnd_DataObjectFunction("full");
    }
}
?>