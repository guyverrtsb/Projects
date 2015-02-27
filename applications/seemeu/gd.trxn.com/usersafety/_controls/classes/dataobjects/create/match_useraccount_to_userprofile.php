<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/base/user.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class CreateMatchUserAccounttoUserProfile
    extends UserBase
{
    function __construct()
    {
    }
    
    function basic($useraccount_uid,
                $userprofile_uid)
    {
        zLog()->LogInfoStartFUNCTION("basic");
        $sqlstmnt = "INSERT INTO match_useraccount_to_userprofile SET 
            uid=UUID(), createddt=NOW(), changeddt=NOW(),
            useraccount_uid=:useraccount_uid,
            userprofile_uid=:userprofile_uid";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":useraccount_uid", $useraccount_uid);
        $appcon->bindParam(":userprofile_uid", $userprofile_uid);
        $appcon->execUpdate();
        
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getRowfromLastId($appcon, "match_useraccount_to_userprofile", $appcon->getLastInsertID()));
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