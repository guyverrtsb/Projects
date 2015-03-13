<?php require_once("../classes/_core.php"); ?>
<?php
$echoret = "";
$action = getControlKey();
if($action != "INVALID")
{
    if($action == "MAINT_USERACOUNT" && validateUsersafetyUseraccount())
    {
        gdlog()->LogInfoTaskLabel("Redirect to User Acount Maintenance");
        gdconfig()->setAppData("USERSAFETY_USERACCOUNT_UID", filter_var($_GET["usersafety_useraccount_uid"], FILTER_SANITIZE_STRING));
        gdconfig()->redirectToUIPage("000", "GOTO_USERACCOUNT", "Go to User Account", "FALSE", "/gd.trxn.com/usersafety/s_user_account.php");
    }
    else
    {
        gdconfig()->redirectToUIPage(0, $fr, "User Account not Selected", "TRUE", gdconfig()->getRedirectAuthLoggedinPage());
    }
}

function validateUsersafetyUseraccount()
{
    $fv = true;  // Form is Valid Key T=Valid; anything else is invalid;
    if (!isset($_GET["usersafety_useraccount_uid"]) || $_GET["usersafety_useraccount_uid"] == "")
        $fv = false;
    return $fv;
}
?>