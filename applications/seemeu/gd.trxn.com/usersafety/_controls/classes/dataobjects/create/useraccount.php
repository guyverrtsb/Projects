<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/base/user.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class CreateUserAccount
    extends UserBase
{
    function __construct()
    {
    }
    
    function basic($email,
                $nickname,
                $password)
    {
        zLog()->LogInfoStartFUNCTION("basic");
        $sqlstmnt = "INSERT INTO useraccount SET 
            uid=UUID(), createddt=NOW(), changeddt=NOW(),
            email=:email,
            password=:password,
            nickname=:nickname,
            usertablekey=:usertablekey,
            isactive=:isactive,
            changepassword=:changepassword,
            numberoflogintries=:numberoflogintries";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":email", $email);
        $appcon->bindParam(":nickname", $nickname);
        $appcon->bindParam(":password", $password);
        $appcon->bindParam(":usertablekey", $this->createUserTableKey($nickname));
        $appcon->bindParam(":isactive", "F");
        $appcon->bindParam(":changepassword", "F");
        $appcon->bindParam(":numberoflogintries", 0);
        $appcon->execUpdate();
        
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getRowfromLastId($appcon, "useraccount", $appcon->getLastInsertID()));
                zLog()->LogInfoDB($this->getResult_Record());
                $fr = $this->saveActivityLog("RECORD_IS_CREATED", "Record is Created:".json_encode($this->getResult_Record()).":");
                zLog()->LogInfo("this->getNummberoflogintries() - {".($this->getNumberoflogintries() + 1)."}");
            }
            else
            {
                $fr = zLog()->LogInfoRETURN("RECORD_IS_NOT_CREATED");
            }
        }
        else
        {
            $fr = zLog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        zLog()->LogInfoEndFUNCTION("basic");
        return $fr;
    }
}
?>