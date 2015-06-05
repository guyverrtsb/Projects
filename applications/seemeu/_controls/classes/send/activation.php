<?php zReqOnce("/_controls/classes/dataobjects/base/email.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class Activation
    extends EmailBase
{
    function __construct()
    {
    }
    
    function sendActivationofGamerAccount($args)
    {
        zLog()->LogStartFUNCTION("sendActivationofGamerAccount");
        
        // $this->sendmail($to, $from, $subject, $message);TASKKEY

        zLog()->LogDebug("Build Activation Email:".$_SESSION['GUYVERDESIGNS_SITE_ALIAS']);
        
        $url = "http://".$_SESSION['GUYVERDESIGNS_SITE_ALIAS'].
            "/_controls/CONTROL.php?AJAX_SERVICE_CONTROL_KEY=TASK_CONTROL&TASKKEY=".
            $args["taskcontrollink_uid1"]."{}".$args["taskcontrollink_uid2"]."{}".$args["taskcontrollink_uid3"];
        
        $tab = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        $o = "<html>";
        $o .= "<head>";
        $o .= "<title>Gamer Activation</title>";
        $o .= "</head>";
        $o .= "<body>";
        $o .= "<ul>";
        $o .= "<li>Gamer Tag:" . $args["gameraccount_gamertag"] . "</li>";
        $o .= "<li>Nickname:" . $args["useraccount_nickname"] . "</li>";
        $o .= "<li>Email:" . $args["useraccount_email"] . "</li>";
        $o .= "<li>First Name:" . $args["userprofile_firstname"] . "</li>";
        $o .= "<li>Last Name:" . $args["userprofile_lastname"] . "</li>";
        $o .= "<li>Activation Link:<a href=\"".$url."\"/>Activate Account</a></li>";
        $o .= "</ul>";
        $o .= "<br/><img src=\"http://zealcon.com.previewdns.com/wp-content/uploads/2014/04/white-logo.png\"/>";
        $o .= "</body>";
        $o .= "</html>";
        
        zLog()->LogDebug($o);
        
        $envkey = zAppSysIntegration()->isLandscapeLocal();
        
        if(!$envkey)
        {
            $this->sendmail($args["useraccount_email"],
                            "stephen@guyverdesigns.com",
                            "Validate Account - ".$args["useraccount_email"],
                            $o);
        }
        
        $this->setSysReturnStructure("RETURN_KEY", "ACCOUNT_IN_PENDING"
                                ,"RETURN_SHOW_PASS_MSG", "TRUE"
                                ,"RETURN_MSG", "Please check email for account activation email."
                                ,"TRXN_URL", "$url"
                                ,"IS_ENV_LCL", $envkey
                                ,"USER_TYPE", "SITE_USER");
                                
        zLog()->LogDebug("TASK Url {".$this->getSysReturnitem("TRXN_URL")."}");  
        
        zLog()->LogEndFUNCTION("sendActivationofGamerAccount");
    }
    
    function sendResetofGamerPassword($args)
    {
        zLog()->LogStartFUNCTION("sendResetofGamerPassword");
        
        // $this->sendmail($to, $from, $subject, $message);TASKKEY

        zLog()->LogDebug("Build Activation Email:".$_SESSION['GUYVERDESIGNS_SITE_ALIAS']);
        
        $url = "http://".$_SESSION['GUYVERDESIGNS_SITE_ALIAS'].
            "/_controls/CONTROL.php?AJAX_SERVICE_CONTROL_KEY=TASK_CONTROL&TASKKEY=".
            $args["taskcontrollink_uid1"]."{}".$args["taskcontrollink_uid2"]."{}".$args["taskcontrollink_uid3"];
        
        $tab = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        $o = "<html>";
        $o .= "<head>";
        $o .= "<title>Gamer Password Reset</title>";
        $o .= "</head>";
        $o .= "<body>";
        $o .= "<ul>";
        $o .= "<li>Gamer Tag:" . $args["gameraccount_gamertag"] . "</li>";
        $o .= "<li>Nickname:" . $args["useraccount_nickname"] . "</li>";
        $o .= "<li>Email:" . $args["useraccount_email"] . "</li>";
        $o .= "<li>First Name:" . $args["userprofile_firstname"] . "</li>";
        $o .= "<li>Last Name:" . $args["userprofile_lastname"] . "</li>";
        $o .= "<li>Reset Password Link:<a href=\"".$url."\"/>Reset Password</a></li>";
        $o .= "</ul>";
        $o .= "<br/><img src=\"http://zealcon.com.previewdns.com/wp-content/uploads/2014/04/white-logo.png\"/>";
        $o .= "</body>";
        $o .= "</html>";
        
        zLog()->LogDebug($o);
        
        $envkey = zAppSysIntegration()->isLandscapeLocal();
        
        if(!$envkey)
        {
            $this->sendmail($args["useraccount_email"],
                            "stephen@guyverdesigns.com",
                            "Validate Account - ".$args["useraccount_email"],
                            $o);
        }
        
        $this->setSysReturnStructure("RETURN_KEY", "ACCOUNT_IN_PENDING"
                                ,"RETURN_SHOW_PASS_MSG", "TRUE"
                                ,"RETURN_MSG", "Please check email for account activation email."
                                ,"TRXN_URL", "$url"
                                ,"IS_ENV_LCL", $envkey
                                ,"USER_TYPE", "SITE_USER");
                                
        zLog()->LogDebug("TASK Url {".$this->getSysReturnitem("TRXN_URL")."}");  
        
        zLog()->LogEndFUNCTION("sendResetofGamerPassword");
    }
}
?>