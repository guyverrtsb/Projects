<?php require_once("../gd.trxn.com/_controls/classes/_syscore.php"); ?>
<?php
$return = new AppSysBaseObject();
if(getControlKey() != "INVALID")
{
    zLog()->LogInfo("AJAX_SERVICE_CONTROL_KEY{".getControlKey()."}");
    if(getControlKey() == "GAMER_REGISTRATION")
    {
        zReqOnce("/_controls/ajax/".getControlKey().".php");
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