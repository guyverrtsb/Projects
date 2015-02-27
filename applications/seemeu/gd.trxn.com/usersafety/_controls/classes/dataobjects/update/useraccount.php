<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/base/user.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class UpdateUserAccount
    extends UserBase
{
    function __construct()
    {
    }
    
    function updateAllbyUid($uid,
                            $email,
                            $password,
                            $nickname,
                            $isactive,
                            $changepassword,
                            $numberoflogintries)
    {
        zcLog()->LogInfoStartFUNCTION("updateAllbyUid");
        $sqlstmnt = "UPDATE useraccount SET ".
            "changeddt=NOW(), ".
            "email=:email, ".
            "password=:password, ".
            "nickname=:nickname, ".
            "isactive=:isactive, ".
            "changepassword=:changepassword, ".
            "numberoflogintries=:numberoflogintries ".
            "WHERE uid=:uid";
        
        $appcon = new SysConnections();
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
                $this->setResult_Record($appcon->getRowfromLastId($appcon, "useraccount", $appcon->getLastInsertID()));
                zcLog()->LogInfoDB($this->getResult_Record());
                $fr = $this->saveActivityLog("RECORD_IS_UPDATED", "Record is Updated:".json_encode($this->getResult_Record()).":");
            }
            else
            {
                $fr = zcLog()->LogInfoRETURN("RECORD_IS_NOT_UPDATED");
            }
        }
        else
        {
            $fr = zcLog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        zcLog()->LogInfoEndFUNCTION("updateAllbyUid");
        return $fr;
    }
}
?>