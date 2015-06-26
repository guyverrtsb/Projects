<?php zReqOnce("/_controls/classes/dataobjects/base/entitymatch.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class CreateMatchEntityaccounttoGroupaccount
    extends EntityMatchBase
{
    function __construct()
    {
    }
    
    function full($entityaccount_uid,
                $groupaccount_uid)
    {
        zLog()->LogStart_DataObjectFunction("full");
        
        $sqlstmnt = "INSERT INTO match_entityaccount_to_groupaccount SET 
            uid=UUID(), createddt=NOW(), changeddt=NOW(),
            entityaccount_uid=:entityaccount_uid,
            groupaccount_uid=:groupaccount_uid";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":entityaccount_uid", $entityaccount_uid);
        $appcon->bindParam(":groupaccount_uid", $groupaccount_uid);
        $appcon->execUpdate();
        
        $this->resultCreateRecord($appcon, "match_entityaccount_to_groupaccount");
        
        zLog()->LogEnd_DataObjectFunction("full");
    }
}
?>