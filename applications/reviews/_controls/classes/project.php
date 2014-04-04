<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php gdreqonce("/_controls/classes/create/accounting_project.php"); ?>
<?php gdreqonce("/_controls/classes/create/accounting_project_profile.php"); ?>
<?php gdreqonce("/_controls/classes/find/accounting_project.php"); ?>
<?php gdreqonce("/_controls/classes/update/accounting_project.php"); ?>
<?php gdreqonce("/_controls/classes/update/accounting_project_profile.php"); ?>
<?php gdreqonce("/_controls/classes/create/match_accounting_project_to_billto.php"); ?>
<?php gdreqonce("/_controls/classes/create/match_accounting_project_to_client.php"); ?>
<?php gdreqonce("/_controls/classes/find/_project_data.php"); ?>
<?php gdreqonce("/_controls/classes/update/match_accounting_project_to_billto.php"); ?>
<?php gdreqonce("/_controls/classes/update/match_accounting_project_to_client.php"); ?>
<?php gdreqonce("/_controls/classes/timesheet.php"); ?>
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
class gdProjectData
    extends zAppBaseObject
{
    function __construct()
    {
    }
    
    /*
     * This Method is used when Creating
     * User Account and User Profile and Matching.
     * This account will be inactive.
     * the Task Control Unique QS will be generated.
     * You may access using the getTaskCountrolQS method
     */
    function createNewProjectAccount($account_billto_uid
                                    , $account_client_uid
                                    , $sdesc
                                    , $ldesc
                                    , $contactname
                                    , $contactemail
                                    , $contactnumber
                                    , $address
                                    , $cfg_country_sdesc
                                    , $cfg_region_sdesc
                                    , $city
                                    , $cfg_payoutcycle_sdesc
                                    , $rate_hourly
                                    , $start_date
                                    , $end_date)
    {
        $this->gdlog()->LogInfoStartFUNCTION("createNewProjectAccount");
        $fr = "UNKNOWN_ERROR";
        $this->cleanAllOutputData();
        
        $gdfab = new gdFindAccountingProject();
        $fr = $gdfab->findAcountingProject_bySdesc($sdesc);
        if($fr == "RECORD_IS_NOT_FOUND")
        {
            $gdcap = new gdCreateAccountingProject();
            $fr = $gdcap->createRecordProjectAccount($sdesc
                                                    , $ldesc
                                                    , $contactname
                                                    , $contactemail
                                                    , $contactnumber
                                                    , $address
                                                    , $cfg_country_sdesc
                                                    , $cfg_region_sdesc
                                                    , $city);

            $gdcapp = new gdCreateAccountingProjectProfile();
            $gdcapp->createRecordProjectProfile($gdcap->getUid()
                                                , $cfg_payoutcycle_sdesc
                                                , $rate_hourly
                                                , $start_date
                                                , $end_date);
        
            $gdcampb = new gdCreateAccountingMatchProjecttoBillto();
            $gdcampb->createRecordMatchAccount($gdcap->getUid(), $account_billto_uid);
                                                    
            $gdcampb = new gdCreateAccountingMatchProjecttoClient();
            $gdcampb->createRecordMatchAccount($gdcap->getUid(), $account_client_uid);
            
            $gdtd = new gdTimesheetData();
            $gdtd->createNewTimesheetAccount($gdcap->getUid()
                                            , $start_date
                                            , $end_date);
            
            
            if($fr == "RECORD_IS_CREATED")
            {
                $fr = $this->gdlog()->LogInfoRETURN("DATA_IS_CREATED");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("DATA_IS_NOT_CREATED");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoRETURN("ACCOUNT_ALREADY_EXISTS");
        }
        $this->gdlog()->LogInfoEndFUNCTION("createNewProjectAccount");
        return $fr;
    }
    
    function findProjectList()
    {
        $this->gdlog()->LogInfoStartFUNCTION("findProjectList");
        $fr = "UNKNOWN_ERROR";
        $this->cleanAllOutputData();
        
        $gdfab = new gdFindAccountingProjectData();
        $fr = $gdfab->findAcountingProjects();
        
        if($fr == "RECORDS_ARE_FOUND")
        {
            $this->setResult_Records($gdfab->getResult_Records());
            $fr = $this->gdlog()->LogInfoRETURN("RECORDS_ARE_FOUND");
        }
        else
        {
            $fr = $this->gdlog()->LogInfoRETURN("RECORDS_ARE_NOT_FOUND");
        }
        
        $this->gdlog()->LogInfoEndFUNCTION("findProjectList");
        return $fr;

    }
    
    function findProjectListFullData()
    {
        $this->gdlog()->LogInfoStartFUNCTION("findProjectListFullData");
        $fr = "UNKNOWN_ERROR";
        $this->cleanAllOutputData();
        
        $gdfab = new gdFindAccountingProjectData();
        $fr = $gdfab->findAcountingProjectsBIllTosClients();
        
        if($fr == "RECORDS_ARE_FOUND")
        {
            $this->setResult_Records($gdfab->getResult_Records());
            $fr = $this->gdlog()->LogInfoRETURN("RECORDS_ARE_FOUND");
        }
        else
        {
            $fr = $this->gdlog()->LogInfoRETURN("RECORDS_ARE_NOT_FOUND");
        }
        
        $this->gdlog()->LogInfoEndFUNCTION("findProjectListFullData");
        return $fr;

    }
    
    function findProject_byUid($uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findProject_byUid");
        $fr = "UNKNOWN_ERROR";
        $this->cleanAllOutputData();
        
        $gdfapd = new gdFindAccountingProjectData();
        $fr = $gdfapd->findAcountingProject_byUid($uid);
        if($fr == "RECORD_IS_FOUND")
        {
            $this->setResult_Record($gdfapd->getResult_Record());
            $fr = $this->gdlog()->LogInfoRETURN("RECORD_IS_FOUND");
        }
        else
        {
            $fr = $this->gdlog()->LogInfoRETURN("RECORD_IS_NOT_FOUND");
        }
        
        $this->gdlog()->LogInfoEndFUNCTION("findProject_byUid");
        return $fr;
    }
    
    function updateExistingProjectAccount($uid
                                        , $accounting_billto_uid
                                        , $accounting_client_uid
                                        , $sdesc
                                        , $ldesc
                                        , $contactname
                                        , $contactemail
                                        , $contactnumber
                                        , $address
                                        , $cfg_country_sdesc
                                        , $cfg_region_sdesc
                                        , $city
                                        , $cfg_payoutcycle_sdesc
                                        , $rate_hourly
                                        , $start_date
                                        , $end_date)
    {
        $this->gdlog()->LogInfoStartFUNCTION("updateExistingProjectAccount");
        $fr = "UNKNOWN_ERROR";
        $this->cleanAllOutputData();
        
        $gdcap = new gdUpdateAccountingProject();
        $fr = $gdcap->updateRecordProjectAccount($uid
                                                , $sdesc
                                                , $ldesc
                                                , $contactname
                                                , $contactemail
                                                , $contactnumber
                                                , $address
                                                , $cfg_country_sdesc
                                                , $cfg_region_sdesc
                                                , $city);
        
        $gdcapp = new gdUpdateAccountingProjectProfile();
        $gdcapp->updateRecordProjectProfile($uid
                                            , $cfg_payoutcycle_sdesc
                                            , $rate_hourly
                                            , $start_date
                                            , $end_date);
                                                
        $gduampb = new gdUpdateAccountingMatchProjecttoBillto();
        $gduampb->updateRecordMatchAccount_byProjectUid($uid, $accounting_billto_uid);
        
        
        $gduampc = new gdUpdateAccountingMatchProjecttoClient();
        $gduampb->updateRecordMatchAccount_byProjectUid($uid, $accounting_billto_uid);
        
        $gdtd = new gdTimesheetData();
        $gdtd->updateExistingTimesheetAccount($uid
                                            , $start_date
                                            , $end_date);

        if($fr == "RECORD_IS_UPDATED")
        {
            $fr = $this->gdlog()->LogInfoRETURN("RECORD_IS_UPDATED");
        }
        else
        {
            $fr = $this->gdlog()->LogInfoRETURN("RECORD_IS_NOT_UPDATED");
        }

        $this->gdlog()->LogInfoEndFUNCTION("updateExistingProjectAccount");
        return $fr;
    }
}
?>
    