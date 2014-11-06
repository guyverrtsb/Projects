<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class gdCreateSearchContent
    extends zAppBaseObject
{
    function __construct()
    {
    }
    
    function createSearchContent($searchable_content, 
                                $cfg_search_object_sdesc,
                                $owner_table_name,
                                $owner_table_record_uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("createSearchContent");
        $sqlstmnt = "INSERT INTO search_content SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "searchable_content=:searchable_content, ".
            "cfg_search_object_sdesc=:cfg_search_object_sdesc, ".
            "owner_table_name=:owner_table_name, ".
            "owner_table_record_uid=:owner_table_record_uid";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("APPDB");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":searchable_content", $searchable_content);
        $appcon->bindParam(":cfg_search_object_sdesc", $cfg_search_object_sdesc);
        $appcon->bindParam(":owner_table_name", $owner_table_name);
        $appcon->bindParam(":owner_table_record_uid", $owner_table_record_uid);
        $appcon->execUpdate();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getRowfromLastId($appcon, "search_content", $appcon->getLastInsertID()));
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
        $this->gdlog()->LogInfoEndFUNCTION("createSearchContent");
        return $fr;
    }
    
    function getUid() { return $this->getResult_RecordField("uid"); }
    function getCreateddt() { return $this->getResult_RecordField("createddt"); }
    function getSearchablecontent() { return $this->getResult_RecordField("searchable_content"); }
    function getCfgsearchobjectsdesc() { return $this->getResult_RecordField("cfg_search_object_sdesc"); }
    function getOwnertablename() { return $this->getResult_RecordField("owner_table_name"); }
    function getOwnertablerecorduid() { return $this->getResult_RecordField("owner_table_record_uid"); }
}
?>   