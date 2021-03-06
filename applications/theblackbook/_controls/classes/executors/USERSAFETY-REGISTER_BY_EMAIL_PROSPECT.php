<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/accesspoints/user.php"); ?>
<?php zReqOnce("/gd.trxn.com/crossapplication/_controls/classes/accesspoints/taskcontrol.php"); ?>
<?php zReqOnce("/gd.trxn.com/crossapplication/_controls/classes/accesspoints/generateuniquevalue.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/create/match_usersafety_useraccount_to_usertype.php"); ?>
<?php
class Executor
    extends AppSysBaseObject
{
    function execute()
    {
        zLog()->LogStart_ExecutorFunction("execute");
        zLog()->LogInfo("email:".trim($_POST["email"]));
        zLog()->LogInfo("password:".trim($_POST["password"]));
        zLog()->LogInfo("passwordconfirm:".trim($_POST["passwordconfirm"]));
        if($this->validate())
        {
            $guvutk = new GenerateUniqueValue();
            $nickname = $guvutk->generate("USERSAFETY", "useraccount", "nickname",  "PROSPECT");
            zLog()->LogDebug("nickname:[".$nickname."]");
            $usertablekey = $guvutk->generate("USERSAFETY", "useraccount", "usertablekey",  $this->createUserTableKey("USER"));
            zLog()->LogDebug("usertablekey:[".$usertablekey."]");

            $args["useraccount_email"] = trim($_POST["email"]);
            $args["useraccount_password"] = trim($_POST["password"]);
            $args["useraccount_usertablekey"] = $usertablekey;
            $args["useraccount_isactive"] = "F";
            $args["useraccount_changepassword"] = "F";
            $args["useraccount_numberoflogintries"] = "0";
            $args["useraccount_nickname"] = $nickname;

            $args["userprofile_firstname"] = "NOT_ADDED";
            $args["userprofile_lastname"] = "NOT_ADDED";
            $args["userprofile_city"] = "NOT_ADDED";
            $args["userprofile_crossappl_configurations_sdesc_region"] = "NOT_ADDED";
            $args["userprofile_crossappl_configurations_sdesc_country"] = "NOT_ADDED";
            
            $user = new User();
            $user->createUserInfo($args);
            if($user->getSysReturnCode() == "USER_IS_CREATED")
            {
                $cmuuu = new CreateMatchUsersafetyUseraccounttoUsertype();
                $cmuuu->full($user->getSysReturnitem("useraccount_uid"), "USER_TYPE-PROSPECT");
                
                if($cmuuu->getSysReturnCode() == "RECORD_IS_CREATED" && zAppSysIntegration()->isLandscapeLocal())
                    $this->setSysReturnData("USER_IS_CREATED", "User is Created-".$user->getSysReturnitem("LCL_MSG_OVERRIDE"), "TRUE");
                else if($cmuuu->getSysReturnCode() == "RECORD_IS_CREATED")
                    $this->setSysReturnData("USER_IS_CREATED", "User is Created", "TRUE");
                else
                    $this->setSysReturnData("USER_IS_NOT_CREATED", "User Creation Failed", "TRUE");
                
            }
            else if($user->getSysReturnCode() == "EMAIL_IN_USE")
            {
                $this->setSysReturnData("EMAIL_IN_USE", "Email is already registered", "TRUE");
            }
            else if($user->getSysReturnCode() == "NICKNAME_IN_USE")
            {
                $this->setSysReturnData("NICKNAME_IN_USE", "Nickename in Use.  Try [".$user->getSysReturnitem("NICKNAME_SUGGESTION")."].", "TRUE");
            }
            else if($user->getSysReturnCode() == "USERTABLEKEY_IN_USE")
            {
                $this->setSysReturnData("USERTABLEKEY_IN_USE", "User Table Key is Use", "TRUE");
            }
            else
            {
                $this->setSysReturnData("FORM_FIELDS_NOT_VALID", "Please fill in all fields.", "TRUE");
            }
        }
        else
        {
            $this->setSysReturnData("FORM_FIELDS_NOT_VALID", "Please fill in all fields.", "TRUE");
        }
        zLog()->LogEnd_ExecutorFunction("execute");
    }

    function validate()
    {
        $fv = true;  // Form is Valid Key T=Valid; anything else is invalid;
        if(!isset($_POST["email"]) || trim($_POST["email"]) == "")
            $fv = ajaxValidationLogging(false, "create_UserandProspectAccount", "POST:email");
        if(!isset($_POST["password"]) || trim($_POST["password"]) == "")
            $fv = ajaxValidationLogging(false, "create_UserandProspectAccount", "POST:password");
        if(!isset($_POST["passwordconfirm"]) || trim($_POST["passwordconfirm"]) == "")
            $fv = ajaxValidationLogging(false, "create_UserandProspectAccount", "POST:passwordconfirm");
        return $fv;
    }
}