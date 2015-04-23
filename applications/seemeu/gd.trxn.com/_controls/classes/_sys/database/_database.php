<?php zReqOnce("/gd.trxn.com/_controls/classes/_sys/_returns.php"); ?>
<?php
class SysDatabase
    extends SysReturns
{
    private $connection = null;
    private $statement = null;
    private $transactionSuccessful = TRUE;
    private $rollBackCommitPerformed = FALSE;
    
    // **************************** Connections and Statements
    public function setConnection($connection) { $this->connection = $connection; }
    public function getConnection() { return $this->connection; }
    public function setStatement($sqlstatement)
    {
        zLog()->LogInfo("setStatement():".$sqlstatement);
        $statementLen = strlen($sqlstatement);
        $statementTyp = strtoupper(substr($sqlstatement, 0, 6));
        $crudstate = "CRUD Not Found";
        if(($statementLen >= 5) && ($statementTyp == "INSERT"))
        {
            $crudstate = "CREATE";
        }
        else if(($statementLen >= 5) && ($statementTyp == "SELECT"))
        {
            $crudstate = "RETRIEVE";
        }
        else if(($statementLen >= 5) && ($statementTyp == "UPDATE"))
        {
            $crudstate = "UPDATE";
        }
        else if(($statementLen >= 5) && ($statementTyp == "DELETE"))
        {
            $crudstate = "DELETE";
        }
        zLog()->LogInfo("StatementLen{".$statementLen."}:StatementTyp{".$statementTyp."}:CRUD State:{".$crudstate."}");
        $this->statement = $this->getConnection()->prepare($sqlstatement);
    }
    public function getStatement() { return $this->statement; }
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
    // **************************** Connections and Statements
    
    // **************************** BINDS
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
    // **************************** BINDS
    
    // **************************** Executes
        public function execUpdate()
    {
        if($this->getStatement()->execute())
        {
            zLog()->LogInfo("execUpdate():Good Transaction.");
            $this->setTransactionSuccessful();
            $this->setSysReturnStructure("DB_ERROR_CODE", $this->getStatement()->errorCode(),
                                        "DB_ERROR_INFO" , $this->getStatement()->errorInfo(),
                                        "DB_ROW_COUNT", $this->getrowCount(),
                                        "DB_ROW_IDX_AFFECTED", "-1");
        }
        else
        {
            zLog()->LogInfoERROR("execUpdate():Failed Transaction:".$this->getStatement()->errorInfo());
            $this->setTransactionFailure();
            $this->setSysReturnStructure("DB_ERROR_CODE", $this->getStatement()->errorCode(),
                                        "DB_ERROR_INFO" , $this->getStatement()->errorInfo(),
                                        "DB_ROW_COUNT", "-1",
                                        "DB_ROW_IDX_AFFECTED", "-1");
        }
    }
    
    public function execSelect()
    {
        if($this->getStatement()->execute())
        {
            zLog()->LogInfo("execSelect():Good Transaction.");
            $this->setTransactionSuccessful();
            $this->setSysReturnStructure("DB_ERROR_CODE", $this->getStatement()->errorCode(),
                                        "DB_ERROR_INFO" , $this->getStatement()->errorInfo(),
                                        "DB_ROW_COUNT", $this->getrowCount(),
                                        "DB_ROW_IDX_AFFECTED", "-1");
        }
        else
        {
            zLog()->LogInfoERROR("execSelect():Failed Transaction:".$this->getStatement()->errorInfo());
            $this->setTransactionFailure();
            $this->setSysReturnStructure("DB_ERROR_CODE", $this->getStatement()->errorCode(),
                                        "DB_ERROR_INFO" , $this->getStatement()->errorInfo(),
                                        "DB_ROW_COUNT", "-1",
                                        "DB_ROW_IDX_AFFECTED", "-1");
        }
    }
    // **************************** Executes

    public function getRowCount()
    {
        $rcn = $this->getStatement()->rowCount();
        return $rcn;
    }
    
    public function getRowfromLastLid($appcon, $tablename)
    {
        $lid = $this->getConnection()->lastInsertId();
        zLog()->LogInfo("getLastRowId():{".$lid."}");
        $sqlstmnt = "SELECT * FROM ".$tablename." ".
        "WHERE lid=:lid";
        
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":lid", $lid);
        $appcon->execSelect();
        if($appcon->getRowCount() > 0)
        {
            zLog()->LogInfo("getRowfromLastId():Good Transaction:".$tablename);
            $row = $appcon->getStatement()->fetch(PDO::FETCH_ASSOC);
            return $row;
        }
        else
        {
            zLog()->LogInfoERROR("getLastRowId():Failed Transaction:".$tablename);
        }
    }
    
    public function getRowfromLastUid($appcon, $tablename, $uid)
    {
        $sqlstmnt = "SELECT * FROM ".$tablename." ".
        "WHERE uid=:uid";
        
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":uid", $uid);
        $appcon->execSelect();
        if($appcon->getRowCount() > 0)
        {
            zLog()->LogInfo("getRowfromLastUid():Good Transaction:".$tablename.":".$uid);
            $row = $appcon->getStatement()->fetch(PDO::FETCH_ASSOC);
            return $row;
        }
        else
        {
            zLog()->LogInfoERROR("getRowfromLastUid():Failed Transaction:".$tablename);
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
            zLog()->LogInfoERROR("rollbackcommit():Bad Commit");
            $this->getConnection()->rollback();
        }
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