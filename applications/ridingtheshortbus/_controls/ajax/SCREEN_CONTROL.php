<?php require_once("../../gd.trxn.com/_controls/classes/_core.php"); ?>
<?php gdreqonce("/_controls/classes/billto.php"); ?>
<?php gdreqonce("/_controls/classes/client.php"); ?>
<?php gdreqonce("/_controls/classes/project.php"); ?>
<?php gdreqonce("/_controls/classes/timesheet.php"); ?>
<?php
$echoret = "";
$action = getControlKey();
if($action != "INVALID")
{
    if($action == "LIST_OF_BILLTOS")
    {
        $gdbd = new gdBilltoData();
        $fv = $gdbd->findBilltoList();
        if($fv == "RECORDS_ARE_FOUND")
        {
            $echoret = json_encode(buildReturnArray("RETURN_KEY", "SUCCESS"
                                                ,"RETURN_SHOW_PASS_MSG", "false"
                                                , "RESULT", $gdbd->getResult_Records()));
        }
        else
        {
            $echoret = json_encode(buildReturnArray("RETURN_KEY", "NO_RESULTS"
                                                ,"RETURN_SHOW_PASS_MSG", "FALSE"));
        }
    }
    else if($action == "LIST_OF_CLIENTS")
    {
        $gdbd = new gdClientData();
        $fv = $gdbd->findClientList();
        if($fv == "RECORDS_ARE_FOUND")
        {
            $echoret = json_encode(buildReturnArray("RETURN_KEY", "SUCCESS"
                                                ,"RETURN_SHOW_PASS_MSG", "false"
                                                , "RESULT", $gdbd->getResult_Records()));
        }
        else
        {
            $echoret = json_encode(buildReturnArray("RETURN_KEY", "NO_RESULTS"
                                                ,"RETURN_SHOW_PASS_MSG", "FALSE"));
        }
    }
    else if($action == "LIST_OF_PROJECTS")
    {
        $gdbd = new gdProjectData();
        $fv = $gdbd->findProjectList();
        if($fv == "RECORDS_ARE_FOUND")
        {
            $echoret = json_encode(buildReturnArray("RETURN_KEY", "SUCCESS"
                                                ,"RETURN_SHOW_PASS_MSG", "false"
                                                , "RESULT", $gdbd->getResult_Records()));
        }
        else
        {
            $echoret = json_encode(buildReturnArray("RETURN_KEY", "NO_RESULTS"
                                                ,"RETURN_SHOW_PASS_MSG", "FALSE"));
        }
    }
    else if($action == "LIST_OF_PROJECTS_FULL_DATA")
    {
        $gdbd = new gdProjectData();
        $fv = $gdbd->findProjectListFullData();
        if($fv == "RECORDS_ARE_FOUND")
        {
            $echoret = json_encode(buildReturnArray("RETURN_KEY", "SUCCESS"
                                                ,"RETURN_SHOW_PASS_MSG", "false"
                                                , "RESULT", $gdbd->getResult_Records()));
        }
        else
        {
            $echoret = json_encode(buildReturnArray("RETURN_KEY", "NO_RESULTS"
                                                ,"RETURN_SHOW_PASS_MSG", "FALSE"));
        }
    }
    else if($action == "LIST_OF_TIMESHEETS_FOR_PROJECT")
    {
        $fv = validateListofTimesheetsforProjectForm();
        if($fv == true)
        {
            $gdtd = new gdTimesheetData();
            $fv = $gdtd->findTimesheetListforProject(gdconfig()->getAppData("ACCOUNTING_PROJECT_UID"));
            if($fv == "RECORDS_ARE_FOUND")
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "SUCCESS"
                                                    ,"RETURN_SHOW_PASS_MSG", "false"
                                                    , "RESULT", $gdtd->getResult_Records()));
            }
            else
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "NO_RESULTS"
                                                    ,"RETURN_SHOW_PASS_MSG", "FALSE"));
            }
        }
        else
        {
            $echoret = json_encode(buildReturnArray("RETURN", "FORM_FIELDS_NOT_VALID"
                                                , "RETURN_SHOW_MSG", "TRUE"
                                                , "RETURN_MSG", "Please fill in Registration form completely"));
        }
    }
    else if($action == "LOAD_DATA_FOR_UPDATE_BILLTO")
    {
        $gdbd = new gdBilltoData();
        $fv = $gdbd->findBillto_byUid(filter_var($_POST["account_uid"], FILTER_SANITIZE_STRING));
        if($fv == "RECORD_IS_FOUND")
        {
            $echoret = json_encode(buildReturnArray("RETURN_KEY", "SUCCESS"
                                                ,"RETURN_SHOW_PASS_MSG", "false"
                                                , "RESULT", $gdbd->getResult_Record()));
        }
        else
        {
            $echoret = json_encode(buildReturnArray("RETURN_KEY", "NO_RESULTS"
                                                ,"RETURN_SHOW_PASS_MSG", "FALSE"));
        }
    }
    else if($action == "LOAD_DATA_FOR_UPDATE_CLIENT")
    {
        $gdbd = new gdClientData();
        $fv = $gdbd->findClient_byUid(filter_var($_POST["account_uid"], FILTER_SANITIZE_STRING));
        if($fv == "RECORD_IS_FOUND")
        {
            $echoret = json_encode(buildReturnArray("RETURN_KEY", "SUCCESS"
                                                ,"RETURN_SHOW_PASS_MSG", "false"
                                                , "RESULT", $gdbd->getResult_Record()));
        }
        else
        {
            $echoret = json_encode(buildReturnArray("RETURN_KEY", "NO_RESULTS"
                                                ,"RETURN_SHOW_PASS_MSG", "FALSE"));
        }
    }
    else if($action == "LOAD_DATA_FOR_UPDATE_PROJECT")
    {
        $gdpd = new gdProjectData();
        $fv = $gdpd->findProject_byUid(filter_var($_POST["account_uid"], FILTER_SANITIZE_STRING));
        if($fv == "RECORD_IS_FOUND")
        {
            $echoret = json_encode(buildReturnArray("RETURN_KEY", "SUCCESS"
                                                ,"RETURN_SHOW_PASS_MSG", "false"
                                                , "RESULT", $gdpd->getResult_Record()));
        }
        else
        {
            $echoret = json_encode(buildReturnArray("RETURN_KEY", "NO_RESULTS"
                                                ,"RETURN_SHOW_PASS_MSG", "FALSE"));
        }
    }
    else if($action == "TIMESHEET_UDPATE_SCREEN_DATA")
    {
        $gdpd = new gdTimesheetData();
        $fv = $gdpd->findTimesheetDates_byUid(filter_var($_POST["accounting_timesheet_dates_uid"], FILTER_SANITIZE_STRING));
        if($fv == "RECORD_IS_FOUND")
        {
            $echoret = json_encode(buildReturnArray("RETURN_KEY", "SUCCESS"
                                                ,"RETURN_SHOW_PASS_MSG", "false"
                                                , "RESULT", $gdpd->getResult_Record()));
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