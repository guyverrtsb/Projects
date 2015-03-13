<?php zReqOnce("/_controls/classes/dataobjects/base/match.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class RetreiveMatchMerchantAccountProfile
    extends MatchBase
{
    function __construct()
    {
    }
    
    /**
     * Retrieve Record by MerchantaccountUid
     */
    function byMerchantaccountUid($merchantaccount_uid)
    {
        zLog()->LogInfoStartDATAOBJECTFUNCTION("byMerchantaccountUid");
        
        $sqlstmnt = "SELECT * FROM match_merchantaccount_to_merchantprofile ".
            "WHERE merchantaccount_uid=:merchantaccount_uid";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":merchantaccount_uid", $merchantaccount_uid);
        $appcon->execSelect();

        $this->resultRetrieveRecord($appcon);

        zLog()->LogInfoEndDATAOBJECTFUNCTION("byMerchantaccountUid");
    }
}
?>