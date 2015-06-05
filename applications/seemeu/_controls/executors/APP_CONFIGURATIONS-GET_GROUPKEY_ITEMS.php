<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/retrieve/appconfiguration.php"); ?>
<?php
class Executor
    extends AppSysBaseObject
{
    function execute()
    {
        if($this->validate())
        {
            $groupkey = trim($_POST["groupkey"]);

            $rac = new RetrieveAppConfiguration();
            $rac->byGroupkey($groupkey);
            
            $this->setSysReturnObj($rac);
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
        if(!isset($_POST["groupkey"]) || trim($_POST["groupkey"]) == "")
            $fv = ajaxValidationLogging(false, "AppConfigurations", "POST:groupkey");
        return $fv;
    }
}