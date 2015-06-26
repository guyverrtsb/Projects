<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/**
 * Author: Stephen Shellenberger
 * Copyright: 2013 Stephen Shellenberger
 * Date: 2013/01/05
 */

class zRegisterMessage
    extends zAppBaseObject
{
    /**
     * Register Request Message.
     * $cfg_message_type_sdesc = Message type
     * $subject = subject of message
     * $content = Message content
     * $to_user_account_uid = To account uid
     * $from_user_account_uid = From account uid
     * $utk = table key
     * $object_uid - object attachement or refrence
     * $isread = default F for not read
     * $reply_message_uid = message this one is replying to
     **/
    function registerMessage($cfg_message_type_sdesc,
                            $subject,
                            $content,
                            $to_user_account_uid,
                            $from_user_account_uid,
                            $utk,
                            $object_uid,
                            $isread = "F",
                            $reply_message_uid = "TOP_LEVEL_MESSAGE")
    {
        $this->gdlog()->LogInfoStartFUNCTION("registerMessage");
        $fr;
        $sqlstmnt = "INSERT INTO ".$utk."messages SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "cfg_message_type_uid=:cfg_message_type_uid, ".
            "subject=:subject, ".
            "content=:content, ".
            "to_user_account_uid=:to_user_account_uid, ".
            "from_user_account_uid=:from_user_account_uid, ".
            "isread=:isread, ".
            "object_uid=:object_uid, ".
            "reply_message_uid=:reply_message_uid";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":cfg_message_type_uid", $this->findCfgUidfromSdesc($cfg_message_type_sdesc));
        $dbcontrol->bindParam(":subject", $subject);
        $dbcontrol->bindParam(":content", $content);
        $dbcontrol->bindParam(":to_user_account_uid", $to_user_account_uid);
        $dbcontrol->bindParam(":from_user_account_uid", $from_user_account_uid);
        $dbcontrol->bindParam(":isread", strtoupper($isread));
        $dbcontrol->bindParam(":object_uid", $object_uid);
        $dbcontrol->bindParam(":reply_message_uid", $reply_message_uid);
                $dbcontrol->execUpdate();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResult_Message($dbcontrol->getRowfromLastId($dbcontrol, $utk."messages", $dbcontrol->getLastInsertID()));
                $this->gdlog()->LogInfoDB($this->getResult_Message());
                $fr = $this->saveActivityLog("MESSAGE_IS_REGISTERED", "Register Message has been registered:".json_encode($this->getResult_Message()).":");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("MESSAGE_IS_NOT_REGISTERED");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("registerMessage");
        return $fr;
    }

    private $Result_Message = "NO_RECORD";
    function setResult_Message($row)
    {
        $this->Result_Message = $row;
    }    
    
    function getResult_Message()
    {
        return $this->Result_Message;
    }
    
    function getUid(){return $this->Result_Message["uid"];}
    function getCfgMessageTypeUid(){return $this->Result_Message["cfg_message_type_uid"];}
    function getContent(){return $this->Result_Message["content"];}
    function getToUserAccountUid(){return $this->Result_Message["to_user_account_uid"];}
    function getFromUserAccountUid(){return $this->Result_Message["from_user_account_uid"];}
    function geIsRead(){return $this->Result_Message["isread"];}
}
?>