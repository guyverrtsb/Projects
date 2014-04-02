<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class gdUpdateAccountingProjectProfile
    extends zAppBaseObject
{
    function __construct()
    {
    }
    
    function updateRecordProjectProfile($accounting_project_uid
                                        , $cfg_payoutcycle_sdesc
                                        , $rate_hourly
                                        , $start_date
                                        , $end_date)
    {
        $this->gdlog()->LogInfoStartFUNCTION("updateRecordProjectProfile");
        $this->cleanResult_Record();
        $sqlstmnt = "UPDATE accounting_project_profile SET ".
            "changeddt=NOW(), ".
            "cfg_payoutcycle_sdesc=:cfg_payoutcycle_sdesc, ".
            "rate_hourly=:rate_hourly, ".
            "start_date=:start_date, ".
            "end_date=:end_date ".
            "WHERE accounting_project_uid=:accounting_project_uid";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("APPDB");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":cfg_payoutcycle_sdesc", $cfg_payoutcycle_sdesc);
        $appcon->bindParam(":rate_hourly", $rate_hourly);
        $appcon->bindParam(":start_date", $this->getGDConfig()->getmySQLDateTimeStamp($start_date));
        $appcon->bindParam(":end_date", $this->getGDConfig()->getmySQLDateTimeStamp($end_date));
        $appcon->bindParam(":accounting_project_uid", $accounting_project_uid);
        $appcon->execUpdate();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getRowfromLastId($appcon, "accounting_project_profile", $appcon->getLastInsertID()));
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
        $this->gdlog()->LogInfoEndFUNCTION("updateRecordProjectProfile");
        return $fr;
    }
    
    function getAccountingProjectUid() { return $this->getResult_RecordField("accounting_project_uid"); }
    function getCfgPayoutcycleSdesc() { return $this->getResult_RecordField("cfg_payoutcycle_sdesc"); }
    function getRateHourly() { return $this->getResult_RecordField("rate_hourly"); }
    function getStartDate() { return $this->getResult_RecordField("start_date"); }
    function getEndDate() { return $this->getResult_RecordField("end_date"); }
}
?>