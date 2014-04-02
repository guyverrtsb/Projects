<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class gdFindUsersafetyProfile
    extends zAppBaseObject
{
    function __construct()
    {
    }
    
    function findUsersafetyProfile_byUid($uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findUsersafetyProfile_byUid");
        $this->cleanResult_Record();
        $sqlstmnt = "SELECT * FROM usersafety_userprofile ".
            "WHERE uid=:uid";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":uid", $uid);
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
        $this->gdlog()->LogInfoEndFUNCTION("findUsersafetyProfile_byUid");
        return $fr;
    }
    
    function findUsersafetyProfiles()
    {
        $this->gdlog()->LogInfoStartFUNCTION("findUsersafetyProfiles");
        $this->cleanResult_Records();
        $sqlstmnt = "SELECT * FROM usersafety_useraccount";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
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
        $this->gdlog()->LogInfoEndFUNCTION("findUsersafetyProfiles");
        return $fr;
    }
    
    function getUid() { return $this->getResult_RecordField("uid"); }
    function getFirstname() { return $this->getResult_RecordField("firstname"); }
    function getLastname() { return $this->getResult_RecordField("lastname"); }
    function getCity() { return $this->getResult_RecordField("city"); }
    function getCfgRegionUid() { return $this->getResult_RecordField("cfg_region_uid"); }
    function getCfgCountryUid() { return $this->getResult_RecordField("cfg_country_uid"); }
}?>
        
    