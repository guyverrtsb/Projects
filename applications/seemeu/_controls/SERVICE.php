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
    case "APP_CONFIGURATIONS-GET_GROUPKEY_ITEMS":
        zReqOnce("/_controls/classes/executors/".$serviceControlKey.".php");
        $executor = new Executor();
        $executor->execute();
        $return->transferSysReturnAry($executor);
        break;
    case "TEST_ACTION":
        zReqOnce("/gd.trxn.com/_controls/classes/executors/".$serviceControlKey.".php");
        $executor = new Executor();
        $executor->execute();
        $return->transferSysReturnAry($executor);
        break;
    case "TASK_CONTROL":
    case "MIME_UPLOAD":
        zReqOnce("/gd.trxn.com/crossapplication/_controls/classes/executors/".$serviceControlKey.".php");
        $executor = new Executor();
        $executor->execute();
        $return->transferSysReturnAry($executor);
        break;
    case "USERSAFETY-LOGIN":
    case "USERSAFETY-REGISTRATION":
        zReqOnce("/gd.trxn.com/usersafety/_controls/classes/executors/".$serviceControlKey.".php");
        $executor = new Executor();
        $executor->execute();
        $return->transferSysReturnAry($executor);
        break;
    case "NO_KEY_SENT":
        $return->setSysReturnData("ACTION_SERVICE_CONTROL_KEY_NOT_FOUND", "Action not provided");
        zLog()->LogInfo("SERVICE_CONTROL_KEY{".getServiceControlKey()."}");
        break;
    default:
        $return->setSysReturnData("ACTION_SERVICE_CONTROL_KEY_NOT_FOUND", "Action not Valid");
}
zLog()->LogDebug($return->getSysReturnAryJSON());
echo $return->getSysReturnAryJSON();