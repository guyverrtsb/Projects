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
            $taskkey = trim($_GET["TASKKEY"]);

            $tcl = new TaskControl();
            $tcl->executeTaskControl($taskkey);
            
            if($tcl->getSysReturnCode() == "TASK_PERFORMED")
            {
                $tcl->setSysReturnCode("TASK_PERFORMED");
                $this->setSysReturnObj($tcl);
            }
            else
            {
                $tcl->setSysReturnCode("TASK_NOT_PERFORMED");
                $this->setSysReturnObj($tcl);
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
        if(!isset($_GET["TASKKEY"]) || trim($_GET["TASKKEY"]) == "")
            $fv = ajaxValidationLogging(false, "loginGamerByEmail", "POST:email");
        return $fv;
    }
}