<?php gdreqonce("/gd.trxn.com/_controls/classes/sites/validation.php"); ?>
<?php gdreqonce("/gd.trxn.com/_controls/classes/roles/initialization.php"); ?>
<?php
class ZGDConfigurations
{
    private $isCoreConfigSet = false;
    private $subdomaindocroot = "SUBDOMAIN_DOCUMENT_ROOT"; 
    function __construct()
    {

    }
    
    function setSite()
    {
        if($this->isCoreConfigSet == false)
        {
            session_start();
            /** Set sub domain document root for standardized _controls **/
            if (!isset($_SERVER["SUBDOMAIN_DOCUMENT_ROOT"]))
                $_SERVER["SUBDOMAIN_DOCUMENT_ROOT"] = $_SERVER["CONTEXT_DOCUMENT_ROOT"];
            $_SERVER["DOCUMENT_ROOT"] = $_SERVER["SUBDOMAIN_DOCUMENT_ROOT"];
            
            /** Set the Landscape identifier so we can run configurations based on Environment **/
            if (!isset($_SERVER["GUYVERDESIGNS_SERVER_ENVIRONMENT"]))
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
            
            $this->isCoreConfigSet = true;
        }
    }

    function setGDLogging($loglevel = 6)
    {
        /** Set sub domain document root for standardized _controls **/
        if (!isset($_SERVER["GDLOG_LOCATION"]))
        {
            $DEBUG     = 1;    // Most Verbose
            $INFO      = 2;    // ...
            $WARN      = 3;    // ...
            $ERROR     = 4;    // ...
            $FATAL     = 5;    // Least Verbose
            $OFF       = 6;    // Nothing at all.
            if($loglevel == $DEBUG)
                $_SERVER["GDLOG_PRIORITY"] = $DEBUG;
            else if($loglevel == $INFO)
                $_SERVER["GDLOG_PRIORITY"] = $INFO;
            else if($loglevel == $WARN)
                $_SERVER["GDLOG_PRIORITY"] = $WARN;
            else if($loglevel == $ERROR)
                $_SERVER["GDLOG_PRIORITY"] = $ERROR;
            else if($loglevel == $FATAL)
                $_SERVER["GDLOG_PRIORITY"] = $FATAL;
            else if($loglevel == $OFF)
                $_SERVER["GDLOG_PRIORITY"] = $OFF;
            
            $f = explode("/", $_SERVER["DOCUMENT_ROOT"]);
            $logpath = substr($_SERVER["DOCUMENT_ROOT"], 0, -strlen($f[sizeof($f) - 1]));
            $_SERVER["GDLOG_LOCATION"] = $logpath."/".$_SESSION["GUYVERDESIGNS_SITE"].".txt";
        }
    }

    function setSiteRegistration()
    {
        if (!isset($_SESSION["GUYVERDESIGNS_SITE_UID"]) || !isset($_SESSION["GUYVERDESIGNS_SITE_ALIAS_UID"])
            || !isset($_SESSION["GUYVERDESIGNS_SITE"]) || !isset($_SESSION["GUYVERDESIGNS_SITE_ALIAS"]))
        {
            $this->gdlog()->LogInfo("_core.php:Session Object not Found");
            $zgdsa = new ZGDSiteAlias();
            if(!$zgdsa->isSiteandAliasValid())  // Checkign to see if Site and Alias exist and are matched
            {
                $this->gdlog()->LogInfo("Site and Site Alias Not Valid");
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
                    $this->gdlog()->LogInfo("Site Not Found");
                    $zgdsa->registerSite();
                    $zgdroles = new ZGDRoles();
                    $zgdroles->registerRolestoNewSite();
                 }
        
                $zgdsa->registerSiteAlias();
                $zgdsa->matchSiteandSiteAlias();
            }
            else
            {
                $this->gdlog()->LogInfo("_core.php:Site and Site Alias Valid");
            }
        }
        else
        {
            $this->gdlog()->LogInfo("_core.php:Session Object Found");
        }
    }

    function getSubDomainDocumentRoot()
    {
        return $_SERVER["SUBDOMAIN_DOCUMENT_ROOT"];
    }
}
?>