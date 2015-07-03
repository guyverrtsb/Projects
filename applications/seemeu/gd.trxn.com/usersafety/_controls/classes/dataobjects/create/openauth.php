<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/base/openauth.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class CreateOpenauth
    extends OpenauthBase
{
    function __construct()
    {
    }
    
    function basic($openauthkey,
                $expiredt,
                $isvalid,
                $configurations_sdesc_openauthprovider)
    {
        zLog()->LogStart_DataObjectFunction("basic");
        
        $sqlstmnt = "INSERT INTO openauth SET 
            uid=UUID(), createddt=NOW(), changeddt=NOW(),
            openauthkey=:openauthkey,
            expiredt=:expiredt,
            isvalid=:isvalid,
            configurations_sdesc_openauthprovider=:configurations_sdesc_openauthprovider";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":openauthkey", $openauthkey);
        $appcon->bindParam(":expiredt", $expiredt);
        $appcon->bindParam(":isvalid", $isvalid);
        $appcon->bindParam(":configurations_sdesc_openauthprovider", $configurations_sdesc_openauthprovider);
        $appcon->execUpdate();
        
        $this->resultCreateRecord($appcon, "openauth");
        
        zLog()->LogEnd_DataObjectFunction("basic");
    }
}
?>