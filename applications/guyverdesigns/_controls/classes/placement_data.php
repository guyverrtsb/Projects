<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php gdreqonce("/_controls/classes/find/match_placement_requirement_to_resource_to_cfg_placement_status.php"); ?>
<?php gdreqonce("/_controls/classes/create/match_placement_requirement_to_resource_to_cfg_placement_status.php"); ?>
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
class gdPlacementData
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
    function doesReqResStatusExists($placement_requirement_uid,
                                    $resource_account_uid,
                                    $cfg_placement_status_sdesc)
    {
        $this->gdlog()->LogInfoStartFUNCTION("doesReqResStatusExists");
        $fr = "UNKNOWN_ERROR";

        $gdfpmrrs = new gdFindPlacementMatchReqtoRestoStatus();
        $fr = $gdfpmrrs->findPlacementRequirementsToResourcetoStatus($placement_requirement_uid,
                                                                    $resource_account_uid,
                                                                    $cfg_placement_status_sdesc);
        
        if($fr == "RECORDS_ARE_FOUND")
        {
            $fr = $this->gdlog()->LogInfoRETURN("RECORDS_ARE_FOUND");
        }
        else
        {
            $fr = $this->gdlog()->LogInfoRETURN("RECORDS_ARE_NOT_FOUND");
        }

        $this->gdlog()->LogInfoEndFUNCTION("doesReqResStatusExists");
        return $fr;
    }
    
    function createReqResStatus($placement_requirement_uid,
                                $resource_account_uid,
                                $cfg_placement_status_sdesc)
    {
        $this->gdlog()->LogInfoStartFUNCTION("createReqResStatus");
        $fr = "UNKNOWN_ERROR";

        $gdcpmrrs = new gdCreatePlacementMatchReqtoRestoStatus();
        $fr = $gdcpmrrs->createPlacementRequirementsToResourcetoStatus($placement_requirement_uid,
                                                                    $resource_account_uid,
                                                                    $cfg_placement_status_sdesc);
        
        if($fr == "RECORD_IS_CREATED")
        {
            $fr = $this->gdlog()->LogInfoRETURN("RECORD_IS_CREATED");
        }
        else
        {
            $fr = $this->gdlog()->LogInfoRETURN("RECORD_IS_NOT_CREATED");
        }

        $this->gdlog()->LogInfoEndFUNCTION("createReqResStatus");
        return $fr;
    }
    
    function findReqRes($placement_requirement_uid,
                        $resource_account_uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findReqRes");
        $fr = "UNKNOWN_ERROR";

        $gdfpmrrs = new gdFindPlacementMatchReqtoRestoStatus();
        $fr = $gdfpmrrs->findPlacementRequirementsToResource($placement_requirement_uid,
                                                            $resource_account_uid);
        $this->setResult_Record($gdfpmrrs->getResult_Record());
        
        if($fr == "RECORD_IS_FOUND")
        {
            $fr = $this->gdlog()->LogInfoRETURN("RECORD_IS_FOUND");
        }
        else
        {
            $fr = $this->gdlog()->LogInfoRETURN("RECORD_IS_NOT_FOUND");
        }

        $this->gdlog()->LogInfoEndFUNCTION("findReqRes");
        return $fr;
    }
}
?>