<?php gdreqonce("/gd.trxn.com/_controls/classes/base/baseobject.php"); ?>
<?php
class Z_GD_Authorization
    extends zBaseObject
{
    private $sessAuthUid = "GD_USER_AUTHENTICATED_UID";
    private $sessAuthEmail = "GD_USER_AUTHENTICATED_EMAIL";
    private $sessAuthenticated = "GD_USER_AUTHENTICATED";
    
    function authenticate($email, $password)
    {
        $sqlstmnt = "SELECT uid, email, password, numberoflogintries, ".
        "active FROM usersafety_useraccounts ".
        "WHERE email=:email";
        
        $appcon = new ZAppDatabase();
        $appcon->setUserSafetyConn("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":email", $email);
        $appcon->execSelect();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $row = $appcon->getStatement()->fetch(PDO::FETCH_ASSOC);

                /** Check if Account Active **/
                if($row["active"] == "F")
                {
                    $appcon->saveActivityLog("ACCOUNT_INACTIVE", ":UID:".$row["uid"].
                        ":".$row["email"].":");
                    $this->gdlog()->LogInfo("ACCOUNT_INACTIVE:".
                        $row["uid"].":".
                        $row["email"].":");
                    return "ACCOUNT_INACTIVE";
                }
                
                /** Check Number of Tries **/
                $nolt = $row["numberoflogintries"];
                $nolt = $nolt + 1;
                if($nolt >= 3)
                {
                    $appcon->saveActivityLog("USER_IS_LOCKED_TOO_MANY_TRIES", ":UID:".$row["uid"].
                        ":".$row["email"].":");
                    $this->gdlog()->LogInfo("USER_IS_LOCKED_TOO_MANY_TRIES:".
                        $row["uid"].":".
                        $row["email"].":");
                    return "USER_IS_LOCKED_TOO_MANY_TRIES";
                }
                
                /** Check If Password is good **/
                if($row["password"] == $password)
                {
                    $this->setNumberofTries(0, $row["uid"], $row["email"], "GOOD_LOGIN".
                        ":uid:".$uid.
                        ":email:".$email);

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
                    $this->setNumberofTries($nolt, $row["uid"], $row["email"], "BAD_LOGIN".
                        ":Number of Tires:".$nolt.
                        ":uid:".$uid.
                        ":email:".$email);
                    $this->gdlog()->LogInfo("authenticate():BAD_LOGIN");
                    return "BAD_LOGIN";
                }
            }
            else
            {
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

    function isAthenticated()
    {
        if(isset($_SESSION[$this->sessAuthenticated]))
            return true;
        else
            return false;
    }
    
    function setNumberofTries($nolt, $uid, $email, $activitylogkey)
    {
         $sqlstmnt = "UPDATE usersafety_useraccounts SET numberoflogintries=:numberoflogintries ".
            "WHERE uid=:uid";
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":numberoflogintries", $nolt);
        $dbcontrol->execUpdate();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $dbcontrol->saveActivityLog("USER_LOGIN_BAD_PASSWORD", ":uid:".$uid.
                    ":".$email.":");
                $this->gdlog()->LogInfo("setNumberofTries():Activity Log Success:".
                    ":uid:".$uid.
                    ":email:".$email);
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
    
    
    function redirectToLogin($code, $sdesc, $ldesc, $location = "/gd.trxn.com/usersafety/siteaccess.php")
    {
        $_SESSION["AUTH_ERROR_CODE"] = $code;
        $_SESSION["AUTH_ERROR_KEY"] = $sdesc;
        $_SESSION["AUTH_ERROR_MSG"] = $ldesc;
        $this->gdlog()->LogInfo("redirectToLogin():location:".$location.":".
            $_REQUEST["AUTH_ERROR_KEY"].":".$_REQUEST["AUTH_ERROR_MSG"].":");
        header("Location: ".$location);
    }
}
?>
