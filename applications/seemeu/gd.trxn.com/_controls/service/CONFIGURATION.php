<?php require_once("../classes/_core.php"); ?>
<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
$echoret = "";
$action = getControlKey();
if($action != "INVALID")
{
    if($action == "GET_CONFIGURATION")
    {
        gdlog()->LogTaskLabel("Get Configuration");
        if(validateConfiguration())
        {
            $group_key = filter_var($_POST["group_key"], FILTER_SANITIZE_STRING);
            $zfconfigs = new zAppBaseObject();
            if($zfconfigs->findConfigurationListfromGroupKey($group_key) == "LIST_FOUND")
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "SUCCESS"
                                                ,"RETURN_SHOW_MSG", "FALSE"
                                                , "LIST", $zfconfigs->getResults_ConfigurationRecords()));
            }
            else
            {
                $echoret = json_encode(buildReturnArray("RETURN", "CONFIG_NOT_FOUND"
                                                ,"RETURN_SHOW_MSG", "FALSE"));
            }
        }
        else
        {
            $echoret = json_encode(buildReturnArray("RETURN", "FORM_FIELDS_NOT_VALID"
                                                , "RETURN_SHOW_MSG", "FALSE"));
        }
    }
}
gdLogEchoReturn($echoret);
echo $echoret;

function validateConfiguration()
{
    $tf = true;  // Form is Valid Key T=Valid; anything else is invalid;
    if (!isset($_POST["group_key"]) || $_POST["group_key"] == "")
        $tf = false;
    return $tf;
}
?>