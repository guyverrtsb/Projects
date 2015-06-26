<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/create/match_merchantaccount_to_object.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/create/object.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/delete/match_merchantaccount_to_object.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/delete/object.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/retrieve/merchantaccount.php"); ?>
<?php zReqOnce("/gd.trxn.com/crossapplication/_controls/classes/dataobjects/retrieve/unique.php"); ?>
<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/retrieve/useraccount.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/retrieve/match_useraccount_to_gameraccount_to_gamerprofile.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/retrieve/match_gameraccount_to_object.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/create/match_gameraccount_to_object.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/retrieve/object.php"); ?>

<?php
/*
* File: user.php
* Author: Stephen Shellenberger
* Copyright: 2015 Stephen Shellenberger
* Date: 2015/02/01
*/
class Object
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
    function assignObjecttoMerchant($jsonargs)
    {
        zLog()->LogStart_AccessPointFunction("loadObjects");
        $mr = "NA";

        zLog()->LogDebug("JSON:{".$jsonargs."}");

        $objectTypes = json_decode($jsonargs, TRUE);
        foreach ($objectTypes as $type => $objects)
        {
            foreach ($objects as $recidx => $cstics)
            {
                $cu = new CountUnique();
                $cu->countUniqueFieldValue("APPLICATION", "object", "sdesc", $cstics["sdesc"]);
                
                if($cu->getNumofRecords() == 0)
                {
                    $co = new CreateObject();
                    $co->full($cstics["sdesc"],
                            $cstics["ldesc"],
                            $cstics["nickname"],
                            $cstics["icon"],
                            $cstics["detectionrange"],
                            $cstics["effectiverange"],
                            $cstics["configurations_sdesc_objecttype"],
                            $cstics["configurations_sdesc_paymenttype"]);
                    
                    $rma = new RetrieveMerchantAccount();
                    $rma->bySdesc($cstics["merchantaccount_sdesc"]);
                    if($rma->getSysReturnCode() == "RECORD_IS_FOUND")
                    {
                        $match = new CreateMatchMerchantAccounttoObject();
                        $match->full($rma->getUid(), $co->getUid());
                        
                        $mr = zLog()->LogReturn("COMPLETED_SUCCESSFULLY");
                    }
                    else
                    {
                        $mr = zLog()->LogReturn("MERCHANT_NOT_FOUND");                     
                    }
                }
            }
        }

        $this->setSysReturnCode($mr);
        zLog()->LogEnd_AccessPointFunction("loadObjects");
    }
    
    function assignObjectToGamer($gameraccount_email,
                                $object_sdesc)
    {
        zLog()->LogStart_AccessPointFunction("assignObjectToGamer");
        $mr = "NA";
        
        // Get User Account from EMail
        $user = new RetrieveUserAccount();
        $user->byEmail($gameraccount_email);
        
        if($user->getSysReturnCode() == "RECORD_IS_FOUND")
        {
            $useraccount_uid = $user->getUid();
            // Retrieve the Match Record using the UserAccountUid for the Gamer Uid
            $rmusgap = new RetrieveMatchUserAccounttoGamerAccountProfile();
            $rmusgap->byUseraccountUid($useraccount_uid);

            // Retrieve the Object from the sdesc
            $object = new RetrieveObject();
            $object->bySdesc($object_sdesc);
            if($object->getSysReturnCode() == "RECORD_IS_FOUND")            
            {
                // Check if the Gamer has already added the Object
                $rmgao = new RetrieveMatchGamerAccounttoObject();
                $rmgao->byGamerAccountUidandObjectUid($rmusgap->getGameraccountUid(), $object->getUid());
                if($rmgao->getSysReturnCode() == "RECORD_IS_NOT_FOUND")
                {
                    // Assign the Object to the Gamer
                    $cmgao = new CreateMatchGamerAccounttoObject();
                    $cmgao->full($rmusgap->getGameraccountUid(), $object->getUid());
                    
                    $mr = zLog()->LogReturn("GAMER_ASSIGNED_TO_OBJECT");
                }
                else
                {
                    $mr = zLog()->LogReturn("GAMER_IS_ALREADY_ASSIGNED_TO_OBJECT");
                }
            }
            else
            {
                $mr = zLog()->LogReturn("OBJECT_NOT_FOUND");
            }
        }
        else
        {
            $mr = zLog()->LogReturn("EMAIL_NOT_FOUND");
        }
        
        $this->setSysReturnCode($mr);
        zLog()->LogEnd_AccessPointFunction("assignObjectToGamer");
    }
    
    /*
     * This Method is used when Creating
     * User Account and User Profile and Matching.
     * This account will be inactive.
     * the Task Control Unique QS will be generated.
     * You may access using the getTaskCountrolQS method
     */
    function deleteObjects($jsonobjects)
    {
        zLog()->LogStart_AccessPointFunction("deleteObjects");
        $mr = "NA";
        
        $co = null;
        $match = null;
        zLog()->LogDebug("JSON:{".$jsonobjects."}");

        $objectTypes = json_decode($jsonobjects, TRUE);
        foreach ($objectTypes as $type => $objects)
        {
            foreach ($objects as $recidx => $cstics)
            {
                $co = new DeleteHazard();
                $co->bySdesc($cstics["sdesc"]);
                        
                $match = new DeleteMatchMerchantAccounttoObject();
                $match->byMerchantaccountUid($cstics["merchantaccount_uid"]);
            }
        }

        if($co->getSysReturnCode()  == "RECORD_IS_CREATED")
            $mr = zLog()->LogReturn("COMPLETED_SUCCESSFULLY");
        else
            $mr = zLog()->LogReturn("FAILURE");

        $this->setSysReturnCode($mr);
        zLog()->LogEnd_AccessPointFunction("deleteObjects");
    }
}
?>