<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/retrieve/groupaccount.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/create/groupaccount.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/create/groupprofile.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/create/match_groupaccount_to_groupprofile.php"); ?>
<?php
/*
* File: user.php
* Author: Stephen Shellenberger
* Copyright: 2015 Stephen Shellenberger
* Date: 2015/02/01
*/
class Group
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
    function createGroupInfo($sdesc,
                            $configurations_sdesc_grouptype,
                            $configurations_sdesc_groupvisibility,
                            $configurations_sdesc_groupaccept,
                            $validtodate,
                            $description,
                            $mantra,
                            $objectives)
    {
        zLog()->LogInfoStartFUNCTION("createGroupInfo");
        $mr = "NA";
        
        $ra = new RetrieveGroupAccount();
        $ra->bySdesc($sdesc);
        
        if($ra->getSysReturnCode() == "RECORD_IS_NOT_FOUND")
        {
            $ca = new CreateGroupAccount();
            $ca->full($sdesc,
                    $configurations_sdesc_grouptype,
                    $configurations_sdesc_groupvisibility,
                    $configurations_sdesc_groupaccept);
            
            $cp = new CreateGroupProfile();
            $cp->full($validtodate,
                    $description,
                    $mantra,
                    $objectives);

            $match = new CreateMatchGroupAccountProfile();
            $match->full($ca->getUid(), $cp->getUid());

            $mr = zLog()->LogInfoRETURN("DATA_IS_CREATED");
        }
        else if($tr == "RECORD_IS_FOUND")
        {
            $mr = zLog()->LogInfoRETURN("EMAIL_IN_USE");
        }
        
        $this->setSysReturnCode($mr);
        zLog()->LogInfoEndFUNCTION("createGroupInfo");
    }
}
?>