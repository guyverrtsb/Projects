<?php require_once("_config.php") ?>
<?php
$zgdconfigs = new ZGDConfigurations();
$zgdconfigs->setSite();
$zgdconfigs->setGDLogging();

/** Include method that uses the standardized subdomain **/
function gdincvar($path, $lvar="")
{
    $o = $zgdconfigs->getSubDomainDocumentRoot() . $path;
    return include($o);
}

/** Include method that uses the standardized subdomain **/
function gdinc($path)
{
    $o = $zgdconfigs->getSubDomainDocumentRoot() . $path;
    return include($o);
}

/** Include method that uses the standardized subdomain **/
function gdreq($path)
{
    $o = $zgdconfigs->getSubDomainDocumentRoot() . $path;
    return require $o;
}

/** Include method that uses the standardized subdomain **/
function gdreqonce($path)
{
    $o = $zgdconfigs->getSubDomainDocumentRoot() . $path;
    return require_once($o);
}
?>