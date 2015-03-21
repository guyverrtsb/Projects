<?php require_once("../../../gd.trxn.com/_controls/classes/_syscore.php"); ?>
<?php
$echoret = "";
$action = getControlKey();
if($action != "INVALID")
{
    syslog()->LogInfo("GD_CONTROLLER_KEY{".$action."}");
    if($action == "GAMER_ADD_LATLNG")
    {
        if(validate())
        {
            $echoret = json_encode(buildReturnArray("RETURN_KEY", "FORM_FIELDS_VALID"
                                                ,"RETURN_SHOW_PASS_MSG", "FALSE"
                                                ,"RETURN_MSG", "Form Fields Filled In"));
        }
        else
        {
            $echoret = json_encode(buildReturnArray("RETURN_KEY", "FORM_FIELDS_NOT_VALID"
                                                ,"RETURN_SHOW_PASS_MSG", "FALSE"
                                                ,"RETURN_MSG", "Please fill in all fields."));
        }
    }
    else
    {
        $echoret = json_encode(buildReturnArray("RETURN_KEY", "GD_CONTROLLER_KEY_NOT_VALID"
                                            ,"RETURN_SHOW_PASS_MSG", "FALSE"
                                            ,"RETURN_MSG", "GD_CONTROLLER_KEY Not valid"));
    }
}
else
{
    $echoret = json_encode(buildReturnArray("RETURN_KEY", "GD_CONTROLLER_KEY_NOT_FOUND"
                                        ,"RETURN_SHOW_PASS_MSG", "FALSE"
                                        ,"RETURN_MSG", "GD_CONTROLLER_KEY Not found"));
}
gdLogEchoReturn($echoret);
echo $echoret;

function validate()
{
    $fv = true;  // Form is Valid Key T=Valid; anything else is invalid;
    if($action == "GAMER_ADD_LATLNG") {
        if(!isset($_SESSION["GAMER_UID"]) || !trim($_SESSION["GAMER_UID"]) == "")
            $fv = ajaxValidationLogging(false, "create_GAMERS", "SESSION:GAMER_UID");
        if(!isset($_POST["longitude"]) || $_POST["longitude"] == "")
            $fv = ajaxValidationLogging(false, "create_GAMERS", "POST:longitude");
        if(!isset($_POST["latitude"]) || $_POST["latitude"] == "")
            $fv = ajaxValidationLogging(false, "create_GAMERS", "POST:latitude");

    } else if($action == "RETRIEVE_BY_GROUP") {
        
    } else if($action == "RETRIEVE_BY_USER") {
        
    } else if($action == "RETRIEVE_BY_MERCHANT") {
        
    }
    return $fv;
}