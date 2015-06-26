<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class EmailBase
    extends AppSysBaseObject
{
    function __construct()
    {
    }
    
    /*
     * Use this to Send Email
     * to : To Field
     * subject : Subject Field
     * $message : Message body
     */
    function sendmail($to, $from, $subject, $message)
    {
        // if "email" is filled out, send email
        //$email = $email;
        $subject = $subject;
        $message = $message;
        $headers = "";
            $headers .= "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
            $headers .= "From:" . $from . "\r\n";
            $headers .= "BCC:support@guyverdesigns.com\r\n";
            $headers .= "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
    
        mail($to,
            $subject,
            $message,
            $headers);
    }
}
?>