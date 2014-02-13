<?php gdreqonce("/gd.trxn.com/_controls/classes/_config.php"); ?>
<?php
class ZAppConfigurations
    extends ZGDConfigurations
{
    private $isCoreConfigSet = false;
    private $subdomaindocroot = "SUBDOMAIN_DOCUMENT_ROOT"; 
    function __construct()
    {

    }
    
    function setUserObjects($user)
    {
        $_SESSION[$this->getKeySessAuthUserUid()] = $user->getUA_Uid();
        $_SESSION[$this->getKeySessAuthUserValid()] = "TRUE";
        $_SESSION[$this->getKeySessAuthUserSiteRole()] = $user->getCfgUsrRoleSdesc();
    }
    
    function setUniversityObjects($university)
    {
        $_SESSION[$zfuniv->getKeySessUnivUid()] = $university->getUA_Uid();
        $_SESSION[$zfuniv->getKeySessUnivSdesc()] = $university->getSdesc();
        $_SESSION[$zfuniv->getKeySessUnivTblKey()] = $university->getTablekey();
    }
    
    function setCurrentGroup($uid, $roleuid, $rolesdesc)
    {
        $_SESSION[$this->getKeySessGroupUid()] = $uid;
        $_SESSION[$this->getKeySessGroupRole_Uid()] = $roleuid;
        $_SESSION[$this->getKeySessGroupRole_Sdesc()] = $rolesdesc;
    }
    
    function cleanAuthoritySessionObjects()
    {
        $this->gdlog()->LogInfoStartFUNCTION("cleanAuthoritySessionObjects");
        unset($_SESSION[$this->getKeySessAuthUserUid()]);
        unset($_SESSION[$this->getKeySessAuthUserValid()]);
        unset($_SESSION[$this->getKeySessAuthUserSiteRole()]);
        
        unset($_SESSION[$this->getKeySessUnivUid()]);
        unset($_SESSION[$this->getKeySessUnivSdesc()]);
        unset($_SESSION[$this->getKeySessUnivTblKey()]);
        $this->cleanGroupSessionObjects();
    }
    
    function cleanGroupSessionObjects()
    {
        $this->gdlog()->LogInfoStartFUNCTION("cleanAuthoritySessionObjects");
        unset($_SESSION[$this->getKeySessGroupUid()]);
        unset($_SESSION[$this->getKeySessGroupRole_Uid()]);
        unset($_SESSION[$this->getKeySessGroupRole_Sdesc()]);
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
            return $tblkey."_";
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
    
    function getKeySessUnivUid(){return "UNIV_MEET_AUTH_UNIV_UID";}
    function getKeySessUnivSdesc(){return "UNIV_MEET_AUTH_UNIV_SDESC";}
    function getKeySessUnivKey(){return "UNIV_MEET_AUTH_UNIV_KEY";}
    
    function getKeySessGroupUid(){return "UNIV_MEET_GROUP_ACCOUNT_UID";}
    function getKeySessGroupUserRoleUid(){return "UNIV_MEET_GROUP_ROLE_UID";}
    function getKeySessGroupUserRoleSdesc(){return "UNIV_MEET_GROUP_ROLE_SDESC";}
}
?>