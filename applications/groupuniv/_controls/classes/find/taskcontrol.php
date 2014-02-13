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
class zFindTaskControl
    extends zAppBaseObject
{

    function findUid123fromUid($activationlink)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findUid123fromUid");
        $fr;
        $sqlstmnt = "SELECT * from task_control_links ".
            "WHERE uid1=:uid1 AND uid2=:uid2 AND uid3=:uid3";
        
        $al = explode(":", $activationlink);
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":uid1", $al[0]);
        $dbcontrol->bindParam(":uid2", $al[1]);
        $dbcontrol->bindParam(":uid3", $al[2]);
        $dbcontrol->execSelect();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResult_TempLink($dbcontrol->getStatement()->fetch(PDO::FETCH_ASSOC));
                $this->gdlog()->LogInfoDB($this->getResult_TempLink());
                $fr = $this->gdlog()->LogInfoRETURN("UID123_FOUND");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("UID123_NOT_FOUND");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("findUid123fromUid");
        return $fr;
    }

    private $Result_TempLink = "No_RECORD";
    function setResult_TempLink($row)
    {
        $this->Result_TempLink = $row;
    }
    
    function getResult_TempLink()
    {
        return $this->Result_TempLink;
    }
    
    function getTL_Uid(){return $this->Result_TempLink["uid"];}
    function getTaskKey(){return $this->Result_TempLink["task_key"];}
    function getUid1(){return $this->Result_TempLink["uid1"];}
    function getUid2(){return $this->Result_TempLink["uid2"];}
    function getUid3(){return $this->Result_TempLink["uid3"];}
    function getRecordUid(){return $this->Result_TempLink["record_uid"];}
    
    function getTempLink()
    {
        $tl = $this->getUid1().":".$this->getUid2().":".$this->getUid3();
        return $tl;
    }
}
?>