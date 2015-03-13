<?php
class SysIntegration
{
    static function setZBaseLines()
    {
        if (!isset($_SESSION["GD_SITE_DEFINED"]))
        {
            session_start();
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
                $_SESSION[SysIntegration::getKeySessSite()] = $f[sizeof($f) - 1];
            else
                $_SESSION[SysIntegration::getKeySessSite()] = $f[sizeof($f) - 4].".".$f[sizeof($f) - 2].".".$f[sizeof($f) - 1];
            $_SESSION[SysIntegration::getKeySessSiteAlias()] = $_SERVER["HTTP_HOST"];
            
            $_SESSION["GD_SITE_DEFINED"] = "TRUE";
            
            $f = explode("/", $_SERVER["DOCUMENT_ROOT"]);
            $_SESSION[SysIntegration::getKeySessSiteConfigRoot()] = substr($_SERVER["DOCUMENT_ROOT"], 0, -strlen($f[sizeof($f) - 1]));
        }
    }

    static function getPathing($path)
    {
        if(substr($path, 0, 1) == "/")
            $path = SysIntegration::getSubDomainDocumentRoot().$path;
        return $path;
    }
    
    static function setZLogging($loglevel = 6)
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
            
            //$f = explode("/", $_SERVER["DOCUMENT_ROOT"]);
            //$logpath = substr($_SERVER["DOCUMENT_ROOT"], 0, -strlen($f[sizeof($f) - 1]));
            
            $_SESSION["GD_LOG_LOCATION"] = $_SESSION[AppSysIntegration::getKeySessSiteConfigRoot()]."ZLOG.txt";
        }
    }

    static function setZSiteRegistration()
    {
        if (!isset($_SESSION[SysIntegration::getKeySessSiteUid()])
            || !isset($_SESSION[SysIntegration::getKeySessSiteAliasUid()])
            || !isset($_SESSION[SysIntegration::getKeySessSite()])
            || !isset($_SESSION[SysIntegration::getKeySessSiteAlias()]))
        {
            zReqOnce("/gd.trxn.com/_controls/classes/dataobjects/retrieve/siteandalias.php");
            zReqOnce("/gd.trxn.com/_controls/classes/dataobjects/create/siteandalias.php");

            //require_once("integration/roles.php");
            zLog()->LogDebug("++Session Objects Not Found++");
            $rsa = new RetrieveSiteandAlias();
            $csa = new CreateSiteandAlias();
            
            $rsa->isSiteandAliasValid();
            if($rsa->getSysReturnCode() == "RECORD_IS_FOUND")  // Checking to see if Site and Alias exist and are matched
            {
                zLog()->LogDebug("++Site and Site Alias found in Database++");
                $_SESSION["GUYVERDESIGNS_SITE_UID"] = $rsa->getResult_RecordField($rsa->dbf("site.uid"));
                $_SESSION["GUYVERDESIGNS_SITE"] = $rsa->getResult_RecordField($rsa->dbf("site.sdesc"));
                $_SESSION["GUYVERDESIGNS_SITE_ALIAS_UID"] = $rsa->getResult_RecordField($rsa->dbf("site.uid"));
                $_SESSION["GUYVERDESIGNS_SITE_ALIAS"] = $rsa->getResult_RecordField($rsa->dbf("site.sdesc"));
            }
            else if($rsa->getSysReturnCode() == "RECORD_IS_NOT_FOUND")
            {
                zLog()->LogDebug("++Site and Site Alias not found in Database++");
                
                $tr = $rsa->doesSiteExist();
                if($rsa->getSysReturnCode() == "RECORD_IS_FOUND")
                {
                    zLog()->LogDebug("++Site found in Database++");
                    $_SESSION["GUYVERDESIGNS_SITE_UID"] = $rsa->getResult_RecordField("uid");
                    $_SESSION["GUYVERDESIGNS_SITE"] = $rsa->getResult_RecordField("sdesc");
                }
                else if($rsa->getSysReturnCode() == "RECORD_IS_NOT_FOUND")
                {
                    zLog()->LogDebug("++Site not found in Database++");
                    $csa->registerSite();
                    zLog()->LogDebug("++Site created in Database++");
                    $_SESSION["GUYVERDESIGNS_SITE_UID"] = $csa->getResult_RecordField("uid");
                    $_SESSION["GUYVERDESIGNS_SITE"] = $csa->getResult_RecordField("sdesc");
                }
                
                $csa->registerSiteAlias();
                zLog()->LogDebug("++Site Alias created in Database++");
                $_SESSION["GUYVERDESIGNS_SITE_ALIAS_UID"] = $csa->getResult_RecordField("uid");
                $_SESSION["GUYVERDESIGNS_SITE_ALIAS"] = $csa->getResult_RecordField("sdesc");
                
                $csa->matchSiteandSiteAlias($_SESSION["GUYVERDESIGNS_SITE_UID"],
                                            $_SESSION["GUYVERDESIGNS_SITE_ALIAS_UID"]);
                zLog()->LogDebug("++Match Site to Alias created in Database++");
            }
        }
        else
        {
            zLog()->LogInfo("{".SysIntegration::getKeySessSiteUid()."}-{".$_SESSION[SysIntegration::getKeySessSiteUid()]."}");
            zLog()->LogInfo("{".SysIntegration::getKeySessSite()."}-{".$_SESSION[SysIntegration::getKeySessSite()]."}");
            zLog()->LogInfo("{".SysIntegration::getKeySessSiteAliasUid()."}-{".$_SESSION[SysIntegration::getKeySessSiteAliasUid()]."}");
            zLog()->LogInfo("{".SysIntegration::getKeySessSiteAlias()."}-{".$_SESSION[SysIntegration::getKeySessSiteAlias()]."}");
            zLog()->LogInfo("_config.php:Session Object Found");
        }
    }
    
    static function isLandscapeLocal()
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
    
    /** End - CONFIG VALUES **/
    function getCurrentPageURL()
    {
        $pageURL = 'http';
        if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }
        return $pageURL;
    }
    
    /** Start - SITE DATA **/
    static function setSiteControlData($siteuid, $site, $sitealiasuid, $sitealias)
    {
        $zlog = new KLogger();
        $zlog->LogInfoStartFUNCTION("setSiteControlData");
        SysIntegration::setSiteData($siteuid, $site);
        SysIntegration::setSiteAliasData($sitealiasuid, $sitealias);
        $syslog->LogInfoEndFUNCTION("setSiteControlData");
    }
    
    static function setSiteData($siteuid, $site)
    {
        $syslog = new KLogger();
        $syslog->LogInfoStartFUNCTION("setSiteData");
        $_SESSION[SysIntegration::getKeySessSiteUid()] = $siteuid;
        $_SESSION[SysIntegration::getKeySessSite()] = $site;
        $syslog->LogInfoEndFUNCTION("setSiteData");
    }
    
    static function setSiteAliasData($sitealiasuid, $sitealias)
    {
        $syslog = new KLogger();
        $syslog->LogInfoStartFUNCTION("setSiteAliasData");
        $_SESSION[SysIntegration::getKeySessSiteAliasUid()] = $sitealiasuid;
        $_SESSION[SysIntegration::getKeySessSiteAlias()] = $sitealias;
        $syslog->LogInfoEndFUNCTION("setSiteAliasData");
    }

    static function getSiteUid(){ return SysIntegration::nullCheckSession(SysIntegration::getKeySessSiteUid()); }
    static function getSite(){ return SysIntegration::nullCheckSession(SysIntegration::getKeySessSite()); }
    static function getSiteAliasUid(){ return SysIntegration::nullCheckSession(SysIntegration::getKeySessSiteAliasUid()); }
    static function getSiteAlias(){ return SysIntegration::nullCheckSession(SysIntegration::getKeySessSiteAlias()); }
    /** End - SITE DATA **/

    
    /** Start - USER AUTHORITY DATA **/
    static function setAuthoritySessionData($usersafety_account_uid,
                                            $isauthenticated,
                                            $usersafety_role_sdesc,
                                            $usersafety_role_priority,
                                            $usersafety_account_usertablekey)
    {
        $syslog = new KLogger();
        $syslog->LogInfoStartFUNCTION("setAuthoritySessionData");
        $_SESSION[SysIntegration::getKeySessAuthUserUid()] = $usersafety_account_uid;
        $_SESSION[SysIntegration::getKeySessAuthUserIsAuthenticated()] = $isauthenticated;
        $_SESSION[SysIntegration::getKeySessAuthUserSiteRole()] = $usersafety_role_sdesc;
        $_SESSION[SysIntegration::getKeySessAuthUserSiteRolePriority()] = $usersafety_role_priority;
        $_SESSION[SysIntegration::getKeySessAuthUsertablekey()] = $usersafety_account_usertablekey;
        $syslog->LogInfoEndFUNCTION("setAuthoritySessionData");
    }
    
    static function setAuthoritySessionPageRedirectPageOverride($page_redirect_override)
    {
        $syslog = new KLogger();
        $syslog->LogInfoStartFUNCTION("setAuthoritySessionPageRedirectPageOverride");
        $_SESSION[SysIntegration::getKeySessAuthUserPageRedirectOverride()] = $page_redirect_override;
        $syslog->LogInfo("Page Redirect Override:{" . SysIntegration::getAuthUserPageRedirectOverride() . "}");
        $syslog->LogInfoEndFUNCTION("setAuthoritySessionPageRedirectPageOverride");
    }
    
    static function getAuthUserUid(){ return SysIntegration::nullCheckSession(SysIntegration::getKeySessAuthUserUid()); }
    static function getAuthUserIsAuthenticated(){ return SysIntegration::nullCheckSession(SysIntegration::getKeySessAuthUserIsAuthenticated()); }
    static function getAuthUserSiteRole(){ return SysIntegration::nullCheckSession(SysIntegration::getKeySessAuthUserSiteRole()); }
    static function getAuthUserSiteRolePriority(){ return SysIntegration::nullCheckSession(SysIntegration::getKeySessAuthUserSiteRolePriority()); }
    static function getAuthUsertablekey(){ return SysIntegration::nullCheckSession(SysIntegration::getKeySessAuthUsertablekey()); }
    static function getAuthUserPageRedirectOverride(){ return SysIntegration::nullCheckSession(SysIntegration::getKeySessAuthUserPageRedirectOverride()); }
        
    static function cleanAuthoritySessionData()
    {
        $syslog = new KLogger();
        $syslog->LogInfoStartFUNCTION("cleanAuthoritySessionObjects");
        unset($_SESSION[SysIntegration::getKeySessAuthUserUid()]);
        unset($_SESSION[SysIntegration::getKeySessAuthUserIsAuthenticated()]);
        unset($_SESSION[SysIntegration::getKeySessAuthUserSiteRole()]);
        unset($_SESSION[SysIntegration::getKeySessAuthUserSiteRolePriority()]);
        unset($_SESSION[SysIntegration::getKeySessAuthUsertablekey()]);
        $syslog->LogInfoEndFUNCTION("cleanAuthoritySessionObjects");
    }
    
    static function cleanAuthoritySessionPageRedirectPageOverride()
    {
        $syslog = new KLogger();
        $syslog->LogInfoStartFUNCTION("cleanAuthoritySessionPageRedirectPageOverride");
        unset($_SESSION[SysIntegration::getAuthUserPageRedirectOverride()]);
        $syslog->LogInfoEndFUNCTION("cleanAuthoritySessionPageRedirectPageOverride");
    }
    /** End - USER AUTHORITY DATA **/
    
    
    /** Start - UI RESPONSE DATA **/
    static function setUIPageResponseData($code, $key, $msg, $showmsg = "TRUE")
    {
        $syslog = new KLogger();
        $syslog->LogInfoStartFUNCTION("setUIPageResponseData");
        $syslog->LogInfo("{".SysIntegration::getKeySessUIPageRespCode()."}-{".$code."}");
        $syslog->LogInfo("{".SysIntegration::getKeySessUIPageRespKey()."}-{".$key."}");
        $syslog->LogInfo("{".SysIntegration::getKeySessUIPageRespMsg()."}-{".$msg."}");
        $syslog->LogInfo("{".SysIntegration::getKeySessUIPageRespMsgShow()."}-{".strtoupper($showmsg)."}");
        $_SESSION[SysIntegration::getKeySessUIPageRespCode()] = $code;
        $_SESSION[SysIntegration::getKeySessUIPageRespKey()] = $key;
        $_SESSION[SysIntegration::getKeySessUIPageRespMsg()] = $msg;
        $_SESSION[SysIntegration::getKeySessUIPageRespMsgShow()] = strtoupper($showmsg);
        $syslog->LogInfoEndFUNCTION("setUIPageResponseData");
    }
    
    static function getUIPageResponseCode(){ return SysIntegration::nullCheckSession(SysIntegration::getKeySessUIPageRespCode()); }
    static function getUIPageResponseKey(){ return SysIntegration::nullCheckSession(SysIntegration::getKeySessUIPageRespKey()); }
    static function getUIPageResponseMsg(){ return SysIntegration::nullCheckSession(SysIntegration::getKeySessUIPageRespMsg()); }
    static function getUIPageResponseMsgShow(){ return SysIntegration::nullCheckSession(SysIntegration::getKeySessUIPageRespMsgShow()); }
    
    static function cleanUIPageResponseData()
    {
        $syslog = new KLogger();
        $syslog->LogInfoStartFUNCTION("cleanUIPageResponseData");
        unset($_SESSION[SysIntegration::getKeySessUIPageRespCode()]);
        unset($_SESSION[SysIntegration::getKeySessUIPageRespKey()]);
        unset($_SESSION[SysIntegration::getKeySessUIPageRespMsg()]);
        unset($_SESSION[SysIntegration::getKeySessUIPageRespMsgShow()]);
        $syslog->LogInfoEndFUNCTION("cleanUIPageResponseData");
    }
    /** End - UI RESPONSE DATA **/
    
    
    /** Start - APPLICATION_DATA **/
    static function setAppData($name, $value)
    {
        $syslog = new KLogger();
        $syslog->LogInfoStartFUNCTION("setAppData");
        $_SESSION[SysIntegration::getKeySessAppDataPrefix().$name] = $value;
        SysIntegration::dumpSessionData();
        $syslog->LogInfoEndFUNCTION("setAppData");
    }
    
    static function getAppData($name)
    {
        $value = "";
        $prefix = SysIntegration::getKeySessAppDataPrefix();
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
        $syslog = new KLogger();
        $syslog->LogInfoStartFUNCTION("cleanAppData");
        $prefix = SysIntegration::getKeySessAppDataPrefix();
        foreach ($_SESSION as $sessname => $sessvalue)
        {
            if(strlen($sessname) > strlen($prefix))
            {
                if(substr($sessname, strlen($prefix), strlen($sessname)) == $name)
                {
                    unset($_SESSION[SysIntegration::getKeySessAppDataPrefix().$name]);
                }
            }
        }
        $syslog->LogInfoEndFUNCTION("cleanAppData");
    }

    static function cleanAppData($name)
    {
        $syslog = new KLogger();
        $syslog->LogInfoStartFUNCTION("cleanAppData");
        $prefix = SysIntegration::getKeySessAppDataPrefix();
        foreach ($_SESSION as $sessname => $sessvalue)
        {
            if(strlen($sessname) > strlen($prefix))
            {
                unset($_SESSION[SysIntegration::getKeySessAppDataPrefix().$name]);
            }
        }
        $syslog->LogInfoEndFUNCTION("cleanAppData");
    }
    /** End - APPLICATION_DATA **/
    
    static function nullCheckSession($name)
    {
        $value = "";
        if(isset($_SESSION[$name]))
            $value = $_SESSION[$name];
        return $value;
    }
    
    static function getKeySessUIPageRespCode(){return "UI_PAGE_RESPONSE_CODE";}
    static function getKeySessUIPageRespKey(){return "UI_PAGE_RESPONSE_KEY";}
    static function getKeySessUIPageRespMsg(){return "UI_PAGE_RESPONSE_MSG";}
    static function getKeySessUIPageRespMsgShow(){return "UI_PAGE_RESPONSE_MSG_SHOW";}
    
    static function getKeySessAuthUserUid(){return "GD_CORP_AUTH_USER_UID";}
    static function getKeySessAuthUserIsAuthenticated(){return "GD_CORP_AUTH_ISUSERAUTHENTICATED_TF";}
    static function getKeySessAuthUserSiteRole(){return "GD_CORP_AUTH_SITE_ROLE";}
    static function getKeySessAuthUserSiteRolePriority(){return "GD_CORP_AUTH_SITE_ROLE_PRIORITY";}
    static function getKeySessAuthUsertablekey(){return "GD_CORP_AUTH_USER_TABLE_KEY";}
    static function getKeySessAuthUserPageRedirectOverride(){return "GD_CORP_AUTH_USER_PAGE_REDIRECT_OVERRIDE";}
    
    static function getKeySessSiteUid(){return "GUYVERDESIGNS_SITE_UID";}
    static function getKeySessSite(){return "GUYVERDESIGNS_SITE";}
    static function getKeySessSiteAliasUid(){return "GUYVERDESIGNS_SITE_ALIAS_UID";}
    static function getKeySessSiteAlias(){return "GUYVERDESIGNS_SITE_ALIAS";}
    static function getKeySessSiteConfigRoot(){return "GUYVERDESIGNS_SITE_CONFIGURATION_ROOT";}
    
    static function getKeySessAppDataPrefix(){return "GUYVERDESIGNS_APP_DATA";}

    static function dumpSessionData()
    {
        $syslog = new KLogger();
        foreach ($_SESSION as $sessname => $sessvalue)
        {
            $syslog->LogDebug("SESSION:NAME-{".$sessname."}:VALUE-{".$sessvalue."}");
        }
    }
    
    static function redirectToUIPage($code, $key, $msg, $showmsg = "TRUE", $location)
    {
        $syslog = new KLogger();
        $syslog->LogInfoStartFUNCTION("redirectToUIPage");
        SysIntegration::cleanUIPageResponseData();
        SysIntegration::setUIPageResponseData($code, $key, $msg, strtoupper($showmsg));
        $syslog->LogInfo("{location}-{".$location."}");
        $syslog->LogInfoEndFUNCTION("redirectToUIPage");
        header("Location: ".$location);
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
        return SysIntegration::$not_authorized_page;
    }
    
    static $user_logged_in_correctly = "/gd.trxn.com/usersafety/s_user_home.php";
    static function getRedirectAuthLoggedinPage()
    {
        return SysIntegration::$user_logged_in_correctly;
    }
    
    static $user_logged_off_correctly = "/gd.trxn.com/usersafety/s_user_home.php";
    static function getRedirectAuthLoggedoffPage()
    {
        return SysIntegration::$user_logged_off_correctly;
    }
    
    static $email_support_account = "support@guyverdesigns.com";
    static function getEmailSupportAccount()
    {
        return SysIntegration::$email_support_account;
    }
    
    static $email_admin_account = "stephen@guyverdesigns.com";
    static function getEmailAdminAccount()
    {
        return SysIntegration::$email_admin_account;
    }
}
?>