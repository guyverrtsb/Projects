<?php gdreqonce("/_controls/classes/authenticate.php"); ?>
<?php
class zAuthorize
    extends zAuthenticate
{
    function isSiteAdmin()
    {
        if($this->isAuthenticated())
            if($this->getGDConfig()->getSessAuthUserSiteRole() == "USER_ROLE_SITE_ADMIN")
                return true;
            else
                $this->redirectToLogin(111, $fr, "User tried to access content not allowed to Site Admins.");
    }
    
    function isSiteUser()
    {
        if($this->isAuthenticated())
            if($this->getGDConfig()->getSessAuthUserSiteRole() == "USER_ROLE_SITE_USER")
                return true;
            else
                $this->redirectToLogin(111, $fr, "User tried to access content not allowed to Site Users.");
    }
    
    function isGroupOwner()
    {
        if($this->isAuthenticated())
            if($this->getGDConfig()->getSessGroupUserRoleSdesc() == "USER_ROLE_GROUP_OWNER")
                return true;
            else
                $this->redirectToLogin(111, $fr, "User tried to access content not allowed to Site Users.");
    }
    
    function isGroupUser()
    {
        if($this->isAuthenticated())
            if($this->getGDConfig()->getSessGroupUserRoleSdesc() == "USER_ROLE_GROUP_USER")
                return true;
            else
                $this->redirectToLogin(111, $fr, "User tried to access content not allowed to Site Users.");
    }
    
}
?>