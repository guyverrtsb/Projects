<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php gdreqonce("/_controls/classes/find/placement_requirement.php"); ?>
<?php gdreqonce("/_controls/classes/create/placement_requirement.php"); ?>
<?php gdreqonce("/_controls/classes/create/match_placement_requirement_to_search_word.php"); ?>
<?php gdreqonce("/_controls/classes/create/search_content.php"); ?>
<?php gdreqonce("/gd.trxn.com/usersafety/_controls/classes/userdata.php"); ?>
<?php gdreqonce("/_controls/classes/find/placement_resource_account.php"); ?>
<?php gdreqonce("/_controls/classes/find/match_placement_requirement_to_resource_to_cfg_placement_status.php"); ?>
<?php gdreqonce("/_controls/classes/find/match_placement_requirement_to_search_word.php"); ?>
<?php gdreqonce("/_controls/classes/resource.php"); ?>
<?php gdreqonce("/_controls/classes/placement_data.php"); ?>
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
class gdRequirementData
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
    function createRequirement($title, 
                            $role_desc,
                            $start_date,
                            $end_date,
                            $requested_days,
                            $days_per_week,
                            $is_remote_possible,
                            $company_name,
                            $cfg_country_sdesc,
                            $cfg_region_sdesc,
                            $city,
                            $scope_of_tasks,
                            $comments,
                            $sdesc,
                            $search_words)
    {
        $this->gdlog()->LogInfoStartFUNCTION("createRequirement");
        $fr = "UNKNOWN_ERROR";

        $gdfpr = new gdFindPlacementRequirement();
        $gdfpr->countPlacementRequirements();
        $count = $gdfpr->getRecordCount();
        
        $requirement_number = 700000 + (1 + $count);
        
        $gdcpf = new gdCreatePlacementRequirement();
        $fr = $gdcpf->createRecordRequirement($title, 
                                            $role_desc,
                                            $start_date,
                                            $end_date,
                                            $requested_days,
                                            $days_per_week,
                                            $is_remote_possible,
                                            $company_name,
                                            $cfg_country_sdesc,
                                            $cfg_region_sdesc,
                                            $city,
                                            $scope_of_tasks,
                                            $requirement_number,
                                            $comments,
                                            $sdesc);
        if($fr == "RECORD_IS_CREATED")
        {
            $reqrec = $gdcpf->getResult_Record();
            
            $gdcpmrtsw = new gdCreatePlacementMatchRequirementtoSearchword();
            foreach($search_words as $search_word)
            {
                $search_word = filter_var($search_word, FILTER_SANITIZE_STRING);
                if($search_word != null && $search_word != "")
                {
                    $gdcpmrtsw->createResourceMatchReqtoSearchword($gdcpf->getUid(), $search_word);
                }
            }
            
            $gdcsc = new gdCreateSearchContent();
            $gdcsc->createSearchContent($scope_of_tasks,
                            "SEARCH_OBJECT_REQUIREMENT",
                            "placement_requirement",
                            $gdcpf->getUid());
            
            $gdcsc->createSearchContent($requirement_number,
                            "SEARCH_OBJECT_REQUIREMENT",
                            "placement_requirement",
                            $gdcpf->getUid());

            // Get Email of Logged in User
            $gdud = new gdUserData();
            $gdud->findUserData_byUid(gdconfig()->getAuthUserUid());
            $from_email = $gdud->getResult_RecordField($gdud->dbf("usersafety_useraccount.email"));
            
            $o = "<html>";
            $o .= "<head>";
            $o .= "<title>".$reqrec["requirement_number"]."...".$reqrec["title"]."</title>";
            $o .= "</head>";
            $o .= "<body>";
            $o .= "<div>You have a Requirement created for you.  Please log on to the system to access this req and to start finding resources.</div>";
            $o .= "<br/>";
            $o .= "<div>Req ID : " . $reqrec["requirement_number"] . "</div>";
            $o .= "<div>Description : " . $reqrec["title"] . "</div>";
            $o .= "<br/>";
            $o .= "<div>Role Description : " . $reqrec["role_desc"] . "</div>";
            $o .= "<div>Planned Start Data : " . $reqrec["start_date"] . "</div>";
            $o .= "<div>Planned End Date : " . $reqrec["end_date"] . "</div>";
            $o .= "<div>Requested Days : " . $reqrec["requested_days"] . "</div>";
            $o .= "<div>Days per Week : " . ($reqrec["days_per_week"] + 1) . "</div>";
            $o .= "<br/>";
            if($reqrec["is_remote_possible"] == "0")
                $o .= "<div>Work Type : " . "On-Site Only" . "</div>";
            else if($reqrec["is_remote_possible"] == "1")
                $o .= "<div>Work Type : " . "Remote" . "</div>";
            else if($reqrec["is_remote_possible"] == "2")
                $o .= "<div>Work Type : " . "Remote and On-Site" . "</div>";
            else if($reqrec["is_remote_possible"] == "3")
                $o .= "<div>Work Type : " . "Possible Remote" . "</div>";
            $o .= "<div>Location : " . $reqrec["city"] . "</div>";
            
            $this->findConfigurationfromSdesc($reqrec["cfg_country_sdesc"]);
            $cfg_defaults_country = $this->getConfigurationLabel();
            $this->findConfigurationfromSdesc($reqrec["cfg_region_sdesc"]);
            $cfg_defaults_region = $this->getConfigurationLabel();
            
            $o .= "<div>Region : " . $cfg_defaults_region . ", " . $cfg_defaults_country . "</div>";
            $o .= "<br/>";
            $o .= "<div>Scope of Tasks : " . "</div>";
            $o .= "<div>" . $reqrec["scope_of_tasks"] . "</div>";
            $o .= "<br/>";
            $o .= "<div>Comments :" . "</div>";
            $o .= "<div>" . $reqrec["comments"] . "</div>";
            $o .= "<br/>";
            
            $gdfpmrtsw = new gdFindPlacementMatchRequirementtoSearchword();
            $frsw = $gdfpmrtsw->findResourceMatchReqtoSearchword_byPlacementrequirementuid($gdcpf->getUid());
            if($frsw == "RECORDS_ARE_FOUND")
            {
                $o .= "<div>Search Terms:</div>";
                $recs_searchwords = $gdfpmrtsw->getResult_Records();
                foreach($recs_searchwords as $rec_sw)
                {
                    $o .= "<div>&nbsp;&nbsp;&nbsp;&nbsp;" . $rec_sw["search_word"] . "</div>";
                }
            }

            $o .= "<br/>";
            $o .= "<div>Click to Work Requirement {".
                "<a href=\""."http://".gdconfig()->getSiteAlias().
                "/_controls/ajax/PAGE_DIRECT.php?GD_CONTROL_KEY=REQUIREMENT_TO_RESOURCE&placement_requirement_uid=" . $reqrec["uid"] . "\">".
                $reqrec["requirement_number"] . "</a>".
                "}</div>";
            $o .= "</body>";
            $o .= "</html>";
            
            $this->gdlog()->LogInfo($o);
            
            if(!gdconfig()->isLandscapeLocal())
            {
                $this->sendmail("tiffany@guyverdesigns.com",
                                $from_email,
                                "You have a new Posting -- ".$reqrec["requirement_number"]."...".$reqrec["title"],
                                $o);
            }
            
            $fr = $this->gdlog()->LogInfoRETURN("DATA_IS_CREATED");
        }
        else
        {
            $fr = $this->gdlog()->LogInfoRETURN("DATA_IS_NOT_CREATED");
        }

        $this->gdlog()->LogInfoEndFUNCTION("createRequirement");
        return $fr;
    }
    
    function findRequirementList()
    {
        $this->gdlog()->LogInfoStartFUNCTION("findRequirementList");
        $fr = "UNKNOWN_ERROR";
        
        $gdfpr = new gdFindPlacementRequirement();
        $fr = $gdfpr->findPlacementRequirements();
        if($fr == "RECORDS_ARE_FOUND")
        {
            $this->setResult_Records($gdfpr->getResult_Records());
            $fr = $this->gdlog()->LogInfoRETURN("RECORDS_ARE_FOUND");
        }
        else
        {
            $fr = $this->gdlog()->LogInfoRETURN("RECORDS_ARE_NOT_FOUND");
        }
        
        $this->gdlog()->LogInfoEndFUNCTION("findRequirementList");
        return $fr;

    }
    
    function findRequirement_byUid($uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findRequirement_byUid");
        $fr = "UNKNOWN_ERROR";
        
        $gdfpr = new gdFindPlacementRequirement();
        $fr = $gdfpr->findPlacementRequirement_byUid($uid);
        if($fr == "RECORD_IS_FOUND")
        {
            $this->setResult_Record($gdfpr->getResult_Record());
            $fr = $this->gdlog()->LogInfoRETURN("RECORD_IS_FOUND");
        }
        else
        {
            $fr = $this->gdlog()->LogInfoRETURN("RECORD_IS_NOT_FOUND");
        }
        
        $this->gdlog()->LogInfoEndFUNCTION("findRequirement_byUid");
        return $fr;

    }
    
    function findRequirement_bySdesc($sdesc)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findRequirement_bySdesc");
        $fr = "UNKNOWN_ERROR";
        
        $gdfpr = new gdFindPlacementRequirement();
        $fr = $gdfpr->findPlacementRequirement_bySdesc(strtoupper(trim(filter_var($_POST["title"], FILTER_SANITIZE_STRING))));
        if($fr == "RECORD_IS_FOUND")
        {
            $this->setResult_Record($gdfpr->getResult_Record());
            $fr = $this->gdlog()->LogInfoRETURN("RECORD_IS_FOUND");
        }
        else
        {
            $fr = $this->gdlog()->LogInfoRETURN("RECORD_IS_NOT_FOUND");
        }
        
        $this->gdlog()->LogInfoEndFUNCTION("findRequirement_bySdesc");
        return $fr;

    }

    function sendRequirementtoResource($resource_email,
                                    $firstname,
                                    $lastname,
                                    $profile_id,
                                    $profile_url,
                                    $placement_requirement_uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("sendRequirementtoResource");
        $fr = "UNKNOWN_ERROR";
        
        $resource_account_uid = "";
        
        $gdrd = new gdResourceData();
        // Find Resource account by Email
        $fr = $gdrd->findResourceAccount_byEmail($resource_email);
        // Does EMail Account Exists - 
        if($fr == "RECORD_IS_FOUND")
        {
            $resource_account_uid = $gdrd->getResult_RecordField("uid");
        }
        else if($fr == "RECORD_IS_NOT_FOUND")
        {
            // Create Resource Account
            $gdrd->createResource($resource_email, $profile_id, $profile_url, $firstname, $lastname);
            $resource_account_uid = $gdrd->getOutputData("resource_account_uid");
        }
        
        $gdpd = new gdPlacementData();
        $fr = $gdpd->findReqRes($placement_requirement_uid,
                                $resource_account_uid);
                                
        if($fr == "RECORD_IS_FOUND")
        {
            $cfg_placement_status_sdesc = $gdpd->getResult_RecordField("cfg_placement_status_sdesc");
            if($cfg_placement_status_sdesc == "PLACEMENT_STATUS_REQSENT")
                $fr = "REQ_HAS_BEEN_EMAILED_PREVIOUSLY";
            else
                $fr = "RESOURCE_IS_IN_PIPELINE";
        }
        else
        {
            $fr = $gdpd->createReqResStatus($placement_requirement_uid,
                                            $resource_account_uid,
                                            "PLACEMENT_STATUS_REQSENT");
            if($fr == "RECORD_IS_CREATED")
            {
                $this->findRequirement_byUid($placement_requirement_uid);
                $reqrec = $this->getResult_Record();
                
                // Get Email of Logged in User
                $gdud = new gdUserData();
                $gdud->findUserData_byUid(gdconfig()->getAuthUserUid());
                $from_email = $gdud->getResult_RecordField($gdud->dbf("usersafety_useraccount.email"));
                
                $o = "<html>";
                $o .= "<head>";
                $o .= "<title>".$reqrec["requirement_number"]."...".$reqrec["title"]."</title>";
                $o .= "</head>";
                $o .= "<body>";
                $o .= "<div>Req ID : " . $reqrec["requirement_number"] . "</div>";
                $o .= "<div>Description : " . $reqrec["title"] . "</div>";
                $o .= "<br/>";
                $o .= "<div>Role Description : " . $reqrec["role_desc"] . "</div>";
                $o .= "<div>Planned Start Data : " . $reqrec["start_date"] . "</div>";
                $o .= "<div>Planned End Date : " . $reqrec["end_date"] . "</div>";
                $o .= "<div>Requested Days : " . $reqrec["requested_days"] . "</div>";
                $o .= "<div>Days per Week : " . ($reqrec["days_per_week"] + 1) . "</div>";
                $o .= "<br/>";
                if($reqrec["is_remote_possible"] == "0")
                    $o .= "<div>Work Type : " . "On-Site Only" . "</div>";
                else if($reqrec["is_remote_possible"] == "1")
                    $o .= "<div>Work Type : " . "Remote" . "</div>";
                else if($reqrec["is_remote_possible"] == "2")
                    $o .= "<div>Work Type : " . "Remote and On-Site" . "</div>";
                else if($reqrec["is_remote_possible"] == "3")
                    $o .= "<div>Work Type : " . "Possible Remote" . "</div>";
                $o .= "<div>Location : " . $reqrec["city"] . "</div>";
                $o .= "<div>Region : " . $reqrec["cfg_defaults_region"] . ", " . $reqrec["cfg_defaults_country"] . "</div>";
                $o .= "<br/>";
                $o .= "<div>Scope of Tasks : " . "</div>";
                $o .= "<div>" . $reqrec["scope_of_tasks"] . "</div>";
                $o .= "<br/>";
                $o .= "<div>Comments :" . "</div>";
                $o .= "<div>" . $reqrec["comments"] . "</div>";
                $o .= "</body>";
                $o .= "</html>";
                
                $this->gdlog()->LogInfo($o);
                
                if(!gdconfig()->isLandscapeLocal())
                {
                    $this->sendmail($resource_email,
                                    $from_email,
                                    $reqrec["requirement_number"]."...".$reqrec["title"],
                                    $o);
                }
                
                $fr = $this->gdlog()->LogInfoRETURN("RECORD_IS_CREATED");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("RECORD_IS_NOT_CREATED");
            }
        }
        $this->gdlog()->LogInfoEndFUNCTION("sendRequirementtoResource");
        return $fr;
    }

    function findRequirements_byResourceAccountuid($resource_account_uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findRequirements_byResourceAccountuid");
        $fr = "UNKNOWN_ERROR";
        
        $gdfpra = new gdFindPlacementMatchReqtoRestoStatus();
        $fr = $gdfpra->findPlacementRequirements_byResourceAccountUid($resource_account_uid);

        if($fr == "RECORDS_ARE_FOUND")
        {
            $this->setResult_Records($gdfpra->getResult_Records());
            $fr = $this->gdlog()->LogInfoRETURN("RECORDS_ARE_FOUND");
        }
        else
        {
            $fr = $this->gdlog()->LogInfoRETURN("RECORDS_ARE_NOT_FOUND");
        }

        $this->gdlog()->LogInfoEndFUNCTION("findRequirements_byResourceAccountuid");
        return $fr;
    }
}
?>