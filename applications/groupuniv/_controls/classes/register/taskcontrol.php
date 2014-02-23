<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/**
 * Author: Stephen Shellenberger
 * Copyright: 2013 Stephen Shellenberger
 * Date: 2013/01/05
 * This Class file is for Registering User Data
 
 */

class zRegisterTaskControl
    extends zAppBaseObject
{
    private $task_uid;
    
    function __construct()
    {

    }
    
    /**
     * Register User Account.
     * $email = email account;
     * $password = password;
     */
    function registerTask($task_key, $record_uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("registerTask");
        $fr;
        $task_key = strtoupper($task_key);
        $sqlstmnt = "INSERT INTO task_control_links SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "uid1=UUID(), uid2=UUID(), uid3=UUID(), ".
            "task_key=:task_key, ".
            "record_uid=:record_uid, ".
            "isactive=:isactive";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":record_uid", $record_uid);
        $dbcontrol->bindParam(":task_key", $task_key);
        $dbcontrol->bindParam(":isactive", "T");
        $dbcontrol->execUpdate();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResult_TempLink($dbcontrol->getRowfromLastId($dbcontrol, "task_control_links", $dbcontrol->getLastInsertID()));
                $this->gdlog()->LogInfoDB($this->getResult_TempLink());
                $fr = $this->saveActivityLog("TASK_IS_REGISTERED","Account has been registered:".json_encode($this->getResult_TempLink()).":");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("TASK_IS_NOT_REGISTERED");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("registerTask");
        return $fr;
    }

    function registerDeactivateTask($uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("registerDeactivateTask");
        $fr;
        $sqlstmnt = "UPDATE task_control_links SET active=:active ".
            "WHERE uid=:uid";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":uid", $uid);
        $dbcontrol->bindParam(":active", "F");
        $dbcontrol->execUpdate();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $fr = $this->gdlog()->LogInfoRETURN("TASK_LINK_DEACTIVATED");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("TASK_LINK_NOT_DEACTIVATED");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("registerDeactivateTask");
        return $fr;
    }

    private $Result_TempLink = "NO_RECORD";
    function setResult_TempLink($row)
    {
        $this->Result_TempLink = $row;
    }
    
    function getResult_TempLink()
    {
        return $this->Result_TempLink;
    }
    
    function getTL_Uid(){return $this->Result_TempLink["uid"];}
    function getTaskKey(){return $this->Result_TempLink["task_key"];}
    function getUid1(){return $this->Result_TempLink["uid1"];}
    function getUid2(){return $this->Result_TempLink["uid2"];}
    function getUid3(){return $this->Result_TempLink["uid3"];}
    function getRecordUid(){return $this->Result_TempLink["record_uid"];}
    function getIsActive(){return $this->Result_TempLink["isactive"];}
    
    function getTempLink()
    {
        $tl = $this->getUid1().":".$this->getUid2().":".$this->getUid3();
        return $tl;
    }
}
?>