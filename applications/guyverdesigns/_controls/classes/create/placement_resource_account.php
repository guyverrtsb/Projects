<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class gdCreatePlacementResourceAccount
    extends zAppBaseObject
{
    function __construct()
    {
    }
    
    function createResourceAccount($email, 
                                $profile_id,
                                $profile_url)
    {
        $this->gdlog()->LogInfoStartFUNCTION("createResourceAccount");
        $sqlstmnt = "INSERT INTO placement_resource_account SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "email=:email, ".
            "profile_id=:profile_id, ".
            "profile_url=:profile_url";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("APPDB");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":email", $email);
        $appcon->bindParam(":profile_id", $profile_id);
        $appcon->bindParam(":profile_url", $profile_url);
        $appcon->execUpdate();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getRowfromLastId($appcon, "placement_resource_account", $appcon->getLastInsertID()));
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
        $this->gdlog()->LogInfoEndFUNCTION("createResourceAccount");
        return $fr;
    }
    
    function getUid() { return $this->getResult_RecordField("uid"); }
    function getCreateddt() { return $this->getResult_RecordField("createddt"); }
    function getEmail() { return $this->getResult_RecordField("email"); }
    function getProfileid() { return $this->getResult_RecordField("profile_id"); }
    function getProfileurl() { return $this->getResult_RecordField("profile_url"); }
}
?>   