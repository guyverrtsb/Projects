<?php require_once("../../gd.trxn.com/_controls/classes/_core.php"); ?>
<?php gdreqonce("/_controls/classes/find/group.php"); ?>
<?php gdreqonce("/_controls/classes/match/user.php"); ?>
<?php gdreqonce("/_controls/classes/routines/requestgroupmembership.php"); ?>
<?php gdreqonce("/_controls/classes/find/user.php"); ?>
<?php gdreqonce("/_controls/classes/find/grouprequest.php"); ?>
<?php
$echoret = "";
$action = getControlKey();
if($action != "INVALID")
{
    $gdconfig = gdconfig();
    if($action == "JOIN_GROUP_FROM_SEARCH") // User has asked to join group
    {
        if(validateConfiguration())
        {
            $group_account_uid = filter_var($_POST["GROUP_ACCOUNT_UID"], FILTER_SANITIZE_STRING);
            /*
             * 1. Is group open to requests for joining
             * 2. If group allows auto accept add user to group
             * 3. if user request requires approval save request
             */
            $zfg = new zFindGroup();
            $zfg->findAccountandProfileByUid($group_account_uid);
            gdlog()->LogInfo("GROUP_ACCEPT_SDESC:".$zfg->getCfgGroupUASdesc());
            if($zfg->getCfgGroupUASdesc() == "GROUP_ACCEPT_AUTO_ACCEPT")    // AUTO Accept to Group
            {
                gdlog()->LogInfoTaskLabel("Group Auto Accept");
                $zfuserLoggedIn = new zFindUser();
                $r = $zfuserLoggedIn->findAccountandProfileByUid($gdconfig->getSessAuthUserUid());
                
                $zfuserGroupOwner = new zFindUser();
                $r = $zfuserGroupOwner->findUserAccountandProfileofGroupOwner($group_account_uid);

                $zmu = new zMatchUser();
                $zmu->matchUsertoGrouptoRoleSdesc($zfuserLoggedIn->getUA_Uid(),
                                                $group_account_uid,
                                                "USER_ROLES_GROUP_USER");
                
                $zrgm = new zRequestGroupMembership();
                $zrgm->requestGroupMembershipAutoAccept($zfg, $zfuserLoggedIn, $zfuserGroupOwner);

                $echoret = json_encode(buildReturnArray("RETURN_KEY", "SUCCESS"
                                                ,"RETURN_SHOW_PASS_MSG", "FALSE"
                                                , "RECORD", $zrgm->getResult()));
            }
            else if($zfg->getCfgGroupUASdesc() == "GROUP_ACCEPT_OWNER_ACCEPT") // OWNER Accept
            {
                gdlog()->LogInfoTaskLabel("Group Owner Accept");
                $zfuserLoggedIn = new zFindUser();
                $r = $zfuserLoggedIn->findAccountandProfileByUid($gdconfig->getSessAuthUserUid());
                
                $zfuserGroupOwner = new zFindUser();
                $r = $zfuserGroupOwner->findUserAccountandProfileofGroupOwner($group_account_uid);
                                            
                $zrgm = new zRequestGroupMembership();
                $zrgm->requestGroupMembershipOwnerAccept($zfg, $zfuserLoggedIn, $zfuserGroupOwner);

                $echoret = json_encode(buildReturnArray("RETURN_KEY", "SUCCESS"
                                                ,"RETURN_SHOW_PASS_MSG", "FALSE"
                                                , "RECORD", $zrgm->getResult()));
            }
            else
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "GROUP_JOIN_NOT_DEFINED"
                                                ,"RETURN_SHOW_PASS_MSG", "FALSE"));
            }
        }
        else
        {
            $echoret = json_encode(buildReturnArray("RETURN_KEY", "FORM_FIELDS_NOT_VALID"
                                                ,"RETURN_SHOW_PASS_MSG", "FALSE"));
        }
    }
    else if($action == "LIST_OF_REQUEST_FOR_GROUP")
    {
        $zfgr = new zFindGroupRequests();
        $r = $zfgr->findGroupRequest();
        if($r == "REQUEST_LIST_FOUND")
        {
            $echoret = json_encode(buildReturnArray("RETURN_KEY", "SUCCESS"
                                                ,"RETURN_SHOW_PASS_MSG", "FALSE"
                                            , "RECORD", $zfgr->getResult_RequestLists()));
        }
        else
        {
            $echoret = json_encode(buildReturnArray("RETURN_KEY", "REQUEST_LIST_NOT_FOUND"
                                                ,"RETURN_SHOW_PASS_MSG", "FALSE"));
        }
    }
}
gdLogEchoReturn($echoret);
echo $echoret;

function validateConfiguration()
{
    $tf = true;  // Form is Valid Key T=Valid; anything else is invalid;
    if (!isset($_POST["GROUP_ACCOUNT_UID"]) || $_POST["GROUP_ACCOUNT_UID"] == "")
        $tf = false;
    return $tf;
}
function validateConfigurationOnbehalf()
{
    $tf = true;  // Form is Valid Key T=Valid; anything else is invalid;
    if (!isset($_POST["GROUP_ACCOUNT_UID"]) || $_POST["GROUP_ACCOUNT_UID"] == "")
        $tf = false;
    else if (!isset($_POST["INVITED_USER_ACCOUNT_UID"]) || $_POST["INVITED_USER_ACCOUNT_UID"] == "")
        $tf = false;
    return $tf;
}
?>