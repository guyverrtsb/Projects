<?php gdreqonce("/gd.trxn.com/_controls/classes/KLogger.php"); ?>
<?php
class ZGDLogging
{
    private $zgdlog;
    
    function gdlog()
    {
        if(!isset($this->zgdlog))
            $this->zgdlog = new KLogger ( $_SERVER['GDLOG_LOCATION'] , $_SERVER['GDLOG_PRIORITY'] );
        return $this->zgdlog;
    }
}
?>