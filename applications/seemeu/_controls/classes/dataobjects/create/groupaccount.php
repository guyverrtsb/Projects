<?php zReqOnce("/_controls/classes/dataobjects/base/group.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class CreateGroupAccount
    extends GroupBase
{
    function __construct()
    {
    }
    
    function full($sdesc,
                $ldesc,
                $configurations_sdesc_grouptype,
                $configurations_sdesc_groupvisibility,
                $configurations_sdesc_groupaccept)
    {
        zLog()->LogStart_DataObjectFunction("full");
        
        $sqlstmnt = "INSERT INTO groupaccount SET 
            uid=UUID(), createddt=NOW(), changeddt=NOW(),
            sdesc=:sdesc,
            ldesc=:ldesc,
            configurations_sdesc_grouptype=:configurations_sdesc_grouptype,
            configurations_sdesc_groupvisibility=:configurations_sdesc_groupvisibility,
            configurations_sdesc_groupaccept=:configurations_sdesc_groupaccept";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":sdesc", $this->createSdesc($sdesc));
        $appcon->bindParam(":ldesc", $this->createSdesc($ldesc));
        $appcon->bindParam(":configurations_sdesc_grouptype", $configurations_sdesc_grouptype);
        $appcon->bindParam(":configurations_sdesc_groupvisibility", $configurations_sdesc_groupvisibility);
        $appcon->bindParam(":configurations_sdesc_groupaccept", $configurations_sdesc_groupaccept);
        $appcon->execUpdate();
        
        $this->resultCreateRecord($appcon, "groupaccount");
        
        zLog()->LogEnd_DataObjectFunction("full");
    }
}
?>