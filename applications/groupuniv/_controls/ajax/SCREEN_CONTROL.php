<?php require_once("../../gd.trxn.com/_controls/classes/_core.php"); ?>
<?php gdreqonce("/_controls/classes/find/university.php"); ?>
<?php gdreqonce("/_controls/classes/find/grouprequest.php"); ?>
<?php
if(isset($_POST["GD_CONTROLLER_KEY"]))
{
    $action = filter_var($_POST["GD_CONTROLLER_KEY"], FILTER_SANITIZE_STRING);
    $gdconfig = gdconfig();
    gdlog()->LogInfo("GD_CONTROLLER_KEY{".$action."}");
    if($action == "LIST_OF_UNIVERSITIES")
    {
        $zfuniv = new zFindUniversity();
        $r = $zfuniv->findAllUniversitiesAccountsandProfiles();
        if($r == "ACCOUNTS_FOUND")
        {
            $r = json_encode($zfuniv->getResults_AllAccountsandProfiles());
            $zfuniv->gdlog()->LogInfo("JSON_ENCODE:".$r);
        }
        else
            $r = "NO_RESULTS";
        echo $r;
    }
    else if($action == "LIST_OF_JOIN_GROUP_REQUESTS")
    {
        $zfgr = new zFindGroupRequests();
        $r = $zfgr->findGroupRequests("P");
        if($r == "REQUEST_LIST_FOUND")
        {
            $r = json_encode($zfgr->getResult_RequestLists());
            $zfgr->gdlog()->LogInfo("JSON_ENCODE:".$r);
        }
        else
            $r = "NO_RESULTS";
        echo $r;
    }
}

function validateConfiguration()
{
    $fv = "T";  // Form is Valid Key T=Valid; anything else is invalid;
    if (!isset($_POST["GROUP_ACCOUNT_UID"]) || $_POST["GROUP_ACCOUNT_UID"] == "")
        $fv = "F";
    return $fv;
}
?>