<?php require_once("../../gd.trxn.com/_controls/classes/_core.php"); ?>
<?php gdreqonce("/_controls/classes/find/university.php"); ?>
<?php gdreqonce("/_controls/classes/find/grouprequest.php"); ?>
<?php
$echoret = "";
$action = getControlKey();
if($action != "INVALID")
{
    $gdconfig = gdconfig();
    if($action == "LIST_OF_UNIVERSITIES")
    {
        $zfuniv = new zFindUniversity();
        $r = $zfuniv->findAllUniversitiesAccountsandProfiles();
        if($r == "ACCOUNTS_FOUND")
        {
            $echoret = json_encode(buildReturnArray("RETURN_KEY", "SUCCESS"
                                                ,"RETURN_SHOW_PASS_MSG", "false"
                                                , "RESULT", $zfuniv->getResults_AllAccountsandProfiles()));
        }
        else
        {
            $echoret = json_encode(buildReturnArray("RETURN_KEY", "NO_RESULTS"
                                                ,"RETURN_SHOW_PASS_MSG", "FALSE"));
        }
    }
    else if($action == "LIST_OF_JOIN_GROUP_REQUESTS")
    {
        $zfgr = new zFindGroupRequests();
        $r = $zfgr->findGroupRequests("P");
        if($r == "REQUEST_LIST_FOUND")
        {
            $echoret = json_encode(buildReturnArray("RETURN_KEY", "SUCCESS"
                                                ,"RETURN_SHOW_PASS_MSG", "FALSE"
                                                , "RESULT", $zfgr->getResult_Lists()));
        }
        else
        {
            $echoret = json_encode(buildReturnArray("RETURN_KEY", "NO_RESULTS"));
        }
    }
    else if($action == "COUNT_NOTIFICATONS")
    {
        $zfgr = new zFindGroupRequests();
        $r = $zfgr->findGroupRequests("P");
        if($r == "REQUEST_LIST_FOUND")
        {
            $echoret = json_encode(buildReturnArray("RETURN_KEY", "SUCCESS"
                                                ,"RETURN_SHOW_PASS_MSG", "FALSE"
                                               , "RESULT", $zfgr->getResult_Lists()));
        }
        else
        {
            $echoret = json_encode(buildReturnArray("RETURN_KEY", "NO_RESULTS"
                                                ,"RETURN_SHOW_PASS_MSG", "FALSE"));
        }
    }
}
gdLogEchoReturn($echoret);
echo $echoret;

function validateConfiguration()
{
    $fv = true;  // Form is Valid Key T=Valid; anything else is invalid;
    if (!isset($_POST["GROUP_ACCOUNT_UID"]) || $_POST["GROUP_ACCOUNT_UID"] == "")
        $fv = false;
    return $fv;
}
?>