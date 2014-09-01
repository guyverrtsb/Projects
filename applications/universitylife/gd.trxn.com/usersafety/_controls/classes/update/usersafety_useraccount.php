<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class gdUpdateUsersafetyAccount
    extends zAppBaseObject
{
    function __construct()
    {
    }
    
    function updateRecordUserAccount_UEN($uid, $email, $nickname)
    {
        $this->gdlog()->LogInfoStartFUNCTION("updateRecordUserAccount_UEN");
        $this->cleanResult_Record();
        $sqlstmnt = "UPDATE usersafety_useraccount SET ".
            "changeddt=NOW(), ".
            "email=:email, ".
            "nickname=:nickname, ".
            "WHERE uid=:uid";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":uid", $uid);
        $appcon->bindParam(":email", $email);
        $appcon->bindParam(":nickname", $nickname);
        $appcon->execUpdate();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getRowfromLastId($appcon, "usersafety_useraccount", $appcon->getLastInsertID()));
                $this->gdlog()->LogInfoDB($this->getResult_Record());
                $fr = $this->saveActivityLog("RECORD_IS_UPDATED", "Record is Updated:".json_encode($this->getResult_Record()).":");
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
        $this->gdlog()->LogInfoEndFUNCTION("updateRecordUserAccount_UEN");
        return $fr;
    }
    
    function updateRecordUserAccount($uid, $email, $password, $nickname, $isactive, $changepassword, $numberoflogintries)
    {
        $this->gdlog()->LogInfoStartFUNCTION("updateRecordUserAccount");
        $this->cleanResult_Record();
        $sqlstmnt = "UPDATE usersafety_useraccount SET ".
            "changeddt=NOW(), ".
            "email=:email, ".
            "password=:password, ".
            "nickname=:nickname, ".
            "isactive=:isactive, ".
            "changepassword=:changepassword, ".
            "numberoflogintries=:numberoflogintries ".
            "WHERE uid=:uid";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":uid", $uid);
        $appcon->bindParam(":email", $email);
        $appcon->bindParam(":password", $password);
        $appcon->bindParam(":nickname", $nickname);
        $appcon->bindParam(":isactive", $isactive);
        $appcon->bindParam(":changepassword", $changepassword);
        $appcon->bindParam(":numberoflogintries", $numberoflogintries);
        $appcon->execUpdate();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getRowfromLastId($appcon, "usersafety_useraccount", $appcon->getLastInsertID()));
                $this->gdlog()->LogInfoDB($this->getResult_Record());
                $fr = $this->saveActivityLog("RECORD_IS_UPDATED", "Record is Updated:".json_encode($this->getResult_Record()).":");
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
        $this->gdlog()->LogInfoEndFUNCTION("updateRecordUserAccount");
        return $fr;
    }

    function updateActivateUser($uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("updateActivateUser");
        $this->cleanResult_Record();
        
        $fr = $this->updateRecordUserAccount_Isactive($uid, "T");
        
        $this->gdlog()->LogInfoEndFUNCTION("updateActivateUser");
        return $fr;
    }
    
    function updateDeactivateUser($uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("updateDeactivateUser");
        $this->cleanResult_Record();
        
        $fr = $this->updateRecordUserAccount_Isactive($uid, "F");
        
        $this->gdlog()->LogInfoEndFUNCTION("updateDeactivateUser");
        return $fr;
    }
    
    function updateRecordUserAccount_Isactive($uid, $isactive)
    {
        $this->gdlog()->LogInfoStartFUNCTION("updateRecordUserAccount_Isactive");
        $this->cleanResult_Record();
        $sqlstmnt = "UPDATE usersafety_useraccount SET ".
            "changeddt=NOW(), ".
            "isactive=:isactive ".
            "WHERE uid=:uid";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":uid", $uid);
        $appcon->bindParam(":isactive", $isactive);
        $appcon->execUpdate();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getRowfromLastId($appcon, "usersafety_useraccount", $appcon->getLastInsertID()));
                $this->gdlog()->LogInfoDB($this->getResult_Record());
                $fr = $this->saveActivityLog("RECORD_IS_UPDATED", "Record is Updated:".json_encode($this->getResult_Record()).":");
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
        $this->gdlog()->LogInfoEndFUNCTION("updateRecordUserAccount_Isactive");
        return $fr;
    }
    
    function updateRecordUserAccount_Numberoflogintries($uid, $numberoflogintries)
    {
        $this->gdlog()->LogInfoStartFUNCTION("updateRecordUserAccount_Numberoflogintries");
        $this->cleanResult_Record();
        $sqlstmnt = "UPDATE usersafety_useraccount SET ".
            "changeddt=NOW(), ".
            "numberoflogintries=:numberoflogintries ".
            "WHERE uid=:uid";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":uid", $uid);
        $appcon->bindParam(":numberoflogintries", $numberoflogintries);
        $appcon->execUpdate();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getRowfromLastId($appcon, "usersafety_useraccount", $appcon->getLastInsertID()));
                $this->gdlog()->LogInfoDB($this->getResult_Record());
                $fr = $this->saveActivityLog("RECORD_IS_UPDATED", "Record is Updated:".json_encode($this->getResult_Record()).":");
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
        $this->gdlog()->LogInfoEndFUNCTION("updateRecordUserAccount_Numberoflogintries");
        return $fr;
    }
    
    function updateChangePasswordTrue($uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("updateChangePasswordTrue");
        $this->cleanResult_Record();
        
        $fr = $this->updateRecordUserAccount_Changepassword($uid, "T");
        
        $this->gdlog()->LogInfoEndFUNCTION("updateChangePasswordTrue");
        return $fr;
    }
    
    function updateChangePasswordFalse($uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("updateChangePasswordFalse");
        $this->cleanResult_Record();
        
        $fr = $this->updateRecordUserAccount_Changepassword($uid, "F");
        
        $this->gdlog()->LogInfoEndFUNCTION("updateChangePasswordFalse");
        return $fr;
    }
    
    function updateRecordUserAccount_Changepassword($uid, $changepassword)
    {
        $this->gdlog()->LogInfoStartFUNCTION("updateRecordUserAccount_Changepassword");
        $this->cleanResult_Record();
        $sqlstmnt = "UPDATE usersafety_useraccount SET ".
            "changeddt=NOW(), ".
            "changepassword=:changepassword ".
            "WHERE uid=:uid";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":uid", $uid);
        $appcon->bindParam(":changepassword", $changepassword);
        $appcon->execUpdate();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getRowfromLastId($appcon, "usersafety_useraccount", $appcon->getLastInsertID()));
                $this->gdlog()->LogInfoDB($this->getResult_Record());
                $fr = $this->saveActivityLog("RECORD_IS_UPDATED", "Record is Updated:".json_encode($this->getResult_Record()).":");
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
        $this->gdlog()->LogInfoEndFUNCTION("updateRecordUserAccount_Changepassword");
        return $fr;
    }
    
    function getUid() { return $this->getResult_RecordField("uid"); }
    function getEmail() { return $this->getResult_RecordField("email"); }
    function getPassword() { return $this->getResult_RecordField("password"); }
    function getNickname() { return $this->getResult_RecordField("nickname"); }
    function getUsertablekey() { return $this->getResult_RecordField("usertablekey"); }
    function getIsactive() { return $this->getResult_RecordField("isactive"); }
    function getChangepassword() { return $this->getResult_RecordField("changepassword"); }
    function getNumberoflogintries() { return $this->getResult_RecordField("numberoflogintries"); }
}
?>