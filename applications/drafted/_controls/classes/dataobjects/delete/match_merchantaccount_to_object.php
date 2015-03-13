<?php zReqOnce("/_controls/classes/dataobjects/base/match.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class DeleteMatchMerchantAccounttoObject
    extends MatchBase
{
    function __construct()
    {
    }
    
    function byMerchantaccountUid($merchantaccount_uid)
    {
        zLog()->LogInfoStartDATAOBJECTFUNCTION("byMerchantaccountUid");
        
        $sqlstmnt = "DELETE FROM match_merchantaccount_to_object
            WHERE merchantaccount_uid=:merchantaccount_uid";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":merchantaccount_uid", $merchantaccount_uid);
        $appcon->execUpdate();
        
        $this->resultDeleteRecord($appcon);
        
        zLog()->LogInfoEndDATAOBJECTFUNCTION("byMerchantaccountUid");
    }
}
?>