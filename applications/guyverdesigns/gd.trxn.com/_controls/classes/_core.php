<?php
require_once("_config.php");
ZGDConfigurations::setSite();
ZGDConfigurations::setGDLogging(1);
ZGDConfigurations::setSiteRegistration();


/** Include method that uses the standardized subdomain **/
function gdincvar($path, $lvar="")
{
    return include(ZGDConfigurations::getPathing($path));
}

/** Include method that uses the standardized subdomain **/
function gdinc($path)
{
    return include(ZGDConfigurations::getPathing($path));
}

/** Include method that uses the standardized subdomain **/
function gdreq($path)
{
    return require ZGDConfigurations::getPathing($path);
}

/** Include method that uses the standardized subdomain **/
function gdreqonce($path)
{
    return require_once(ZGDConfigurations::getPathing($path));
}

function gdlog()
{
    gdreqonce("/gd.trxn.com/_controls/classes/KLogger.php");
    return new KLogger();
}

function gdconfig()
{
    gdreqonce("/_controls/classes/base/appconfig.php");
    return new ZAppConfigurations();
}

function gdauth()
{
    gdreqonce("/gd.trxn.com/usersafety/_controls/classes/authorityuser.php");
    return new gdAuthorizeUser();
}

function setpagekey($key)
{
    $_REQUEST["GD_PAGE_KEY"] = strtoupper($key);
}

function getpagekey()
{
    if(!isset($_REQUEST["GD_PAGE_KEY"]))
        $_REQUEST["GD_PAGE_KEY"] = "";
    return $_REQUEST["GD_PAGE_KEY"];
}

function getControlKey()
{
    $gdcontrolkey = "INVALID";
    if(isset($_POST["GD_CONTROL_KEY"]))
    {
        $gdcontrolkey = filter_var($_POST["GD_CONTROL_KEY"], FILTER_SANITIZE_STRING);
        if($gdcontrolkey == "")
        {
            $gdcontrolkey = "INVALID";
            if(isset($_GET["GD_CONTROL_KEY"]))
            {
                $gdcontrolkey = filter_var($_GET["GD_CONTROL_KEY"], FILTER_SANITIZE_STRING);
                if($gdcontrolkey == "")
                {
                    $gdcontrolkey = "INVALID";
                }
            }
        }
    }
    else
    {
        if(isset($_GET["GD_CONTROL_KEY"]))
        {
            $gdcontrolkey = filter_var($_GET["GD_CONTROL_KEY"], FILTER_SANITIZE_STRING);
            if($gdcontrolkey == "")
            {
                $gdcontrolkey = "INVALID";
            }
        }
    }
    gdlog()->LogInfo("getControlKey{".$gdcontrolkey."}");
    return $gdcontrolkey;
}

/*
 * Arg [1] = "RETURN"
 * Arg [2] = VALUE
 * Arg [3] ODD = Name of structure
 * Arg [4] EVEN = is value of Structure
 */
function buildReturnArray()
{
    gdlog()->LogInfoStartFUNCTION("buildReturnArray");
    $retary = new ArrayObject();
    $args = func_get_args();
    $msgshowcaught = false;
    $msgcaught = false;
    for ($idx = 0; $idx < func_num_args(); $idx++)
    {
        $name = func_get_arg($idx);
        $idx++;
        $valu = func_get_arg($idx);
        gdlog()->LogInfo($name."{".$valu."}");
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
    
    gdlog()->LogInfoEndFUNCTION("buildReturnArray");
    return $retary;
}

function gdLogEchoReturn($ret)
{
        gdlog()->LogInfo("RETURN Output Echo{".$ret."}");
}

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
            gdlog()->LogInfo("Bad Field :{".$name."}");
            $fieldfailed = "email";
        }
    }
    
    if($fieldfailed == "NONE")
        return true;
    else
        return false;
}
?>