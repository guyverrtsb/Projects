<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class gdFindPlacementResourceData
    extends zAppBaseObject
{
    function findPlacementRequirementAccountandProfile_byAccountUid($resource_account_uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findPlacementRequirementAccountandProfile_byAccountUid");
        $sqlstmnt = "SELECT * ".
                    "FROM placement_resource_account ".
                    "JOIN match_placement_resource_account_to_profile".
                    " ON placement_resource_account.uid = match_placement_resource_account_to_profile.placement_resource_account_uid ".
                    "JOIN placement_resource_profile".
                    " ON placement_resource_profile.uid = match_placement_resource_account_to_profile.placement_resource_profile_uid ".
                    "WHERE placement_resource_account.uid=:placement_resource_account_uid";
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("APPDB");
        $appcon->setStatement($sqlstmnt);
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
        $this->gdlog()->LogInfoEndFUNCTION("findPlacementRequirementAccountandProfile_byAccountUid");
        return $fr;
    }
    
    function getUid() { return $this->getResult_RecordField("uid"); }
    function getCreateddt() { return $this->getResult_RecordField("createddt"); }
    function getEmail() { return $this->getResult_RecordField("email"); }
    function getProfileid() { return $this->getResult_RecordField("profile_id"); }
    function getProfileurl() { return $this->getResult_RecordField("profile_url"); }
    function getFirstname() { return $this->getResult_RecordField("firstname"); }
    function getLastname() { return $this->getResult_RecordField("lastname"); }
}
?>