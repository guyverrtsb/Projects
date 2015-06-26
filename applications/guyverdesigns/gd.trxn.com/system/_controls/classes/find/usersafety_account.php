<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class gdFindUsersafetyAccount
    extends zAppBaseObject
{
    function __construct()
    {
    }
    
    function findUsersafetyAccount_byEmail($email)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findUsersafetyAccount_byEmail");
        $this->cleanResult_Record();
        $sqlstmnt = "SELECT * FROM usersafety_useraccount ".
            "WHERE email=:email";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":email", $email);
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
        $this->gdlog()->LogInfoEndFUNCTION("findUsersafetyAccount_byEmail");
        return $fr;
    }
    
    function findUsersafetyAccount_byNickname($nickname)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findUsersafetyAccount_byNickname");
        $this->cleanResult_Record();
        $sqlstmnt = "SELECT * FROM usersafety_useraccount ".
            "WHERE nickname=:nickname";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":nickname", $nickname);
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
        $this->gdlog()->LogInfoEndFUNCTION("findUsersafetyAccount_byNickname");
        return $fr;
    }
    
    function findUsersafetyAccount_byUsertablekey($nickname)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findUsersafetyAccount_byUsertablekey");
        $this->cleanResult_Record();
        $sqlstmnt = "SELECT * FROM usersafety_useraccount ".
            "WHERE usertablekey=:usertablekey";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":usertablekey", $this->createUserTableKey($nickname));
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
        $this->gdlog()->LogInfoEndFUNCTION("findUsersafetyAccount_byUsertablekey");
        return $fr;
    }
    
    function findUsersafetyAccount_byUid($uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findUsersafetyAccount_byUid");
        $this->cleanResult_Record();
        $sqlstmnt = "SELECT * FROM usersafety_useraccount ".
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
        $this->gdlog()->LogInfoEndFUNCTION("findUsersafetyAccount_byUid");
        return $fr;
    }
    
    function findUsersafetyAccounts()
    {
        $this->gdlog()->LogInfoStartFUNCTION("findUsersafetyAccounts");
        $this->cleanResult_Records();
        $sqlstmnt = "SELECT * FROM usersafety_useraccount";
        
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
        $this->gdlog()->LogInfoEndFUNCTION("findUsersafetyAccounts");
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
}?>
        
    