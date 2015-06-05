<?php zReqOnce("/_controls/classes/_sys/_appsysajaxinterfacevalidation.php"); ?>
<?php
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

function getServiceControlKey()
{
    $key = "SERVICE_CONTROL_KEY";
    $controlkey = "NO_KEY_SENT";
    if(isset($_POST[$key]))
    {
        $controlkey = filter_var($_POST[$key], FILTER_SANITIZE_STRING);
        if($controlkey == "")
        {
            $controlkey = "NO_KEY_SENT";
            if(isset($_GET[$key]))
            {
                $controlkey = filter_var($_GET[$key], FILTER_SANITIZE_STRING);
                if($controlkey == "")
                {
                    $controlkey = "NO_KEY_SENT";
                }
            }
        }
    }
    else if(isset($_GET[$key]))
    {
        $controlkey = filter_var($_GET[$key], FILTER_SANITIZE_STRING);
        if($controlkey == "")
        {
            $controlkey = "NO_KEY_SENT";
        }
    }
    zLog()->LogDebug("getServiceControlKey:[$key]:[$controlkey]");
    return $controlkey;
}
?>