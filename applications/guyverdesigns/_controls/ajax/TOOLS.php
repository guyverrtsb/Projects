<?php require_once("../../gd.trxn.com/_controls/classes/_core.php"); ?>
<?php gdreqonce("/_controls/classes/billto.php"); ?>
<?php gdreqonce("/_controls/classes/client.php"); ?>
<?php gdreqonce("/_controls/classes/project.php"); ?>
<?php gdreqonce("/_controls/classes/requirement.php"); ?>
<?php
$echoret = "";
$action = getControlKey();
if($action != "INVALID")
{
    if($action == "REGISTER_BILLTO")
    {
        $fv = validateFormforBlanks("companyname", "accountingcontactname", "accountingcontactemail", "accountingcontactnumber"
                                    , "address", "cfg_country_sdesc", "city");
        if($fv == true)
        {
            $gdbd = new gdBilltoData();
            $fr = $gdbd->createNewBilltoAccount(filter_var($_POST["companyname"], FILTER_SANITIZE_STRING), 
                                                filter_var($_POST["accountingcontactname"], FILTER_SANITIZE_STRING),
                                                filter_var($_POST["accountingcontactemail"], FILTER_SANITIZE_STRING),
                                                filter_var($_POST["accountingcontactnumber"], FILTER_SANITIZE_STRING),
                                                filter_var($_POST["address"], FILTER_SANITIZE_STRING),
                                                filter_var($_POST["cfg_country_sdesc"], FILTER_SANITIZE_STRING),
                                                filter_var($_POST["cfg_region_sdesc"], FILTER_SANITIZE_STRING),
                                                filter_var($_POST["city"], FILTER_SANITIZE_STRING));
            if($fr == "DATA_IS_CREATED")
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "DATA_IS_CREATED"
                                                            ,"RETURN_SHOW_MSG", "TRUE"
                                                            ,"RETURN_MSG", "Bill To is created"));
            }
            else if($fr == "DATA_IS_NOT_CREATED")
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "DATA_IS_NOT_CREATED"
                                                            ,"RETURN_SHOW_MSG", "TRUE"
                                                            ,"RETURN_MSG", "Bill To is not created"));
            }
            else if($fr == "ACCOUNT_ALREADY_EXISTS")
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "ACCOUNT_ALREADY_EXISTS"
                                                            ,"RETURN_SHOW_MSG", "TRUE"
                                                            ,"RETURN_MSG", "Account already exists"));
            }
            else
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "UNKNOW_ERROR"
                                                            ,"RETURN_SHOW_MSG", "TRUE"
                                                            ,"RETURN_MSG", "Unknown Error"));
            }
        }
        else
        {
            $echoret = json_encode(buildReturnArray("RETURN", "FORM_FIELDS_NOT_VALID"
                                                , "RETURN_SHOW_MSG", "TRUE"
                                                , "RETURN_MSG", "Please fill in Registration form completely"));
        }
    }
    else if($action == "UPDATE_BILLTO")
    {
        $fv = validateFormforBlanks("account_uid", "companyname", "accountingcontactname", "accountingcontactemail", "accountingcontactnumber"
                                    , "address", "cfg_country_sdesc", "city");
        if($fv == true)
        {
            $gdbd = new gdBilltoData();
            $fr = $gdbd->updateExistingBilltoAccount(filter_var($_POST["account_uid"], FILTER_SANITIZE_STRING),
                                                    filter_var($_POST["companyname"], FILTER_SANITIZE_STRING), 
                                                    filter_var($_POST["accountingcontactname"], FILTER_SANITIZE_STRING),
                                                    filter_var($_POST["accountingcontactemail"], FILTER_SANITIZE_STRING),
                                                    filter_var($_POST["accountingcontactnumber"], FILTER_SANITIZE_STRING),
                                                    filter_var($_POST["address"], FILTER_SANITIZE_STRING),
                                                    filter_var($_POST["cfg_country_sdesc"], FILTER_SANITIZE_STRING),
                                                    filter_var($_POST["cfg_region_sdesc"], FILTER_SANITIZE_STRING),
                                                    filter_var($_POST["city"], FILTER_SANITIZE_STRING));
            if($fr == "RECORD_IS_UPDATED")
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "RECORD_IS_UPDATED"
                                                            ,"RETURN_SHOW_MSG", "TRUE"
                                                            ,"RETURN_MSG", "Client is created"));
            }
            else if($fr == "RECORD_IS_NOT_UPDATED")
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "RECORD_IS_NOT_UPDATED"
                                                            ,"RETURN_SHOW_MSG", "TRUE"
                                                            ,"RETURN_MSG", "Billto is not created"));
            }
            else if($fr == "ACCOUNT_ALREADY_EXISTS")
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "ACCOUNT_ALREADY_EXISTS"
                                                            ,"RETURN_SHOW_MSG", "TRUE"
                                                            ,"RETURN_MSG", "Account already exists"));
            }
            else
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "UNKNOW_ERROR"
                                                            ,"RETURN_SHOW_MSG", "TRUE"
                                                            ,"RETURN_MSG", "Unknown Error"));
            }
        }
        else
        {
            $echoret = json_encode(buildReturnArray("RETURN", "FORM_FIELDS_NOT_VALID"
                                                , "RETURN_SHOW_MSG", "TRUE"
                                                , "RETURN_MSG", "Please fill in Registration form completely"));
        }
    }
    else if($action == "REGISTER_CLIENT")
    {
        $fv = validateFormforBlanks("companyname", "contactname", "contactemail", "contactnumber"
                                    , "address", "cfg_country_sdesc", "city");
        if($fv == true)
        {
            $gdcd = new gdClientData();
            $fr = $gdcd->createNewClientAccount(filter_var($_POST["companyname"], FILTER_SANITIZE_STRING), 
                                                filter_var($_POST["contactname"], FILTER_SANITIZE_STRING),
                                                filter_var($_POST["contactemail"], FILTER_SANITIZE_STRING),
                                                filter_var($_POST["contactnumber"], FILTER_SANITIZE_STRING),
                                                filter_var($_POST["address"], FILTER_SANITIZE_STRING),
                                                filter_var($_POST["cfg_country_sdesc"], FILTER_SANITIZE_STRING),
                                                filter_var($_POST["cfg_region_sdesc"], FILTER_SANITIZE_STRING),
                                                filter_var($_POST["city"], FILTER_SANITIZE_STRING));
            if($fr == "DATA_IS_CREATED")
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "DATA_IS_CREATED"
                                                            ,"RETURN_SHOW_MSG", "TRUE"
                                                            ,"RETURN_MSG", "Client is created"));
            }
            else if($fr == "DATA_IS_NOT_CREATED")
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "DATA_IS_NOT_CREATED"
                                                            ,"RETURN_SHOW_MSG", "TRUE"
                                                            ,"RETURN_MSG", "Client is not created"));
            }
            else if($fr == "ACCOUNT_ALREADY_EXISTS")
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "ACCOUNT_ALREADY_EXISTS"
                                                            ,"RETURN_SHOW_MSG", "TRUE"
                                                            ,"RETURN_MSG", "Account already exists"));
            }
            else
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "UNKNOW_ERROR"
                                                            ,"RETURN_SHOW_MSG", "TRUE"
                                                            ,"RETURN_MSG", "Unknown Error"));
            }
        }
    }
    else if($action == "UPDATE_CLIENT")
    {
        $fv = validateFormforBlanks("account_uid", "companyname", "contactname", "contactemail", "contactnumber"
                                    , "address", "cfg_country_sdesc", "city");
        if($fv == true)
        {
            $gdcd = new gdClientData();
            $fr = $gdcd->updateExistingClientAccount(filter_var($_POST["account_uid"], FILTER_SANITIZE_STRING),
                                                    filter_var($_POST["companyname"], FILTER_SANITIZE_STRING), 
                                                    filter_var($_POST["contactname"], FILTER_SANITIZE_STRING),
                                                    filter_var($_POST["contactemail"], FILTER_SANITIZE_STRING),
                                                    filter_var($_POST["contactnumber"], FILTER_SANITIZE_STRING),
                                                    filter_var($_POST["address"], FILTER_SANITIZE_STRING),
                                                    filter_var($_POST["cfg_country_sdesc"], FILTER_SANITIZE_STRING),
                                                    filter_var($_POST["cfg_region_sdesc"], FILTER_SANITIZE_STRING),
                                                    filter_var($_POST["city"], FILTER_SANITIZE_STRING));
            if($fr == "RECORD_IS_UPDATED")
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "RECORD_IS_UPDATED"
                                                            ,"RETURN_SHOW_MSG", "TRUE"
                                                            ,"RETURN_MSG", "Client is created"));
            }
            else if($fr == "RECORD_IS_NOT_UPDATED")
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "RECORD_IS_NOT_UPDATED"
                                                            ,"RETURN_SHOW_MSG", "TRUE"
                                                            ,"RETURN_MSG", "Client is not created"));
            }
            else if($fr == "ACCOUNT_ALREADY_EXISTS")
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "ACCOUNT_ALREADY_EXISTS"
                                                            ,"RETURN_SHOW_MSG", "TRUE"
                                                            ,"RETURN_MSG", "Account already exists"));
            }
            else
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "UNKNOW_ERROR"
                                                            ,"RETURN_SHOW_MSG", "TRUE"
                                                            ,"RETURN_MSG", "Unknown Error"));
            }
        }
    }
    else if($action == "REGISTER_PROJECT")
    {
        $fv = validateProjectRegisterForm();
        if($fv == true)
        {
            $gdpd = new gdProjectData();
            $fr = $gdpd->createNewProjectAccount(filter_var($_POST["accounting_billto_uid"], FILTER_SANITIZE_STRING), 
                                                filter_var($_POST["accounting_client_uid"], FILTER_SANITIZE_STRING), 
                                                filter_var($_POST["sdesc"], FILTER_SANITIZE_STRING), 
                                                filter_var($_POST["ldesc"], FILTER_SANITIZE_STRING), 
                                                filter_var($_POST["contactname"], FILTER_SANITIZE_STRING),
                                                filter_var($_POST["contactemail"], FILTER_SANITIZE_STRING),
                                                filter_var($_POST["contactnumber"], FILTER_SANITIZE_STRING),
                                                filter_var($_POST["address"], FILTER_SANITIZE_STRING),
                                                filter_var($_POST["cfg_country_sdesc"], FILTER_SANITIZE_STRING),
                                                filter_var($_POST["cfg_region_sdesc"], FILTER_SANITIZE_STRING),
                                                filter_var($_POST["city"], FILTER_SANITIZE_STRING),
                                                filter_var($_POST["cfg_payoutcycle_sdesc"], FILTER_SANITIZE_STRING),
                                                filter_var($_POST["cfg_ratetype_sdesc"], FILTER_SANITIZE_STRING),
                                                filter_var($_POST["rate_hourly_onsite"], FILTER_SANITIZE_STRING),
                                                filter_var($_POST["rate_hourly_remote"], FILTER_SANITIZE_STRING),
                                                filter_var($_POST["start_date"], FILTER_SANITIZE_STRING),
                                                filter_var($_POST["end_date"], FILTER_SANITIZE_STRING));
            if($fr == "DATA_IS_CREATED")
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "DATA_IS_CREATED"
                                                            ,"RETURN_SHOW_MSG", "TRUE"
                                                            ,"RETURN_MSG", "Bill To is created"));
            }
            else if($fr == "DATA_IS_NOT_CREATED")
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "DATA_IS_NOT_CREATED"
                                                            ,"RETURN_SHOW_MSG", "TRUE"
                                                            ,"RETURN_MSG", "Bill To is not created"));
            }
            else if($fr == "ACCOUNT_ALREADY_EXISTS")
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "ACCOUNT_ALREADY_EXISTS"
                                                            ,"RETURN_SHOW_MSG", "TRUE"
                                                            ,"RETURN_MSG", "Account already exists"));
            }
            else
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "UNKNOW_ERROR"
                                                            ,"RETURN_SHOW_MSG", "TRUE"
                                                            ,"RETURN_MSG", "Unknown Error"));
            }
        }
        else
        {
            $echoret = json_encode(buildReturnArray("RETURN", "FORM_FIELDS_NOT_VALID"
                                                , "RETURN_SHOW_MSG", "TRUE"
                                                , "RETURN_MSG", "Please fill in Registration form completely"));
        }
    }
    else if($action == "UPDATE_PROJECT")
    {
        $fv = validateProjectUpdateForm();
        if($fv == true)
        {
            $gdpd = new gdProjectData();
            $fr = $gdpd->updateExistingProjectAccount(filter_var($_POST["account_uid"], FILTER_SANITIZE_STRING), 
                                                filter_var($_POST["accounting_billto_uid"], FILTER_SANITIZE_STRING), 
                                                filter_var($_POST["accounting_client_uid"], FILTER_SANITIZE_STRING), 
                                                filter_var($_POST["sdesc"], FILTER_SANITIZE_STRING), 
                                                filter_var($_POST["ldesc"], FILTER_SANITIZE_STRING), 
                                                filter_var($_POST["contactname"], FILTER_SANITIZE_STRING),
                                                filter_var($_POST["contactemail"], FILTER_SANITIZE_STRING),
                                                filter_var($_POST["contactnumber"], FILTER_SANITIZE_STRING),
                                                filter_var($_POST["address"], FILTER_SANITIZE_STRING),
                                                filter_var($_POST["cfg_country_sdesc"], FILTER_SANITIZE_STRING),
                                                filter_var($_POST["cfg_region_sdesc"], FILTER_SANITIZE_STRING),
                                                filter_var($_POST["city"], FILTER_SANITIZE_STRING),
                                                filter_var($_POST["cfg_payoutcycle_sdesc"], FILTER_SANITIZE_STRING),
                                                filter_var($_POST["rate_hourly"], FILTER_SANITIZE_STRING),
                                                filter_var($_POST["start_date"], FILTER_SANITIZE_STRING),
                                                filter_var($_POST["end_date"], FILTER_SANITIZE_STRING));
            if($fr == "RECORD_IS_UPDATED")
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "RECORD_IS_UPDATED"
                                                            ,"RETURN_SHOW_MSG", "TRUE"
                                                            ,"RETURN_MSG", "Client is created"));
            }
            else if($fr == "RECORD_IS_NOT_UPDATED")
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "RECORD_IS_NOT_UPDATED"
                                                            ,"RETURN_SHOW_MSG", "TRUE"
                                                            ,"RETURN_MSG", "Client is not created"));
            }
            else if($fr == "ACCOUNT_ALREADY_EXISTS")
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "ACCOUNT_ALREADY_EXISTS"
                                                            ,"RETURN_SHOW_MSG", "TRUE"
                                                            ,"RETURN_MSG", "Account already exists"));
            }
            else
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "UNKNOW_ERROR"
                                                            ,"RETURN_SHOW_MSG", "TRUE"
                                                            ,"RETURN_MSG", "Unknown Error"));
            }
        }
        else
        {
            $echoret = json_encode(buildReturnArray("RETURN", "FORM_FIELDS_NOT_VALID"
                                                , "RETURN_SHOW_MSG", "TRUE"
                                                , "RETURN_MSG", "Please fill in Registration form completely"));
        }
    }
    else if($action == "UPDATE_TIMESHEET_DATA")
    {
        $fv = validateTimesheetDataUpdateForm();
        if($fv == true)
        {
            $gdpd = new gdTimesheetData();
            $fr = $gdpd->updateExistingTimesheetDates(filter_var($_POST["uid"], FILTER_SANITIZE_STRING), 
                                                filter_var($_POST["d0_work_hours"], FILTER_SANITIZE_STRING), 
                                                filter_var($_POST["d1_work_hours"], FILTER_SANITIZE_STRING), 
                                                filter_var($_POST["d2_work_hours"], FILTER_SANITIZE_STRING), 
                                                filter_var($_POST["d3_work_hours"], FILTER_SANITIZE_STRING), 
                                                filter_var($_POST["d4_work_hours"], FILTER_SANITIZE_STRING),
                                                filter_var($_POST["d5_work_hours"], FILTER_SANITIZE_STRING),
                                                filter_var($_POST["d6_work_hours"], FILTER_SANITIZE_STRING), 
                                                filter_var($_POST["d0_cfg_ratetype_sdesc"], FILTER_SANITIZE_STRING), 
                                                filter_var($_POST["d1_cfg_ratetype_sdesc"], FILTER_SANITIZE_STRING), 
                                                filter_var($_POST["d2_cfg_ratetype_sdesc"], FILTER_SANITIZE_STRING), 
                                                filter_var($_POST["d3_cfg_ratetype_sdesc"], FILTER_SANITIZE_STRING), 
                                                filter_var($_POST["d4_cfg_ratetype_sdesc"], FILTER_SANITIZE_STRING),
                                                filter_var($_POST["d5_cfg_ratetype_sdesc"], FILTER_SANITIZE_STRING),
                                                filter_var($_POST["d6_cfg_ratetype_sdesc"], FILTER_SANITIZE_STRING));
            if($fr == "RECORD_IS_UPDATED")
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "RECORD_IS_UPDATED"
                                                            ,"RETURN_SHOW_MSG", "TRUE"
                                                            ,"RETURN_MSG", "Timesheet is Updated"));
            }
            else if($fr == "RECORD_IS_NOT_UPDATED")
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "RECORD_IS_NOT_UPDATED"
                                                            ,"RETURN_SHOW_MSG", "TRUE"
                                                            ,"RETURN_MSG", "Timesheet is not Updated"));
            }
            else
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "UNKNOW_ERROR"
                                                            ,"RETURN_SHOW_MSG", "TRUE"
                                                            ,"RETURN_MSG", "Unknown Error"));
            }
        }
        else
        {
            $echoret = json_encode(buildReturnArray("RETURN", "FORM_FIELDS_NOT_VALID"
                                                , "RETURN_SHOW_MSG", "TRUE"
                                                , "RETURN_MSG", "Please fill in Timesheet form completely"));
        }
    }
    else if($action == "REGISTER_REQUIREMENT")
    {
        $fv = validateFormforBlanks("title", "role_desc", "start_date"
                                    , "requested_days", "days_per_week", "is_remote_possible"
                                    , "cfg_country_sdesc", "cfg_region_sdesc", "scope_of_tasks");
        if($fv == true)
        {
            $gdbd = new gdRequirementData();
            $fr = $gdbd->findRequirement_bySdesc(strtoupper(trim(filter_var($_POST["title"], FILTER_SANITIZE_STRING))));
            if($fr == "RECORD_IS_NOT_FOUND")
            {
                $comments = "";
                if (isset($_POST["comments"]))
                    $comments = filter_var($_POST["comments"], FILTER_SANITIZE_STRING);
                $city = "";
                if (isset($_POST["city"]))
                    $city = filter_var($_POST["comments"], FILTER_SANITIZE_STRING);
                $gdbd = new gdRequirementData();
                $fr = $gdbd->createRequirement(filter_var($_POST["title"], FILTER_SANITIZE_STRING), 
                                                    filter_var($_POST["role_desc"], FILTER_SANITIZE_STRING),
                                                    filter_var($_POST["start_date"], FILTER_SANITIZE_STRING),
                                                    filter_var($_POST["end_date"], FILTER_SANITIZE_STRING),
                                                    filter_var($_POST["requested_days"], FILTER_SANITIZE_STRING),
                                                    filter_var($_POST["days_per_week"], FILTER_SANITIZE_STRING),
                                                    filter_var($_POST["is_remote_possible"], FILTER_SANITIZE_STRING),
                                                    filter_var($_POST["company_name"], FILTER_SANITIZE_STRING),
                                                    filter_var($_POST["cfg_country_sdesc"], FILTER_SANITIZE_STRING),
                                                    filter_var($_POST["cfg_region_sdesc"], FILTER_SANITIZE_STRING),
                                                    filter_var($_POST["city"], FILTER_SANITIZE_STRING),
                                                    filter_var($_POST["scope_of_tasks"], FILTER_SANITIZE_STRING),
                                                    $comments,
                                                    strtoupper(trim(filter_var($_POST["title"], FILTER_SANITIZE_STRING))),
                                                    $_POST["search_words"]);
                                                    
                if($fr == "DATA_IS_CREATED")
                {
                    $echoret = json_encode(buildReturnArray("RETURN_KEY", "DATA_IS_CREATED"
                                                                ,"RETURN_SHOW_MSG", "TRUE"
                                                                ,"RETURN_MSG", "Requirement is created"));
                }
                else
                {
                    $echoret = json_encode(buildReturnArray("RETURN_KEY", "UNKNOWN_ERROR"
                                                                ,"RETURN_SHOW_MSG", "TRUE"
                                                                ,"RETURN_MSG", "Unknown Error"));
                }
            }
            else
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "RECORD_EXISTS"
                                                            ,"RETURN_SHOW_MSG", "TRUE"
                                                            ,"RETURN_MSG", "Record Already Exists"));
            }
        }
        else
        {
            $echoret = json_encode(buildReturnArray("RETURN", "FORM_FIELDS_NOT_VALID"
                                                , "RETURN_SHOW_MSG", "TRUE"
                                                , "RETURN_MSG", "Please fill in Registration form completely"));
        }
    }
    else if($action == "SEND_REQUIREMENT_TO_EMAIL")
    {
        $fv = validateFormforBlanks("email", "firstname", "lastname");
        if($fv == true)
        {
            $profile_id = "NOT_ASSIGNED";
            $profile_url = "NOT_ASSIGNED";
            if (isset($_POST["profile_id"]) && $_POST["profile_id"] != "")
                $profile_id = filter_var($_POST["profile_id"], FILTER_SANITIZE_STRING);
            if (isset($_POST["profile_url"]) && $_POST["profile_url"] != "")
                $profile_url = filter_var($_POST["profile_url"], FILTER_SANITIZE_STRING);
            $placement_requirement_uid = gdconfig()->getAppData("PLACEMENT_REQUIREMENT_UID");
            
            $gdrd = new gdRequirementData();
            $fv = $gdrd->sendRequirementtoResource(filter_var($_POST["email"], FILTER_SANITIZE_STRING),
                                            filter_var($_POST["firstname"], FILTER_SANITIZE_STRING),
                                            filter_var($_POST["lastname"], FILTER_SANITIZE_STRING),
                                            $profile_id,
                                            $profile_url,
                                            $placement_requirement_uid);
            
            if($fv == "RECORD_IS_CREATED")
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "DATA_IS_CREATED"
                                                        ,"RETURN_SHOW_MSG", "TRUE"
                                                        ,"RETURN_MSG", "E-Mail Sent"));
            }
            else if($fv == "REQ_HAS_BEEN_EMAILED_PREVIOUSLY")
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "REQ_HAS_BEEN_EMAILED_PREVIOUSLY"
                                                        ,"RETURN_SHOW_MSG", "TRUE"
                                                        ,"RETURN_MSG", "Resource has been E-Mailed Requirement Previously"));
            }
            else if($fv == "RESOURCE_IS_IN_PIPELINE")
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "RESOURCE_IS_IN_PIPELINE"
                                                        ,"RETURN_SHOW_MSG", "TRUE"
                                                        ,"RETURN_MSG", "Resource is in Pipeline."));
            }
            else
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "UNKNOWN_ERROR"
                                                        ,"RETURN_SHOW_MSG", "TRUE"
                                                        ,"RETURN_MSG", "Unknown Error"));
            }
        }
        else
        {
            $echoret = json_encode(buildReturnArray("RETURN", "FORM_FIELDS_NOT_VALID"
                                                , "RETURN_SHOW_MSG", "TRUE"
                                                , "RETURN_MSG", "Please fill in Registration form completely"));
        }
    }
    else
    {
        $echoret = json_encode(buildReturnArray("RETURN_KEY", "GD_CONTROL_KEY_NOT_FOUND"
                                            ,"RETURN_SHOW_MSG", "FALSE"
                                                , "RETURN_MSG", "Control Key not Found"));
    }
}
else
{
    $echoret = json_encode(buildReturnArray("RETURN_KEY", "GD_CONTROL_KEY_NOT_VALID"
                                            ,"RETURN_SHOW_MSG", "FALSE"
                                                , "RETURN_MSG", "Control Key not Valid for Function"));
}

gdLogEchoReturn($echoret);
echo $echoret;

function validateProjectRegisterForm()
{
    $fv = true;  // Form is Valid Key T=Valid; anything else is invalid;
    if (!isset($_POST["accounting_billto_uid"]) || $_POST["accounting_billto_uid"] == "")
        $fv = false;
    if (!isset($_POST["accounting_client_uid"]) || $_POST["accounting_client_uid"] == "")
        $fv = false;
    if (!isset($_POST["sdesc"]) || $_POST["sdesc"] == "")
        $fv = false;
    if (!isset($_POST["ldesc"]) || $_POST["ldesc"] == "")
        $fv = false;
    if (!isset($_POST["contactname"]) || $_POST["contactname"] == "")
        $fv = false;
    if (!isset($_POST["contactemail"]) || $_POST["contactemail"] == "")
        $fv = false;
    if (!isset($_POST["contactnumber"]) || $_POST["contactnumber"] == "")
        $fv = false;
    if (!isset($_POST["address"]) || $_POST["address"] == "")
        $fv = false;
    if (!isset($_POST["cfg_country_sdesc"]) || $_POST["cfg_country_sdesc"] == "")
        $fv = false;
    if (!isset($_POST["cfg_region_sdesc"]) || $_POST["cfg_region_sdesc"] == "")
        $fv = false;
    if (!isset($_POST["city"]) || $_POST["city"] == "")
        $fv = false;
    if (!isset($_POST["cfg_payoutcycle_sdesc"]) || $_POST["cfg_payoutcycle_sdesc"] == "")
        $fv = false;
    if (!isset($_POST["start_date"]) || $_POST["start_date"] == "")
        $fv = false;
    if (!isset($_POST["end_date"]) || $_POST["end_date"] == "")
        $fv = false;
    if (!isset($_POST["cfg_ratetype_sdesc"]) || $_POST["cfg_ratetype_sdesc"] == "")
        $fv = false;
    if (!isset($_POST["rate_hourly_onsite"]) || $_POST["rate_hourly_onsite"] == "")
        $fv = false;
    if (!isset($_POST["rate_hourly_remote"]) || $_POST["rate_hourly_remote"] == "")
        $fv = false;
    return $fv;
}

function validateProjectUpdateForm()
{
    $fv = true;  // Form is Valid Key T=Valid; anything else is invalid;
    if (!isset($_POST["account_uid"]) || $_POST["account_uid"] == "")
        $fv = false;
    if (!isset($_POST["accounting_billto_uid"]) || $_POST["accounting_billto_uid"] == "")
        $fv = false;
    if (!isset($_POST["accounting_client_uid"]) || $_POST["accounting_client_uid"] == "")
        $fv = false;
    if (!isset($_POST["sdesc"]) || $_POST["sdesc"] == "")
        $fv = false;
    if (!isset($_POST["ldesc"]) || $_POST["ldesc"] == "")
        $fv = false;
    if (!isset($_POST["contactname"]) || $_POST["contactname"] == "")
        $fv = false;
    if (!isset($_POST["contactemail"]) || $_POST["contactemail"] == "")
        $fv = false;
    if (!isset($_POST["contactnumber"]) || $_POST["contactnumber"] == "")
        $fv = false;
    if (!isset($_POST["address"]) || $_POST["address"] == "")
        $fv = false;
    if (!isset($_POST["cfg_country_sdesc"]) || $_POST["cfg_country_sdesc"] == "")
        $fv = false;
    if (!isset($_POST["cfg_region_sdesc"]) || $_POST["cfg_region_sdesc"] == "")
        $fv = false;
    if (!isset($_POST["city"]) || $_POST["city"] == "")
        $fv = false;
    if (!isset($_POST["cfg_payoutcycle_sdesc"]) || $_POST["cfg_payoutcycle_sdesc"] == "")
        $fv = false;
    if (!isset($_POST["rate_hourly"]) || $_POST["rate_hourly"] == "")
        $fv = false;
    if (!isset($_POST["start_date"]) || $_POST["start_date"] == "")
        $fv = false;
    if (!isset($_POST["end_date"]) || $_POST["end_date"] == "")
        $fv = false;
    return $fv;
}

function validateTimesheetDataUpdateForm()
{
    $fv = true;  // Form is Valid Key T=Valid; anything else is invalid;
    if (!isset($_POST["uid"]) || $_POST["uid"] == "")
        $fv = false;
    if (!isset($_POST["d0_work_hours"]) || $_POST["d0_work_hours"] == "")
        $fv = false;
    if (!isset($_POST["d1_work_hours"]) || $_POST["d1_work_hours"] == "")
        $fv = false;
    if (!isset($_POST["d2_work_hours"]) || $_POST["d2_work_hours"] == "")
        $fv = false;
    if (!isset($_POST["d3_work_hours"]) || $_POST["d3_work_hours"] == "")
        $fv = false;
    if (!isset($_POST["d4_work_hours"]) || $_POST["d4_work_hours"] == "")
        $fv = false;
    if (!isset($_POST["d5_work_hours"]) || $_POST["d5_work_hours"] == "")
        $fv = false;
    if (!isset($_POST["d6_work_hours"]) || $_POST["d6_work_hours"] == "")
        $fv = false;
    if (!isset($_POST["d0_cfg_ratetype_sdesc"]))
        $fv = false;
    if (!isset($_POST["d1_cfg_ratetype_sdesc"]))
        $fv = false;
    if (!isset($_POST["d2_cfg_ratetype_sdesc"]))
        $fv = false;
    if (!isset($_POST["d3_cfg_ratetype_sdesc"]))
        $fv = false;
    if (!isset($_POST["d4_cfg_ratetype_sdesc"]))
        $fv = false;
    if (!isset($_POST["d5_cfg_ratetype_sdesc"]))
        $fv = false;
    if (!isset($_POST["d6_cfg_ratetype_sdesc"]))
        $fv = false;
    if (!isset($_POST["uid"]) || $_POST["uid"] == "")
        $fv = false;
    return $fv;
}

function validateTaskControlForm()
{
    $fv = true;  // Form is Valid Key T=Valid; anything else is invalid;
    if (!isset($_GET["activationlink"]) || $_GET["activationlink"] == "")
        $fv = false;
    return $fv;
}

function validateLoginForm()
{
    $fv = true;  // Form is Valid Key T=Valid; anything else is invalid;
    if (!isset($_POST["login_user_email"]) || $_POST["login_user_email"] == "")
        $fv = false;
    if (!isset($_POST["login_user_password"]) || $_POST["login_user_password"] == "")
        $fv = false;
    return $fv;
}

function validateActivateUserForm()
{
    $fv = true;  // Form is Valid Key T=Valid; anything else is invalid;
    if (!isset($_POST["activate_user_email"]) || $_POST["activate_user_email"] == "")
        $fv = false;
    return $fv;
}
?>