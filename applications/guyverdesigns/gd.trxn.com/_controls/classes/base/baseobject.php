<?php gdreqonce("/_controls/classes/connections/appdatabase.php"); ?>
<?php gdreqonce("/gd.trxn.com/_controls/classes/_config.php"); ?>
<?php
class zBaseObject
    extends zGDUtilities
{
    private $zgdconfig = null;
    public function saveActivityLog($fr, $notes)
    {
        $this->gdlog()->LogInfoStartFUNCTION("saveActivityLog");
        $sqlstmnt = "INSERT INTO activity_log SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "fdesc=:fdesc, notes=:notes";

        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("CROSSAPPDATA");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":fdesc", $fr);
        $dbcontrol->bindParam(":notes", $notes);
        $numrows = $dbcontrol->execUpdate();
/*
        for ($idx = 0; $idx < sizeof($dbcontrol->getErrorNumAry()); $idx++)
        {
            $en = $dbcontrol->getErrorNumAry();
            $em = $dbcontrol->getErrorMsgAry();
            $rc = $dbcontrol->getRowCount();
            $li = $dbcontrol->getLastInsertID();
            $dbcontrol->setErrorContainer($en[$idx], $em[$idx], $rc[$idx], $li[$idx]);
        }
*/
        $dbcontrol->rollbackcommit();
        $this->gdlog()->LogInfoRETURN($fr);
        $this->gdlog()->LogInfoEndFUNCTION("saveActivityLog");
        return $fr;
    }
    
    /*
     * database field AS
     */
    public function dbfas($fieldinput, $univtablekey = "NOT_DEFINED")
    {
        $fns = explode(",", $fieldinput);
        $fieldoutput = "";
        $cntr = 0;
        foreach($fns as $fn)
        {
            $cntr++;
            $fn = trim($fn);
            $fo = "AS ".str_replace(".", "_", $fn);
            if($univtablekey != "NOT_DEFINED")
            {
                $fo = str_replace($univtablekey, "", $fo);
            }
            $this->gdlog()->LogInfo("BASE OBJECT:DBFAS:".$fn."{".$fo."}");
            $fieldoutput = $fieldoutput.$fn." ".$fo;
            if(count($fns) > $cntr)
                $fieldoutput = $fieldoutput.",";
        }
        $this->gdlog()->LogInfo("BASE OBJECT:DBFAS[".count($fns)."]:fieldoutput {".$fieldoutput."}");
        return $fieldoutput;
    }
    /*
     * Database Field
     */
    public function dbf($fieldinput)
    {
        $fieldoutput = str_replace(".", "_", $fieldinput);
        $this->gdlog()->LogInfo("BASE OBJECT:DBF:".$fieldinput."{".$fieldoutput."}");
        return $fieldoutput;
    }
    
    function getGDConfig()
    {
        if(!isset($this->zgdconfig) || $this->zgdconfig == null)
            $this->zgdconfig = new ZGDConfigurations();
        return $this->zgdconfig;
    }
    
    function createUserTableKey($usertablekey)
    {
        $usertablekey = preg_replace('/[^a-zA-Z0-9]/', '', $usertablekey);
        return "X_".$usertablekey."_";
    }
    
    function createSdesc($import)
    {
        $export = preg_replace('/[^a-zA-Z0-9]/', '', $import);
        return strtoupper($export);
    }
    
    /* Data Container */
    private $outputdatacontainer = array();
    function setOutputData($name, $value)
    {
        $this->outputdatacontainer[$name] = $value;
        gdlog()->LogInfo("setOutData:{".$name."}-{".$this->outputdatacontainer[$name]."}");
    }
    function getOutputData($name)
    {
        return $this->outputdatacontainer[$name];
    }
    function cleanOutputData($name)
    {
        $this->outputdatacontainer[$name] = "NO_OBJECT";
    }
    function cleanAllOutputData()
    {
        foreach($this->outputdatacontainer as $key => $val)
        {
            $this->cleanOutputData($key);
        }
    }
    function dumpOutputData()
    {
        foreach($this->outputdatacontainer as $key => $val)
        {
            gdlog()->LogInfo("dumpOutputData:{".$key."}-{".$this->outputdatacontainer[$key]."}");
        }
    }
    
    /* Record Container */
    private $Result_Records = "NO_RECORDS";
    function setResult_Records($rows)
    {
        $this->Result_Records = $rows;
    }
    
    function getResult_Records()
    {
        return $this->Result_Records;
    }
    
    function cleanResult_Records()
    {
        $this->Result_Records = "NO_RECORDS";
    }
    
    private $Result_Record = "NO_RECORD";
    function setResult_Record($row)
    {
        $this->Result_Record = $row;
    }
    
    function getResult_Record()
    {
        return $this->Result_Record;
    }
    
    function getResult_RecordField($name)
    {
        return $this->Result_Record[$name];
    }
    
    function cleanResult_Record()
    {
        $this->Result_Record = "NO_RECORD";
    }
    
    function getDATE_FORMAT($date)
    {
        return "DATE_FORMAT(".$date.", \"%m/%d/%Y\")";
    }
    
    function getDAY_FORMAT($date)
    {
        return "DATE_FORMAT(".$date.", \"%W\")";
    }
}
?>