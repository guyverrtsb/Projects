<?php zReqOnce("/gd.trxn.com/_controls/classes/_sys/_returns.php"); ?>
<?php
class SysConfigurations
    extends SysReturns
{
    function findConfigurationListfromGroupKey($groupkey, $APPDB = "crossapplication")
    {
        zLog()->LogStart_Function("findConfigurationListfromGroupKey");
        
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

        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->Results_ConfigurationRecords = $appcon->getStatement()->fetch(PDO::FETCH_ASSOC);
                $this->saveActivityLog("RECORD_IS_FOUND", "Record is Retrieved:".json_encode($this->Results_ConfigurationRecords).":");
                $this->setSysReturnData("RECORD_IS_FOUND", "Record is Retrieved");
            }
            else
            {
                $this->setSysReturnData("RECORD_IS_NOT_FOUND", "Record is not Retrieved");
            }
        }
        else
        {
            $this->setSysReturnData("TRANSACTION_FAIL", "Transaction has failed");
        }

        zLog()->LogEnd_Function("findConfigurationListfromGroupKey");
    }
    
    function findConfigurationfromSdesc($sdesc, $APPDB = "crossapplication")
    {
        zLog()->LogStart_Function("findConfigurationfromSdesc");
        
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

        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->Result_ConfigurationRecord = $appcon->getStatement()->fetch(PDO::FETCH_ASSOC);
                $this->saveActivityLog("RECORD_IS_FOUND", "Record is Retrieved:".json_encode($this->Result_ConfigurationRecord).":");
                $this->setSysReturnData("RECORD_IS_FOUND", "Record is Retrieved");
            }
            else
            {
                $this->setSysReturnData("RECORD_IS_NOT_FOUND", "Record is not Retrieved");
            }
        }
        else
        {
            $this->setSysReturnData("TRANSACTION_FAIL", "Transaction has failed");
        }

        zLog()->LogEnd_Function("findConfigurationfromSdesc");
    }
    
    function findConfigurationfromUid($uid, $APPDB = "crossapplication")
    {
        zLog()->LogStart_Function("findConfigurationfromUid");
        
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

        zLog()->LogEnd_Function("findConfigurationfromUid");
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