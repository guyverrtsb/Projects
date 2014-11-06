<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/*
 * Author: Stephen Shellenberger
 * Copyright: 2013 Stephen Shellenberger
 * Date: 2013/01/07
 * This Class file is for Finding University Data
 * 1. findAllWallMessagesbyGroupUID - 
 * -- Use this to get all of the Wall Messages for a given Group
 * 2. getResults_AllWallMessageRecordsByGroupUID -
 * -- Use this to retrieve records
 * 3. findAllWallMessagesbyGroupUIDFromStartDateTime
 * -- Use this to get the list of Messages from a start
 * -- date and time.  This will ensure low load and
 * -- accurate results
 */
class zFindWallMessage
    extends zAppBaseObject
{
    /**
     * Find All Wall Messages with User account Information
     * use the getAllFoundUniversitiesAccountsandProfilesRecords
     * to get results
     */
    function findAllExistingWallMessages($group_account_uid,
                                        $wall_message_createddt_start,
                                        $wall_message_lid_bypass)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findAllExistingWallMessages");
        $utk = $this->getGDConfig()->getSessUnivTblKey();
        $fr;
        $sqlstmnt = "SELECT ".
        
            "IF((SELECT uid FROM ".$utk."match_user_account_to_group_account_to_cfg_user_roles ".
            "WHERE ".$utk."match_user_account_to_group_account_to_cfg_user_roles.user_account_uid = :user_account_uid ".
            "AND ".$utk."match_user_account_to_group_account_to_cfg_user_roles.group_account_uid = :group_account_uid) <> '', 'USER_IS_MEMBER', 'USER_IS_NOT_MEMBER') AS is_member_of_group ".
        
            ", ".$this->dbfas($utk."wall_message.lid, ".
                        $utk."wall_message.uid, ".
                        $utk."wall_message.user_account_uid, ".
                        $utk."wall_message.group_account_uid, ".
                        $utk."wall_message.content, ".
                        $utk."wall_message.createddt, ".
                        $utk."wall_message.mimes_uid, ".
                        "user_account.nickname, ".
                        "user_profile.fname, ".
                        "user_profile.lname, ".
                        "user_account.email", $utk)." ".
                        
            "from ".$utk."wall_message ".
            
            "join match_user_account_to_user_profile ".
            " on match_user_account_to_user_profile.user_account_uid = ".$utk."wall_message.user_account_uid ".
            "join user_account ".
            " on user_account.uid = match_user_account_to_user_profile.user_account_uid ".
            "join user_profile ".
            " on user_profile.uid = match_user_account_to_user_profile.user_profile_uid ".
            "WHERE ".$utk."wall_message.group_account_uid = :group_account_uid ".
            "AND ".$utk."wall_message.lid <> :wall_message_lid_bypass ";
            
            if($wall_message_createddt_start == "NOW")
                $sqlstmnt=$sqlstmnt."AND ".$utk."wall_message.createddt BETWEEN TIMESTAMP('2014-01-01 00:00:00') AND NOW() ";
            else
                $sqlstmnt=$sqlstmnt."AND ".$utk."wall_message.createddt BETWEEN TIMESTAMP('2014-01-01 00:00:00') AND TIMESTAMP(:wall_message_createddt_start) ";

            $sqlstmnt=$sqlstmnt."ORDER BY ".$utk."wall_message.createddt DESC LIMIT 0,10";
                        
        if($wall_message_lid_bypass == "EMPTY")
            $wall_message_lid_bypass = "";
                        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":user_account_uid", $this->getGDConfig()->getAuthUserUid());
        $dbcontrol->bindParam(":group_account_uid", $group_account_uid);
        $dbcontrol->bindParam(":wall_message_lid_bypass", $wall_message_lid_bypass);
        if($wall_message_createddt_start != "NOW")
            $dbcontrol->bindParam(":wall_message_createddt_start", $wall_message_createddt_start);
        $dbcontrol->execSelect();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResults_AllWallMessages($dbcontrol->getStatement()->fetchAll(PDO::FETCH_ASSOC));
                $this->gdlog()->LogInfoDB($this->getResults_AllWallMessages());
                $fr = $this->gdlog()->LogInfoRETURN("WALL_MESSAGES_FOUND");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("WALL_MESSAGES_NOT_FOUND");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("findAllExistingWallMessages");
        return $fr;
    }
    
    /**
     * Find All Wall Messages with User account Information starting from Date Time
     * use the getAllFoundUniversitiesAccountsandProfilesRecords
     * to get results
     */
    function findAllNewWallMessages($group_account_uid,
                                    $wall_message_createddt_start,
                                    $wall_message_lid_bypass)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findAllNewWallMessages");
        $utk = $this->getGDConfig()->getSessUnivTblKey();
        $fr;
        $sqlstmnt = "SELECT ".
        
            "IF((SELECT uid FROM ".$utk."match_user_account_to_group_account_to_cfg_user_roles ".
            "WHERE ".$utk."match_user_account_to_group_account_to_cfg_user_roles.user_account_uid = :user_account_uid ".
            "AND ".$utk."match_user_account_to_group_account_to_cfg_user_roles.group_account_uid = :group_account_uid) <> '', 'USER_IS_MEMBER', 'USER_IS_NOT_MEMBER') AS is_member_of_group ".
        
            ", ".$this->dbfas($utk."wall_message.lid, ".
                        $utk."wall_message.uid, ".
                        $utk."wall_message.user_account_uid, ".
                        $utk."wall_message.group_account_uid, ".
                        $utk."wall_message.content, ".
                        $utk."wall_message.createddt, ".
                        $utk."wall_message.mimes_uid, ".
                        "user_account.nickname, ".
                        "user_profile.fname, ".
                        "user_profile.lname, ".
                        "user_account.email", $utk).
                        
            " from ".$utk."wall_message ".
            
            "join match_user_account_to_user_profile ".
            " on match_user_account_to_user_profile.user_account_uid = ".$utk."wall_message.user_account_uid ".
            "join user_account ".
            " on user_account.uid = match_user_account_to_user_profile.user_account_uid ".
            "join user_profile ".
            " on user_profile.uid = match_user_account_to_user_profile.user_profile_uid ".
            "WHERE ".$utk."wall_message.group_account_uid = :group_account_uid ".
            "AND ".$utk."wall_message.lid <> :wall_message_lid_bypass ".
            "AND ".$utk."wall_message.createddt BETWEEN TIMESTAMP(:wall_message_createddt_start) AND NOW() ".
            "ORDER BY ".$utk."wall_message.createddt ASC";
            
        if($wall_message_lid_bypass == "EMPTY")
            $wall_message_lid_bypass = "";

        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":user_account_uid", $this->getGDConfig()->getAuthUserUid());
        $dbcontrol->bindParam(":group_account_uid", $group_account_uid);
        $dbcontrol->bindParam(":wall_message_lid_bypass", $wall_message_lid_bypass);
        $dbcontrol->bindParam(":wall_message_createddt_start", $wall_message_createddt_start);
        $dbcontrol->execSelect();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {

                $this->setResults_AllWallMessages($dbcontrol->getStatement()->fetchAll(PDO::FETCH_ASSOC));
                $this->gdlog()->LogInfoDB($this->getResults_AllWallMessages());
                $fr = $this->gdlog()->LogInfoRETURN("WALL_MESSAGES_FOUND");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("WALL_MESSAGES_NOT_FOUND");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("findAllNewWallMessages");
        return $fr;
    }
    
    /**
     * Find All Wall Messages with User account Information starting from Date Time
     * use the getAllFoundUniversitiesAccountsandProfilesRecords
     * to get results
     */
    function findAllWallMessageComments($wall_message_uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findAllWallMessageComments");
        $utk = $this->getGDConfig()->getSessUnivTblKey();
        $fr;
        $sqlstmnt = "SELECT ".
            $this->dbfas($utk."wall_message_comment.lid, ".
                        $utk."wall_message_comment.uid, ".
                        $utk."wall_message_comment.user_account_uid, ".
                        $utk."wall_message_comment.group_account_uid, ".
                        $utk."wall_message_comment.content, ".
                        $utk."wall_message_comment.createddt, ".
                        "user_account.nickname, ".
                        "user_profile.fname, ".
                        "user_profile.lname, ".
                        "user_account.email", $utk).
            " from ".$utk."wall_message_comment ".
            "join ".$utk."wall_message ".
            " on ".$utk."wall_message_comment.wall_message_uid = ".$utk."wall_message.uid ".
            "join match_user_account_to_user_profile ".
            " on match_user_account_to_user_profile.user_account_uid = wall_message.user_account_uid ".
            "join user_account ".
            " on user_account.uid = match_user_account_to_user_profile.user_account_uid ".
            "join user_profile ".
            " on user_profile.uid = match_user_account_to_user_profile.user_profile_uid ".
            "WHERE ".$utk."wall_message_comment.wall_message_uid = :wall_message_uid ".
            "ORDER BY ".$utk."wall_message_comment.createddt ASC";

        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":wall_message_uid", $wall_message_uid);
        $dbcontrol->execSelect();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResults_AllWallMessageComments($dbcontrol->getStatement()->fetchAll(PDO::FETCH_ASSOC));
                $this->gdlog()->LogInfoDB($this->getResults_AllWallMessageComments());
                $fr = $this->gdlog()->LogInfoRETURN("WALL_MESSAGE_COMMENTS_FOUND");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("WALL_MESSAGE_COMMENTS_NOT_FOUND");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("findAllWallMessageComments");
        return $fr;
    }
    
    private $Results_AllWallMessages = "NO_RECORDS";
    private $Results_AllWallMessageComments = "NO_RECORDS";
    function setResults_AllWallMessages($row)
    {
        $this->Results_AllWallMessages = $row;
    }
    
    function getResults_AllWallMessages()
    {
        return $this->Results_AllWallMessages;
    }
    
    function setResults_AllWallMessageComments($row)
    {
        $this->Results_AllWallMessageComments = $row;
    }
    
    function getResults_AllWallMessageComments()
    {
        return $this->$Results_AllWallMessageComments;
    }
}
?>