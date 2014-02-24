<?php require_once("../../gd.trxn.com/_controls/classes/_core.php"); ?>
<?php gdreqonce("/_controls/classes/find/messages.php"); ?>
<?php
if(isset($_POST["GD_CONTROLLER_KEY"]))
{
    $action = filter_var($_POST["GD_CONTROLLER_KEY"], FILTER_SANITIZE_STRING);
    $gdconfig = gdconfig();
    gdlog()->LogInfo("GD_CONTROLLER_KEY{".$action."}");
    if($action == "GET_LIST_OF_MESSAGES")
    {
        $zfm = new zFindMessages();
        $r = $zfm->findAllMessages();
        if($r == "MESSAGES_FOUND")
        {
            $r = json_encode($zfm->getResult_List());
            gdlog()->LogInfo("JSON_ENCODE:".$r);
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