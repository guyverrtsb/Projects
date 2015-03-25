<?php zReqOnce("/_controls/classes/dataobjects/base/draftedmatch.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class RetrieveMatchUserAccounttoGamerAccountProfile
    extends DraftedMatchBase
{
    function __construct()
    {
    }
    
    /**
     * Retrieve Record by MerchantaccountUid
     */
    function byUseraccountUid($useraccount_uid)
    {
        zLog()->LogInfoStartDATAOBJECTFUNCTION("byUseraccountUid");
        
        $sqlstmnt = "SELECT * FROM match_useraccount_to_gameraccount_to_gamerprofile ".
            "WHERE useraccount_uid=:useraccount_uid";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":useraccount_uid", $useraccount_uid);
        $appcon->execSelect();

        $this->resultRetrieveRecord($appcon);

        zLog()->LogInfoEndDATAOBJECTFUNCTION("byUseraccountUid");
    }
}
?>