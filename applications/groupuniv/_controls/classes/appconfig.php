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
        $_SESSION[$this->getSessAuthUserUid()] = $user->getUA_Uid();
        $_SESSION[$this->getSessAuthUserValid()] = "TRUE";
        $_SESSION[$this->getSessAuthUserSiteRole()] = $user->getCfgUsrRoleSdesc();
    }
    
    function setUniversityObjects($university)
    {
        $_SESSION[$zfuniv->getSessUnivUid()] = $university->getUA_Uid();
        $_SESSION[$zfuniv->getSessUnivSdesc()] = $university->getSdesc();
        $_SESSION[$zfuniv->getSessUnivTblKey()] = $university->getTablekey();
    }
    
    function cleanAuthoritySessionObjects()
    {
        $this->gdlog()->LogInfoStartFUNCTION("cleanAuthoritySessionObjects");
        unset($_SESSION[$this->getSessAuthUserUid()]);
        unset($_SESSION[$this->getSessAuthUserValid()]);
        unset($_SESSION[$this->getSessAuthUserSiteRole()]);
        
        unset($_SESSION[$this->getSessUnivUid()]);
        unset($_SESSION[$this->getSessUnivSdesc()]);
        unset($_SESSION[$this->getSessUnivTblKey()]);
        $this->cleanGroupSessionObjects();
    }
    
    function cleanGroupSessionObjects()
    {
        $this->gdlog()->LogInfoStartFUNCTION("cleanAuthoritySessionObjects");
        unset($_SESSION[$this->getSessGroupUid()]);
        unset($_SESSION[$this->getSessGroupRole()]);
    }
    
    function getObjectValue($key)
    {
        if(isset($_SESSION[$key]))
            return $_SESSION[$key];
        return "";
    }
    
    /** USER SESSION OBJECTS **/
    function getKeySessAuthUserUid(){return "UNIV_MEET_AUTH_USER_UID";}
    function getKeySessAuthUserValid(){return "UNIV_MEET_AUTH_VALID_TF";}
    function getKeySessAuthUserSiteRole(){return "UNIV_MEET_AUTH_SITE_ROLE";}
    
    function getKeySessUnivUid(){return "UNIV_MEET_AUTH_UNIV_UID";}
    function getKeySessUnivSdesc(){return "UNIV_MEET_AUTH_UNIV_SDESC";}
    function getKeySessUnivTblKey(){return "UNIV_MEET_AUTH_UNIV_TBL_KEY";}
    
    function getKeySessGroupUid(){return "UNIV_MEET_GROUP_ACCOUNT_UID";}
    function getKeySessGroupRole(){return "UNIV_MEET_GROUP_ROLE";}
}
?>