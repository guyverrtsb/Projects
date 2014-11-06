<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class gdCreatePlacementRequirement
    extends zAppBaseObject
{
    function __construct()
    {
    }
    
    function createRecordRequirement($title, 
                                    $role_desc,
                                    $start_date,
                                    $end_date,
                                    $requested_days,
                                    $days_per_week,
                                    $is_remote_possible,
                                    $company_name,
                                    $cfg_country_sdesc,
                                    $cfg_region_sdesc,
                                    $city,
                                    $scope_of_tasks,
                                    $requirement_number,
                                    $comments,
                                    $sdesc)
    {
        $this->gdlog()->LogInfoStartFUNCTION("createRecordRequirement");
        $sqlstmnt = "INSERT INTO placement_requirement SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "title=:title, ".
            "role_desc=:role_desc, ".
            "start_date=:start_date, ".
            "end_date=:end_date, ".
            "requested_days=:requested_days, ".
            "days_per_week=:days_per_week, ".
            "is_remote_possible=:is_remote_possible, ".
            "company_name=:company_name, ".
            "cfg_country_sdesc=:cfg_country_sdesc, ".
            "cfg_region_sdesc=:cfg_region_sdesc, ".
            "city=:city, ".
            "scope_of_tasks=:scope_of_tasks, ".
            "requirement_number=:requirement_number, ".
            "comments=:comments, ".
            "sdesc=:sdesc";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("APPDB");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":title", $title);
        $appcon->bindParam(":role_desc", $role_desc);
        $appcon->bindParamDateTime(":start_date", $start_date);
        $appcon->bindParamDateTime(":end_date", $end_date);
        $appcon->bindParam(":requested_days", $requested_days);
        $appcon->bindParam(":days_per_week", $days_per_week);
        $appcon->bindParam(":is_remote_possible", $is_remote_possible);
        $appcon->bindParam(":company_name", $company_name);
        $appcon->bindParam(":cfg_country_sdesc", $cfg_country_sdesc);
        $appcon->bindParam(":cfg_region_sdesc", $cfg_region_sdesc);
        $appcon->bindParam(":city", $city);
        $appcon->bindParam(":scope_of_tasks", $scope_of_tasks);
        $appcon->bindParam(":requirement_number", $requirement_number);
        $appcon->bindParam(":comments", $comments);
        $appcon->bindParam(":sdesc", $sdesc);
        
        $appcon->execUpdate();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getRowfromLastId($appcon, "placement_requirement", $appcon->getLastInsertID()));
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
        $this->gdlog()->LogInfoEndFUNCTION("createRecordRequirement");
        return $fr;
    }
    
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
    }
?>   