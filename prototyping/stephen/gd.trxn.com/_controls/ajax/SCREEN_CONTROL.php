<?php require_once("../../../gd.trxn.com/_controls/classes/_core.php"); ?>
<?php gdreqonce("/gd.trxn.com/usersafety/_controls/classes/userdata.php"); ?>
<?php gdreqonce("/gd.trxn.com/usersafety/_controls/classes/userroles.php"); ?>
<?php
$echoret = "";
$action = getControlKey();
if($action != "INVALID")
{
    if($action == "LIST_OF_USER_ACCOUNTS")
    {
        $gdud = new gdUserData();
        $fv = $gdud->findUserDataList();
        if($fv == "RECORDS_ARE_FOUND")
        {
            $echoret = json_encode(buildReturnArray("RETURN_KEY", "SUCCESS"
                                                ,"RETURN_SHOW_MSG", "false"
                                                , "RESULT", $gdud->getResult_Records()));
        }
        else
        {
            $echoret = json_encode(buildReturnArray("RETURN_KEY", "NO_RESULTS"
                                                ,"RETURN_SHOW_PASS_MSG", "FALSE"));
        }
    }
    else if($action == "SINGLE_USER_DATA")
    {
        $gdud = new gdUserData();
        $fv = $gdud->findUserData_byUid(gdconfig()->getAppData("USERSAFETY_USERACCOUNT_UID"));
        gdconfig()->cleanAppDataName("USERSAFETY_USERACCOUNT_UID");
        if($fv == "RECORD_IS_FOUND")
        {
            $echoret = json_encode(buildReturnArray("RETURN_KEY", "SUCCESS"
                                                ,"RETURN_SHOW_MSG", "false"
                                                , "RESULT", $gdud->getResult_Record()));
        }
        else
        {
            $echoret = json_encode(buildReturnArray("RETURN_KEY", "NO_RESULTS"
                                                ,"RETURN_SHOW_PASS_MSG", "FALSE"));
        }
    }
    else if($action == "LIST_OF_USERSAFETY_ROLES")
    {
        $gdur = new gdUserRoles();
        $fv = $gdur->findUserRolesList();
        if($fv == "RECORDS_ARE_FOUND")
        {
            $echoret = json_encode(buildReturnArray("RETURN_KEY", "SUCCESS"
                                                ,"RETURN_SHOW_PASS_MSG", "false"
                                                , "RESULT", $gdur->getResult_Records()));
        }
        else
        {
            $echoret = json_encode(buildReturnArray("RETURN_KEY", "NO_RESULTS"
                                                ,"RETURN_SHOW_PASS_MSG", "FALSE"));
        }
    }
    else
    {
        $echoret = json_encode(buildReturnArray("RETURN_KEY", "GD_CONTROLLER_KEY_NOT_FOUND"
                                            ,"RETURN_SHOW_MSG", "FALSE"));
    }
}

gdLogEchoReturn($echoret);
echo $echoret;

function validateListofTimesheetsforProjectForm()
{
    $fv = true;  // Form is Valid Key T=Valid; anything else is invalid;
    if (!isset($_POST["GROUP_ACCOUNT_UID"]) || $_POST["GROUP_ACCOUNT_UID"] == "")
        $fv = false;
    return true;
}
?>