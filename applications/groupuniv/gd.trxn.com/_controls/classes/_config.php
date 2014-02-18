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
                    $_SESSION["GUYVERDESIGNS_SERVER_ENVIRONMENT"] = "LCL";
            }
            
            /** Site Information **/
            $f = explode("/", $_SERVER["DOCUMENT_ROOT"]);
            if($_SESSION["GUYVERDESIGNS_SERVER_ENVIRONMENT"] == "LCL")
                $_SESSION["GUYVERDESIGNS_SITE"] = $f[sizeof($f) - 1];
            else
                $_SESSION["GUYVERDESIGNS_SITE"] = $f[sizeof($f) - 4].".".$f[sizeof($f) - 2].".".$f[sizeof($f) - 1];
            $_SESSION["GUYVERDESIGNS_SITE_ALIAS"] = $_SERVER["HTTP_HOST"];
            
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
            
            $_SESSION["GD_LOG_LOCATION"] = $logpath."/".$_SESSION["GUYVERDESIGNS_SITE"].".txt";
        }
    }

    static function setSiteRegistration()
    {
        require_once("KLogger.php");
        $zgdlog = new KLogger();
        if (!isset($_SESSION["GUYVERDESIGNS_SITE_UID"]) || !isset($_SESSION["GUYVERDESIGNS_SITE_ALIAS_UID"])
            || !isset($_SESSION["GUYVERDESIGNS_SITE"]) || !isset($_SESSION["GUYVERDESIGNS_SITE_ALIAS"]))
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

            $zgdlog->LogInfo("_config.php:Session Object Found");
        }
    }

    static function getSubDomainDocumentRoot()
    {
        return $_SERVER["SUBDOMAIN_DOCUMENT_ROOT"];
    }
    
    private $zgdlog;
    function gdlog()
    {
        if(!isset($this->zgdlog))
            $this->zgdlog = new KLogger();
        return $this->zgdlog;
    }
}
?>