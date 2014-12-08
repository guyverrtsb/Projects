<?php gdreqonce("/_controls/classes/base/sqlbase.php"); ?><?php
/*
 * Author: Stephen Shellenberger
 * Copyright: 2013 Stephen Shellenberger
 * Date: 2013/01/05
 * This Class file is for Finding User data
 * is the primary object
 * 1. findUid123fromUid
 */
class zFindGroupRequests
    extends zSqlBaseObject
{

    function findGroupRequestsbyStatus($cfg_group_request_status_sdesc)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findGroupRequestsbyStatus");
        $utk = $this->getGDConfig()->getSessUnivTblKey();
        $fr;
        $sqlstmnt = "SELECT ".
            $this->dbfas("who_requested_user_profile.fname, ".
                        "who_approves_user_profile.fname, ".
                        "who_gets_approved_user_profile.fname").
            " FROM ".$utk."requests ".
            
            "JOIN user_account as who_requested_user_account ".
            " on who_requested_user_account.uid = ".$utk."requests.who_requested_user_account_uid ".
            "JOIN match_user_account_to_user_profile as who_requested_match_user_account_profile ".
            " on who_requested_match_user_account_profile.user_account_uid = who_requested_user_account.uid ".
            "JOIN user_profile as who_requested_user_profile ".
            " on who_requested_user_profile.uid = who_requested_match_user_account_profile.user_profile_uid ".
            
            "JOIN user_account as who_approves_user_account ".
            " on who_approves_user_account.uid = ".$utk."requests.who_approves_user_account_uid ".
            "JOIN match_user_account_to_user_profile as who_approves_match_user_account_profile ".
            " on who_approves_match_user_account_profile.user_account_uid = who_approves_user_account.uid ".
            "JOIN user_profile as who_approves_user_profile ".
            " on who_approves_user_profile.uid = who_approves_match_user_account_profile.user_profile_uid ".
            
            "JOIN user_account as who_gets_approved_user_account ".
            " on who_gets_approved_user_account.uid = ".$utk."requests.who_gets_approved_user_account_uid ".
            "JOIN match_user_account_to_user_profile as who_gets_approved_match_user_account_profile ".
            " on who_gets_approved_match_user_account_profile.user_account_uid = who_gets_approved_user_account.uid ".
            "JOIN user_profile as who_gets_approved_user_profile ".
            " on who_gets_approved_user_profile.uid = who_gets_approved_match_user_account_profile.user_profile_uid ".
            
            "WHERE ".$utk."requests.who_approves_user_account_uid = :who_approves_user_account_uid ".
            "AND ".$utk."requests.cfg_group_request_status_sdesc = :cfg_group_request_status_sdesc";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":who_approves_user_account_uid", $this->getGDConfig()->getSessAuthUserUid());
        $dbcontrol->bindParam(":cfg_group_request_status_sdesc", strtoupper($cfg_group_request_status_sdesc));
        $dbcontrol->execSelect();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResult_Lists($dbcontrol->getStatement()->fetchAll(PDO::FETCH_ASSOC));
                $this->gdlog()->LogInfoDB($this->getResult_Lists());
                $fr = $this->gdlog()->LogInfoRETURN("REQUEST_LIST_FOUND");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("REQUEST_LIST_NOT_FOUND");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("findGroupRequestsbyStatus");
        return $fr;
    }

    private $Result_Lists = "NO_RECORDS";
    function setResult_Lists($row)
    {
        $this->Result_Lists = $row;
    }
    
    function getResult_Lists()
    {
        return $this->Result_Lists;
    }
    
    function clearResult_Lists()
    {
        $this->Result_Lists = "NO_RECORDS";
    }
}
?>