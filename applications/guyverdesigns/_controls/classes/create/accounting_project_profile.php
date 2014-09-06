<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class gdCreateAccountingProjectProfile
    extends zAppBaseObject
{
    function __construct()
    {
    }
    
    function createRecordProjectProfile($accounting_project_uid
                                        , $cfg_payoutcycle_sdesc
                                        , $cfg_ratetype_sdesc
                                        , $rate_hourly_onsite
                                        , $rate_hourly_remote
                                        , $start_date
                                        , $end_date)
    {
        $this->gdlog()->LogInfoStartFUNCTION("createRecordClientAccount");
        $sqlstmnt = "INSERT INTO accounting_project_profile SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "accounting_project_uid=:accounting_project_uid, ".
            "cfg_payoutcycle_sdesc=:cfg_payoutcycle_sdesc, ".
            "cfg_ratetype_sdesc=:cfg_ratetype_sdesc, ".
            "rate_hourly_onsite=:rate_hourly_onsite, ".
            "rate_hourly_remote=:rate_hourly_remote, ".
            "start_date=:start_date, ".
            "end_date=:end_date";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("APPDB");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":accounting_project_uid", $accounting_project_uid);
        $appcon->bindParam(":cfg_payoutcycle_sdesc", $cfg_payoutcycle_sdesc);
        $appcon->bindParam(":cfg_ratetype_sdesc", $cfg_ratetype_sdesc);
        $appcon->bindParam(":rate_hourly_onsite", $rate_hourly_onsite);
        $appcon->bindParam(":rate_hourly_remote", $rate_hourly_remote);
        $appcon->bindParamDateTime(":start_date", $start_date);
        $appcon->bindParamDateTime(":end_date", $end_date);
        $appcon->execUpdate();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getRowfromLastId($appcon, "accounting_project_profile", $appcon->getLastInsertID()));
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
        $this->gdlog()->LogInfoEndFUNCTION("createRecordClientAccount");
        return $fr;
    }
    
    function getAccountingProjectUid() { return $this->getResult_RecordField("accounting_project_uid"); }
    function getCfgPayoutcycleSdesc() { return $this->getResult_RecordField("cfg_payoutcycle_sdesc"); }
    function getCfgRatetypeSdesc() { return $this->getResult_RecordField("cfg_ratetype_sdesc"); }
    function getOnsiteRateHourly() { return $this->getResult_RecordField("rate_hourly_onsite"); }
    function getRemoteRateHourly() { return $this->getResult_RecordField("rate_hourly_remote"); }
    function getStartDate() { return $this->getResult_RecordField("start_date"); }
    function getEndDate() { return $this->getResult_RecordField("end_date"); }
}
?>