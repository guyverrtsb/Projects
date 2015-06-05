<?php zReqOnce("/gd.trxn.com/_controls/classes/_sys/database/_connections.php"); ?>
<?php zReqOnce("/gd.trxn.com/_controls/classes/_sys/_configurations.php"); ?>
<?php
class SysBaseObject
    extends SysConfigurations
{
    /* Record Container */
    private $Result_Records = "NO_RECORDS";
    function setResult_Records($rows)
    {
        $this->setSysReturnitem(strtoupper(get_class($this)), $rows);
    }
    
    function getResult_Records()
    {
        if($this->getSysReturnitem(strtoupper(get_class($this))) == "NO_VALUE_SET")
            return null;
        return $this->Result_Records;
    }
    
    private $Result_Record = "NO_RECORD";
    function setResult_Record($row)
    {
        $this->setSysReturnitem(strtoupper(get_class($this)), $row);
    }
    
    function getResult_Record()
    {
        if(getSysReturnitem(strtoupper(get_class($this))) == "NO_VALUE_SET")
            return null;
        return $this->Result_Record;
    }
    
    function getResult_RecordField($name)
    {
        $row = $this->getResult_Record();
        if($row == null)
            return null;
        return $row[$name];
    }
}
?>