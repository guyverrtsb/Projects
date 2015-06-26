<?php require_once("../../gd.trxn.com/_controls/classes/_core.php"); ?>
<?php gdreqonce("/_controls/classes/find/search.php"); ?>
<?php
$echoret = "";
$action = getControlKey();
if($action != "INVALID")
{
    if($action == "SEARCH_NON_UNIVERSITY")
    {
        gdlog()->LogInfoTaskLabel("Search University");
        if(validateTaskForm())
        {
            $searchcfg = filter_var($_POST["searchcfg"], FILTER_SANITIZE_STRING);
            gdlog()->LogInfo("SEARCH_CFG:".$searchcfg);
            $zfsd = new zFindSearchData();
            if($searchcfg == "SEARCH_OBJECT_GROUP")
            {
                gdlog()->LogInfoTaskLabel("Search through Groups");
                $r = $zfsd->findSearchGroup(filter_var($_POST["searchfield"], FILTER_SANITIZE_STRING));
            }
            else if($searchcfg == "SEARCH_OBJECT_WALL_MESSAGE")
            {
                gdlog()->LogInfoTaskLabel("Search through Wall Messages");
                $r = $zfsd->findSearchWallMessage(filter_var($_POST["searchfield"], FILTER_SANITIZE_STRING));
            }
            
            if($r == "RECORDS_FOUND")
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "RESULTS_FOUND"
                                                ,"RETURN_SHOW_PASS_MSG", "FALSE"
                                                , "LIST", $zfsd->getResults_List()));
            }
            else
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "NO_RESULTS"
                                                ,"RETURN_SHOW_PASS_MSG", "TRUE"
                                                ,"RETURN_MSG", "Please adjust your search.  No results found."));
            }
        }
        else
        {
            $echoret = json_encode(buildReturnArray("RETURN_KEY", "FORM_FIELDS_NOT_VALID"
                                                ,"RETURN_SHOW_PASS_MSG", "TRUE"
                                                ,"RETURN_MSG", "Please fill in all fields."));
        }
    }
}
gdLogEchoReturn($echoret);
echo $echoret;

function validateTaskForm()
{
    $fv = true;  // Form is Valid Key T=Valid; anything else is invalid;
    if (!isset($_POST["searchfield"]) || $_POST["searchfield"] == "")
        $fv = false;
    if (!isset($_POST["searchcfg"]) || $_POST["searchcfg"] == "")
        $fv = false;
    return $fv;
}
?>