<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/**
 * Author: Stephen Shellenberger
 * Copyright: 2013 Stephen Shellenberger
 * Date: 2013/01/05
 */

class zFindSearchData
    extends zAppBaseObject
{
    /**
     * Search Group Data. This search is used by the user in the User Search Screen.
     */
    function findSearchGroup($search_content)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findSearchGroup");
        $utk = $this->getGDConfig()->getSessUnivTblKey();
        $usrtk = $this->getGDConfig()->getSessAuthUserTblKey();
        $fr;
        $this->cleanResults_List();
        
        $sqlstmnt = "SELECT ".
        
            "IF((SELECT uid FROM ".$utk."match_user_account_to_group_account_to_cfg_user_roles ".
            "WHERE ".$utk."match_user_account_to_group_account_to_cfg_user_roles.user_account_uid = :user_account_uid ".
            "AND ".$utk."match_user_account_to_group_account_to_cfg_user_roles.group_account_uid = ".$utk."group_account.uid) <> '', 'USER_IS_MEMBER', 'USER_IS_NOT_MEMBER') AS is_member_of_group ".

            ", (SELECT status FROM ".$utk."requests ".
            "WHERE ".$utk."requests.who_gets_approved_user_account_uid = :user_account_uid ".
            "AND ".$utk."requests.group_account_uid = ".$utk."group_account.uid LIMIT 0,1) ".
            "AS request_status ".
            
            ", IF((SELECT user_account.email FROM user_account ".
            "JOIN ".$utk."match_user_account_to_group_account_to_cfg_user_roles ".
            " on ".$utk."match_user_account_to_group_account_to_cfg_user_roles.user_account_uid = user_account.uid ".
            "WHERE ".$utk."match_user_account_to_group_account_to_cfg_user_roles.group_account_uid = ".$utk."group_account.uid ".
            "AND ".$utk."match_user_account_to_group_account_to_cfg_user_roles.cfg_user_roles_uid = (SELECT uid from cfg_defaults WHERE sdesc='USER_ROLE_GROUP_OWNER') ".
            "AND user_account.uid = :user_account_uid) <> '', 'USER_IS_OWNER', 'USER_IS_NOT_OWNER') ".
            "AS is_owner_of_group ".
            
            ", ".$this->dbfas($utk."group_profile.content, ".
                $utk."group_account.ldesc, ".
                $utk."group_account.uid, ".
                $utk."group_account.createddt, ".
                $utk."search_content.content, ".
                $utk."search_content.uid, ".
                $utk."search_content.createddt, ".
                "cfg_group_useracceptance.uid, ".
                "cfg_group_useracceptance.sdesc, ".
                "cfg_search_objects.uid, ".
                "cfg_search_objects.sdesc, ".
                "user_account.nickname", $utk)." ".
            
            "FROM ".$utk."search_content ".
            
            "JOIN ".$utk."group_account ".
            " on ".$utk."group_account.uid = ".$utk."search_content.object_uid ".
            "JOIN ".$utk."match_group_account_to_group_profile ".
            " on ".$utk."match_group_account_to_group_profile.group_account_uid = ".$utk."group_account.uid ".
            "JOIN ".$utk."group_profile ".
            " on ".$utk."group_profile.uid = ".$utk."match_group_account_to_group_profile.group_profile_uid ".
            
            "JOIN ".$utk."match_university_account_to_group_account ".
            " on ".$utk."match_university_account_to_group_account.group_account_uid = ".$utk."search_content.object_uid ".
            "JOIN university_account ".
            " on university_account.uid = ".$utk."match_university_account_to_group_account.university_account_uid ".
            
            "JOIN ".$utk."match_user_account_to_group_account_to_cfg_user_roles ".
            " on ".$utk."match_user_account_to_group_account_to_cfg_user_roles.group_account_uid = ".$utk."group_account.uid ".
            
            "JOIN cfg_defaults AS cfg_group_useracceptance ".
            " on cfg_group_useracceptance.uid = ".$utk."group_account.cfg_group_useracceptance_uid ".
            "JOIN cfg_defaults AS cfg_search_objects ".
            " on cfg_search_objects.uid = ".$utk."search_content.cfg_search_objects_uid ".
            
            "JOIN user_account ".
            " on user_account.uid = ".$utk."match_user_account_to_group_account_to_cfg_user_roles.user_account_uid ".
            "JOIN match_user_account_to_user_profile ".
            " on match_user_account_to_user_profile.user_account_uid = user_account.uid ".
            "JOIN user_profile ".
            " on  user_profile.uid = match_user_account_to_user_profile.user_profile_uid ".
                        
            "WHERE match(".$utk."search_content.content) against (:search_content) ".
            "AND ".$utk."group_account.cfg_group_visibility_uid <> (SELECT uid from cfg_defaults WHERE sdesc='GROUP_VISIBILITY_GROUP_PRIVATE') ".
            "AND ".$utk."search_content.cfg_search_objects_uid = (SELECT uid from cfg_defaults WHERE sdesc='SEARCH_OBJECT_GROUP') ".
            "AND ".$utk."match_user_account_to_group_account_to_cfg_user_roles.cfg_user_roles_uid = (SELECT uid from cfg_defaults WHERE sdesc='USER_ROLE_GROUP_OWNER') ".
            "AND university_account.uid = :university_account_uid ".
            "GROUP BY ".$utk."group_account.uid";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":search_content", $search_content);
        $dbcontrol->bindParam(":university_account_uid", $this->getGDConfig()->getSessUnivUid());
        $dbcontrol->bindParam(":user_account_uid", $this->getGDConfig()->getSessAuthUserUid());
        $dbcontrol->execSelect();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResults_List($dbcontrol->getStatement()->fetchAll(PDO::FETCH_ASSOC));
                $this->gdlog()->LogInfoDB($this->getResults_List());
                $fr = $this->gdlog()->LogInfoRETURN("RECORDS_FOUND");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("RECORDS_NOT_FOUND");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("findSearchGroup");
        return $fr;
    }

    /**
     * Search Wall MEssage Data. This search is used by the user in the User Search Screen.
     */
    function findSearchWallMessage($search_content)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findSearchWallMessage");
        $utk = $this->getGDConfig()->getSessUnivTblKey();
        $usrtk = $this->getGDConfig()->getSessAuthUserTblKey();
        $fr;
        $this->cleanResults_List();
        
        $sqlstmnt = "select ".
        
            "IF((SELECT uid FROM ".$utk."match_user_account_to_group_account_to_cfg_user_roles ".
            "WHERE ".$utk."match_user_account_to_group_account_to_cfg_user_roles.user_account_uid = :user_account_uid ".
            "AND ".$utk."match_user_account_to_group_account_to_cfg_user_roles.group_account_uid = ".$utk."group_account.uid) <> '', 'USER_IS_MEMBER', 'USER_IS_NOT_MEMBER') AS is_member_of_group ".
            
            ", (SELECT status FROM ".$utk."requests ".
            "WHERE ".$utk."requests.who_gets_approved_user_account_uid = :user_account_uid ".
            "AND ".$utk."requests.group_account_uid = ".$utk."group_account.uid LIMIT 0,1) ".
            "AS request_status ".
            
            ", IF((SELECT user_account.email FROM user_account ".
            "JOIN ".$utk."match_user_account_to_group_account_to_cfg_user_roles ".
            "ON ".$utk."match_user_account_to_group_account_to_cfg_user_roles.user_account_uid = user_account.uid ".
            "WHERE ".$utk."match_user_account_to_group_account_to_cfg_user_roles.group_account_uid = ".$utk."group_account.uid ".
            "AND ".$utk."match_user_account_to_group_account_to_cfg_user_roles.cfg_user_roles_uid = (SELECT uid from cfg_defaults WHERE sdesc='USER_ROLE_GROUP_OWNER') ".
            "AND user_account.uid = :user_account_uid) <> '', 'USER_IS_OWNER', 'USER_IS_NOT_OWNER') ".
            "AS is_owner_of_group ".
            
            ", ".$this->dbfas($utk."group_profile.content, ".
                $utk."group_account.ldesc, ".
                $utk."group_account.uid, ".
                $utk."group_account.createddt, ".
                $utk."search_content.content, ".
                $utk."search_content.uid, ".
                $utk."search_content.createddt, ".
                "cfg_group_useracceptance.uid, ".
                "cfg_group_useracceptance.sdesc, ".
                "cfg_search_objects.uid, ".
                "cfg_search_objects.sdesc, ".
                "user_account.nickname, ".
                $utk."wall_message.uid, ".
                $utk."wall_message.createddt, ".
                $utk."wall_message.content, ".
                $utk."wall_message.mimes_uid", $utk)." ".
            
            "from ".$utk."search_content ".
            
            "JOIN ".$utk."wall_message ".
            " on ".$utk."wall_message.uid = ".$utk."search_content.object_uid ".
            
            "JOIN ".$utk."group_account ".
            " on ".$utk."group_account.uid = ".$utk."wall_message.group_account_uid ".
            "JOIN ".$utk."match_group_account_to_group_profile ".
            " on ".$utk."match_group_account_to_group_profile.group_account_uid = ".$utk."group_account.uid ".
            "JOIN ".$utk."group_profile ".
            " on ".$utk."group_profile.uid = ".$utk."match_group_account_to_group_profile.group_profile_uid ".
            
            "JOIN ".$utk."match_university_account_to_group_account ".
            " on ".$utk."match_university_account_to_group_account.group_account_uid = ".$utk."wall_message.group_account_uid ".
            "JOIN university_account ".
            " on university_account.uid = ".$utk."match_university_account_to_group_account.university_account_uid ".
            
            //"JOIN match_user_account_to_group_account_to_cfg_user_roles ".
            //" on match_user_account_to_group_account_to_cfg_user_roles.group_account_uid = group_account.uid ".
            
            "JOIN cfg_defaults AS cfg_group_useracceptance ".
            " on cfg_group_useracceptance.uid = ".$utk."group_account.cfg_group_useracceptance_uid ".
            "JOIN cfg_defaults AS cfg_search_objects ".
            " on cfg_search_objects.uid = ".$utk."search_content.cfg_search_objects_uid ".
            
            "JOIN user_account ".
            " on user_account.uid = ".$utk."wall_message.user_account_uid ".
            "JOIN match_user_account_to_user_profile ".
            " on match_user_account_to_user_profile.user_account_uid = user_account.uid ".
            "JOIN user_profile ".
            " on  user_profile.uid = match_user_account_to_user_profile.user_profile_uid ".
            
            "WHERE match(".$utk."search_content.content) against (:search_content) ".
            "AND ".$utk."group_account.cfg_group_visibility_uid <> (SELECT uid from cfg_defaults WHERE sdesc='GROUP_VISIBILITY_GROUP_PRIVATE') ".
            "AND ".$utk."search_content.cfg_search_objects_uid = (SELECT uid from cfg_defaults WHERE sdesc='SEARCH_OBJECT_WALL_MESSAGE') ".
            "AND university_account.uid = :university_account_uid ";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":search_content", $search_content);
        $dbcontrol->bindParam(":university_account_uid", $this->getGDConfig()->getSessUnivUid());
        $dbcontrol->bindParam(":user_account_uid", $this->getGDConfig()->getSessAuthUserUid());
        $dbcontrol->execSelect();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResults_List($dbcontrol->getStatement()->fetchAll(PDO::FETCH_ASSOC));
                $this->gdlog()->LogInfoDB($this->getResults_List());
                $fr = $this->gdlog()->LogInfoRETURN("RECORDS_FOUND");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("RECORDS_NOT_FOUND");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("findSearchWallMessage");
        return $fr;
    }
    
    private $Results_List = "NO_RECORDS";
    private $Result_Record = "NO_RECORD";
    function setResults_List($rows)
    {
        return $this->Results_List = $rows;
    }
    function getResults_List()
    {
        return $this->Results_List;
    }
    function cleanResults_List()
    {
        $this->Results_List = "NO_RECORDS";
    }
    
    function setResult_Record($row)
    {
        return $this->Result_Record = $row;
    }
    function getResult_Record()
    {
        return $this->Result_Record;
    }
    function cleanResult_Record()
    {
        $this->Result_Record = "NO_RECORD";
    }
}
?>