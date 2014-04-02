<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class gdFindAccountingTimesheetData
    extends zAppBaseObject
{
    function __construct()
    {
    }

    function findAcountingTimesheetData_byProject($accounting_project_uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findAcountingTimesheetData_byProject");
        $this->cleanResult_Records();
        $sqlstmnt = "SELECT ".
        
        $this->dbfas("accounting_timesheet_dates.uid".
                    ", accounting_timesheet_dates.changeddt".
                    ", accounting_timesheet_dates.accounting_timesheet_uid".
                    ", accounting_timesheet_dates.cfg_workweekstatus_sdesc".
                    ", accounting_timesheet_dates.week_number".
                    ", accounting_timesheet_dates.d0_work_day_idx".
                    ", accounting_timesheet_dates.d6_work_day_idx".
                    ", accounting_timesheet_dates.d0_work_hours".
                    ", accounting_timesheet_dates.d1_work_hours".
                    ", accounting_timesheet_dates.d2_work_hours".
                    ", accounting_timesheet_dates.d3_work_hours".
                    ", accounting_timesheet_dates.d4_work_hours".
                    ", accounting_timesheet_dates.d5_work_hours".
                    ", accounting_timesheet_dates.d6_work_hours".
                    ", accounting_timesheet_dates.d0_cfg_workdaystatus_sdesc".
                    ", accounting_timesheet_dates.d6_cfg_workdaystatus_sdesc".
                    ", accounting_timesheet_dates.d0_ldesc".
                    ", accounting_timesheet_dates.d6_ldesc".
                    ", accounting_project.sdesc".
                    ", accounting_project.ldesc".
                    ", accounting_project_profile.rate_hourly".
                    ", accounting_project_profile.start_date".
                    ", accounting_project_profile.end_date".
                    ", cfg_defaults.label")." ".

            ", ".$this->getDATE_FORMAT("accounting_timesheet_dates.d0_work_date")." AS accounting_timesheet_dates_d0_work_date ".
            ", ".$this->getDATE_FORMAT("accounting_timesheet_dates.d6_work_date")." AS accounting_timesheet_dates_d6_work_date ".

            "FROM accounting_timesheet_dates ".
            
            "JOIN accounting_timesheet ".
            " ON accounting_timesheet.uid = accounting_timesheet_dates.accounting_timesheet_uid ".
            
            "JOIN accounting_project ".
            " ON accounting_project.uid = accounting_timesheet.accounting_project_uid ".
            "JOIN accounting_project_profile ".
            " ON accounting_project_profile.accounting_project_uid = accounting_project.uid ".
            
            "JOIN cfg_defaults ".
            " ON cfg_defaults.sdesc = accounting_project_profile.cfg_payoutcycle_sdesc ".
            
            "WHERE accounting_project.uid=:accounting_project_uid ".
            "ORDER BY accounting_timesheet_dates.d0_work_date ASC";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("APPDB");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":accounting_project_uid", $accounting_project_uid);
        $appcon->execSelect();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Records($appcon->getStatement()->fetchAll(PDO::FETCH_ASSOC));
                $this->gdlog()->LogInfoDB($this->getResult_Records());
                $fr = $this->saveActivityLog("RECORDS_ARE_FOUND", "Records are found:".json_encode($this->getResult_Records()).":");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("RECORDS_ARE_NOT_FOUND");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("findAcountingTimesheetData_byProject");
        return $fr;
    }

    function findAcountingTimesheetData_byUid($accounting_timesheet_dates_uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findAcountingTimesheetData_byUid");
        $this->cleanResult_Records();
        $sqlstmnt = "SELECT ".
        
        $this->dbfas("accounting_timesheet_dates.uid".
                    ", accounting_timesheet_dates.changeddt".
                    ", accounting_timesheet_dates.accounting_timesheet_uid".
                    ", accounting_timesheet_dates.cfg_workweekstatus_sdesc".
                    ", accounting_timesheet_dates.week_number".
                    ", accounting_timesheet_dates.d0_work_day_idx".
                    ", accounting_timesheet_dates.d1_work_day_idx".
                    ", accounting_timesheet_dates.d2_work_day_idx".
                    ", accounting_timesheet_dates.d3_work_day_idx".
                    ", accounting_timesheet_dates.d4_work_day_idx".
                    ", accounting_timesheet_dates.d5_work_day_idx".
                    ", accounting_timesheet_dates.d6_work_day_idx".
                    ", accounting_timesheet_dates.d0_work_hours".
                    ", accounting_timesheet_dates.d1_work_hours".
                    ", accounting_timesheet_dates.d2_work_hours".
                    ", accounting_timesheet_dates.d3_work_hours".
                    ", accounting_timesheet_dates.d4_work_hours".
                    ", accounting_timesheet_dates.d5_work_hours".
                    ", accounting_timesheet_dates.d6_work_hours".
                    ", accounting_timesheet_dates.d0_cfg_workdaystatus_sdesc".
                    ", accounting_timesheet_dates.d1_cfg_workdaystatus_sdesc".
                    ", accounting_timesheet_dates.d2_cfg_workdaystatus_sdesc".
                    ", accounting_timesheet_dates.d3_cfg_workdaystatus_sdesc".
                    ", accounting_timesheet_dates.d4_cfg_workdaystatus_sdesc".
                    ", accounting_timesheet_dates.d5_cfg_workdaystatus_sdesc".
                    ", accounting_timesheet_dates.d6_cfg_workdaystatus_sdesc".
                    ", accounting_timesheet_dates.d0_ldesc".
                    ", accounting_timesheet_dates.d0_ldesc".
                    ", accounting_timesheet_dates.d1_ldesc".
                    ", accounting_timesheet_dates.d2_ldesc".
                    ", accounting_timesheet_dates.d3_ldesc".
                    ", accounting_timesheet_dates.d4_ldesc".
                    ", accounting_timesheet_dates.d5_ldesc".
                    ", accounting_timesheet_dates.d6_ldesc".
                    ", accounting_project.ldesc".
                    ", accounting_project_profile.rate_hourly".
                    ", accounting_project_profile.start_date".
                    ", accounting_project_profile.end_date".
                    ", cfg_defaults.label")." ".

            ", ".$this->getDATE_FORMAT("accounting_timesheet_dates.d0_work_date")." AS accounting_timesheet_dates_d0_work_date ".
            ", ".$this->getDATE_FORMAT("accounting_timesheet_dates.d1_work_date")." AS accounting_timesheet_dates_d1_work_date ".
            ", ".$this->getDATE_FORMAT("accounting_timesheet_dates.d2_work_date")." AS accounting_timesheet_dates_d2_work_date ".
            ", ".$this->getDATE_FORMAT("accounting_timesheet_dates.d3_work_date")." AS accounting_timesheet_dates_d3_work_date ".
            ", ".$this->getDATE_FORMAT("accounting_timesheet_dates.d4_work_date")." AS accounting_timesheet_dates_d4_work_date ".
            ", ".$this->getDATE_FORMAT("accounting_timesheet_dates.d5_work_date")." AS accounting_timesheet_dates_d5_work_date ".
            ", ".$this->getDATE_FORMAT("accounting_timesheet_dates.d6_work_date")." AS accounting_timesheet_dates_d6_work_date ".

            ", ".$this->getDAY_FORMAT("accounting_timesheet_dates.d0_work_date")." AS accounting_timesheet_dates_d0_work_day ".
            ", ".$this->getDAY_FORMAT("accounting_timesheet_dates.d1_work_date")." AS accounting_timesheet_dates_d1_work_day ".
            ", ".$this->getDAY_FORMAT("accounting_timesheet_dates.d2_work_date")." AS accounting_timesheet_dates_d2_work_day ".
            ", ".$this->getDAY_FORMAT("accounting_timesheet_dates.d3_work_date")." AS accounting_timesheet_dates_d3_work_day ".
            ", ".$this->getDAY_FORMAT("accounting_timesheet_dates.d4_work_date")." AS accounting_timesheet_dates_d4_work_day ".
            ", ".$this->getDAY_FORMAT("accounting_timesheet_dates.d5_work_date")." AS accounting_timesheet_dates_d5_work_day ".
            ", ".$this->getDAY_FORMAT("accounting_timesheet_dates.d6_work_date")." AS accounting_timesheet_dates_d6_work_day ".

            "FROM accounting_timesheet_dates ".
            
            "JOIN accounting_timesheet ".
            " ON accounting_timesheet.uid = accounting_timesheet_dates.accounting_timesheet_uid ".
            
            "JOIN accounting_project ".
            " ON accounting_project.uid = accounting_timesheet.accounting_project_uid ".
            "JOIN accounting_project_profile ".
            " ON accounting_project_profile.accounting_project_uid = accounting_project.uid ".
            
            "JOIN cfg_defaults ".
            " ON cfg_defaults.sdesc = accounting_project_profile.cfg_payoutcycle_sdesc ".
            
            "WHERE accounting_timesheet_dates.uid=:accounting_timesheet_dates_uid";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("APPDB");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":accounting_timesheet_dates_uid", $accounting_timesheet_dates_uid);
        $appcon->execSelect();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getStatement()->fetch(PDO::FETCH_ASSOC));
                $this->gdlog()->LogInfoDB($this->getResult_Record());
                $fr = $this->saveActivityLog("RECORD_IS_FOUND", "Record is found:".json_encode($this->getResult_Record()).":");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("RECORD_IS_NOT_FOUND");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("findAcountingTimesheetData_byUid");
        return $fr;
    }

    function countAcountingTimesheets()
    {
        $this->gdlog()->LogInfoStartFUNCTION("countAcountingBilltos");
        $this->cleanResult_Records();
        $sqlstmnt = "SELECT COUNT(record_count) FROM accounting_billto";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("APPDB");
        $appcon->setStatement($sqlstmnt);
        $appcon->execSelect();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Records($appcon->getStatement()->fetch(PDO::FETCH_ASSOC));
                $this->gdlog()->LogInfoDB($this->getResult_Records());
                $fr = $this->saveActivityLog("RECORDS_ARE_FOUND", "Records are found:".json_encode($this->getResult_Records()).":");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("RECORDS_ARE_NOT_FOUND");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("countAcountingBilltos");
        return $fr;
    }
    
    function getRecordCount() { return $this->getResult_RecordField("record_count"); }
    function getUid() { return $this->getResult_RecordField("uid"); }
    function getSdesc() { return $this->getResult_RecordField("sdesc"); }
    function getLdesc() { return $this->getResult_RecordField("ldesc"); }
    function getContactname() { return $this->getResult_RecordField("contactname"); }
    function getContactemail() { return $this->getResult_RecordField("contactemail"); }
    function getContactnumber() { return $this->getResult_RecordField("contactnumber"); }
    function getAddress() { return $this->getResult_RecordField("address"); }
    function getCfgCountrySdesc() { return $this->getResult_RecordField("cfg_country_sdesc"); }
    function getCfgRegionSdesc() { return $this->getResult_RecordField("cfg_region_sdesc"); }
    function getCity() { return $this->getResult_RecordField("city"); }
    function getCfgPayoutcycleSdesc() { return $this->getResult_RecordField("cfg_payoutcycle_sdesc"); }
    function getRateHourly() { return $this->getResult_RecordField("rate_hourly"); }
    function getStartDate() { return $this->getResult_RecordField("start_date"); }
    function getEndDate() { return $this->getResult_RecordField("end_date"); }
    function getAccountingBilltoUid() { return $this->getResult_RecordField("accounting_billto_uid"); }
    function getAccountingClientUid() { return $this->getResult_RecordField("accounting_client_uid"); }
}
?>