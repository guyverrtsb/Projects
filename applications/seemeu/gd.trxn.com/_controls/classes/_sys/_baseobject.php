<?php zReqOnce("/gd.trxn.com/_controls/classes/_sys/_configurations.php"); ?>
<?php
class SysBaseObject
    extends SysConfigurations
{
    /* Data Container */
    private $outputdatacontainer = array();
    function setOutputData($name, $value)
    {
        $this->outputdatacontainer[$name] = $value;
        zLog()->LogInfo("setOutData:{".$name."}-{".$this->outputdatacontainer[$name]."}");
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
            zLog()->LogInfo("dumpOutputData:{".$key."}-{".$this->outputdatacontainer[$key]."}");
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
}
?>