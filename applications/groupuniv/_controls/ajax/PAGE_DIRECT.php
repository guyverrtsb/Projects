<?php require_once("../../gd.trxn.com/_controls/classes/_core.php"); ?>
<?php gdreqonce("/_controls/classes/find/group.php"); ?>
<?php
if(isset($_GET["GD_CONTROLLER_KEY"]))
{
    $action = filter_var($_GET["GD_CONTROLLER_KEY"], FILTER_SANITIZE_STRING);
    gdlog()->LogInfo("GD_CONTROLLER_KEY{".$action."}");
    if($action == "GROUP_HOME" && isset($_GET["ga_uid"]))
    {
        gdlog()->LogInfoTaskLabel("Redirect to Group Home");
        $zfg = new zFindGroup();
        $zfg->findUserRoleofGroup(filter_var($_GET["ga_uid"], FILTER_SANITIZE_STRING));
        $zfg->getUserRoleofGroup_CfgUserRole_Sdesc();
        getGDConfig()->setCurrentGroup($zfg->getUserRoleofGroup_CfgGA_Uid(),
                                        $zfg->getUserRoleofGroup_CfgUserRole_Uid(),
                                        $zfg->getUserRoleofGroup_CfgUserRole_Sdesc());
        gdlog()->LogInfo("Group UID{".getGDConfig()->getSessGroupUid()."}:".
            "Group User Role UID{".getGDConfig()->getSessGroupUserRoleUid()."}".
            "Group User Role SDESC{".getGDConfig()->getSessGroupUserRoleSdesc()."}");
        redirectToUI("000", "GOTO_GROUP_HOME", "Go to group Home", "/siteuser/s_group_home.php");
    }
    else 
    {
        
    }
}

function redirectToUI($code, $sdesc, $ldesc, $location = "/siteuser/s_user_account.php")
{
    gdlog()->LogInfoStartFUNCTION("redirectToUI");
    $_SESSION["AUTH_ERROR_CODE"] = $code;
    $_SESSION["AUTH_ERROR_KEY"] = $sdesc;
    $_SESSION["AUTH_ERROR_MSG"] = $ldesc;
    gdlog()->LogInfo("redirectToUI".
        ":location:".$location.
        ":AUTH_ERROR_CODE:".$_SESSION["AUTH_ERROR_CODE"].
        ":AUTH_ERROR_KEY:".$_SESSION["AUTH_ERROR_KEY"].
        ":AUTH_ERROR_MSG:".$_SESSION["AUTH_ERROR_MSG"].":");
    header("Location: ".$location);
}

function validateConfiguration()
{
    $fv = "T";  // Form is Valid Key T=Valid; anything else is invalid;
    if (!isset($_POST["group_key"]) || $_POST["group_key"] == "")
        $fv = "F";
    return $fv;
}
?>