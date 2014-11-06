<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class gdCreatePlacementMatchRequirementtoSearchword
    extends zAppBaseObject
{
    function __construct()
    {
    }
    
    function createResourceMatchReqtoSearchword($placement_requirement_uid, 
                                                $search_word)
    {
        $this->gdlog()->LogInfoStartFUNCTION("createResourceMatchReqtoSearchword");
        $sqlstmnt = "INSERT INTO match_placement_requirement_to_search_word SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "placement_requirement_uid=:placement_requirement_uid, ".
            "search_word=:search_word";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("APPDB");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":placement_requirement_uid", $placement_requirement_uid);
        $appcon->bindParam(":search_word", $search_word);
        $appcon->execUpdate();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getRowfromLastId($appcon, "match_placement_requirement_to_search_word", $appcon->getLastInsertID()));
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
        $this->gdlog()->LogInfoEndFUNCTION("createResourceMatchReqtoSearchword");
        return $fr;
    }
    
    function getUid() { return $this->getResult_RecordField("uid"); }
    function getCreateddt() { return $this->getResult_RecordField("createddt"); }
    function getPlacementrequirementuid() { return $this->getResult_RecordField("placement_requirement_uid"); }
    function getSearchword() { return $this->getResult_RecordField("search_word"); }
    }
?>   