<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php
class gdAuthorizeUser
    extends AppSysBaseObject
{
    function __construct()
    {
    }
    
    function isGuest()
    {
        if($this->getUserSiteRole() == "GD_GUEST")
            return true;
        return false;
    }
    
    function isUser()
    {
        if($this->getUserSiteRole() == "GD_USER")
            return true;
        return false;
        return $this->isAuthorizedforPage("");
    }
    
    function isCreator()
    {
        if($this->getUserSiteRole() == "GD_CONTENT_CREATOR")
            return true;
        return false;
    }
    
    function isPublisher()
    {
        if($this->getUserSiteRole() == "GD_PUBLISHER")
            return true;
        return false;
    }
    
    function isAdministrator()
    {
        if($this->getUserSiteRole() == "GD_ADMIN")
            return true;
        return false;
    }
    
    function getUserSiteRole()
    {
        $this->getGDConfig()->getAuthUserSiteRole();
    }
    
    function isContentAuthorized($resource_role_sdesc = "GD_USER")
    {
        zLog()->LogInfoStartFUNCTION("isContentAuthorized");
        $fr = "UNKNOWN_ERROR";

        
        // if($this->getGDConfig()->getAuthUserSiteRolePriority() >= $gdfur->getPriority())
        if(true)
        {
            $fr = zLog()->LogInfoRETURN("USER_AUTHORIZED");
        }
        else
        {
            $fr = zLog()->LogInfoRETURN("USER_NOT_AUTHORIZED");
        }
        
        zLog()->LogInfoEndFUNCTION("isContentAuthorized");
        if($fr == "USER_AUTHORIZED")
            return true;
        else
            return false;
    }
    
    function isAuthorized($resource_role_sdesc = "GD_USER")
    {
        zLog()->LogInfoStartFUNCTION("isAuthorized");
        $fr = "UNKNOWN_ERROR";

        $gdfur = new gdFindUsersafetyRole();
        $gdfur->findUsersafetyRole_bySdesc($resource_role_sdesc);
        if($this->getGDConfig()->getAuthUserSiteRolePriority() >= $gdfur->getPriority())
        {
            $fr = zLog()->LogInfoRETURN("USER_AUTHORIZED");
        }
        else
        {
            $fr = zLog()->LogInfoRETURN("USER_NOT_AUTHORIZED");
        }
        
        $this->zLog()->LogInfoEndFUNCTION("isAuthorized");
        if($fr == "USER_AUTHORIZED")
            return true;
        else
        {
            zConfig()->setAuthoritySessionPageRedirectPageOverride($_SERVER["REQUEST_URI"]);
            zConfig()->redirectToUIPage(100, "USER_NOT_AUTHORIZED", "User is not Authorized for Resource", "TRUE", gdconfig()->getRedirectAuthFailPage());
        }
    }
    
    function isAuthenticated()
    {
        if(zConfig()->getAuthUserIsAuthenticated() == "T")
            return true;
        else
            return false;
    }
}
?>