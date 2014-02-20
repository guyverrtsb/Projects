<?php require_once("../../gd.trxn.com/_controls/classes/_core.php"); ?>
<?php gdreqonce("/_controls/classes/find/group.php"); ?>
<?php gdreqonce("/_controls/classes/match/user.php"); ?>
<?php gdreqonce("/_controls/classes/register/groupmembershiprequest.php.php"); ?>
<?php gdreqonce("/_controls/classes/register/wallmessage.php"); ?>
<?php gdreqonce("/_controls/classes/find/user.php"); ?>
<?php gdreqonce("/_controls/classes/find/grouprequest.php"); ?>
<?php
if(isset($_POST["GD_CONTROLLER_KEY"]))
{
    $action = filter_var($_POST["GD_CONTROLLER_KEY"], FILTER_SANITIZE_STRING);
    $gdconfig = gdconfig();
    gdlog()->LogInfo("GD_CONTROLLER_KEY{".$action."}");
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
                
                $zrrm = new zRegisterGroupMembershipRequest();
                $zrrm->registerGroupMembershipRequest($zfuserLoggedIn->getUA_Uid(),
                                            $zfuserGroupOwner->getUA_Uid(),
                                            $zfuserLoggedIn->getUA_Uid(),
                                            $group_account_uid,
                                            "A");
                
                $zmu = new zMatchUser();
                $zmu->matchUsertoGrouptoRoleSdesc($zfuserLoggedIn->getUA_Uid(),
                                                $group_account_uid,
                                                "USER_ROLES_GROUP_USER");
                
                $zrwallmessage = new zRegisterWallMessage();
                $zrwallmessage->registerWallMessage($group_account_uid,
                                                    $gdconfig->getSessAuthUserUid(),
                                                    $zfuserLoggedIn->getFName()." has joined ".$zfg->getGA_Ldesc().".",
                                                    "IMAGE_NOT_PROVIDED_FOR_UPLOADED");
                                                    
                $r = json_encode($zrrm->getResult_RequestMessage());
                $zrrm->gdlog()->LogInfo("JSON_ENCODE:".$r);                               
            }
            else if($zfg->getCfgGroupUASdesc() == "GROUP_ACCEPT_OWNER_ACCEPT") // OWNER Accept
            {
                gdlog()->LogInfoTaskLabel("Group Owner Accept");
                $zfuserLoggedIn = new zFindUser();
                $r = $zfuserLoggedIn->findAccountandProfileByUid($gdconfig->getSessAuthUserUid());
                $zfuserGroupOwner = new zFindUser();
                $r = $zfuserGroupOwner->findUserAccountandProfileofGroupOwner($group_account_uid);
                
                $zrrm = new zRegisterRequestMessage();
                $zrrm->registerRequestMessage($zfuserLoggedIn->getUA_Uid(),
                                            $zfuserGroupOwner->getUA_Uid(),
                                            $zfuserLoggedIn->getUA_Uid(),
                                            $group_account_uid,
                                            "P");
                                            
                $r = json_encode($zrrm->getResult_RequestMessage());
                $zrrm->gdlog()->LogInfo("JSON_ENCODE:".$r);
            }
            else if($zfg->getCfgGroupUASdesc() == "GROUP_ACCEPT_INVITED_BY_MEMBER_AUTO_ACCEPT") // Invited by Member Auto Accept
            {
                gdlog()->LogInfoTaskLabel("Group Owner Accept");
                $invited_user_account_uid = filter_var($_POST["INVITED_USER_ACCOUNT_UID"], FILTER_SANITIZE_STRING);
                
                
                $zfuserLoggedIn = new zFindUser();
                $r = $zfuserLoggedIn->findAccountandProfileByUid($gdconfig->getSessAuthUserUid());
                $zfuserGroupOwner = new zFindUser();
                $r = $zfuserGroupOwner->findUserAccountandProfileofGroupOwner($group_account_uid);
                $zfuserInvited = new zFindUser();
                $r = $zfuserInvited->findAccountandProfileByUid($invited_user_account_uid);
                
                $zrrm = new zRegisterRequestMessage();
                $zrrm->registerRequestMessage($zfuserLoggedIn->getUA_Uid(),
                                            $zfuserGroupOwner->getUA_Uid(),
                                            $zfuserInvited->getUA_Uid(),
                                            $group_account_uid,
                                            "P");
                                            
                $r = json_encode($zrrm->getResult_RequestMessage());
                $zrrm->gdlog()->LogInfo("JSON_ENCODE:".$r);
            }
            else if($zfg->getCfgGroupUASdesc() == "GROUP_ACCEPT_INVITED_BY_OWNER_AUTO_ACCEPT") // Invited by Owner Auto Accept
            {
                gdlog()->LogInfoTaskLabel("Group Owner Accept");
                $invited_user_account_uid = filter_var($_POST["INVITED_USER_ACCOUNT_UID"], FILTER_SANITIZE_STRING);
                
                
                $zfuserLoggedIn = new zFindUser();
                $r = $zfuserLoggedIn->findAccountandProfileByUid($gdconfig->getSessAuthUserUid());
                $zfuserGroupOwner = new zFindUser();
                $r = $zfuserGroupOwner->findUserAccountandProfileofGroupOwner($group_account_uid);
                $zfuserInvited = new zFindUser();
                $r = $zfuserInvited->findAccountandProfileByUid($invited_user_account_uid);
                
                $zrrm = new zRegisterRequestMessage();
                $zrrm->registerRequestMessage($zfuserLoggedIn->getUA_Uid(),
                                            $zfuserGroupOwner->getUA_Uid(),
                                            $zfuserInvited->getUA_Uid(),
                                            $group_account_uid,
                                            "P");
                                            
                $r = json_encode($zrrm->getResult_RequestMessage());
                $zrrm->gdlog()->LogInfo("JSON_ENCODE:".$r);
            }
            echo $r;
        }
        else
        {
            echo "FORM_FIELDS_NOT_VALID";
        }
    }
    else if($action == "LIST_OF_REQUEST_FOR_GROUP")
    {
        $zfgr = new zFindGroupRequests();
        $r = $zfgr->findGroupRequest();
        if($r == "REQUEST_LIST_FOUND")
        {
            $r = json_encode($zfgr->getResult_RequestLists());
            $zfgr->gdlog()->LogInfo("JSON_ENCODE:".$r);
        }
        echo $r;
    }
}

function validateConfiguration()
{
    $fv = "T";  // Form is Valid Key T=Valid; anything else is invalid;
    if (!isset($_POST["GROUP_ACCOUNT_UID"]) || $_POST["GROUP_ACCOUNT_UID"] == "")
        $fv = "F";
    return $fv;
}
?>