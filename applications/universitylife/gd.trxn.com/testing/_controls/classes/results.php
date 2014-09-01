<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/**
 * Author: Stephen Shellenberger
 * Copyright: 2013 Stephen Shellenberger
 * Date: 2013/01/05
 * This Class file is for Registering User Data
 * 1. registerWallMessage - 
 * -- Register the User Account.
 * 2. registerUserProfile - 
 * -- Use this Method to Register the User Profile
 * 3. getUserAccountUID
 * 4. getUserAccountEMAIL
 * 5. getUserProfileUID
 * 6. getUserProfileFNAME
 * 7. getUserAccountLNAME
 * 8. getUserProfileCITY
 * 9. getUserAccountSTATE
 * 10. getUserProfileCOUNTRY
 * 11. getUserAccountNICKNAME
 */

class zGetResults
    extends zAppBaseObject
{
    // SearchRecordsBySearchObjectandRecordUID
    private $searchRecordsBySearchObjectsandRecordUID;
    
    function __construct()
    {

    }
    
    /**
     * Find University Account and Profile by Email Key
     * $university_account_emailkey = EMAILKEY
     */
    function findSiteInformationRecords()
    {
        $this->gdlog()->LogInfo("****************: START :findSiteInformationRecords()");
        $fr;
        $this->cleanResults_SearchRecordsBySearchObjectsandRecordUID();
        
        $sqlstmnt = "select usersafety_site_alias.sdesc, usersafety_site.sdesc".
            ", usersafety_role.sdesc ".
            "from usersafety_site_alias ".
            "join match_usersafety_site_to_site_alias".
            " on match_usersafety_site_to_site_alias.usersafety_site_alias_uid = usersafety_site_alias.uid ".
            "join usersafety_site".
            " on usersafety_site.uid = match_usersafety_site_to_site_alias.usersafety_site_uid ".
            "join match_usersafety_site_to_role".
            " on match_usersafety_site_to_role.usersafety_site_uid = usersafety_site.uid ".
            "join usersafety_role".
            " on match_usersafety_site_to_role.usersafety_role_uid = usersafety_role.uid";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("USERSAFETY");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->execSelect();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->searchRecordsBySearchObjectsandRecordUID
                    = $dbcontrol->getStatement();
                $this->gdlog()->LogInfo("findSiteInformationRecords():RECORDS_FOUND");
                $fr = "RECORDS_FOUND";
            }
            else
            {
                $this->gdlog()->LogInfo("findSiteInformationRecords():RECORDS_NOT_FOUND");
                $fr = "RECORDS_NOT_FOUND";
            }
        }
        else
        {
            $this->gdlog()->LogError("findSiteInformationRecords():TRANSACTION_FAIL");
            $fr = "TRANSACTION_FAIL";
        }
        $this->gdlog()->LogInfo("****************: END :findSiteInformationRecords()");
        return $fr;
    }
    
    function cleanResults_SearchRecordsBySearchObjectsandRecordUID()
    {
        $this->searchRecordsBySearchObjectsandRecordUID = "";
    }

    function getResults_SearchRecordsBySearchObjectsandRecordUID()
    {
        return $this->searchRecordsBySearchObjectsandRecordUID;
    }
}
?>