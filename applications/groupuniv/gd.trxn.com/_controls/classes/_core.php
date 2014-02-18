<?php
require_once("_config.php");
ZGDConfigurations::setSite();
ZGDConfigurations::setGDLogging(1);
ZGDConfigurations::setSiteRegistration();


/** Include method that uses the standardized subdomain **/
function gdincvar($path, $lvar="")
{
    $o = ZGDConfigurations::getSubDomainDocumentRoot() . $path;
    return include($o);
}

/** Include method that uses the standardized subdomain **/
function gdinc($path)
{
    $o = ZGDConfigurations::getSubDomainDocumentRoot() . $path;
    return include($o);
}

/** Include method that uses the standardized subdomain **/
function gdreq($path)
{
    $o = ZGDConfigurations::getSubDomainDocumentRoot() . $path;
    return require $o;
}

/** Include method that uses the standardized subdomain **/
function gdreqonce($path)
{
    $o = ZGDConfigurations::getSubDomainDocumentRoot() . $path;
    return require_once($o);
}

function gdlog()
{
    gdreqonce("/gd.trxn.com/_controls/classes/KLogger.php");
    return new KLogger();
}
?>