<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/accesspoints/taskcontrol.php"); ?>
<?php zReqOnce("/gd.trxn.com/_controls/classes/accesspoints/gamer.php"); ?>
<?php
class Ajax
    extends AppSysBaseObject
{
    function execute()
    {
        $return = new AppSysBaseObject();
        if($this->validate())
        {
            $args["useraccount_email"] = trim($_POST["email"]);
            
            $gamer = new Gamer();
            $gamer->retrieveGamer($args["useraccount_email"]);
            
            if($gamer->getSysReturnCode() == "GAMER_ACCOUNT_FOUND")
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
                $return = $tcl;
                $return->setSysReturnMsg("Here is the return info for the New Record:".$tcl->getSysReturnCode()."{".$tcl->getSysReturnitem("IS_ENV_LCL")."}:[".$tcl->getSysReturnitem("TRXN_URL")."]");  
            }
            else
            {
                $return = $gamer;
            }
        }
        else
        {
            $return->setSysReturnStructure("RETURN_CODE", "FORM_FIELDS_NOT_VALID"
                                        ,"RETURN_SHOW_PASS_MSG", "FALSE"
                                        ,"RETURN_MSG", "Please fill in all fields.");
        }
        return $return;
    }

    function validate()
    {
        $fv = true;  // Form is Valid Key T=Valid; anything else is invalid;
        if(getControlKey() == "GAMER_REGISTRATION") {
            if(!isset($_POST["email"]) || trim($_POST["email"]) == "")
                $fv = ajaxValidationLogging(false, "loginGamerByEmail", "POST:email");
        }
        return $fv;
    }
}