<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class gdFindPlacementRequirement
    extends zAppBaseObject
{
    function findPlacementRequirements()
    {
        $this->gdlog()->LogInfoStartFUNCTION("findPlacementRequirements");
        $sqlstmnt = "SELECT * FROM placement_requirement ".
            "ORDER BY createddt";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("APPDB");
        $appcon->setStatement($sqlstmnt);
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
        $this->gdlog()->LogInfoEndFUNCTION("findPlacementRequirements");
        return $fr;
    }

    function findPlacementRequirement_byUid($uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findPlacementRequirement_byUid");
        $sqlstmnt = "SELECT lid, uid, createddt, changeddt, ".
            "requirement_number, title, role_desc, ".
            $this->getDATE_FORMAT("start_date")." AS start_date, ".
            $this->getDATE_FORMAT("end_date")." AS end_date, ".
            "requested_days, days_per_week, is_remote_possible, ".
            "(select label FROM cfg_defaults WHERE sdesc = placement_requirement.cfg_country_sdesc) AS cfg_defaults_country, ".
            "(select label FROM cfg_defaults WHERE sdesc = placement_requirement.cfg_region_sdesc) AS cfg_defaults_region, ".
            "city, sdesc, ".
            "scope_of_tasks, company_name, comments".
            " FROM placement_requirement ".
            "WHERE uid=:uid";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("APPDB");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":uid", $uid);
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
        $this->gdlog()->LogInfoEndFUNCTION("findPlacementRequirement_byUid");
        return $fr;
    }

    function findPlacementRequirement_bySdesc($sdesc)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findPlacementRequirement_bySdesc");
        $sqlstmnt = "SELECT lid, uid, createddt, changeddt, ".
            "requirement_number, title, role_desc, ".
            $this->getDATE_FORMAT("start_date")." AS start_date, ".
            $this->getDATE_FORMAT("end_date")." AS end_date, ".
            "requested_days, days_per_week, is_remote_possible, ".
            "(select label FROM cfg_defaults WHERE sdesc = placement_requirement.cfg_country_sdesc) AS cfg_defaults_country, ".
            "(select label FROM cfg_defaults WHERE sdesc = placement_requirement.cfg_region_sdesc) AS cfg_defaults_region, ".
            "city, sdesc, ".
            "scope_of_tasks, company_name, comments".
            " FROM placement_requirement ".
            "WHERE sdesc=:sdesc";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("APPDB");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":sdesc", $sdesc);
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
        $this->gdlog()->LogInfoEndFUNCTION("findPlacementRequirement_bySdesc");
        return $fr;
    }
    
    function countPlacementRequirements()
    {
        $this->gdlog()->LogInfoStartFUNCTION("countPlacementRequirements");
        $sqlstmnt = "SELECT COUNT(uid) AS record_count FROM placement_requirement";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("APPDB");
        $appcon->setStatement($sqlstmnt);
        $appcon->execSelect();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getStatement()->fetch(PDO::FETCH_ASSOC));
                $this->gdlog()->LogInfoDB($this->getResult_Record());
                $fr = $this->saveActivityLog("RECORDS_ARE_FOUND", "Records are found:".json_encode($this->getResult_Record()).":");
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
        $this->gdlog()->LogInfoEndFUNCTION("countPlacementRequirements");
        return $fr;
    }
    
    function getRecordCount() { return $this->getResult_RecordField("record_count"); }
    function getUid() { return $this->getResult_RecordField("uid"); }
    function getCreateddt() { return $this->getResult_RecordField("createddt"); }
    function getTitle() { return $this->getResult_RecordField("title"); }
    function getRoledesc() { return $this->getResult_RecordField("role_desc"); }
    function getStartdate() { return $this->getResult_RecordField("start_date"); }
    function getEnddate() { return $this->getResult_RecordField("end_date"); }
    function getRequesteddays() { return $this->getResult_RecordField("requested_days"); }
    function getDaysperweek() { return $this->getResult_RecordField("days_per_week"); }
    function getIsremotepossible() { return $this->getResult_RecordField("is_remote_possible"); }
    function getCompanyname() { return $this->getResult_RecordField("company_name"); }
    function getCfgCountrySdesc() { return $this->getResult_RecordField("cfg_country_sdesc"); }
    function getCfgRegionSdesc() { return $this->getResult_RecordField("cfg_region_sdesc"); }
    function getCity() { return $this->getResult_RecordField("city"); }
    function getScopoftasks() { return $this->getResult_RecordField("scope_of_tasks"); }
    function getRequirementnumber() { return $this->getResult_RecordField("requirement_number"); }
    function getComments() { return $this->getResult_RecordField("comments"); }
    function getSdesc() { return $this->getResult_RecordField("sdesc"); }
}?>
        
    