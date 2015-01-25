<?php zReqOnce("/gd.trxn.com/_controls/classes/_sys/_utilities.php"); ?>
<?php
class SysDatabase
    extends SysUtilities
{
    private $connection = null;
    private $statement = null;
    private $transactionSuccessful = TRUE;
    private $rollBackCommitPerformed = FALSE;
    private $errorMsg = array();
    private $errorNum = array();
    private $numRows = array();
    private $lastId = array();
    
    /** Get the Connection currently instantiated **/
    public function setConnection($connection) { $this->connection = $connection; }
    public function getConnection() { return $this->connection; }
    
    public function setStatement($sqlstatement)
    {
        zLog()->LogInfo("setStatement():".$sqlstatement);
        $this->statement = $this->getConnection()->prepare($sqlstatement);
    }
    public function getStatement() { return $this->statement; }
    
    public function bindParam($name, $value)
    {
        zLog()->LogInfo("bindParam()--{".$name."}-{".$value."}");
        $this->getStatement()->bindParam($name, $value);
    }
    
    public function bindParamDateTime($name, $value)
    {
        zLog()->LogInfo("bindParamDateTime()--{".$name."}-{".$value."}");
        $value = $this->getmySQLDateTimeStamp($value);
        $this->getStatement()->bindParam($name, $value);
    }
    
    public function bindParamBlob($name, $value) {
        zLog()->LogInfo("bindParam()--{".$name."}-{BLOB}");
        $this->getStatement()->bindParam($name, $value);
    }
    
    public function execUpdate()
    {
        if($this->getStatement()->execute())
        {
            zLog()->LogInfo("execUpdate():Good Transaction.");
            $this->setTransactionSuccessful();
            $this->setErrorContainer("NO_ERROR_CODE", "NO_ERROR_INFO",
                $this->getRowCount(), $this->getLastInsertID());
        }
        else
        {
            zLog()->LogInfo("execUpdate():Failed Transaction:".$this->getStatement()->errorInfo());
            $this->setTransactionFailure();
            $this->setErrorContainer($this->getStatement()->errorCode(), $this->getStatement()->errorInfo(),
                "-1", "-1");
        }
    }
    
    public function execSelect()
    {
        if($this->getStatement()->execute())
        {
            zLog()->LogInfo("execSelect():Good Transaction.");
            $this->setTransactionSuccessful();
            $this->setErrorContainer("NO_ERROR_CODE", "NO_ERROR_INFO",
                $this->getRowCount(), "-1");
        }
        else
        {
            zLog()->LogInfoERROR("execSelect():Failed Transaction:".$this->getStatement()->errorInfo());
            $this->setTransactionFailure();
            $this->setErrorContainer($this->getStatement()->errorCode(), $this->getStatement()->errorInfo(),
                "-1", "-1");
        }
    }
    
    public function getLastInsertID() {  return $this->getConnection()->lastInsertId(); }
    public function getRowCount() {  return $this->getStatement()->rowCount(); }
    
    public function getRowfromLastId($dbcontrol, $dbname, $lid)
    {
        $sqlstmnt = "SELECT * FROM ".$dbname." ".
        "WHERE lid=:lid";
        
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":lid", $lid);
        $dbcontrol->execSelect();
        if($dbcontrol->getRowCount() > 0)
        {
            zLog()->LogInfo("getRowfromLastId():Good Transaction:".$dbname.":".$lid);
            $row = $dbcontrol->getStatement()->fetch(PDO::FETCH_ASSOC);
            return $row;
        }
        else
        {
            zLog()->LogInfo("getRowfromLastId():Failed Transaction:".$dbname);
        }
    }
    
    public function getRowfromLastUid($dbcontrol, $dbname, $uid)
    {
        $sqlstmnt = "SELECT * FROM ".$dbname." ".
        "WHERE uid=:uid";
        
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":uid", $uid);
        $dbcontrol->execSelect();
        if($dbcontrol->getRowCount() > 0)
        {
            zLog()->LogInfo("getRowfromLastUid():Good Transaction:".$dbname.":".$lid);
            $row = $dbcontrol->getStatement()->fetch(PDO::FETCH_ASSOC);
            return $row;
        }
        else
        {
            zLog()->LogInfo("getRowfromLastUid():Failed Transaction:".$dbname);
        }
    }
    
    public function closeAll()
    {
        if(!$this->rollBackCommitPerformed)
            $this->rollbackcommit();
        if($this->getStatement() != null)
        {
            $this->getStatement()->closeCursor();
            $this->statement = null;
        }
    }
    
    public function setTransactionSuccessful() { $this->transactionSuccessful = TRUE; }
    public function setTransactionFailure() { $this->transactionSuccessful = FALSE; }
    public function getTransactionGood() { return $this->transactionSuccessful; }
    
    public function rollbackcommit()
    {
        $this->rollBackCommitPerformed = true;
        if($this->transactionSuccessful)
        {
            zLog()->LogInfo("rollbackcommit():Good Commit");
            $this->getConnection()->commit();
        }
        else
        {
            zLog()->LogInfo("rollbackcommit():Bad Commit");
            $this->getConnection()->rollback();
        }
    }
    
    public function setErrorContainer($errnum, $errmsg, $numRows, $lastId)
    {
        $this->errorNum[sizeof($this->errorNum)] = $errnum;
        $this->errorMsg[sizeof($this->errorMsg)] = $errmsg;
        $this->numRows[sizeof($this->numRows)] = $numRows;
        $this->lastId[sizeof($this->lastId)] = $lastId;
    }
    
    public function getErrorNumAry() { return $this->errorNum; }
    public function getErrorMsgAry() { return $this->errorMsg; }
    public function getNumRowsAry() { return $this->numRows; }
    public function getLastIdAry() { return $this->lastId; }
        
    public function getErrorContainerJSON()
    {
        $o = "";
        for ($idx = 0; $idx < sizeof($this->errorNum); $idx++)
        {
            $o .= ",";
            $o .= "errorNum=".$this->errorNum[$idx];
            $o .= "---";
            $o .= "errorMsg=".$this->errorMsg[$idx];
            $o .= "---";
            $o .= "rowCount=".$this->numRows[$idx];
            $o .= "---";
            $o .= "lastId=".$this->lastId[$idx];
        }
        return $o;
    }
        
    public function getErrorContainerHTML()
    {
        $o = "";
        for ($idx = 0; $idx < sizeof($this->errorNum); $idx++)
        {
            $o .= "<br/>";
            $o .= "errorNum=".$this->errorNum[$idx];
            $o .= "<br/>";
            $o .= "errorMsg=".$this->errorMsg[$idx];
            $o .= "<br/>";
            $o .= "rowCount=".$this->numRows[$idx];
            $o .= "<br/>";
            $o .= "lastId=".$this->lastId[$idx];
            $o .= "<br/>";
        }
        return $o;
    }
    
    public function getErrorContainerJSAlert()
    {
        $o = "";
        for ($idx = 0; $idx < sizeof($this->errorNum); $idx++)
        {
            $o .= "\n";
            $o .= "errorNum=".$this->errorNum[$idx];
            $o .= "\n";
            $o .= "errorMsg=".$this->errorMsg[$idx];
            $o .= "\n";
            $o .= "rowCount=".$this->numRows[$idx];
            $o .= "\n";
            $o .= "lastId=".$this->lastId[$idx];
            $o .= "\n";
        }
        return $o;
    }
    
    public function getSelectResultJSON()
    {
        $o = "";
        $numargs = func_num_args();
        $rc = 0;
        while($row = $this->getStatement()->fetch(PDO::FETCH_ASSOC))
        {
            if($rc > 0)
                $o .= ",";
            $o .= "{";
            for($ci = 0; $ci < $numargs; $ci++)
            {
                if($ci > 0)
                    $o .= ",";
                $arg = func_get_arg($ci);
                $o .= "\"".$arg."\":\"".$row[$arg]."\"";
            }
            $o .= "}";
            $rc++;
        }
        return $o;
    }
}
?>