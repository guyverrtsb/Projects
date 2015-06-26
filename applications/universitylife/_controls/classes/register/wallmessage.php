<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/**
 * Author: Stephen Shellenberger
 * Copyright: 2013 Stephen Shellenberger
 * Date: 2013/01/05
 */

class zRegisterWallMessage
    extends zAppBaseObject
{
    /**
     * Register Wall Message.
     * $group_account_uid = group account uid;
     * $from_user_account_uid = user account uid;
     */
    function registerWallMessage($group_account_uid, $from_user_account_uid, $wall_message, $mimes_uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("registerWallMessage");
        $utk = $this->getGDConfig()->getSessUnivTblKey();
        $fr;
        $sqlstmnt = "INSERT INTO ".$utk."wall_message SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "group_account_uid=:group_account_uid, ".
            "user_account_uid=:from_user_account_uid, ".
            "content=:wall_message, mimes_uid=:mimes_uid";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":group_account_uid", $group_account_uid);
        $dbcontrol->bindParam(":from_user_account_uid", $from_user_account_uid);
        $dbcontrol->bindParam(":wall_message", $wall_message);
        $dbcontrol->bindParam(":mimes_uid", $mimes_uid);
        $dbcontrol->execUpdate();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResult_WallMessage($dbcontrol->getRowfromLastId($dbcontrol, $utk."wall_message", $dbcontrol->getLastInsertID()));
                $this->gdlog()->LogInfoDB($this->getResult_WallMessage());
                $fr = $this->saveActivityLog("WALL_MESSAGE_IS_REGISTERED", "Wall Message has been registered:".json_encode($this->getResult_WallMessage()).":");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("WALL_MESSAGE_IS_NOT_REGISTERED");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("registerWallMessage");
        return $fr;
    }

    /**
     * Register Wall Message Comment.
     * $group_account_uid = group account uid;
     * $from_user_account_uid = user account uid;
     */
    function registerWallMessageComment($group_account_uid,
        $from_user_account_uid,
        $wall_message_comment,
        $wall_message_uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("registerWallMessageComment");
        $utk = $this->getGDConfig()->getSessUnivTblKey();
        $fr;
        $sqlstmnt = "INSERT INTO ".$utk."wall_message_comment SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "group_account_uid=:group_account_uid, ".
            "user_account_uid=:from_user_account_uid, ".
            "content=:wall_message_comment, wall_message_uid=:wall_message_uid";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":group_account_uid", $group_account_uid);
        $dbcontrol->bindParam(":from_user_account_uid", $from_user_account_uid);
        $dbcontrol->bindParam(":wall_message_comment", $wall_message_comment);
        $dbcontrol->bindParam(":wall_message_uid", $wall_message_uid);
        $dbcontrol->execUpdate();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResult_WallMessageComment($dbcontrol->getRowfromLastId($dbcontrol, $utk."wall_message_comment", $dbcontrol->getLastInsertID()));
                $this->gdlog()->LogInfoDB($this->getResult_WallMessageComment());
                $fr = $this->saveActivityLog("WALL_MESSAGE_COMMENT_IS_REGISTERED", "Wall Message has been registered:".json_encode($this->getResult_WallMessageComment()).":");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("WALL_MESSAGE_COMMENT_IS_NOT_REGISTERED");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("registerWallMessageComment");
        return $fr;
    }

    private $Result_WallMessage = "NO_RECORD";
    private $Result_WallMessageComment = "NO_RECORD";
    function setResult_WallMessage($row)
    {
        $this->Result_WallMessage = $row;
    }    
    
    function getResult_WallMessage()
    {
        return $this->Result_WallMessage;
    }
    
    function setResult_WallMessageComment($row)
    {
        $this->Result_WallMessageComment = $row;
    }  
    
    function getResult_WallMessageComment()
    {
        return $this->Result_WallMessageComment;
    }
    
    function getWM_Uid(){return $this->Result_WallMessage["uid"];}
    function getWM_UserAcctUid(){return $this->Result_WallMessage["user_account_uid"];}
    function getWM_GroupAcctUid(){return $this->Result_WallMessage["group_account_uid"];}
    function getWM_Content(){return $this->Result_WallMessage["content"];}
    function getMimesUid(){return $this->Result_WallMessage["mimes_uid"];}
    
    function getWMC_Uid(){return $this->Result_WallMessageComment["uid"];}
    function getWMC_UserAcctUid(){return $this->Result_WallMessage["user_account_uid"];}
    function getWMC_GroupAcctUid(){return $this->Result_WallMessage["group_account_uid"];}
    function getMessageUid(){return $this->Result_WallMessage["wall_message_uid"];}
    function getWMC_Content(){return $this->Result_WallMessage["content"];}
}
?>