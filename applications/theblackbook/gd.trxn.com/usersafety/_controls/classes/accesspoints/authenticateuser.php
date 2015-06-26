<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/retrieve/useraccount.php"); ?>
<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/retrieve/userprofile.php"); ?>
<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/retrieve/match_useraccount_to_userprofile.php"); ?>
<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/update/useraccount.php"); ?>
<?php
class gdAuthenticateUser
    extends AppSysBaseObject
{
    function __construct()
    {
    }
    
    function authenticate($argary)
    {
        zLog()->LogStart_AccessPointFunction("authenticateByEmail");
       
        $rua = new RetrieveUserAccount();
        $rua->byEmail($argary["useraccount_email"]);
        if($rua->getSysReturnCode() == "RECORD_IS_FOUND")
        {
            if($rua->getIsactive() == "F")    // User account is inactive
            {
                $this->setSysReturnData("ACCOUNT_INACTIVE", "account inactive");
            }
            else if($rua->getNumberoflogintries() >= 3)  // Number of Login Tries
            {
                $uua = new UpdateUserAccount();
                $uua->updateIsactive($rua->getUid(), "F");
                $this->setSysReturnData("TOO_MANY_FAILED_LOGIN_ATTEMPTS", "Too many failed attempts");
            }
            else if($rua->getPassword() != $argary["useraccount_password"])   // Password does not match
            {
                $uua = new UpdateUserAccount();
                $uua->updateLogintries($rua->getUid(), ($rua->getNumberoflogintries() + 1));
                $this->setSysReturnData("PASSWORD_DOES_NOT_MATCH", "Passwords do not match");
            }
            else if($rua->getPassword() == $argary["useraccount_password"])
            {
                zLog()->LogDebug("**************************GOOD LOGIN*****************************");
                zConfig()->setAuthoritySessionData($rua->getUid()
                                                , "T"
                                                , $rua->getUsertablekey());
                $this->setSysReturnData("USER_IS_AUTHENTICATED", "User is Authenticated");
            }
        }
        else if($rua->getSysReturnCode() == "RECORD_IS_NOT_FOUND")
        {
            $this->setSysReturnData("RECORD_NOT_FOUND_BY_EMAIL", "Record not found by email");
        }

        zLog()->LogEnd_AccessPointFunction("authenticateByEmail");
    }

    function isAthenticated()
    {
        if(isset($_SESSION[$this->sessAuthenticated]))
        {
            $this->setSysReturnData("USER_IS_AUTHENTICATED", "User is authenticated");
            return true;
        }
        else
        {
            $this->setSysReturnData("USER_IS_NOT_AUTHENTICATED", "User is not authenticated");
            return false;
        }
    }
}
?>