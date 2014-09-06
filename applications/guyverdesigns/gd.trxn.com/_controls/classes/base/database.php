<?php gdreqonce("/gd.trxn.com/_controls/classes/base/utilities.php"); ?>
<?php
class ZGDDatabase
    extends ZGDUtilities

{
    function getmySQLDateTimeStamp($date)
    {
        $odate = date("Y-m-d h:i:s", strtotime($date));
        return $odate;
    }
}
?>