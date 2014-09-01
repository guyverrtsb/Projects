<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class gdCreateTaskControl
    extends zAppBaseObject
{
    function __construct()
    {
    }
    
    function createRecordTaskControl($task_key,
                                    $record_uid,
                                    $isactive)
    {
        $this->gdlog()->LogInfoStartFUNCTION("createRecordTaskControl");
        $this->cleanResult_Record();
        $sqlstmnt = "INSERT INTO usersafety_task_control_links SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "uid1=UUID(), ".
            "uid2=UUID(), ".
            "uid3=UUID(), ".
            "task_key=:task_key, ".
            "record_uid=:record_uid, ".
            "isactive=:isactive";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":task_key", $task_key);
        $appcon->bindParam(":record_uid", $record_uid);
        $appcon->bindParam(":isactive", $isactive);
        $appcon->execUpdate();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getRowfromLastId($appcon, "usersafety_task_control_links", $appcon->getLastInsertID()));
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
        $this->gdlog()->LogInfoEndFUNCTION("createRecordTaskControl");
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
        
    