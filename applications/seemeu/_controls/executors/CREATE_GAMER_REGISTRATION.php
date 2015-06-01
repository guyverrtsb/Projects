<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php zReqOnce("/_controls/classes/accesspoints/gamer.php"); ?>
<?php zReqOnce("/gd.trxn.com/crossapplication/_controls/classes/accesspoints/taskcontrol.php"); ?>
<?php
class Executor
    extends AppSysBaseObject
{
    function execute()
    {
        $return = new AppSysBaseObject();
        if($this->validate())
        {
            $gamer = new Gamer();
            $gamer->createGamerInfo(trim($_POST["email"]),
                                    trim($_POST["nickname"]),
                                    trim($_POST["password"]),
                                    trim($_POST["firstname"]),
                                    trim($_POST["lastname"]),
                                    trim($_POST["city"]),
                                    trim($_POST["crossappl_configurations_sdesc_region"]),
                                    trim($_POST["crossappl_configurations_sdesc_country"]),
                                    trim($_POST["gamertag"]),
                                    trim($_POST["crossappl_configurations_sdesc_gamerrole"]));
                                    
            if($gamer->getSysReturnCode() == "GAMER_IS_CREATED")
            {
                $args["useraccount_uid"] = $gamer->getOutputData("useraccount_uid");
                $args["useraccount_email"] = $gamer->getOutputData("useraccount_email");
                $args["useraccount_nickname"] = $gamer->getOutputData("useraccount_nickname");
                
                $args["userprofile_firstname"] = $gamer->getOutputData("userprofile_firstname");
                $args["userprofile_lastname"] = $gamer->getOutputData("userprofile_lastname");
                
                $args["gameraccount_uid"] = $gamer->getOutputData("gameraccount_uid");
                $args["gameraccount_gamertag"] = $gamer->getOutputData("gameraccount_gamertag");
                                
                $tcl = new TaskControl();
                $tcl->createTaskControl("ACTIVATE_GAMER_ACCOUNT",
                                        "/_controls/classes/accesspoints/crossappli_task.php",
                                        $args);
                                                
                $args["taskcontrollink_uid1"] = $tcl->getOutputData("uid1");
                $args["taskcontrollink_uid2"] = $tcl->getOutputData("uid2");
                $args["taskcontrollink_uid3"] = $tcl->getOutputData("uid3");
                $args["taskcontrollink_appl_configurations_sdesc_taskkey"] = $tcl->getOutputData("appl_configurations_sdesc_taskkey");
                                                
                $tcl->sendTaskControl($args);
                $return = $tcl;
                $return->setSysReturnMsg("Here is the return info for the New Record:".$tcl->getSysReturnCode()."{".$tcl->getSysReturnitem("IS_ENV_LCL")."}:[".$tcl->getSysReturnitem("TRXN_URL")."]");
            }
            else if ($gamer->getSysReturnCode() == "EMAIL_IN_USE")
            {
                $return = $gamer;
                $return->setSysReturnMsg("E-Mail is in use.");
            }
            else if ($gamer->getSysReturnCode() == "NICKNAME_IN_USE")
            {
                $return = $gamer;
                $return->setSysReturnMsg("Nickname in Use.  Try Using:".$gamer->getOutputData("NICKNAME_SUGGESTION"));  
            }
            else if ($gamer->getSysReturnCode() == "GAMERTAG_IN_USE")
            {
                $return = $gamer;
                $return->setSysReturnMsg("Nickname in Use.  Try Using:".$gamer->getOutputData("GAMERTAG_SUGGESTION"));  
            }
            $return->setSysReturnStructure("RETURN_SHOW_PASS_MSG", "FALSE");
        }
        else
        {
            $return->setSysReturnCode("FORM_FIELDS_NOT_VALID");
            $return->setSysReturnShowMsg("FALSE");
            $return->setSysReturnMsg("Please fill in all fields.");
        }
        return $return;
    }

    function validate()
    {
        $fv = true;  // Form is Valid Key T=Valid; anything else is invalid;
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
        return $fv;
    }
}