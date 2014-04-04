<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class gdCreateAccountingTimesheet
    extends zAppBaseObject
{
    function __construct()
    {
    }
    
    function createRecordTimesheet($accounting_project_uid
                                , $sdesc
                                , $ldesc)
    {
        $this->gdlog()->LogInfoStartFUNCTION("createRecordTimesheet");
        $this->cleanResult_Record();
        $sqlstmnt = "INSERT INTO accounting_timesheet SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "accounting_project_uid=:accounting_project_uid, ".
            "sdesc=:sdesc, ".
            "ldesc=:ldesc";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("APPDB");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":accounting_project_uid", $accounting_project_uid);
        $appcon->bindParam(":sdesc", $sdesc);
        $appcon->bindParam(":ldesc", $ldesc);
        $appcon->execUpdate();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getRowfromLastId($appcon, "accounting_timesheet", $appcon->getLastInsertID()));
                $this->gdlog()->LogInfoDB($this->getResult_Record());
                $fr = $this->saveActivityLog("RECORD_IS_CREATED", "Record is Created:".json_encode($this->getResult_Record()).":");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("RECORD_IS_NOT_CREATED");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("createRecordTimesheet");
        return $fr;
    }
    
    function getUid() { return $this->getResult_RecordField("uid"); }
    function getCompanyname() { return $this->getResult_RecordField("account_project_uid"); }
    function getInvoicecontactname() { return $this->getResult_RecordField("sdesc"); }
    function getInvoicecontactemail() { return $this->getResult_RecordField("ldesc"); }
}?>