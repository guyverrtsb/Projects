<?php zReqOnce("/_controls/classes/dataobjects/base/merchant.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class CreateMerchantAccount
    extends MerchantBase
{
    function __construct()
    {
    }
    
    function full($sdesc,
                $companyname)
    {
        zLog()->LogInfoStartDATAOBJECTFUNCTION("full");

        $sqlstmnt = "INSERT INTO merchantaccount SET 
            uid=UUID(), createddt=NOW(), changeddt=NOW(),
            sdesc=:sdesc,
            companyname=:companyname";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":sdesc", $this->createSdesc($sdesc));
        $appcon->bindParam(":companyname", $companyname);
        $appcon->execUpdate();
        
        $this->resultCreateRecord($appcon, "merchantaccount");
        
        zLog()->LogInfoEndDATAOBJECTFUNCTION("full");
    }
    
    function byCompanyname($companyname)
    {
        zLog()->LogInfoStartDATAOBJECTFUNCTION("full");

        $sqlstmnt = "INSERT INTO merchantaccount SET 
            uid=UUID(), createddt=NOW(), changeddt=NOW(),
            sdesc=:sdesc,
            companyname=:companyname";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":sdesc", $this->createSdesc($companyname));
        $appcon->bindParam(":companyname", $companyname);
        $appcon->execUpdate();
        
        $this->resultCreateRecord($appcon, "merchantaccount");
        
        zLog()->LogInfoEndDATAOBJECTFUNCTION("full");
    }
}
?>