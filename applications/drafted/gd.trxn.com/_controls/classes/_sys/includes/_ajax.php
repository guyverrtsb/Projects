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

function getControlKey()
{
    //zLog()->LogInfoStartFUNCTION("getControlKey()");
    $controlkey = "INVALID";
    if(isset($_POST["AJAX_SERVICE_CONTROL_KEY"]))
    {
        //zLog()->LogInfo("POST:AJAX_SERVICE_CONTROL_KEY:ISSET");
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
                    //zLog()->LogInfo("POST:AJAX_SERVICE_CONTROL_KEY:".$gdcontrolkey);
                }
            }
        }
    }
    else if(isset($_GET["AJAX_SERVICE_CONTROL_KEY"]))
    {
        //zLog()->LogInfo("GET:AJAX_SERVICE_CONTROL_KEY:ISSET");
        $controlkey = filter_var($_GET["AJAX_SERVICE_CONTROL_KEY"], FILTER_SANITIZE_STRING);
        if($controlkey == "")
        {
            $controlkey = "INVALID";
            //zLog()->LogInfo("GET:AJAX_SERVICE_CONTROL_KEY:".$controlkey);
        }
    }
    zLog()->LogDebug("getControlKey{".$controlkey."}");
    //zLog()->LogInfoEndFUNCTION("getControlKey()");
    return $controlkey;
}


?>