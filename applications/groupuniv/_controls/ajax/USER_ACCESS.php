<?php require_once("../../gd.trxn.com/_controls/classes/_core.php"); ?>
<?php gdreqonce("/_controls/classes/find/university.php"); ?>
<?php gdreqonce("/_controls/classes/register/university.php"); ?>
<?php gdreqonce("/_controls/classes/match/university.php"); ?>
<?php gdreqonce("/_controls/classes/find/user.php"); ?>
<?php gdreqonce("/_controls/classes/register/user.php"); ?>
<?php gdreqonce("/_controls/classes/match/user.php"); ?>
<?php gdreqonce("/_controls/classes/register/group.php"); ?>
<?php gdreqonce("/_controls/classes/match/group.php"); ?>
<?php gdreqonce("/_controls/classes/find/group.php"); ?>
<?php gdreqonce("/_controls/classes/register/search.php"); ?>
<?php gdreqonce("/_controls/classes/register/wallmessage.php"); ?>
<?php gdreqonce("/_controls/classes/register/taskcontrol.php"); ?>
<?php
$echoret = "";
$action = getControlKey();
if($action != "INVALID")
{
    gdlog()->LogInfoTaskLabel("Load Config");
    $gdconfig = gdconfig();
    if($action == "REGISTER_USER")
    {
        if(validateRegisterForm())
        {
            gdlog()->LogInfoTaskLabel("Find User");
            $zfuser = new zFindUser();
            $remailfound = $zfuser->findAccountandProfileByEmail($_POST["user_email"]);
            $rnicknamefound = $zfuser->findAccountandProfileByNickname($_POST["user_nickname"]);

            if($remailfound == "ACCOUNT_NOT_FOUND" && $rnicknamefound == "ACCOUNT_NOT_FOUND")
            {
                gdlog()->LogInfo("USER_DOES_NOT_EXISTS");

                $emailkey = explode("@", $_POST["user_email"]);
                $edu = explode(".", $emailkey[1]);

                if(strtoupper($edu[1]) == "EDU" || strtoupper($emailkey[1]) == "GUYVERDESIGNS.COM")
                {
                    gdlog()->LogInfo("DO_USER_CREATION");
	
                    $zfuniv = new zFindUniversity();
                    $r = $zfuniv->findAccountandProfileByEmailKey($emailkey[1]);
                    if($r == "ACCOUNT_FOUND")
                    {
                        //**** Create User Accounts
                        $zruser = new zRegisterUser();
                        $r = $zruser->registerUserAccount($_POST["user_email"], 
                                                        $_POST["user_password"],
                                                        $_POST["user_nickname"]);
                        $r = $zruser->registerUserProfile($_POST["user_firstname"],
                                                        $_POST["user_lastname"], 
                                                        $_POST["user_city"], 
                                                        $_POST["user_region"], 
                                                        $_POST["user_country"],
                                                        "");
                        $zruser->createUserTables($zruser->getUserTableKey());
    
                        $zmuser = new zMatchUser();
                        $r = $zmuser->matchUsertoProfile($zruser->getUA_Uid(),
                                                        $zruser->getUP_Uid());
                                                        
                        if(strtoupper($emailkey[1]) == "GUYVERDESIGNS.COM")
                        {
                            $r = $zmuser->matchUsertoCfgSiteRoleSdesc($zruser->getUA_Uid(), "USER_ROLE_SITE_ADMIN");
                        }
                        else
                        {
                            $r = $zmuser->matchUsertoCfgSiteRoleSdesc($zruser->getUA_Uid(), "USER_ROLE_SITE_USER");
                        }
                        
                        // Register the Temp Link
                        $zrtc = new zRegisterTaskControl();
                        $r = $zrtc->registerTask("ACTIVATE_USER", $zruser->getUA_Uid());
                        // Get Temp Link
                        if($r == "TASK_IS_REGISTERED")
                        {
                            gdlog()->LogInfo("GDBuildHtmlMessage():Build Activation Email:".$_SESSION['GUYVERDESIGNS_SITE_ALIAS']);
                            $tab = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                            $o = "<html>";
                            $o .= "<head>";
                            $o .= "<title>User Activation</title>";
                            $o .= "</head>";
                            $o .= "<body>";
                            $o .= "<ul>";
                            $o = "<li>Nickname:" . $zruser->getNickname() . "</li>";
                            $o = "<li>Email:" . $zruser->getEmail() . "</li>";
                            $o .= "<li>First Name:" . $zruser->getFName() . "</li>";
                            $o .= "<li>Last Name:" . $zruser->getLName() . "</li>";
                            $o .= "<li>Activation Link:<a href=\"http://".$_SESSION['GUYVERDESIGNS_SITE_ALIAS'].
                                "/_controls/ajax/TASK_CONTROL.php?GD_CONTROL_KEY=TASK_CONTROL&".
                                "activationlink=".$zrtc->getTempLink()."\"/>Activate Account</a></li>";
                            $o .= "</ul>";
                            $o .= "<br/><img src=\"http://".$_SESSION['GUYVERDESIGNS_SITE_ALIAS'].
                                "/gd.trxn.com/mimes/images/logos/Guyver-Designs-Web-Site-Logo-w188h59.png\"/>";
                            $o .= "</body>";
                            $o .= "</html>";
                            
                            $url = "http://".$_SESSION['GUYVERDESIGNS_SITE_ALIAS'].
                                "/_controls/ajax/TASK_CONTROL.php?GD_CONTROL_KEY=TASK_CONTROL&activationlink=".$zrtc->getTempLink();
                            
                            if(!gdconfig()->isLandscapeLocal())
                            {
                                $zrtc->sendmail("stephen@guyverdesigns.com",
                                                $zruser->getEmail(),
                                                "Validate Account - ".$zruser->getEmail(),
                                                $o);
                            }
                            $echoret = json_encode(buildReturnArray("RETURN_KEY", "ACCOUNT_IN_PENDING"
                                                                    ,"RETURN_SHOW_PASS_MSG", "TRUE"
                                                                    ,"RETURN_MSG", "Please check email for account activation email."
                                                                    ,"TRXN_URL", "$url"
                                                                    ,"ENV_KEY", gdconfig()->getLandscapeKey()
                                                                    ,"USER_TYPE", "SITE_USER"
                                                                    ,"USER_EMAIL", $zruser->getEmail()));
                        }
                        else
                        {
                            $echoret = json_encode(buildReturnArray("RETURN_KEY", "TASK_IS_NOT_REGISTERED"
                                            ,"RETURN_SHOW_PASS_MSG", "TRUE"
                                            ,"RETURN_MSG", "Task has not been registered"
                                            ,"USER_TYPE", "SITE_USER"));
                        }
                    }
                    else
                    {
                        $echoret = json_encode(buildReturnArray("RETURN_KEY", "UNIVERSITY_DOMAIN_NOT_VALID"
                                            ,"RETURN_SHOW_PASS_MSG", "TRUE"
                                            ,"RETURN_MSG", "We have not registered your university yet."
                                                                    ,"USER_TYPE", "SITE_USER"));
                    }
                }
                else
                {
                    $echoret = json_encode(buildReturnArray("RETURN_KEY", "EMAIL_KEY_NOT_EDU"
                                            ,"RETURN_SHOW_PASS_MSG", "TRUE"
                                            ,"RETURN_MSG", "Please use a .EDU Account for registering"));
                }
            }
            else if($remailfound == "ACCOUNT_FOUND")
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "EMAIL_IN_USE"
                                                ,"RETURN_SHOW_PASS_MSG", "TRUE"
                                                ,"RETURN_MSG", "The E-maill address supplied has been used previously."));
            }
            else if ($rnicknamefound == "ACCOUNT_FOUND")
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "KNICKNAME_IN_USE"
                                                ,"RETURN_SHOW_PASS_MSG", "TRUE"
                                                ,"RETURN_MSG", "Please choose another nickname."));
            }
            else
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "UNKNOWN_ERROR"
                                                ,"RETURN_SHOW_PASS_MSG", "TRUE"
                                                ,"RETURN_MSG", "Unknown Error"));
            }
        }
        else
        {
            $echoret = json_encode(buildReturnArray("RETURN_KEY", "FORM_FIELDS_NOT_VALID"
                                                ,"RETURN_SHOW_PASS_MSG", "TRUE"
                                                ,"RETURN_MSG", "APlease enter in all of the requried fields."));
        }
    }
    else if($action == "LOGIN_USER")
    {
        if(validateLoginForm())
        {
            gdreqonce("/_controls/classes/allowed.php");
            $zallowed = new zAllowed();
            $user_email= filter_var($_POST["user_email"], FILTER_SANITIZE_STRING);
            $user_password = filter_var($_POST["user_password"], FILTER_SANITIZE_STRING);
            
            $fr = $zallowed->authenticate($user_email, $user_password);
            gdlog()->LogInfo("LOGIN_USER:fr:".$fr);
           
            if($fr == "ACCOUNT_INACTIVE")
            {
                $gdconfig->redirectToLogin(101, $fr, "Account Inactive User needs to be activated");
            }
            else if($fr == "USER_IS_LOCKED_TOO_MANY_TRIES")
            {
                $gdconfig->redirectToLogin(102, $fr, "Account Locked.  Too many failed attempts.");
            }
            else if($fr == "USER_NOT_FOUND")
            {
                $gdconfig->redirectToLogin(103, $fr, "User info not valid");
            }
            else if($fr == "USER_IS_AUTHENTICATED")
            {
                $gdconfig->setUserObjects($zallowed);
                if(gdconfig()->getSessAuthUserSiteRole() == "USER_ROLE_SITE_GOD")
                {
                    $gdconfig->redirectToLogin(105, $fr, "User Logged in as God", "/siteadmin/s_admin_account.php");
                }
                else if(gdconfig()->getSessAuthUserSiteRole() == "USER_ROLE_SITE_ADMIN")
                {
                    $gdconfig->redirectToLogin(105, $fr, "User Logged in as Admin", "/siteadmin/s_admin_account.php");
                }
                else
                {
                    $emailkey = explode("@", $zallowed->getUA_Email());
                    $zfuniv = new zFindUniversity();
                    $fr = $zfuniv->findAccountandProfileByEmailKey($emailkey[1]);
                    if($fr == "ACCOUNT_FOUND")
                    {
                        $gdconfig->setUniversityObjects($zfuniv);
                        $gdconfig->redirectToLogin(0, $fr, "User Logged in", "/siteuser/s_user_account.php");
                    }
                    else
                    {
                        $gdconfig->redirectToLogin(105, $fr, "No University Associated");
                    }
                }
            }
            else if($fr == "USER_IS_NOT_AUTHENTICATED")
            {
                $gdconfig->redirectToLogin(103, $fr, "Bad login");
            }
            else if($fr == "USER_IS_NOT_FOUND")
            {
                $gdconfig->redirectToLogin(104, $fr, "User Account not Found.");
            }
            else if($fr == "TRANSACTION_FAIL")
            {
                $gdconfig->redirectToLogin(104, $fr, "User Authentication Failed.");
            }
        }
        else
        {
            $gdconfig->redirectToLogin(999, "FORM_FIELDS_NOT_VALID", "Form Fields not Filled In");
        }
    }
}
gdLogEchoReturn($echoret);
echo $echoret;

function validateRegisterForm()
{
    $fv = true;  // Form is Valid Key T=Valid; anything else is invalid;
    if (!isset($_POST["user_email"]) || $_POST["user_email"] == "")
        $fv = false;
    if (!isset($_POST["user_password"]) || $_POST["user_password"] == "")
        $fv = false;
    if (!isset($_POST["user_firstname"]) || $_POST["user_firstname"] == "")
        $fv = false;
    if (!isset($_POST["user_lastname"]) || $_POST["user_lastname"] == "")
        $fv = false;
    if (!isset($_POST["user_city"]) || $_POST["user_city"] == "")
        $fv = false;
    if (!isset($_POST["user_region"]) || $_POST["user_region"] == "")
        $fv = false;
    if (!isset($_POST["user_country"]) || $_POST["user_country"] == "")
        $fv = false;
    if (!isset($_POST["user_nickname"]) || $_POST["user_nickname"] == "")
        $fv = false;
    return $fv;
}

function validateLoginForm()
{
    $fv = true;  // Form is Valid Key T=Valid; anything else is invalid;
    if (!isset($_POST["user_email"]) || $_POST["user_email"] == "")
        $fv = false;
    if (!isset($_POST["user_password"]) || $_POST["user_password"] == "")
        $fv = false;
    return $fv;
}
?>