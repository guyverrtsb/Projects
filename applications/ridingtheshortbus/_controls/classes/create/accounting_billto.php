<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class gdCreateAccountingBillto
    extends zAppBaseObject
{
    function __construct()
    {
    }
    
    function createRecordBilltoAccount($companyname
                                    , $accountingcontactname
                                    , $accountingcontactemail
                                    , $accountingcontactnumber
                                    , $address
                                    , $cfg_country_sdesc
                                    , $cfg_region_sdesc
                                    , $city
                                    , $invoicenumberprefix
                                    , $timesheetnumberprefix)
    {
        $this->gdlog()->LogInfoStartFUNCTION("createRecordBilltoAccount");
        $this->cleanResult_Record();
        $sqlstmnt = "INSERT INTO accounting_billto SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "companyname=:companyname, ".
            "accountingcontactname=:accountingcontactname, ".
            "accountingcontactemail=:accountingcontactemail, ".
            "accountingcontactnumber=:accountingcontactnumber, ".
            "address=:address, ".
            "cfg_country_sdesc=:cfg_country_sdesc, ".
            "cfg_region_sdesc=:cfg_region_sdesc, ".
            "city=:city, ".
            "sdesc=:sdesc, ".
            "invoicenumberprefix=:invoicenumberprefix, ".
            "timesheetnumberprefix=:timesheetnumberprefix";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("APPDB");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":companyname", $companyname);
        $appcon->bindParam(":accountingcontactname", $accountingcontactname);
        $appcon->bindParam(":accountingcontactemail", $accountingcontactemail);
        $appcon->bindParam(":accountingcontactnumber", $accountingcontactnumber);
        $appcon->bindParam(":address", $address);
        $appcon->bindParam(":cfg_country_sdesc", $cfg_country_sdesc);
        $appcon->bindParam(":cfg_region_sdesc", $cfg_region_sdesc);
        $appcon->bindParam(":city", $city);
        $appcon->bindParam(":sdesc", $this->createSdesc($companyname));
        $appcon->bindParam(":invoicenumberprefix", $invoicenumberprefix);
        $appcon->bindParam(":timesheetnumberprefix", $timesheetnumberprefix);
                $appcon->execUpdate();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getRowfromLastId($appcon, "accounting_billto", $appcon->getLastInsertID()));
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
        $this->gdlog()->LogInfoEndFUNCTION("createRecordBilltoAccount");
        return $fr;
    }
    
    function getUid() { return $this->getResult_RecordField("uid"); }
    function getCompanyname() { return $this->getResult_RecordField("companyname"); }
    function getAccountingcontactname() { return $this->getResult_RecordField("accountingcontactname"); }
    function getAccountingcontactemail() { return $this->getResult_RecordField("accountingcontactemail"); }
    function getAccountingcontactnumber() { return $this->getResult_RecordField("accountingcontactnumber"); }
    function getAddress() { return $this->getResult_RecordField("address"); }
    function getCfgCountrySdesc() { return $this->getResult_RecordField("cfg_country_sdesc"); }
    function getCfgRegionSdesc() { return $this->getResult_RecordField("cfg_region_sdesc"); }
    function getCity() { return $this->getResult_RecordField("city"); }
    function getSdesc() { return $this->getResult_RecordField("sdesc"); }
    function getInvoiceprefixnumber() { return $this->getResult_RecordField("invoicenumberprefix"); }
    function getTimesheetprefixnumber() { return $this->getResult_RecordField("timesheetnumberprefix"); }
}
?>   