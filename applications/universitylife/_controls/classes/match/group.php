<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/**
 * Author: Stephen Shellenberger
 * Copyright: 2013 Stephen Shellenberger
 * Date: 2013/01/05
 */

class zMatchGroup
    extends zAppBaseObject
{
    /**
     * Match Group to Profile
     * $university_account_uid = UID
     * $university_profile_uid = UID
     */
    function matchGrouptoProfile($group_account_uid, $group_profile_uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("matchGrouptoProfile");
        $utk = $this->getGDConfig()->getSessUnivTblKey();
        $fr;
        $sqlstmnt = "INSERT INTO ".$utk."match_group_account_to_group_profile SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "group_account_uid=:group_account_uid, ".
            "group_profile_uid=:group_profile_uid";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":group_account_uid", $group_account_uid);
        $dbcontrol->bindParam(":group_profile_uid", $group_profile_uid);
        $dbcontrol->execUpdate();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResult_AcounttoProfile($dbcontrol->getRowfromLastId($dbcontrol, $utk."match_group_account_to_group_profile", $dbcontrol->getLastInsertID()));
                $this->gdlog()->LogInfoDB($this->getResult_AcounttoProfile());
                $fr = $this->saveActivityLog("MATCHED_GROUP_TO_PROFILE", "Group and Profile has been matched:".json_encode($this->getResult_AcounttoProfile()).":");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("NOT_MATCHED_GROUP_TO_PROFILE");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("matchGrouptoProfile");
        return $fr;
    }

    private $Result_AcounttoProfile = "NO_RECORD";
    function setResult_AcounttoProfile($row)
    {
        $this->Result_AcounttoProfile = $row;
    }
    
    function getResult_AcounttoProfile()
    {
        return $this->Result_AcounttoProfile;
    }
    
    function getGP_Uid(){$this->Result_AcounttoProfile["uid"];}
    function getGroupAcctid(){$this->Result_AcounttoProfile["group_account_uid"];}
    function getGroupProfileid(){$this->Result_AcounttoProfile["group_profile_uid"];}
}
?>