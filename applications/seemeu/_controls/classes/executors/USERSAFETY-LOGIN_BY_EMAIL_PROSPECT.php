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
            $args["LOGIN_TYPE"] = "EMAIL";
            $args["useraccount_email"] = trim($_POST["email"]);
            $args["useraccount_password"] = trim($_POST["password"]);
            
            $auth = new zAuthenticateUser();
            $auth->authenticate($args);

            if($auth->getSysReturnCode() == "ACCOUNT_INACTIVE")
            {
                $this->transferSysReturnAry($auth);
                $this->setSysReturnData("ACCOUNT_INACTIVE", "For your security we have deactivated your account.  Please reactivate.", "TRUE");  
            }
            else if($auth->getSysReturnCode() == "TOO_MANY_FAILED_LOGIN_ATTEMPTS")
            {
                $this->transferSysReturnAry($auth);
                $this->setSysReturnData("TOO_MANY_FAILED_LOGIN_ATTEMPTS", "You have tried to login too many times.  Please reset your account to activate.", "TRUE");  
            }
            else if($auth->getSysReturnCode() == "PASSWORD_DOES_NOT_MATCH")
            {
                $this->transferSysReturnAry($auth);
                $this->setSysReturnData("PASSWORD_DOES_NOT_MATCH", "Using the information provided your account is not found.", "TRUE");  
            }
            else if($auth->getSysReturnCode() == "RECORD_NOT_FOUND_BY_EMAIL")
            {
                $this->transferSysReturnAry($auth);
                $this->setSysReturnData("RECORD_NOT_FOUND_BY_EMAIL", "Using the information provided your account is not found.", "TRUE");  
            }
            else if($auth->getSysReturnCode() == "RECORD_NOT_FOUND_BY_NICKNAME")
            {
                $this->transferSysReturnAry($auth);
                $this->setSysReturnData("RECORD_NOT_FOUND_BY_NICKNAME", "Using the information provided your account is not found.", "TRUE");  
            }
            else if($auth->getSysReturnCode() == "USER_IS_AUTHENTICATED")
            {
                $this->transferSysReturnAry($auth);
                $this->setSysReturnData("USER_IS_AUTHENTICATED", "User is authenticated", "TRUE");
            }
        }
        else
        {
            $this->setSysReturnData("FORM_FIELDS_NOT_VALID", "Please fill in all fields.", "TRUE");
        }
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