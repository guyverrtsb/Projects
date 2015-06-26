<?php zReqOnce("/gd.trxn.com/_controls/classes/_sys/database/_connections.php"); ?>
<?php zReqOnce("/gd.trxn.com/_controls/classes/_sys/_configurations.php"); ?>
<?php
class SysBaseObject
    extends SysConfigurations
{
    /* Record Container */
    function setResult_Records($rows)
    {
        $this->setSysReturnitem(strtoupper(get_class($this)), $rows);
    }
    
    function getResult_Records()
    {
        $records = $this->getSysReturnitem(strtoupper(get_class($this)));
        if($this->getSysReturnitem(strtoupper(get_class($this))) == "NO_VALUE_SET")
            return null;
        return $records;
    }
    
    function setResult_Record($row)
    {
        $this->setSysReturnitem(strtoupper(get_class($this)), $row);
    }
    
    function getResult_Record()
    {
        $record = $this->getSysReturnitem(strtoupper(get_class($this)));
        if($record == "NO_VALUE_SET")
            return null;
        return $record;
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