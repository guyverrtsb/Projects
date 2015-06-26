<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php zReqOnce("/gd.trxn.com/crossapplication/_controls/classes/accesspoints/generateuniquevalue.php"); ?>
<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/retrieve/useraccount.php"); ?>
<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/create/useraccount.php"); ?>
<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/create/userprofile.php"); ?>
<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/create/match_useraccount_to_userprofile.php"); ?>
<?php zReqOnce("/gd.trxn.com/crossapplication/_controls/classes/accesspoints/taskcontrol.php"); ?>
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
    function createUserInfo($args)
    {
        zLog()->LogStart_AccessPointFunction("createUserInfo");
        
        $guvutk = new GenerateUniqueValue();
        $usertablekey = $guvutk->generate("USERSAFETY", "useraccount", "usertablekey",  $this->createUserTableKey($args["useraccount_usertablekey"]));
        
        $emailexists = new RetrieveUserAccount();
        $emailexists->byEmail($args["useraccount_email"]);
                
        $nicknameexists = new RetrieveUserAccount();
        $nicknameexists->byNickname($args["useraccount_nickname"]);
                
        $tablekeyexists = new RetrieveUserAccount();
        $tablekeyexists->byUsertablekey($usertablekey);
        
        zLog()->LogDebug("[emailexists   ]:[".$emailexists->getSysReturnCode()."]");
        zLog()->LogDebug("[nicknameexists]:[".$nicknameexists->getSysReturnCode()."]");
        zLog()->LogDebug("[tablekeyexists]:[".$tablekeyexists->getSysReturnCode()."]");
        
        if($emailexists->getSysReturnCode() == "RECORD_IS_NOT_FOUND"
            && $nicknameexists->getSysReturnCode() == "RECORD_IS_NOT_FOUND"
            && $tablekeyexists->getSysReturnCode() == "RECORD_IS_NOT_FOUND")
        {
            $ca = new CreateUserAccount();
            $ca->basic($args["useraccount_email"], $args["useraccount_nickname"], $args["useraccount_password"], $usertablekey);
            
            $cp = new CreateUserProfile();
            $cp->basic($args["userprofile_firstname"],
                    $args["userprofile_lastname"],
                    $args["userprofile_city"],
                    $args["userprofile_crossappl_configurations_sdesc_region"],
                    $args["userprofile_crossappl_configurations_sdesc_country"]);

            $cmuatup = new CreateMatchUserAccounttoUserProfile();
            $cmuatup->basic($ca->getUid(), $cp->getUid());

            /* Set Output Data Objects */
            $this->setSysReturnitem("useraccount_uid", $ca->getUid());
            $this->setSysReturnitem("useraccount_email", $ca->getEmail());
            $this->setSysReturnitem("useraccount_usertablekey", $ca->getUsertablekey());
            $this->setSysReturnitem("useraccount_nickname", $ca->getNickname());
            $this->setSysReturnitem("userprofile_firstname", $cp->getFirstname());
            $this->setSysReturnitem("userprofile_lastname", $cp->getLastname());
            
            $args["useraccount_uid"] = $this->getSysReturnitem("useraccount_uid");
            $args["useraccount_email"] = $this->getSysReturnitem("useraccount_email");
            $args["useraccount_nickname"] = $this->getSysReturnitem("useraccount_nickname");
            $args["userprofile_firstname"] = $this->getSysReturnitem("userprofile_firstname");
            $args["userprofile_lastname"] = $this->getSysReturnitem("userprofile_lastname");
            
            $tcl = new TaskControl();
            $tcl->createTaskControl("ACTIVATE_USERACCOUNT",
                                    "/_controls/classes/accesspoints/crossappli_task.php",
                                    $args);
                                            
            $args["taskcontrollink_uid1"] = $tcl->getSysReturnitem("uid1");
            $args["taskcontrollink_uid2"] = $tcl->getSysReturnitem("uid2");
            $args["taskcontrollink_uid3"] = $tcl->getSysReturnitem("uid3");
            $args["taskcontrollink_appl_configurations_sdesc_taskkey"] = $tcl->getSysReturnitem("appl_configurations_sdesc_taskkey");
                                            
            $tcl->sendTaskControl($args);
            $tcl->setSysReturnitem("LCL_MSG_OVERRIDE", "Here is the return info for the New Record:".$tcl->getSysReturnCode()."{".$tcl->getSysReturnitem("IS_ENV_LCL")."}:[".$tcl->getSysReturnitem("TRXN_URL")."]");
            $this->transferSysReturnAry($tcl);

            $this->setSysReturnData("USER_IS_CREATED", "User has been Created");
        }
        else if($emailexists->getSysReturnCode() == "RECORD_IS_FOUND")
        {
            $this->setSysReturnData("EMAIL_IN_USE", "Email is not unique");
        }
        else if($nicknameexists->getSysReturnCode() == "RECORD_IS_FOUND")
        {
            $guvn = new GenerateUniqueValue();
            $nickname = $guvn->generate("USERSAFETY", "useraccount", "nickname", $this->createsdesc($args["useraccount_nickname"]));

            $this->setSysReturnitem("NICKNAME_SUGGESTION", $nickname);
            $this->setSysReturnData("NICKNAME_IN_USE", "Nickname is not unique");
        }
        else if($tablekeyexists->getSysReturnCode() == "RECORD_IS_FOUND")
        {
            $this->setSysReturnData("USERTABLEKEY_IN_USE", "Tablekey is not unique");
        }
        
        zLog()->LogEnd_AccessPointFunction("createUserInfo");
    }
    
    function retrieveUserAccount($email)
    {
        zLog()->LogStart_AccessPointFunction("retrieveUserInfo");
        
        $emailexists = new RetrieveUserAccount();
        $emailexists->byEmail($email);
        
        if($emailexists->getSysReturnCode() == "RECORD_IS_FOUND")
        {
            $this->setSysReturnitem("useraccount_uid", $emailexists->getUid());
            $this->setSysReturnitem("useraccount_email", $emailexists->getEmail());
            $this->setSysReturnitem("useraccount_nickname", $emailexists->getNickname());
            $this->setSysReturnitem("useraccount_usertablekey", $emailexists->getUsertablekey());
            
            $this->setSysReturnData("USER_ACCOUNT_IS_FOUND", "User Account is found");
        }
        else if($emailexists->getSysReturnCode() == "RECORD_IS_NOT_FOUND")
        {
            $this->setSysReturnData("EMAIL_NOT_FOUND", "Email is not found");
        }
        
        zLog()->LogEnd_AccessPointFunction("retrieveUserInfo");
    }

   function activateUserProcess($emails)
    {
        zLog()->LogStart_AccessPointFunction("activateUserProcess");
        
        $emailexists = new RetrieveUserAccount();
        $emailexists->byEmail($email);
        
        $nicknameexists = new RetrieveUserAccount();
        $nicknameexists->byNickname($nickname);
        
        $guv = new GenerateUniqueValue();
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
            

            /* Set Output Data Objects */
            $this->setSysReturnitem("useraccount_uid", $ca->getUid());
            $this->setSysReturnitem("useraccount_email", $ca->getEmail());
            $this->setSysReturnitem("useraccount_usertablekey", $ca->getUsertablekey());
            $this->setSysReturnitem("useraccount_nickname", $ca->getNickname());
            $this->setSysReturnitem("userprofile_firstname", $cp->getFirstname());
            $this->setSysReturnitem("userprofile_lastname", $cp->getLastname());

            $this->setSysReturnData("USER_IS_CREATED", "User is Created");
        }
        else if($emailexists->getSysReturnCode() == "RECORD_IS_FOUND")
        {
            $this->setSysReturnData("EMAIL_IN_USE", "Email is already used");
        }
        else if($nicknameexists->getSysReturnCode() == "RECORD_IS_FOUND")
        {
            $nickname = $guv->generate("USERSAFETY", "useraccount", "nickname", $this->createsdesc($nickname));

            $this->setSysReturnitem("NICKNAME_SUGGESTION", $nickname);
            $this->setSysReturnData("NICKNAME_IN_USE", "Nickname is taken");
        }
        else if($tablekeyexists->getSysReturnCode() == "RECORD_IS_FOUND")
        {
            $this->setSysReturnData("USERTABLEKEY_IN_USE", "TableKey is taken");
        }
        
        zLog()->LogEnd_AccessPointFunction("activateUserProcess");
    }
}
?>