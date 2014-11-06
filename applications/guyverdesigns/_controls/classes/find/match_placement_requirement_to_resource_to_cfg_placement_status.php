<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class gdFindPlacementMatchReqtoRestoStatus
    extends zAppBaseObject
{
    function findPlacementRequirementResources($placement_requirement_uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findPlacementRequirementResources");
        $sqlstmnt = "SELECT * ".
                    "FROM match_placement_requirement_to_resource_to_cfg_placement_status ".
                    "JOIN placement_requirement ".
                    " ON placement_requirement.uid = match_placement_requirement_to_resource_to_cfg_placement_status.placement_requirement_uid ".
                    "JOIN match_placement_resource_account_to_profile ".
                    " ON match_placement_resource_account_to_profile.placement_resource_account_uid = match_placement_requirement_to_resource_to_cfg_placement_status.placement_resource_account_uid ".
                    "JOIN placement_resource_account ".
                    " ON placement_resource_account.uid = match_placement_resource_account_to_profile.placement_resource_account_uid ".
                    "JOIN placement_resource_profile ".
                    " ON placement_resource_profile.uid = match_placement_resource_account_to_profile.placement_resource_profile_uid ".
                    "WHERE placement_requirement_uid=:placement_requirement_uid";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("APPDB");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":placement_requirement_uid", $placement_requirement_uid);
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
        $this->gdlog()->LogInfoEndFUNCTION("findPlacementRequirementsToResource");
        return $fr;
    }

    function findPlacementRequirements_byResourceAccountUid($resource_account_uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findPlacementRequirements_byResourceAccountUid");
        $sqlstmnt = "SELECT * ".
                    "FROM match_placement_requirement_to_resource_to_cfg_placement_status ".
                    "JOIN placement_requirement ".
                    " ON placement_requirement.uid = match_placement_requirement_to_resource_to_cfg_placement_status.placement_requirement_uid ".
                    "WHERE match_placement_requirement_to_resource_to_cfg_placement_status.placement_resource_account_uid=:resource_account_uid";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("APPDB");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":resource_account_uid", $resource_account_uid);
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
        $this->gdlog()->LogInfoEndFUNCTION("findPlacementRequirements_byResourceAccountUid");
        return $fr;
    }

    function findPlacementRequirementsToResource($placement_requirement_uid,
                                                $resource_account_uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findPlacementRequirementsToResource");
        $sqlstmnt = "SELECT * ".
                    "FROM match_placement_requirement_to_resource_to_cfg_placement_status ".
                    "WHERE placement_requirement_uid=:placement_requirement_uid ".
                    "AND placement_resource_account_uid=:placement_resource_account_uid";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("APPDB");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":placement_requirement_uid", $placement_requirement_uid);
        $appcon->bindParam(":placement_resource_account_uid", $resource_account_uid);
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
        $this->gdlog()->LogInfoEndFUNCTION("findPlacementRequirementsToResource");
        return $fr;
    }

    function findPlacementRequirementsToResourcetoStatus($placement_requirement_uid,
                                                        $resource_account_uid,
                                                        $cfg_placement_status_sdesc)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findPlacementRequirementsToResource");
        $sqlstmnt = "SELECT * ".
                    "FROM match_placement_requirement_to_resource_to_cfg_placement_status ".
                    "WHERE placement_requirement_uid=:placement_requirement_uid ".
                    "AND placement_resource_account_uid=:placement_resource_account_uid ".
                    "AND cfg_placement_status_sdesc=:cfg_placement_status_sdesc";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("APPDB");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":placement_requirement_uid", $placement_requirement_uid);
        $appcon->bindParam(":placement_resource_account_uid", $resource_account_uid);
        $appcon->bindParam(":cfg_placement_status_sdesc", $cfg_placement_status_sdesc);
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
        $this->gdlog()->LogInfoEndFUNCTION("findPlacementRequirementsToResource");
        return $fr;
    }
    
    function getRecordCount() { return $this->getResult_RecordField("record_count"); }
    function getUid() { return $this->getResult_RecordField("uid"); }
    function getCreateddt() { return $this->getResult_RecordField("createddt"); }
    function getPlacementrequirementuid() { return $this->getResult_RecordField("placement_requirement_uid"); }
    function getPlacementresourceaccountuid() { return $this->getResult_RecordField("placement_resource_account_uid"); }
    function getCfgplacementstatussdesc() { return $this->getResult_RecordField("cfg_placement_status_sdesc"); }
}
?>