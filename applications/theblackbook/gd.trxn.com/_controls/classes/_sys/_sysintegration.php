<?php
class SysIntegration
{
    function setZBaseLines()
    {
        if (!isset($_SESSION["GD_SITE_DEFINED"]))
        {
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
                $_SESSION[$this->getKeySessSite()] = $f[sizeof($f) - 2];
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
        zLog()->LogStart_Function("setZSiteRegistration");
        if (!isset($_SESSION[$this->getKeySessSiteUid()])
            || !isset($_SESSION[$this->getKeySessSiteAliasUid()])
            || !isset($_SESSION[$this->getKeySessSite()])
            || !isset($_SESSION[$this->getKeySessSiteAlias()]))
        {
            zLog()->LogDebug("Site has not been setup in Session");
            zReqOnce("/gd.trxn.com/_controls/classes/dataobjects/retrieve/siteandalias.php");
            zReqOnce("/gd.trxn.com/_controls/classes/dataobjects/create/siteandalias.php");

            $rsa = new RetrieveSiteandAlias();
            
            $rsa->isSiteandAliasValid();
            if($rsa->getSysReturnCode() == "RECORD_IS_FOUND")  // Checking to see if Site and Alias exist and are matched
            {
                zLog()->LogDebug("Site has been registered in the database.  Set to Session");
                
                $_SESSION["GUYVERDESIGNS_SITE_UID"] = $rsa->getResult_RecordField($rsa->dbf("site.uid"));
                $_SESSION["GUYVERDESIGNS_SITE"] = $rsa->getResult_RecordField($rsa->dbf("site.sdesc"));
                $_SESSION["GUYVERDESIGNS_SITE_ALIAS_UID"] = $rsa->getResult_RecordField($rsa->dbf("sitealias.uid"));
                $_SESSION["GUYVERDESIGNS_SITE_ALIAS"] = $rsa->getResult_RecordField($rsa->dbf("sitealias.sdesc"));
            }
            else if($rsa->getSysReturnCode() == "RECORD_IS_NOT_FOUND")
            {
                zLog()->LogDebug("Site has not been registered in the database.  Register into Database");
                
                $csa = new CreateSiteandAlias();
                $tr = $rsa->doesSiteExist();
                if($rsa->getSysReturnCode() == "RECORD_IS_FOUND")
                {
                    $_SESSION["GUYVERDESIGNS_SITE_UID"] = $rsa->getResult_RecordField("uid");
                    $_SESSION["GUYVERDESIGNS_SITE"] = $rsa->getResult_RecordField("sdesc");
                }
                else if($rsa->getSysReturnCode() == "RECORD_IS_NOT_FOUND")
                {
                    $csa->registerSite();
                    $_SESSION["GUYVERDESIGNS_SITE_UID"] = $csa->getResult_RecordField("uid");
                    $_SESSION["GUYVERDESIGNS_SITE"] = $csa->getResult_RecordField("sdesc");
                }
                
                $csa->registerSiteAlias();
                $_SESSION["GUYVERDESIGNS_SITE_ALIAS_UID"] = $csa->getResult_RecordField("uid");
                $_SESSION["GUYVERDESIGNS_SITE_ALIAS"] = $csa->getResult_RecordField("sdesc");
                
                $csa->matchSiteandSiteAlias($_SESSION["GUYVERDESIGNS_SITE_UID"],
                                            $_SESSION["GUYVERDESIGNS_SITE_ALIAS_UID"]);
            }
        }
        zLog()->LogDebug("Site has been setup in Session");
        
        zLog()->LogDebug("[".$this->getKeySessSiteUid()."]:[".$_SESSION[$this->getKeySessSiteUid()]."]");
        zLog()->LogDebug("[".$this->getKeySessSite()."]:[".$_SESSION[$this->getKeySessSite()]."]");
        zLog()->LogDebug("[".$this->getKeySessSiteAliasUid()."]:[".$_SESSION[$this->getKeySessSiteAliasUid()]."]");
        zLog()->LogDebug("[".$this->getKeySessSiteAlias()."]:[".$_SESSION[$this->getKeySessSiteAlias()]."]");
        zLog()->LogDebug("[SHAGGY_TEST]:[".$_SESSION["SHAGGY_TEST"]."]");
        
        zLog()->LogEnd_Function("setZSiteRegistration");
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
        zLog()->LogStart_Function("setSiteControlData");
        $this->setSiteData($siteuid, $site);
        $this->setSiteAliasData($sitealiasuid, $sitealias);
        zLog()->LogEnd_Function("setSiteControlData");
    }
    
    function setSiteData($siteuid, $site)
    {
        zLog()->LogStart_Function("setSiteData");
        $_SESSION[$this->getKeySessSiteUid()] = $siteuid;
        $_SESSION[$this->getKeySessSite()] = $site;
        zLog()->LogEnd_Function("setSiteData");
    }
    
    function setSiteAliasData($sitealiasuid, $sitealias)
    {
        zLog()->LogStart_Function("setSiteAliasData");
        $_SESSION[$this->getKeySessSiteAliasUid()] = $sitealiasuid;
        $_SESSION[$this->getKeySessSiteAlias()] = $sitealias;
        zLog()->LogEnd_Function("setSiteAliasData");
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
        zLog()->LogStart_Function("setAuthoritySessionData");
        $_SESSION[$this->getKeySessAuthUserUid()] = $usersafety_account_uid;
        $_SESSION[$this->getKeySessAuthUserIsAuthenticated()] = $isauthenticated;
        $_SESSION[$this->getKeySessAuthUsertablekey()] = $usersafety_account_usertablekey;
        zLog()->LogEnd_Function("setAuthoritySessionData");
    }
    
    function setAuthoritySessionPageRedirectPageOverride($page_redirect_override)
    {
        zLog()->LogStart_Function("setAuthoritySessionPageRedirectPageOverride");
        $_SESSION[$this->getKeySessAuthUserPageRedirectOverride()] = $page_redirect_override;
        $logger->LogDebug("Page Redirect Override:{" . $this->getAuthUserPageRedirectOverride() . "}");
        zLog()->LogEnd_Function("setAuthoritySessionPageRedirectPageOverride");
    }
    
    function getAuthUserUid(){ return $this->nullCheckSession($this->getKeySessAuthUserUid()); }
    function getAuthUserIsAuthenticated(){ return $this->nullCheckSession($this->getKeySessAuthUserIsAuthenticated()); }
    function getAuthUserSiteRole(){ return $this->nullCheckSession($this->getKeySessAuthUserSiteRole()); }
    function getAuthUserSiteRolePriority(){ return $this->nullCheckSession($this->getKeySessAuthUserSiteRolePriority()); }
    function getAuthUsertablekey(){ return $this->nullCheckSession($this->getKeySessAuthUsertablekey()); }
    function getAuthUserPageRedirectOverride(){ return $this->nullCheckSession($this->getKeySessAuthUserPageRedirectOverride()); }
        
    function cleanAuthoritySessionData()
    {
        zLog()->LogStart_Function("cleanAuthoritySessionObjects");
        unset($_SESSION[$this->getKeySessAuthUserUid()]);
        unset($_SESSION[$this->getKeySessAuthUserIsAuthenticated()]);
        unset($_SESSION[$this->getKeySessAuthUserSiteRole()]);
        unset($_SESSION[$this->getKeySessAuthUserSiteRolePriority()]);
        unset($_SESSION[$this->getKeySessAuthUsertablekey()]);
        zLog()->LogEnd_Function("cleanAuthoritySessionObjects");
    }
    
    function cleanAuthoritySessionPageRedirectPageOverride()
    {
        zLog()->LogStart_Function("cleanAuthoritySessionPageRedirectPageOverride");
        unset($_SESSION[$this->getAuthUserPageRedirectOverride()]);
        zLog()->LogEnd_Function("cleanAuthoritySessionPageRedirectPageOverride");
    }
    /** End - USER AUTHORITY DATA **/
    
    
    /** Start - UI RESPONSE DATA **/
    function setUIPageResponseData($code, $msg, $showmsg = "TRUE")
    {
        zLog()->LogStart_Function("setUIPageResponseData");
        zLog()->LogDebug("{".$this->getKeySessUIPageRespCode()."}-{".$code."}");
        zLog()->LogDebug("{".$this->getKeySessUIPageRespMsg()."}-{".$msg."}");
        zLog()->LogDebug("{".$this->getKeySessUIPageRespMsgShow()."}-{".strtoupper($showmsg)."}");
        $_SESSION[$this->getKeySessUIPageRespCode()] = $code;
        $_SESSION[$this->getKeySessUIPageRespMsg()] = $msg;
        $_SESSION[$this->getKeySessUIPageRespMsgShow()] = strtoupper($showmsg);
        zLog()->LogEnd_Function("setUIPageResponseData");
    }
    
    function getUIPageResponseCode(){ return $this->nullCheckSession($this->getKeySessUIPageRespCode()); }
    function getUIPageResponseMsg(){ return $this->nullCheckSession($this->getKeySessUIPageRespMsg()); }
    function getUIPageResponseMsgShow(){ return $this->nullCheckSession($this->getKeySessUIPageRespMsgShow()); }
    
    function cleanUIPageResponseData()
    {
        zLog()->LogStart_Function("cleanUIPageResponseData");
        unset($_SESSION[$this->getKeySessUIPageRespCode()]);
        unset($_SESSION[$this->getKeySessUIPageRespMsg()]);
        unset($_SESSION[$this->getKeySessUIPageRespMsgShow()]);
        zLog()->LogEnd_Function("cleanUIPageResponseData");
    }
    /** End - UI RESPONSE DATA **/
    
    
    /** Start - APPLICATION_DATA **/
    function setAppData($name, $value)
    {
        zLog()->LogStart_Function("setAppData");
        $_SESSION[$this->getKeySessAppDataPrefix().$name] = $value;
        $this->dumpSessionData();
        zLog()->LogEnd_Function("setAppData");
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
        zLog()->LogStart_Function("cleanAppData");
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
        zLog()->LogEnd_Function("cleanAppData");
    }

    function cleanAppData($name)
    {
        zLog()->LogStart_Function("cleanAppData");
        $prefix = $this->getKeySessAppDataPrefix();
        foreach ($_SESSION as $sessname => $sessvalue)
        {
            if(strlen($sessname) > strlen($prefix))
            {
                unset($_SESSION[$this->getKeySessAppDataPrefix().$name]);
            }
        }
        zLog()->LogEnd_Function("cleanAppData");
    }
    /** End - APPLICATION_DATA **/
    
    function nullCheckSession($name)
    {
        $value = "";
        if(isset($_SESSION[$name]))
            $value = $_SESSION[$name];
        return $value;
    }
    
    static function getKeySessUIPageRespCode(){return "UI_PAGE_RESPONSE_CODE";}
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
    
    function dumpSessionData()
    {
        foreach ($_SESSION as $sessname => $sessvalue)
        {
            if(gettype($sessvalue) == "string")
            {
                zLog()->LogDebug("SESSION:NAME-[".$sessname."]:[".$sessvalue."]");
            }
        }
    }
    
    function redirectToUIPage($code, $msg, $showmsg, $location)
    {
        zLog()->LogStart_Function("redirectToUIPage");
        $this->cleanUIPageResponseData();
        $this->setUIPageResponseData($code, $msg, strtoupper($showmsg));
        zLog()->LogDebug("{location}-{".$location."}");
        zLog()->LogEnd_Function("redirectToUIPage");
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
    private $user_not_authorized_url = "/gd.trxn.com/usersafety/index.php";
    function getRedirectUserNotAuthorizedUrl()
    {
        return $this->user_not_authorized_url;
    }
    
    private $user_logged_on_successfully_url = "/s_user_home.php";
    function getRedirectUserLoggedOnSuccessfullyUrl()
    {
        return $this->user_logged_on_successfully_url;
    }
    
    private $user_logged_off_successfully_url = "/gd.trxn.com/usersafety/index.php";
    function getRedirectUserLoggedOffSuccessfullyUrl()
    {
        return $this->user_logged_off_successfully_url;
    }
    
    private $user_change_password_url = "/gd.trxn.com/usersafety/changepassword.php";
    function getRedirectUserChangePasswordUrl()
    {
        return $this->user_change_password_url;
    }
    
    private $user_login_url = "/gd.trxn.com/usersafety/login.php";
    function getRedirectUserLoginUrl()
    {
        return $this->user_login_url;
    }
    
    private $general_error_url = "/gd.trxn.com/system/error.php";
    function getRedirectGeneralErrorUrl()
    {
        return $this->general_error_url;
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