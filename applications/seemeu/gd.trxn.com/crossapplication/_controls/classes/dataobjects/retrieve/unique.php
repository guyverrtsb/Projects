<?php zReqOnce("/gd.trxn.com/crossapplication/_controls/classes/dataobjects/base/unique.php"); ?>
<?php
class CountUnique
    extends UniqueBase
{ 
    function __construct()
    {
    }

    private $uniqueCounter = 0;
    public function countUniqueFieldValue($APPDB, $tablename, $fieldname, $fieldvalue)
    {
        zLog()->LogStartDATAOBJECTFUNCTION("countUniqueFieldValue");
        $sqlstmnt = "SELECT COUNT(lid) AS numofrecords
             FROM ".$tablename."
             WHERE ".$fieldname."=:".$fieldname;

        $appcon = new SysConnections();
        $appcon->setApplicationDB($APPDB);
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":".$fieldname, $fieldvalue);
        $appcon->execSelect();
        
        $this->resultRetrieveRecord($appcon);
        
        zLog()->LogEndDATAOBJECTFUNCTION("countUniqueFieldValue");
    }
}
?>