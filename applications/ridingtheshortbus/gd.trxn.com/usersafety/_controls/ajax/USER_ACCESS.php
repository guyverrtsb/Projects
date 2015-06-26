<?php require_once("../../../_controls/classes/_core.php"); ?>
<?php 
gdreqonce("/gd.trxn.com/usersafety/_controls/classes/createuser.php");
gdreqonce("/gd.trxn.com/usersafety/_controls/classes/taskcontrol.php");
gdreqonce("/gd.trxn.com/usersafety/_controls/classes/authenticateuser.php");

$echoret = "";
$action = getControlKey();
if($action != "INVALID")
{
    if($action == "REGISTER_USER")
    {
        $fv = validateFormforBlanks("email", "nickname", "password", "firstname", "lastname", "cfg_country_sdesc", "cfg_region_sdesc", "city");
        if($fv == true)
        {
            $gdcud = new gdCreateUserData();
            $fr = $gdcud->createNewUserAccountandProfile(filter_var($_POST["email"], FILTER_SANITIZE_STRING), 
                                                        filter_var($_POST["nickname"], FILTER_SANITIZE_STRING),
                                                        filter_var($_POST["password"], FILTER_SANITIZE_STRING),
                                                        filter_var($_POST["firstname"], FILTER_SANITIZE_STRING),
                                                        filter_var($_POST["lastname"], FILTER_SANITIZE_STRING),
                                                        filter_var($_POST["cfg_country_sdesc"], FILTER_SANITIZE_STRING),
                                                        filter_var($_POST["cfg_region_sdesc"], FILTER_SANITIZE_STRING),
                                                        filter_var($_POST["city"], FILTER_SANITIZE_STRING));
            if($fr == "USER_DATA_IS_CREATED")
            {
                gdlog()->LogInfo("GDBuildHtmlMessage():Build Activation Email:".gdconfig()->getSiteAlias());
                $tab = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                $o = "<html>";
                $o .= "<head>";
                $o .= "<title>User Activation</title>";
                $o .= "</head>";
                $o .= "<body>";
                $o .= "<ul>";
                $o = "<li>Nickname:" . $gdcud->getOutputData("useraccount_nickname") . "</li>";
                $o = "<li>Email:" . $gdcud->getOutputData("useraccount_email") . "</li>";
                $o .= "<li>First Name:" . $gdcud->getOutputData("userprofile_firstname") . "</li>";
                $o .= "<li>Last Name:" . $gdcud->getOutputData("userprofile_lastname") . "</li>";
                $o .= "<li>Activation Link:<a href=\"http://".gdconfig()->getSiteAlias().
                    "/gd.trxn.com/usersafety/_controls/ajax/USER_ACCESS.php?GD_CONTROLLER_KEY=TASK_CONTROL&".
                    "activationlink=".$gdcud->getOutputData("taskcontrol_qs")."\"/>Activate Account</a></li>";
                $o .= "</ul>";
                $o .= "<br/><img src=\"http://".gdconfig()->getSiteAlias()."/gd.trxn.com/mimes/images/logos/gdLogo_w45h70.png\"/>";
                $o .= "</body>";
                $o .= "</html>";
                
                $url = "http://".gdconfig()->getSiteAlias().
                    "/gd.trxn.com/usersafety/_controls/ajax/USER_ACCESS.php?GD_CONTROL_KEY=TASK_CONTROL&activationlink=".
                    $gdcud->getOutputData("taskcontrol_qs");
                
                if(!gdconfig()->isLandscapeLocal())
                {
                    $gdcud->sendmail("stephen@guyverdesigns.com",
                                    "Validate Account - ".$gdcud->getOutputData("useraccount_nickname"),
                                    $o);
                }
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "ACCOUNT_IS_PENDING"
                                                        ,"RETURN_SHOW_MSG", "TRUE"
                                                        ,"RETURN_MSG", "Please check email for account activation email."
                                                        ,"TRXN_URL", "$url"
                                                        ,"ENV_KEY", gdconfig()->getLandscapeKey()
                                                        ,"USER_TYPE", "SITE_USER"));
            }
            else if($fr == "EMAIL_IN_USE")
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "EMAIL_IN_USE"
                                                            ,"RETURN_SHOW_MSG", "TRUE"
                                                            ,"RETURN_MSG", "E-Mail in use."));
            }
            else if($fr == "TABLEKEY_IN_USE")
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "TABLEKEY_IN_USE"
                                                            ,"RETURN_SHOW_MSG", "TRUE"
                                                            ,"RETURN_MSG", "Nickname in use."));
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
    else if($action == "TASK_CONTROL")
    {
        $fv = validateTaskControlForm();
        if($fv == true)
        {
            $gda = new gdActivation();
            $fr = $gda->activation(filter_var($_GET["activationlink"], FILTER_SANITIZE_STRING));
            if($fr == "RECORD_IS_UPDATED")
            {
                gdlog()->LogInfo("GDBuildHtmlMessage():Build Activation Email:".gdconfig()->getSiteAlias());
                $tab = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                $o = "<html>";
                $o .= "<head>";
                $o .= "<title>User Activated</title>";
                $o .= "</head>";
                $o .= "<body>";
                $o .= "<ul>";
                $o = "<li>Nickname:" . $gda->getOutputData("useraccount_nickname") . "</li>";
                $o = "<li>Email:" . $gda->getOutputData("useraccount_email") . "</li>";
                $o .= "<li>First Name:" . $gda->getOutputData("userprofile_firstname") . "</li>";
                $o .= "<li>Last Name:" . $gda->getOutputData("userprofile_lastname") . "</li>";
                $o .= "<li>Activation Link:<a href=\"http://".gdconfig()->getSiteAlias().gdconfig()->getRedirectAuthLoggedinPage()."\"/>Login</a></li>";
                $o .= "</ul>";
                $o .= "<br/><img src=\"http://".gdconfig()->getSiteAlias()."/gd.trxn.com/mimes/images/logos/gdLogo_w45h70.png\"/>";
                $o .= "</body>";
                $o .= "</html>";
                
                if(!gdconfig()->isLandscapeLocal())
                {
                    $gda->sendmail("stephen@guyverdesigns.com",
                                    "Validate Account - ".$gda->getOutputData("useraccount_nickname"),
                                    $o);
                }
                gdconfig()->redirectToUIPage(1, "USER_ACTIVATED", "User has been activated", gdconfig()->getRedirectAuthFailPage());
            }
            else
            {
                gdconfig()->redirectToUIPage(200, "USER_NOT_ACTIVATED", "User has not been activated", gdconfig()->getRedirectAuthFailPage());
            }
        }
        else
        {
            gdconfig()->redirectToUIPage(200, "FORM_FIELDS_NOT_VALID", "Activation Code has not been provided.", gdconfig()->getRedirectAuthFailPage());
        }
    }
    else if($action == "LOGIN_USER")
    {
        $fv = validateLoginForm();
        if($fv == true)
        {
            $gdau = new gdAuthenticateUser();
            $fr = $gdau->authenticateByEmail(filter_var($_POST["email"], FILTER_SANITIZE_STRING),
                                            filter_var($_POST["password"], FILTER_SANITIZE_STRING));
            if($fr == "ACCOUNT_INACTIVE")
            {
                gdconfig()->redirectToUIPage(101, $fr, "Account Inactive User needs to Activate", gdconfig()->getRedirectAuthFailPage());
            }
            else if($fr == "TOO_MANY_FAILED_LOGIN_ATTEMPTS")
            {
                gdconfig()->redirectToUIPage(102, $fr, "Account Locked.  Too many failed Attempts.", gdconfig()->getRedirectAuthFailPage());
            }
            else if($fr == "USER_IS_AUTHENTICATED")
            {
                gdconfig()->redirectToUIPage(0, $fr, "User Logged in", gdconfig()->getRedirectAuthLoggedinPage());
            }
            else if($fr == "PASSWORD_DOES_NOT_MATCH")
            {
                gdconfig()->redirectToUIPage(103, $fr, "Bad login", gdconfig()->getRedirectAuthFailPage());
            }
            else if($fr == "RECORD_NOT_FOUND_BY_EMAIL")
            {
                gdconfig()->redirectToUIPage(104, $fr, "User Account not Found.", gdconfig()->getRedirectAuthFailPage());
            }
            else if($fr == "TRANSACTION_FAIL")
            {
                gdconfig()->redirectToUIPage(999, $fr, "System Failure", gdconfig()->getRedirectAuthFailPage());
            }
        }
        else
        {
            gdconfig()->redirectToUIPage(999, "FORM_FIELDS_NOT_VALID", "Login Form Fields not Filled In", gdconfig()->getRedirectAuthFailPage());
        }
    }
    else if($action == "ACTIVATE_ACCOUNT")
    {
        $fv = validateActivateUserForm();
        gdlog()->LogInfo("Run ACtivation setup-{".filter_var($_POST["email"], FILTER_SANITIZE_STRING)."}");
        if($fv == true)
        {
            gdlog()->LogInfo("Run ACtivation setup-{".filter_var($_POST["email"], FILTER_SANITIZE_STRING)."}");
            $gda = new gdActivation();
            $fr = $gda->generateTaskControlLink(filter_var($_POST["email"], FILTER_SANITIZE_STRING));
            if($fr == "RECORD_IS_CREATED")
            {
                gdlog()->LogInfo("GDBuildHtmlMessage():Build Activation Email:".gdconfig()->getSiteAlias());
                $tab = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                $o = "<html>";
                $o .= "<head>";
                $o .= "<title>User Activation</title>";
                $o .= "</head>";
                $o .= "<body>";
                $o .= "<ul>";
                $o = "<li>Nickname:" . $gda->getOutputData("useraccount_nickname") . "</li>";
                $o = "<li>Email:" . $gda->getOutputData("useraccount_email") . "</li>";
                $o .= "<li>First Name:" . $gda->getOutputData("userprofile_firstname") . "</li>";
                $o .= "<li>Last Name:" . $gda->getOutputData("userprofile_lastname") . "</li>";
                $o .= "<li>Activation Link:<a href=\"http://".gdconfig()->getSiteAlias().
                    "/gd.trxn.com/usersafety/_controls/ajax/TASK_CONTROL.php".
                    "?GD_CONTROLLER_KEY=TASK_CONTROL".
                    "&activationlink=".$gda->getOutputData("taskcontrol_qs")."\"/>Activate Account</a></li>";
                $o .= "</ul>";
                $o .= "<br/><img src=\"http://".gdconfig()->getSiteAlias()."/gd.trxn.com/mimes/images/logos/gdLogo_w45h70.png\"/>";
                $o .= "</body>";
                $o .= "</html>";
                
                $url = "http://".gdconfig()->getSiteAlias().
                    "/gd.trxn.com/usersafety/_controls/ajax/USER_ACCESS.php?GD_CONTROL_KEY=TASK_CONTROL".
                    "&activationlink=".$gda->getOutputData("taskcontrol_qs");
                
                if(!gdconfig()->isLandscapeLocal())
                {
                    $gda->sendmail("stephen@guyverdesigns.com",
                                    "Validate Account - ".$gda->getOutputData("useraccount_nickname"),
                                    $o);
                }
                
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "ACCOUNT_IS_PENDING"
                                                        ,"RETURN_SHOW_MSG", "TRUE"
                                                        ,"RETURN_MSG", "Please check email for account activation email."
                                                        ,"TRXN_URL", "$url"
                                                        ,"ENV_KEY", gdconfig()->getLandscapeKey()
                                                        ,"USER_TYPE", "SITE_USER"));
            }
            else if($fr == "EMAIL_NOT_FOUND")
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "EMAIL_NOT_FOUND"
                                                            ,"RETURN_SHOW_MSG", "TRUE"
                                                            ,"RETURN_MSG", "E-Mail in use."));
            }
        }
        else
        {
            $echoret = json_encode(buildReturnArray("RETURN", "FORM_FIELDS_NOT_VALID"
                                                , "RETURN_SHOW_MSG", "TRUE"
                                                , "RETURN_MSG", "Please fill in Registration form completely"));
        }
    }
}
else
{
    gdconfig()->cleanAuthoritySessionData();
    gdconfig()->redirectToUIPage(1, "LOGOFF", "User is Logged Off", gdconfig()->getRedirectAuthLoggedoffPage());
}
gdLogEchoReturn($echoret);
echo $echoret;

function validateRegisterForm()
{
    $fv = true;  // Form is Valid Key T=Valid; anything else is invalid;
    $pass = "PASS";
    if (!isset($_POST["email"]) || $_POST["email"] == "")
        $pass = "email";
    if (!isset($_POST["password"]) || $_POST["password"] == "")
        $pass = "password";
    if (!isset($_POST["firstname"]) || $_POST["firstname"] == "")
        $pass = "firstname";
    if (!isset($_POST["lastname"]) || $_POST["lastname"] == "")
        $pass = "lastname";
    if (!isset($_POST["cfg_country_sdesc"]) || $_POST["cfg_country_sdesc"] == "")
        $pass = "cfg_country_sdesc";
    if (!isset($_POST["cfg_region_sdesc"]) || $_POST["cfg_region_sdesc"] == "")
        $pass = "cfg_region_sdesc";
    if (!isset($_POST["city"]) || $_POST["city"] == "")
        $pass = "city";
    if (!isset($_POST["nickname"]) || $_POST["nickname"] == "")
        $pass = "nickname";
    
    if($pass == "PASS")
        return true;
    else
    {
        gdlog()->LogInfo("Bad Field :{".$pass."}");
        return false;
    }
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
    if (!isset($_POST["email"]) || $_POST["email"] == "")
        $fv = false;
    if (!isset($_POST["password"]) || $_POST["password"] == "")
        $fv = false;
    return $fv;
}

function validateActivateUserForm()
{
    $fv = true;  // Form is Valid Key T=Valid; anything else is invalid;
    if (!isset($_POST["email"]) || $_POST["email"] == "")
        $fv = false;
    return $fv;
}
?>