<?php require_once("../gd.trxn.com/_controls/classes/_syscore.php"); ?>
<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php
/**
 * CONTROLLER Is designed to be called by a web site or an application needing
 * to know what the next steps are.  There is an XML that will store all of
 * the pathways based on the various errors RETURN_CODES
 * This will give the Developers central place to manage flow
 */
function execute()
{
    $return = new AppSysBaseObject();
    $serviceControlKey = getServiceControlKey();
    switch($serviceControlKey)
    {
        case "USERSAFETY-LOGIN_BY_EMAIL_PROSPECT":
        case "USERSAFETY-REGISTER_BY_EMAIL_PROSPECT":
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
            zReqOnce("/gd.trxn.com/crossapplication/_controls/classes/executors/".$serviceControlKey.".php");
            $executor = new Executor();
            $executor->execute();
            $return->transferSysReturnAry($executor);
            break;
        case "USERSAFETY-LOGIN_BY_EMAIL":
        case "USERSAFETY-REGISTER_BY_EMAIL":
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
    zLog()->LogDebug("EXECUTOR Return : ".$return->getSysReturnAryJSON());
    perform($serviceControlKey, $return);
}

function perform($serviceControlKey, $return)
{
    $xml = "CONTROLLER.xml";
    $xml = simplexml_load_file($xml);

    $retCode = $return->getSysReturnCode();
    $executorNode = null;
    foreach($xml->executors->children() as $node)
    {
        if($node->getName() == $serviceControlKey)
        {
            foreach($node->children() as $returnNode)
            {
                if($returnNode->getName() == $retCode)
                {
                    $executorNode = $returnNode;
                }
            }
        }
    }
    
    if($executorNode == null)
    {
        foreach($xml->globals->children() as $node)
        {
            if($node->getName() == $retCode)
            {
                    $executorNode = $node;
            }
        }
    }
    
    $type = $executorNode["type"];
    $redirecturl = "";
    if($type == "PAGE")
    {
        $path = $executorNode["path"];
        zLog()->LogDebug($type.":".$path);
        $redirecturl = $path;
    }
    else
    {
        $method = $executorNode["method"];
        zLog()->LogDebug($type.":".$method);
        switch($method)
        {
            case "user_not_authorized_url":
                $redirecturl = zAppSysIntegration()->getRedirectUserNotAuthorizedUrl();
                break;
            case "user_logged_on_successfully_url":
                $redirecturl = zAppSysIntegration()->getRedirectUserLoggedOnSuccessfullyUrl();
                break;
            case "user_logged_off_successfully_url":
                $redirecturl = zAppSysIntegration()->getRedirectUserLoggedOffSuccessfullyUrl();
                break;
            case "user_change_password_url":
                $redirecturl = zAppSysIntegration()->getRedirectUserChangePasswordUrl();
                break;
            case "user_logon_url":
                $redirecturl = zAppSysIntegration()->getRedirectUserLogonUrl();
                break;
            case "user_logon_url":
                $redirecturl = zAppSysIntegration()->getRedirectUserLogonUrl();
                break;
            case "referer":
                $redirecturl = zAppSysIntegration()->getRedirectRefererUrl();
                break;
            default:
                $redirecturl = zAppSysIntegration()->getRedirectGeneralErrorUrl();
        }
    }
    
    zLog()->LogDebug($executorNode["type"].":[".$redirecturl."]");
    zAppSysIntegration()->redirectToUIPage($return->getSysReturnCode(),
                                        $return->getSysReturnMsg(),
                                        $return->getSysReturnShowMsg(),
                                        $redirecturl);
}
execute();