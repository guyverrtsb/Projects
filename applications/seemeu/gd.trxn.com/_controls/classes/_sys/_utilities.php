<?php zReqOnce("/gd.trxn.com/_controls/classes/_sys/database/_connections.php"); ?>
<?php zReqOnce("/gd.trxn.com/_controls/classes/KLogger.php"); ?>
<?php
class SysUtilities
{
    public function saveActivityLog($fr, $notes)
    {
        zLog()->LogInfoStartFUNCTION("saveActivityLog");
        $sqlstmnt = "INSERT INTO activity_log SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "sdesc=:sdesc, notes=:notes";

        $dbcontrol = new SysConnections();
        $dbcontrol->setApplicationDB("crossapplication");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":sdesc", $fr);
        $dbcontrol->bindParam(":notes", $notes);
        $numrows = $dbcontrol->execUpdate();
/*
        for ($idx = 0; $idx < sizeof($dbcontrol->getErrorNumAry()); $idx++)
        {
            $en = $dbcontrol->getErrorNumAry();
            $em = $dbcontrol->getErrorMsgAry();
            $rc = $dbcontrol->getRowCount();
            $li = $dbcontrol->getLastInsertID();
            $dbcontrol->setErrorContainer($en[$idx], $em[$idx], $rc[$idx], $li[$idx]);
        }
*/
        $dbcontrol->rollbackcommit();
        zLog()->LogInfoRETURN($fr);
        zLog()->LogInfoEndFUNCTION("saveActivityLog");
        return $fr;
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
    
    /*
     * database field AS
     */
    public function dbfas($fieldinput, $usertablekey = "NOT_DEFINED")
    {
        $fns = explode(",", $fieldinput);
        $fieldoutput = "";
        $cntr = 0;
        foreach($fns as $fn)
        {
            $cntr++;
            $fn = trim($fn);
            $fo = "AS ".str_replace(".", "_", $fn);
            if($usertablekey != "NOT_DEFINED")
            {
                $fo = str_replace($usertablekey, "", $fo);
            }
            zLog()->LogInfo("BASE OBJECT:DBFAS:".$fn."{".$fo."}");
            $fieldoutput = $fieldoutput.$fn." ".$fo;
            if(count($fns) > $cntr)
                $fieldoutput = $fieldoutput.",";
        }
        zLog()->LogInfo("BASE OBJECT:DBFAS[".count($fns)."]:fieldoutput {".$fieldoutput."}");
        return $fieldoutput;
    }
    
    /*
     * Database Field
     */
    public function dbf($fieldinput)
    {
        $fieldoutput = str_replace(".", "_", $fieldinput);
        zLog()->LogInfo("BASE OBJECT:DBF:".$fieldinput."{".$fieldoutput."}");
        return $fieldoutput;
    }
    
    function getDATE_FORMAT($date)
    {
        return "DATE_FORMAT(".$date.", \"%m/%d/%Y\")";
    }
    
    function getDAY_FORMAT($date)
    {
        return "DATE_FORMAT(".$date.", \"%W\")";
    }
    
    function getmySQLDateTimeStamp($date)
    {
        $odate = date("Y-m-d h:i:s", strtotime($date));
        return $odate;
    }
    
    function createUserTableKey($usertablekey)
    {
        $usertablekey = createSdesc($usertablekey);
        return "X_".$usertablekey."_";
    }
    
    function createSdesc($import)
    {
        $export = preg_replace('/[^a-zA-Z0-9]/', '', $import);
        $export = str_replace(' ', '_', strtoupper($export));
        if(strlen($export) >= 100)
            $export = $export.substring(0, 99);
        return strtoupper($export);
    }
}
?>