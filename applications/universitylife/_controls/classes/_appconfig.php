<?php gdreqonce("/gd.trxn.com/_controls/classes/_config.php"); ?>
<?php
class ZAppConfigurations
    extends ZGDConfigurations
{
    function setUserObjects($user)
    {
        $this->gdlog()->LogInfoStartFUNCTION("setUserObjects");
        $_SESSION[$this->getKeySessAuthUserUid()] = $user->getUA_Uid();
        $_SESSION[$this->getKeySessAuthUserValid()] = "TRUE";
        $_SESSION[$this->getKeySessAuthUserSiteRole()] = $user->getCfgUsrRoleSdesc();
        $_SESSION[$this->getKeySessUserTblKey()] = $user->getUA_TableKey();
        $this->gdlog()->LogInfoEndFUNCTION("setUserObjects");
    }
    
    function setUniversityObjects($university)
    {
        $this->gdlog()->LogInfoStartFUNCTION("setUniversityObjects");
        $_SESSION[$this->getKeySessUnivUid()] = $university->getUA_Uid();
        $_SESSION[$this->getKeySessUnivSdesc()] = $university->getSdesc();
        $_SESSION[$this->getKeySessUnivKey()] = $university->getTablekey();
        $this->gdlog()->LogInfoEndFUNCTION("setUniversityObjects");
    }
    
    function setCurrentGroup($uid, $roleuid, $rolesdesc)
    {
        $this->gdlog()->LogInfoStartFUNCTION("setCurrentGroup");
        $_SESSION[$this->getKeySessGroupUid()] = $uid;
        $_SESSION[$this->getKeySessGroupUserRoleUid()] = $roleuid;
        $_SESSION[$this->getKeySessGroupUserRoleSdesc()] = $rolesdesc;
        $this->gdlog()->LogInfoEndFUNCTION("setCurrentGroup");
    }
    
    function cleanAuthoritySessionObjects()
    {
        $this->gdlog()->LogInfoStartFUNCTION("cleanAuthoritySessionObjects");
        unset($_SESSION[$this->getKeySessAuthUserUid()]);
        unset($_SESSION[$this->getKeySessAuthUserValid()]);
        unset($_SESSION[$this->getKeySessAuthUserSiteRole()]);
        $this->cleanUniversitySessionObjects();
        $this->cleanGroupSessionObjects();
    }
    
    function cleanUniversitySessionObjects()
    {
        $this->gdlog()->LogInfoStartFUNCTION("cleanUniversitySessionObjects");
        unset($_SESSION[$this->getKeySessUnivUid()]);
        unset($_SESSION[$this->getKeySessUnivSdesc()]);
        unset($_SESSION[$this->getKeySessUnivKey()]);
        $this->gdlog()->LogInfoEndFUNCTION("cleanAuthoritySessionObjects");
    }
    
    function cleanGroupSessionObjects()
    {
        $this->gdlog()->LogInfoStartFUNCTION("cleanGroupSessionObjects");
        unset($_SESSION[$this->getKeySessGroupUid()]);
        unset($_SESSION[$this->getKeySessGroupUserRoleUid()]);
        unset($_SESSION[$this->getKeySessGroupUserRoleSdesc()]);
        $this->gdlog()->LogInfoEndFUNCTION("cleanGroupSessionObjects");
    }
    
    function getObjectValue($key)
    {
        if(isset($_SESSION[$key]))
            return $_SESSION[$key];
        return "";
    }
    
    function getSessAuthUserUid()
    {
        if(isset($_SESSION[$this->getKeySessAuthUserUid()]))
            return $_SESSION[$this->getKeySessAuthUserUid()];
        return "";
    }
    
    function getSessAuthUserValid()
    {
        if(isset($_SESSION[$this->getKeySessAuthUserValid()]))
            return $_SESSION[$this->getKeySessAuthUserValid()];
        return "";
    }
    
    function getSessAuthUserSiteRole()
    {
        if(isset($_SESSION[$this->getKeySessAuthUserSiteRole()]))
            return $_SESSION[$this->getKeySessAuthUserSiteRole()];
        return "";
    }
    
    function getSessAuthUserTblKey()
    {
        if(isset($_SESSION[$this->getKeySessUserTblKey()]))
            return $_SESSION[$this->getKeySessUserTblKey()];
        return "";
    }
    
    function getSessUnivUid()
    {
        if(isset($_SESSION[$this->getKeySessUnivUid()]))
            return $_SESSION[$this->getKeySessUnivUid()];
        return "";
    }
    
    function getSessUnivSdesc()
    {
        if(isset($_SESSION[$this->getKeySessUnivSdesc()]))
            return $_SESSION[$this->getKeySessUnivSdesc()];
        return "";
    }
    
    function getSessUnivKey()
    {
        if(isset($_SESSION[$this->getKeySessUnivKey()]))
            return $_SESSION[$this->getKeySessUnivKey()];
        return "";
    }
    
    function getSessUnivTblKey()
    {
        if(isset($_SESSION[$this->getKeySessUnivKey()]))
        {
            $tblkey = $_SESSION[$this->getKeySessUnivKey()];
            return $tblkey;
        }
        return "";
    }
    
    function getSessGroupUid()
    {
        if(isset($_SESSION[$this->getKeySessGroupUid()]))
            return $_SESSION[$this->getKeySessGroupUid()];
        return "";
    }
    
    function getSessGroupUserRoleUid()
    {
        if(isset($_SESSION[$this->getKeySessGroupUserRoleUid()]))
            return $_SESSION[$this->getKeySessGroupUserRoleUid()];
        return "";
    }
    
    function getSessGroupUserRoleSdesc()
    {
        if(isset($_SESSION[$this->getKeySessGroupUserRoleSdesc()]))
            return $_SESSION[$this->getKeySessGroupUserRoleSdesc()];
        return "";
    }
    
    
    
    
    
    
    
    
    
    
    /** USER SESSION KEYS **/
    function getKeySessAuthUserUid(){return "UNIV_MEET_AUTH_USER_UID";}
    function getKeySessAuthUserValid(){return "UNIV_MEET_AUTH_VALID_TF";}
    function getKeySessAuthUserSiteRole(){return "UNIV_MEET_AUTH_SITE_ROLE";}
    function getKeySessUserTblKey(){return "UNIV_MEET_AUTH_USER_TABLE_KEY";}
    
    function getKeySessUnivUid(){return "UNIV_MEET_AUTH_UNIV_UID";}
    function getKeySessUnivSdesc(){return "UNIV_MEET_AUTH_UNIV_SDESC";}
    function getKeySessUnivKey(){return "UNIV_MEET_AUTH_UNIV_KEY";}
    
    function getKeySessGroupUid(){return "UNIV_MEET_GROUP_ACCOUNT_UID";}
    function getKeySessGroupUserRoleUid(){return "UNIV_MEET_GROUP_ROLE_UID";}
    function getKeySessGroupUserRoleSdesc(){return "UNIV_MEET_GROUP_ROLE_SDESC";}
    
        
    function redirectToUI($code, $sdesc, $ldesc, $location = "/siteaccess.php")
    {
        gdlog()->LogInfoStartFUNCTION("redirectToUI");
        $_SESSION["AUTH_ERROR_CODE"] = $code;
        $_SESSION["AUTH_ERROR_KEY"] = $sdesc;
        $_SESSION["AUTH_ERROR_MSG"] = $ldesc;
        gdlog()->LogInfo("redirectToUI".
            ":location:".$location.
            ":AUTH_ERROR_CODE:".$_SESSION["AUTH_ERROR_CODE"].
            ":AUTH_ERROR_KEY:".$_SESSION["AUTH_ERROR_KEY"].
            ":AUTH_ERROR_MSG:".$_SESSION["AUTH_ERROR_MSG"].":");
        header("Location: ".$location);
    }
    
    function redirectToLogin($code, $sdesc, $ldesc, $location = "/siteaccess.php")
    {
        $this->gdlog()->LogInfoStartFUNCTION("redirectToLogin");
        $this->redirectToUI($code, $sdesc, $ldesc, $location);
    }
    
    function redirectToUserHomePage($code, $sdesc, $ldesc, $location = "/siteuser/s_user_account.php")
    {
        $this->gdlog()->LogInfoStartFUNCTION("redirectToUserHomePage");
        $this->redirectToUI($code, $sdesc, $ldesc, $location);
    }
}
?>