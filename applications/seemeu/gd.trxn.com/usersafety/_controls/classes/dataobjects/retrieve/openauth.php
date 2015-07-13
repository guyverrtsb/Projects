<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/base/openauth.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class RetrieveOpenauth
    extends OpenauthBase
{
    function __construct()
    {
    }
    
    function byUid($openauth_uid)
    {
        zLog()->LogStart_DataObjectFunction("byUid");

        $sqlstmnt = "SELECT 
                lid,
                uid,
                createddt,
                changeddt,
                openauthkey,
                expiredt,
                isvalid,
                configurations_sdesc_openauthprovider
            FROM openauth 
            WHERE uid = :openauth_uid";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":openauth_uid", $openauth_uid);
        $appcon->execSelect();
        
        $this->resultRetrieveRecord($appcon);
        
        zLog()->LogEnd_DataObjectFunction("byUid");
    }
}
?>