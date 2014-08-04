<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php gdreqonce("/gd.trxn.com/usersafety/_controls/classes/find/usersafety_task_control_links.php"); ?>
<?php gdreqonce("/gd.trxn.com/usersafety/_controls/classes/update/usersafety_task_control_links.php"); ?>
<?php gdreqonce("/gd.trxn.com/usersafety/_controls/classes/update/usersafety_useraccount.php"); ?>
<?php gdreqonce("/gd.trxn.com/usersafety/_controls/classes/find/_user_authentication_data.php"); ?>
<?php gdreqonce("/gd.trxn.com/usersafety/_controls/classes/find/usersafety_useraccount.php"); ?>
<?php
class gdActivation
    extends zAppBaseObject
{
    function __construct()
    {
    }
    
    function activation($activationQS)
    {
        $this->gdlog()->LogInfoStartFUNCTION("activation");
        $fr = "UNKNOWN_ERROR";
        
        $gdfutc = new gdFindUsersafetyTaskControlLinks();
        $activationAry = explode("{}", $activationQS);
        $gdfutc->findUsersafetyTaskControlLinks_byUid1Uid2Uid3_Valid30Minutes($activationAry[0], $activationAry[1], $activationAry[2]);
        
        if($gdfutc->getTasKKey() == "ACTIVATION_USER_ACCOUNT")
        {
            $gdfua = new gdFindUsersafetyAccount();
            $email_acct_found = $gdfua->findUsersafetyAccount_byUid($gdfutc->getRecordUid());
            $email = $gdfua->getEmail();
            
            $this->gdlog()->LogInfo("User Email : ".$email);
            $this->gdlog()->LogInfo("AdminEmail : ".$this->getGDConfig()->getEmailAdminAccount());
                        
            $gdfur = new gdFindUsersafetyRole();
            if($email == $this->getGDConfig()->getEmailAdminAccount())
                $gdfur->findUsersafetyRole_bySdesc("GD_ADMIN");
            else
                $gdfur->findUsersafetyRole_bySdesc("GD_USER");
                        
            $gdcmar = new gdCreateMatchAccounttoRole();
            $gdcmar->createRecordMatchUseraccounttoRole($gdfutc->getRecordUid(), $gdfur->getUid());
            
            $gdcmus = new gdCreateMatchAccounttoSite();
            $gdcmus->createRecordMatchUseraccounttoSite($gdfutc->getRecordUid(), $this->getGDConfig()->getSiteUid());
            
            $fr = $this->activateUserAccount($gdfutc->getRecordUid(), $gdfutc->getUid());
        }
        else
        {
            $fr = "TASK_KEY_NOT_CODED_FOR";
        }

        $this->gdlog()->LogInfoEndFUNCTION("activation");
        return $fr;
    }

    function activateUserAccount($usersafety_account_uid, $usersafety_task_control_links_uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("activateUserAccount");
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
        
        $this->gdlog()->LogInfoEndFUNCTION("activateUserAccount");
        return $fr;
    }

    function generateTaskControlLink($email)
    {
        $this->gdlog()->LogInfoStartFUNCTION("generateTaskControlLink");
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
        
        $this->gdlog()->LogInfoEndFUNCTION("generateTaskControlLink");
        return $fr;
    }
}
?>