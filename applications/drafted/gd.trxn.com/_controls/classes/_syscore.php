<?php
/** Set sub domain document root for standardized _controls **/
if (!isset($_SERVER["SUBDOMAIN_DOCUMENT_ROOT"]))
    $_SERVER["SUBDOMAIN_DOCUMENT_ROOT"] = $_SERVER["CONTEXT_DOCUMENT_ROOT"];
$_SERVER["DOCUMENT_ROOT"] = $_SERVER["SUBDOMAIN_DOCUMENT_ROOT"];

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

function zLog()
{
    if(!isset($_SERVER["GD_APPSYSLOGGER"]))
    {
        zReqOnce("/gd.trxn.com/_controls/classes/KLogger.php");
        $_SERVER["GD_APPSYSLOGGER"] = new KLogger();
    }
    return $_SERVER["GD_APPSYSLOGGER"];
}

function zAuth()
{
    if(!isset($_SERVER["GD_APPSYSAUTHORIZATION"]))
    {
        zReqOnce("/gd.trxn.com/usersafety/_controls/classes/authorityuser.php");
        $_SERVER["GD_APPSYSAUTHORIZATION"] = new zcAuthorizeUser();
    }
    return $_SERVER["GD_APPSYSAUTHORIZATION"];
}

zReqOnce("/gd.trxn.com/_controls/classes/_sys/_returns.php");
$zSysReturn = new SysReturns();

//** START ** Sets the Site Integration after the Includes are set 
zReqOnce("/_controls/classes/_sys/_appsysintegration.php");
function zAppSysIntegration()
{
    if(!isset($_SERVER["GD_APPSYSINTEGATION"]))
        $_SERVER["GD_APPSYSINTEGATION"] = new AppSysIntegration();
    return $_SERVER["GD_APPSYSINTEGATION"];
}
zAppSysIntegration()->setZBaseLines();
zAppSysIntegration()->setZLogging(1);
zAppSysIntegration()->setZSiteRegistration();
//** END ** Sets the Site Integration after the Includes are set
zReqOnce("/gd.trxn.com/_controls/classes/_sys/includes/_service.php");
?>