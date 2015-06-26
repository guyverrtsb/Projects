<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class gdCreateAccountingClient
    extends zAppBaseObject
{
    function __construct()
    {
    }
    
    function createRecordClientAccount($companyname
                                    , $contactname
                                    , $contactemail
                                    , $contactnumber
                                    , $address
                                    , $cfg_country_sdesc
                                    , $cfg_region_sdesc
                                    , $city)
    {
        $this->gdlog()->LogInfoStartFUNCTION("createRecordClientAccount");
        $this->cleanResult_Record();
        $sqlstmnt = "INSERT INTO accounting_client SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "companyname=:companyname, ".
            "contactname=:contactname, ".
            "contactemail=:contactemail, ".
            "contactnumber=:contactnumber, ".
            "address=:address, ".
            "cfg_country_sdesc=:cfg_country_sdesc, ".
            "cfg_region_sdesc=:cfg_region_sdesc, ".
            "city=:city, ".
            "sdesc=:sdesc";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("APPDB");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":companyname", $companyname);
        $appcon->bindParam(":contactname", $contactname);
        $appcon->bindParam(":contactemail", $contactemail);
        $appcon->bindParam(":contactnumber", $contactnumber);
        $appcon->bindParam(":address", $address);
        $appcon->bindParam(":cfg_country_sdesc", $cfg_country_sdesc);
        $appcon->bindParam(":cfg_region_sdesc", $cfg_region_sdesc);
        $appcon->bindParam(":city", $city);
        $appcon->bindParam(":sdesc", $this->createSdesc($companyname));
                $appcon->execUpdate();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getRowfromLastId($appcon, "accounting_client", $appcon->getLastInsertID()));
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
        $this->gdlog()->LogInfoEndFUNCTION("createRecordClientAccount");
        return $fr;
    }
    
    function getUid() { return $this->getResult_RecordField("uid"); }
    function getCompanyname() { return $this->getResult_RecordField("companyname"); }
    function getContactname() { return $this->getResult_RecordField("contactname"); }
    function getContactemail() { return $this->getResult_RecordField("contactemail"); }
    function getContactnumber() { return $this->getResult_RecordField("contactnumber"); }
    function getAddress() { return $this->getResult_RecordField("address"); }
    function getCfgCountrySdesc() { return $this->getResult_RecordField("cfg_country_sdesc"); }
    function getCfgRegionSdesc() { return $this->getResult_RecordField("cfg_region_sdesc"); }
    function getCity() { return $this->getResult_RecordField("city"); }
    function getSdesc() { return $this->getResult_RecordField("sdesc"); }
}
?>