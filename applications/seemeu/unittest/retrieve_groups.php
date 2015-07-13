<?php require_once("../gd.trxn.com/_controls/classes/_syscore.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/retrieve/group.php"); ?>
<?php
/*
* File: user.php
* Author: Stephen Shellenberger
* Copyright: 2015 Stephen Shellenberger
* Date: 2015/02/01
*/
        $group = new RetrieveGroup();
        $group->getGroupsbyEntityUid_Grouptype("8868a3f6-259b-11e5-a0e7-b0a427d6bb28"
                                            , "GROUP_TYPE-ENTITY");
        foreach ($group->getResult_Records() as $row)
        {
            $group->setResult_Record($row);
            zLog()->LogInfo("GA[".$group->getMatchGroupGroupaccountUid()."]");
            zLog()->LogInfo("GP[".$group->getMatchGroupGroupprofileUid()."]");
            // Create Match Group Account to Group Profile
            /*
            $cmgap = new CreateMatchGroup();
            $cmgap->basic($group->getMatchGroupGroupaccountUid(),
                        $group->getMatchGroupGroupprofileUid(),
                        $entityuniversity->getMatchEntitytoUniversityMatchEntityUid(),
                        $userdata->getMatchUserUid(),
                        "GROUP_ROLE-USER");
             * 
             */
        }
?>