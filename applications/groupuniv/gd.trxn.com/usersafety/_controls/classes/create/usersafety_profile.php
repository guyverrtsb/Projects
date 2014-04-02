<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class gdCreateUsersafetyProfile
    extends zAppBaseObject
{
    function __construct()
    {
    }
    
    function createRecordUserProfile($firstname,
                        $lastname,
                        $cfg_country_sdesc, 
                        $cfg_region_sdesc,
                        $city)
    {
        $this->gdlog()->LogInfoStartFUNCTION("createRecordUserProfile");
        $this->cleanResult_Record();
        $sqlstmnt = "INSERT INTO usersafety_userprofile SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "firstname=:firstname, ".
            "lastname=:lastname, ".
            "cfg_country_sdesc=:cfg_country_sdesc, ".
            "cfg_region_sdesc=:cfg_region_sdesc, ".
            "city=:city";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":firstname", $firstname);
        $appcon->bindParam(":lastname", $lastname);
        $appcon->bindParam(":cfg_country_sdesc", $cfg_country_sdesc);
        $appcon->bindParam(":cfg_region_sdesc", $cfg_region_sdesc);
        $appcon->bindParam(":city", $city);
        $appcon->execUpdate();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getRowfromLastId($appcon, "usersafety_userprofile", $appcon->getLastInsertID()));
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
        $this->gdlog()->LogInfoEndFUNCTION("createRecordUserProfile");
        return $fr;
    }
    
    function getUid() { return $this->getResult_RecordField("uid"); }
    function getFirstname() { return $this->getResult_RecordField("firstname"); }
    function getLastname() { return $this->getResult_RecordField("lastname"); }
    function getCfgCountrySdesc() { return $this->getResult_RecordField("cfg_country_sdesc"); }
    function getCfgRegionSdesc() { return $this->getResult_RecordField("cfg_region_sdesc"); }
    function getCity() { return $this->getResult_RecordField("city"); }
}
?>