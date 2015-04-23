<?php require_once($_SERVER["SUBDOMAIN_DOCUMENT_ROOT"]."/gd.trxn.com/_controls/classes/_sys/_sysintegration.php"); ?>
<?php
class AppSysIntegration
    extends SysIntegration
{
    static $not_authorized_page = "/gd.trxn.com/usersafety/index.php";
    static function getRedirectAuthFailPage()
    {
        return AppSysIntegration::$not_authorized_page;
    }
    
    static $user_logged_in_correctly = "/s_user_home.php";
    static function getRedirectAuthLoggedinPage()
    {
        return AppSysIntegration::$user_logged_in_correctly;
    }
    
    static $user_logged_off_correctly = "/gd.trxn.com/usersafety/index.php";
    static function getRedirectAuthLoggedoffPage()
    {
        return AppSysIntegration::$user_logged_off_correctly;
    }
    
    static $user_change_password = "/gd.trxn.com/usersafety/changepassword.php";
    static function getRedirectAuthChangePasswordPage()
    {
        return AppSysIntegration::$user_change_password;
    }
    
    static $email_support_account = "support@guyverdesigns.com";
    static function getEmailSupportAccount()
    {
        return AppSysIntegration::$email_support_account;
    }
    
    static $email_admin_account = "stephen@guyverdesigns.com";
    static function getEmailAdminAccount()
    {
        return AppSysIntegration::$email_admin_account;
    }
}
?>