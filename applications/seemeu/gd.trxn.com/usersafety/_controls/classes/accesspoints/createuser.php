<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php zReqOnce("/gd.trxn.com/crossapplication/_controls/classes/accesspoints/generateuniquevalue.php"); ?>
<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/retrieve/useraccount.php"); ?>
<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/create/useraccount.php"); ?>
<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/create/userprofile.php"); ?>
<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/create/match_user.php"); ?>
<?php zReqOnce("/gd.trxn.com/crossapplication/_controls/classes/accesspoints/taskcontrol.php"); ?>
<?php
/*
* File: user.php
* Author: Stephen Shellenberger
* Copyright: 2015 Stephen Shellenberger
* Date: 2015/02/01
*/
class CreateUser
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

            $cmu = new CreateMatchUser();
            $cmu->basic($ca->getUid(), $cp->getUid());

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
            $tcl->createTaskControl($args["taskcontrol_key"],
                                    $args["taskcontrol_taskclass"],
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
}
?>