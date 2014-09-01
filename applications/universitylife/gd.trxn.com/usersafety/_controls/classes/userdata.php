<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php gdreqonce("/gd.trxn.com/usersafety/_controls/classes/find/_user_data.php"); ?>
<?php gdreqonce("/gd.trxn.com/usersafety/_controls/classes/find/usersafety_useraccount.php"); ?>
<?php gdreqonce("/gd.trxn.com/usersafety/_controls/classes/find/usersafety_role.php"); ?>
<?php gdreqonce("/gd.trxn.com/usersafety/_controls/classes/update/usersafety_useraccount.php"); ?>
<?php gdreqonce("/gd.trxn.com/usersafety/_controls/classes/update/usersafety_userprofile.php"); ?>
<?php gdreqonce("/gd.trxn.com/usersafety/_controls/classes/update/match_usersafety_useraccount_to_role.php"); ?>
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
class gdUserData
    extends zAppBaseObject
{
    function __construct()
    {
    }
    
    function findUserDataList()
    {
        $this->gdlog()->LogInfoStartFUNCTION("findUserDataList");
        $fr = "UNKNOWN_ERROR";
        $this->cleanAllOutputData();
        
        $gdfud = new gdFindUserData();
        $fr = $gdfud->findUserData_List();
        if($fr == "RECORDS_ARE_FOUND")
        {
            $this->setResult_Records($gdfud->getResult_Records());
            $fr = $this->gdlog()->LogInfoRETURN("RECORDS_ARE_FOUND");
        }
        else
        {
            $fr = $this->gdlog()->LogInfoRETURN("RECORDS_ARE_NOT_FOUND");
        }
        
        $this->gdlog()->LogInfoEndFUNCTION("findUserDataList");
        return $fr;
    }
    
    function findUserData_byUid($usesafety_useraccount_uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findUserData_byUid");
        $fr = "UNKNOWN_ERROR";
        $this->cleanAllOutputData();
        
        $gdfud = new gdFindUserData();
        $fr = $gdfud->findUserData_ByUid($usesafety_useraccount_uid);
        if($fr == "RECORD_IS_FOUND")
        {
            $this->setResult_Record($gdfud->getResult_Record());
            $fr = $this->gdlog()->LogInfoRETURN("RECORD_IS_FOUND");
        }
        else
        {
            $fr = $this->gdlog()->LogInfoRETURN("RECORD_IS_NOT_FOUND");
        }
        
        $this->gdlog()->LogInfoEndFUNCTION("findUserData_byUid");
        return $fr;
    }
    
    function updateUserData_byUid($usersafety_useraccount_uid,
                                $usersafety_userprofile_uid,
                                $email,
                                $nickname,
                                $firstname,
                                $lastname,
                                $cfg_country_sdesc,
                                $cfg_region_sdesc,
                                $city,
                                $usersafety_role_uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("updateUserData_byUid");
        $fr = "UNKNOWN_ERROR";
        $this->cleanAllOutputData();
        
        $gdfua = new gdFindUsersafetyAccount();
        // $emailexists = $gdfua->findUsersafetyAccount_byEmail($email);
        // $nicknameexists = $gdfua->findUsersafetyAccount_byNickname($nickname);
        // $tablekeyexists = $gdfua->findUsersafetyAccount_byUsertablekey($nickname);
        // if($emailexists == "RECORD_IS_NOT_FOUND" && $nicknameexists == "RECORD_IS_NOT_FOUND" && $tablekeyexists == "RECORD_IS_NOT_FOUND")
        // {
            // $gduua = new gdUpdateUsersafetyAccount();
            // $gduua->updateRecordUserAccount_UEN($usersafety_useraccount_uid, $email, $nickname);
        
            $gduup = new gdUpdateUsersafetyProfile();
            $gduup->updateRecordUserAccount($usersafety_userprofile_uid, $firstname, $city, $lastname, $cfg_region_sdesc, $cfg_country_sdesc);
            
            $gdumar = new gdUpdateMatchAccounttoRole();
            $gdumar->updateRecordUserAccounttoRole($usersafety_useraccount_uid, $usersafety_role_uid);
            
            $fr = $this->gdlog()->LogInfoRETURN("USER_DATA_IS_UPDATED");
        // }
        // else if($emailexists == "RECORD_IS_FOUND")
        // {
        //     $fr = $this->gdlog()->LogInfoRETURN("EMAIL_IN_USE");
        // }
        // else if($nicknameexists == "RECORD_IS_FOUND")
        // {
        //     $fr = $this->gdlog()->LogInfoRETURN("NICKNAME_IN_USE");
        // }
        // else if($tablekeyexists == "RECORD_IS_FOUND")
        // {
        //     $fr = $this->gdlog()->LogInfoRETURN("USERTABLEKEY_IN_USE");
        // }
        
        $this->gdlog()->LogInfoEndFUNCTION("updateUserData_byUid");
        return $fr;
    }
}
?>