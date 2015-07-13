<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/base/openauth.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class UpdateUserProfile
    extends OpenauthBase
{
    function __construct()
    {
    }
    
    function updateAllbyUid($openauth_uid,
                            $openauthkey,
                            $expiredt,
                            $isvalid,
                            $configurations_sdesc_openauthprovider)
    {
        zLog()->LogStart_DataObjectFunction("updateAllbyUid");
        
        $sqlstmnt = "UPDATE openauth SET 
            changeddt=NOW(), 
            openauthkey=:openauthkey, 
            expiredt=:expiredt, 
            isvalid=:isvalid,
            configurations_sdesc_openauthprovider=:configurations_sdesc_openauthprovider 
            WHERE openauth_uid=:openauth_uid";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":openauthkey", $openauthkey);
        $appcon->bindParam(":expiredt", $expiredt);
        $appcon->bindParam(":isvalid", $isvalid);
        $appcon->bindParam(":configurations_sdesc_openauthprovider", $configurations_sdesc_openauthprovider);
        $appcon->bindParam(":openauth_uid", $openauth_uid);
        $appcon->execUpdate();

        $this->resultUpdateRecord($appcon, "openauth");
        
        zLog()->LogEnd_DataObjectFunction("updateAllbyUid");
    }
    
    function updateIsValidbyUid($openauth_uid,
                                $isvalid)
    {
        zLog()->LogStart_DataObjectFunction("updateIsValidbyUid");
        
        $sqlstmnt = "UPDATE openauth SET 
            changeddt=NOW(), 
            isvalid=:isvalid 
            WHERE openauth_uid=:openauth_uid";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":isvalid", $isvalid);
        $appcon->bindParam(":openauth_uid", $openauth_uid);
        $appcon->execUpdate();

        $this->resultUpdateRecord($appcon, "openauth");
        
        zLog()->LogEnd_DataObjectFunction("updateIsValidbyUid");
    }
}
?>