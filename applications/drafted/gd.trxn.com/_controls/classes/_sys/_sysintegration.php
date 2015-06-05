<?php
class SysIntegration
{
    function setZBaseLines()
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
                $_SESSION[$this->getKeySessSite()] = $f[sizeof($f) - 1];
            else
                $_SESSION[$this->getKeySessSite()] = $f[sizeof($f) - 4].".".$f[sizeof($f) - 2].".".$f[sizeof($f) - 1];
            $_SESSION[$this->getKeySessSiteAlias()] = $_SERVER["HTTP_HOST"];
            
            $_SESSION["GD_SITE_DEFINED"] = "TRUE";
            
            $f = explode("/", $_SERVER["DOCUMENT_ROOT"]);
            $_SESSION[$this->getKeySessSiteConfigRoot()] = substr($_SERVER["DOCUMENT_ROOT"], 0, -strlen($f[sizeof($f) - 1]));
        }
    }

    function getPathing($path)
    {
        if(substr($path, 0, 1) == "/")
            $path = $this->getSubDomainDocumentRoot().$path;
        return $path;
    }
    
    function setZLogging($loglevel = 6)
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
            
            $_SESSION["GD_LOG_LOCATION"] = $_SESSION[$this->getKeySessSiteConfigRoot()]."ZLOG.txt";
        }
    }

    function setZSiteRegistration()
    {
        if (!isset($_SESSION[$this->getKeySessSiteUid()])
            || !isset($_SESSION[$this->getKeySessSiteAliasUid()])
            || !isset($_SESSION[$this->getKeySessSite()])
            || !isset($_SESSION[$this->getKeySessSiteAlias()]))
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
            zLog()->LogInfo("{".$this->getKeySessSiteUid()."}-{".$_SESSION[$this->getKeySessSiteUid()]."}");
            zLog()->LogInfo("{".$this->getKeySessSite()."}-{".$_SESSION[$this->getKeySessSite()]."}");
            zLog()->LogInfo("{".$this->getKeySessSiteAliasUid()."}-{".$_SESSION[$this->getKeySessSiteAliasUid()]."}");
            zLog()->LogInfo("{".$this->getKeySessSiteAlias()."}-{".$_SESSION[$this->getKeySessSiteAlias()]."}");
            zLog()->LogInfo("_config.php:Session Object Found");
        }
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
    function setSiteControlData($siteuid, $site, $sitealiasuid, $sitealias)
    {
        $zlog = new KLogger();
        $zlog->LogInfoStartFUNCTION("setSiteControlData");
        $this->setSiteData($siteuid, $site);
        $this->setSiteAliasData($sitealiasuid, $sitealias);
        $syslog->LogInfoEndFUNCTION("setSiteControlData");
    }
    
    function setSiteData($siteuid, $site)
    {
        $syslog = new KLogger();
        $syslog->LogInfoStartFUNCTION("setSiteData");
        $_SESSION[$this->getKeySessSiteUid()] = $siteuid;
        $_SESSION[$this->getKeySessSite()] = $site;
        $syslog->LogInfoEndFUNCTION("setSiteData");
    }
    
    function setSiteAliasData($sitealiasuid, $sitealias)
    {
        $syslog = new KLogger();
        $syslog->LogInfoStartFUNCTION("setSiteAliasData");
        $_SESSION[$this->getKeySessSiteAliasUid()] = $sitealiasuid;
        $_SESSION[$this->getKeySessSiteAlias()] = $sitealias;
        $syslog->LogInfoEndFUNCTION("setSiteAliasData");
    }

    function getSiteUid(){ return $this->nullCheckSession($this->getKeySessSiteUid()); }
    function getSite(){ return $this->nullCheckSession($this->getKeySessSite()); }
    function getSiteAliasUid(){ return $this->nullCheckSession($this->getKeySessSiteAliasUid()); }
    function getSiteAlias(){ return $this->nullCheckSession($this->getKeySessSiteAlias()); }
    /** End - SITE DATA **/

    
    /** Start - USER AUTHORITY DATA **/
    function setAuthoritySessionData($usersafety_account_uid,
                                            $isauthenticated,
                                            $usersafety_account_usertablekey)
    {
        $syslog = new KLogger();
        $syslog->LogInfoStartFUNCTION("setAuthoritySessionData");
        $_SESSION[$this->getKeySessAuthUserUid()] = $usersafety_account_uid;
        $_SESSION[$this->getKeySessAuthUserIsAuthenticated()] = $isauthenticated;
        $_SESSION[$this->getKeySessAuthUsertablekey()] = $usersafety_account_usertablekey;
        $syslog->LogInfoEndFUNCTION("setAuthoritySessionData");
    }
    
    function setAuthoritySessionPageRedirectPageOverride($page_redirect_override)
    {
        $syslog = new KLogger();
        $syslog->LogInfoStartFUNCTION("setAuthoritySessionPageRedirectPageOverride");
        $_SESSION[$this->getKeySessAuthUserPageRedirectOverride()] = $page_redirect_override;
        $syslog->LogInfo("Page Redirect Override:{" . $this->getAuthUserPageRedirectOverride() . "}");
        $syslog->LogInfoEndFUNCTION("setAuthoritySessionPageRedirectPageOverride");
    }
    
    function getAuthUserUid(){ return $this->nullCheckSession($this->getKeySessAuthUserUid()); }
    function getAuthUserIsAuthenticated(){ return $this->nullCheckSession($this->getKeySessAuthUserIsAuthenticated()); }
    function getAuthUserSiteRole(){ return $this->nullCheckSession($this->getKeySessAuthUserSiteRole()); }
    function getAuthUserSiteRolePriority(){ return $this->nullCheckSession($this->getKeySessAuthUserSiteRolePriority()); }
    function getAuthUsertablekey(){ return $this->nullCheckSession($this->getKeySessAuthUsertablekey()); }
    function getAuthUserPageRedirectOverride(){ return $this->nullCheckSession($this->getKeySessAuthUserPageRedirectOverride()); }
        
    function cleanAuthoritySessionData()
    {
        $syslog = new KLogger();
        $syslog->LogInfoStartFUNCTION("cleanAuthoritySessionObjects");
        unset($_SESSION[$this->getKeySessAuthUserUid()]);
        unset($_SESSION[$this->getKeySessAuthUserIsAuthenticated()]);
        unset($_SESSION[$this->getKeySessAuthUserSiteRole()]);
        unset($_SESSION[$this->getKeySessAuthUserSiteRolePriority()]);
        unset($_SESSION[$this->getKeySessAuthUsertablekey()]);
        $syslog->LogInfoEndFUNCTION("cleanAuthoritySessionObjects");
    }
    
    function cleanAuthoritySessionPageRedirectPageOverride()
    {
        $syslog = new KLogger();
        $syslog->LogInfoStartFUNCTION("cleanAuthoritySessionPageRedirectPageOverride");
        unset($_SESSION[$this->getAuthUserPageRedirectOverride()]);
        $syslog->LogInfoEndFUNCTION("cleanAuthoritySessionPageRedirectPageOverride");
    }
    /** End - USER AUTHORITY DATA **/
    
    
    /** Start - UI RESPONSE DATA **/
    function setUIPageResponseData($code, $key, $msg, $showmsg = "TRUE")
    {
        $syslog = new KLogger();
        $syslog->LogInfoStartFUNCTION("setUIPageResponseData");
        $syslog->LogInfo("{".$this->getKeySessUIPageRespCode()."}-{".$code."}");
        $syslog->LogInfo("{".$this->getKeySessUIPageRespKey()."}-{".$key."}");
        $syslog->LogInfo("{".$this->getKeySessUIPageRespMsg()."}-{".$msg."}");
        $syslog->LogInfo("{".$this->getKeySessUIPageRespMsgShow()."}-{".strtoupper($showmsg)."}");
        $_SESSION[$this->getKeySessUIPageRespCode()] = $code;
        $_SESSION[$this->getKeySessUIPageRespKey()] = $key;
        $_SESSION[$this->getKeySessUIPageRespMsg()] = $msg;
        $_SESSION[$this->getKeySessUIPageRespMsgShow()] = strtoupper($showmsg);
        $syslog->LogInfoEndFUNCTION("setUIPageResponseData");
    }
    
    function getUIPageResponseCode(){ return $this->nullCheckSession($this->getKeySessUIPageRespCode()); }
    function getUIPageResponseKey(){ return $this->nullCheckSession($this->getKeySessUIPageRespKey()); }
    function getUIPageResponseMsg(){ return $this->nullCheckSession($this->getKeySessUIPageRespMsg()); }
    function getUIPageResponseMsgShow(){ return $this->nullCheckSession($this->getKeySessUIPageRespMsgShow()); }
    
    function cleanUIPageResponseData()
    {
        $syslog = new KLogger();
        $syslog->LogInfoStartFUNCTION("cleanUIPageResponseData");
        unset($_SESSION[$this->getKeySessUIPageRespCode()]);
        unset($_SESSION[$this->getKeySessUIPageRespKey()]);
        unset($_SESSION[$this->getKeySessUIPageRespMsg()]);
        unset($_SESSION[$this->getKeySessUIPageRespMsgShow()]);
        $syslog->LogInfoEndFUNCTION("cleanUIPageResponseData");
    }
    /** End - UI RESPONSE DATA **/
    
    
    /** Start - APPLICATION_DATA **/
    function setAppData($name, $value)
    {
        $syslog = new KLogger();
        $syslog->LogInfoStartFUNCTION("setAppData");
        $_SESSION[$this->getKeySessAppDataPrefix().$name] = $value;
        $this->dumpSessionData();
        $syslog->LogInfoEndFUNCTION("setAppData");
    }
    
    function getAppData($name)
    {
        $value = "";
        $prefix = $this->getKeySessAppDataPrefix();
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

    function cleanAppDataName($name)
    {
        $syslog = new KLogger();
        $syslog->LogInfoStartFUNCTION("cleanAppData");
        $prefix = $this->getKeySessAppDataPrefix();
        foreach ($_SESSION as $sessname => $sessvalue)
        {
            if(strlen($sessname) > strlen($prefix))
            {
                if(substr($sessname, strlen($prefix), strlen($sessname)) == $name)
                {
                    unset($_SESSION[$this->getKeySessAppDataPrefix().$name]);
                }
            }
        }
        $syslog->LogInfoEndFUNCTION("cleanAppData");
    }

    function cleanAppData($name)
    {
        $syslog = new KLogger();
        $syslog->LogInfoStartFUNCTION("cleanAppData");
        $prefix = $this->getKeySessAppDataPrefix();
        foreach ($_SESSION as $sessname => $sessvalue)
        {
            if(strlen($sessname) > strlen($prefix))
            {
                unset($_SESSION[$this->getKeySessAppDataPrefix().$name]);
            }
        }
        $syslog->LogInfoEndFUNCTION("cleanAppData");
    }
    /** End - APPLICATION_DATA **/
    
    function nullCheckSession($name)
    {
        $value = "";
        if(isset($_SESSION[$name]))
            $value = $_SESSION[$name];
        return $value;
    }
    
    function getKeySessUIPageRespCode(){return "UI_PAGE_RESPONSE_CODE";}
    function getKeySessUIPageRespKey(){return "UI_PAGE_RESPONSE_KEY";}
    function getKeySessUIPageRespMsg(){return "UI_PAGE_RESPONSE_MSG";}
    function getKeySessUIPageRespMsgShow(){return "UI_PAGE_RESPONSE_MSG_SHOW";}
    
    function getKeySessAuthUserUid(){return "GD_CORP_AUTH_USER_UID";}
    function getKeySessAuthUserIsAuthenticated(){return "GD_CORP_AUTH_ISUSERAUTHENTICATED_TF";}
    function getKeySessAuthUserSiteRole(){return "GD_CORP_AUTH_SITE_ROLE";}
    function getKeySessAuthUserSiteRolePriority(){return "GD_CORP_AUTH_SITE_ROLE_PRIORITY";}
    function getKeySessAuthUsertablekey(){return "GD_CORP_AUTH_USER_TABLE_KEY";}
    function getKeySessAuthUserPageRedirectOverride(){return "GD_CORP_AUTH_USER_PAGE_REDIRECT_OVERRIDE";}
    
    function getKeySessSiteUid(){return "GUYVERDESIGNS_SITE_UID";}
    function getKeySessSite(){return "GUYVERDESIGNS_SITE";}
    function getKeySessSiteAliasUid(){return "GUYVERDESIGNS_SITE_ALIAS_UID";}
    function getKeySessSiteAlias(){return "GUYVERDESIGNS_SITE_ALIAS";}
    function getKeySessSiteConfigRoot(){return "GUYVERDESIGNS_SITE_CONFIGURATION_ROOT";}
    
    function getKeySessAppDataPrefix(){return "GUYVERDESIGNS_APP_DATA";}

    function dumpSessionData()
    {
        $syslog = new KLogger();
        foreach ($_SESSION as $sessname => $sessvalue)
        {
            $syslog->LogDebug("SESSION:NAME-{".$sessname."}:VALUE-{".$sessvalue."}");
        }
    }
    
    function redirectToUIPage($code, $key, $msg, $showmsg = "TRUE", $location)
    {
        $syslog = new KLogger();
        $syslog->LogInfoStartFUNCTION("redirectToUIPage");
        $this->cleanUIPageResponseData();
        $this->setUIPageResponseData($code, $key, $msg, strtoupper($showmsg));
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
    private $not_authorized_page = "/gd.trxn.com/usersafety/index.php";
    function getRedirectAuthFailPage()
    {
        return $this->not_authorized_page;
    }
    
    private $user_logged_in_correctly = "/gd.trxn.com/usersafety/s_user_home.php";
    function getRedirectAuthLoggedinPage()
    {
        return $this->user_logged_in_correctly;
    }
    
    private $user_logged_off_correctly = "/gd.trxn.com/usersafety/s_user_home.php";
    function getRedirectAuthLoggedoffPage()
    {
        return $this->user_logged_off_correctly;
    }
    
    private $user_change_password = "/gd.trxn.com/usersafety/changepassword.php";
    function getRedirectAuthChangePasswordPage()
    {
        return $this->user_change_password;
    }
    
    private $email_support_account = "support@guyverdesigns.com";
    function getEmailSupportAccount()
    {
        return $this->email_support_account;
    }
    
    private $email_admin_account = "stephen@guyverdesigns.com";
    function getEmailAdminAccount()
    {
        return $this->email_admin_account;
    }
    
    private $default_page_title = "SeeMeU - Education, Access and Collaboration for All";
    function setDefaultPageTitle($pageTitle)
    {
        $this->default_page_title = $pageTitle;
    }
    
    function getDefaultPageTitle()
    {
        return $this->default_page_title;
    }
}
?>