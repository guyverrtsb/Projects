<?php zReqOnce("/_controls/classes/dataobjects/base/merchant.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class RetrieveMerchantAccount
    extends MerchantBase
{
    function __construct()
    {
    }
    
    /**
     * Retrieve Record by Email
     */
    function bySdesc($sdesc)
    {
        zLog()->LogStart_DataObjectFunction("bySdescCompanyame");
        
        $sqlstmnt = "SELECT * FROM merchantaccount ".
            "WHERE sdesc=:sdesc";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":sdesc", $this->createSdescToupper($sdesc));
        $appcon->execSelect();

        $this->resultRetrieveRecord($appcon);

        zLog()->LogEnd_DataObjectFunction("bySdescCompanyame");
    }
    
    /**
     * Retrieve Record by Uid
     */
    function byUid($uid)
    {
        zLog()->LogStart_DataObjectFunction("byUid");
        
        $sqlstmnt = "SELECT * FROM merchantaccount ".
            "WHERE uid=:uid";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":uid", $uid);
        $appcon->execSelect();

        $this->resultRetrieveRecord($appcon);

        zLog()->LogEnd_DataObjectFunction("byUid");
    }
}
?>