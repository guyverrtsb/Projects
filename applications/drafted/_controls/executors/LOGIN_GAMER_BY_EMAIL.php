<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/accesspoints/authenticateuser.php"); ?>
<?php zReqOnce("/_controls/classes/accesspoints/gamer.php"); ?>
<?php
class Executor
    extends AppSysBaseObject
{
    function execute()
    {
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
                    $gamer->setSysReturnMsg("User is Authenticated");
                    $gamer->setSysReturnCode("USER_IS_AUTHENTICATED");
                    $this->setSysReturnObj($gamer);
                }
                else
                {
                    $gamer->setSysReturnMsg("User is Authenticated");
                    $gamer->setSysReturnCode("PROBLEM_WITH_GAMER_ACCOUNT_DATA");
                    $this->setSysReturnObj($gamer);
                }
            }
            else if($auth->getSysReturnCode() == "RECORD_NOT_FOUND_BY_EMAIL")
            {
                $auth->setSysReturnMsg("Using the information provided your account is not found.");  
                $this->setSysReturnObj($auth);
                            }
            else if($auth->getSysReturnCode() == "PASSWORD_DOES_NOT_MATCH")
            {
                $auth->setSysReturnMsg("Using the information provided your account is not found.");  
                $this->setSysReturnObj($auth);
            }
            else if($auth->getSysReturnCode() == "TOO_MANY_FAILED_LOGIN_ATTEMPTS")
            {
                $auth->setSysReturnMsg("You have tried to login too many times.  Please reset your account to activate.");  
                $this->setSysReturnObj($auth);
                            }
            else if($auth->getSysReturnCode() == "ACCOUNT_INACTIVE")
            {
                $auth->setSysReturnMsg("For your security we have deactivated your account.  Please reactivate.");  
                $this->setSysReturnObj($auth);
            }
            $this->setSysReturnStructure("RETURN_SHOW_PASS_MSG", "FALSE");
        }
        else
        {
            $this->setSysReturnCode("FORM_FIELDS_NOT_VALID");
            $this->setSysReturnShowMsg("FALSE");
            $this->setSysReturnMsg("Please fill in all fields.");
        }
        return $this;
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