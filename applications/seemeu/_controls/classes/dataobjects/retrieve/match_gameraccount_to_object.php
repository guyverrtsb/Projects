<?php zReqOnce("/_controls/classes/dataobjects/base/draftedmatch.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class RetrieveMatchGamerAccounttoObject
    extends DraftedMatchBase
{
    function __construct()
    {
    }
    
    /**
     * Retrieve Record by MerchantaccountUid
     */
    function byGamerAccountUidandObjectUid($gameraccount_uid,
                                        $object_uid)
    {
        zLog()->LogStartDATAOBJECTFUNCTION("byGamerAccountUidandObjectUid");
        
        $sqlstmnt = "SELECT * FROM match_gameraccount_to_object".
            " WHERE gameraccount_uid=:gameraccount_uid".
            " AND object_uid=:object_uid";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":gameraccount_uid", $gameraccount_uid);
        $appcon->bindParam(":object_uid", $object_uid);
        $appcon->execSelect();

        $this->resultRetrieveRecord($appcon);

        zLog()->LogEndDATAOBJECTFUNCTION("byGamerAccountUidandObjectUid");
    }
}
?>