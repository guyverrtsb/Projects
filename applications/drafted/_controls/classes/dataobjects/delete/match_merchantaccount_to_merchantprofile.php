<?php zReqOnce("/_controls/classes/dataobjects/base/draftedmatch.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class DeleteMatchMerchantAccountProfile
    extends DraftedMatchBase
{
    function __construct()
    {
    }
    
    /**
     * Retrieve Record by Uid
     */
    function byUid($uid)
    {
        zLog()->LogStart_DataObjectFunction("byUid");
        
        $sqlstmnt = "DELETE FROM match_merchantaccount_to_merchantprofile ".
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