<?php require_once("../gd.trxn.com/_controls/classes/_syscore.php"); ?>
<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php
$return = new AppSysBaseObject();
if(getControlKey() != "INVALID")
{
    zLog()->LogInfo("AJAX_SERVICE_CONTROL_KEY{".getControlKey()."}");
    if(getControlKey() == "CREATE_GAMER_REGISTRATION"
        || getControlKey() == "LOGIN_GAMER_BY_EMAIL")
    {
        zReqOnce("/_controls/ajax/".getControlKey().".php");
        $ajax = new Ajax();
        $return = $ajax->execute();
    }
    else
    {
        $return->setSysReturnStructure("RETURN_CODE", "AJAX_SERVICE_CONTROL_KEY_NOT_VALID"
                                    ,"RETURN_SHOW_PASS_MSG", "FALSE"
                                    ,"RETURN_MSG", "AJAX_SERVICE_CONTROL_KEY Not valid");
    }
}
else
{
    $return->setSysReturnStructure("RETURN_CODE", "AJAX_SERVICE_CONTROL_KEY_NOT_FOUND"
                                ,"RETURN_SHOW_PASS_MSG", "FALSE"
                                ,"RETURN_MSG", "AJAX_SERVICE_CONTROL_KEY Not found");
}
zLog()->LogInfo($return->getSysReturnAryJSON());
echo $return->getSysReturnAryJSON();