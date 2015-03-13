<?php zReqOnce("/_controls/classes/dataobjects/base/merchant.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class DeleteMerchantProfile
    extends MerchantBase
{
    function __construct()
    {
    }
    
    /**
     * Retrieve Record by Uid
     */
    function byUid($uid)
    {
        zLog()->LogInfoStartDATAOBJECTFUNCTION("byUid");
        
        $sqlstmnt = "DELETE FROM merchantprofile ".
            "WHERE uid=:uid";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":uid", $uid);
        $appcon->execSelect();

        $this->resultDeleteRecord($appcon);

        zLog()->LogInfoEndDATAOBJECTFUNCTION("byUid");
    }
}
?>