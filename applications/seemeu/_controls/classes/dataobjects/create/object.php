<?php zReqOnce("/_controls/classes/dataobjects/base/object.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class CreateObject
    extends ObjectBase
{
    function __construct()
    {
    }
    
    function full($sdesc,
                $ldesc,
                $nickname,
                $icon,
                $detectionrange,
                $effectiverange,
                $configurations_sdesc_objecttype,
                $configurations_sdesc_paymenttype)
    {
        zLog()->LogStartDATAOBJECTFUNCTION("full");

        $sqlstmnt = "INSERT INTO object SET 
            uid=UUID(), createddt=NOW(), changeddt=NOW(),
            sdesc=:sdesc,
            ldesc=:ldesc,
            nickname=:nickname,
            icon=:icon,
            detectionrange=:detectionrange,
            effectiverange=:effectiverange,
            configurations_sdesc_objecttype=:configurations_sdesc_objecttype,
            configurations_sdesc_paymenttype=:configurations_sdesc_paymenttype";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":sdesc", $sdesc);
        $appcon->bindParam(":ldesc", $ldesc);
        $appcon->bindParam(":nickname", $nickname);
        $appcon->bindParam(":icon", $icon);
        $appcon->bindParam(":detectionrange", $detectionrange);
        $appcon->bindParam(":effectiverange", $effectiverange);
        $appcon->bindParam(":configurations_sdesc_objecttype", $configurations_sdesc_objecttype);
        $appcon->bindParam(":configurations_sdesc_paymenttype", $configurations_sdesc_paymenttype);
        $appcon->execUpdate();
        
        $this->resultCreateRecord($appcon, "object");
        
        zLog()->LogEndDATAOBJECTFUNCTION("full");
    }
}
?>