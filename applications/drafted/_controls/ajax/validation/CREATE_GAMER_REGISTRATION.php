<?php
function validate()
{
    $fv = true;  // Form is Valid Key T=Valid; anything else is invalid;
    if(getControlKey() == "GAMER_REGISTRATION") {
        if(!isset($_POST["email"]) || trim($_POST["email"]) == "")
            $fv = ajaxValidationLogging(false, "create_UserandGamerAccount", "POST:email");
        if(!isset($_POST["nickname"]) || trim($_POST["nickname"]) == "")
            $fv = ajaxValidationLogging(false, "create_UserandGamerAccount", "POST:nickname");
        if(!isset($_POST["password"]) || trim($_POST["password"]) == "")
            $fv = ajaxValidationLogging(false, "create_UserandGamerAccount", "POST:password");
        if(!isset($_POST["firstname"]) || trim($_POST["firstname"]) == "")
            $fv = ajaxValidationLogging(false, "create_UserandGamerAccount", "POST:firstname");
        if(!isset($_POST["lastname"]) || trim($_POST["lastname"]) == "")
            $fv = ajaxValidationLogging(false, "create_UserandGamerAccount", "POST:lastname");
        if(!isset($_POST["city"]) || trim($_POST["city"]) == "")
            $fv = ajaxValidationLogging(false, "create_UserandGamerAccount", "POST:city");
        if(!isset($_POST["crossappl_configurations_sdesc_region"]) || trim($_POST["crossappl_configurations_sdesc_region"]) == "")
            $fv = ajaxValidationLogging(false, "create_UserandGamerAccount", "POST:crossappl_configurations_sdesc_region");
        if(!isset($_POST["crossappl_configurations_sdesc_country"]) || trim($_POST["crossappl_configurations_sdesc_country"]) == "")
            $fv = ajaxValidationLogging(false, "create_UserandGamerAccount", "POST:crossappl_configurations_sdesc_country");
        if(!isset($_POST["gamertag"]) || trim($_POST["gamertag"]) == "")
            $fv = ajaxValidationLogging(false, "create_UserandGamerAccount", "POST:gamertag");
        if(!isset($_POST["crossappl_configurations_sdesc_gamerrole"]) || trim($_POST["crossappl_configurations_sdesc_gamerrole"]) == "")
            $fv = ajaxValidationLogging(false, "create_UserandGamerAccount", "POST:crossappl_configurations_sdesc_gamerrole");
    }
    return $fv;
}