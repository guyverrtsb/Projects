<?php require_once("../../gd.trxn.com/_controls/classes/_core.php"); ?>
<?php
$echoret = "";
$action = getControlKey();
if($action != "INVALID")
{
    if($action == "TIMESHEETS_BY_PROJECT" && validateTimesheetScreen())
    {
        gdlog()->LogInfoTaskLabel("Redirect to TimeSheet");
        gdconfig()->setAppData("ACCOUNTING_PROJECT_UID", filter_var($_GET["accounting_project_uid"], FILTER_SANITIZE_STRING));
        gdconfig()->redirectToUIPage("000", "GOTO_TIMESHEET", "Go to Time Sheet", "/accounting/s_timesheet.php");
    }
    else
    {
        gdconfig()->redirectToUIPage(0, $fr, "Project was not selected", gdconfig()->getRedirectAuthLoggedinPage());
    }
}

function validateTimesheetScreen()
{
    $fv = true;  // Form is Valid Key T=Valid; anything else is invalid;
    if (!isset($_GET["accounting_project_uid"]) || $_GET["accounting_project_uid"] == "")
        $fv = false;
    return $fv;
}
?>