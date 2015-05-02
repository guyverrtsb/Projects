<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/retrieve/merchantaccount.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/create/merchantaccount.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/create/merchantprofile.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/create/match_useraccount_to_merchantaccount_to_merchantrole.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/create/match_merchantaccount_to_merchantprofile.php"); ?>
<?php
/*
* File: user.php
* Author: Stephen Shellenberger
* Copyright: 2015 Stephen Shellenberger
* Date: 2015/02/01
*/
class Merchant
    extends AppSysBaseObject
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
    function createMerchantInfo($useraccount_uid,
                                $companyname_sdesc,
                                $companyname,
                                $officename,
                                $email,
                                $address1,
                                $address2,
                                $address3,
                                $city,
                                $crossappl_configurations_sdesc_region,
                                $crossappl_configurations_sdesc_country,
                                $intldialingcode,
                                $areacode,
                                $prefix,
                                $number,
                                $configurations_sdesc_merchantrole)
    {
        zLog()->LogInfoStartFUNCTION("createMerchantInfo");
        $mr = "NA";

        $ra = new RetrieveMerchantAccount();
        $ra->bySdesc($companyname_sdesc);
        
        if($ra->getSysReturnCode() == "RECORD_IS_NOT_FOUND")
        {
            $ca = new CreateMerchantAccount();
            $ca->full($companyname_sdesc,
                    $companyname);
            
            $cp = new CreateMerchantProfile();
            $cp->full($officename,
                    $email,
                    $address1,
                    $address2,
                    $address3,
                    $city,
                    $crossappl_configurations_sdesc_region,
                    $crossappl_configurations_sdesc_country,
                    $intldialingcode,
                    $areacode,
                    $prefix,
                    $number);

            $matchUser = new CreateMatchUsertoMerchanttoRole();
            $matchUser->full($useraccount_uid, $ca->getUid(), $configurations_sdesc_merchantrole);

            $matchMerchant = new CreateMatchMerchantAccountProfile();
            $matchMerchant->full($ca->getUid(), $cp->getUid());
            
            /* Set Output Data Objects */
            $this->setOutputData("merchantaccount_uid", $ca->getUid());
            $this->setOutputData("merchantaccount_sdesc", $ca->getSdesc());
            $this->setOutputData("merchantaccount_companyname", $ca->getCompanyname());
            
            $mr = zLog()->LogInfoRETURN("MERCHANT_IS_CREATED");
        }
        else if($ra->getSysReturnCode()  == "RECORD_IS_FOUND")
        {
            $mr = zLog()->LogInfoRETURN("MERCHANT_IN_USE");
        }
        
        $this->setSysReturnCode($mr);
        zLog()->LogInfoEndFUNCTION("createMerchantInfo");
    }
    
    /*
     * This Method is used when Creating
     * User Account and User Profile and Matching.
     * This account will be inactive.
     * the Task Control Unique QS will be generated.
     * You may access using the getTaskCountrolQS method
     */
    function deleteMerchantInfo($jsonargs)
    {
        zLog()->LogInfoStartFUNCTION("deleteMerchantInfo");
        
        zLog()->LogInfo("JSON:{".$jsonargs."}");
        $args = json_decode($jsonargs, TRUE);
        
        $ra = new RetrieveMerchantAccount();
        if(isset($args['sdesc']))
        {
            zLog()->LogInfo("sdesc:{".$args['sdesc']."}");
            $ra->bySdescCompanyame($args['sdesc']);
        }
        if(isset($args['uid']))
        {
            zLog()->LogInfo("uid:{".$args['uid']."}");
            $ra->byUid($args['uid']);
        }
        
        $match = new RetreiveMatchMerchantAccountProfile();
        $match->byMerchantaccountUid($ra->getUid());

        $this->setOutputData("merchantaccount_uid", $match->getMerchantaccountUid());
        
        $da = new DeleteMerchantAccount();
        $da->byUid($match->getMerchantaccountUid());
        
        $dp = new DeleteMerchantProfile();
        $dp->byUid($match->getMerchantprofileUid());
        
        $dm = new DeleteMatchMerchantAccountProfile();
        $dm->byUid($match->getUid());

        $this->setSysReturnCode($mr);
        zLog()->LogInfoEndFUNCTION("deleteMerchantInfo");
    }



}
?>