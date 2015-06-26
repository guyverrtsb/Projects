<?php require_once("../../../_controls/classes/_core.php"); ?>
<?php
if(isset($_POST["GD_CONTROLLER_KEY"]))
{
    $action = filter_var($_POST["GD_CONTROLLER_KEY"], FILTER_SANITIZE_STRING);
    if($action == "REGISTER_USER")
    {
        $fv = validateRegisterForm();
        if($fv == "T")
        {
            gdlog()->LogInfo("validateRegisterForm:".$fv);
            gdreqonce("/gd.trxn.com/usersafety/_controls/classes/createuser.php");
            $zcnur = new Z_Create_NewUser_References($_POST["user_email"]);
            $r = $zcnur->doesEmailExist();
            gdlog()->LogInfo("doesEmailExist:".$r);
            if($r == "EMAIL_NOT_IN_USE")
            {
                $r = $zcnur->registerUserAccount($_POST["user_password"]);
                $r = $zcnur->registerUserProfile($_POST["user_firstname"],
                    $_POST["user_lastname"],
                    $_POST["user_city"],
                    $_POST["user_state"],
                    $_POST["user_country"],
                    $_POST["user_nickname"]);
                $r = $zcnur->matchUserAccounttoProfile();
                $r = $zcnur->matchUserAccounttoSite();
                $r = $zcnur->registerTempLink();
                echo "ACCOUNT_PROFILE_CREATED";
            }
            else
            {
                echo "EMAIL_IN_USE";
            }
        }
        else
        {
            gdlog()->LogInfo("validateRegisterForm:".$fv);
            echo "FORM_FIELDS_NOT_VALID";
        }
    }
    else if($action == "LOGIN_USER")
    {
        gdreqonce("/gd.trxn.com/usersafety/_controls/classes/authenticate.php");
        $zgdauth = new Z_GD_Authorization();
        
    	$fv = validateLoginForm();
        if($fv == "T")
        {
            gdlog()->LogInfo("validateLoginForm:".$fv);
            
            $email= filter_var($_POST["user_email"], FILTER_SANITIZE_STRING);
            $password = filter_var($_POST["user_password"], FILTER_SANITIZE_STRING);
            
            gdlog()->LogInfo("validateLoginForm:email:".$email.":password:".$password.":");
            
            $r = $zgdauth->authenticate($email, $password);
            gdlog()->LogInfo("authenticate:".$r);
            if($r == "ACCOUNT_INACTIVE")
            {
                $zgdauth->redirectToLogin(101, $r, "Account Inactive User needs to Activate");
            }
            else if($r == "USER_IS_LOCKED_TOO_MANY_TRIES")
            {
                $zgdauth->redirectToLogin(102, $r, "Account Locked.  Too many failed Attempts.");
            }
            else if($r == "USER_IS_AUTHENTICATED")
            {
                $zgdauth->redirectToLogin(0, $r, "User Logged in", "/gd.trxn.com/usersafety/isuserloggedon.php");
            }
            else if($r == "BAD_LOGIN")
            {
                $zgdauth->redirectToLogin(103, $r, "Bad login");
            }
            else if($r == "USER_IS_NOT_FOUND")
            {
                $zgdauth->redirectToLogin(104, $r, "User Account not Found.");
            }
            else if($r == "TRANSACTION_FAIL")
            {
                $zgdauth->redirectToLogin(999, $r, "System Failure");
            }
        }
        else
        {
            gdlog()->LogInfo("validateLoginForm:".$fv);
            $zgdauth->redirectToLogin(999, "FORM_FIELDS_NOT_VALID", "Form Fields not Filled In");
        }
    }
}
else
{
    echo "GD_CONTROLLER_KEY_NOT_VALID";
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
    if (!isset($_POST["user_state"]) || $_POST["user_state"] == "")
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