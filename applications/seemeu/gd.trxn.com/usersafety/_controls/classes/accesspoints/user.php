<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/retrieve/useraccount.php"); ?>
<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/create/useraccount.php"); ?>
<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/create/userprofile.php"); ?>
<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/create/match_useraccount_to_userprofile.php"); ?>
<?php
/*
* File: user.php
* Author: Stephen Shellenberger
* Copyright: 2015 Stephen Shellenberger
* Date: 2015/02/01
*/
class User
    extends AppSysBaseObject
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
    function createUserInfo($email,
                            $nickname,
                            $password,
                            $firstname,
                            $lastname,
                            $city,
                            $crossappl_configurations_sdesc_region,
                            $crossappl_configurations_sdesc_country)
    {
        $this->gdlog()->LogInfoStartFUNCTION("createUserInfo");
        $fr = "NA";
        
        $rua = new RetrieveUserAccount();
        $emailexists = $rua->byEmail($email);
        $nicknameexists = $rua->byNickname($nickname);
        $tablekeyexists = $rua->byTablekey($nickname);
        
        if($emailexists == "RECORD_IS_NOT_FOUND" && $nicknameexists == "RECORD_IS_NOT_FOUND" && $tablekeyexists == "RECORD_IS_NOT_FOUND")
        {
            $cua = new CreateUserAccount();
            $cua->basic($email, $nickname, $password);
            
            $cup = new CreateUserProfile();
            $cup->basic($firstname, $lastname, $city,
                        $crossappl_configurations_sdesc_region,
                        $crossappl_configurations_sdesc_country);

            $cmuatup = new CreateMatchUserAccounttoUserProfile();
            $cmuatup->basic($cua->getUid(), $cup->getUid());
            
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
        
        $this->gdlog()->LogInfoEndFUNCTION("createUserInfo");
        return $fr;
    }
    
    private $taskcontrolqs = "NO_RECORD";
    function setTaskControlQS($uid1, $uid2, $uid3)
    {
        $taskcontrolqs = "taskkey".$uid1."{}".$uid2."{}".$uid3;
    }
}
?>