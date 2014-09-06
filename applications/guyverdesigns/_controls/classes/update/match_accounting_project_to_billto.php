<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class gdUpdateAccountingMatchProjecttoBillto
    extends zAppBaseObject
{
    function __construct()
    {
    }
    
    function updateRecordMatchAccount_byProjectUid($accounting_project_uid
                                                , $accounting_billto_uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("updateRecordMatchAccount_byProjectUid");
        $sqlstmnt = "UPDATE match_accounting_project_to_billto SET ".
            "changeddt=NOW(), ".
            "accounting_billto_uid=:accounting_billto_uid ".
            "WHERE accounting_project_uid=:accounting_project_uid";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("APPDB");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":accounting_billto_uid", $accounting_billto_uid);
        $appcon->bindParam(":accounting_project_uid", $accounting_project_uid);
        $appcon->execUpdate();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getRowfromLastId($appcon, "match_accounting_project_to_billto", $appcon->getLastInsertID()));
                $this->gdlog()->LogInfoDB($this->getResult_Record());
                $fr = $this->saveActivityLog("RECORD_IS_UPDATED", "Record is Update:".json_encode($this->getResult_Record()).":");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("RECORD_IS_NOT_UPDATED");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("updateRecordMatchAccount_byProjectUid");
        return $fr;
    }
    
    function getUid() { return $this->getResult_RecordField("uid"); }
    function getProjectUid() { return $this->getResult_RecordField("accounting_project_uid"); }
    function getBilltoUid() { return $this->getResult_RecordField("accounting_billto_uid"); }
}
?>