<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php zReqOnce("/gd.trxn.com/crossapplication/_controls/classes/accesspoints/generateuniquevalue.php"); ?>
<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/retrieve/useraccount.php"); ?>
<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/create/useraccount.php"); ?>
<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/create/userprofile.php"); ?>
<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/create/match_user.php"); ?>
<?php zReqOnce("/gd.trxn.com/crossapplication/_controls/classes/accesspoints/taskcontrol.php"); ?>
<?php
/*
* File: user.php
* Author: Stephen Shellenberger
* Copyright: 2015 Stephen Shellenberger
* Date: 2015/02/01
*/
class User
    extends AppSysBaseObject
{
    function __construct()
    {
    }
    
    function retrieveUserAccount($email)
    {
        zLog()->LogStart_AccessPointFunction("retrieveUserInfo");
        
        $emailexists = new RetrieveUserAccount();
        $emailexists->byEmail($email);
        
        if($emailexists->getSysReturnCode() == "RECORD_IS_FOUND")
        {
            $this->setSysReturnitem("useraccount_uid", $emailexists->getUid());
            $this->setSysReturnitem("useraccount_email", $emailexists->getEmail());
            $this->setSysReturnitem("useraccount_nickname", $emailexists->getNickname());
            $this->setSysReturnitem("useraccount_usertablekey", $emailexists->getUsertablekey());
            
            $this->setSysReturnData("USER_ACCOUNT_IS_FOUND", "User Account is found");
        }
        else if($emailexists->getSysReturnCode() == "RECORD_IS_NOT_FOUND")
        {
            $this->setSysReturnData("EMAIL_NOT_FOUND", "Email is not found");
        }
        
        zLog()->LogEnd_AccessPointFunction("retrieveUserInfo");
    }
}
?>