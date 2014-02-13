<?php require_once("../../gd.trxn.com/_controls/classes/_core.php"); ?>
<?php gdreqonce("/_controls/classes/find/search.php"); ?>

<?php
if(isset($_POST["GD_CONTROLLER_KEY"]))
{
    $action = filter_var($_POST["GD_CONTROLLER_KEY"], FILTER_SANITIZE_STRING);
    gdlog()->LogInfo("GD_CONTROLLER_KEY{".$action."}");
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
                $r = json_encode($zfsd->getResults_SearchRecords());
                gdlog()->LogInfo("JSON_ENCODE:".$r);
            }
            echo $r;
        }
        else
        {
            echo "FORM_FIELDS_NOT_VALID";
        }
    }
}

function validateTaskForm()
{
    $fv = "T";  // Form is Valid Key T=Valid; anything else is invalid;
    if (!isset($_POST["searchfield"]) || $_POST["searchfield"] == "")
        $fv = "F";
    return $fv;
}
?>