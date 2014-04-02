<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class gdUpdateUsersafetyProfile
    extends zAppBaseObject
{
    function __construct()
    {
    }
    
    function updateRecordUserAccount($uid, $firstname, $city, $lastname, $cfg_region_uid, $cfg_country_uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("updateRecordUserAccount");
        $this->cleanResult_Record();
        $sqlstmnt = "UPDATE usersafety_userprofile SET ".
            "changeddt=NOW(), ".
            "firstname=:firstname, ".
            "lastname=:lastname, ".
            "city=:city, ".
            "cfg_region_uid=:cfg_region_uid, ".
            "cfg_country_uid=:cfg_country_uid ".
            "WHERE uid=:uid";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":uid", $uid);
        $appcon->bindParam(":firstname", $firstname);
        $appcon->bindParam(":lastname", $lastname);
        $appcon->bindParam(":city", $city);
        $appcon->bindParam(":cfg_region_uid", $cfg_region_uid);
        $appcon->bindParam(":cfg_country_uid", $cfg_country_uid);
        $appcon->execUpdate();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getRowfromLastId($appcon, "usersafety_userprofile", $appcon->getLastInsertID()));
                $this->gdlog()->LogInfoDB($this->getResult_Record());
                $fr = $this->saveActivityLog("RECORD_IS_UPDATED", "Record is Created:".json_encode($this->getResult_Record()).":");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("RECORD_IS_NOT_UPDATED");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("updateRecordUserAccount");
        return $fr;
    }
    
    function getUid() { return $this->getResult_RecordField("uid"); }
    function getFirstname() { return $this->getResult_RecordField("firstname"); }
    function getLastname() { return $this->getResult_RecordField("lastname"); }
    function getCity() { return $this->getResult_RecordField("city"); }
    function getCfgRegionUid() { return $this->getResult_RecordField("cfg_region_uid"); }
    function getCfgCountryUid() { return $this->getResult_RecordField("cfg_country_uid"); }
}?>
        
    