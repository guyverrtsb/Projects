<?php zReqOnce("/gd.trxn.com/_controls/classes/_sys/_baseobject.php"); ?>
<?php
class AppSysBaseObject
    extends SysBaseObject
{
    function __constructor()
    {
        // $this->setSysReturnitem("REFERER", $_SERVER["HTTP_REFERER"]);
    }
    
    function resultCreateRecord($appcon, $tablename)
    {
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getRowfromLastLid($appcon, $tablename));
                $this->saveActivityLog("RECORD_IS_CREATED", "Record is Created:".json_encode($this->getResult_Record()).":");
                $this->setSysReturnData("RECORD_IS_CREATED", "Record is Created");
            }
            else
            {
                $this->setSysReturnData("RECORD_IS_NOT_CREATED", "Record is not Created");
            }
        }
        else
        {
            $this->setSysReturnData("TRANSACTION_FAIL", "Transaction has failed");
        }
    }
    
    function resultRetrieveRecord($appcon)
    {
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getStatement()->fetch(PDO::FETCH_ASSOC));
                $this->saveActivityLog("RECORD_IS_FOUND", "Record is Retrieved:".json_encode($this->getResult_Record()).":");
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
    }
    
    function resultRetrieveRecords($appcon)
    {
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Records($appcon->getStatement()->fetchAll(PDO::FETCH_ASSOC));
                $this->saveActivityLog("RECORDS_ARE_FOUND", "Records are Retrieved:".json_encode($this->getResult_Records()).":");
                $this->setSysReturnData("RECORDS_ARE_FOUND", "Records are Retrieved");
            }
            else
            {
                $this->setSysReturnData("RECORDS_ARE_NOT_FOUND", "Records are not Retrieved");
            }
        }
        else
        {
            $this->setSysReturnData("TRANSACTION_FAIL", "Transaction has failed");
        }
    }
    
    function resultUpdateRecord($appcon)
    {
        if($appcon->getTransactionGood())
        {
            $this->saveActivityLog("RECORD_IS_UDPATED", "Record is Updated");
            $this->setSysReturnData("RECORD_IS_UDPATED", "Record is Updated");
        }
        else
        {
            $this->setSysReturnData("TRANSACTION_FAIL", "Transaction has failed");
        }
    }
    
    function resultDeleteRecord($appcon)
    {
        if($appcon->getTransactionGood())
        {
            $this->saveActivityLog("RECORD_IS_DELETED", "Record is Deleted");
            $this->setSysReturnData("RECORD_IS_DELETED", "Record is Deleted");
        }
        else
        {
            $this->setSysReturnData("TRANSACTION_FAIL", "Transaction has failed");
        }
    }
}
?>