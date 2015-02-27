<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/base/user.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class RetrieveUserAccount
    extends UserBase
{
    function __construct()
    {
    }
    
    /**
     * Retrieve Record by Email
     */
    function byEmail($email)
    {
        zcLog()->LogInfoStartFUNCTION("byEmail");
        $sqlstmnt = "SELECT * FROM useraccount ".
            "WHERE email=:email";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":email", $email);
        $appcon->execSelect();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getStatement()->fetch(PDO::FETCH_ASSOC));
                zcLog()->LogInfoDB($this->getResult_Record());
                $fr = $this->saveActivityLog("RECORD_IS_FOUND", "Record is found:".json_encode($this->getResult_Record()).":");
            }
            else
            {
                $fr = zcLog()->LogInfoRETURN("RECORD_IS_NOT_FOUND");
            }
        }
        else
        {
            $fr = zcLog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        zcLog()->LogInfoEndFUNCTION("byEmail");
        return $fr;
    }
    
    /**
     * Retrieve Record by Nickname
     */
    function byNickname($nickname)
    {
        zcLog()->LogInfoStartFUNCTION("byEmail");
        $sqlstmnt = "SELECT * FROM useraccount ".
            "WHERE nickname=:nickname";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":nickname", $nickname);
        $appcon->execSelect();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getStatement()->fetch(PDO::FETCH_ASSOC));
                zcLog()->LogInfoDB($this->getResult_Record());
                $fr = $this->saveActivityLog("RECORD_IS_FOUND", "Record is found:".json_encode($this->getResult_Record()).":");
            }
            else
            {
                $fr = zcLog()->LogInfoRETURN("RECORD_IS_NOT_FOUND");
            }
        }
        else
        {
            $fr = zcLog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        zcLog()->LogInfoEndFUNCTION("byEmail");
        return $fr;
    }
    
    /**
     * Retrieve Record by Tablekey
     */
    function byTablekey($tablekeyexists)
    {
        zcLog()->LogInfoStartFUNCTION("byEmail");
        $sqlstmnt = "SELECT * FROM useraccount ".
            "WHERE tablekeyexists=:tablekeyexists";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":tablekeyexists", $tablekeyexists);
        $appcon->execSelect();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getStatement()->fetch(PDO::FETCH_ASSOC));
                zcLog()->LogInfoDB($this->getResult_Record());
                $fr = $this->saveActivityLog("RECORD_IS_FOUND", "Record is found:".json_encode($this->getResult_Record()).":");
            }
            else
            {
                $fr = zcLog()->LogInfoRETURN("RECORD_IS_NOT_FOUND");
            }
        }
        else
        {
            $fr = zcLog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        zcLog()->LogInfoEndFUNCTION("byEmail");
        return $fr;
    }
}
?>