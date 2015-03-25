<?php zReqOnce("/_controls/classes/dataobjects/base/draftedmatch.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class CreateMatchMerchantAccounttoObject
    extends DraftedMatchBase
{
    function __construct()
    {
    }
    
    function full($merchantaccount_uid,
                $object_uid)
    {
        zLog()->LogInfoStartDATAOBJECTFUNCTION("full");

        $sqlstmnt = "INSERT INTO match_merchantaccount_to_object SET 
            uid=UUID(), createddt=NOW(), changeddt=NOW(),
            merchantaccount_uid=:merchantaccount_uid,
            object_uid=:object_uid";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":merchantaccount_uid", $merchantaccount_uid);
        $appcon->bindParam(":object_uid", $object_uid);
        $appcon->execUpdate();
        
        $this->resultCreateRecord($appcon, "match_merchantaccount_to_object");
        
        zLog()->LogInfoEndDATAOBJECTFUNCTION("full");
    }
}
?>