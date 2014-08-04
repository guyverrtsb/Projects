<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class gdCreateAccountingTimesheetDates
    extends zAppBaseObject
{
    function __construct()
    {
    }
    
    function createRecordTimesheetDates($accounting_timesheet_uid
                                        , $week_number
                                        , $timesheet_number
                                        , $cfg_workweekstatus_sdesc
                                        , $d0_work_date
                                        , $d0_work_day_idx
                                        , $d0_work_hours
                                        , $d0_cfg_workdaystatus_sdesc
                                        , $d0_ldesc
                                        , $d0_cfg_ratetype_sdesc
                                        , $d1_work_date
                                        , $d1_work_day_idx
                                        , $d1_work_hours
                                        , $d1_cfg_workdaystatus_sdesc
                                        , $d1_ldesc
                                        , $d1_cfg_ratetype_sdesc
                                        , $d2_work_date
                                        , $d2_work_day_idx
                                        , $d2_work_hours
                                        , $d2_cfg_workdaystatus_sdesc
                                        , $d2_ldesc
                                        , $d2_cfg_ratetype_sdesc
                                        , $d3_work_date
                                        , $d3_work_day_idx
                                        , $d3_work_hours
                                        , $d3_cfg_workdaystatus_sdesc
                                        , $d3_ldesc
                                        , $d3_cfg_ratetype_sdesc
                                        , $d4_work_date
                                        , $d4_work_day_idx
                                        , $d4_work_hours
                                        , $d4_cfg_workdaystatus_sdesc
                                        , $d4_ldesc
                                        , $d4_cfg_ratetype_sdesc
                                        , $d5_work_date
                                        , $d5_work_day_idx
                                        , $d5_work_hours
                                        , $d5_cfg_workdaystatus_sdesc
                                        , $d5_ldesc
                                        , $d5_cfg_ratetype_sdesc
                                        , $d6_work_date
                                        , $d6_work_day_idx
                                        , $d6_work_hours
                                        , $d6_cfg_workdaystatus_sdesc
                                        , $d6_ldesc
                                        , $d6_cfg_ratetype_sdesc)
    {
        $this->gdlog()->LogInfoStartFUNCTION("createRecordTimesheetDates");
        $this->cleanResult_Record();
        $sqlstmnt = "INSERT INTO accounting_timesheet_dates SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "accounting_timesheet_uid=:accounting_timesheet_uid, ".
            "week_number=:week_number, ".
            "timesheet_number=:timesheet_number, ".
            "cfg_workweekstatus_sdesc=:cfg_workweekstatus_sdesc, ".
            
            "d0_work_date=:d0_work_date, ".
            "d0_work_day_idx=:d0_work_day_idx, ".
            "d0_work_hours=:d0_work_hours, ".
            "d0_cfg_workdaystatus_sdesc=:d0_cfg_workdaystatus_sdesc, ".
            "d0_ldesc=:d0_ldesc, ".
            "d0_cfg_ratetype_sdesc=:d0_cfg_ratetype_sdesc, ".
            
            "d1_work_date=:d1_work_date, ".
            "d1_work_day_idx=:d1_work_day_idx, ".
            "d1_work_hours=:d1_work_hours, ".
            "d1_cfg_workdaystatus_sdesc=:d1_cfg_workdaystatus_sdesc, ".
            "d1_ldesc=:d1_ldesc, ".
            "d1_cfg_ratetype_sdesc=:d1_cfg_ratetype_sdesc, ".
            
            "d2_work_date=:d2_work_date, ".
            "d2_work_day_idx=:d2_work_day_idx, ".
            "d2_work_hours=:d2_work_hours, ".
            "d2_cfg_workdaystatus_sdesc=:d2_cfg_workdaystatus_sdesc, ".
            "d2_ldesc=:d2_ldesc, ".
            "d2_cfg_ratetype_sdesc=:d2_cfg_ratetype_sdesc, ".
            
            "d3_work_date=:d3_work_date, ".
            "d3_work_day_idx=:d3_work_day_idx, ".
            "d3_work_hours=:d3_work_hours, ".
            "d3_cfg_workdaystatus_sdesc=:d3_cfg_workdaystatus_sdesc, ".
            "d3_ldesc=:d3_ldesc, ".
            "d3_cfg_ratetype_sdesc=:d3_cfg_ratetype_sdesc, ".
            
            "d4_work_date=:d4_work_date, ".
            "d4_work_day_idx=:d4_work_day_idx, ".
            "d4_work_hours=:d4_work_hours, ".
            "d4_cfg_workdaystatus_sdesc=:d4_cfg_workdaystatus_sdesc, ".
            "d4_ldesc=:d4_ldesc, ".
            "d4_cfg_ratetype_sdesc=:d4_cfg_ratetype_sdesc, ".
            
            "d5_work_date=:d5_work_date, ".
            "d5_work_day_idx=:d5_work_day_idx, ".
            "d5_work_hours=:d5_work_hours, ".
            "d5_cfg_workdaystatus_sdesc=:d5_cfg_workdaystatus_sdesc, ".
            "d5_ldesc=:d5_ldesc, ".
            "d5_cfg_ratetype_sdesc=:d5_cfg_ratetype_sdesc, ".
            
            "d6_work_date=:d6_work_date, ".
            "d6_work_day_idx=:d6_work_day_idx, ".
            "d6_work_hours=:d6_work_hours, ".
            "d6_cfg_workdaystatus_sdesc=:d6_cfg_workdaystatus_sdesc, ".
            "d6_ldesc=:d6_ldesc, ".
            "d6_cfg_ratetype_sdesc=:d6_cfg_ratetype_sdesc";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("APPDB");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":accounting_timesheet_uid", $accounting_timesheet_uid);
        $appcon->bindParam(":week_number", $week_number);
        $appcon->bindParam(":timesheet_number", $timesheet_number);
        $appcon->bindParam(":cfg_workweekstatus_sdesc", $cfg_workweekstatus_sdesc);
        
        $appcon->bindParam(":d0_work_date", $d0_work_date);
        $appcon->bindParam(":d0_work_day_idx", $d0_work_day_idx);
        $appcon->bindParam(":d0_work_hours", $d0_work_hours);
        $appcon->bindParam(":d0_cfg_workdaystatus_sdesc", $d0_cfg_workdaystatus_sdesc);
        $appcon->bindParam(":d0_ldesc", $d0_ldesc);
        $appcon->bindParam(":d0_cfg_ratetype_sdesc", $d0_cfg_ratetype_sdesc);
                
        $appcon->bindParam(":d1_work_date", $d1_work_date);
        $appcon->bindParam(":d1_work_day_idx", $d1_work_day_idx);
        $appcon->bindParam(":d1_work_hours", $d1_work_hours);
        $appcon->bindParam(":d1_cfg_workdaystatus_sdesc", $d1_cfg_workdaystatus_sdesc);
        $appcon->bindParam(":d1_ldesc", $d1_ldesc);
        $appcon->bindParam(":d1_cfg_ratetype_sdesc", $d1_cfg_ratetype_sdesc);
        
        $appcon->bindParam(":d2_work_date", $d2_work_date);
        $appcon->bindParam(":d2_work_day_idx", $d2_work_day_idx);
        $appcon->bindParam(":d2_work_hours", $d2_work_hours);
        $appcon->bindParam(":d2_cfg_workdaystatus_sdesc", $d2_cfg_workdaystatus_sdesc);
        $appcon->bindParam(":d2_ldesc", $d2_ldesc);
        $appcon->bindParam(":d2_cfg_ratetype_sdesc", $d2_cfg_ratetype_sdesc);
                
        $appcon->bindParam(":d3_work_date", $d3_work_date);
        $appcon->bindParam(":d3_work_day_idx", $d3_work_day_idx);
        $appcon->bindParam(":d3_work_hours", $d3_work_hours);
        $appcon->bindParam(":d3_cfg_workdaystatus_sdesc", $d3_cfg_workdaystatus_sdesc);
        $appcon->bindParam(":d3_ldesc", $d3_ldesc);
        $appcon->bindParam(":d3_cfg_ratetype_sdesc", $d3_cfg_ratetype_sdesc);
        
        $appcon->bindParam(":d4_work_date", $d4_work_date);
        $appcon->bindParam(":d4_work_day_idx", $d4_work_day_idx);
        $appcon->bindParam(":d4_work_hours", $d4_work_hours);
        $appcon->bindParam(":d4_cfg_workdaystatus_sdesc", $d4_cfg_workdaystatus_sdesc);
        $appcon->bindParam(":d4_ldesc", $d4_ldesc);
        $appcon->bindParam(":d4_cfg_ratetype_sdesc", $d4_cfg_ratetype_sdesc);
        
        $appcon->bindParam(":d5_work_date", $d5_work_date);
        $appcon->bindParam(":d5_work_day_idx", $d5_work_day_idx);
        $appcon->bindParam(":d5_work_hours", $d5_work_hours);
        $appcon->bindParam(":d5_cfg_workdaystatus_sdesc", $d5_cfg_workdaystatus_sdesc);
        $appcon->bindParam(":d5_ldesc", $d5_ldesc);
        $appcon->bindParam(":d5_cfg_ratetype_sdesc", $d5_cfg_ratetype_sdesc);
        
        $appcon->bindParam(":d6_work_date", $d6_work_date);
        $appcon->bindParam(":d6_work_day_idx", $d6_work_day_idx);
        $appcon->bindParam(":d6_work_hours", $d6_work_hours);
        $appcon->bindParam(":d6_cfg_workdaystatus_sdesc", $d6_cfg_workdaystatus_sdesc);
        $appcon->bindParam(":d6_ldesc", $d6_ldesc);
        $appcon->bindParam(":d6_cfg_ratetype_sdesc", $d6_cfg_ratetype_sdesc);

        $appcon->execUpdate();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getRowfromLastId($appcon, "accounting_timesheet_dates", $appcon->getLastInsertID()));
                $this->gdlog()->LogInfoDB($this->getResult_Record());
                $fr = $this->saveActivityLog("RECORD_IS_CREATED", "Record is Created:".json_encode($this->getResult_Record()).":");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("RECORD_IS_NOT_CREATED");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("createRecordTimesheetDates");
        return $fr;
    }
}
?>