<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/retrieve/appconfiguration.php"); ?>
<?php
class Executor
    extends AppSysBaseObject
{
    function execute()
    {
        zLog()->LogStart_ExecutorFunction("APP_CONFIGURATIONS-GET_GROUPKEY_ITEMS");
        if($this->validate())
        {
            $groupkey = trim($_POST["groupkey"]);

            $rac = new RetrieveAppConfiguration();
            $rac->byGroupkey($groupkey);
            
            $this->transferSysReturnAry($rac);
            $this->setSysReturnData("SUCCESS", "FOUND");
        }
        else
        {
            $this->setSysReturnData("FORM_FIELDS_NOT_VALID", "Please fill in all fields.");
        }
        zLog()->LogEnd_ExecutorFunction("APP_CONFIGURATIONS-GET_GROUPKEY_ITEMS");
        return $this;
    }

    function validate()
    {
        $fv = true;  // Form is Valid Key T=Valid; anything else is invalid;
        if(!isset($_POST["groupkey"]) || trim($_POST["groupkey"]) == "")
            $fv = ajaxValidationLogging(false, "AppConfigurations", "POST:groupkey");
        return $fv;
    }
}