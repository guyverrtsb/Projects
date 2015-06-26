<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php zReqOnce("/_controls/classes/accesspoints/gamer.php"); ?>
<?php zReqOnce("/gd.trxn.com/crossapplication/_controls/classes/accesspoints/taskcontrol.php"); ?>
<?php
class Executor
    extends AppSysBaseObject
{
    function execute()
    {
        if($this->validate())
        {
            $useraccount_email = trim($_POST["email"]);

            $gamer = new Gamer();
            $gamer->retrieveGamer("useraccount_email", $useraccount_email);
            
            if($gamer->getSysReturnCode() == "GAMER_ACCOUNT_FOUND")
            {
                $args["useraccount_uid"] = $gamer->getOutputData("useraccount_uid");
                $args["useraccount_email"] = $gamer->getOutputData("useraccount_email");
                $args["useraccount_nickname"] = $gamer->getOutputData("useraccount_nickname");
                
                $args["userprofile_firstname"] = $gamer->getOutputData("userprofile_firstname");
                $args["userprofile_lastname"] = $gamer->getOutputData("userprofile_lastname");
                
                $args["gameraccount_uid"] = $gamer->getOutputData("gameraccount_uid");
                $args["gameraccount_gamertag"] = $gamer->getOutputData("gameraccount_gamertag");
                                
                $tcl = new TaskControl();
                $tcl->createTaskControl("RESET_GAMER_PASSWORD",
                                        "/_controls/classes/accesspoints/crossappli_task.php",
                                        $args);
                                                
                $args["taskcontrollink_uid1"] = $tcl->getOutputData("uid1");
                $args["taskcontrollink_uid2"] = $tcl->getOutputData("uid2");
                $args["taskcontrollink_uid3"] = $tcl->getOutputData("uid3");
                $args["taskcontrollink_appl_configurations_sdesc_taskkey"] = $tcl->getOutputData("appl_configurations_sdesc_taskkey");
                
                $tcl->sendTaskControl($args);
                if($tcl->getSysReturnCode() == "TASK_PERFORMED")
                {
                    $tcl->setSysReturnMsg("Here is the return info for the New Record:".$tcl->getSysReturnCode()."{".$tcl->getSysReturnitem("IS_ENV_LCL")."}:[".$tcl->getSysReturnitem("TRXN_URL")."]");
                    $tcl->setSysReturnCode("RESET_PASSWORD_COMPLETED");
                    $this->setSysReturnObj($tcl);
                }
                else
                {
                    $this->setSysReturnCode("RESET_PASSWORD_NOT_COMPLETED");
                }
            }
            else
            {
                $this->setSysReturnObj($gamer);
            }
        }
        else
        {
            $this->setSysReturnCode("FORM_FIELDS_NOT_VALID");
            $this->setSysReturnShowMsg("FALSE");
            $this->setSysReturnMsg("Please fill in all fields.");
        }
        return $this;
    }

    function validate()
    {
        $fv = true;  // Form is Valid Key T=Valid; anything else is invalid;
        if(!isset($_POST["email"]) || trim($_POST["email"]) == "")
            $fv = ajaxValidationLogging(false, "loginGamerByEmail", "POST:email");
        return $fv;
    }
}