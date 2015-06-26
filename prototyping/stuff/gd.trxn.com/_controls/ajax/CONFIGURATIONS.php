<?php require_once("../classes/_core.php"); ?>
<?php gdreqonce("/gd.trxn.com/_controls/classes/find/configurations.php"); ?>
<?php
if(isset($_GET["GD_CONTROLLER_KEY"]))
{
    $action = filter_var($_GET["GD_CONTROLLER_KEY"], FILTER_SANITIZE_STRING);
    gdlog()->LogInfo($action.":START");
    if($action == "GET_GROUP_LIST")
    {
        if(validateGroupList())
        {
            $group_key = filter_var($_GET["group_key"], FILTER_SANITIZE_STRING);
            $dependant_sdesc = filter_var($_GET["dependant_sdesc"], FILTER_SANITIZE_STRING);
            $zfconfigs = new zFindConfigurations();
            $r = $zfconfigs->findGroupList($group_key, $dependant_sdesc);
            if($r == "LIST_FOUND")
            {
                $r = json_encode($zfconfigs->getResults_GroupList());
                $zfconfigs->gdlog()->LogInfo("JSON_ENCODE:".$r);
            }
            echo $r;
        }
        else
        {
            echo "FORM_FIELDS_NOT_VALID";
        }
    }
    else if($action == "GET_CFG_LIST")
    {
        if(validateConfigList())
        {
            gdlog()->LogInfo($action.":START");
            $cfg_type = filter_var($_GET["cfg_type"], FILTER_SANITIZE_STRING);
            $zfconfigs = new zFindConfigurations();
            $r = $zfconfigs->findConfigurationList($cfg_type);
            if($r == "LIST_FOUND")
            {
                $r = json_encode($zfconfigs->getResults_GroupList());
                $zfconfigs->gdlog()->LogInfo("JSON_ENCODE:".$r);
            }
            echo $r;
        }
        else
        {
            echo "FORM_FIELDS_NOT_VALID";
        }
    }
}

function validateGroupList()
{
    $fv = "T";  // Form is Valid Key T=Valid; anything else is invalid;
    if (!isset($_GET["group_key"]) || $_GET["group_key"] == "")
        $fv = "F";
    return $fv;
}
function validateConfigList()
{
    $fv = "T";  // Form is Valid Key T=Valid; anything else is invalid;
    if (!isset($_GET["cfg_type"]) || $_GET["cfg_type"] == "")
        $fv = "F";
    return $fv;
}
?>