<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class gdUpdateAccountingTimesheetDates
    extends zAppBaseObject
{
    function __construct()
    {
    }
    
    function updateRecordTimesheetDates($timesheet_dates_uid
                                    , $d0_work_hours
                                    , $d1_work_hours
                                    , $d2_work_hours
                                    , $d3_work_hours
                                    , $d4_work_hours
                                    , $d5_work_hours
                                    , $d6_work_hours)
    {
        $this->gdlog()->LogInfoStartFUNCTION("updateRecordTimesheetDates");
        $this->cleanResult_Record();
        $sqlstmnt = "UPDATE accounting_timesheet_dates SET ".
            "changeddt=NOW(), ".
            "d0_work_hours=:d0_work_hours, ".
            "d1_work_hours=:d1_work_hours, ".
            "d2_work_hours=:d2_work_hours, ".
            "d3_work_hours=:d3_work_hours, ".
            "d4_work_hours=:d4_work_hours, ".
            "d5_work_hours=:d5_work_hours, ".
            "d6_work_hours=:d6_work_hours ".
            "WHERE uid=:timesheet_dates_uid";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("APPDB");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":d0_work_hours", $d0_work_hours);
        $appcon->bindParam(":d1_work_hours", $d1_work_hours);
        $appcon->bindParam(":d2_work_hours", $d2_work_hours);
        $appcon->bindParam(":d3_work_hours", $d3_work_hours);
        $appcon->bindParam(":d4_work_hours", $d4_work_hours);
        $appcon->bindParam(":d5_work_hours", $d5_work_hours);
        $appcon->bindParam(":d6_work_hours", $d6_work_hours);
        $appcon->bindParam(":timesheet_dates_uid", $timesheet_dates_uid);
        $appcon->execUpdate();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getRowfromLastId($appcon, "accounting_timesheet_dates", $appcon->getLastInsertID()));
                $this->gdlog()->LogInfoDB($this->getResult_Record());
                $fr = $this->saveActivityLog("RECORD_IS_UPDATED", "Record is Update:".json_encode($this->getResult_Record()).":");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("RECORD_IS_NOT_UPDATED");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("updateRecordTimesheetDates");
        return $fr;
    }
    
    function getUid() { return $this->getResult_RecordField("uid"); }
    function getCompanyname() { return $this->getResult_RecordField("companyname"); }
    function getContactname() { return $this->getResult_RecordField("contactname"); }
    function getContactemail() { return $this->getResult_RecordField("contactemail"); }
    function getContactnumber() { return $this->getResult_RecordField("contactnumber"); }
    function getAddress() { return $this->getResult_RecordField("address"); }
    function getCfgCountrySdesc() { return $this->getResult_RecordField("cfg_country_sdesc"); }
    function getCfgRegionSdesc() { return $this->getResult_RecordField("cfg_region_sdesc"); }
    function getCity() { return $this->getResult_RecordField("city"); }
    function getSdesc() { return $this->getResult_RecordField("sdesc"); }
}
?>