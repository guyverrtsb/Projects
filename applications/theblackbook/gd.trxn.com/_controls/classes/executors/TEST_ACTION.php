<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php
class Action
    extends AppSysBaseObject
{
    function execute()
    {
        if($this->validate())
        {
            $this->setSysReturnCode("FIELDS_ARE_GOOD");
            $this->setSysReturnShowMsg("TRUE");
            $this->setSysReturnMsg("You have entered in the fields correctly.");
        }
        else
        {
            $this->setSysReturnCode("FORM_FIELDS_NOT_VALID");
            $this->setSysReturnShowMsg("TRUE");
            $this->setSysReturnMsg("Please fill in all fields.");
        }
        return $this;
    }

    function validate()
    {
        $fv = true;  // Form is Valid Key T=Valid; anything else is invalid;
        if(zConfig()->getAuthUserUid() == "")
            $fv = ajaxValidationLogging(false, "Config_AuthUserId", "CONFIG:AUTH_USER_ID");
        return $fv;
    }
}