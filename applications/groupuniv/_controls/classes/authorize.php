<?php gdreqonce("/_controls/classes/authenticate.php"); ?>
<?php
class zAuthorize
    extends zAuthenticate
{
    function isSiteGod()
    {
        $this->gdlog()->LogInfoStartFUNCTION("isSiteGod");
        if($this->isAuthenticated())
        {
            $this->gdlog()->LogInfo("getSessAuthUserSiteRole{".$this->getGDConfig()->getSessAuthUserSiteRole()."}");
            if($this->getGDConfig()->getSessAuthUserSiteRole() == "USER_ROLE_SITE_GOD")
                return true;
            else
                $this->redirectToLogin(111, $fr, "User tried to access content not allowed to Site Admins.");
        }
        $this->gdlog()->LogInfoEndFUNCTION("isSiteGod");
    }
    
    function isSiteAdmin()
    {
        $this->gdlog()->LogInfoStartFUNCTION("isSiteAdmin");
        if($this->isAuthenticated())
        {
            $this->gdlog()->LogInfo("getSessAuthUserSiteRole{".$this->getGDConfig()->getSessAuthUserSiteRole()."}");
            if($this->getGDConfig()->getSessAuthUserSiteRole() == "USER_ROLE_SITE_ADMIN"
            || $this->getGDConfig()->getSessAuthUserSiteRole() == "USER_ROLE_SITE_GOD")
                return true;
            else
                $this->redirectToLogin(111, $fr, "User tried to access content not allowed to Site Admins.");
        }
        $this->gdlog()->LogInfoEndFUNCTION("isSiteAdmin");
    }
    
    function isSiteUser()
    {
        $this->gdlog()->LogInfoStartFUNCTION("isSiteUser");
        if($this->isAuthenticated())
        {
            $this->gdlog()->LogInfo("getSessAuthUserSiteRole{".$this->getGDConfig()->getSessAuthUserSiteRole()."}");
            if($this->getGDConfig()->getSessAuthUserSiteRole() == "USER_ROLE_SITE_USER")
                return true;
            else
                $this->redirectToLogin(111, $fr, "User tried to access content not allowed to Site Users.");
        }
        $this->gdlog()->LogInfoEndFUNCTION("isSiteUser");
    }
    
    function isGroupOwner()
    {
        $this->gdlog()->LogInfoStartFUNCTION("isGroupOwner");
        if($this->isAuthenticated())
        {
            $this->gdlog()->LogInfo("getSessGroupUserRoleSdesc{".$this->getGDConfig()->getSessGroupUserRoleSdesc()."}");
            if($this->getGDConfig()->getSessGroupUserRoleSdesc() == "USER_ROLE_GROUP_OWNER")
                return true;
            else
                $this->redirectToLogin(111, $fr, "User tried to access content not allowed to Site Users.");
        }
        $this->gdlog()->LogInfoEndFUNCTION("isGroupOwner");
    }
    
    function isGroupUser()
    {
        $this->gdlog()->LogInfoStartFUNCTION("isGroupUser");
        if($this->isAuthenticated())
        {
            $this->gdlog()->LogInfo("getSessGroupUserRoleSdesc{".$this->getGDConfig()->getSessGroupUserRoleSdesc()."}");
            if($this->getGDConfig()->getSessGroupUserRoleSdesc() == "USER_ROLE_GROUP_USER")
                return true;
            else
                $this->redirectToLogin(111, $fr, "User tried to access content not allowed to Site Users.");
        }
        $this->gdlog()->LogInfoEndFUNCTION("isGroupUser");
    }
}
?>