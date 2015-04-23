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
    zReqOnce("/gd.trxn.com/_controls/classes/KLogger.php");
    return new KLogger();
}

function zConfig()
{
    zReqOnce("/_controls/classes/_sys/_appsysintegration.php");
    return new AppSysIntegration();
}

function zAuth()
{
    zReqOnce("/gd.trxn.com/usersafety/_controls/classes/authorityuser.php");
    return new gdAuthorizeUser();
}

zReqOnce("/gd.trxn.com/_controls/classes/_sys/_returns.php");
$zcSysReturn = new SysReturns();

//** START ** Sets the Site Integration after the Includes are set 
zReqOnce("/_controls/classes/_sys/_appsysintegration.php");
SysIntegration::setZBaseLines();
SysIntegration::setZLogging(1);
SysIntegration::setZSiteRegistration();
//** END ** Sets the Site Integration after the Includes are set
zReqOnce("/gd.trxn.com/_controls/classes/_sys/includes/_ajax.php");

?>