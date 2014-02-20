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
if(isset($_POST["GD_CONTROLLER_KEY"]))
{
    $action = filter_var($_POST["GD_CONTROLLER_KEY"], FILTER_SANITIZE_STRING);
    $gdconfig = gdconfig();
    gdlog()->LogInfo("GD_CONTROLLER_KEY{".$action."}");
    if($action == "REGISTER_USER")
    {
        if(validateRegisterForm())
        {
            gdlog()->LogInfoTaskLabel("Find User");
            $zfuser = new zFindUser();
            $r = $zfuser->findAccountandProfileByEmail($_POST["user_email"]);
            if($r  == "ACCOUNT_NOT_FOUND")
            {
                gdlog()->LogInfo("USER_DOES_NOT_EXISTS:fr:".$r);

                $emailkey = explode("@", $_POST["user_email"]);
                $edu = explode(".", $emailkey[1]);
                
                if(strtoupper($emailkey[1]) == "GUYVERDESIGNS.COM")
                {
                    gdlog()->LogInfo("DO_ADMIN_CREATION:fr:".$r);
                    
                    //**** Create User Accounts
                    $r = $zruser = new zRegisterUser();
                    $r = $zruser->registerUserAccount($_POST["user_email"], 
                                                    $_POST["user_password"],
                                                    "T");
                    $r = $zruser->registerUserProfile($_POST["user_firstname"],
                                                    $_POST["user_lastname"], 
                                                    $_POST["user_city"], 
                                                    $_POST["user_region"], 
                                                    $_POST["user_country"], 
                                                    $_POST["user_nickname"],
                                                    "");
                    $zmuser = new zMatchUser();
                    $r = $zmuser->matchUsertoProfile($zruser->getUA_Uid(),
                                                    $zruser->getUP_Uid());
                                                    
                    $r = $zmuser->matchUsertoRoleSdesc($zruser->getUA_Uid(), "USER_ROLE_SITE_ADMIN");
                    
                    echo $r;
                }
                else if(strtoupper($edu[1]) == "EDU")
                {
                    gdlog()->LogInfo("DO_USER_CREATION:fr:".$r);
	
                    $zfuniv = new zFindUniversity();
                    $r = $zfuniv->findAccountandProfileByEmailKey($emailkey[1]);
                    if($r == "ACCOUNT_FOUND")
                    {
                        //**** Create User Accounts
                        $zruser = new zRegisterUser();
                        $r = $zruser->registerUserAccount($_POST["user_email"], 
                                                        $_POST["user_password"]);
                        $r = $zruser->registerUserProfile($_POST["user_firstname"],
                                                        $_POST["user_lastname"], 
                                                        $_POST["user_city"], 
                                                        $_POST["user_region"], 
                                                        $_POST["user_country"], 
                                                        $_POST["user_nickname"],
                                                        "");
    
                        $zmuser = new zMatchUser();
                        $r = $zmuser->matchUsertoProfile($zruser->getUA_Uid(),
                                                        $zruser->getUP_Uid());
                                                        
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
                                "/_controls/ajax/TASK_CONTROL.php?GD_CONTROLLER_KEY=TASK_CONTROL&".
                                "activationlink=".$zrtc->getTempLink()."\"/>Activate Account</a></li>";
                            $o .= "</ul>";
                            $o .= "<br/><img src=\"http://".$_SESSION['GUYVERDESIGNS_SITE_ALIAS'].
                                "/gd.trxn.com/mimes/images/logos/Guyver-Designs-Web-Site-Logo-w188h59.png\"/>";
                            $o .= "</body>";
                            $o .= "</html>";
                            
                            gdlog()->LogInfo("http://".$_SESSION['GUYVERDESIGNS_SITE_ALIAS'].
                                "/_controls/ajax/TASK_CONTROL.php?GD_CONTROLLER_KEY=TASK_CONTROL&".
                                "activationlink=".$zrtc->getTempLink());
                            
                            $zrtc->sendmail("stephen@guyverdesigns.com",
                                            "Validate Account - ".$zruser->getEmail(),
                                            $o);
                        }
                        echo $r;
                    }
                    else
                    {
                        gdlog()->LogInfo("User is not part of a university:fr:".$r);
                        echo $r;
                    }
                }
                else
                {
                	echo "EMAIL_KEY_NOT_EDU";
                }
            }
            else
            {
                echo $r;
            }
        }
        else
        {
            echo "FORM_FIELDS_NOT_VALID";
        }
    }
    else if($action == "LOGIN_USER")
    {
        $fv = validateLoginForm();
        if($fv == "T")
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
            else if($fr == "USER_IS_AUTHENTICATED")
            {
                $emailkey = explode("@", $_POST["user_email"]);
                if(strtoupper($emailkey[1]) == "GUYVERDESIGNS.COM")
                {
                    $gdconfig->setUserObjects($zallowed);
                    $gdconfig->redirectToLogin(105, $fr, "User Logged in", "/siteadmin/s_admin_account.php");
                }
                else
                {
                    $gdconfig->setUserObjects($zallowed);
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

function validateRegisterForm()
{
    $fv = "T";  // Form is Valid Key T=Valid; anything else is invalid;
    if (!isset($_POST["user_email"]) || $_POST["user_email"] == "")
        $fv = "F";
    if (!isset($_POST["user_password"]) || $_POST["user_password"] == "")
        $fv = "F";
    if (!isset($_POST["user_firstname"]) || $_POST["user_firstname"] == "")
        $fv = "F";
    if (!isset($_POST["user_lastname"]) || $_POST["user_lastname"] == "")
        $fv = "F";
    if (!isset($_POST["user_city"]) || $_POST["user_city"] == "")
        $fv = "F";
    if (!isset($_POST["user_region"]) || $_POST["user_region"] == "")
        $fv = "F";
    if (!isset($_POST["user_country"]) || $_POST["user_country"] == "")
        $fv = "F";
    if (!isset($_POST["user_nickname"]) || $_POST["user_nickname"] == "")
        $fv = "F";

    return $fv;
}

function validateLoginForm()
{
    $fv = "T";  // Form is Valid Key T=Valid; anything else is invalid;
    if (!isset($_POST["user_email"]) || $_POST["user_email"] == "")
        $fv = "F";
    if (!isset($_POST["user_password"]) || $_POST["user_password"] == "")
        $fv = "F";
    return $fv;
}
?>