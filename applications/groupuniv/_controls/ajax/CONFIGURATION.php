<?php require_once("../../gd.trxn.com/_controls/classes/_core.php"); ?>
<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
if(isset($_POST["GD_CONTROLLER_KEY"]))
{
    $action = filter_var($_POST["GD_CONTROLLER_KEY"], FILTER_SANITIZE_STRING);
    gdlog()->LogInfo("GD_CONTROLLER_KEY{".$action."}");
    if($action == "GET_CONFIGURATION")
    {
        gdlog()->LogInfoTaskLabel("Get Configuration");
        if(validateConfiguration())
        {
            $group_key = filter_var($_POST["group_key"], FILTER_SANITIZE_STRING);
            $zfconfigs = new zAppBaseObject();
            $r = $zfconfigs->findConfigurationListfromGroupKey($group_key);
            if($r == "LIST_FOUND")
            {
                $r = json_encode($zfconfigs->getResults_ConfigurationRecords());
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

function validateConfiguration()
{
    $fv = "T";  // Form is Valid Key T=Valid; anything else is invalid;
    if (!isset($_POST["group_key"]) || $_POST["group_key"] == "")
        $fv = "F";
    return $fv;
}
?>