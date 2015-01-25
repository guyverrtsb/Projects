<?php gdreqonce("/gd.trxn.com/usersafety/_controls/classes/_user.php"); ?>
<?php
class GDAccessControl
    extends Z_User_Base
{
    function isGuest()
    {
        $this->gdlog()->LogInfo("isGuest()");
        return $this->isAuthorizedforPage("GD_GUEST");
    }
    function isUser()
    {
        $this->gdlog()->LogInfo("isUser()");
        return $this->isAuthorizedforPage("GD_USER");
    }
    function isCreator()
    {
        $this->gdlog()->LogInfo("isCreator()");
        return $this->isAuthorizedforPage("GD_CONTENT_CREATOR");
    }
    function isPublisher()
    {
        $this->gdlog()->LogInfo("isPublisher()");
        return $this->isAuthorizedforPage("GD_PUBLISHER");
    }
    function isAdministrator()
    {
        $this->gdlog()->LogInfo("isAdministrator()");
        return $this->isAuthorizedforPage("GD_ADMIN");
    }
    
    function isAuthorizedforPage($rolesdesc = "GD_ADMIN")
    {
        if($this->isAthenticated())
        {
            $this->gdlog()->LogInfo("isAuthorizedforPage():AUTHENTICATED");
            $userrolepriority = $this->getUserRolePriority();
            $resourcerolepriority = $this->getRolePriorityfromSdesc($rolesdesc);
            if($userrolepriority >= $resourcerolepriority)
            {
                $this->gdlog()->LogInfo("isAuthorizedforPage():AUTHORIZED");
                return true;
            }
            else
            {
                $this->gdlog()->LogInfo("isAuthorizedforPage():NOT_AUTHORIZED");
                return false;
             }
        }
        else
        {
            $this->gdlog()->LogInfo("isAuthorizedforPage():NOT_AUTHENTICATED");
        	$this->redirectToLogin("998", "USER_DOES_NOT_HAVE_AUTHORITY_FOR_PAGE", "User does not have authority for page.");
        }
    }
    
    function isAuthorizedforResource($rolesdesc = "GD_ADMIN", $content = "bool")
    {
        if($this->isAthenticated())
        {
            $userrolepriority = $this->getUserRolePriority();
            $resourcerolepriority = $this->getRolePriorityfromSdesc($rolesdesc);
            if($userrolepriority >= $resourcerolepriority)
            {
                $this->gdlog()->LogInfo("isAuthorizedforResource():AUTHORIZED");
                if($content == "bool")
                    return true;
                else
                    printf($content);
            }
            else
            {
                $this->gdlog()->LogInfo("isAuthorizedforResource():NOT_AUTHORIZED");
                if($content == "bool")
                    return false;
                else
                    printf("");
            }
        }
        else
        {
                $this->gdlog()->LogInfo("isAuthorizedforResource():NOT_AUTHENTICATED");
                if($content == "bool")
                    return false;
                else
                    printf("");
        }
    }
    
    function authenticate($email, $password)
    {
        $sqlstmnt = "SELECT uid, email, password, numberoflogintries, ".
                    "active FROM usersafety_useraccount ".
                    "WHERE email=:email";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":email", $email);
        $appcon->execSelect();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $row = $appcon->getStatement()->fetch(PDO::FETCH_ASSOC);

                /** Check Number of Tries **/
                $nolt = $row["numberoflogintries"];
                if($nolt >= 3)
                {
                    $this->setAccountInactive("F", $row["uid"], "USER_IS_LOCKED_TOO_MANY_TRIES",
                        ":uid:".$row["uid"]);
                    $appcon->saveActivityLog("USER_IS_LOCKED_TOO_MANY_TRIES",
                        ":uid:".$row["uid"].":".$row["email"].":");
                        
                    $this->gdlog()->LogInfo("USER_IS_LOCKED_TOO_MANY_TRIES:".
                        $row["uid"].":".
                        $row["email"].":");
                    $this->registerUserLoginActivity($email, "N/A", "N/A", "TOO_MANY_FAILED_LOGIN_TRIES", "Too many attempts");
                    return "USER_IS_LOCKED_TOO_MANY_TRIES";
                }
                
                /** Check if Account Active **/
                if($row["active"] == "F")
                {
                    $appcon->saveActivityLog("ACCOUNT_INACTIVE", ":UID:".$row["uid"].
                        ":".$row["email"].":");

                    $this->registerUserLoginActivity($email, "N/A", "N/A", "ACCOUNT_INACTIVE", "Account Inactive");
                    $this->gdlog()->LogInfo("ACCOUNT_INACTIVE:".
                        $row["uid"].":".
                        $row["email"].":");
                    return "ACCOUNT_INACTIVE";
                }
                
                /** Check If Password is good **/
                if($row["password"] == $password)
                {
                    $this->setNumberofTries(0, $row["uid"], "GOOD_LOGIN",
                        ":uid:".$row["uid"]);

                    $this->registerUserLoginActivity($email, "N/A", "N/A", "LOGIN_GOOD", "Login Good");
                    $appcon->saveActivityLog("USER_LOGIN_SUCCESS", ":UID:".$row["uid"].
                        ":".$row["email"].":");
                    $this->gdlog()->LogInfo("ACCOUNT_VALID:".$row["uid"]."password-".$password);
                    $_SESSION[$this->sessAuthUid] = $row["uid"];
                    $_SESSION[$this->sessAuthEmail] = $row["email"];
                    $_SESSION[$this->sessAuthenticated] = "T";
                    return "USER_IS_AUTHENTICATED";
                }
                else
                {
                    $nolt = $nolt + 1;
                    $this->setNumberofTries($nolt, $row["uid"], "BAD_LOGIN",
                        ":Number of Tires:".$nolt.":uid:".$row["uid"]);
                        
                    $this->registerUserLoginActivity($email, "N/A", $password, "LOGIN_COMBINATION_FAILURE", "Login Combination Failure");
                    $appcon->saveActivityLog("BAD_LOGIN", ":UID:".$row["uid"].":".$row["email"].":");
                    $this->gdlog()->LogInfo("authenticate():BAD_LOGIN");
                    return "BAD_LOGIN";
                }
            }
            else
            {
                $this->registerUserLoginActivity($email, "N/A", "N/A", "EMAIL_NOT_FOUND", $email." has not found");
                $this->gdlog()->LogInfo("authenticate():USER_IS_NOT_FOUND");
                return "USER_IS_NOT_FOUND";
            }
        }
        else
        {
            $this->gdlog()->LogInfo("authenticate():TRANSACTION_FAIL");
            return "TRANSACTION_FAIL";
        }
    }
    
    function setNumberofTries($nolt, $uid, $activitylogkey, $activitylogmessage)
    {
         $sqlstmnt = "UPDATE usersafety_useraccount SET numberoflogintries=:numberoflogintries ".
            "WHERE uid=:uid";
            
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":numberoflogintries", $nolt);
        $appcon->bindParam(":uid", $uid);
        $appcon->execUpdate();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $appcon->saveActivityLog($activitylogkey, $activitylogmessage);
                $this->gdlog()->LogInfo("setNumberofTries():Activity Log Success:".
                    ":uid:".$uid.
                    "Active Log:".$activitylogkey.":".$activitylogmessage);
            }
            else
            {
                $this->gdlog()->LogInfo("setNumberofTries():Activity Log Failed");
            }
        }
        else
        {
            $this->gdlog()->LogInfo("setNumberofTries():TRANSACTION_FAIL");
            return "TRANSACTION_FAIL";
        }
    }
    
    function setAccountInactive($active, $uid, $activitylogkey, $activitylogmessage)
    {
         $sqlstmnt = "UPDATE usersafety_useraccount SET active=:active ".
            "WHERE uid=:uid";
            
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":active", $active);
        $appcon->bindParam(":uid", $uid);
        $appcon->execUpdate();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $appcon->saveActivityLog($activitylogkey, $activitylogmessage);
                $this->gdlog()->LogInfo("setNumberofTries():Activity Log Success:".
                    ":uid:".$uid.
                    "Active Log:".$activitylogkey.":".$activitylogmessage);
            }
            else
            {
                $this->gdlog()->LogInfo("setNumberofTries():Activity Log Failed");
            }
        }
        else
        {
            $this->gdlog()->LogInfo("setNumberofTries():TRANSACTION_FAIL");
            return "TRANSACTION_FAIL";
        }
    }
    
    function getLoggedinUserEmail()
    {
        return $_SESSION[$this->sessAuthEmail];
    }
    
    function redirectToLogin($code, $sdesc, $ldesc, $location = "/gd.trxn.com/usersafety/siteaccess.php")
    {
        $_SESSION["AUTH_ERROR_CODE"] = $code;
        $_SESSION["AUTH_ERROR_KEY"] = $sdesc;
        $_SESSION["AUTH_ERROR_MSG"] = $ldesc;
        $this->gdlog()->LogInfo("redirectToLogin():location:".$location.":".
            $_REQUEST["AUTH_ERROR_KEY"].":".$_REQUEST["AUTH_ERROR_MSG"].":");
        header("Location: ".$location);
    }
    
    function logout()
    {
        $this->setUserAcountandProfile($_SESSION["GD_USER_AUTHENTICATED_UID"]);
        $email = $this->getUaEmail();
        $nickname = $this->getUpNickname();
        $this->registerUserLoginActivity($email, $nickname, "N/A", "LOGOUT", $email." has logged out");
        
        unset($_SESSION["GD_USER_AUTHENTICATED_UID"]);
        unset($_SESSION["GD_USER_AUTHENTICATED_EMAIL"]);        
        unset($_SESSION["GD_USER_AUTHENTICATED"]);
        
        return "LOGOUT_SUCCESSFUL";
    }
    
    function redirectToLogout($location = "/gd.trxn.com/usersafety/siteaccess.php")
    {
        $_SESSION["AUTH_ERROR_CODE"] = "999";
        $_SESSION["AUTH_ERROR_KEY"] = "USER_LOGGED_OUT";
        $_SESSION["AUTH_ERROR_MSG"] = "User has been logged out.";
        $this->gdlog()->LogInfo("redirectToLogout():location:".$location.":");
        header("Location: ".$location);
    }
}
?>