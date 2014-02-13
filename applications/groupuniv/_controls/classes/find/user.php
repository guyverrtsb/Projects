<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/*
 * Author: Stephen Shellenberger
 * Copyright: 2013 Stephen Shellenberger
 * Date: 2013/01/05
 * This Class file is for Finding User data
 * is the primary object
 * 1. findAccountandProfileByEmail - 
 * -- Use this Method to access User Accounts
 * -- and user Profile by Email
 * 2. findAllUsersAccountsandProfiles
 * 3. getAllFoundUsersAccountsandProfilesRecords
 * 4. getUserAccountUID
 * 5. getUserAccountEMAIL
 * 6. getUserProfileUID
 * 7. getUserProfileFNAME
 * 8. getUserProfileLNAME
 * 9. getUserProfileCITY
 * 10. getUserProfileSTATE
 * 11. getUserProfileCOUNTRY
 * 12. getUserProfileNICKNAME
 */
class zFindUser
    extends zAppBaseObject
{
    function findAccountandProfileByUid($uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findAccountandProfileByEmail");
        $fr;
        $sqlstmnt = "SELECT ".
            $this->dbfas("user_account.uid, ".
                        "user_account.email, ".
                        "user_account.active, ".
                        "user_profile.uid, ".
                        "user_profile.fname, ".
                        "user_profile.lname, ".
                        "user_profile.city, ".
                        "user_profile.cfg_region_uid, ".
                        "user_profile.cfg_country_uid, ".
                        "user_profile.nickname").
        " FROM user_account ".
        "JOIN match_user_account_to_user_profile on ".
            "match_user_account_to_user_profile.user_account_uid = user_account.uid ".
        "JOIN user_profile on ".
            "match_user_account_to_user_profile.user_profile_uid = user_profile.uid ".
        "WHERE user_account.uid=:user_account_uid";

        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":user_account_uid", $uid);
        $dbcontrol->execSelect();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResult_AccountProfile($dbcontrol->getStatement()->fetch(PDO::FETCH_ASSOC));
                $this->gdlog()->LogInfoDB($this->getResult_AccountProfile());
                $fr = $this->gdlog()->LogInfoRETURN("ACCOUNT_FOUND");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("ACCOUNT_NOT_FOUND");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("findAccountandProfileByEmail");
        return $fr;
    }

    /**
     * Find User Account and Profile by Email address
     * $user_account_email = EMAIL
     */
    function findAccountandProfileByEmail($user_account_email)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findAccountandProfileByEmail");
        $fr;
        $sqlstmnt = "SELECT ".
            $this->dbfas("user_account.uid, ".
                        "user_account.email, ".
                        "user_account.active, ".
                        "user_profile.uid, ".
                        "user_profile.fname, ".
                        "user_profile.lname, ".
                        "user_profile.city, ".
                        "user_profile.cfg_region_uid, ".
                        "user_profile.cfg_country_uid, ".
                        "user_profile.nickname").
        " FROM user_account ".
        "JOIN match_user_account_to_user_profile on ".
            "match_user_account_to_user_profile.user_account_uid = user_account.uid ".
        "JOIN user_profile on ".
            "match_user_account_to_user_profile.user_profile_uid = user_profile.uid ".
        "WHERE email=:email";

        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":email", $user_account_email);
        $dbcontrol->execSelect();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResult_AccountProfile($dbcontrol->getStatement()->fetch(PDO::FETCH_ASSOC));
                $this->gdlog()->LogInfoDB($this->getResult_AccountProfile());
                $fr = $this->gdlog()->LogInfoRETURN("ACCOUNT_FOUND");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("ACCOUNT_NOT_FOUND");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("findAccountandProfileByEmail");
        return $fr;
    }

    /**
     * Find All User Accounts and Profiles
     * use the getAllFoundUsersAccountsandProfilesRecords
     * to get results
     */
    function findAllUsersAccountsandProfiles()
    {
        $this->gdlog()->LogInfoStartFUNCTION("findAllUsersAccountsandProfiles");
        $fr;
        $sqlstmnt = "SELECT ".
            $this->dbfas("user_account.uid, ".
                        "user_account.email, ".
                        "user_account.active, ".
                        "user_profile.uid, ".
                        "user_profile.fname, ".
                        "user_profile.lname, ".
                        "user_profile.city, ".
                        "user_profile.cfg_region_uid, ".
                        "user_profile.cfg_country_uid, ".
                        "user_profile.nickname").
        " FROM user_account ".
        "JOIN match_user_account_to_user_profile on ".
            "match_user_account_to_user_profile.user_account_uid = user_account.uid ".
        "JOIN user_profile on ".
            "match_user_account_to_user_profile.user_profile_uid = user_profile.uid";

        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->execSelect();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResults_AccountProfiles($dbcontrol->getStatement()->fetchAll(PDO::FETCH_ASSOC));
                $this->gdlog()->LogInfoDB($this->getResults_AccountProfiles());
                $fr = $this->gdlog()->LogInfoRETURN("ACCOUNTS_FOUND");
              }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("ACCOUNTS_NOT_FOUND");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("findAllUsersAccountsandProfiles");
        return $fr;
    }

    /**
     * Find All User Accounts and Profiles
     * use the getAllFoundUsersAccountsandProfilesRecords
     * to get results
     */
    function findUserAccountandProfileofGroupOwner($group_account_uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findUserAccountandProfileofGroupOwner");
        $utk = $this->getGDConfig()->getSessUnivTblKey();
        $fr;
        $sqlstmnt = "SELECT ".
            $this->dbfas("user_account.uid, ".
                        "user_account.email, ".
                        "user_account.active, ".
                        "user_profile.uid, ".
                        "user_profile.fname, ".
                        "user_profile.lname, ".
                        "user_profile.city, ".
                        "user_profile.cfg_region_uid, ".
                        "user_profile.cfg_country_uid, ".
                        "user_profile.nickname").
        " FROM user_account ".
        "JOIN match_user_account_to_user_profile on ".
            "match_user_account_to_user_profile.user_account_uid = user_account.uid ".
        "JOIN user_profile on ".
            "match_user_account_to_user_profile.user_profile_uid = user_profile.uid ".
        "JOIN ".$utk."match_user_account_to_group_account_to_cfg_user_roles on ".
            $utk."match_user_account_to_group_account_to_cfg_user_roles.user_account_uid = user_account.uid ".
        "WHERE ".$utk."match_user_account_to_group_account_to_cfg_user_roles.cfg_user_roles_uid ".
            "= (SELECT uid FROM cfg_user_roles WHERE sdesc = 'GROUP_OWNER') ".
        "AND ".$utk."match_user_account_to_group_account_to_cfg_user_roles.group_account_uid = :group_account_uid";

        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":group_account_uid", $group_account_uid);
        $dbcontrol->execSelect();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResult_AccountProfile($dbcontrol->getStatement()->fetch(PDO::FETCH_ASSOC));
                $this->gdlog()->LogInfoDB($this->getResult_AccountProfile());
                $fr = $this->gdlog()->LogInfoRETURN("ACCOUNT_FOUND");
              }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("ACCOUNT_NOT_FOUND");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("findUserAccountandProfileofGroupOwner");
        return $fr;
    }

    private $Result_AccountProfile = "NO_RECORD";
    private $Results_AccountProfiles = "NO_RECORDS";
   
    function setResults_AccountProfiles($row)
    {
        $this->Results_AccountProfiles = $row;
    }
    
    function getResults_AccountProfiles()
    {
        return $this->Results_AccountProfiles;
    }
    
    function setResult_AccountProfile($row)
    {
        $this->Result_AccountProfile = $row;
    }
    
    function getResult_AccountProfile()
    {
        return $this->Result_AccountProfile;
    }
    
    function getUA_Uid() { return $this->Result_AccountProfile[$this->dbf("user_account.uid")]; }
    function getEmail() { return $this->Result_AccountProfile[$this->dbf("user_account.email")]; }
    function getActive() { return $this->Result_AccountProfile[$this->dbf("user_account.active")]; }
    function getUP_Uid() { return $this->Result_AccountProfile[$this->dbf("user_profile.uid")]; }
    function getFName() { return $this->Result_AccountProfile[$this->dbf("user_profile.fname")]; }
    function getLName() { return $this->Result_AccountProfile[$this->dbf("user_profile.lname")]; }
    function getCity() { return $this->Result_AccountProfile[$this->dbf("user_profile.city")]; }
    function getRegionCfgUid() { return $this->Result_AccountProfile[$this->dbf("user_profile.cfg_region_uid")]; }
    function getCountryCfgUid() { return $this->Result_AccountProfile[$this->dbf("user_profile.cfg_country_uid")]; }
    function getNickname() { return $this->Result_AccountProfile[$this->dbf("user_profile.nickname")]; }
}
?>