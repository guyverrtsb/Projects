<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/retrieve/group.php"); ?>
<?php
class Executor
    extends AppSysBaseObject
{
    function execute()
    {
        zLog()->LogStart_ExecutorFunction("SEEMEU-GET_GROUPS_BY_ROLE");
        if($this->validate())
        {
            $rolekey = trim($_POST["rolekey"]);
            
            $rg = new RetrieveGroup();
            $rg->getGroupsbyRole($rolekey);
            
            $this->transferSysReturnAry($rg);
            $this->setSysReturnData("SUCCESS", "FOUND");
        }
        else
        {
            $this->setSysReturnData("FORM_FIELDS_NOT_VALID", "Please fill in all fields.");
        }
        zLog()->LogEnd_ExecutorFunction("SEEMEU-GET_GROUPS_BY_ROLE");
    }

    function validate()
    {
        $fv = true;  // Form is Valid Key T=Valid; anything else is invalid;
        if(!isset($_POST["rolekey"]) || trim($_POST["rolekey"]) == "")
            $fv = ajaxValidationLogging(false, "SeemeuGetgroupbyrole", "POST:rolekey");
        return $fv;
    }
}