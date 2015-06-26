<?php require_once("../../gd.trxn.com/_controls/classes/_core.php"); ?>
<?php gdreqonce("/_controls/classes/find/group.php"); ?>
<?php
$echoret = "";
$action = getControlKey();
if($action != "INVALID")
{
    $gdconfig = gdconfig();
    if($action == "GROUP_HOME" && isset($_GET["ga_uid"]))
    {
        gdlog()->LogInfoTaskLabel("Redirect to Group Home");
        $zfg = new zFindGroup();
        $zfg->findUserRoleofGroup(filter_var($_GET["ga_uid"], FILTER_SANITIZE_STRING));
        $zfg->getUserRoleofGroup_CfgUserRole_Sdesc();
        $gdconfig->setCurrentGroup($zfg->getUserRoleofGroup_CfgGA_Uid(),
                                        $zfg->getUserRoleofGroup_CfgUserRole_Uid(),
                                        $zfg->getUserRoleofGroup_CfgUserRole_Sdesc());
                                        
        gdlog()->LogInfo("Group UID{".gdconfig()->getSessGroupUid()."}:".
            "Group User Role UID{".gdconfig()->getSessGroupUserRoleUid()."}".
            "Group User Role SDESC{".gdconfig()->getSessGroupUserRoleSdesc()."}");
            
        $gdconfig->redirectToUI("000", "GOTO_GROUP_HOME", "Go to group Home", "/siteuser/s_group_home.php");
    }
    else
    {
        $gdconfig->redirectToUserHomePage("000", "GOTO_GROUP_HOME", "Go to User Home");
    }
}

function validateConfiguration()
{
    $fv = true;  // Form is Valid Key T=Valid; anything else is invalid;
    if (!isset($_POST["group_key"]) || $_POST["group_key"] == "")
        $fv = false;
    return $fv;
}
?>