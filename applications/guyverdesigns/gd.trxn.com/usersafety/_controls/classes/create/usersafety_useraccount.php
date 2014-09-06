<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class gdCreateUsersafetyAccount
    extends zAppBaseObject
{
    function __construct()
    {
    }
    
    function createRecordUserAccount($email, $nickname, $password)
    {
        $this->gdlog()->LogInfoStartFUNCTION("createRecordUserAccount");
        $sqlstmnt = "INSERT INTO usersafety_useraccount SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "email=:email, ".
            "password=:password, ".
            "isactive=:isactive, ".
            "changepassword=:changepassword, ".
            "numberoflogintries=:numberoflogintries, ".
            "usertablekey=:usertablekey, ".
            "nickname=:nickname";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":email", $email);
        $appcon->bindParam(":nickname", $nickname);
        $appcon->bindParam(":password", $password);
        $appcon->bindParam(":usertablekey", strtolower($this->createUserTableKey($nickname)));
        $appcon->bindParam(":isactive", "F");
        $appcon->bindParam(":changepassword", "F");
        $appcon->bindParam(":numberoflogintries", 0);
        $appcon->execUpdate();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getRowfromLastId($appcon, "usersafety_useraccount", $appcon->getLastInsertID()));
                $this->gdlog()->LogInfoDB($this->getResult_Record());
                $fr = $this->saveActivityLog("RECORD_IS_CREATED", "Record is Created:".json_encode($this->getResult_Record()).":");
                $this->gdlog()->LogInfo("this->getNummberoflogintries() - {".($this->getNumberoflogintries() + 1)."}");
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
        $this->gdlog()->LogInfoEndFUNCTION("createRecordUserAccount");
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