<?php require_once($_SERVER["SUBDOMAIN_DOCUMENT_ROOT"]."/gd.trxn.com/_controls/classes/_sys/_sysintegration.php"); ?>
<?php
class AppSysIntegration
    extends SysIntegration
{
    private $not_authorized_page = "/gd.trxn.com/usersafety/index.php";
    function getRedirectAuthFailPage()
    {
        return $this->not_authorized_page;
    }
    
    private $user_logged_in_correctly = "/s_user_home.php";
    function getRedirectAuthLoggedinPage()
    {
        return $this->user_logged_in_correctly;
    }
    
    private $user_logged_off_correctly = "/gd.trxn.com/usersafety/index.php";
    function getRedirectAuthLoggedoffPage()
    {
        return $this->user_logged_off_correctly;
    }
    
    private $user_change_password = "/gd.trxn.com/usersafety/changepassword.php";
    function getRedirectAuthChangePasswordPage()
    {
        return $this->user_change_password;
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
    
    private $default_page_title = "SeeMeU - Education, Access and Collaboration for All";
    function setDefaultPageTitle($pageTitle)
    {
        $this->default_page_title = $pageTitle;
    }
    
    function getDefaultPageTitle()
    {
        return $this->default_page_title;
    }
}
?>