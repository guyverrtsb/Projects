<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/**
 * Author: Stephen Shellenberger
 * Copyright: 2013 Stephen Shellenberger
 * Date: 2013/01/05
 */

class zRegisterNotification
    extends zAppBaseObject
{
    /**
     * Register Request Message.
     * $who_sent_user_account_uid = Who has sent the Request
     * $who_approves_user_account_uid = Who is supposed to Approve the Request
     * $who_receives_user_account_uid = Who Receives the Approval or Denial response
     * $request_content = Content used for the Request.  This is viewed by Approver;
     * $status = P=Pending; A=Accepted; D=Declined;
     **/
    function registerNotification($cfg_message_type_sdesc,
                                $message_uid,
                                $utk,
                                $isread = "F")
    {
        $this->gdlog()->LogInfoStartFUNCTION("registerNotification");
        $fr;
        $sqlstmnt = "INSERT INTO ".$utk."notifications SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "cfg_message_type_uid=:cfg_message_type_uid, ".
            "message_uid=:message_uid, ".
            "isread=:isread";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":cfg_message_type_uid", $this->findCfgUidfromSdesc($cfg_message_type_sdesc));
        $dbcontrol->bindParam(":message_uid", $message_uid);
        $dbcontrol->bindParam(":isread", $isread);
        $dbcontrol->execUpdate();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResult_Notification($dbcontrol->getRowfromLastId($dbcontrol, $utk."notifications", $dbcontrol->getLastInsertID()));
                $this->gdlog()->LogInfoDB($this->getResult_Notification());
                $fr = $this->saveActivityLog("NOTIFICATION_IS_REGISTERED", "Register Notification has been registered:".json_encode($this->getResult_Notification()).":");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("NOTIFICATION_IS_NOT_REGISTERED");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("registerNotification");
        return $fr;
    }

    private $Result_Notification = "NO_RECORD";
    function setResult_Notification($row)
    {
        $this->Result_Notification = $row;
    }    
    
    function getResult_Notification()
    {
        return $this->Result_Notification;
    }
    
    function getUid(){return $this->Result_Notification["uid"];}
    function getCfgMessageTypeUid(){return $this->Result_Notification["cfg_message_type_sdesc"];}
    function getMessageUid(){return $this->Result_Notification["message_uid"];}
    function getIsRead(){return $this->Result_Notification["isread"];}
}
?>