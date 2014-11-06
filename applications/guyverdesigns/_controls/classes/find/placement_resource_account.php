<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class gdFindPlacementResourceAccount
    extends zAppBaseObject
{
    function findPlacementRequirementAccount_byEmail($email)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findPlacementRequirementAccount_byEmail");
        $sqlstmnt = "SELECT * ".
                    "FROM placement_resource_account ".
                    "WHERE email=:email";
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("APPDB");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":email", $email);
        $appcon->execSelect();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getStatement()->fetch(PDO::FETCH_ASSOC));
                $this->gdlog()->LogInfoDB($this->getResult_Record());
                $fr = $this->saveActivityLog("RECORD_IS_FOUND", "Records are found:".json_encode($this->getResult_Record()).":");
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
        $this->gdlog()->LogInfoEndFUNCTION("findPlacementRequirementAccount_byEmail");
        return $fr;
    }
    
    function getUid() { return $this->getResult_RecordField("uid"); }
    function getCreateddt() { return $this->getResult_RecordField("createddt"); }
    function getEmail() { return $this->getResult_RecordField("email"); }
    function getProfileid() { return $this->getResult_RecordField("profile_id"); }
    function getProfileurl() { return $this->getResult_RecordField("profile_url"); }
}
?>