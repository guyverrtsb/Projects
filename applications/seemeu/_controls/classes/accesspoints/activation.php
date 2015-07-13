<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php zReqOnce("/gd.trxn.com/crossapplication/_controls/classes/accesspoints/generateuniquevalue.php"); ?>
<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/retrieve/user.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/retrieve/entity_university.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/create/groupaccount.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/create/groupprofile.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/create/match_group.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/retrieve/group.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/create/personalization.php"); ?>
<?php
class Activation
    extends AppSysBaseObject
{
    function __construct()
    {
    }
    
    function prospect($args)
    {
        zLog()->LogStart_AccessPointFunction("prospect");
        
        $univemaildomain = "groupuniv.com";
        
        $gts = array("GROUP_TYPE-VETTING_UNIVERSITY",   "GROUP_TYPE-SOCIAL",        "GROUP_TYPE-FAMILY");
        $vis = array("GROUP_VISIBILITY-PRIVATE",        "GROUP_VISIBILITY-PRIVATE", "GROUP_VISIBILITY-PRIVATE");
        $ona = array("GROUP_ACCEPT-OWNER_ACCEPT",       "GROUP_ACCEPT-AUTO_ACCEPT", "GROUP_ACCEPT-INVITED_BY_OWNER_AUTO_ACCEPT");
        $dsc = array("University View",                 "My Social",                "Famliy and those close");
        
        /*
         * 1. Retrieve User Data from UID
         * 2. Retrieve Entity University
         * 3. Loop through Groups to Create
         * 4. Generate Unique Group Sdesc
         * 5. Create Group Account
         * 6. Create Group Profile
         *
         */
         
        $userdata = new RetrieveUser();
        $userdata->byUid($args["useraccount_uid"]);
        
        $entityuniversity = new RetrieveEntityUniversity();
        $entityuniversity->byEmaildomain($univemaildomain);

        for($idx = 0; $idx < count($gts); $idx++)
        {
            // Configuration data from Group Type
            $this->findConfigurationfromSdesc($gts[$idx], "APPLICATION");
            $cfg_label = $this->getConfigurationLabel();
            
            // Generate Unique SDESC
            $guvutk = new GenerateUniqueValue();
            $ga_sdesc = $guvutk->generate("APPLICATION", "groupaccount", "sdesc",  "PROSPECT_".$gts[$idx]);
            // Create Group Account
            $cga = new CreateGroupaccount();
            $cga->basic($ga_sdesc,
                $dsc[$idx],
                $gts[$idx],
                $vis[$idx],
                $ona[$idx]);

            if($cga->getSysReturnCode("RECORD_IS_CREATED"))
            {
                // Create Group Profile
                $futureDateOneYear = date('Y-m-d', strtotime('+1 year'));
                // Create Group Profile
                $cgp = new CreateGroupprofile();
                $cgp->basic("This Channel ".$cfg_label." is create by: ".$userdata->getUseraccountNickname().".  Please enjoy.");
                        
                // Create Match Group Account to Group Profile
                $cmgap = new CreateMatchGroup();
                $cmgap->basic($cga->getUid(),
                    $cgp->getUid(),
                    $entityuniversity->getMatchEntitytoUniversityMatchEntityUid(),
                    $userdata->getMatchUserUid(),
                    "GROUP_ROLE-OWNER");
            }
        }

        $group = new RetrieveGroup();
        $group->getGroupsbyEntityUid_Grouptype($entityuniversity->getMatchEntitytoUniversityMatchEntityUid()
                                            , "GROUP_TYPE-ENTITY");
        foreach ($group->getResult_Records() as $row)
        {
            $group->setResult_Record($row);
            // Create Match Group Account to Group Profile
            $cmgap = new CreateMatchGroup();
            $cmgap->basic($group->getMatchGroupGroupaccountUid(),
                        $group->getMatchGroupGroupprofileUid(),
                        $entityuniversity->getMatchEntitytoUniversityMatchEntityUid(),
                        $userdata->getMatchUserUid(),
                        "GROUP_ROLE-USER");
        }

        $cp = new CreatePersonalization();
        $cp->basic($entityuniversity->getMatchEntitytoUniversityMatchEntityUid()
            , $userdata->getMatchUserUid());

        zLog()->LogEnd_AccessPointFunction("prospect");
    }
}
?>