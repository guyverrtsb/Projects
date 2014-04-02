<?php require_once("../../gd.trxn.com/_controls/classes/_core.php"); ?>
<?php gdreqonce("/_controls/classes/find/university.php"); ?>
<?php gdreqonce("/_controls/classes/register/university.php"); ?>
<?php gdreqonce("/_controls/classes/match/university.php"); ?>
<?php gdreqonce("/_controls/classes/register/user.php"); ?>
<?php gdreqonce("/_controls/classes/match/user.php"); ?>
<?php gdreqonce("/_controls/classes/register/group.php"); ?>
<?php gdreqonce("/_controls/classes/match/group.php"); ?>
<?php gdreqonce("/_controls/classes/find/group.php"); ?>
<?php gdreqonce("/_controls/classes/register/wallmessage.php"); ?>
<?php gdreqonce("/_controls/classes/register/search.php"); ?>
<?php
$echoret = "";
$action = getControlKey();
if($action != "INVALID")
{
    $gdconfig = gdconfig();
    if($action == "REGISTER_UNIVERSITY")
    {
        if(validateRegisterForm())
        {
            $edu = explode(".", $_POST["univ_emailkey"]);
            if(strtoupper($edu[1]) == "EDU")
            {
                gdlog()->LogInfoTaskLabel("Create University Form is Valid");
                // University Section
                $zfuniv = new zFindUniversity();
                $r = $zfuniv->findAccountandProfileByEmailKey($_POST["univ_emailkey"]);
                if($r  == "ACCOUNT_NOT_FOUND")
                {
                    /** ************************ Registration of Accounts */
                    gdlog()->LogInfoTaskLabel("Create of University Information");
                    $zruniv = new zRegisterUniversity();
                    $r = $zruniv->registerUniversityAccount($_POST["univ_emailkey"],
                                                        $_POST["univ_sdesc"]);
                    $r = $zruniv->registerUnversityProfile($_POST["univ_city"], 
                                                        $_POST["univ_region"], 
                                                        $_POST["univ_country"], 
                                                        "1875-12-31", 
                                                        $_POST["univ_name"], 
                                                        $_POST["univ_name"]);
                    $zmuniv = new zMatchUniversity();
                    $r = $zmuniv->matchUniversitytoProfile($zruniv->getUA_Uid(), 
                                                        $zruniv->getUP_Uid());
    
                    $gdconfig->setUniversityObjects($zruniv);
                    $zruniv->createUniversityTables();
                    
                    gdlog()->LogInfoTaskLabel("Create of User Information President");
                    $r = $zruserPres = new zRegisterUser();
                    $r = $zruserPres->registerUserAccount("president.".$zruniv->getSdesc()."@".$_POST["univ_emailkey"], 
                                                    "abcd1234",
                                                    $zruniv->getSdesc()."PREZ");
                    $r = $zruserPres->registerUserProfile("Univ", "President", 
                                                        $zruniv->getCity(), 
                                                        $_POST["univ_region"], 
                                                        $_POST["univ_country"], 
                                                        "President");
                    $zruserPres->createUserTables($zruserPres->getUserTableKey());
    
                    $zmuserPres = new zMatchUser();
                    $r = $zmuserPres->matchUsertoProfile($zruserPres->getUA_Uid(),
                                                        $zruserPres->getUP_Uid());
                    $r = $zmuserPres->matchUsertoRoleSdesc($zruserPres->getUA_Uid(), "USER_ROLE_SITE_USER");
                    $r = $zmuniv->matchUniversitytoUsertoRoleSdesc($zruniv->getUA_Uid(),
                                                        $zruserPres->getUA_Uid(),
                                                        "USER_ROLE_UNIVERSITY_OWNER");
                                                        
                    gdlog()->LogInfoTaskLabel("Create of User Information Vice-President");
                    $r = $zruserVicePres = new zRegisterUser();
                    $r = $zruserVicePres->registerUserAccount("vicepresident.".$zruniv->getSdesc()."@".$_POST["univ_emailkey"], 
                                                        "abcd1234",
                                                        $zruniv->getSdesc()."VPREZ");
                    $r = $zruserVicePres->registerUserProfile("Univ", "Vice President", 
                                                        $zruniv->getCity(), 
                                                        $_POST["univ_region"], 
                                                        $_POST["univ_country"], 
                                                        "Vice President");
                    $zruserVicePres->createUserTables($zruserVicePres->getUserTableKey());
    
                    $zmuserVicePres = new zMatchUser();
                    $r = $zmuserVicePres->matchUsertoProfile($zruserVicePres->getUA_Uid(),
                                                        $zruserVicePres->getUP_Uid());
                    $r = $zmuserVicePres->matchUsertoRoleSdesc($zruserPres->getUA_Uid(), "USER_ROLE_SITE_USER");
                    $r = $zmuniv->matchUniversitytoUsertoRoleSdesc($zruniv->getUA_Uid(),
                                                        $zruserVicePres->getUA_Uid(),
                                                        "USER_ROLE_UNIVERSITY_USER");
    
                    gdlog()->LogInfoTaskLabel("Create of Group University Home");
                    $zrgroup01 = new zRegisterGroup();
                    $r = $zrgroup01->registerGroupAccountSdesc($zruniv->getSdesc()." University Home",
                                                        "GROUP_TYPE_UNIVERSITY", 
                                                        "GROUP_VISIBILITY_UNIVERSITY_PUBLIC", 
                                                        "GROUP_ACCEPT_AUTO_ACCEPT");
                    $r = $zrgroup01->registerGroupProfile("2020-12-31",
                                                        "Share you Experinces and Views with your ".$zruniv->getSdesc()." University family.");
                    $zmgroup01 = new zMatchGroup();
                    $r = $zmgroup01->matchGrouptoProfile($zrgroup01->getGA_Uid(), $zrgroup01->getGP_Uid());
                    $r = $zmuniv->matchUniversitytoGroup($zruniv->getUA_Uid(),
                                                        $zrgroup01->getGA_Uid());
    
                    gdlog()->LogInfoTaskLabel("Create of Group University Wall and Voice");
                    $zrgroup02 = new zRegisterGroup();
                    $r = $zrgroup02->registerGroupAccountSdesc("University Wall and Voice",
                                                        "GROUP_TYPE_UNIVERSITY", 
                                                        "GROUP_VISIBILITY_UNIVERSITY_PRIVATE", 
                                                        "GROUP_ACCEPT_AUTO_ACCEPT");
                    $r = $zrgroup02->registerGroupProfile("2020-12-31",
                                                        "Your voice is heard loud and clear ".
                                                        "in this open group for all those part of the ".$zruniv->getSdesc()." University family.");
                    $zmgroup02 = new zMatchGroup();
                    $r = $zmgroup02->matchGrouptoProfile($zrgroup02->getGA_Uid(), $zrgroup02->getGP_Uid());
                    $r = $zmuniv->matchUniversitytoGroup($zruniv->getUA_Uid(),
                                                        $zrgroup02->getGA_Uid());
                    
                    gdlog()->LogInfoTaskLabel("Assign President and Vice-President to University Home Group as Owner");
                    $zfgroup = new zFindGroup();
                    $r = $zfgroup->findGroupsByUniversityByTypeByAcceptanceByVisibilitySdesc("GROUP_TYPE_UNIVERSITY", 
                                                        "GROUP_ACCEPT_AUTO_ACCEPT", 
                                                        "GROUP_VISIBILITY_UNIVERSITY_PUBLIC",
                                                        $zruniv->getUA_Uid());
                    foreach ($zfgroup->getResults_Groups() as $row)
                    {
                        $zfgroup->setResult_Group($row);
                        $r = $zmuserPres->matchUsertoGrouptoRoleSdesc($zruserPres->getUA_Uid(),
                                                        $zfgroup->getGA_Uid(),
                                                        "USER_ROLE_GROUP_USER");
                        $r = $zmuserVicePres->matchUsertoGrouptoRoleSdesc($zruserVicePres->getUA_Uid(),
                                                        $zfgroup->getGA_Uid(),
                                                        "USER_ROLE_GROUP_USER");
                    }
                    
                    gdlog()->LogInfoTaskLabel("Assign President and Vice-President to University Wall and Voice Group as Owner");
                    $zfgroup = new zFindGroup();
                    $r = $zfgroup->findGroupsByUniversityByTypeByAcceptanceByVisibilitySdesc("GROUP_TYPE_UNIVERSITY", 
                                                        "GROUP_ACCEPT_AUTO_ACCEPT", 
                                                        "GROUP_VISIBILITY_UNIVERSITY_PRIVATE",
                                                        $zruniv->getUA_Uid());
                    foreach ($zfgroup->getResults_Groups() as $row)
                    {
                        $zfgroup->setResult_Group($row);
                        $r = $zmuserPres->matchUsertoGrouptoRoleSdesc($zruserPres->getUA_Uid(),
                                                        $zfgroup->getGA_Uid(),
                                                        "USER_ROLE_GROUP_OWNER");
                        $r = $zmuserVicePres->matchUsertoGrouptoRoleSdesc($zruserVicePres->getUA_Uid(),
                                                        $zfgroup->getGA_Uid(),
                                                        "USER_ROLE_GROUP_OWNER");
                    }
                    
                    gdlog()->LogInfoTaskLabel("Add Wall Message to University Home Group");
                    $wallmessagecontentHomeGroup = "Welcome to the ".$zruniv->getSdesc()." Home Group.  ".
                        "Use this group to share school related information with your fellow ".
                        "students. We hope you find this group useful and productive.  Please ".
                        "do not forget that you ahve the power to make your school more ".
                        "powerful by creating your own groups. Have fun and stay in active ".
                        "your fellow alumni.";
                    $zrwallmessageHomeGroup = new zRegisterWallMessage();
                    $r = $zrwallmessageHomeGroup->registerWallMessage($zrgroup01->getGA_Uid(),
                        $zruserPres->getUA_Uid(),
                        $wallmessagecontentHomeGroup, 
                        "IMAGE_NOT_PROVIDED_FOR_UPLOADED");
                    
                    gdlog()->LogInfoTaskLabel("Add Wall Message to University Wall and Voice Group");
                    $wallmessagecontentVoiceGroup = "Welcome to the ".$zruniv->getSdesc()." Wall. ".
                        "This is the place to share posting and friends about your life ".
                        "and experiences around school. Share your thoughts, pictures ".
                        "and ideas with your fellow fellow students and alumni. Here is ".
                        "where we hope the color and culture of the school will come our.  ".
                        "Please do not forget that you have the power to make your school ".
                        "more powerful by creating your own groups. Have fun and stay in ".
                        "active your fellow alumni.";
                    $zrwallmessageVoiceGroup = new zRegisterWallMessage();
                    $r = $zrwallmessageVoiceGroup->registerWallMessage($zrgroup02->getGA_Uid(),
                        $zruserPres->getUA_Uid(),
                        $wallmessagecontentVoiceGroup,
                        "IMAGE_NOT_PROVIDED_FOR_UPLOADED");
                        
                    gdlog()->LogInfoTaskLabel("Add Search for University Account");
                    $zrsearch = new zRegisterSearchData();
                    $zrsearch->registerSearchSdesc($zruniv->getSdesc()." ".$zruniv->getName()." ".$zruniv->getContent()
                        , $zruniv->getUA_Uid(), "SEARCH_OBJECT_UNIVERSITY", $zruniv->getUA_Uid());
                    $zrsearch->registerKeywordsSdesc($zruniv->getSdesc().";".$zruniv->getEmailkey().";".$zruniv->getName().";".$zruniv->getCity().";".$_POST["univ_region"].";".$_POST["univ_country"].";"
                        , $zruniv->getUA_Uid(), "SEARCH_OBJECT_UNIVERSITY", $zruniv->getUA_Uid());
                        
                    gdlog()->LogInfoTaskLabel("Add Search for University Home Group");
                    $zrsearch = new zRegisterSearchData();
                    $zrsearch->registerSearchSdesc($zrgroup01->getLdesc()." ".$zrgroup01->getContent()
                        , $zrgroup01->getGA_Uid(), "SEARCH_OBJECT_GROUP", $zruniv->getUA_Uid());
                    $zrsearch->registerKeywordsSdesc("Main;Home;Campus;Quad"
                        , $zrgroup01->getGA_Uid(), "SEARCH_OBJECT_GROUP", $zruniv->getUA_Uid());
                        
                    gdlog()->LogInfoTaskLabel("Add Search for University Wall and Voice Group");
                    $zrsearch = new zRegisterSearchData();
                    $zrsearch->registerSearchSdesc($zrgroup02->getLdesc()." ".$zrgroup02->getContent()
                        , $zrgroup02->getGA_Uid(), "SEARCH_OBJECT_GROUP", $zruniv->getUA_Uid());
                    $zrsearch->registerKeywordsSdesc("Wall;Voice"
                        , $zrgroup02->getGA_Uid(), "SEARCH_OBJECT_GROUP", $zruniv->getUA_Uid());
    
                    gdlog()->LogInfoTaskLabel("Add Search for Wall Message Home Group");
                    $zrsearch = new zRegisterSearchData();
                    $zrsearch->registerSearchSdesc($zrwallmessageHomeGroup->getWM_Content()
                        , $zrwallmessageHomeGroup->getWM_Uid(), "SEARCH_OBJECT_WALL_MESSAGE", $zruniv->getUA_Uid());
    
                    gdlog()->LogInfoTaskLabel("Add Search for Wall Message Voice Group");
                    $zrsearch = new zRegisterSearchData();
                    $zrsearch->registerSearchSdesc($zrwallmessageVoiceGroup->getWM_Content()
                        , $zrwallmessageVoiceGroup->getWM_Uid(), "SEARCH_OBJECT_WALL_MESSAGE", $zruniv->getUA_Uid());
    
                    gdlog()->LogInfoTaskLabel("Add Search for President User");
                    $zrsearch = new zRegisterSearchData();
                    $zrsearch->registerSearchSdesc($zruserPres->getEmail()
                        , $zruserPres->getUA_Uid(), "SEARCH_OBJECT_USER", $zruniv->getUA_Uid());
                    $zrsearch->registerKeywordsSdesc($zruserPres->getEmail()
                        , $zruserPres->getUA_Uid(), "SEARCH_OBJECT_USER", $zruniv->getUA_Uid());
    
                    gdlog()->LogInfoTaskLabel("Add Search for Vice-President User");
                    $zrsearch = new zRegisterSearchData();
                    $zrsearch->registerSearchSdesc($zruserVicePres->getEmail()
                        , $zruserVicePres->getUA_Uid(), "SEARCH_OBJECT_USER", $zruniv->getUA_Uid());
                    $zrsearch->registerKeywordsSdesc($zruserPres->getEmail()
                        , $zruserVicePres->getUA_Uid(), "SEARCH_OBJECT_USER", $zruniv->getUA_Uid());
    
                    $echoret = json_encode(buildReturnArray("RETURN_KEY", "UNIVERSITY_CREATED"
                                                    ,"RETURN_SHOW_PASS_MSG", "TRUE"
                                                    ,"RETURN_MSG", "University has been created."));
                }
                else
                {
                    $echoret = json_encode(buildReturnArray("RETURN_KEY", "UNIVERSITY_KEY_FOUND"
                                                    ,"RETURN_SHOW_PASS_MSG", "TRUE"
                                                    ,"RETURN_MSG", "EDU Key for the university is already used."));
                }
            }
            else
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "NOT_EDU"
                                                ,"RETURN_SHOW_PASS_MSG", "TRUE"
                                                ,"RETURN_MSG", "You must use an EDU email address for the university."));
            }
        }
        else
        {
            $echoret = json_encode(buildReturnArray("RETURN_KEY", "FORM_FIELDS_NOT_VALID"
                                                ,"RETURN_SHOW_PASS_MSG", "TRUE"
                                                ,"RETURN_MSG", "Please fill in all fields."));
        }
    }
}
gdLogEchoReturn($echoret);
echo $echoret;

function validateRegisterForm()
{
    $fv = true;  // Form is Valid Key T=Valid; anything else is invalid;
    if (!isset($_POST["univ_emailkey"]) || $_POST["univ_emailkey"] == "")
        $fv = false;
    if (!isset($_POST["univ_sdesc"]) || $_POST["univ_sdesc"] == "")
        $fv = false;
    if (!isset($_POST["univ_city"]) || $_POST["univ_city"] == "")
        $fv = false;
    if (!isset($_POST["univ_region"]) || $_POST["univ_region"] == "")
        $fv = false;
    if (!isset($_POST["univ_country"]) || $_POST["univ_country"] == "")
        $fv = false;
    if (!isset($_POST["univ_name"]) || $_POST["univ_name"] == "")
        $fv = false;
    /*
            if (!isset($_POST["user_country"]) || $_POST["user_country"] == "")
        $fv = "F";
    if (!isset($_POST["user_nickname"]) || $_POST["user_nickname"] == "")
        $fv = "F";
     * 
     */
    return $fv;
}
?>