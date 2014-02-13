<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
class zAuthenticate
    extends zAppBaseObject
{
    function authenticate($user_email, $user_password)
    {
        $this->gdlog()->LogInfoStartFUNCTION("authenticate");
        $this->getConfig()->cleanAuthoritySessionObjects();
        $fr;
        $sqlstmnt = "SELECT user_account.uid AS user_account_uid, ".
            "email, ".
            "password, ".
            "active, ".
            "cfg_user_roles.uid AS cfg_user_roles_uid, ".
            "cfg_user_roles.sdesc AS cfg_user_roles_sdesc ".
            "FROM user_account ".
            "JOIN match_user_account_to_cfg_user_roles".
            " on match_user_account_to_cfg_user_roles.user_account_uid = user_account.uid ".
            "JOIN cfg_defaults AS cfg_user_roles".
            " on cfg_user_roles.uid = match_user_account_to_cfg_user_roles.cfg_user_roles_uid ".
            "WHERE email=:email";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":email", $user_email);
        $dbcontrol->execSelect();
        if($dbcontrol->getRowCount() > 0)
        {
            $row = $dbcontrol->getStatement()->fetch(PDO::FETCH_ASSOC);
            $this->gdlog()->LogInfoDB($row);
            if($row["active"] == "F")
            {
                $fr = $this->saveActivityLog("ACCOUNT_INACTIVE", "User has not been activated:".json_encode($row).":");
            }
            else if($row["password"] == $user_password)
            {
                $fr = $this->saveActivityLog("USER_IS_AUTHENTICATED", "User has been authenticated:".json_encode($row).":");
            }
            else
            {
                $fr = $this->saveActivityLog("USER_IS_NOT_AUTHENTICATED", "User has failed Authentication:".json_encode($row).":");
             }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("authenticate");
        return $fr;
    }

    function isAuthenticated()
    {
        $this->gdlog()->LogInfoStartFUNCTION("isAuthenticated");
        if(isset($_SESSION[$this->getSessAuthUserUid()])
            && isset($_SESSION[$this->getSessAuthUserValid()]) && $_SESSION[$this->getSessAuthUserValid()] == "TRUE")
        {
            $this->gdlog()->LogInfoRETURN("USER_AUTHENTICATED");
            return true;
        }
        else
        {
            $this->getConfig()->cleanAuthoritySessionObjects();
            $this->redirectToLogin(102, "RESOURCE_SECURED", "Resource Requested is secure and requires login.  Please Login");
        }
    }
    
    function redirectToLogin($code, $sdesc, $ldesc, $location = "/siteaccess.php")
    {
        $this->gdlog()->LogInfoStartFUNCTION("redirectToLogin");
        if($location == "/siteaccess.php")
            $this->getConfig()->cleanAuthoritySessionObjects();
        $_SESSION["AUTH_ERROR_CODE"] = $code;
        $_SESSION["AUTH_ERROR_KEY"] = $sdesc;
        $_SESSION["AUTH_ERROR_MSG"] = $ldesc;
        $this->gdlog()->LogInfo("redirectToLogin()".
            ":location:".$location.
            ":AUTH_ERROR_CODE:".$_SESSION["AUTH_ERROR_CODE"].
            ":AUTH_ERROR_KEY:".$_SESSION["AUTH_ERROR_KEY"].
            ":AUTH_ERROR_MSG:".$_SESSION["AUTH_ERROR_MSG"].":");
        header("Location: ".$location);
    }
    
    function redirectToUserHomePage($code, $sdesc, $ldesc, $location = "/siteuser/s_user_account.php")
    {
        $this->gdlog()->LogInfoStartFUNCTION("redirectToUserHomePage");
        $_SESSION["AUTH_ERROR_CODE"] = $code;
        $_SESSION["AUTH_ERROR_KEY"] = $sdesc;
        $_SESSION["AUTH_ERROR_MSG"] = $ldesc;
        $this->gdlog()->LogInfo("redirectToUserHomePage()".
            ":location:".$location.
            ":AUTH_ERROR_CODE:".$_SESSION["AUTH_ERROR_CODE"].
            ":AUTH_ERROR_KEY:".$_SESSION["AUTH_ERROR_KEY"].
            ":AUTH_ERROR_MSG:".$_SESSION["AUTH_ERROR_MSG"].":");
        header("Location: ".$location);
    }
    
    private $Result_User = "NO_RECORD";
    function setResult_User($row)
    {
        $this->Result_User = $row;
    }
    function getResult_User()
    {
        return $this->Result_User;
    }
    function clearResult_User()
    {
        $this->Result_User = "NO_RECORD";
    }
    
    function getUA_Uid(){ return $this->Result_User["user_account_uid"]; }
    function getUA_Email(){ return $this->Result_User["email"]; }
    function getUA_Password(){ return $this->Result_User["password"]; }
    function getUA_Active(){ return $this->Result_User["active"]; }
    function getCfgUsrRoleUid(){ return $this->Result_User["cfg_user_roles_uid"]; }
    function getCfgUsrRoleSdesc(){ return $this->Result_User["cfg_user_roles_sdesc"]; }
}
?>