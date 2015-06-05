<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/base/user.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class Createopenauth
    extends UserBase
{
    function __construct()
    {
    }
    
    function full($openauthkey,
                $expiredt,
                $isvalid)
    {
        zLog()->LogStartDATAOBJECTFUNCTION("basic");
        
        $sqlstmnt = "INSERT INTO openauth SET 
            uid=UUID(), createddt=NOW(), changeddt=NOW(),
            openauthkey=:openauthkey,
            expiredt=:expiredt,
            isvalid=:isvalid";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":openauthkey", $openauthkey);
        $appcon->bindParam(":expiredt", $expiredt);
        $appcon->bindParam(":isvalid", $isvalid);
        $appcon->execUpdate();
        
        $this->resultCreateRecord($appcon, "openauth");
        
        zLog()->LogEndDATAOBJECTFUNCTION("basic");
    }
}
?>