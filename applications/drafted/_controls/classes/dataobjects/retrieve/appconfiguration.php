<?php zReqOnce("/_controls/classes/dataobjects/base/appconfiguration.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class RetrieveAppConfiguration
    extends AppConfigurationBase
{
    function __construct()
    {
    }
    
    /**
     * Retrieve Record by Email
     */
    function byGroupkey($groupkey)
    {
        zLog()->LogStart_DataObjectFunction("byGroupkey");
        
        $sqlstmnt = "SELECT * FROM configurations ".
            "WHERE groupkey=:groupkey";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":groupkey", $groupkey);
        $appcon->execSelect();

        $this->resultRetrieveRecords($appcon);

        zLog()->LogEnd_DataObjectFunction("byGroupkey");
    }
    
    /**
     * Retrieve Record by Nickname
     */
    function bySdesc($sdesc)
    {
        zLog()->LogStart_DataObjectFunction("bySdesc");
        
        $sqlstmnt = "SELECT * FROM gameraccount ".
            "WHERE sdesc=:sdesc";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":sdesc", $sdesc);
        $appcon->execSelect();

        $this->resultRetrieveRecord($appcon);

        zLog()->LogEnd_DataObjectFunction("bySdesc");
    }
}
?>