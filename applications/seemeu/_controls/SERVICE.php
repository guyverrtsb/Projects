<?php require_once("../gd.trxn.com/_controls/classes/_syscore.php"); ?>
<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php
/**
 * SERVICE page is designed to be called by MVCs and Design Pattern
 * applications that control their own page flow.  This Service is
 * only designed to make a call and return the results.
 */
$return = new AppSysBaseObject();
if(getServiceControlKey() != "NO_KEY_SENT")
{
    zLog()->LogInfo("SERVICE_CONTROL_KEY{".getServiceControlKey()."}");
    if(getServiceControlKey() == "TEST_ACTION"
        || getServiceControlKey() == "LOGIN_GAMER_BY_EMAIL"
        || getServiceControlKey() == "ACTIVATE_GAMER_ACCOUNT"
        || getServiceControlKey() == "TASK_CONTROL"
        || getServiceControlKey() == "LOGGED_IN_GAMER_DATA")
    {
        zReqOnce("/_controls/action/".getServiceControlKey().".php");
        $executor = new Executor();
        $return->setSysReturnAry($executor->execute());
        $_REQUEST["SERVICE_RETURN"] = $return;
    }
    else
    {
        $return->setSysReturnCode("ACTION_SERVICE_CONTROL_KEY_NOT_FOUND");
        $return->setSysReturnShowMsg("FALSE");
        $return->setSysReturnMsg("Action not valid");
        $_REQUEST["SERVICE_RETURN"] = $return;
    }
}
else
{
    $return->setSysReturnCode("ACTION_SERVICE_CONTROL_KEY_NOT_FOUND");
    $return->setSysReturnShowMsg("FALSE");
    $return->setSysReturnMsg("Action not provided");
    $_REQUEST["SERVICE_RETURN"] = $return;
}
zLog()->LogInfo($return->getSysReturnAryJSON());
echo $return->getSysReturnAryJSON();
