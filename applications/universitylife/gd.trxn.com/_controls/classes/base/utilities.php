<?php gdreqonce("/gd.trxn.com/_controls/classes/KLogger.php"); ?>
<?php
class ZGDUtilities
{
    private $zgdlog;
    
    function gdlog()
    {
        if(!isset($this->zgdlog))
            $this->zgdlog = new KLogger();
        return $this->zgdlog;
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
            $headers .= 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= "To:" . $to . "\r\n";
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