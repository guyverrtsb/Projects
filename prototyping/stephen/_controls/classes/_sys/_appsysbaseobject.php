<?php zReqOnce("/gd.trxn.com/_controls/classes/_sys/_baseobject.php"); ?>
<?php
class AppSysBaseObject
    extends SysBaseObject
{
    function resultCreateRecord($appcon, $tablename)
    {
        $mr = "NA"; //Method Return;
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getRowfromLastLid($appcon, $tablename));
                zLog()->LogInfoDB($this->getResult_Record());
                $this->saveActivityLog("RECORD_IS_CREATED", "Record is Created:".json_encode($this->getResult_Record()).":");
                $this->setSysReturnCode("RECORD_IS_CREATED");
            }
            else
            {
                $this->setSysReturnCode("RECORD_IS_NOT_CREATED");
            }
        }
        else
        {
            $this->setSysReturnCode("TRANSACTION_FAIL");
        }
    }
    
    function resultRetrieveRecord($appcon)
    {
        $mr = "NA"; //Method Return;
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getStatement()->fetch(PDO::FETCH_ASSOC));
                zLog()->LogInfoDB($this->getResult_Record());
                $mr = $this->saveActivityLog("RECORD_IS_FOUND", "Record is Retrieved:".json_encode($this->getResult_Record()).":");
                $this->setSysReturnCode("RECORD_IS_FOUND");
            }
            else
            {
                $this->setSysReturnCode("RECORD_IS_NOT_FOUND");
            }
        }
        else
        {
            $this->setSysReturnCode("TRANSACTION_FAIL");
        }
    }
    
    function resultRetrieveRecords($appcon)
    {
        $mr = "NA"; //Method Return;
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Records($appcon->getStatement()->fetch(PDO::FETCH_ASSOC));
                zLog()->LogInfoDB($this->getResult_Records());
                $mr = $this->saveActivityLog("RECORDS_ARE_FOUND", "Records are Retrieved:".json_encode($this->getResult_Records()).":");
                $this->setSysReturnCode("RECORDS_ARE_FOUND");
            }
            else
            {
                $this->setSysReturnCode("RECORDS_ARE_NOT_FOUND");
            }
        }
        else
        {
            $this->setSysReturnCode("TRANSACTION_FAIL");
        }
    }
    
    function resultUpdateRecord($appcon)
    {
        $mr = "NA"; //Method Return;
        if($appcon->getTransactionGood())
        {
            $this->saveActivityLog("RECORD_IS_UDPATED", "Record is Updated");
            $this->setSysReturnCode("RECORD_IS_UDPATED");
        }
        else
        {
            $this->setSysReturnCode("TRANSACTION_FAIL");
        }
    }
    
    function resultDeleteRecord($appcon)
    {
        $mr = "NA"; //Method Return;
        if($appcon->getTransactionGood())
        {
            $this->saveActivityLog("RECORD_IS_DELETED", "Record is Deleted");
            $this->setSysReturnCode("RECORD_IS_DELETED");
        }
        else
        {
            $this->setSysReturnCode("TRANSACTION_FAIL");
        }
    }
}
?>