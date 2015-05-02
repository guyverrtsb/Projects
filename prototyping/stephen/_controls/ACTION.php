<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php
$return = new AppSysBaseObject();
if(getActionControlKey() != "NO_KEY_SENT")
{
    zLog()->LogInfo("ACTION_SERVICE_CONTROL_KEY{".getActionControlKey()."}");
    if(getActionControlKey() == "TEST_ACTION"
        || getActionControlKey() == "LOGIN_GAMER_BY_EMAIL"
        || getActionControlKey() == "ACTIVATE_GAMER_ACCOUNT"
        || getActionControlKey() == "TASK_CONTROL"
        || getActionControlKey() == "LOGGED_IN_GAMER_DATA")
    {
        zReqOnce("/_controls/action/".getActionControlKey().".php");
        $action = new Action();
        $return = $action->execute();
        $_REQUEST["ACTION_SERVICE_RETURN"] = $return;
    }
    else
    {
        $return->setSysReturnCode("ACTION_SERVICE_CONTROL_KEY_NOT_FOUND");
        $return->setSysReturnShowMsg("FALSE");
        $return->setSysReturnMsg("Action not valid");
        $_REQUEST["ACTION_SERVICE_RETURN"] = $return;
    }
}
else
{
    $return->setSysReturnCode("ACTION_SERVICE_CONTROL_KEY_NOT_FOUND");
    $return->setSysReturnShowMsg("FALSE");
    $return->setSysReturnMsg("Action not provided");
    $_REQUEST["ACTION_SERVICE_RETURN"] = $return;
}
zLog()->LogInfo($return->getSysReturnAryJSON());

