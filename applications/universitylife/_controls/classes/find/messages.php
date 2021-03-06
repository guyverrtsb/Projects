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
class zFindMessages
    extends zAppBaseObject
{

    function findAllMessages()
    {
        $this->gdlog()->LogInfoStartFUNCTION("findAllMessages");
        $usrtk = $this->getGDConfig()->getSessAuthUserTblKey();
        $fr;
        $sqlstmnt = "SELECT ".
        
            $this->dbfas("to_user_profile.fname, ".
            "from_user_profile.fname, ".
            "from_user_account.nickname, ".
            $usrtk."messages.isread, ".
            $usrtk."messages.createddt, ".
            $usrtk."messages.changeddt, ".
            $usrtk."messages.subject, ".
            $usrtk."messages.uid, ".
            "message_type_cfg.sdesc ", $usrtk)." ".
            
            "FROM ".$usrtk."messages ".
            "JOIN user_account AS to_user_account ".
            " ON to_user_account.uid = ".$usrtk."messages.to_user_account_uid ".
            "JOIN match_user_account_to_user_profile AS to_user_match_user_account_to_user_profile ".
            " ON to_user_match_user_account_to_user_profile.user_account_uid = to_user_account.uid ".
            "JOIN user_profile AS to_user_profile ".
            " ON to_user_profile.uid = to_user_match_user_account_to_user_profile.user_profile_uid ".
            
            "JOIN user_account AS from_user_account ".
            " ON from_user_account.uid = ".$usrtk."messages.from_user_account_uid ".
            "JOIN match_user_account_to_user_profile AS from_user_match_user_account_to_user_profile ".
            " ON from_user_match_user_account_to_user_profile.user_account_uid = from_user_account.uid ".
            "JOIN user_profile AS from_user_profile ".
            " ON from_user_profile.uid = from_user_match_user_account_to_user_profile.user_profile_uid ".
            
            "JOIN cfg_defaults AS message_type_cfg ".
            " ON message_type_cfg.uid = ".$usrtk."messages.cfg_message_type_uid ".
            "WHERE to_user_account_uid=:to_user_account_uid";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":to_user_account_uid", $this->getGDConfig()->getSessAuthUserUid());
        $dbcontrol->execSelect();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResult_List($dbcontrol->getStatement()->fetchAll(PDO::FETCH_ASSOC));
                $this->gdlog()->LogInfoDB($this->getResult_List());
                $fr = $this->gdlog()->LogInfoRETURN("MESSAGES_FOUND");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("MESSAGES_NOT_FOUND");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("findAllMessages");
        return $fr;
    }

    private $Result_List = "NO_RECORD";
    function setResult_List($row)
    {
        $this->Result_List = $row;
    }
    
    function getResult_List()
    {
        return $this->Result_List;
    }
    
    function cleanResult_List()
    {
        $this->Result_List = "NO_RECORD";
    }
}
?>