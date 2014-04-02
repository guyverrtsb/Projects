<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php gdreqonce("/gd.trxn.com/usersafety/_controls/classes/find/usersafety_task_control_links.php"); ?>
<?php gdreqonce("/gd.trxn.com/usersafety/_controls/classes/update/usersafety_task_control_links.php"); ?>
<?php gdreqonce("/gd.trxn.com/usersafety/_controls/classes/update/usersafety_account.php"); ?>
<?php gdreqonce("/gd.trxn.com/usersafety/_controls/classes/find/_user_authentication_data.php"); ?>
<?php gdreqonce("/gd.trxn.com/usersafety/_controls/classes/find/usersafety_account.php"); ?>
<?php
class gdActivation
    extends zAppBaseObject
{
    function __construct()
    {
    }
    
    function activation($activationQS)
    {
        $this->gdlog()->LogInfoStartFUNCTION("createNewUserAccountandProfile");
        $fr = "UNKNOWN_ERROR";
        
        $gdfutc = new gdFindUsersafetyTaskControlLinks();
        $activationAry = explode("{}", $activationQS);
        $gdfutc->findUsersafetyTaskControlLinks_byUid1Uid2Uid3_Valid30Minutes($activationAry[0], $activationAry[1], $activationAry[2]);
        
        if($gdfutc->getTasKKey() == "ACTIVATION_USER_ACCOUNT")
        {
            $fr = $this->activateUserAccount($gdfutc->getRecordUid(), $gdfutc->getUid());
        }
        else
        {
            $fr = "TASK_KEY_NOT_CODED_FOR";
        }

        $this->gdlog()->LogInfoEndFUNCTION("createNewUserAccountandProfile");
        return $fr;
    }

    function activateUserAccount($usersafety_account_uid, $usersafety_task_control_links_uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("createNewUserAccountandProfile");
        $fr = "UNKNOWN_ERROR";
        
        $gduua = new gdUpdateUsersafetyAccount();
        $fr = $gduua->updateActivateUser($usersafety_account_uid);
        $fr = $gduua->updateRecordUserAccount_Numberoflogintries($usersafety_account_uid, "0");
        $gduutcl = new gdUpdateUsersafetyTaskControlLinks();
        $fr = $gduutcl->updateRecordTaskControlDeactivate($usersafety_task_control_links_uid);
        
        $gdfuad = new gdFindUserAuthenticationData();
        $gdfuad->findUserAuthenticationData_ByUid($usersafety_account_uid);
        
        /* Set Output Data Objects */
        $this->setOutputData("useraccount_uid", $gdfuad->getUAUid());
        $this->setOutputData("useraccount_email", $gdfuad->getEmail());
        $this->setOutputData("useraccount_nickname", $gdfuad->getNickname());
        $this->setOutputData("userprofile_firstname", $gdfuad->getFirstname());
        $this->setOutputData("userprofile_lastname", $gdfuad->getLastname());

        $this->dumpOutputData();
        
        $this->gdlog()->LogInfoEndFUNCTION("createNewUserAccountandProfile");
        return $fr;
    }

    function generateTaskControlLink($email)
    {
        $this->gdlog()->LogInfoStartFUNCTION("createNewUserAccountandProfile");
        $fr = "UNKNOWN_ERROR";
        $this->cleanAllOutputData();
        
        $gdfua = new gdFindUsersafetyAccount();
        $emailexists = $gdfua->findUsersafetyAccount_byEmail($email);
        if($emailexists == "RECORD_IS_FOUND")
        {
            $gdctc = new gdCreateTaskControl();
            $gdctc->createRecordTaskControl("ACTIVATION_USER_ACCOUNT", $gdfua->getUid(), "T");
        
            $gdfuad = new gdFindUserAuthenticationData();
            $gdfuad->findUserAuthenticationData_ByUid($gdfua->getUid());
            
            /* Set Output Data Objects */
            $this->setOutputData("useraccount_uid", $gdfuad->getUAUid());
            $this->setOutputData("useraccount_email", $gdfuad->getEmail());
            $this->setOutputData("useraccount_nickname", $gdfuad->getNickname());
            $this->setOutputData("userprofile_firstname", $gdfuad->getFirstname());
            $this->setOutputData("userprofile_lastname", $gdfuad->getLastname());
            $this->setOutputData("taskcontrol_qs", $gdctc->getUid1()."{}".$gdctc->getUid2()."{}".$gdctc->getUid3());
    
            $this->dumpOutputData();
            
            $fr = $this->gdlog()->LogInfoRETURN("RECORD_IS_CREATED");
        }
        else if($emailexists == "RECORD_IS_NOT_FOUND")
        {
            $fr = $this->gdlog()->LogInfoRETURN("EMAIL_NOT_FOUND");
        }
        
        $this->gdlog()->LogInfoEndFUNCTION("createNewUserAccountandProfile");
        return $fr;
    }
}
?>