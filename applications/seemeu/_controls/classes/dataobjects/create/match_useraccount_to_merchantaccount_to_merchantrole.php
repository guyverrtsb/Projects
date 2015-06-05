<?php zReqOnce("/_controls/classes/dataobjects/base/draftedmatch.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class CreateMatchUsertoMerchanttoRole
    extends DraftedMatchBase
{
    function __construct()
    {
    }
    
    function full($useraccount_uid,
                $merchantaccount_uid,
                $configurations_sdesc_merchantrole)
    {
        zLog()->LogStartDATAOBJECTFUNCTION("full");
        
        $sqlstmnt = "INSERT INTO match_useraccount_to_merchantaccount_to_merchantrole SET 
            uid=UUID(), createddt=NOW(), changeddt=NOW(),
            useraccount_uid=:useraccount_uid,
            merchantaccount_uid=:merchantaccount_uid,
            configurations_sdesc_merchantrole=:configurations_sdesc_merchantrole";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":useraccount_uid", $useraccount_uid);
        $appcon->bindParam(":merchantaccount_uid", $merchantaccount_uid);
        $appcon->bindParam(":configurations_sdesc_merchantrole", $configurations_sdesc_merchantrole);
        $appcon->execUpdate();
        
        $this->resultCreateRecord($appcon, "match_useraccount_to_merchantaccount_to_merchantrole");
        
        zLog()->LogEndDATAOBJECTFUNCTION("full");
    }
}
?>