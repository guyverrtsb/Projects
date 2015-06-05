<?php zReqOnce("/gd.trxn.com/_controls/classes/_sys/_returns.php"); ?>
<?php
class SysConfigurations
    extends SysReturns
{
    function findConfigurationListfromGroupKey($groupkey, $APPDB = "crossapplication")
    {
        zLog()->LogStartFUNCTION("findConfigurationListfromGroupKey");
        
        $this->cleanResults_ConfigurationRecords();

        $sqlstmnt = "SELECT ".
            "uid, sdesc, ldesc, groupkey, label ".
            "from configurations ".
            "WHERE groupkey=:groupkey";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB($APPDB);
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":groupkey", strtoupper($groupkey));
        $appcon->execSelect();
        
        $this->resultRetrieveRecord($appcon);

        zLog()->LogEndFUNCTION("findConfigurationListfromGroupKey");
    }
    
    function findConfigurationfromSdesc($sdesc, $APPDB = "crossapplication")
    {
        zLog()->LogStartFUNCTION("findConfigurationfromSdesc");
        
        $this->cleanResult_ConfigurationRecord();

        $sqlstmnt = "SELECT ".
            "uid, sdesc, ldesc, groupkey, label ".
            "from configurations ".
            "WHERE sdesc=:sdesc";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB($APPDB);
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":sdesc", strtoupper($sdesc));
        $appcon->execSelect();
        
        $this->resultRetrieveRecord($appcon);

        zLog()->LogEndFUNCTION("findConfigurationfromSdesc");
    }
    
    function findConfigurationfromUid($uid, $APPDB = "crossapplication")
    {
        zLog()->LogStartFUNCTION("findConfigurationfromUid");
        
        $this->cleanResult_ConfigurationRecord();

        $sqlstmnt = "SELECT ".
            "uid, sdesc, ldesc, groupkey, label ".
            "from configurations ".
            "WHERE uid=:uid";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB($APPDB);
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":uid", $uid);
        $appcon->execSelect();
        
        $this->resultRetrieveRecord($appcon);

        zLog()->LogEndFUNCTION("findConfigurationfromUid");
    }
    
    function findCfgUidfromSdesc($sdesc)
    {
        $this->findConfigurationfromSdesc(strtoupper($sdesc));
        return $this->getConfigurationUID();
    }
    
    function findCfgSdescfromUid($uid)
    {
        $this->findConfigurationfromUid($uid);
        return $this->getConfigurationSdesc();
    }
    
    private $Results_ConfigurationRecords = "NO_RECORDS";
    private $Result_ConfigurationRecord = "NO_RECORD";
    function setResults_ConfigurationRecords($rows)
    {
        $this->Results_ConfigurationRecords = $rows;
    }  
    function getResults_ConfigurationRecords()
    {
        return $this->Results_ConfigurationRecords;
    }    
    function cleanResults_ConfigurationRecords()
    {
        return $this->Results_ConfigurationRecords = "NO_RECORDS";
    }
    
    function setResult_ConfigurationRecord($row)
    {
        $this->Result_ConfigurationRecord = $row;
    }
    function getResult_ConfigurationRecord()
    {
        return $this->Result_ConfigurationRecord;
    }    
    function cleanResult_ConfigurationRecord()
    {
        return $this->Result_ConfigurationRecord = "NO_RECORD";
    }
    
    function getConfigurationUID(){return $this->Result_ConfigurationRecord["uid"];}
    function getConfigurationSdesc(){return $this->Result_ConfigurationRecord["sdesc"];}
    function getConfigurationLdesc(){return $this->Result_ConfigurationRecord["ldesc"];}
    function getConfigurationLabel(){return $this->Result_ConfigurationRecord["label"];}
    function getConfigurationGroupKey(){return $this->Result_ConfigurationRecord["groupkey"];}
    function getConfigurationNumofRecords(){return count($this->Results_ConfigurationRecords);}
}
?>