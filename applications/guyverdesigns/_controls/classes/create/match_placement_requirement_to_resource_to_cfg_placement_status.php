<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class gdCreatePlacementMatchReqtoRestoStatus
    extends zAppBaseObject
{

    function createPlacementRequirementsToResourcetoStatus($placement_requirement_uid,
                                                        $resource_account_uid,
                                                        $cfg_placement_status_sdesc)
    {
        $this->gdlog()->LogInfoStartFUNCTION("createPlacementRequirementsToResourcetoStatus");
        $sqlstmnt = "INSERT INTO match_placement_requirement_to_resource_to_cfg_placement_status SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "placement_requirement_uid=:placement_requirement_uid, ".
            "placement_resource_account_uid=:placement_resource_account_uid, ".
            "cfg_placement_status_sdesc=:cfg_placement_status_sdesc";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("APPDB");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":placement_requirement_uid", $placement_requirement_uid);
        $appcon->bindParam(":placement_resource_account_uid", $resource_account_uid);
        $appcon->bindParam(":cfg_placement_status_sdesc", $cfg_placement_status_sdesc);
        $appcon->execUpdate();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getRowfromLastId($appcon, "match_placement_requirement_to_resource_to_cfg_placement_status", $appcon->getLastInsertID()));
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
        $this->gdlog()->LogInfoEndFUNCTION("createPlacementRequirementsToResourcetoStatus");
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