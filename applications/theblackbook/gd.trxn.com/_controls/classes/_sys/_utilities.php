<?php zReqOnce("/gd.trxn.com/_controls/classes/KLogger.php"); ?>
<?php
class SysUtilities
{    
    public function saveActivityLog($sdesc, $notes)
    {
        zLog()->LogStart_FUNCTION("saveActivityLog");
        
        zLog()->LogDebug("SDESC:[".$sdesc."]");
        zLog()->LogDebug("NOTES:[".$notes."]");
        
        $sqlstmnt = "INSERT INTO activitylog SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "sdesc=:sdesc, notes=:notes";

        $dbcontrol = new SysConnections();
        $dbcontrol->setApplicationDB("crossapplication");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":sdesc", $sdesc);
        $dbcontrol->bindParam(":notes", $notes);
        $dbcontrol->execUpdate();

        zLog()->LogEnd_FUNCTION("saveActivityLog");
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
            zLog()->LogDebug("BASE OBJECT:DBFAS:".$fn."{".$fo."}");
            $fieldoutput = $fieldoutput.$fn." ".$fo;
            if(count($fns) > $cntr)
                $fieldoutput = $fieldoutput.",";
        }
        zLog()->LogDebug("BASE OBJECT:DBFAS[".count($fns)."]:fieldoutput {".$fieldoutput."}");
        return $fieldoutput." ";
    }
    
    /*
     * Database Field
     */
    public function dbf($fieldinput)
    {
        $fieldoutput = str_replace(".", "_", $fieldinput);
        zLog()->LogDebug("BASE OBJECT:DBF:".$fieldinput."{".$fieldoutput."}");
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
        $export = "X_".$usertablekey."_";
        return $this->createSdescToupper($export);
    }
    
    function createSdescToupper($import)
    {
        $export = strtoupper($import);
        return $this->createSdesc($export);
    }
    
    function createSdesc($import)
    {
        $export = preg_replace('/[^a-zA-Z0-9]/', '', $import);
        $export = str_replace(' ', '_', $export);
        if(strlen($export) >= 100)
            $export = $export.substring(0, 99);
        return strtoupper($export);
    }
}
?>