<?php require_once("../gd.trxn.com/_controls/classes/_syscore.php"); ?>
<?php zReqOnce("/_controls/classes/accesspoints/gamer.php"); ?>
<?php zReqOnce("/gd.trxn.com/crossapplication/_controls/classes/accesspoints/taskcontrol.php"); ?>
<?php
$output = ""; $return = null;
$gamer = new Gamer();
$gamer->createGamerInfo("sshellenberger@zealcon.com",
                        "shaggy",
                        "luv123",
                        "Stephen",
                        "Shellenberger",
                        "raleigh",
                        "REGION_NC",
                        "COUNTRIES_US",
                        "guyver",
                        "GAMER_ROLE_GAMER");
                        
if($gamer->getSysReturnCode() == "GAMER_IS_CREATED")
{
    $args["useraccount_uid"] = $gamer->getOutputData("useraccount_uid");
    $args["useraccount_email"] = $gamer->getOutputData("useraccount_email");
    $args["useraccount_nickname"] = $gamer->getOutputData("useraccount_nickname");
    $args["userprofile_firstname"] = $gamer->getOutputData("userprofile_firstname");
    $args["userprofile_lastname"] = $gamer->getOutputData("userprofile_lastname");
    $args["gameraccount_uid"] = $gamer->getOutputData("gameraccount_uid");
    $args["gameraccount_tag"] = $gamer->getOutputData("gameraccount_tag");
                    
    $tcl = new TaskControl();
    $tcl->createTaskControl("ACTIVATE_GAMER_ACCOUNT",
                            "/_controls/classes/accesspoints/crossappli_task.php",
                            $args);
                                    
    $args["taskcontrollink_uid1"] = $tcl->getOutputData("uid1");
    $args["taskcontrollink_uid2"] = $tcl->getOutputData("uid2");
    $args["taskcontrollink_uid3"] = $tcl->getOutputData("uid3");
    $args["taskcontrollink_appl_configurations_sdesc_taskkey"] = $tcl->getOutputData("appl_configurations_sdesc_taskkey");
                                    
    $tcl->sendTaskControl($args);
    $output = "Here is the return info for the New Record:".$tcl->getSysReturnCode()."{".$tcl->getSysReturnitem("IS_ENV_LCL")."}:[".$tcl->getSysReturnitem("TRXN_URL")."]";  
    $return = $tcl;
}
else if ($gamer->getSysReturnCode() == "EMAIL_IN_USE")
{
    $output = "E-Mail is in use.";  
    $return = $gamer;
}
else if ($gamer->getSysReturnCode() == "NICKNAME_IN_USE")
{
    $output = "Nickname in Use.  Try Using:".$gamer->getOutputData("NICKNAME_SUGGESTION");  
    $return = $gamer;
    }
else if ($gamer->getSysReturnCode() == "GAMERTAG_IN_USE")
{
    $output = "Nickname in Use.  Try Using:".$gamer->getOutputData("GAMERTAG_SUGGESTION");  
    $return = $gamer;
}
?>
<?php printf($output); ?>
<?php printf("JSON:%s:", $return->getSysReturnAryJSON()); ?>s