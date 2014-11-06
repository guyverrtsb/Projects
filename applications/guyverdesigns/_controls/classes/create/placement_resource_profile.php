<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class gdCreatePlacementResourceProfile
    extends zAppBaseObject
{
    function __construct()
    {
    }
    
    function createResourceProfile($firstname, 
                                $lastname)
    {
        $this->gdlog()->LogInfoStartFUNCTION("createResourceProfile");
        $this->cleanResult_Record();
        $sqlstmnt = "INSERT INTO placement_resource_profile SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "firstname=:firstname, ".
            "lastname=:lastname";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("APPDB");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":firstname", $firstname);
        $appcon->bindParam(":lastname", $lastname);
        $appcon->execUpdate();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getRowfromLastId($appcon, "placement_resource_profile", $appcon->getLastInsertID()));
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
        $this->gdlog()->LogInfoEndFUNCTION("createResourceProfile");
        return $fr;
    }
    
    function getUid() { return $this->getResult_RecordField("uid"); }
    function getCreateddt() { return $this->getResult_RecordField("createddt"); }
    function getTitle() { return $this->getResult_RecordField("firstname"); }
    function getRoledesc() { return $this->getResult_RecordField("lastname"); }
    }
?>   