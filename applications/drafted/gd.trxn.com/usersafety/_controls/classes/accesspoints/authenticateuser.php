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
        zLog()->LogInfoStartFUNCTION("authenticateByEmail");
        $mr = "NA";
        
        $rua = new RetrieveUserAccount();
        $rua->byEmail($argary["useraccount_email"]);
        if($rua->getSysReturnCode() == "RECORD_IS_FOUND")
        {
            
            if($rua->getIsactive() == "F")    // User account is inactive
            {
                $mr = zLog()->LogInfoRETURN("ACCOUNT_INACTIVE");
            }
            else if($rua->getNumberoflogintries() >= 3)  // Number of Login Tries
            {
                $uua = new UpdateUserAccount();
                $uua->updateIsactive($rua->getUid(), "F");
                $mr = zLog()->LogInfoRETURN("TOO_MANY_FAILED_LOGIN_ATTEMPTS");
            }
            else if($rua->getPassword() != $password)   // Password does not match
            {
                $uua = new UpdateUserAccount();
                $uua->updateLogintries($rua->getUid(), ($rua->getNumberoflogintries() + 1));
                $mr = zLog()->LogInfoRETURN("PASSWORD_DOES_NOT_MATCH");
            }
            else if($rua->getPassword() == $argary["useraccount_password"])
            {
                zConfig()->setAuthoritySessionData($rua->getUid()
                                                , "T"
                                                , $rua->getUsertablekey());
                $mr = zLog()->LogInfoRETURN("USER_IS_AUTHENTICATED");
            }
        }
        else if($rua->getSysReturnCode() == "RECORD_IS_NOT_FOUND")
        {
            $mr = zLog()->LogInfoRETURN("RECORD_NOT_FOUND_BY_EMAIL");
        }

        $this->setSysReturnCode($mr);
        zLog()->LogInfoEndFUNCTION("authenticateByEmail");
    }

    function isAthenticated()
    {
        if(isset($_SESSION[$this->sessAuthenticated]))
        {
            $this->setSysReturnCode("USER_IS_AUTHENTICATED");
            return true;
        }
        else
        {
            $this->setSysReturnCode("USER_IS_NOT_AUTHENTICATED");
            return false;
        }
    }
}
?>