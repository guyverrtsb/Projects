<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php gdreqonce("/_controls/classes/create/accounting_client.php"); ?>
<?php gdreqonce("/_controls/classes/find/accounting_client.php"); ?>
<?php gdreqonce("/_controls/classes/update/accounting_client.php"); ?>
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
class gdClientData
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
    function createNewClientAccount($companyname
                                    , $contactname
                                    , $contactemail
                                    , $contactnumber
                                    , $address
                                    , $cfg_country_sdesc
                                    , $cfg_region_sdesc
                                    , $city)
    {
        $this->gdlog()->LogInfoStartFUNCTION("createNewClientAccount");
        $fr = "UNKNOWN_ERROR";
        
        $gdfab = new gdFindAccountingClient();
        $fr = $gdfab->findAcountingClient_bySdesc($companyname);
        if($fr == "RECORD_IS_NOT_FOUND")
        {
            $gdcab = new gdCreateAccountingClient();
            $fr = $gdcab->createRecordClientAccount($companyname
                                                , $contactname
                                                , $contactemail
                                                , $contactnumber
                                                , $address
                                                , $cfg_country_sdesc
                                                , $cfg_region_sdesc
                                                , $city);
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
        $this->gdlog()->LogInfoEndFUNCTION("createNewClientAccount");
        return $fr;
    }
    
    function findClientList()
    {
        $this->gdlog()->LogInfoStartFUNCTION("findClientList");
        $fr = "UNKNOWN_ERROR";
        
        $gdfab = new gdFindAccountingClient();
        $fr = $gdfab->findAcountingClients();
        if($fr == "RECORDS_ARE_FOUND")
        {
            $this->setResult_Records($gdfab->getResult_Records());
            $fr = $this->gdlog()->LogInfoRETURN("RECORDS_ARE_FOUND");
        }
        else
        {
            $fr = $this->gdlog()->LogInfoRETURN("RECORDS_ARE_NOT_FOUND");
        }
        
        $this->gdlog()->LogInfoEndFUNCTION("findClientList");
        return $fr;

    }
    
    function findClient_byUid($uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findClient_byUid");
        $fr = "UNKNOWN_ERROR";
        
        $gdfab = new gdFindAccountingClient();
        $fr = $gdfab->findAcountingClient_byUid($uid);
        if($fr == "RECORD_IS_FOUND")
        {
            $this->setResult_Record($gdfab->getResult_Record());
            $fr = $this->gdlog()->LogInfoRETURN("RECORD_IS_FOUND");
        }
        else
        {
            $fr = $this->gdlog()->LogInfoRETURN("RECORD_IS_NOT_FOUND");
        }
        
        $this->gdlog()->LogInfoEndFUNCTION("findClient_byUid");
        return $fr;
    }
    
    function updateExistingClientAccount($uid
                                        , $companyname
                                        , $contactname
                                        , $contactemail
                                        , $contactnumber
                                        , $address
                                        , $cfg_country_sdesc
                                        , $cfg_region_sdesc
                                        , $city)
    {
        $this->gdlog()->LogInfoStartFUNCTION("updateExistingClientAccount");
        $fr = "UNKNOWN_ERROR";
        
        $gdfab = new gdFindAccountingClient();
        $fr = $gdfab->findAcountingClient_bySdesc($companyname);
        
        $gdcab = new gdUpdateAccountingClient();
        if($fr == "RECORD_IS_NOT_FOUND")
        {
            $fr = $gdcab->updateRecordClientAccount($uid
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
            $fr = $gdcab->updateRecordClientAccount_noCompanyName($uid
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

        $this->gdlog()->LogInfoEndFUNCTION("updateExistingClientAccount");
        return $fr;
    }
}
?>
    