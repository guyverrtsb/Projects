<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
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
                $this->transferSysReturnAry($tcl);
                $this->setSysReturnData("TASK_PERFORMED", "Task is Performed");
            }
            else
            {
                $this->transferSysReturnAry($tcl);
                $this->setSysReturnData("TASK_NOT_PERFORMED", "Task is not Performed");
            }
        }
        else
        {
            $this->setSysReturnData("FORM_FIELDS_NOT_VALID", "Please fill in all fields.");
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