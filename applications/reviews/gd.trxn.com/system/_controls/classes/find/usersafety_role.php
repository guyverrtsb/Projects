<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class gdFindUsersafetyRole
    extends zAppBaseObject
{
    function __construct()
    {
    }
    
    function findUsersafetyRole_bySdesc($sdesc)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findUsersafetyRole_bySdesc");
        $this->cleanResult_Record();
        $sqlstmnt = "SELECT * FROM usersafety_role ".
            "WHERE sdesc=:sdesc";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":sdesc", $sdesc);
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
        $this->gdlog()->LogInfoEndFUNCTION("findUsersafetyRole_bySdesc");
        return $fr;
    }
    
    function findUsersafetyRole_byUid($uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findUsersafetyRole_byUid");
        $this->cleanResult_Record();
        $sqlstmnt = "SELECT * FROM usersafety_role ".
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
        $this->gdlog()->LogInfoEndFUNCTION("findUsersafetyRole_byUid");
        return $fr;
    }
    
    function findUsersafetyRoles()
    {
        $this->gdlog()->LogInfoStartFUNCTION("findUsersafetyRoles");
        $this->cleanResult_Records();
        $sqlstmnt = "SELECT * FROM usersafety_role";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->execSelect();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Records($appcon->getStatement()->fetchAll(PDO::FETCH_ASSOC));
                $this->gdlog()->LogInfoDB($this->getResult_Records());
                $fr = $this->saveActivityLog("RECORDS_ARE_FOUND", "Records are found:".json_encode($this->getResult_Records()).":");
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
        $this->gdlog()->LogInfoEndFUNCTION("findUsersafetyRoles");
        return $fr;
    }
    
    function getUid() { return $this->getResult_RecordField("uid"); }
    function getEmail() { return $this->getResult_RecordField("sdesc"); }
    function getNickname() { return $this->getResult_RecordField("ldesc"); }
    function getPassword() { return $this->getResult_RecordField("priority"); }
}?>
        
    