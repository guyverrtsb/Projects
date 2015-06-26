<?php require_once($_SERVER["SUBDOMAIN_DOCUMENT_ROOT"]."/gd.trxn.com/_controls/classes/_sys/_sysintegration.php"); ?>
<?php
class AppSysIntegration
    extends SysIntegration
{
    private $user_not_authorized_url = "/gd.trxn.com/usersafety/index.php";
    function getRedirectUserNotAuthorizedUrl()
    {
        return $this->user_not_authorized_url;
    }
    
    private $user_logged_on_successfully_url = "/s_user_home.php";
    function getRedirectUserLoggedOnSuccessfullyUrl()
    {
        return $this->user_logged_on_successfully_url;
    }
    
    private $user_logged_off_successfully_url = "/gd.trxn.com/usersafety/index.php";
    function getRedirectUserLoggedOffSuccessfullyUrl()
    {
        return $this->user_logged_off_successfully_url;
    }
    
    private $user_change_password_url = "/gd.trxn.com/usersafety/changepassword.php";
    function getRedirectUserChangePasswordUrl()
    {
        return $this->user_change_password_url;
    }
    
    private $user_login_url = "/gd.trxn.com/usersafety/login.php";
    function getRedirectUserLoginUrl()
    {
        return $this->user_login_url;
    }
    
    private $general_error_url = "/gd.trxn.com/system/error.php";
    function getRedirectGeneralErrorUrl()
    {
        return $this->general_error_url;
    }
    
    function getRedirectRefererUrl()
    {
        return $_SERVER['HTTP_REFERER'];
    }

    private $email_support_account = "support@guyverdesigns.com";
    function getEmailSupportAccount()
    {
        return $this->email_support_account;
    }
    
    private $email_admin_account = "stephen@guyverdesigns.com";
    function getEmailAdminAccount()
    {
        return $this->email_admin_account;
    }
    
    private $default_page_title = "SeeMeU :: Access to Education with Collaboration for All";
    function setDefaultPageTitle($pageTitle)
    {   
        $_SESSION["OVERRIDE_PAGE_TITLE"] = "SeeMeU :: ".$pageTitle;
    }
    
    function getDefaultPageTitle()
    {
        $pagetitle = "";
        if(isset($_SESSION["OVERRIDE_PAGE_TITLE"]))
        {
            $pagetitle = $_SESSION["OVERRIDE_PAGE_TITLE"];
            unset($_SESSION["OVERRIDE_PAGE_TITLE"]);
        }
        else
        {
            $pagetitle = $this->default_page_title;
        }
        return $pagetitle;
    }
}
?>