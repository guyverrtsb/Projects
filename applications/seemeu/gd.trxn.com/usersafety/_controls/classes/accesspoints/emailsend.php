<?php zReqOnce("/gd.trxn.com/crossapplication/_controls/classes/dataobjects/base/email.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class UsersafetyActivation
    extends EmailBase
{
    function __construct()
    {
    }
    
    function sendUseraccountActivation($args)
    {
        zLog()->LogStart_AccessPointFunction("sendUseraccountActivation");
        
        // $this->sendmail($to, $from, $subject, $message);TASKKEY

        zLog()->LogDebug("Build Activation Email:".$_SESSION['GUYVERDESIGNS_SITE_ALIAS']);
        
        $url = "http://".$_SESSION['GUYVERDESIGNS_SITE_ALIAS'].
            "/_controls/CONTROLLER.php?SERVICE_CONTROL_KEY=TASK_CONTROL&TASKKEY=".
            $args["taskcontrollink_uid1"]."{}".$args["taskcontrollink_uid2"]."{}".$args["taskcontrollink_uid3"];
        
        $tab = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        $o = "<html>";
        $o .= "<head>";
        $o .= "<title>Gamer Activation</title>";
        $o .= "</head>";
        $o .= "<body>";
        $o .= "<ul>";
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
        
        $this->setSysReturnStructure("RETURN_CODE", "ACCOUNT_IN_PENDING"
                                    ,"RETURN_MSG", "Please check email for account activation email."
                                    ,"RETURN_SHOW_MSG", "TRUE"
                                    ,"TRXN_URL", "$url"
                                    ,"IS_ENV_LCL", $envkey
                                    ,"USER_TYPE", "SITE_USER");
                                
        zLog()->LogDebug("TASK Url {".$this->getSysReturnitem("TRXN_URL")."}");  
        
        zLog()->LogEnd_AccessPointFunction("sendUseraccountActivation");
    }
    
    function sendUseraccountPasswordReset($args)
    {
        zLog()->LogStart_AccessPointFunction("sendUseraccountPasswordReset");
        
        // $this->sendmail($to, $from, $subject, $message);TASKKEY

        zLog()->LogDebug("Build Activation Email:".$_SESSION['GUYVERDESIGNS_SITE_ALIAS']);
        
        $url = "http://".$_SESSION['GUYVERDESIGNS_SITE_ALIAS'].
            "/_controls/CONTROLLER.php?SERVICE_CONTROL_KEY=TASK_CONTROL&TASKKEY=".
            $args["taskcontrollink_uid1"]."{}".$args["taskcontrollink_uid2"]."{}".$args["taskcontrollink_uid3"];
        
        $tab = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        $o = "<html>";
        $o .= "<head>";
        $o .= "<title>Gamer Password Reset</title>";
        $o .= "</head>";
        $o .= "<body>";
        $o .= "<ul>";
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
        
        $this->setSysReturnStructure("RETURN_CODE", "ACCOUNT_IN_PENDING"
                                    ,"RETURN_MSG", "Please check email for account activation email."
                                    ,"RETURN_SHOW_MSG", "TRUE"
                                    ,"TRXN_URL", "$url"
                                    ,"IS_ENV_LCL", $envkey
                                    ,"USER_TYPE", "SITE_USER");
                                
        zLog()->LogDebug("TASK Url {".$this->getSysReturnitem("TRXN_URL")."}");  
        
        zLog()->LogEnd_AccessPointFunction("sendUseraccountPasswordReset");
    }
}
?>