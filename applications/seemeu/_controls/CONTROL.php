<?php require_once("../gd.trxn.com/_controls/classes/_syscore.php"); ?>
<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php
$return = new AppSysBaseObject();
if(getAjaxControlKey() != "INVALID")
{
    zLog()->LogInfo("AJAX_SERVICE_CONTROL_KEY{".getAjaxControlKey()."}");
    if(getAjaxControlKey() == "CREATE_GAMER_REGISTRATION"
        || getAjaxControlKey() == "LOGIN_GAMER_BY_EMAIL"
        || getAjaxControlKey() == "ACTIVATE_GAMER_ACCOUNT"
        || getAjaxControlKey() == "TASK_CONTROL"
        || getAjaxControlKey() == "LOGGED_IN_GAMER_DATA"
        || getAjaxControlKey() == "RESET_GAMER_PASSWORD")
    {
        zReqOnce("/_controls/ajax/".getAjaxControlKey().".php");
        $ajax = new Ajax();
        $return = $ajax->execute();
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
echo $return->getSysReturnAryJSON();