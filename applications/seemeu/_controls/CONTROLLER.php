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
$_REQUEST["SERVICE_RETURN"] = $return;