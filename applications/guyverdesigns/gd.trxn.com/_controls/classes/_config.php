<?php
class ZGDConfigurations
{
    private $subdomaindocroot = "SUBDOMAIN_DOCUMENT_ROOT"; 

    static function setSite()
    {
        if (!isset($_SESSION["GD_SITE_DEFINED"]))
        {
            session_start();
            /** Set sub domain document root for standardized _controls **/
            if (!isset($_SERVER["SUBDOMAIN_DOCUMENT_ROOT"]))
                $_SERVER["SUBDOMAIN_DOCUMENT_ROOT"] = $_SERVER["CONTEXT_DOCUMENT_ROOT"];
            $_SERVER["DOCUMENT_ROOT"] = $_SERVER["SUBDOMAIN_DOCUMENT_ROOT"];
            
            /** Set the Landscape identifier so we can run configurations based on Environment **/
            if (!isset($_SESSION["GUYVERDESIGNS_SERVER_ENVIRONMENT"]))
            {
                $docroot = $_SERVER["DOCUMENT_ROOT"];
                if (strpos($docroot, "prototyping") !== false)
                    $_SESSION["GUYVERDESIGNS_SERVER_ENVIRONMENT"] = "PRT";
                else if (strpos($docroot, "staging") !== false)
                    $_SESSION["GUYVERDESIGNS_SERVER_ENVIRONMENT"] = "STG";
                else if (strpos($docroot, "zzzproduction") !== false)
                    $_SESSION["GUYVERDESIGNS_SERVER_ENVIRONMENT"] = "PRD";
                else
                    $_SESSION["GUYVERDESIGNS_SERVER_ENVIRONMENT"] ="LCL";
            }
            
            /** Site Information **/
            $f = explode("/", $_SERVER["DOCUMENT_ROOT"]);
            if($_SESSION["GUYVERDESIGNS_SERVER_ENVIRONMENT"] == "LCL")
                $_SESSION[ZGDConfigurations::getKeySessSite()] = $f[sizeof($f) - 1];
            else
                $_SESSION[ZGDConfigurations::getKeySessSite()] = $f[sizeof($f) - 4].".".$f[sizeof($f) - 2].".".$f[sizeof($f) - 1];
            $_SESSION[ZGDConfigurations::getKeySessSiteAlias()] = $_SERVER["HTTP_HOST"];
            
            $_SESSION["GD_SITE_DEFINED"] = "TRUE";
        }
    }

    static function setGDLogging($loglevel = 6)
    {
        /** Set sub domain document root for standardized _controls **/
        if (!isset($_SESSION["GD_LOG_LOCATION"]))
        {
            $DEBUG     = 1;    // Most Verbose
            $INFO      = 2;    // ...
            $WARN      = 3;    // ...
            $ERROR     = 4;    // ...
            $FATAL     = 5;    // Least Verbose
            $OFF       = 6;    // Nothing at all.
            if($loglevel == $DEBUG)
                $_SESSION["GD_LOG_PRIORITY"] = $DEBUG;
            else if($loglevel == $INFO)
                $_SESSION["GD_LOG_PRIORITY"] = $INFO;
            else if($loglevel == $WARN)
                $_SESSION["GD_LOG_PRIORITY"] = $WARN;
            else if($loglevel == $ERROR)
                $_SESSION["GD_LOG_PRIORITY"] = $ERROR;
            else if($loglevel == $FATAL)
                $_SESSION["GD_LOG_PRIORITY"] = $FATAL;
            else if($loglevel == $OFF)
                $_SESSION["GD_LOG_PRIORITY"] = $OFF;
            
            $f = explode("/", $_SERVER["DOCUMENT_ROOT"]);
            $logpath = substr($_SERVER["DOCUMENT_ROOT"], 0, -strlen($f[sizeof($f) - 1]));
            
            $_SESSION["GD_LOG_LOCATION"] = $logpath."/".ZGDConfigurations::getSiteAlias().".txt";
        }
    }

    static function setSiteRegistration()
    {
        require_once("KLogger.php");
        $zgdlog = new KLogger();
        if (!isset($_SESSION[ZGDConfigurations::getKeySessSiteUid()]) || !isset($_SESSION[ZGDConfigurations::getKeySessSiteAliasUid()])
            || !isset($_SESSION[ZGDConfigurations::getKeySessSite()]) || !isset($_SESSION[ZGDConfigurations::getKeySessSiteAlias()]))
        {
            require_once("sites/validation.php");
            require_once("roles/initialization.php");
            $zgdlog->LogInfo("_core.php:Session Object not Found");
            $zgdsa = new ZGDSiteAlias();
            if(!$zgdsa->isSiteandAliasValid())  // Checkign to see if Site and Alias exist and are matched
            {
                $zgdlog->LogInfo("Site and Site Alias Not Valid");
                /*
                 * 1. Does Site Exist and does Alias exists
                 * 1c If Site does exist
                 *  - Insert Site then Attach Alias to site and Match Table
                 * 1b if Site exists and Alias does not exist
                 *  - Insert alias to site
                 * 1c if Site does not exist but alias exists Failure
                 *  - (ASSUMPTION is alias will not exist if Site exists)
                 *  - This scenario will only occur if package has changed.
                 *  - Not likely as package is tied to code base and WAR file name
                 */
                 if(!$zgdsa->doesSiteExist())
                 {
                    $zgdlog->LogInfo("Site Not Found");
                    $zgdsa->registerSite();
                    $zgdroles = new ZGDRoles();
                    $zgdroles->registerRolestoNewSite();
                 }
        
                $zgdsa->registerSiteAlias();
                $zgdsa->matchSiteandSiteAlias();
            }
            else
            {
                $zgdlog->LogInfo("_config.php:Site and Site Alias Valid");
            }
        }
        else
        {
            $zgdlog->LogInfo("{".ZGDConfigurations::getKeySessSiteUid()."}-{".$_SESSION[ZGDConfigurations::getKeySessSiteUid()]."}");
            $zgdlog->LogInfo("{".ZGDConfigurations::getKeySessSite()."}-{".$_SESSION[ZGDConfigurations::getKeySessSite()]."}");
            $zgdlog->LogInfo("{".ZGDConfigurations::getKeySessSiteAliasUid()."}-{".$_SESSION[ZGDConfigurations::getKeySessSiteAliasUid()]."}");
            $zgdlog->LogInfo("{".ZGDConfigurations::getKeySessSiteAlias()."}-{".$_SESSION[ZGDConfigurations::getKeySessSiteAlias()]."}");
            $zgdlog->LogInfo("_config.php:Session Object Found");
        }
    }

    static function getSubDomainDocumentRoot()
    {
        return $_SERVER["SUBDOMAIN_DOCUMENT_ROOT"];
    }
    
    function isLandscapeLocal()
    {
        if($_SESSION["GUYVERDESIGNS_SERVER_ENVIRONMENT"] == "LCL")
            return true;
        else
            return false;
    }
    
    function getLandscapeKey()
    {
        return $_SESSION["GUYVERDESIGNS_SERVER_ENVIRONMENT"];
    }
    
    private $zgdlog;
    function gdlog()
    {
        if(!isset($this->zgdlog))
            $this->zgdlog = new KLogger();
        return $this->zgdlog;
    }
    
    /** Start - SITE DATA **/
    static function setSiteControlData($siteuid, $site, $sitealiasuid, $sitealias)
    {
        $zgdlog = new KLogger();
        $zgdlog->LogInfoStartFUNCTION("setSiteControlData");
        ZGDConfigurations::setSiteData($siteuid, $site);
        ZGDConfigurations::setSiteAliasData($sitealiasuid, $sitealias);
        $zgdlog->LogInfoEndFUNCTION("setSiteControlData");
    }
    
    static function setSiteData($siteuid, $site)
    {
        $zgdlog = new KLogger();
        $zgdlog->LogInfoStartFUNCTION("setSiteData");
        $_SESSION[ZGDConfigurations::getKeySessSiteUid()] = $siteuid;
        $_SESSION[ZGDConfigurations::getKeySessSite()] = $site;
        $zgdlog->LogInfoEndFUNCTION("setSiteData");
    }
    
    static function setSiteAliasData($sitealiasuid, $sitealias)
    {
        $zgdlog = new KLogger();
        $zgdlog->LogInfoStartFUNCTION("setSiteAliasData");
        $_SESSION[ZGDConfigurations::getKeySessSiteAliasUid()] = $sitealiasuid;
        $_SESSION[ZGDConfigurations::getKeySessSiteAlias()] = $sitealias;
        $zgdlog->LogInfoEndFUNCTION("setSiteAliasData");
    }

    static function getSiteUid(){ return ZGDConfigurations::nullCheckSession(ZGDConfigurations::getKeySessSiteUid()); }
    static function getSite(){ return ZGDConfigurations::nullCheckSession(ZGDConfigurations::getKeySessSite()); }
    static function getSiteAliasUid(){ return ZGDConfigurations::nullCheckSession(ZGDConfigurations::getKeySessSiteAliasUid()); }
    static function getSiteAlias(){ return ZGDConfigurations::nullCheckSession(ZGDConfigurations::getKeySessSiteAlias()); }
    /** End - SITE DATA **/

    
    /** Start - USER AUTHORITY DATA **/
    static function setAuthoritySessionData($usersafety_account_uid,
                                            $isauthenticated,
                                            $usersafety_role_sdesc,
                                            $usersafety_role_priority,
                                            $usersafety_account_usertablekey)
    {
        $zgdlog = new KLogger();
        $zgdlog->LogInfoStartFUNCTION("setAuthoritySessionData");
        $_SESSION[ZGDConfigurations::getKeySessAuthUserUid()] = $usersafety_account_uid;
        $_SESSION[ZGDConfigurations::getKeySessAuthUserIsAuthenticated()] = $isauthenticated;
        $_SESSION[ZGDConfigurations::getKeySessAuthUserSiteRole()] = $usersafety_role_sdesc;
        $_SESSION[ZGDConfigurations::getKeySessAuthUserSiteRolePriority()] = $usersafety_role_priority;
        $_SESSION[ZGDConfigurations::getKeySessAuthUsertablekey()] = $usersafety_account_usertablekey;
        $zgdlog->LogInfoEndFUNCTION("setAuthoritySessionData");
    }
    
    static function getAuthUserUid(){ return ZGDConfigurations::nullCheckSession(ZGDConfigurations::getKeySessAuthUserUid()); }
    static function getAuthUserIsAuthenticated(){ return ZGDConfigurations::nullCheckSession(ZGDConfigurations::getKeySessAuthUserIsAuthenticated()); }
    static function getAuthUserSiteRole(){ return ZGDConfigurations::nullCheckSession(ZGDConfigurations::getKeySessAuthUserSiteRole()); }
    static function getAuthUserSiteRolePriority(){ return ZGDConfigurations::nullCheckSession(ZGDConfigurations::getKeySessAuthUserSiteRolePriority()); }
    static function getAuthUsertablekey(){ return ZGDConfigurations::nullCheckSession(ZGDConfigurations::getKeySessAuthUsertablekey()); }
        
    static function cleanAuthoritySessionData()
    {
        $zgdlog = new KLogger();
        $zgdlog->LogInfoStartFUNCTION("cleanAuthoritySessionObjects");
        unset($_SESSION[ZGDConfigurations::getKeySessAuthUserUid()]);
        unset($_SESSION[ZGDConfigurations::getKeySessAuthUserIsAuthenticated()]);
        unset($_SESSION[ZGDConfigurations::getKeySessAuthUserSiteRole()]);
        unset($_SESSION[ZGDConfigurations::getKeySessAuthUserSiteRolePriority()]);
        unset($_SESSION[ZGDConfigurations::getKeySessAuthUsertablekey()]);
        $zgdlog->LogInfoEndFUNCTION("cleanAuthoritySessionObjects");
    }
    /** End - USER AUTHORITY DATA **/
    
    
    /** Start - UI RESPONSE DATA **/
    static function setUIPageResponseData($code, $key, $msg)
    {
        $zgdlog = new KLogger();
        $zgdlog->LogInfoStartFUNCTION("setUIPageResponseData");
        $_SESSION[ZGDConfigurations::getKeySessUIPageRespCode()] = $code;
        $_SESSION[ZGDConfigurations::getKeySessUIPageRespKey()] = $key;
        $_SESSION[ZGDConfigurations::getKeySessUIPageRespMsg()] = $msg;
        $zgdlog->LogInfoEndFUNCTION("setUIPageResponseData");
    }
    
    static function getUIPageResponseCode(){ return ZGDConfigurations::nullCheckSession(ZGDConfigurations::getKeySessUIPageRespCode()); }
    static function getUIPageResponseKey(){ return ZGDConfigurations::nullCheckSession(ZGDConfigurations::getKeySessUIPageRespKey()); }
    static function getUIPageResponseMsg(){ return ZGDConfigurations::nullCheckSession(ZGDConfigurations::getKeySessUIPageRespMsg()); }

    static function cleanUIPageResponseData()
    {
        $zgdlog = new KLogger();
        $zgdlog->LogInfoStartFUNCTION("cleanUIPageResponseData");
        unset($_SESSION[ZGDConfigurations::getKeySessUIPageRespCode()]);
        unset($_SESSION[ZGDConfigurations::getKeySessUIPageRespKey()]);
        unset($_SESSION[ZGDConfigurations::getKeySessUIPageRespMsg()]);
        $zgdlog->LogInfoEndFUNCTION("cleanUIPageResponseData");
    }
    /** End - UI RESPONSE DATA **/
    
    
    /** Start - APPLICATION_DATA **/
    static function setAppData($name, $value)
    {
        $zgdlog = new KLogger();
        $zgdlog->LogInfoStartFUNCTION("setAppData");
        $_SESSION[ZGDConfigurations::getKeySessAppDataPrefix().$name] = $value;
        ZGDConfigurations::dumpSessionData();
        $zgdlog->LogInfoEndFUNCTION("setAppData");
    }
    
    static function getAppData($name)
    {
        $value = "";
        $prefix = ZGDConfigurations::getKeySessAppDataPrefix();
        foreach ($_SESSION as $sessname => $sessvalue)
        {
            if(strlen($sessname) > strlen($prefix))
            {
                if(substr($sessname, strlen($prefix), strlen($sessname)) == $name)
                {
                    $value = $sessvalue;
                }
            }
        }
        return $value;
    }

    static function cleanAppDataName($name)
    {
        $zgdlog = new KLogger();
        $zgdlog->LogInfoStartFUNCTION("cleanAppData");
        $prefix = ZGDConfigurations::getKeySessAppDataPrefix();
        foreach ($_SESSION as $sessname => $sessvalue)
        {
            if(strlen($sessname) > strlen($prefix))
            {
                if(substr($sessname, strlen($prefix), strlen($sessname)) == $name)
                {
                    unset($_SESSION[ZGDConfigurations::getKeySessAppDataPrefix().$name]);
                }
            }
        }
        $zgdlog->LogInfoEndFUNCTION("cleanAppData");
    }

    static function cleanAppData($name)
    {
        $zgdlog = new KLogger();
        $zgdlog->LogInfoStartFUNCTION("cleanAppData");
        $prefix = ZGDConfigurations::getKeySessAppDataPrefix();
        foreach ($_SESSION as $sessname => $sessvalue)
        {
            if(strlen($sessname) > strlen($prefix))
            {
                unset($_SESSION[ZGDConfigurations::getKeySessAppDataPrefix().$name]);
            }
        }
        $zgdlog->LogInfoEndFUNCTION("cleanAppData");
    }
    /** End - APPLICATION_DATA **/
    
    static function nullCheckSession($name)
    {
        if(isset($_SESSION[$name]))
            return $_SESSION[$name];
        else
            return "";
    }
    
    static function getKeySessUIPageRespCode(){return "UI_PAGE_RESPONSE_CODE";}
    static function getKeySessUIPageRespKey(){return "UI_PAGE_RESPONSE_KEY";}
    static function getKeySessUIPageRespMsg(){return "UI_PAGE_RESPONSE_MSG";}
    
    static function getKeySessAuthUserUid(){return "GD_CORP_AUTH_USER_UID";}
    static function getKeySessAuthUserIsAuthenticated(){return "GD_CORP_AUTH_ISUSERAUTHENTICATED_TF";}
    static function getKeySessAuthUserSiteRole(){return "GD_CORP_AUTH_SITE_ROLE";}
    static function getKeySessAuthUserSiteRolePriority(){return "GD_CORP_AUTH_SITE_ROLE_PRIORITY";}
    static function getKeySessAuthUsertablekey(){return "GD_CORP_AUTH_USER_TABLE_KEY";}
    
    static function getKeySessSiteUid(){return "GUYVERDESIGNS_SITE_UID";}
    static function getKeySessSite(){return "GUYVERDESIGNS_SITE";}
    static function getKeySessSiteAliasUid(){return "GUYVERDESIGNS_SITE_ALIAS_UID";}
    static function getKeySessSiteAlias(){return "GUYVERDESIGNS_SITE_ALIAS";}
    
    static function getKeySessAppDataPrefix(){return "GUYVERDESIGNS_APP_DATA";}
    
    static function dumpSessionData()
    {
        $zgdlog = new KLogger();
        foreach ($_SESSION as $sessname => $sessvalue)
        {
            $zgdlog->LogInfo("SESSION:NAME-{".$sessname."}:VALUE-{".$sessvalue."}");
        }
    }
    
    static function redirectToUIPage($code, $key, $msg, $location)
    {
        $zgdlog = new KLogger();
        $zgdlog->LogInfoStartFUNCTION("redirectToUIPage");
        ZGDConfigurations::cleanUIPageResponseData($code, $key, $msg);
        $zgdlog->LogInfo("{".ZGDConfigurations::getKeySessUIPageRespCode()."}-{".$code."}");
        $zgdlog->LogInfo("{".ZGDConfigurations::getKeySessUIPageRespKey()."}-{".$key."}");
        $zgdlog->LogInfo("{".ZGDConfigurations::getKeySessUIPageRespMsg()."}-{".$msg."}");
        $zgdlog->LogInfo("{location}-{".$location."}");
        ZGDConfigurations::setUIPageResponseData($code, $key, $msg);
        $zgdlog->LogInfoEndFUNCTION("redirectToUIPage");
        header("Location: ".$location);
    }
    
    static function getPathing($path)
    {
        if(substr($path, 0, 1) == "/")
            $path = ZGDConfigurations::getSubDomainDocumentRoot().$path;
        //$zgdlog = new KLogger();
        //$zgdlog->LogDebug("URL PATHING {".$path."}");
        return $path;
    }
    
    function gdDateTime($date)
    {
        $sdate = new DateTime();
        $sdate->setDate(date("Y", strtotime($date))
                        , date("m", strtotime($date))
                        , date("d", strtotime($date)));
        $sdate->setTime(0,0,0);
        return $sdate;
    }
    
    function getmySQLDateTimeStamp($date)
    {
        $odate = date("Y-m-d h:i:s", strtotime($date));
        return $odate;
    }
    
    /** Start - CONFIG VALUES **/
    static $not_authorized_page = "/gd.trxn.com/usersafety/index.php";
    static function getRedirectAuthFailPage()
    {
        return ZGDConfigurations::$not_authorized_page;
    }
    
    static $user_logged_in_correctly = "/gd.trxn.com/usersafety/s_user_home.php";
    static function getRedirectAuthLoggedinPage()
    {
        return ZGDConfigurations::$user_logged_in_correctly;
    }
    
    static $user_logged_off_correctly = "/gd.trxn.com/usersafety/s_user_home.php";
    static function getRedirectAuthLoggedoffPage()
    {
        return ZGDConfigurations::$user_logged_off_correctly;
    }
    
    static $email_support_account = "support@guyverdesigns.com";
    static function getEmailSupportAccount()
    {
        return ZGDConfigurations::$email_support_account;
    }
    /** End - CONFIG VALUES **/
}
?>