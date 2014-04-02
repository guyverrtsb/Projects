<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class gdFindUsersafetyTaskControlLinks
    extends zAppBaseObject
{
    function __construct()
    {
    }
    
    function findUsersafetyTaskControlLinks_byUid($uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findUsersafetyTaskControlLinks_byUid");
        $this->cleanResult_Record();
        $sqlstmnt = "SELECT * FROM usersafety_task_control_links ".
            "WHERE uid=:uid";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":uid", $uid);
        $appcon->execSelect();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getStatement()->fetch(PDO::FETCH_ASSOC));
                $this->gdlog()->LogInfoDB($this->getResult_Record());
                $fr = $this->saveActivityLog("RECORD_IS_FOUND", "Record is found:".json_encode($this->getResult_Record()).":");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("RECORD_IS_NOT_FOUND");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("findUsersafetyTaskControlLinks_byUid");
        return $fr;
    }
    
    function findUsersafetyTaskControlLinks_byUid1Uid2Uid3_Valid30Minutes($uid1, $uid2, $uid3)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findUsersafetyTaskControlLinks_byUid1Uid2Uid3_Valid30Minutes");
        $this->cleanResult_Record();
        $sqlstmnt = "SELECT * FROM usersafety_task_control_links ".
            "WHERE uid1=:uid1 ".
            "AND uid2=:uid2 ".
            "AND uid3=:uid3 ".
            "AND createddt >= DATE_SUB(NOW(), INTERVAL (60 * 26) SECOND)";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":uid1", $uid1);
        $appcon->bindParam(":uid2", $uid2);
        $appcon->bindParam(":uid3", $uid3);
        $appcon->execSelect();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getStatement()->fetch(PDO::FETCH_ASSOC));
                $this->gdlog()->LogInfoDB($this->getResult_Record());
                $fr = $this->saveActivityLog("RECORD_IS_FOUND", "Record is found:".json_encode($this->getResult_Record()).":");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("RECORD_IS_NOT_FOUND");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("findUsersafetyTaskControlLinks_byUid1Uid2Uid3_Valid30Minutes");
        return $fr;
    }
    
    function findUsersafetyTaskControlLinks_byUid1Uid2Uid3($uid1, $uid2, $uid3)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findUsersafetyTaskControlLinks_byUid1Uid2Uid3");
        $this->cleanResult_Record();
        $sqlstmnt = "SELECT * FROM usersafety_task_control_links ".
            "WHERE uid1=:uid1 ".
            "AND uid2=:uid2 ".
            "AND uid3=:uid3";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":uid1", $uid1);
        $appcon->bindParam(":uid2", $uid2);
        $appcon->bindParam(":uid3", $uid3);
        $appcon->execSelect();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getStatement()->fetch(PDO::FETCH_ASSOC));
                $this->gdlog()->LogInfoDB($this->getResult_Record());
                $fr = $this->saveActivityLog("RECORD_IS_FOUND", "Record is found:".json_encode($this->getResult_Record()).":");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("RECORD_IS_NOT_FOUND");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("findUsersafetyTaskControlLinks_byUid1Uid2Uid3");
        return $fr;
    }
    
    function findUsersafetyTaskControlLinks_byRecordUid($record_uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findUsersafetyTaskControlLinks_byRecordUid");
        $this->cleanResult_Records();
        $sqlstmnt = "SELECT * FROM usersafety_task_control_links".
            "WHERE record_uid=:record_uid";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":record_uid", $record_uid);
        $appcon->execSelect();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Records($appcon->getStatement()->fetchAll(PDO::FETCH_ASSOC));
                $this->gdlog()->LogInfoDB($this->getResult_Records());
                $fr = $this->saveActivityLog("RECORDS_ARE_FOUND", "Record is found:".json_encode($this->getResult_Records()).":");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("RECORDS_ARE_NOT_FOUND");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("findUsersafetyTaskControlLinks_byRecordUid");
        return $fr;
    }
    
    function getUid() { return $this->getResult_RecordField("uid"); }
    function getTasKKey() { return $this->getResult_RecordField("task_key"); }
    function getUid1() { return $this->getResult_RecordField("uid1"); }
    function getUid2() { return $this->getResult_RecordField("uid2"); }
    function getUid3() { return $this->getResult_RecordField("uid3"); }
    function getRecordUid() { return $this->getResult_RecordField("record_uid"); }
    function getIsactive() { return $this->getResult_RecordField("isactive"); }
}
?>