<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php gdreqonce("/_controls/classes/create/placement_resource_account.php"); ?>
<?php gdreqonce("/_controls/classes/create/placement_resource_profile.php"); ?>
<?php gdreqonce("/_controls/classes/create/search_content.php"); ?>
<?php gdreqonce("/_controls/classes/create/match_placement_resource_account_to_profile.php"); ?>
<?php gdreqonce("/_controls/classes/find/placement_resource_account.php"); ?>
<?php gdreqonce("/_controls/classes/find/_placement_resource_data.php"); ?>
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
class gdResourceData
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
    function createResource($email,
                            $profile_id,
                            $profile_url,
                            $firstname,
                            $lastname)
    {
        $this->gdlog()->LogInfoStartFUNCTION("createResource");
        $fr = "UNKNOWN_ERROR";
        
        $gdcpra = new gdCreatePlacementResourceAccount();
        $fr = $gdcpra->createResourceAccount($email, 
                                            $profile_id,
                                            $profile_url);
        
        $gdcprp = new gdCreatePlacementResourceProfile();
        $fr = $gdcprp->createResourceProfile($firstname,
                                            $lastname);
                                            
        $gdpmratp = new gdCreatePlacementMatchResourceAccounttoProfile();
        $fr = $gdpmratp->createResourceMatchAccounttoProfile($gdcpra->getUid(), $gdcprp->getUid());
                                            
        $gdcsc = new gdCreateSearchContent();
        $gdcsc->createSearchContent($email,
                        "SEARCH_OBJECT_RESOURCE",
                        "match_placement_resource_account_to_profile",
                        $gdpmratp->getUid());
        
        $gdcsc->createSearchContent($firstname ." ". $lastname,
                        "SEARCH_OBJECT_RESOURCE",
                        "match_placement_resource_account_to_profile",
                        $gdpmratp->getUid());
        
        $this->setOutputData("resource_account_uid", $gdcpra->getUid());
        $this->setOutputData("resource_profile_uid", $gdcprp->getUid());
        $this->setOutputData("resource_match_account_to_profile_uid", $gdpmratp->getUid());
        
        if($fr == "RECORD_IS_CREATED")
        {
            $fr = $this->gdlog()->LogInfoRETURN("RECORD_IS_CREATED");
        }
        else
        {
            $fr = $this->gdlog()->LogInfoRETURN("RECORD_IS_NOT_CREATED");
        }

        $this->gdlog()->LogInfoEndFUNCTION("createResource");
        return $fr;
    }

    function findResourceAccount_byEmail($resource_email)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findResource_byEmail");
        $fr = "UNKNOWN_ERROR";
        
        $gdfpra = new gdFindPlacementResourceAccount();
        $fr = $gdfpra->findPlacementRequirementAccount_byEmail($resource_email);

        if($fr == "RECORD_IS_FOUND")
        {
            $this->setResult_Record($gdfpra->getResult_Record());
            $fr = $this->gdlog()->LogInfoRETURN("RECORD_IS_FOUND");
        }
        else
        {
            $fr = $this->gdlog()->LogInfoRETURN("RECORD_IS_NOT_FOUND");
        }

        $this->gdlog()->LogInfoEndFUNCTION("findResource_byEmail");
        return $fr;
    }

    function findResourceAccountandProfile_byAccountUid($resource_account_uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findResourceAccountandProfile_byAccountUid");
        $fr = "UNKNOWN_ERROR";
        
        $gdfprd = new gdFindPlacementResourceData();
        $fr = $gdfprd->findPlacementRequirementAccountandProfile_byAccountUid($resource_account_uid);

        if($fr == "RECORD_IS_FOUND")
        {
            $this->setResult_Record($gdfprd->getResult_Record());
            $fr = $this->gdlog()->LogInfoRETURN("RECORD_IS_FOUND");
        }
        else
        {
            $fr = $this->gdlog()->LogInfoRETURN("RECORD_IS_NOT_FOUND");
        }

        $this->gdlog()->LogInfoEndFUNCTION("findResourceAccountandProfile_byAccountUid");
        return $fr;
    }

    function findResourceAccounts_byRequirementuid($requirement_uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findResourceAccounts_byRequirementuid");
        $fr = "UNKNOWN_ERROR";
        
        $gdfpra = new gdFindPlacementMatchReqtoRestoStatus();
        $fr = $gdfpra->findPlacementRequirementResources($requirement_uid);

        if($fr == "RECORDS_ARE_FOUND")
        {
            $this->setResult_Records($gdfpra->getResult_Records());
            $fr = $this->gdlog()->LogInfoRETURN("RECORDS_ARE_FOUND");
        }
        else
        {
            $fr = $this->gdlog()->LogInfoRETURN("RECORDS_ARE_NOT_FOUND");
        }

        $this->gdlog()->LogInfoEndFUNCTION("findResourceAccounts_byRequirementuid");
        return $fr;
    }
}
?>