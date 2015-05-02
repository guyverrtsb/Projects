<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php
class Action
    extends AppSysBaseObject
{
    function execute()
    {
        $return = new AppSysBaseObject();
        if($this->validate())
        {
            $return->setSysReturnCode("FIELDS_ARE_GOOD");
            $return->setSysReturnShowMsg("TRUE");
            $return->setSysReturnMsg("You have entered in the fields correctly.");
        }
        else
        {
            $return->setSysReturnCode("FORM_FIELDS_NOT_VALID");
            $return->setSysReturnShowMsg("TRUE");
            $return->setSysReturnMsg("Please fill in all fields.");
        }
        return $return;
    }

    function validate()
    {
        $fv = true;  // Form is Valid Key T=Valid; anything else is invalid;
        if(zConfig()->getAuthUserUid() == "")
            $fv = ajaxValidationLogging(false, "Config_AuthUserId", "CONFIG:AUTH_USER_ID");
        return $fv;
    }
}