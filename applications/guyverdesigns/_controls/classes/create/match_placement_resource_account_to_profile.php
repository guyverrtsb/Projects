<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class gdCreatePlacementMatchResourceAccounttoProfile
    extends zAppBaseObject
{
    function __construct()
    {
    }
    
    function createResourceMatchAccounttoProfile($resource_account_uid, 
                                                $resource_profile_uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("createResourceMatchAccounttoProfile");
        $sqlstmnt = "INSERT INTO match_placement_resource_account_to_profile SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "placement_resource_account_uid=:placement_resource_account_uid, ".
            "placement_resource_profile_uid=:placement_resource_profile_uid";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("APPDB");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":placement_resource_account_uid", $resource_account_uid);
        $appcon->bindParam(":placement_resource_profile_uid", $resource_profile_uid);
        $appcon->execUpdate();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getRowfromLastId($appcon, "match_placement_resource_account_to_profile", $appcon->getLastInsertID()));
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
        $this->gdlog()->LogInfoEndFUNCTION("createResourceMatchAccounttoProfile");
        return $fr;
    }
    
    function getUid() { return $this->getResult_RecordField("uid"); }
    function getCreateddt() { return $this->getResult_RecordField("createddt"); }
    function getTitle() { return $this->getResult_RecordField("placement_resource_account_uid"); }
    function getRoledesc() { return $this->getResult_RecordField("placement_resource_profile_uid"); }
    }
?>   