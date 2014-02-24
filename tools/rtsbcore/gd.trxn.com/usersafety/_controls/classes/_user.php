<?php gdreqonce("/gd.trxn.com/_controls/classes/base/database.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. Is Email in Use
 * 2. Create User Account with account inactive
 * 3, Create Profile
 * 4. Match User Account to Profile
 * 5. Match User to Site 
 * 6. Match User to Role
 * 7. Register Activation Record
 * 8. Send Activation Email
*/
class Z_User_Base
    extends Z_GD_Database
{
    private $ua_uid, $ua_email, $up_uid, $up_fname, $up_lname, $up_nickname;
    
    function setUserAcountandProfile($uid)
    {
        $sqlstmnt = "SELECT usersafety_useraccounts.uid, usersafety_useraccounts.email, ".
            "usersafety_userprofiles.uid, usersafety_userprofiles.firstname, ".
            "usersafety_userprofiles.lastname, usersafety_userprofiles.nickname ".
            "FROM match_usersafety_useraccounts_to_userprofiles ".
            "JOIN usersafety_useraccounts ON match_usersafety_useraccounts_to_userprofiles.usersafety_user_accounts_uid = usersafety_useraccounts.uid ".
            "JOIN usersafety_userprofiles ON match_usersafety_useraccounts_to_userprofiles.usersafety_user_profiles_uid = usersafety_userprofiles.uid ".
            "WHERE match_usersafety_useraccounts_to_userprofiles.usersafety_user_accounts_uid=:usersafety_user_accounts_uid";
        
        $dbcontrol = new Z_GDDBConnection();
        $dbcontrol->setCrossAppConn();
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":usersafety_user_accounts_uid", $uid);
        $dbcontrol->execSelect();
        
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $row = $dbcontrol->getStatement()->fetch();
                $this->ua_uid = $row[0];
                $this->ua_email = $row[1];
                $this->up_uid = $row[2];
                $this->up_fname = $row[3];
                $this->up_lname = $row[4];
                $this->up_nickname = $row[5];
                
                $this->gdlog()->LogInfo("setUserAcountandProfile():Match Record Found".
                    ":ua_uid:".$row[0].
                    ":ua_email:".$row[1].
                    ":up_uid:".$row[2].
                    ":up_fname:".$row[3].
                    ":up_lname:".$row[4].
                    ":up_nickname:".$row[5]);

                return "MATCH_RECORD_FOUND";
            }
            else
            {
                $this->gdlog()->LogInfo("setUserAcountandProfile():Match Record not Found");
                return "MATCH_RECORD_NOT_FOUND";
            }
        }
        else
        {
            $this->gdlog()->LogInfo("setUserAcountandProfile():TRANSACTION_FAIL");
            return "TRANSACTION_FAIL";
        }
    }

    function getUaUid()
    {
        return $this->ua_uid;
    }
    function getUaEmail()
    {
        return $this->ua_email;
    }
    function getUpUid()
    {
        return $this->up_uid;
    }
    function getUpFname()
    {
        return $this->up_fname;
    }
    function getUpLname()
    {
        return $this->up_lname;
    }
    function getUpNickname()
    {
        return $this->up_nickname;
    }
}
?>
    