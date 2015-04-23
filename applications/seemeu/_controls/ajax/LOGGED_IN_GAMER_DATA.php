<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php zReqOnce("/_controls/classes/accesspoints/gamer.php"); ?>
<?php
class Ajax
    extends AppSysBaseObject
{
    function execute()
    {
        $return = new AppSysBaseObject();
        $return->setSysReturnitem("useraccount_uid", zConfig()->getAuthUserUid());
        
        $gamer = new Gamer();
        $gamer->retrieveGamer("useraccount_uid", $return->getSysReturnitem("useraccount_uid"));
        
        if($gamer->getSysReturnCode() == "GAMER_ACCOUNT_FOUND")
        {
            $return = $gamer;
            $return->setSysReturnCode("GAMER_INFO_STATED");
        }
        else
        {
            $return->setSysReturnCode("GAMER_INFO_NOT_STATED");
        }
        return $return;
    }

    function validate()
    {
        $fv = true;  // Form is Valid Key T=Valid; anything else is invalid;

        return $fv;
    }
}