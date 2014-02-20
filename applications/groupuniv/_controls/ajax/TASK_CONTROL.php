<?php require_once("../../gd.trxn.com/_controls/classes/_core.php"); ?>
<?php gdreqonce("/_controls/classes/find/university.php"); ?>
<?php gdreqonce("/_controls/classes/register/university.php"); ?>
<?php gdreqonce("/_controls/classes/match/university.php"); ?>
<?php gdreqonce("/_controls/classes/find/user.php"); ?>
<?php gdreqonce("/_controls/classes/register/user.php"); ?>
<?php gdreqonce("/_controls/classes/match/user.php"); ?>
<?php gdreqonce("/_controls/classes/register/group.php"); ?>
<?php gdreqonce("/_controls/classes/match/group.php"); ?>
<?php gdreqonce("/_controls/classes/find/group.php"); ?>
<?php gdreqonce("/_controls/classes/register/search.php"); ?>
<?php gdreqonce("/_controls/classes/register/wallmessage.php"); ?>
<?php gdreqonce("/_controls/classes/find/taskcontrol.php"); ?>
<?php gdreqonce("/_controls/classes/authenticate.php"); ?>
<?php
if(isset($_GET["GD_CONTROLLER_KEY"]))
{
    $action = filter_var($_GET["GD_CONTROLLER_KEY"], FILTER_SANITIZE_STRING);
    $gdconfig = gdconfig();
    gdlog()->LogInfo("GD_CONTROLLER_KEY{".$action."}");
    if($action == "TASK_CONTROL")
    {
        if(validateTaskForm())
        {
            gdlog()->LogInfoTaskLabel("Task Control Found");
            $alink = filter_var($_GET["activationlink"]);
            gdlog()->LogInfo("activationlink:".$alink);
                        
            $zftc = new zFindTaskControl();
            $r = $zftc->findUid123fromUid($alink);
            gdlog()->LogInfo("findUid123fromUid:".$r);
            if($r == "UID123_FOUND")
            {
                gdlog()->LogInfo("findUid123fromUid:".$zftc->getTaskKey());
                if($zftc->getTaskkey() == "ACTIVATE_USER")
                {
                    $zfuser = new zFindUser();
                    $zfuser->findAccountandProfileByUid($zftc->getRecordUid());
                    
                    $zmuser = new zMatchUser();
                    $r = $zmuser->matchUsertoRoleSdesc($zfuser->getUA_Uid(), "USER_ROLE_SITE_USER");
                    
                    $emailkey = explode("@", $zfuser->getEmail());
                    $emailkey = $emailkey[1];
                    
                    $zfu = new zFindUniversity();
                    $zfu->findAccountandProfileByEmailKey($emailkey);
                    gdconfig()->setUniversityObjects($zfu);
                    
                    // Match University to User to Role
                    $zmuniv = new zMatchUniversity();
                    $r = $zmuniv->matchUniversitytoUsertoRoleSdesc($zfu->getUA_Uid(),
                                                    $zfuser->getUA_Uid(),
                                                    "USER_ROLE_UNIVERSITY_USER");

                    // Match Open University Groups to University Owners
                    $zfgroup = new zFindGroup();
                    $r = $zfgroup->findGroupsByUniversityByTypeByAcceptanceByVisibilitySdesc("GROUP_TYPE_UNIVERSITY", 
                                                    "GROUP_ACCEPT_AUTO_ACCEPT", 
                                                    "GROUP_VISIBILITY_UNIVERSITY_PRIVATE",
                                                    $zfu->getUA_Uid());
                        
                    foreach ($zfgroup->getResults_Groups() as $row)
                    {
                        $zfgroup->setResult_Group($row);
                        $r = $zmuser->matchUsertoGrouptoRoleSdesc($zfuser->getUA_Uid(),
                                                    $zfgroup->getGA_Uid(),
                                                    "USER_ROLE_GROUP_USER");
                    }
                    
                    $zfgroup = new zFindGroup();
                    $r = $zfgroup->findGroupsByUniversityByTypeByAcceptanceByVisibilitySdesc("GROUP_TYPE_UNIVERSITY", 
                                                    "GROUP_ACCEPT_AUTO_ACCEPT", 
                                                    "GROUP_VISIBILITY_UNIVERSITY_PUBLIC",
                                                    $zfu->getUA_Uid());
                        
                    foreach ($zfgroup->getResults_Groups() as $row)
                    {
                        $zfgroup->setResult_Group($row);
                        $r = $zmuser->matchUsertoGrouptoRoleSdesc($zfuser->getUA_Uid(),
                                                    $zfgroup->getGA_Uid(),
                                                    "USER_ROLE_GROUP_USER");
                    }

                    //******* Group for User Families
                    $zrgroup01 = new zRegisterGroup();
                    $r = $zrgroup01->registerGroupAccountSdesc($zfuser->getFName().
                                                    " Family Group at ".$zfu->getSdesc(),
                                                    "GROUP_TYPE_FAMILY", 
                                                    "GROUP_VISIBILITY_GROUP_PRIVATE", 
                                                    "GROUP_ACCEPT_INVITED_BY_OWNER_AUTO_ACCEPT");
                    $r = $zrgroup01->registerGroupProfile("2020-12-31",
                                                    "This group is for ".
                                                    $zfuser->getFName().
                                                    " at ".$zfu->getSdesc().
                                                    " to stay in with with their family.");
                    $zmgroup01 = new zMatchGroup();
                    $r = $zmgroup01->matchGrouptoProfile($zrgroup01->getGA_Uid(),
                                                    $zrgroup01->getGP_Uid());
 
                    $r = $zmuniv->matchUniversitytoGroup($zfu->getUA_Uid(),
                                                    $zrgroup01->getGA_Uid());
                                                    
                    $r = $zmuser->matchUsertoGrouptoRoleSdesc($zfuser->getUA_Uid(),
                                                    $zrgroup01->getGA_Uid(),
                                                    "USER_ROLE_GROUP_OWNER");
                        
                    $zrwallmessage01 = new zRegisterWallMessage();
                    $r = $zrwallmessage01->registerWallMessage($zrgroup01->getGA_Uid(),
                        $zfuser->getUA_Uid(),
                        "This group is for ".$zfuser->getFName()." at ".$zfu->getSdesc()." to stay in with with their family.",
                        "IMAGE_NOT_PROVIDED_FOR_UPLOADED");

                    //******* Group for User Social
                    $zrgroup02 = new zRegisterGroup();
                    $r = $zrgroup02->registerGroupAccountSdesc($zfuser->getFName().
                                                    " Social Group at ".$zfu->getSdesc(),
                                                    "GROUP_TYPE_SOCIAL", 
                                                    "GROUP_VISIBILITY_GROUP_PUBLIC", 
                                                    "GROUP_ACCEPT_OWNER_ACCEPT");
                    $r = $zrgroup02->registerGroupProfile("2020-12-31",
                                                    "This group is for ".$zfuser->getFName()." at ".$zfu->getSdesc()." invite other University Friends to their Social area.");
                                                    
                    $zmgroup02 = new zMatchGroup();
                    $r = $zmgroup02->matchGrouptoProfile($zrgroup02->getGA_Uid(),
                                                    $zrgroup02->getGP_Uid());
 
                    $r = $zmuniv->matchUniversitytoGroup($zfu->getUA_Uid(),
                                                    $zrgroup02->getGA_Uid());
                                                    
                    $r = $zmuser->matchUsertoGrouptoRoleSdesc($zfuser->getUA_Uid(),
                                                    $zrgroup02->getGA_Uid(),
                                                    "USER_ROLE_GROUP_OWNER");
                                                    
                    $zrwallmessage02 = new zRegisterWallMessage();
                    $r = $zrwallmessage02->registerWallMessage($zrgroup02->getGA_Uid(),
                        $zfuser->getUA_Uid(),
                        "This group is for ".$zfuser->getFName()." at ".$zfu->getSdesc()." for college freinds and fellow alumni to stay in touch.",
                        "IMAGE_NOT_PROVIDED_FOR_UPLOADED");
                                                    
                    gdlog()->LogInfoTaskLabel("Add Search for User");
                    $zrsearch = new zRegisterSearchData();
                    $zrsearch->registerSearchSdesc($zfuser->getEmail()
                        , $zfuser->getUA_Uid(), "SEARCH_OBJECT_USER", $zfu->getUA_Uid());
                    $zrsearch->registerKeywordsSdesc($zfuser->getEmail()
                        , $zfuser->getUA_Uid(), "SEARCH_OBJECT_USER", $zfu->getUA_Uid());
                        
                    gdlog()->LogInfoTaskLabel("Add Search for Family Group");
                    $zrsearch = new zRegisterSearchData();
                    $zrsearch->registerSearchSdesc($zrgroup01->getLdesc()." ".$zrgroup01->getContent()
                        , $zrgroup01->getGA_Uid(), "SEARCH_OBJECT_GROUP", $zfu->getUA_Uid());
                    $zrsearch->registerKeywordsSdesc("Family;Home;"
                        , $zrgroup01->getGA_Uid(), "SEARCH_OBJECT_GROUP", $zfu->getUA_Uid());
                        
                    gdlog()->LogInfoTaskLabel("Add Search for Social Group");
                    $zrsearch = new zRegisterSearchData();
                    $zrsearch->registerSearchSdesc($zrgroup02->getLdesc()." ".$zrgroup02->getContent()
                        , $zrgroup02->getGA_Uid(), "SEARCH_OBJECT_GROUP", $zfu->getUA_Uid());
                    $zrsearch->registerKeywordsSdesc("Social;Personal"
                        , $zrgroup02->getGA_Uid(), "SEARCH_OBJECT_GROUP", $zfu->getUA_Uid());
                            
                    gdlog()->LogInfoTaskLabel("Add Search for Wall Message Family Group");
                    $zrsearch = new zRegisterSearchData();
                    $zrsearch->registerSearchSdesc($zrwallmessage01->getWM_Content()
                        , $zrwallmessage01->getWM_Uid(), "SEARCH_OBJECT_WALL_MESSAGE", $zfu->getUA_Uid());
                        
                    gdlog()->LogInfoTaskLabel("Add Search for Wall Message Social Group");
                    $zrsearch = new zRegisterSearchData();
                    $zrsearch->registerSearchSdesc($zrwallmessage02->getWM_Content()
                        , $zrwallmessage02->getWM_Uid(), "SEARCH_OBJECT_WALL_MESSAGE", $zfu->getUA_Uid());
                        

                    $zru = new zRegisterUser();
                    $r = $zru->registerUserAccountActivationSwitch($zfuser->getUA_Uid(), "T");
                    
                    $zru->createUserTables();
                    
                    if($r == "USER_ACCOUNT_ACTIVATION_SWITCHED")
                    {
                        $gdconfig->redirectToLogin(103, $r, "User has been activated", "/siteaccess.php");
                    }
                }
            }
            $gdconfig->cleanUniversitySessionObjects();
            $gdconfig->redirectToLogin(103, $r, "User has not been activated", "/siteaccess.php");
            echo $r;
        }
        else
        {
            echo "FORM_FIELDS_NOT_VALID";
        }
    }
}

function validateTaskForm()
{
    $fv = "T";  // Form is Valid Key T=Valid; anything else is invalid;
    if (!isset($_GET["activationlink"]) || $_GET["activationlink"] == "")
        $fv = "F";
    return $fv;
}
?>