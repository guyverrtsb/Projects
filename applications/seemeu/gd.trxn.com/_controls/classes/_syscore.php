<?php
session_start();
/** Set sub domain document root for standardized _controls **/
if (!isset($_SERVER["SUBDOMAIN_DOCUMENT_ROOT"]))
    $_SERVER["SUBDOMAIN_DOCUMENT_ROOT"] = $_SERVER["CONTEXT_DOCUMENT_ROOT"];
$_SERVER["DOCUMENT_ROOT"] = $_SERVER["SUBDOMAIN_DOCUMENT_ROOT"];
$_SESSION["SHAGGY_TEST"] = "carzy value";
function getPathing($path)
{
    if(substr($path, 0, 1) == "/")
        $path = $_SERVER["SUBDOMAIN_DOCUMENT_ROOT"].$path;
    return $path;
}

/** Include method that uses the standardized subdomain **/
function zIncVar($path, $lvar="")
{
    return include(getPathing($path));
}
/** Include method that uses the standardized subdomain **/
function zInc($path)
{
    return include(getPathing($path));
}

/** Include method that uses the standardized subdomain **/
function zReq($path)
{
    return require(getPathing($path));
}

/** Include method that uses the standardized subdomain **/
function zReqOnce($path)
{
    return require_once(getPathing($path));
}

/*
zReqOnce("/gd.trxn.com/usersafety/_controls/classes/authorityuser.php");
function zAuth()
{
    if(!isset($_SESSION["GD_APPSYSAUTHORIZATION"]))
    {
        $_SESSION["GD_APPSYSAUTHORIZATION"] = new zcAuthorizeUser();
    }
    return $_SESSION["GD_APPSYSAUTHORIZATION"];
}
 */
zReqOnce("/gd.trxn.com/_controls/classes/KLogger.php");
function zLog()
{
    return new KLogger();
}
zReqOnce("/gd.trxn.com/_controls/classes/_sys/_returns.php");
$zSysReturn = new SysReturns();

//** START ** Sets the Site Integration after the Includes are set 
zReqOnce("/_controls/classes/_sys/_appsysintegration.php");
function zAppSysIntegration()
{
    $appSysIntegration = new AppSysIntegration();
    
    if(!isset($_SESSION["GD_APP_SYS_INTEGRATION"]))
    {
        $_SESSION["GD_APP_SYS_INTEGRATION"] = "PERFORMED";
        $appSysIntegration->setZBaseLines();
        $appSysIntegration->setZLogging(1);
        zLog()->LogAllPageDeclaration();
        $appSysIntegration->setZSiteRegistration();
        zLog()->LogDebug("zAppSysIntegration()::Ceated");
    }

    
    return $appSysIntegration;
}

//** END ** Sets the Site Integration after the Includes are set
zReqOnce("/gd.trxn.com/_controls/classes/_sys/includes/_service.php");
?>