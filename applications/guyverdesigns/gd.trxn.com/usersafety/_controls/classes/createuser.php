<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php gdreqonce("/gd.trxn.com/usersafety/_controls/classes/find/usersafety_account.php"); ?>
<?php gdreqonce("/gd.trxn.com/usersafety/_controls/classes/create/usersafety_account.php"); ?>
<?php gdreqonce("/gd.trxn.com/usersafety/_controls/classes/create/usersafety_profile.php"); ?>
<?php gdreqonce("/gd.trxn.com/usersafety/_controls/classes/create/match_usersafety_useraccount_to_userprofile.php"); ?>
<?php gdreqonce("/gd.trxn.com/usersafety/_controls/classes/find/usersafety_role.php"); ?>
<?php gdreqonce("/gd.trxn.com/usersafety/_controls/classes/create/match_usersafety_useraccount_to_role.php"); ?>
<?php gdreqonce("/gd.trxn.com/usersafety/_controls/classes/create/match_usersafety_useraccount_to_site.php"); ?>
<?php gdreqonce("/gd.trxn.com/usersafety/_controls/classes/create/usersafety_task_control_links.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. Is Email in Use
 * 2. Create User Account with account inactive
 * 3, Create Profile
 * 4. Match User Account to Profile
 * 5. Match User to Site 
 * 6. Match User to Role
 * 7. Register Activation Record
 * 8. Send Activation Email
*/
class gdCreateUserData
    extends zAppBaseObject
{
    function __construct()
    {
    }
    
    /*
     * This Method is used when Creating
     * User Account and User Profile and Matching.
     * This account will be inactive.
     * the Task Control Unique QS will be generated.
     * You may access using the getTaskCountrolQS method
     */
    function createNewUserAccountandProfile($email,
                                            $nickname,
                                            $password,
                                            $firstname,
                                            $lastname,
                                            $cfg_country_sdesc,
                                            $cfg_region_sdesc,
                                            $city)
    {
        $this->gdlog()->LogInfoStartFUNCTION("createNewUserAccountandProfile");
        $fr = "UNKNOWN_ERROR";
        $this->cleanAllOutputData();
        $gdfua = new gdFindUsersafetyAccount();
        $emailexists = $gdfua->findUsersafetyAccount_byEmail($email);
        $nicknameexists = $gdfua->findUsersafetyAccount_byNickname($nickname);
        $tablekeyexists = $gdfua->findUsersafetyAccount_byUsertablekey($nickname);
        if($emailexists == "RECORD_IS_NOT_FOUND" && $nicknameexists == "RECORD_IS_NOT_FOUND" && $tablekeyexists == "RECORD_IS_NOT_FOUND")
        {
            $gdcua = new gdCreateUsersafetyAccount();
            $gdcua->createRecordUserAccount($email, $nickname, $password);
            
            $gdcup = new gdCreateUsersafetyProfile();
            $gdcup->createRecordUserProfile($firstname, $lastname, $cfg_country_sdesc, $cfg_region_sdesc, $city);

            $gdcmap = new gdCreateMatchAccounttoProfile();
            $gdcmap->createRecordMatchUseraccounttoProfile($gdcua->getUid(), $gdcup->getUid());
            
            $gdctc = new gdCreateTaskControl();
            $gdctc->createRecordTaskControl("ACTIVATION_USER_ACCOUNT", $gdcua->getUid(), "T");

            /* Set Output Data Objects */
            $this->setOutputData("useraccount_uid", $gdcua->getUid());
            $this->setOutputData("useraccount_email", $gdcua->getEmail());
            $this->setOutputData("useraccount_nickname", $gdcua->getNickname());
            $this->setOutputData("userprofile_firstname", $gdcup->getFirstname());
            $this->setOutputData("userprofile_lastname", $gdcup->getLastname());
            $this->setOutputData("taskcontrol_qs", $gdctc->getUid1()."{}".$gdctc->getUid2()."{}".$gdctc->getUid3());

            $this->dumpOutputData();
            $fr = $this->gdlog()->LogInfoRETURN("USER_DATA_IS_CREATED");
        }
        else if($emailexists == "RECORD_IS_FOUND")
        {
            $fr = $this->gdlog()->LogInfoRETURN("EMAIL_IN_USE");
        }
        else if($nicknameexists == "RECORD_IS_FOUND")
        {
            $fr = $this->gdlog()->LogInfoRETURN("NICKNAME_IN_USE");
        }
        else if($tablekeyexists == "RECORD_IS_FOUND")
        {
            $fr = $this->gdlog()->LogInfoRETURN("USERTABLEKEY_IN_USE");
        }
        
        $this->gdlog()->LogInfoEndFUNCTION("createNewUserAccountandProfile");
        return $fr;
    }
    
    private $taskcontrolqs = "NO_RECORD";
    function setTaskControlQS($uid1, $uid2, $uid3)
    {
        $taskcontrolqs = "taskkey".$uid1."{}".$uid2."{}".$uid3;
    }
}
?>