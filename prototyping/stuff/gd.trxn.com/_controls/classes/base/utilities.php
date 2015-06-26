<?php gdreqonce("/gd.trxn.com/_controls/classes/KLogger.php"); ?>
<?php
class ZGDUtilities
{
    private $zgdlog, $zgdconfig;
    
    function gdlog()
    {
        if(!isset($this->zgdlog))
            $this->zgdlog = new KLogger();
        return $this->zgdlog;
    }
    
    function sendmail($to, $subject, $message)
    {
        // if "email" is filled out, send email
        //$email = $email;
        $subject = $subject;
        $message = $message;
        $headers = "";
            $headers .= "From:" . $to . "\r\n";
            $headers .= "BCC:audit@guyverdesigns.com\r\n";
            $headers .= "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
    
        mail($to,
            $subject,
            $message,
            $headers);
    }
}
?>