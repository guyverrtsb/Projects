<?php gdreqonce("/gd.trxn.com/_controls/classes/base/baseobject.php"); ?>
<?php gdreqonce("/_controls/classes/_appconfig.php"); ?>
<?php
class zAppBaseObject
    extends zBaseObject

{
    private $zappconfig = null;
    function getGDConfig()
    {
        if(!isset($this->zappconfig) || $this->zappconfig == null)
            $this->zappconfig = new ZAppConfigurations();
        return $this->zappconfig;
    }
    
    function findConfigurationListfromGroupKey($group_key)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findConfigurationListfromGroupKey");
        $this->cleanResults_ConfigurationRecords();
        $fr;
        $sqlstmnt = "SELECT ".
            "uid, sdesc, ldesc, group_key, label ".
            "from cfg_defaults ".
            "WHERE group_key=:group_key";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":group_key", strtoupper($group_key));
        $dbcontrol->execSelect();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResults_ConfigurationRecords($dbcontrol->getStatement()->fetchAll(PDO::FETCH_ASSOC));
                $this->gdlog()->LogInfoDB($this->getResults_ConfigurationRecords());
                $fr = $this->gdlog()->LogInfoRETURN("LIST_FOUND");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("LIST_NOT_FOUND");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("findConfigurationListfromGroupKey");
        return $fr;
    }
    
    function findConfigurationfromSdesc($sdesc)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findConfigurationfromSdesc");
        $this->cleanResult_ConfigurationRecord();
        $fr;
        $sqlstmnt = "SELECT ".
            "uid, sdesc, ldesc, group_key, label ".
            "from cfg_defaults ".
            "WHERE sdesc=:sdesc";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":sdesc", strtoupper($sdesc));
        $dbcontrol->execSelect();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResult_ConfigurationRecord($dbcontrol->getStatement()->fetch(PDO::FETCH_ASSOC));
                $this->gdlog()->LogInfoDB($this->getResult_ConfigurationRecord());
                $fr = $this->gdlog()->LogInfoRETURN("RECORD_FOUND");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("RECORD_NOT_FOUND");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("findConfigurationfromSdesc");
        return $fr;
    }
    
    function findConfigurationfromUid($uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findConfigurationfromUid");
        $this->cleanResult_ConfigurationRecord();
        $fr;
        $sqlstmnt = "SELECT ".
            "uid, sdesc, ldesc, group_key, label ".
            "from cfg_defaults ".
            "WHERE uid=:uid";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":uid", $uid);
        $dbcontrol->execSelect();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResult_ConfigurationRecord($dbcontrol->getStatement()->fetch(PDO::FETCH_ASSOC));
                $this->gdlog()->LogInfoDB($this->getResult_ConfigurationRecord());
                $fr = $this->gdlog()->LogInfoRETURN("RECORD_FOUND");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("RECORD_NOT_FOUND");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("findConfigurationfromUid");
        return $fr;
    }
    
    function findCfgUidfromSdesc($sdesc)
    {
        $this->findConfigurationfromSdesc(strtoupper($sdesc));
        return $this->getUID();
    }
    
    function findCfgSdescfromUid($uid)
    {
        $this->findConfigurationfromUid($uid);
        return $this->getSdesc();
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
    
    function getUID(){return $this->Result_ConfigurationRecord["uid"];}
    function getSdesc(){return $this->Result_ConfigurationRecord["sdesc"];}
    function getLdesc(){return $this->Result_ConfigurationRecord["ldesc"];}
    function getLabel(){return $this->Result_ConfigurationRecord["label"];}
    function getGroupKey(){return $this->Result_ConfigurationRecord["group_key"];}
    function getNumofRecords(){return count($this->Results_ConfigurationRecords);}
    
    function createSdesc($input)
    {
        $sdesc = str_replace(' ', '_', strtoupper($input));
        if(strlen($sdesc) >= 100)
            $sdesc = $sdesc.substring(0, 99);
        return $sdesc;
    }
    
    function createUserTableKey($user_email)
    {
        $usertablekey = str_replace("@", "_", $user_email);
        $usertablekey = str_replace(".", "_", $usertablekey);
        return $usertablekey;
    }
}
?>