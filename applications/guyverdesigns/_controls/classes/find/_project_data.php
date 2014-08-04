<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class gdFindAccountingProjectData
    extends zAppBaseObject
{
    function __construct()
    {
    }

    function findAcountingProject_byUid($uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findAcountingProject_byUid");
        $this->cleanResult_Records();
        $sqlstmnt = "SELECT ".
        
            "accounting_project.uid AS uid, ".
            "accounting_project.sdesc AS sdesc, ".
            "accounting_project.ldesc AS ldesc, ".
            "accounting_project.contactname AS contactname, ".
            "accounting_project.contactemail AS contactemail, ".
            "accounting_project.contactnumber AS contactnumber, ".
            "accounting_project.address AS address, ".
            "accounting_project.cfg_country_sdesc AS cfg_country_sdesc, ".
            "accounting_project.cfg_region_sdesc AS cfg_region_sdesc, ".
            "accounting_project.city AS city, ".
            
            "accounting_project_profile.cfg_payoutcycle_sdesc AS cfg_payoutcycle_sdesc, ".
            "accounting_project_profile.cfg_ratetype_sdesc AS cfg_ratetype_sdesc, ".
            "accounting_project_profile.rate_hourly_onsite AS rate_hourly_onsite, ".
            "accounting_project_profile.rate_hourly_remote AS rate_hourly_remote, ".
            
            "accounting_billto.companyname AS accounting_billto_companyname, ".
            "accounting_billto.accountingcontactname AS accounting_billto_accountingcontactname, ".
            "accounting_billto.accountingcontactemail AS accounting_billto_accountingcontactemail, ".
            "accounting_billto.accountingcontactnumber AS accounting_billto_accountingcontactnumber, ".
            "accounting_billto.invoicenumberprefix AS accounting_billto_invoicenumberprefix, ".
            "accounting_billto.timesheetnumberprefix AS accounting_billto_timesheetnumberprefix, ".
                        
            "accounting_client.companyname AS accounting_client_companyname, ".
            "accounting_client.contactname AS accounting_client_contactname, ".
            "accounting_client.contactemail AS accounting_client_contactemail, ".
            "accounting_client.contactnumber AS accounting_client_contactnumber, ".
            
            
            $this->getDATE_FORMAT("accounting_project_profile.start_date")." AS start_date, ".
            $this->getDATE_FORMAT("accounting_project_profile.end_date")." AS end_date, ".
            
            "match_accounting_project_to_billto.accounting_billto_uid AS accounting_billto_uid, ".
            "match_accounting_project_to_client.accounting_client_uid AS accounting_client_uid ".

            "FROM accounting_project ".
            "JOIN accounting_project_profile ".
            " ON accounting_project_profile.accounting_project_uid = accounting_project.uid ".
            
            "JOIN match_accounting_project_to_billto ".
            " ON match_accounting_project_to_billto.accounting_project_uid = accounting_project.uid ".
            "JOIN accounting_billto ".
            " ON accounting_billto.uid = match_accounting_project_to_billto.accounting_billto_uid ".
            
            "JOIN match_accounting_project_to_client ".
            " ON match_accounting_project_to_client.accounting_project_uid = accounting_project.uid ".
            "JOIN accounting_client ".
            " ON accounting_client.uid = match_accounting_project_to_client.accounting_client_uid ".
            
            "WHERE accounting_project.uid=:accounting_project_uid";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("APPDB");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":accounting_project_uid", $uid);
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
        $this->gdlog()->LogInfoEndFUNCTION("findAcountingProject_byUid");
        return $fr;
    }

    function findAcountingProject_bySdesc($sdesc)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findAcountingProject_bySdesc");
        $this->cleanResult_Records();
        $sqlstmnt = "SELECT ".
        
            "accounting_project.uid AS uid, ".
            "accounting_project.sdesc AS sdesc, ".
            "accounting_project.ldesc AS ldesc, ".
            "accounting_project.contactname AS contactname, ".
            "accounting_project.contactemail AS contactemail, ".
            "accounting_project.contactnumber AS contactnumber, ".
            "accounting_project.address AS address, ".
            "accounting_project.cfg_country_sdesc AS cfg_country_sdesc, ".
            "accounting_project.cfg_region_sdesc AS cfg_region_sdesc, ".
            "accounting_project.city AS city, ".
            
            "accounting_project_profile.cfg_payoutcycle_sdesc AS cfg_payoutcycle_sdesc, ".
            "accounting_project_profile.cfg_ratetype_sdesc AS cfg_ratetype_sdesc, ".
            "accounting_project_profile.rate_hourly_onsite AS rate_hourly_onsite, ".
            "accounting_project_profile.rate_hourly_remote AS rate_hourly_remote, ".
            $this->getDATE_FORMAT("accounting_project_profile.start_date")." AS start_date, ".
            $this->getDATE_FORMAT("accounting_project_profile.end_date")." AS end_date, ".
            
            "match_accounting_project_to_billto.accounting_billto_uid AS accounting_billto_uid, ".
            "match_accounting_project_to_client.accounting_client_uid AS accounting_client_uid ".

            "FROM accounting_project ".
            "JOIN accounting_project_profile ".
            " ON accounting_project_profile.accounting_project_uid = accounting_project.uid ".
            "JOIN match_accounting_project_to_billto ".
            " ON match_accounting_project_to_billto.accounting_project_uid = accounting_project.uid ".
            "JOIN match_accounting_project_to_client ".
            " ON match_accounting_project_to_client.accounting_project_uid = accounting_project.uid ".
            
            "WHERE sdesc=:sdesc";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("APPDB");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":sdesc", $this->createSdesc($sdesc));
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
        $this->gdlog()->LogInfoEndFUNCTION("findAcountingProject_bySdesc");
        return $fr;
    }

    function findAcountingProjects()
    {
        $this->gdlog()->LogInfoStartFUNCTION("findAcountingProjects");
        $this->cleanResult_Records();
        $sqlstmnt = "SELECT ".
        
            "accounting_project.uid AS uid, ".
            "accounting_project.sdesc AS sdesc, ".
            "accounting_project.ldesc AS ldesc, ".
            "accounting_project.contactname AS contactname, ".
            "accounting_project.contactemail AS contactemail, ".
            "accounting_project.contactnumber AS contactnumber, ".
            "accounting_project.address AS address, ".
            "accounting_project.cfg_country_sdesc AS cfg_country_sdesc, ".
            "accounting_project.cfg_region_sdesc AS cfg_region_sdesc, ".
            "accounting_project.city AS city, ".
            
            "accounting_project_profile.cfg_payoutcycle_sdesc AS cfg_payoutcycle_sdesc, ".
            "accounting_project_profile.cfg_ratetype_sdesc AS cfg_ratetype_sdesc, ".
            "accounting_project_profile.rate_hourly_onsite AS rate_hourly_onsite, ".
            "accounting_project_profile.rate_hourly_remote AS rate_hourly_remote, ".
            $this->getDATE_FORMAT("accounting_project_profile.start_date")." AS start_date, ".
            $this->getDATE_FORMAT("accounting_project_profile.end_date")." AS end_date, ".
            
            "match_accounting_project_to_billto.accounting_billto_uid AS accounting_billto_uid, ".
            "match_accounting_project_to_client.accounting_client_uid AS accounting_client_uid ".

            "FROM accounting_project ".
            "JOIN accounting_project_profile ".
            " ON accounting_project_profile.accounting_project_uid = accounting_project.uid ".
            "JOIN match_accounting_project_to_billto ".
            " ON match_accounting_project_to_billto.accounting_project_uid = accounting_project.uid ".
            "JOIN match_accounting_project_to_client ".
            " ON match_accounting_project_to_client.accounting_project_uid = accounting_project.uid ".
            
            "ORDER BY accounting_project.createddt";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("APPDB");
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
        $this->gdlog()->LogInfoEndFUNCTION("findAcountingProjects");
        return $fr;
    }

    function findAcountingProjectsBIllTosClients()
    {
        $this->gdlog()->LogInfoStartFUNCTION("findAcountingProjectsBIllTosClients");
        $this->cleanResult_Records();
        $sqlstmnt = "SELECT ".
        
            "accounting_project.uid AS uid, ".
            "accounting_project.sdesc AS sdesc, ".
            "accounting_project.ldesc AS ldesc, ".
            "accounting_project.contactname AS contactname, ".
            "accounting_project.contactemail AS contactemail, ".
            "accounting_project.contactnumber AS contactnumber, ".
            "accounting_project.address AS address, ".
            "accounting_project.cfg_country_sdesc AS cfg_country_sdesc, ".
            "accounting_project.cfg_region_sdesc AS cfg_region_sdesc, ".
            "accounting_project.city AS city, ".
            
            "accounting_project_profile.cfg_payoutcycle_sdesc AS cfg_payoutcycle_sdesc, ".
            "accounting_project_profile.cfg_ratetype_sdesc AS cfg_ratetype_sdesc, ".
            "accounting_project_profile.rate_hourly_onsite AS rate_hourly_onsite, ".
            "accounting_project_profile.rate_hourly_remote AS rate_hourly_remote, ".
            $this->getDATE_FORMAT("accounting_project_profile.start_date")." AS start_date, ".
            $this->getDATE_FORMAT("accounting_project_profile.end_date")." AS end_date, ".
            
            "match_accounting_project_to_billto.accounting_billto_uid AS accounting_billto_uid, ".
            "match_accounting_project_to_client.accounting_client_uid AS accounting_client_uid, ".
            
            "accounting_billto.companyname AS accounting_billto_companyname, ".
            "accounting_billto.accountingcontactname AS accounting_billto_accountingcontactname, ".
            "accounting_billto.accountingcontactemail AS accounting_billto_accountingcontactemail, ".
            "accounting_billto.accountingcontactnumber AS accounting_billto_accountingcontactnumber, ".
            
            "accounting_client.companyname AS accounting_client_companyname, ".
            "accounting_client.contactname AS accounting_client_contactname, ".
            "accounting_client.contactemail AS accounting_client_contactemail, ".
            "accounting_client.contactnumber AS accounting_client_contactnumber, ".
            
            "cfg_defaults.ldesc AS cfg_defaults_ldesc, ".
            "cfg_defaults.label AS cfg_defaults_label ".
            
            "FROM accounting_project ".
            "JOIN accounting_project_profile ".
            " ON accounting_project_profile.accounting_project_uid = accounting_project.uid ".
            
            "JOIN match_accounting_project_to_billto ".
            " ON match_accounting_project_to_billto.accounting_project_uid = accounting_project.uid ".
            "JOIN accounting_billto ".
            " ON accounting_billto.uid = match_accounting_project_to_billto.accounting_billto_uid ".
            
            "JOIN match_accounting_project_to_client ".
            " ON match_accounting_project_to_client.accounting_project_uid = accounting_project.uid ".
            "JOIN accounting_client ".
            " ON accounting_client.uid = match_accounting_project_to_client.accounting_client_uid ".
            
            "JOIN cfg_defaults ".
            " ON cfg_defaults.sdesc = accounting_project_profile.cfg_payoutcycle_sdesc ".
            
            "ORDER BY accounting_project.createddt";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("APPDB");
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
        $this->gdlog()->LogInfoEndFUNCTION("findAcountingProjectsBIllTosClients");
        return $fr;
    }

    function getUid() { return $this->getResult_RecordField("uid"); }
    function getSdesc() { return $this->getResult_RecordField("sdesc"); }
    function getLdesc() { return $this->getResult_RecordField("ldesc"); }
    function getContactname() { return $this->getResult_RecordField("contactname"); }
    function getContactemail() { return $this->getResult_RecordField("contactemail"); }
    function getContactnumber() { return $this->getResult_RecordField("contactnumber"); }
    function getAddress() { return $this->getResult_RecordField("address"); }
    function getCfgCountrySdesc() { return $this->getResult_RecordField("cfg_country_sdesc"); }
    function getCfgRegionSdesc() { return $this->getResult_RecordField("cfg_region_sdesc"); }
    function getCity() { return $this->getResult_RecordField("city"); }
    function getCfgPayoutcycleSdesc() { return $this->getResult_RecordField("cfg_payoutcycle_sdesc"); }
    function getCfgRatetypeSdesc() { return $this->getResult_RecordField("cfg_ratetype_sdesc"); }
    function getRateHourlyOnsite() { return $this->getResult_RecordField("rate_hourly_onsite"); }
    function getRateHourlyRemote() { return $this->getResult_RecordField("rate_hourly_remote"); }
    function getStartDate() { return $this->getResult_RecordField("start_date"); }
    function getEndDate() { return $this->getResult_RecordField("end_date"); }
    function getAccountingBilltoUid() { return $this->getResult_RecordField("accounting_billto_uid"); }
    function getAccountingClientUid() { return $this->getResult_RecordField("accounting_client_uid"); }
    function getInvoiceprefixnumber() { return $this->getResult_RecordField("accounting_billto_invoicenumberprefix"); }
    function getTimesheetprefixnumber() { return $this->getResult_RecordField("accounting_billto_timesheetnumberprefix"); }
}
?>