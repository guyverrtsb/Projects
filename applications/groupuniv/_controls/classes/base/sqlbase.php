<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
class zSqlBaseObject
    extends zAppBaseObject

{
    // START - Record Container
    private $Result_Records = array();
    private $Result_Record = array();
    function setResult_Records($rows, $key="DEFAULT")
    {
        $this->Result_Records[$key] = $rows;
    }
    
    function getResult_Records($key="DEFAULT")
    {
        return $this->Result_Records[$key];
    }
    
    function cleanResult_Records()
    {
        $this->Result_Records = array();
    }
    
    function setResult_Record($row, $key="DEFAULT")
    {
        $this->Result_Record[$key] = $row;
    }
    
    function getResult_Record($key="DEFAULT")
    {
        return $this->Result_Record[$key];
    }
    
    function cleanResult_Record()
    {
        $this->Result_Record = array();
    }

    function getResult_RecordField($name, $key="DEFAULT")
    {
        $row = $this->getResult_Record($key);
        return $row[$name];
    }
    // END - Record Container
    
    
    // START - DATA Functions
    function getDATE_FORMAT($date)
    {
        return "DATE_FORMAT(".$date.", \"%m/%d/%Y\")";
    }
    
    function getDAY_FORMAT($date)
    {
        return "DATE_FORMAT(".$date.", \"%W\")";
    }
    // END - DATA Functions
    
    function selectcount($sql)
    {
        $this->gdlog()->LogInfoStartFUNCTION("countNotifications");
        $usrtk = $this->getGDConfig()->getSessAuthUserTblKey();
        $fr;
        $sqlstmnt = "SELECT COUNT(cfg_defaults.sdesc) ".
            "FROM x_stephen_notifications AS notifications ".
            "JOIN cfg_defaults ".
            " ON cfg_defaults.uid = notifications.cfg_message_type_uid ".
            "JOIN ".$usrtk."messages AS messages ".
            " ON messages.uid = notifications.message_uid ".
            "WHERE cfg_defaults.sdesc=:cfg_defaults_sdesc ".
            "AND messages.isread=:messages_isread";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":messages_isread", strtoupper("F"));
        $dbcontrol->bindParam(":cfg_defaults_sdesc", strtoupper($cfs_messge_type_sdesc));
        $dbcontrol->execSelect();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResult_Records($dbcontrol->getStatement()->fetchAll(PDO::FETCH_ASSOC));
                $this->gdlog()->LogInfoDB($this->getResult_RequestLists());
                $fr = $this->gdlog()->LogInfoRETURN("REQUEST_LIST_FOUND");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("REQUEST_LIST_NOT_FOUND");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("countNotifications");
        return $fr;
    }
}
?>