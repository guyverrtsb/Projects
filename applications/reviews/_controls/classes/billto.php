<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php gdreqonce("/_controls/classes/create/accounting_billto.php"); ?>
<?php gdreqonce("/_controls/classes/find/accounting_billto.php"); ?>
<?php gdreqonce("/_controls/classes/update/accounting_billto.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. Is Email in Use
 * 2. Create User Account with account inactive
 * 3, Create Profile
 * 4. Match User Account to Profile
 * 5. Match User to Site 
 * 6. Match User to Role
 * 7. Register Activation Record
 * 8. Send Activation Email
*/
class gdBilltoData
    extends zAppBaseObject
{
    function __construct()
    {
    }
    
    /*
     * This Method is used when Creating
     * User Account and User Profile and Matching.
     * This account will be inactive.
     * the Task Control Unique QS will be generated.
     * You may access using the getTaskCountrolQS method
     */
    function createNewBilltoAccount($companyname
                                    , $contactname
                                    , $contactemail
                                    , $contactnumber
                                    , $address
                                    , $cfg_country_sdesc
                                    , $cfg_region_sdesc
                                    , $city)
    {
        $this->gdlog()->LogInfoStartFUNCTION("createNewBilltoAccount");
        $fr = "UNKNOWN_ERROR";
        $this->cleanAllOutputData();
        
        $gdfab = new gdFindAccountingBillto();
        $fr = $gdfab->findAcountingBillto_bySdesc($companyname);
        if($fr == "RECORD_IS_NOT_FOUND")
        {
            $gdfab->countAcountingBilltos();
            $count = $gdfab->getRecordCount();
            
            $invoicenumberprefix = 9000 + (100 * (1 + $count));
            $timesheetnumberprefix = 9000 + (100 * (2 + $count));
            
            
            $gdcab = new gdCreateAccountingBillto();
            $fr = $gdcab->createRecordBilltoAccount($companyname
                                                , $contactname
                                                , $contactemail
                                                , $contactnumber
                                                , $address
                                                , $cfg_country_sdesc
                                                , $cfg_region_sdesc
                                                , $city
                                                , $invoicenumberprefix
                                                , $timesheetnumberprefix);
            if($fr == "RECORD_IS_CREATED")
            {
                $fr = $this->gdlog()->LogInfoRETURN("DATA_IS_CREATED");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("DATA_IS_NOT_CREATED");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoRETURN("ACCOUNT_ALREADY_EXISTS");
        }
        $this->gdlog()->LogInfoEndFUNCTION("createNewBilltoAccount");
        return $fr;
    }
    
    function findBilltoList()
    {
        $this->gdlog()->LogInfoStartFUNCTION("findBilltoList");
        $fr = "UNKNOWN_ERROR";
        $this->cleanAllOutputData();
        
        $gdfab = new gdFindAccountingBillto();
        $fr = $gdfab->findAcountingBilltos();
        if($fr == "RECORDS_ARE_FOUND")
        {
            $this->setResult_Records($gdfab->getResult_Records());
            $fr = $this->gdlog()->LogInfoRETURN("RECORDS_ARE_FOUND");
        }
        else
        {
            $fr = $this->gdlog()->LogInfoRETURN("RECORDS_ARE_NOT_FOUND");
        }
        
        $this->gdlog()->LogInfoEndFUNCTION("findBilltoList");
        return $fr;

    }
    
    function findBillto_byUid($uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findBillto_byUid");
        $fr = "UNKNOWN_ERROR";
        $this->cleanAllOutputData();
        
        $gdfab = new gdFindAccountingBillto();
        $fr = $gdfab->findAcountingBillto_byUid($uid);
        if($fr == "RECORD_IS_FOUND")
        {
            $this->setResult_Record($gdfab->getResult_Record());
            $fr = $this->gdlog()->LogInfoRETURN("RECORD_IS_FOUND");
        }
        else
        {
            $fr = $this->gdlog()->LogInfoRETURN("RECORD_IS_NOT_FOUND");
        }
        
        $this->gdlog()->LogInfoEndFUNCTION("findBillto_byUid");
        return $fr;

    }
    
    function updateExistingBilltoAccount($uid
                                        , $companyname
                                        , $contactname
                                        , $contactemail
                                        , $contactnumber
                                        , $address
                                        , $cfg_country_sdesc
                                        , $cfg_region_sdesc
                                        , $city)
    {
        $this->gdlog()->LogInfoStartFUNCTION("updateExistingBilltoAccount");
        $fr = "UNKNOWN_ERROR";
        $this->cleanAllOutputData();
        
        $gdfab = new gdFindAccountingBillto();
        $fr = $gdfab->findAcountingBillto_bySdesc($companyname);
        
        $gdcab = new gdUpdateAccountingBillto();
        if($fr == "RECORD_IS_NOT_FOUND")
        {
            $fr = $gdcab->updateRecordBilltoAccount($uid
                                                , $companyname
                                                , $contactname
                                                , $contactemail
                                                , $contactnumber
                                                , $address
                                                , $cfg_country_sdesc
                                                , $cfg_region_sdesc
                                                , $city);
        }
        else
        {
            $fr = $gdcab->updateRecordBilltoAccount_noCompanyName($uid
                                                , $contactname
                                                , $contactemail
                                                , $contactnumber
                                                , $address
                                                , $cfg_country_sdesc
                                                , $cfg_region_sdesc
                                                , $city);
        }

        if($fr == "RECORD_IS_UPDATED")
        {
            $fr = $this->gdlog()->LogInfoRETURN("RECORD_IS_UPDATED");
        }
        else
        {
            $fr = $this->gdlog()->LogInfoRETURN("RECORD_IS_NOT_UPDATED");
        }

        $this->gdlog()->LogInfoEndFUNCTION("updateExistingBilltoAccount");
        return $fr;
    }
}
?>
    