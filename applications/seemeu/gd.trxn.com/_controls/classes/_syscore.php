<?php
/** Set sub domain document root for standardized _controls **/
if (!isset($_SERVER["SUBDOMAIN_DOCUMENT_ROOT"]))
    $_SERVER["SUBDOMAIN_DOCUMENT_ROOT"] = $_SERVER["CONTEXT_DOCUMENT_ROOT"];
$_SERVER["DOCUMENT_ROOT"] = $_SERVER["SUBDOMAIN_DOCUMENT_ROOT"];
?>
<?php require_once($_SERVER["SUBDOMAIN_DOCUMENT_ROOT"]."/_controls/classes/_sys/_appsysintegration.php"); ?>
<?php
SysIntegration::setZBaseLines();
SysIntegration::setZLogging(1);
SysIntegration::setZSiteRegistration();

/** Include method that uses the standardized subdomain **/
function zIncVar($path, $lvar="")
{
    return include(SysIntegration::getPathing($path));
}

/** Include method that uses the standardized subdomain **/
function zInc($path)
{
    return include(SysIntegration::getPathing($path));
}

/** Include method that uses the standardized subdomain **/
function zReq($path)
{
    return require SysIntegration::getPathing($path);
}

/** Include method that uses the standardized subdomain **/
function zReqOnce($path)
{
    return require_once(SysIntegration::getPathing($path));
}

function zLog()
{
    zReqOnce("/gd.trxn.com/_controls/classes/KLogger.php");
    return new KLogger();
}

function zConfig()
{
    zReqOnce("/_controls/classes/base/_appsysintegrations.php");
    return new AppSysIntegration();
}

function zAuth()
{
    zReqOnce("/gd.trxn.com/usersafety/_controls/classes/authorityuser.php");
    return new gdAuthorizeUser();
}

function setPageKey($key)
{
    $_REQUEST["PAGE_KEY"] = strtoupper($key);
}

function getPageKey()
{
    if(!isset($_REQUEST["PAGE_KEY"]))
        $_REQUEST["PAGE_KEY"] = "";
    return $_REQUEST["PAGE_KEY"];
}

function getControlKey()
{
    zLog()->LogInfoStartFUNCTION("getControlKey()");
    $controlkey = "INVALID";
    if(isset($_POST["AJAX_SERVICE_CONTROL_KEY"]))
    {
        zLog()->LogInfo("POST:AJAX_SERVICE_CONTROL_KEY:ISSET");
        $controlkey = filter_var($_POST["AJAX_SERVICE_CONTROL_KEY"], FILTER_SANITIZE_STRING);
        if($controlkey == "")
        {
            $controlkey = "INVALID";
            if(isset($_GET["AJAX_SERVICE_CONTROL_KEY"]))
            {
                $controlkey = filter_var($_GET["AJAX_SERVICE_CONTROL_KEY"], FILTER_SANITIZE_STRING);
                if($controlkey == "")
                {
                    $controlkey = "INVALID";
                    zLog()->LogInfo("POST:AJAX_SERVICE_CONTROL_KEY:".$gdcontrolkey);
                }
            }
        }
    }
    else if(isset($_GET["AJAX_SERVICE_CONTROL_KEY"]))
    {
        zLog()->LogInfo("GET:AJAX_SERVICE_CONTROL_KEY:ISSET");
        $controlkey = filter_var($_GET["AJAX_SERVICE_CONTROL_KEY"], FILTER_SANITIZE_STRING);
        if($controlkey == "")
        {
            $controlkey = "INVALID";
            zLog()->LogInfo("GET:AJAX_SERVICE_CONTROL_KEY:".$controlkey);
        }
    }
    zLog()->LogInfo("getControlKey{".$controlkey."}");
    zLog()->LogInfoEndFUNCTION("getControlKey()");
    return $controlkey;
}

/*
 * Arg [1] = "RETURN"
 * Arg [2] = VALUE
 * Arg [3] ODD = Name of structure
 * Arg [4] EVEN = is value of Structure
 */
function buildReturnArray()
{
    zLog()->LogInfoStartFUNCTION("buildReturnArray");
    $retary = new ArrayObject();
    $args = func_get_args();
    $msgshowcaught = false;
    $msgcaught = false;
    for ($idx = 0; $idx < func_num_args(); $idx++)
    {
        $name = func_get_arg($idx);
        $idx++;
        $valu = func_get_arg($idx);
        zLog()->LogInfo($name."{".$valu."}");
        $retary[strtoupper($name)] = $valu;
        if(strtoupper($name) == "RETURN_SHOW_MSG")
            $msgshowcaught = true;
        if(strtoupper($name) == "RETURN_MSG")
            $msgcaught = true;
    }
    
    if(!$msgshowcaught)
        $retary["RETURN_SHOW_MSG"] = "TRUE";    
    if(!$msgcaught)
        $retary["RETURN_MSG"] = "No message defined.";
    
    zLog()->LogInfoEndFUNCTION("buildReturnArray");
    return $retary;
}

function gdLogEchoReturn($ret)
{
    zLog()->LogInfo("RETURN Output Echo{".$ret."}");
}

/**
 * Look at possible extending this out
 */
function validateFormforBlanks()
{
    $fv = true;  // Form is Valid Key T=Valid; anything else is invalid;
    $fieldfailed = "NONE";
    /*
    $numargs = func_num_args();
    if ($numargs >= 2) {
        echo "Second argument is: " . func_get_arg (1) . "<br />\n";
    }
     */
    $args = func_get_args();
    foreach ($args as $idx => $name)
    {
        if (!isset($_POST[$name]) || $_POST[$name] == "")
        {
            zLog()->LogInfo("Bad Field :{".$name."}");
            $fieldfailed = "email";
        }
    }
    
    if($fieldfailed == "NONE")
        return true;
    else
        return false;
}

function ajaxValidationLogging($retTF, $ajaxfile, $fieldfailed)
{
    zLog()->LogInfo($funcname." :{".$fieldfailed."}");
    return $retTF; 
}
?>