<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php zReqOnce("/gd.trxn.com/crossapplication/_controls/classes/accesspoints/generateuniquevalue.php"); ?>
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
        zLog()->LogInfoStartFUNCTION("createUserInfo");
        $mr = "NA";
        
        $emailexists = new RetrieveUserAccount();
        $emailexists->byEmail($email);
        
        $guv = new GenerateUniqueValue();
        
        $nicknameexists = new RetrieveUserAccount();
        $nicknameexists->byNickname($nickname);
        
        $tablekeyexists = $guv->generate("USERSAFETY", "useraccount", "usertablekey", $this->createUserTableKey($nickname));
        
        if($emailexists->getSysReturnCode() == "RECORD_IS_NOT_FOUND"
            && $nicknameexists->getSysReturnCode() == "RECORD_IS_NOT_FOUND")
        {
            $ca = new CreateUserAccount();
            $ca->basic($email, $nickname, $password);
            
            $cp = new CreateUserProfile();
            $cp->basic($firstname,
                    $lastname,
                    $city,
                    $crossappl_configurations_sdesc_region,
                    $crossappl_configurations_sdesc_country);

            $cmuatup = new CreateMatchUserAccounttoUserProfile();
            $cmuatup->basic($ca->getUid(), $cp->getUid());
            
            //$gdctc = new gdCreateTaskControl();
            //$gdctc->createRecordTaskControl("ACTIVATION_USER_ACCOUNT", $gdcua->getUid(), "T");

            /* Set Output Data Objects */
            $this->setOutputData("useraccount_uid", $ca->getUid());
            $this->setOutputData("useraccount_email", $ca->getEmail());
            $this->setOutputData("useraccount_usertablekey", $ca->getUsertablekey());
            $this->setOutputData("useraccount_nickname", $ca->getNickname());
            $this->setOutputData("userprofile_firstname", $cp->getFirstname());
            $this->setOutputData("userprofile_lastname", $cp->getLastname());
            //$this->setOutputData("taskcontrol_qs", $gdctc->getUid1()."{}".$gdctc->getUid2()."{}".$gdctc->getUid3());

            //$this->dumpOutputData();
            $mr = zLog()->LogInfoRETURN("USER_IS_CREATED");
        }
        else if($emailexists->getSysReturnCode() == "RECORD_IS_FOUND")
        {
            $mr = zLog()->LogInfoRETURN("EMAIL_IN_USE");
        }
        else if($nicknameexists->getSysReturnCode() == "RECORD_IS_FOUND")
        {
            $nickname = $guv->generate("USERSAFETY", "useraccount", "nickname", $this->createsdesc($nickname));

            $this->setOutputData("NICKNAME_SUGGESTION", $nickname);
            $mr = zLog()->LogInfoRETURN("NICKNAME_IN_USE");
        }
        else if($tablekeyexists->getSysReturnCode() == "RECORD_IS_FOUND")
        {
            $mr = zLog()->LogInfoRETURN("USERTABLEKEY_IN_USE");
        }
        
        $this->setSysReturnCode($mr);
        zLog()->LogInfoEndFUNCTION("createUserInfo");
    }
    
    function retrieveUserAccount($email)
    {
        zLog()->LogInfoStartFUNCTION("retrieveUserInfo");
        $mr = "NA";
        
        $emailexists = new RetrieveUserAccount();
        $emailexists->byEmail($email);
        
        if($emailexists->getSysReturnCode() == "RECORD_IS_FOUND")
        {
            $this->setOutputData("useraccount_uid", $emailexists->getUid());
            $this->setOutputData("useraccount_email", $emailexists->getEmail());
            $this->setOutputData("useraccount_nickname", $emailexists->getNickname());
            $this->setOutputData("useraccount_usertablekey", $emailexists->getUsertablekey());
            
            $mr = zLog()->LogInfoRETURN("USER_ACCOUNT_IS_FOUND");
        }
        else if($emailexists->getSysReturnCode() == "RECORD_IS_NOT_FOUND")
        {
            $mr = zLog()->LogInfoRETURN("EMAIL_NOT_FOUND");
        }
        
        $this->setSysReturnCode($mr);
        zLog()->LogInfoEndFUNCTION("retrieveUserInfo");
    }

   function activateUserProcess($emails)
    {
        zLog()->LogInfoStartFUNCTION("activateUserProcess");
        $mr = "NA";
        
        $emailexists = new RetrieveUserAccount();
        $emailexists->byEmail($email);
        
        $guv = new GenerateUniqueValue();
        
        $nicknameexists = new RetrieveUserAccount();
        $nicknameexists->byNickname($nickname);
        
        $tablekeyexists = $guv->generate("USERSAFETY", "useraccount", "usertablekey", $this->createUserTableKey($nickname));
        
        if($emailexists->getSysReturnCode() == "RECORD_IS_NOT_FOUND"
            && $nicknameexists->getSysReturnCode() == "RECORD_IS_NOT_FOUND")
        {
            $ca = new CreateUserAccount();
            $ca->basic($email, $nickname, $password);
            
            $cp = new CreateUserProfile();
            $cp->basic($firstname,
                    $lastname,
                    $city,
                    $crossappl_configurations_sdesc_region,
                    $crossappl_configurations_sdesc_country);

            $cmuatup = new CreateMatchUserAccounttoUserProfile();
            $cmuatup->basic($ca->getUid(), $cp->getUid());
            
            //$gdctc = new gdCreateTaskControl();
            //$gdctc->createRecordTaskControl("ACTIVATION_USER_ACCOUNT", $gdcua->getUid(), "T");

            /* Set Output Data Objects */
            $this->setOutputData("useraccount_uid", $ca->getUid());
            $this->setOutputData("useraccount_email", $ca->getEmail());
            $this->setOutputData("useraccount_usertablekey", $ca->getUsertablekey());
            $this->setOutputData("useraccount_nickname", $ca->getNickname());
            $this->setOutputData("userprofile_firstname", $cp->getFirstname());
            $this->setOutputData("userprofile_lastname", $cp->getLastname());
            //$this->setOutputData("taskcontrol_qs", $gdctc->getUid1()."{}".$gdctc->getUid2()."{}".$gdctc->getUid3());

            //$this->dumpOutputData();
            $mr = zLog()->LogInfoRETURN("USER_IS_CREATED");
        }
        else if($emailexists->getSysReturnCode() == "RECORD_IS_FOUND")
        {
            $mr = zLog()->LogInfoRETURN("EMAIL_IN_USE");
        }
        else if($nicknameexists->getSysReturnCode() == "RECORD_IS_FOUND")
        {
            $nickname = $guv->generate("USERSAFETY", "useraccount", "nickname", $this->createsdesc($nickname));

            $this->setOutputData("NICKNAME_SUGGESTION", $nickname);
            $mr = zLog()->LogInfoRETURN("NICKNAME_IN_USE");
        }
        else if($tablekeyexists->getSysReturnCode() == "RECORD_IS_FOUND")
        {
            $mr = zLog()->LogInfoRETURN("USERTABLEKEY_IN_USE");
        }
        
        $this->setSysReturnCode($mr);
        zLog()->LogInfoEndFUNCTION("activateUserProcess");
    }
}
?>