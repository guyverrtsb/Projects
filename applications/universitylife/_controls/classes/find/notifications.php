<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/*
 * Author: Stephen Shellenberger
 * Copyright: 2013 Stephen Shellenberger
 * Date: 2013/01/05
 * This Class file is for Finding User data
 * is the primary object
 * 1. findUid123fromUid
 */
class zFindNotifications
    extends zAppBaseObject
{

    function countNotifications($cfs_messge_type_sdesc)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findGroupRequest");
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
                $this->setResult_RequestLists($dbcontrol->getStatement()->fetchAll(PDO::FETCH_ASSOC));
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
        $this->gdlog()->LogInfoEndFUNCTION("findGroupRequest");
        return $fr;
    }

    private $Result_RequestLists = "NO_RECORDS";
    function setResult_RequestLists($row)
    {
        $this->Result_RequestLists = $row;
    }
    
    function getResult_RequestLists()
    {
        return $this->Result_RequestLists;
    }
    
    function clearResult_RequestLists()
    {
        $this->Result_RequestLists = "NO_RECORDS";
    }
}
?>