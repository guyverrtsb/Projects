<?php require_once("../gd.trxn.com/_controls/classes/_syscore.php"); ?>
<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/retrieve/appconfiguration.php"); ?>
<?php
/**
 * SERVICE page is designed to be called by MVCs and Design Pattern
 * applications that control their own page flow.  This Service is
 * only designed to make a call and return the results.
 */
$return = new AppSysBaseObject();
$serviceControlKey = getServiceControlKey();
switch($serviceControlKey)
{
        case "TEST_ACTION":
        case "APP_CONFIGURATIONS-GET_GROUPKEY_ITEMS":
        case "ACTIVATE_GAMER_ACCOUNT":
        case "TASK_CONTROL":
        case "LOGGED_IN_GAMER_DATA":
            zReqOnce("/_controls/executors/".$serviceControlKey.".php");
            $executor = new Executor();
            $return->setSysReturnAry($executor->execute()->getSysReturnAry());
            break;
    case "NO_KEY_SENT":
            $return->setSysReturnCode("ACTION_SERVICE_CONTROL_KEY_NOT_FOUND");
            $return->setSysReturnShowMsg("FALSE");
            $return->setSysReturnMsg("Action not provided");
            zLog()->LogInfo("SERVICE_CONTROL_KEY{".getServiceControlKey()."}");
            break;
    default:
        $return->setSysReturnCode("ACTION_SERVICE_CONTROL_KEY_NOT_FOUND");
        $return->setSysReturnShowMsg("FALSE");
        $return->setSysReturnMsg("Action not valid");
}
zLog()->LogInfo($return->getSysReturnAryJSON());
echo $return->getSysReturnAryJSON();
