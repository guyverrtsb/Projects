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
<?php gdreqonce("/_controls/classes/create/accounting_timesheet.php"); ?>
<?php gdreqonce("/_controls/classes/create/accounting_timesheet_dates.php"); ?>
<?php gdreqonce("/_controls/classes/find/_project_data.php"); ?>
<?php gdreqonce("/_controls/classes/find/_timesheet_data.php"); ?>
<?php gdreqonce("/_controls/classes/update/accounting_timesheet_dates.php"); ?>
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
class gdTimesheetData
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
    function createNewTimesheetAccount($project_account_uid
                                    , $start_date
                                    , $end_date)
    {
        $this->gdlog()->LogInfoStartFUNCTION("createNewTimesheetAccount");
        $fr = "UNKNOWN_ERROR";
        $this->cleanAllOutputData();
        
        $gdcat = new gdCreateAccountingTimesheet();
        $fr = $gdcat->createRecordTimesheet($project_account_uid
                                            , "sdesc"
                                            , "ldesc");
                                            
        $gdfapd = new gdFindAccountingProjectData();
        $gdfapd->findAcountingProject_byUid($project_account_uid);
        $timesheetnumberprefix = $gdfapd->getTimesheetprefixnumber();
        $cfg_ratetype_sdesc = $gdfapd->getCfgRatetypeSdesc();


        $srtloopdate;
        $srtprojdate = $this->getGDConfig()->gdDateTime($start_date);
        $endprojdate = $this->getGDConfig()->gdDateTime($end_date);
        $endloopdate;
        
        if($srtprojdate->format("w") == 0)
            $srtloopdate = $srtprojdate;
        else
            $srtloopdate = $this->getGDConfig()->gdDateTime(date("Y-m-d h:i:s", strtotime("-".$srtprojdate->format("w")." day", $srtprojdate->getTimestamp())));
        $endloopdate = $this->getGDConfig()->gdDateTime(date("Y-m-d h:i:s", strtotime("+".(6 - ($endprojdate->format("w")))." day", $endprojdate->getTimestamp())));

        $this->gdlog()->LogInfoMSGshaggy("start loop{".$srtloopdate->format("Y-m-d H:i:s")."}{".$srtloopdate->format("w")."}}{}");
        $this->gdlog()->LogInfoMSGshaggy("start proj{".$srtprojdate->format("Y-m-d H:i:s")."}{".$srtprojdate->format("w")."}}{}");
        $this->gdlog()->LogInfoMSGshaggy("end projec{".$endprojdate->format("Y-m-d H:i:s")."}{".$endprojdate->format("w")."}}{}");
        $this->gdlog()->LogInfoMSGshaggy("end   loop{".$endloopdate->format("Y-m-d H:i:s")."}{".$endloopdate->format("w")."}}{".(6 - ($endprojdate->format("w")))."}");
        
        $crtdate = $srtloopdate;
        $counter = 0;
        $timesheetcounter = 0;
        $funcargs = array();
        $gdcatd = new gdCreateAccountingTimesheetDates();
        while($crtdate->getTimestamp() <= $endloopdate->getTimestamp() && $counter <= 730)
        {
            if($crtdate->getTimestamp() >= $srtprojdate->getTimestamp()
                && $crtdate->getTimestamp() <= $endprojdate->getTimestamp())
            {
                $this->gdlog()->LogInfoMSGshaggy("current date{".$crtdate->format("Y-m-d H:i:s")."}{".$crtdate->format("w")."}}{ACCOUNTING_WORKDAYSTATUS_PENDING}");
                $funcargs["d".$crtdate->format("w")."_cfg_workdaystatus_sdesc"] = "ACCOUNTING_WORKDAYSTATUS_PENDING";
            }
            else
            {
                $this->gdlog()->LogInfoMSGshaggy("current date{".$crtdate->format("Y-m-d H:i:s")."}{".$crtdate->format("w")."}}{ACCOUNTING_WORKDAYSTATUS_NOTPROJECTDAY}");
                $funcargs["d".$crtdate->format("w")."_cfg_workdaystatus_sdesc"] = "ACCOUNTING_WORKDAYSTATUS_NOTPROJECTDAY";
            }
            $funcargs["d".$crtdate->format("w")."_work_date"] = $crtdate->format("Y-m-d H:i:s");
            $funcargs["d".$crtdate->format("w")."_work_day_idx"] = $crtdate->format("w");
            $funcargs["d".$crtdate->format("w")."_work_hours"] = "0";
            $funcargs["d".$crtdate->format("w")."_ldesc"] = "";
            
            if($crtdate->format("w") == 6)
            {
                $timesheet_number = $timesheetnumberprefix."-".(1 + $timesheetcounter);
                $gdcatd->createRecordTimesheetDates($gdcat->getUid()
                                                , $crtdate->format("W")
                                                , $timesheet_number
                                                , "ACCOUNTING_WORKWEEKSTATUS_NEW"
                                                , $funcargs["d0_work_date"]
                                                , $funcargs["d0_work_day_idx"]
                                                , $funcargs["d0_work_hours"]
                                                , $funcargs["d0_cfg_workdaystatus_sdesc"]
                                                , $funcargs["d0_ldesc"]
                                                , $cfg_ratetype_sdesc
                                                , $funcargs["d1_work_date"]
                                                , $funcargs["d1_work_day_idx"]
                                                , $funcargs["d1_work_hours"]
                                                , $funcargs["d1_cfg_workdaystatus_sdesc"]
                                                , $funcargs["d1_ldesc"]
                                                , $cfg_ratetype_sdesc
                                                , $funcargs["d2_work_date"]
                                                , $funcargs["d2_work_day_idx"]
                                                , $funcargs["d2_work_hours"]
                                                , $funcargs["d2_cfg_workdaystatus_sdesc"]
                                                , $funcargs["d2_ldesc"]
                                                , $cfg_ratetype_sdesc
                                                , $funcargs["d3_work_date"]
                                                , $funcargs["d3_work_day_idx"]
                                                , $funcargs["d3_work_hours"]
                                                , $funcargs["d3_cfg_workdaystatus_sdesc"]
                                                , $funcargs["d3_ldesc"]
                                                , $cfg_ratetype_sdesc
                                                , $funcargs["d4_work_date"]
                                                , $funcargs["d4_work_day_idx"]
                                                , $funcargs["d4_work_hours"]
                                                , $funcargs["d4_cfg_workdaystatus_sdesc"]
                                                , $funcargs["d4_ldesc"]
                                                , $cfg_ratetype_sdesc
                                                , $funcargs["d5_work_date"]
                                                , $funcargs["d5_work_day_idx"]
                                                , $funcargs["d5_work_hours"]
                                                , $funcargs["d5_cfg_workdaystatus_sdesc"]
                                                , $funcargs["d5_ldesc"]
                                                , $cfg_ratetype_sdesc
                                                , $funcargs["d6_work_date"]
                                                , $funcargs["d6_work_day_idx"]
                                                , $funcargs["d6_work_hours"]
                                                , $funcargs["d6_cfg_workdaystatus_sdesc"]
                                                , $funcargs["d6_ldesc"]
                                                , $cfg_ratetype_sdesc);
                $timesheetcounter++;
            }

            $crtdate = $this->getGDConfig()->gdDateTime(date("Y-m-d h:i:s", strtotime("+1 day", $crtdate->getTimestamp())));
            $counter++;
        }
        $this->gdlog()->LogInfoEndFUNCTION("createNewTimesheetAccount");
        return $fr;
    }
    
    function findTimesheetListforProject($accounting_project_uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findTimesheetListforProject");
        $fr = "UNKNOWN_ERROR";
        $this->cleanAllOutputData();
        
        $gdfatd = new gdFindAccountingTimesheetData();
        $fr = $gdfatd->findAcountingTimesheetData_byProject($accounting_project_uid);
        
        if($fr == "RECORDS_ARE_FOUND")
        {
            $this->setResult_Records($gdfatd->getResult_Records());
            $fr = $this->gdlog()->LogInfoRETURN("RECORDS_ARE_FOUND");
        }
        else
        {
            $fr = $this->gdlog()->LogInfoRETURN("RECORDS_ARE_NOT_FOUND");
        }
        
        $this->gdlog()->LogInfoEndFUNCTION("findTimesheetListforProject");
        return $fr;

    }
    
    function findTimesheetDates_byUid($accounting_timesheet_dates_uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findTimesheetDates_byUid");
        $fr = "UNKNOWN_ERROR";
        $this->cleanAllOutputData();
        
        $gdfatd = new gdFindAccountingTimesheetData();
        $fr = $gdfatd->findAcountingTimesheetData_byUid($accounting_timesheet_dates_uid);
        
        if($fr == "RECORD_IS_FOUND")
        {
            $this->setResult_Record($gdfatd->getResult_Record());
            $fr = $this->gdlog()->LogInfoRETURN("RECORD_IS_FOUND");
        }
        else
        {
            $fr = $this->gdlog()->LogInfoRETURN("RECORD_IS_NOT_FOUND");
        }
        
        $this->gdlog()->LogInfoEndFUNCTION("findTimesheetDates_byUid");
        return $fr;

    }
    
    function findTimesheet_byProject($uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findProject_byUid");
        $fr = "UNKNOWN_ERROR";
        $this->cleanAllOutputData();


        
        $this->gdlog()->LogInfoEndFUNCTION("findProject_byUid");
        return $fr;
    }
    
    function updateExistingTimesheetDates($timesheet_dates_uid
                                        , $d0_work_hours
                                        , $d1_work_hours
                                        , $d2_work_hours
                                        , $d3_work_hours
                                        , $d4_work_hours
                                        , $d5_work_hours
                                        , $d6_work_hours
                                        , $d0_cfg_ratetype_sdesc
                                        , $d1_cfg_ratetype_sdesc
                                        , $d2_cfg_ratetype_sdesc
                                        , $d3_cfg_ratetype_sdesc
                                        , $d4_cfg_ratetype_sdesc
                                        , $d5_cfg_ratetype_sdesc
                                        , $d6_cfg_ratetype_sdesc)
    {
        $this->gdlog()->LogInfoStartFUNCTION("updateExistingTimesheetDates");
        $fr = "UNKNOWN_ERROR";
        $this->cleanAllOutputData();
        
        $gduatd = new gdUpdateAccountingTimesheetDates();
        $fr = $gduatd->updateRecordTimesheetDates($timesheet_dates_uid
                                                , $d0_work_hours
                                                , $d1_work_hours
                                                , $d2_work_hours
                                                , $d3_work_hours
                                                , $d4_work_hours
                                                , $d5_work_hours
                                                , $d6_work_hours
                                                , $d0_cfg_ratetype_sdesc
                                                , $d1_cfg_ratetype_sdesc
                                                , $d2_cfg_ratetype_sdesc
                                                , $d3_cfg_ratetype_sdesc
                                                , $d4_cfg_ratetype_sdesc
                                                , $d5_cfg_ratetype_sdesc
                                                , $d6_cfg_ratetype_sdesc);

        if($fr == "RECORD_IS_UPDATED")
        {
            $fr = $this->gdlog()->LogInfoRETURN("RECORD_IS_UPDATED");
        }
        else
        {
            $fr = $this->gdlog()->LogInfoRETURN("RECORD_IS_NOT_UPDATED");
        }
                        
        $this->gdlog()->LogInfoEndFUNCTION("updateExistingTimesheetDates");
        return $fr;
    }
    
    private function loadTimeSheet($type
                                , $start_date
                                , $end_date)
    {
        $this->gdlog()->LogInfoStartFUNCTION("loadTimeSheet");

        $this->gdlog()->LogInfoEndFUNCTION("loadTimeSheet");
    }
}
?>
    