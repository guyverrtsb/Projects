<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class gdUpdateAccountingBillto
    extends zAppBaseObject
{
    function __construct()
    {
    }
    
    function updateRecordBilltoAccount($uid
                                , $companyname
                                , $accountingcontactname
                                , $accountingcontactemail
                                , $accountingcontactnumber
                                , $address
                                , $cfg_country_sdesc
                                , $cfg_region_sdesc
                                , $city)
    {
        $this->gdlog()->LogInfoStartFUNCTION("updateRecordBilltoAccount");
        $this->cleanResult_Record();
        $sqlstmnt = "UPDATE accounting_billto SET ".
            "changeddt=NOW(), ".
            "companyname=:companyname, ".
            "accountingcontactname=:accountingcontactname, ".
            "accountingcontactemail=:accountingcontactemail, ".
            "accountingcontactnumber=:accountingcontactnumber, ".
            "address=:address, ".
            "cfg_country_sdesc=:cfg_country_sdesc, ".
            "cfg_region_sdesc=:cfg_region_sdesc, ".
            "city=:city, ".
            "sdesc=:sdesc ".
            "WHERE uid=:uid";
        
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
        $appcon->bindParam(":uid", $uid);
        $appcon->execUpdate();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getRowfromLastId($appcon, "accounting_billto", $appcon->getLastInsertID()));
                $this->gdlog()->LogInfoDB($this->getResult_Record());
                $fr = $this->saveActivityLog("RECORD_IS_UPDATED", "Record is Update:".json_encode($this->getResult_Record()).":");
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
        $this->gdlog()->LogInfoEndFUNCTION("updateRecordBilltoAccount");
        return $fr;
    }
    
    function updateRecordBilltoAccount_noCompanyName($uid
                                    , $accountingcontactname
                                    , $accountingcontactemail
                                    , $accountingcontactnumber
                                    , $address
                                    , $cfg_country_sdesc
                                    , $cfg_region_sdesc
                                    , $city)
    {
        $this->gdlog()->LogInfoStartFUNCTION("updateRecordBilltoAccount_noCompanyName");
        $this->cleanResult_Record();
        $sqlstmnt = "UPDATE accounting_billto SET ".
            "changeddt=NOW(), ".
             "accountingcontactname=:accountingcontactname, ".
            "accountingcontactemail=:accountingcontactemail, ".
            "accountingcontactnumber=:accountingcontactnumber, ".
            "address=:address, ".
            "cfg_country_sdesc=:cfg_country_sdesc, ".
            "cfg_region_sdesc=:cfg_region_sdesc, ".
            "city=:city ".
            "WHERE uid=:uid";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("APPDB");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":accountingcontactname", $accountingcontactname);
        $appcon->bindParam(":accountingcontactemail", $accountingcontactemail);
        $appcon->bindParam(":accountingcontactnumber", $accountingcontactnumber);
        $appcon->bindParam(":address", $address);
        $appcon->bindParam(":cfg_country_sdesc", $cfg_country_sdesc);
        $appcon->bindParam(":cfg_region_sdesc", $cfg_region_sdesc);
        $appcon->bindParam(":city", $city);
        $appcon->bindParam(":uid", $uid);
        $appcon->execUpdate();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $this->setResult_Record($appcon->getRowfromLastId($appcon, "accounting_billto", $appcon->getLastInsertID()));
                $this->gdlog()->LogInfoDB($this->getResult_Record());
                $fr = $this->saveActivityLog("RECORD_IS_UPDATED", "Record is Update:".json_encode($this->getResult_Record()).":");
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
        $this->gdlog()->LogInfoEndFUNCTION("updateRecordBilltoAccount_noCompanyName");
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