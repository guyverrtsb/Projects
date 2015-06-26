<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/**
 * Author: Stephen Shellenberger
 * Copyright: 2013 Stephen Shellenberger
 * Date: 2013/01/05
 */

class zRegisterGroupRequest
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
    function registerGroupRequest($who_requested_user_account_uid,
                                    $who_approves_user_account_uid,
                                    $who_gets_approved_user_account_uid,
                                    $group_account_uid,
                                    $status = "P")
    {
        $this->gdlog()->LogInfoStartFUNCTION("registerGroupMembershipRequest");
        $utk = $this->getGDConfig()->getSessUnivTblKey();
        $fr;
        $sqlstmnt = "INSERT INTO ".$utk."requests SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "who_requested_user_account_uid=:who_requested_user_account_uid, ".
            "who_approves_user_account_uid=:who_approves_user_account_uid, ".
            "who_gets_approved_user_account_uid=:who_gets_approved_user_account_uid, ".
            "status=:status, ".
            "group_account_uid=:group_account_uid";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":who_requested_user_account_uid", $who_requested_user_account_uid);
        $dbcontrol->bindParam(":who_approves_user_account_uid", $who_approves_user_account_uid);
        $dbcontrol->bindParam(":who_gets_approved_user_account_uid", $who_gets_approved_user_account_uid);
        $dbcontrol->bindParam(":status", strtoupper($status));
        $dbcontrol->bindParam(":group_account_uid", $group_account_uid);
        $dbcontrol->execUpdate();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResult_Request($dbcontrol->getRowfromLastId($dbcontrol, $utk."requests", $dbcontrol->getLastInsertID()));
                $this->gdlog()->LogInfoDB($this->getResult_Request());
                $fr = $this->saveActivityLog("REQUEST_GROUP_MEMBERSHIP_IS_REGISTERED", "Register Message has been registered:".json_encode($this->getResult_Request()).":");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("REQUEST_GROUP_MEMBERSHIP_IS_NOT_REGISTERED");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("registerGroupMembershipRequest");
        return $fr;
    }

    private $Result_Request = "NO_RECORD";
    function setResult_Request($row)
    {
        $this->Result_Request = $row;
    }    
    
    function getResult_Request()
    {
        return $this->Result_Request;
    }
    
    function getUid(){return $this->Result_Request["uid"];}
    function getWhoRequestesUserAccountUid(){return $this->Result_Request["who_requested_user_account_uid"];}
    function getWhoApprovesUserAccountUid(){return $this->Result_Request["who_approves_user_account_uid"];}
    function getWhoGetsApprovedUserAccountUid(){return $this->Result_Request["who_gets_approved_user_account_uid"];}
    function geStatus(){return $this->Result_Request["status"];}
    function getGroupAccountUid(){return $this->Result_Request["group_account_uid"];}
}
?>