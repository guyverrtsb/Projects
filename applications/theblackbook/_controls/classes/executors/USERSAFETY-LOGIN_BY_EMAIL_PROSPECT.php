<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/accesspoints/authenticateuser.php"); ?>
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

            if($auth->getSysReturnCode() == "ACCOUNT_INACTIVE")
            {
                $this->setSysReturnObj($auth);
                $this->setSysReturnMsg("For your security we have deactivated your account.  Please reactivate.");  
            }
            else if($auth->getSysReturnCode() == "TOO_MANY_FAILED_LOGIN_ATTEMPTS")
            {
                $this->setSysReturnObj($auth);
                $this->setSysReturnMsg("You have tried to login too many times.  Please reset your account to activate.");  
            }
            else if($auth->getSysReturnCode() == "PASSWORD_DOES_NOT_MATCH")
            {
                $this->setSysReturnObj($auth);
                $this->setSysReturnMsg("Using the information provided your account is not found.");  
            }
            else if($auth->getSysReturnCode() == "USER_IS_AUTHENTICATED")
            {
                $this->setSysReturnObj($auth);
                $this->setSysReturnMsg("User is authenticated");
            }
            else if($auth->getSysReturnCode() == "RECORD_NOT_FOUND_BY_EMAIL")
            {
                $this->setSysReturnObj($auth);
                $this->setSysReturnMsg("Using the information provided your account is not found.");  
            }
        }
        else
        {
            $this->setSysReturnData("FORM_FIELDS_NOT_VALID", "Please fill in all fields.", "TRUE");
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