<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/*
 * Author: Stephen Shellenberger
 * Copyright: 2013 Stephen Shellenberger
 * Date: 2013/01/07
 */
class zFindUniversity
    extends zAppBaseObject
{
    /**
     * Find University Account and Profile by Email Key
     * $university_account_emailkey = EMAILKEY
     */
    function findAccountandProfileByUID($university_account_uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findAccountandProfileByUID");
        $fr;
        $sqlstmnt = "SELECT ".
            $this->dbfas("university_account.uid, ".
                        "university_account.sdesc, ".
                        "university_account.emailkey, ".
                        "university_profile.uid, ".
                        "university_profile.name, ".
                        "university_profile.content, ".
                        "university_profile.city, ".
                        "university_profile.cfg_region_sdesc, ".
                        "university_profile.cfg_country_sdesc, ".
                        "university_profile.foundeddate").
        " FROM university_account ".
        "JOIN match_university_account_to_university_profile on ".
            "match_university_account_to_university_profile.university_account_uid = university_account.uid ".
        "JOIN university_profile on ".
            "match_university_account_to_university_profile.university_profile_uid = university_profile.uid ".
        "WHERE university_account.uid=:university_account_uid";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":university_account_uid", $university_account_uid);
        $dbcontrol->execSelect();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResult_AccountandProfile($dbcontrol->getStatement()->fetch(PDO::FETCH_ASSOC));

                $this->gdlog()->LogInfoDB($this->getResult_AccountandProfile());
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
        $this->gdlog()->LogInfoEndFUNCTION("findAccountandProfileByUID");
        return $fr;
    }
    
    
    /**
     * Find University Account and Profile by Email Key
     * $university_account_emailkey = EMAILKEY
     */
    function findAccountandProfileByEmailKey($university_account_emailkey)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findAccountandProfileByEmailKey");
        $fr;
        $sqlstmnt = "SELECT ".
            $this->dbfas("university_account.uid, ".
                        "university_account.sdesc, ".
                        "university_account.emailkey, ".
                        "university_profile.uid, ".
                        "university_profile.name, ".
                        "university_profile.content, ".
                        "university_profile.city, ".
                        "university_profile.cfg_region_sdesc, ".
                        "university_profile.cfg_country_sdesc, ".
                        "university_profile.foundeddate").
        " FROM university_account ".
        "JOIN match_university_account_to_university_profile on ".
            "match_university_account_to_university_profile.university_account_uid = university_account.uid ".
        "JOIN university_profile on ".
            "match_university_account_to_university_profile.university_profile_uid = university_profile.uid ".
        "WHERE university_account.emailkey=:university_account_emailkey";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":university_account_emailkey", $university_account_emailkey);
        $dbcontrol->execSelect();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResult_AccountandProfile($dbcontrol->getStatement()->fetch(PDO::FETCH_ASSOC));

                $this->gdlog()->LogInfoDB($this->getResult_AccountandProfile());
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
        $this->gdlog()->LogInfoEndFUNCTION("findAccountandProfileByEmailKey");
        return $fr;
    }
    
    /**
     * Find All Universities Accounts and Profiles
     * use the getAllFoundUniversitiesAccountsandProfilesRecords
     * to get results
     * Results_findAllUniversitiesAccountsandProfiles
     * getResults_findAllUniversitiesAccountsandProfiles
     */
    function findAllUniversitiesAccountsandProfiles()
    {
        $this->gdlog()->LogInfoStartFUNCTION("findAllUniversitiesAccountsandProfiles");
        $fr;
        $sqlstmnt = "SELECT ".
            $this->dbfas("university_account.uid, ".
                        "university_account.sdesc, ".
                        "university_account.emailkey, ".
                        "university_profile.uid, ".
                        "university_profile.name, ".
                        "university_profile.content, ".
                        "university_profile.city, ".
                        "university_profile.cfg_region_sdesc, ".
                        "university_profile.cfg_country_sdesc, ".
                        "university_profile.foundeddate").
        " FROM university_account ".
        "JOIN match_university_account_to_university_profile on ".
            "match_university_account_to_university_profile.university_account_uid = university_account.uid ".
        "JOIN university_profile on ".
            "match_university_account_to_university_profile.university_profile_uid = university_profile.uid";

        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->execSelect();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResults_AllAccountsandProfiles($dbcontrol->getStatement()->fetchAll(PDO::FETCH_ASSOC));
                $this->gdlog()->LogInfoDB($this->getResults_AllAccountsandProfiles());
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
        $this->gdlog()->LogInfoEndFUNCTION("findAllUniversitiesAccountsandProfiles");
        return $fr;
    }
    
    private $Results_AllAccountsandProfiles = "NO_RECORDS";
    private $Result_AccountandProfile = "NO_RECORD";
    function setResults_AllAccountsandProfiles($rows)
    {
        $this->Results_AllAccountsandProfiles = $rows;
    }
    
    function getResults_AllAccountsandProfiles()
    {
        return $this->Results_AllAccountsandProfiles;
    }
    
    function setResult_AccountandProfile($row)
    {
        $this->Result_AccountandProfile = $row;
    }
    
    function getResult_AccountandProfile()
    {
        return $this->Result_AccountandProfile;
    }
    
    function getUA_Uid() { return $this->Result_AccountandProfile[$this->dbf("university_account.uid")]; }
    function getSdesc() { return $this->Result_AccountandProfile[$this->dbf("university_account.sdesc")]; }
    function getEmailkey() { return $this->Result_AccountandProfile[$this->dbf("university_account.emailkey")]; }
    function getUP_Uid() { return $this->Result_AccountandProfile[$this->dbf("university_profile.uid")]; }
    function getName() { return $this->Result_AccountandProfile[$this->dbf("university_profile.name")]; }
    function getContent() { return $this->Result_AccountandProfile[$this->dbf("university_profile.content")]; }
    function getCity() { return $this->Result_AccountandProfile[$this->dbf("university_profile.city")]; }
    function getRegionCfgUid() { return $this->findCfgUidfromSdesc($this->Result_AccountandProfile[$this->dbf("university_profile.cfg_region_sdesc")]); }
    function getCountryCfgUid() { return $this->findCfgUidfromSdesc($this->Result_AccountandProfile[$this->dbf("university_profile.cfg_country_sdesc")]); }
    function getRegionCfgSdesc() { return $this->Result_AccountandProfile[$this->dbf("university_profile.cfg_region_sdesc")]; }
    function getCountryCfgSdesc() { return $this->Result_AccountandProfile[$this->dbf("university_profile.cfg_country_sdesc")]; }
    function getFoundeddate() { return $this->Result_AccountandProfile[$this->dbf("university_profile.foundeddate")]; }
    function getTablekey() {
        $emailkey = $this->getEmailkey();
        $univtablekey = explode(".", $this->getEmailkey());
        $univtablekey = strtolower($univtablekey[0]);
        return "z_".$univtablekey."_";
    }
}
?>