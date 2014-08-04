<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php gdreqonce("/gd.trxn.com/usersafety/_controls/classes/find/_user_authentication_data.php"); ?>
<?php gdreqonce("/gd.trxn.com/usersafety/_controls/classes/update/usersafety_useraccount.php"); ?>
<?php
class gdAuthenticateUser
    extends zAppBaseObject
{
    function __construct()
    {
    }
    
    function authenticateByEmail($email, $password)
    {
        $this->gdlog()->LogInfoStartFUNCTION("authenticateByEmail");
        $fr = "UNKNOWN_ERROR";
        $this->cleanAllOutputData();
        
        $gdfuad = new gdFindUserAuthenticationData();
        $emailexists = $gdfuad->findUserAuthenticationData_ByEmail($email);
        if($emailexists == "RECORD_IS_FOUND")
        {
            if($gdfuad->getIsactive() == "F")    // User account is inactive
            {
                $fr = "ACCOUNT_INACTIVE";
            }
            else if($gdfuad->getNumberoflogintries() >= 3)  // Number of Login Tries
            {
                $gduua = new gdUpdateUsersafetyAccount();
                $gduua->updateDeactivateUser($gdfuad->getUAUid());
                $fr = "TOO_MANY_FAILED_LOGIN_ATTEMPTS";
            }
            else if($gdfuad->getPassword() != $password)
            {
                $gduua = new gdUpdateUsersafetyAccount();
                $gduua->updateRecordUserAccount_Numberoflogintries($gdfuad->getUAUid(), ($gdfuad->getNumberoflogintries() + 1));
                $fr = "PASSWORD_DOES_NOT_MATCH";
            }
            else if($gdfuad->getPassword() == $password)
            {
                $this->getGDConfig()->setAuthoritySessionData($gdfuad->getUAUid()
                                                            , "T"
                                                            , $gdfuad->getSdesc()
                                                            , $gdfuad->getPrority()
                                                            , $gdfuad->getUsertablekey());
                $fr = "USER_IS_AUTHENTICATED";
            }
        }
        else if($emailexists == "RECORD_IS_NOT_FOUND")
        {
            $fr = "RECORD_NOT_FOUND_BY_EMAIL";
        }

        $this->gdlog()->LogInfoEndFUNCTION("authenticateByEmail");
        return $fr;
    }

    function isAthenticated()
    {
        if(isset($_SESSION[$this->sessAuthenticated]))
            return true;
        else
            return false;
    }
}
?>