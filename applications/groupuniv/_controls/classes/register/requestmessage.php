<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/**
 * Author: Stephen Shellenberger
 * Copyright: 2013 Stephen Shellenberger
 * Date: 2013/01/05
 */

class zRegisterRequestMessage
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
    function registerRequestMessage($who_sent_user_account_uid, $who_approves_user_account_uid, $who_receives_user_account_uid
                                    , $request_content, $group_account_uid, $status = "P")
    {
        $this->gdlog()->LogInfoStartFUNCTION("registerRequestMessage");
        $utk = $this->getGDConfig()->getSessUnivTblKey();
        $fr;
        $sqlstmnt = "INSERT INTO ".$utk."group_request_message SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "who_sent_user_account_uid=:who_sent_user_account_uid, ".
            "who_approves_user_account_uid=:who_approves_user_account_uid, ".
            "who_receives_user_account_uid=:who_receives_user_account_uid, ".
            "status=:status, ".
            "request_content=:request_content, ".
            "group_account_uid=:group_account_uid";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":who_sent_user_account_uid", $who_sent_user_account_uid);
        $dbcontrol->bindParam(":who_approves_user_account_uid", $who_approves_user_account_uid);
        $dbcontrol->bindParam(":who_receives_user_account_uid", $who_receives_user_account_uid);
        $dbcontrol->bindParam(":request_content", $request_content);
        $dbcontrol->bindParam(":group_account_uid", $group_account_uid);
        $dbcontrol->bindParam(":status", strtoupper($status));
        $dbcontrol->execUpdate();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResult_RequestMessage($dbcontrol->getRowfromLastId($dbcontrol, $utk."group_request_message", $dbcontrol->getLastInsertID()));
                $this->gdlog()->LogInfoDB($this->getResult_RequestMessage());
                $fr = $this->saveActivityLog("REQUEST_MESSAGE_IS_REGISTERED", "Register Message has been registered:".json_encode($this->getResult_RequestMessage()).":");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("REQUEST_MESSAGE_IS_NOT_REGISTERED");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("registerRequestMessage");
        return $fr;
    }

    /**
     * Register Response Message.
     * $uid = Wuid for messsage
     * $response_content = Response Message
     * $status = P=Pending; A=Accepted; D=Declined;
     **/
    function registerResponseMessage($uid, $response_content, $status =  "D")
    {
        $this->gdlog()->LogInfoStartFUNCTION("registerResponseMessage");
        $fr;
        $sqlstmnt = "UPDATE ".$utk."group_request_message SET response_content=:response_content, status=:status ".
            "WHERE uid=:uid";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":uid", $uid);
        $dbcontrol->bindParam(":response_content", $response_content);
        $dbcontrol->bindParam(":status", strtoupper($status));
                $dbcontrol->execUpdate();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResult_RequestMessage($dbcontrol->getRowfromLastUid($dbcontrol, $utk."group_request_message", $uid));
                $this->gdlog()->LogInfoDB($this->getResult_RequestMessage());
                $fr = $this->saveActivityLog("REQUEST_RESPONSE_MESSAGE_IS_REGISTERED", "Register Response Message has been registered:".json_encode($this->getResult_RequestMessage()).":");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("REQUEST_RESPONSE_MESSAGE_IS_NOT_REGISTERED");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("registerResponseMessage");
        return $fr;
    }

    private $Result_RequestMessage = "NO_RECORD";
    function setResult_RequestMessage($row)
    {
        $this->Result_RequestMessage = $row;
    }    
    
    function getResult_RequestMessage()
    {
        return $this->Result_RequestMessage;
    }
    
    function getUid(){return $this->Result_RequestMessage["uid"];}
    function getWhoSentUserAccountUid(){return $this->Result_RequestMessage["who_sent_user_account_uid"];}
    function getWhoApprovesUserAccountUid(){return $this->Result_RequestMessage["who_approves_user_account_uid"];}
    function getWhoReceivesUserAccountUid(){return $this->Result_RequestMessage["who_receives_user_account_uid"];}
    function getRequestContent(){return $this->Result_RequestMessage["request_content"];}
    function getGroupAccountUid(){return $this->Result_RequestMessage["group_account_uid"];}
    function geStatus(){return $this->Result_RequestMessage["status"];}
    function getResponseContent(){return $this->Result_RequestMessage["response_content"];}
}
?>