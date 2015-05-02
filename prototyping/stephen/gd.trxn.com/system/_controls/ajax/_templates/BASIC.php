<?php require_once("../../../gd.trxn.com/_controls/classes/_syscore.php"); ?>
<?php
$echoret = "";
$action = getControlKey();
if($action != "INVALID")
{
    syslog()->LogInfo("GD_CONTROLLER_KEY{".$action."}");
    if($action == "RETRIEVE_ALL")
    {
        // Do File Upload
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
    $fv = false;  // Form is Valid Key T=Valid; anything else is invalid;
    if($action == "RETRIEVE_ALL") {
        $fv = ajaxValidationLogging(true, "RETRIEVE_HAZARDS", "GDFileDescription");
    } else if($action == "RETRIEVE_BY_GROUP") {
        
    } else if($action == "RETRIEVE_BY_USER") {
        
    } else if($action == "RETRIEVE_BY_MERCHANT") {
        
    }
    return $fv;
}