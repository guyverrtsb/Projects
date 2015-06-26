<?php gdreqonce("/_controls/classes/connections/appdatabase.php"); ?>
<?php gdreqonce("/gd.trxn.com/_controls/classes/_config.php"); ?>
<?php
class zBaseObject
    extends zGDUtilities
{
    private $zgdconfig = null;
    public function saveActivityLog($fr, $notes)
    {
        $this->gdlog()->LogInfoStartFUNCTION("saveActivityLog");
        $sqlstmnt = "INSERT INTO activity_log SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "fdesc=:fdesc, notes=:notes";

        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("CROSSAPPDATA");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":fdesc", $fr);
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
        $this->gdlog()->LogInfoRETURN($fr);
        $this->gdlog()->LogInfoEndFUNCTION("saveActivityLog");
        return $fr;
    }
    
    /*
     * database field AS
     */
    public function dbfas($fieldinput, $univtablekey = "NOT_DEFINED")
    {
        $fns = explode(",", $fieldinput);
        $fieldoutput = "";
        $cntr = 0;
        foreach($fns as $fn)
        {
            $cntr++;
            $fn = trim($fn);
            $fo = "AS ".str_replace(".", "_", $fn);
            if($univtablekey != "NOT_DEFINED")
            {
                $fo = str_replace($univtablekey, "", $fo);
            }
            $this->gdlog()->LogInfo("BASE OBJECT:DBFAS:".$fn."{".$fo."}");
            $fieldoutput = $fieldoutput.$fn." ".$fo;
            if(count($fns) > $cntr)
                $fieldoutput = $fieldoutput.",";
        }
        $this->gdlog()->LogInfo("BASE OBJECT:DBFAS[".count($fns)."]:fieldoutput {".$fieldoutput."}");
        return $fieldoutput;
    }
    /*
     * Database Field
     */
    public function dbf($fieldinput)
    {
        $fieldoutput = str_replace(".", "_", $fieldinput);
        $this->gdlog()->LogInfo("BASE OBJECT:DBF:".$fieldinput."{".$fieldoutput."}");
        return $fieldoutput;
    }
    
    function getConfig()
    {
        if(!isset($this->zgdconfig) || $this->zgdconfig == null)
            $this->zgdconfig = new ZGDConfigurations();
        return $this->zgdconfig;
    }
}
?>