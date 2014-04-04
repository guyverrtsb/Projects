<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class gdUpdateUsersafetyTaskControlLinks
    extends zAppBaseObject
{
    function __construct()
    {
    }
    
    function updateRecordTaskControlDeactivate($uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("updateRecordTaskControlDeactivate");
        $fr = $this->updateRecordTaskControl_Isactive($uid, "F");
        $this->gdlog()->LogInfoEndFUNCTION("updateRecordTaskControlDeactivate");
        return $fr;
    }
    
    function updateRecordTaskControlActivate($uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("updateRecordTaskControlActivate");
        $fr = $this->updateRecordTaskControl_Isactive($uid, "T");
        $this->gdlog()->LogInfoEndFUNCTION("updateRecordTaskControlActivate");
        return $fr;
    }
    
    private function updateRecordTaskControl_Isactive($uid, $isactive)
    {
        $this->gdlog()->LogInfoStartFUNCTION("updateRecordTaskControl_Isactive");
        $this->cleanResult_Record();
        $sqlstmnt = "UPDATE usersafety_task_control_links SET ".
            "changeddt=NOW(), ".
            "isactive=:isactive ".
            "WHERE uid=:uid";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":uid", $uid);
        $appcon->bindParam(":isactive", strtoupper($isactive));
        $appcon->execUpdate();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getRowfromLastId($appcon, "usersafety_task_control_links", $appcon->getLastInsertID()));
                $this->gdlog()->LogInfoDB($this->getResult_Record());
                $fr = $this->saveActivityLog("RECORD_IS_UPDATED", "Record is Created:".json_encode($this->getResult_Record()).":");
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
        $this->gdlog()->LogInfoEndFUNCTION("updateRecordTaskControl_Isactive");
        return $fr;
    }
    
    function getUid() { return $this->getResult_RecordField("uid"); }
    function getTasKKey() { return $this->getResult_RecordField("task_key"); }
    function getUid1() { return $this->getResult_RecordField("uid1"); }
    function getUid2() { return $this->getResult_RecordField("uid2"); }
    function getUid3() { return $this->getResult_RecordField("uid3"); }
    function getRecordUid() { return $this->getResult_RecordField("record_uid"); }
    function getIsactive() { return $this->getResult_RecordField("isactive"); }
}?>
        
    