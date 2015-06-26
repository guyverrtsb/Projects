<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php zReqOnce("/gd.trxn.com/crossapplication/_controls/classes/accesspoints/generateuniquevalue.php"); ?>
<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/retrieve/userdata.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/retrieve/universityaccount.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/create/groupaccount.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/create/groupprofile.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/create/match_groupaccount_to_groupprofile.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/create/match_entityaccount_to_groupaccount.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/create/match_usersafety_useraccount_to_groupaccount_to_userrole.php"); ?>
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
        
        $gts = array("GROUP_TYPE-VETTING_UNIVERSITY",   "GROUP_TYPE-SOCIAL",         "GROUP_TYPE-FAMILY");
        $vis = array("GROUP_VISIBILITY-PRIVATE",        "GROUP_VISIBILITY-PRIVATE",  "GROUP_VISIBILITY-PRIVATE");
        $ona = array("GROUP_ACCEPT-OWNER_ACCEPT",       "GROUP_ACCEPT-AUTO_ACCEPT",  "GROUP_ACCEPT-INVITED_BY_OWNER_AUTO_ACCEPT");
        $rol = array("USER_GROUP_ROLE-OWNER",           "USER_GROUP_ROLE-OWNER",     "USER_GROUP_ROLE-OWNER");
        
        /*
         * 1. Retrieve User Data from UID
         * 2. Retrieve University Account for 'www.groupuniv.com'
         * 3. Get Configuration from Group Type
         * 4. Create Group Account  - [groupaccount]
         * 5. Create Group Profile - [groupprofile]
         * 6. Match Group Account to Profile - [match_groupaccount_to_groupprofile]
         * 7. Match User Account to Group Account to User Role - [match_useraccount_to_groupaccount_to_userrole]
         * 8. Match University Account to Group Account - [match_universityaccount_to_groupaccount]
         *
         */
         
        $userdata = new RetrieveUserData();
        $userdata->byUseraccountuid($args["useraccount_uid"]);
        
        $rua = new RetrieveUniversityAccount();
        $rua->byEmaildomain($univemaildomain);

        for($idx = 0; $idx < count($gts); $idx++)
        {
            // Configuration data from Group Type
            $this->findConfigurationfromSdesc($gts[$idx], "APPLICATION");
            $cfg_label = $this->getConfigurationLabel();
            
            // Generate Unique SDESC
            $guvutk = new GenerateUniqueValue();
            $ga_sdesc = $guvutk->generate("APPLICATION", "groupaccount", "sdesc",  "PROSPECT_".$gts[$idx]);
            // Create Group Account
            $cga = new CreateGroupAccount();
            $cga->full($ga_sdesc,
                    "PROSPECT_".$gts[$idx]."_".$vis[$idx]."_".$ona[$idx],
                    $gts[$idx],
                    $vis[$idx],
                    $ona[$idx]);

            if($cga->getSysReturnCode("RECORD_IS_CREATED"))
            {
                // Create Group Profile
                $futureDateOneYear = date('Y-m-d', strtotime('+1 year'));
                // Create Group Profile
                $cgp = new CreateGroupProfile();
                $cgp->full($this->getMySqlDate($futureDateOneYear),
                        "This Channel ".$cfg_label." is create by: ".$userdata->getNickname().".  Please enjoy.");
                        
                // Create Match Group Account to Group Profile
                $cmgap = new CreateMatchGroupAccountProfile();
                $cmgap->full($cga->getUid(), $cgp->getUid());
                
                // Create Match Entity Account to Group Account 
                $cmgaua = new CreateMatchEntityaccounttoGroupaccount();
                $cmgaua->full($rua->getEntityaccountUid(), $cga->getUid());
                
                // Create Match Usersafety User Account to Group Account to Configuration Userrole
                $cmuuagacu = new CreateMatchUsersafetyUseraccountGroupaccounttoUserrole();
                $cmuuagacu->full($userdata->getUAUid(), $cga->getUid(), $rol[$idx]);
            }
        }

        zLog()->LogEnd_AccessPointFunction("prospect");
    }
}
?>