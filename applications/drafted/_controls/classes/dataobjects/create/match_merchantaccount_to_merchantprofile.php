<?php zReqOnce("/_controls/classes/dataobjects/base/draftedmatch.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class CreateMatchMerchantAccountProfile
    extends DraftedMatchBase
{
    function __construct()
    {
    }
    
    function full($merchantaccount_uid,
                $merchantprofile_uid)
    {
        zLog()->LogStart_DataObjectFunction("full");
        
        $sqlstmnt = "INSERT INTO match_merchantaccount_to_merchantprofile SET 
            uid=UUID(), createddt=NOW(), changeddt=NOW(),
            merchantaccount_uid=:merchantaccount_uid,
            merchantprofile_uid=:merchantprofile_uid";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":merchantaccount_uid", $merchantaccount_uid);
        $appcon->bindParam(":merchantprofile_uid", $merchantprofile_uid);
        $appcon->execUpdate();
        
        $this->resultCreateRecord($appcon, "match_merchantaccount_to_merchantprofile");
        
        zLog()->LogEnd_DataObjectFunction("full");
    }
}
?>