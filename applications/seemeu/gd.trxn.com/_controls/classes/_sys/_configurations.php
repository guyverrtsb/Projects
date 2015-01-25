<?php zReqOnce("/gd.trxn.com/_controls/classes/_sys/_utilities.php"); ?>
<?php
class SysConfigurations
    extends SysUtilities
{
    function findConfigurationListfromGroupKey($groupkey, $APPDB = "crossapplication")
    {
        zLog()->LogInfoStartFUNCTION("findConfigurationListfromGroupKey");
        $this->cleanResults_ConfigurationRecords();
        $fr;
        $sqlstmnt = "SELECT ".
            "uid, sdesc, ldesc, groupkey, label ".
            "from configurations ".
            "WHERE groupkey=:groupkey";
        
        $dbcontrol = new SysConnections();
        $dbcontrol->setApplicationDB($APPDB);
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":groupkey", strtoupper($groupkey));
        $dbcontrol->execSelect();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResults_ConfigurationRecords($dbcontrol->getStatement()->fetchAll(PDO::FETCH_ASSOC));
                zLog()->LogInfoDB($this->getResults_ConfigurationRecords());
                $fr = zLog()->LogInfoRETURN("LIST_FOUND");
            }
            else
            {
                $fr = zLog()->LogInfoRETURN("LIST_NOT_FOUND");
            }
        }
        else
        {
            $fr = zLog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        zLog()->LogInfoEndFUNCTION("findConfigurationListfromGroupKey");
        return $fr;
    }
    
    function findConfigurationfromSdesc($sdesc, $APPDB = "crossapplication")
    {
        zLog()->LogInfoStartFUNCTION("findConfigurationfromSdesc");
        $this->cleanResult_ConfigurationRecord();
        $fr;
        $sqlstmnt = "SELECT ".
            "uid, sdesc, ldesc, groupkey, label ".
            "from configurations ".
            "WHERE sdesc=:sdesc";
        
        $dbcontrol = new SysConnections();
        $dbcontrol->setApplicationDB($APPDB);
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":sdesc", strtoupper($sdesc));
        $dbcontrol->execSelect();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResult_ConfigurationRecord($dbcontrol->getStatement()->fetch(PDO::FETCH_ASSOC));
                zLog()->LogInfoDB($this->getResult_ConfigurationRecord());
                $fr = zLog()->LogInfoRETURN("RECORD_FOUND");
            }
            else
            {
                $fr = zLog()->LogInfoRETURN("RECORD_NOT_FOUND");
            }
        }
        else
        {
            $fr = zLog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        zLog()->LogInfoEndFUNCTION("findConfigurationfromSdesc");
        return $fr;
    }
    
    function findConfigurationfromUid($uid, $APPDB = "crossapplication")
    {
        zLog()->LogInfoStartFUNCTION("findConfigurationfromUid");
        $this->cleanResult_ConfigurationRecord();
        $fr;
        $sqlstmnt = "SELECT ".
            "uid, sdesc, ldesc, groupkey, label ".
            "from configurations ".
            "WHERE uid=:uid";
        
        $dbcontrol = new SysConnections();
        $dbcontrol->setApplicationDB($APPDB);
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":uid", $uid);
        $dbcontrol->execSelect();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResult_ConfigurationRecord($dbcontrol->getStatement()->fetch(PDO::FETCH_ASSOC));
                zLog()->LogInfoDB($this->getResult_ConfigurationRecord());
                $fr = zLog()->LogInfoRETURN("RECORD_FOUND");
            }
            else
            {
                $fr = zLog()->LogInfoRETURN("RECORD_NOT_FOUND");
            }
        }
        else
        {
            $fr = zLog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        zLog()->LogInfoEndFUNCTION("findConfigurationfromUid");
        return $fr;
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