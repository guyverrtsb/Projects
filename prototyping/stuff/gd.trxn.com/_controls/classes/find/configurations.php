<?php gdreqonce("/gd.trxn.com/_controls/classes/base/baseobject.php"); ?>
<?php
/*
 * Author: Stephen Shellenberger
 * Copyright: 2013 Stephen Shellenberger
 * Date: 2013/01/07
 * This Class file is for Finding University Data
 * 1. findGroupList - 
 * -- Use this to get the list of based on the group
 */
class zFindConfigurations
    extends zBaseObject
{
    private $group_list, $config_default_record;
    
    function __construct()
    {
    }
    
    /**
     * Find University Account and Profile by Email Key
     * $university_account_emailkey = EMAILKEY
     */
    function findGroupList($group_key, $dependant_sdesc)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findGroupList");
        $this->cleanResults_GroupList();
        $fr;
        $sqlstmnt = "SELECT ".
            "uid, sdesc, ldesc ".
            "from cfg_defaults ".
            "WHERE group_key=:group_key ".
            "AND dependant_sdesc=:dependant_sdesc";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB();
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":group_key", $group_key);
        $dbcontrol->bindParam(":dependant_sdesc", $dependant_sdesc);
        $dbcontrol->execSelect();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->group_list = $dbcontrol->getStatement()->fetchAll(PDO::FETCH_ASSOC);
                $this->gdlog()->LogInfoDB($this->group_list);
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
        $this->gdlog()->LogInfoEndFUNCTION("findGroupList");
        return $fr;
    }

    
    /**
     * Find University Account and Profile by Email Key
     * $university_account_emailkey = EMAILKEY
     */
    function findDefaultLabelSdesc($sdesc)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findDefaultLabelSdesc");
        $this->cleanResults_Default();
        $fr;
        $sqlstmnt = "SELECT ".
            "uid, sdesc, ldesc ".
            "from cfg_defaults ".
            "WHERE sdesc=:sdesc";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB();
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":sdesc", $sdesc);
        $dbcontrol->execSelect();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->config_default_record = $dbcontrol->getStatement()->fetchAll(PDO::FETCH_ASSOC);
                $this->gdlog()->LogInfoDB($this->config_default_record);
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
        $this->gdlog()->LogInfoEndFUNCTION("findDefaultLabelSdesc");
        return $fr;
    }

    /**
     * Find University Account and Profile by Email Key
     * $university_account_emailkey = EMAILKEY
     */
    function findConfigurationList($cfg_type)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findConfigurationList");
        $this->cleanResults_GroupList();
        $tblname = "";
        if($cfg_type == "GROUPTYPE")
            $tblname = "cfg_group_type";
        else if($cfg_type == "GROUPACCEPTANCE")
            $tblname = "cfg_group_useracceptance";
        else if($cfg_type == "GROUPVISIBILITY")
            $tblname = "cfg_group_visibility";
        $fr;
        $sqlstmnt = "SELECT ".
            "uid, sdesc, ldesc ".
            "from ".$tblname." ";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB();
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->execSelect();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->group_list = $dbcontrol->getStatement()->fetchAll(PDO::FETCH_ASSOC);
                $this->gdlog()->LogInfoDB($this->group_list);
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
        $this->gdlog()->LogInfoEndFUNCTION("findConfigurationList");
        return $fr;
    }
    
    function getResults_GroupList()
    {
        return $this->group_list;
    }    
    function cleanResults_GroupList()
    {
        return $this->group_list = "";
    }
    
    function getResults_Default_UsingField($fieldname)
    {
        if($fieldname == "uid")
            return $this->config_default_record[0];
        else if($fieldname == "sdesc")
            return $this->config_default_record[1];
        else if($fieldname == "ldesc")
            return $this->config_default_record[2];
    }    
    function cleanResults_Default()
    {
        return $this->config_default_record = "";
    }
}
?>