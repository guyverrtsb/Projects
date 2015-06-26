<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php zReqOnce("/_controls/classes/accesspoints/gamer.php"); ?>
<?php
class Executor
    extends AppSysBaseObject
{
    function execute()
    {
        $this->setSysReturnitem("useraccount_uid", zConfig()->getAuthUserUid());
        
        $gamer = new Gamer();
        $gamer->retrieveGamer("useraccount_uid", $return->getSysReturnitem("useraccount_uid"));
        
        if($gamer->getSysReturnCode() == "GAMER_ACCOUNT_FOUND")
        {
            $gamer->setSysReturnCode("GAMER_INFO_STATED");
            $this->setSysReturnObj($gamer);
        }
        else
        {
            $this->setSysReturnCode("GAMER_INFO_NOT_STATED");
        }
        return $this;
    }

    function validate()
    {
        $fv = true;  // Form is Valid Key T=Valid; anything else is invalid;

        return $fv;
    }
}