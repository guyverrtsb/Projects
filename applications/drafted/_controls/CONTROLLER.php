<?php require_once("../gd.trxn.com/_controls/classes/_syscore.php"); ?>
<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php
/**
 * CONTROLLER Is designed to be called by a web site or an application needing
 * to know what the next steps are.  There is an XML that will store all of
 * the pathways based on the various errors RETURN_CODES
 * This will give the Developers central place to manage flow
 */
$return = new AppSysBaseObject();
if(getAjaxControlKey() != "NO_KEY_SENT")
{
    zLog()->LogInfo("SERVICE_CONTROL_KEY{".getServiceControlKey()."}");
    if(getServiceControlKey() == "CREATE_GAMER_REGISTRATION"
        || getServiceControlKey() == "LOGIN_GAMER_BY_EMAIL"
        || getServiceControlKey() == "ACTIVATE_GAMER_ACCOUNT"
        || getServiceControlKey() == "TASK_CONTROL"
        || getServiceControlKey() == "LOGGED_IN_GAMER_DATA"
        || getServiceControlKey() == "RESET_GAMER_PASSWORD")
    {
        zReqOnce("/_controls/executors/".getServiceControlKey().".php");
        $executor = new Executor();
        $return->setSysReturnAry($executor->execute());
    }
    else
    {
        $return->setSysReturnCode("AJAX_SERVICE_CONTROL_KEY_NOT_VALID");
        $return->setSysReturnShowMsg("FALSE");
        $return->setSysReturnMsg("AJAX_SERVICE_CONTROL_KEY Not valid");
    }
}
else
{
    $return->setSysReturnCode("AJAX_SERVICE_CONTROL_KEY_NOT_FOUND");
    $return->setSysReturnShowMsg("FALSE");
    $return->setSysReturnMsg("AJAX_SERVICE_CONTROL_KEY Not found");
}
zLog()->LogInfo($return->getSysReturnAryJSON());
