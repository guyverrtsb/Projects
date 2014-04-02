<?php gdreqonce("/gd.trxn.com/_controls/classes/_config.php"); ?>
<?php
class ZAppConfigurations
    extends ZGDConfigurations
{
    static $not_authorized_page = "/gd.trxn.com/usersafety/index.php";
    static function getRedirectAuthFailPage()
    {
        return ZAppConfigurations::$not_authorized_page;
    }
    
    static $user_logged_in_correctly = "/s_user_home.php";
    static function getRedirectAuthLoggedinPage()
    {
        return ZAppConfigurations::$user_logged_in_correctly;
    }
    
    static $user_logged_off_correctly = "/gd.trxn.com/usersafety/index.php";
    static function getRedirectAuthLoggedoffPage()
    {
        return ZAppConfigurations::$user_logged_off_correctly;
    }
    
    static $email_support_account = "support@guyverdesigns.com";
    static function getEmailSupportAccount()
    {
        return ZAppConfigurations::$email_support_account;
    }
}
?>