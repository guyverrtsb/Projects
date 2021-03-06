<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php gdreqonce("/gd.trxn.com/usersafety/_controls/classes/find/usersafety_role.php"); ?>
<?php
class gdAuthorizeUser
    extends AppSysBaseObject
{
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
        zLog()->LogInfoStart_AccessPointFunction("isContentAuthorized");
        $fr = "UNKNOWN_ERROR";

        $gdfur = new gdFindUsersafetyRole();
        $gdfur->findUsersafetyRole_bySdesc($resource_role_sdesc);
        $this->gdlog()->LogInfo("User Site Role : ".$this->getGDConfig()->getAuthUserSiteRole());
        $this->gdlog()->LogInfo("User Site Prir : ".$this->getGDConfig()->getAuthUserSiteRolePriority());
        $this->gdlog()->LogInfo("Resource  Role : ".$gdfur->getSdesc());
        $this->gdlog()->LogInfo("Resource  Prir : ".$gdfur->getPriority());
        if($this->getGDConfig()->getAuthUserSiteRolePriority() >= $gdfur->getPriority())
        {
            $fr = $this->gdlog()->LogInfoRETURN("USER_AUTHORIZED");
        }
        else
        {
            $fr = $this->gdlog()->LogInfoRETURN("USER_NOT_AUTHORIZED");
        }
        
        $this->gdlog()->LogInfoEnd_AccessPointFunction("isContentAuthorized");
        if($fr == "USER_AUTHORIZED")
            return true;
        else
            return false;
    }
    
    function isAuthorized($resource_role_sdesc = "GD_USER")
    {
        $this->gdlog()->LogInfoStart_AccessPointFunction("isAuthorized");
        $fr = "UNKNOWN_ERROR";

        $gdfur = new gdFindUsersafetyRole();
        $gdfur->findUsersafetyRole_bySdesc($resource_role_sdesc);
        if($this->getGDConfig()->getAuthUserSiteRolePriority() >= $gdfur->getPriority())
        {
            $fr = $this->gdlog()->LogInfoRETURN("USER_AUTHORIZED");
        }
        else
        {
            $fr = $this->gdlog()->LogInfoRETURN("USER_NOT_AUTHORIZED");
        }
        
        $this->gdlog()->LogInfoEnd_AccessPointFunction("isAuthorized");
        if($fr == "USER_AUTHORIZED")
            return true;
        else
        {
            $this->getGDConfig()->setAuthoritySessionPageRedirectPageOverride($_SERVER["REQUEST_URI"]);
            $this->getGDConfig()->redirectToUIPage(100, "USER_NOT_AUTHORIZED", "User is not Authorized for Resource", "TRUE", gdconfig()->getRedirectAuthFailPage());
        }
    }
    
    function isAuthenticated()
    {
        if($this->getGDConfig()->getAuthUserIsAuthenticated() == "T")
            return true;
        else
            return false;
    }
}
?>