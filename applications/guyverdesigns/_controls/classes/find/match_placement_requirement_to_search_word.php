<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class gdFindPlacementMatchRequirementtoSearchword
    extends zAppBaseObject
{
    function findResourceMatchReqtoSearchword_byPlacementrequirementuid($placement_requirement_uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findResourceMatchReqtoSearchword_byPlacementrequirementuid");
        $sqlstmnt = "SELECT * ".
                    "FROM match_placement_requirement_to_search_word ".
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
        $this->gdlog()->LogInfoEndFUNCTION("findResourceMatchReqtoSearchword_byPlacementrequirementuid");
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