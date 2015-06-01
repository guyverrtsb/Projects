<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/accesspoints/authenticateuser.php"); ?>
<?php zReqOnce("/_controls/classes/accesspoints/gamer.php"); ?>
<?php
class Executor
    extends AppSysBaseObject
{
    function execute()
    {
        $return = new AppSysBaseObject();
        if($this->validate())
        {
            $args["useraccount_email"] = trim($_POST["email"]);
            $args["useraccount_password"] = trim($_POST["password"]);
            
            $auth = new gdAuthenticateUser();
            $auth->authenticate($args);
                                    
            if($auth->getSysReturnCode() == "USER_IS_AUTHENTICATED")
            {
                $gamer = new Gamer();
                $gamer->retrieveGamer("useraccount_uid", zConfig()->getAuthUserUid());
                
                if($gamer->getSysReturnCode() == "GAMER_ACCOUNT_FOUND")
                {
                    $return = $gamer;
                    $return->setSysReturnMsg("User is Authenticated");
                    $return->setSysReturnCode("USER_IS_AUTHENTICATED");
                }
                else
                {
                    $return = $gamer;
                    $return->setSysReturnMsg("User is Authenticated");
                    $return->setSysReturnCode("PROBLEM_WITH_GAMER_ACCOUNT_DATA");
                }
            }
            else if($auth->getSysReturnCode() == "RECORD_NOT_FOUND_BY_EMAIL")
            {
                $return = $auth;
                $return->setSysReturnMsg("Using the information provided your account is not found.");  
            }
            else if($auth->getSysReturnCode() == "PASSWORD_DOES_NOT_MATCH")
            {
                $return = $auth;
                $return->setSysReturnMsg("Using the information provided your account is not found.");  
            }
            else if($auth->getSysReturnCode() == "TOO_MANY_FAILED_LOGIN_ATTEMPTS")
            {
                $return = $auth;
                $return->setSysReturnMsg("You have tried to login too many times.  Please reset your account to activate.");  
            }
            else if($auth->getSysReturnCode() == "ACCOUNT_INACTIVE")
            {
                $return = $auth;
                $return->setSysReturnMsg("For your security we have deactivated your account.  Please reactivate.");  
            }
            $return->setSysReturnStructure("RETURN_SHOW_PASS_MSG", "FALSE");
        }
        else
        {
            $return->setSysReturnCode("FORM_FIELDS_NOT_VALID");
            $return->setSysReturnShowMsg("FALSE");
            $return->setSysReturnMsg("Please fill in all fields.");
        }
        return $return;
    }

    function validate()
    {
        $fv = true;  // Form is Valid Key T=Valid; anything else is invalid;
        if(!isset($_POST["email"]) || trim($_POST["email"]) == "")
            $fv = ajaxValidationLogging(false, "loginGamerByEmail", "POST:email");
        if(!isset($_POST["password"]) || trim($_POST["password"]) == "")
            $fv = ajaxValidationLogging(false, "loginGamerByEmail", "POST:password");
        return $fv;
    }
}