<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/retrieve/user.php"); ?>
<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/update/useraccount.php"); ?>
<?php
class AuthenticateUser
    extends AppSysBaseObject
{
    function __construct()
    {
    }
    
    function authenticate($args)
    {
        zLog()->LogStart_AccessPointFunction("authenticate");

        $ru = new RetrieveUser();
        if($args["LOGIN_TYPE"] == 'EMAIL')
            $ru->byEmail($args["useraccount_email"]);
        else if($args["LOGIN_TYPE"] == 'NICKNAME')
            $ru->byNickname($args["useraccount_nickname"]);
        
        if($ru->getSysReturnCode() == "RECORD_IS_FOUND")
        {
            if($ru->getUseraccountIsactive() == "F")    // User account is inactive
            {
                $this->setSysReturnData("ACCOUNT_INACTIVE", "account inactive");
            }
            else if($ru->getUseraccountNumberoflogintries() >= 3)  // Number of Login Tries
            {
                $uua = new UpdateUserAccount();
                $uua->updateIsactive($ru->getMatchUserUseraccountUid(), "F");
                $this->setSysReturnData("TOO_MANY_FAILED_LOGIN_ATTEMPTS", "Too many failed attempts");
            }
            else if($ru->getUseraccountPassword() != $args["useraccount_password"])   // Password does not match
            {
                $uua = new UpdateUserAccount();
                $uua->updateLogintries($ru->getUseraccountUid(), ($ru->getUseraccountNumberoflogintries() + 1));
                $this->setSysReturnData("PASSWORD_DOES_NOT_MATCH", "Passwords do not match");
            }
            else if($ru->getUseraccountPassword() == $args["useraccount_password"])
            {
                zAppSysIntegration()->setAuthoritySessionData($ru->getMatchUserUid()
                                                            , "T"
                                                            , $ru->getUseraccountUsertablekey());
                $this->setSysReturnData("USER_IS_AUTHENTICATED", "User is Authenticated");
            }
        }
        else if($ru->getSysReturnCode() == "RECORD_IS_NOT_FOUND")
        {
            if($args["LOGIN_TYPE"] == 'EMAIL')
                $this->setSysReturnData("RECORD_NOT_FOUND_BY_EMAIL", "Record not found by email");
            else if($args["LOGIN_TYPE"] == 'NICKNAME')
                $this->setSysReturnData("RECORD_NOT_FOUND_BY_NICKNAME", "Record not found by nickname");
        }

        zLog()->LogEnd_AccessPointFunction("authenticate");
    }
}
?>