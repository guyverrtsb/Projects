<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class gdUpdateMatchAccounttoRole
    extends zAppBaseObject
{
    function __construct()
    {
    }
    
    function updateRecordUserAccounttoRole($usersafety_useraccount_uid, $usersafety_role_uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("updateRecordUserAccounttoRole");
        $this->cleanResult_Record();
        
        $sqlstmnt = "UPDATE match_usersafety_useraccount_to_role SET ".
            "changeddt=NOW(), ".
            "usersafety_role_uid=:usersafety_role_uid ".
            "WHERE usersafety_useraccount_uid=:usersafety_useraccount_uid";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":usersafety_role_uid", $usersafety_role_uid);
        $appcon->bindParam(":usersafety_useraccount_uid", $usersafety_useraccount_uid);
        $appcon->execUpdate();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getRowfromLastId($appcon, "match_usersafety_useraccount_to_role", $appcon->getLastInsertID()));
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
        
        $this->gdlog()->LogInfoEndFUNCTION("updateRecordUserAccounttoRole");
        return $fr;
    }
}
?>