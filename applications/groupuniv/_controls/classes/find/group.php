<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/*
 * Author: Stephen Shellenberger
 * Copyright: 2013 Stephen Shellenberger
 * Date: 2013/01/05
 */
class zFindGroup
    extends zAppBaseObject
{
    function findAccountbySdesc($group_sdesc)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findAccountbySdesc");
        $utk = $this->getGDConfig()->getSessUnivTblKey();
        $fr;
        $sqlstmnt = "SELECT ".
            "uid FROM ".$utk."group_account ".
            "WHERE uid=:group_account_sdesc";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":group_account_sdesc", $this->createSdesc($group_sdesc));
        $dbcontrol->execSelect();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $row = $dbcontrol->getStatement()->fetch(PDO::FETCH_ASSOC);
                $this->gdlog()->LogInfoDB($row);
                $fr = $this->gdlog()->LogInfoRETURN("ACCOUNT_FOUND");
                $this->findAccountandProfileByUid($row["uid"]);
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("ACCOUNT_NOT_FOUND");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("findAccountbySdesc");
        return $fr;
    }
    
    /**
     * Find University Account and Profile by Email Key
     * $university_account_emailkey = EMAILKEY
     */
    function findAccountandProfileByUid($group_account_uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findAccountandProfileByUid");
        $utk = $this->getGDConfig()->getSessUnivTblKey();
        $fr;
        $sqlstmnt = "SELECT ".
            $this->dbfas("university_account.uid, ".
                        "university_account.sdesc, ".
                        "university_account.emailkey, ".
                        $utk."group_account.uid, ".
                        $utk."group_account.sdesc, ".
                        $utk."group_account.ldesc, ".
                        $utk."group_account.cfg_group_type_sdesc, ".
                        $utk."group_account.cfg_group_visibility_sdesc, ".
                        $utk."group_account.cfg_group_useracceptance_sdesc, ".
                        $utk."group_profile.uid, ".
                        $utk."group_profile.validtodate, ".
                        $utk."group_profile.content", $utk).
        " FROM ".$utk."group_account ".
        "JOIN ".$utk."match_group_account_to_group_profile ".
            "on ".$utk."match_group_account_to_group_profile.group_account_uid = ".$utk."group_account.uid ".
        "JOIN ".$utk."group_profile ".
            "on ".$utk."match_group_account_to_group_profile.group_profile_uid = ".$utk."group_profile.uid ".
        
        "join ".$utk."match_university_account_to_group_account ".
            " on ".$utk."match_university_account_to_group_account.group_account_uid = ".$utk."group_account.uid ".
        "join university_account ".
            " on university_account.uid = ".$utk."match_university_account_to_group_account.university_account_uid ".
            
        "WHERE ".$utk."group_account.uid=:group_account_uid";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":group_account_uid", $group_account_uid);
        $dbcontrol->execSelect();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResult_Group($dbcontrol->getStatement()->fetch(PDO::FETCH_ASSOC));
                $this->gdlog()->LogInfoDB($this->getResult_Group());
                $fr = $this->gdlog()->LogInfoRETURN("ACCOUNT_FOUND");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("ACCOUNT_NOT_FOUND");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("findAccountandProfileByUid");
        return $fr;
    }
    
    /**
     * Find Groups by University that are based on
     * Group Type
     * Group User Acceptance
     * Group Visibility
     * $cfg_group_type_sdesc = SDESC
     * $cfg_group_useracceptance_sdesc = SDESC
     * $cfg_group_visibility_sdesc = SDESC
     * $university_account_uid = UID
     */
    function findGroupsByUniversityByTypeByAcceptanceByVisibilitySdesc($cfg_group_type_sdesc,
                                                                $cfg_group_useracceptance_sdesc,
                                                                $cfg_group_visibility_sdesc,
                                                                $university_account_uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findGroupsByUniversityByTypeByAcceptanceByVisibilitySdesc");
        $utk = $this->getGDConfig()->getSessUnivTblKey();
        $fr;
        $sqlstmnt = "select ".
            $this->dbfas("university_account.uid, ".
                        "university_account.sdesc, ".
                        "university_account.emailkey, ".
                        $utk."group_account.uid, ".
                        $utk."group_account.sdesc, ".
                        $utk."group_account.ldesc, ".
                        $utk."group_account.cfg_group_type_sdesc, ".
                        $utk."group_account.cfg_group_visibility_sdesc, ".
                        $utk."group_account.cfg_group_useracceptance_sdesc, ".
                        $utk."group_profile.uid, ".
                        $utk."group_profile.validtodate, ".
                        $utk."group_profile.content", $utk).
            " from ".$utk."match_university_account_to_group_account ".
            "join university_account ".
            " on university_account.uid = ".$utk."match_university_account_to_group_account.university_account_uid ".
            
            "join ".$utk."group_account ".
            " on ".$utk."match_university_account_to_group_account.group_account_uid = ".$utk."group_account.uid ".
            
            "join ".$utk."match_group_account_to_group_profile ".
            " on ".$utk."match_group_account_to_group_profile.group_account_uid = ".$utk."group_account.uid ".
            "join ".$utk."group_profile ".
            " on ".$utk."group_profile.uid = ".$utk."match_group_account_to_group_profile.group_profile_uid ".
            
            "where group_account.cfg_group_type_sdesc = :cfg_group_type_sdesc ".
            "AND group_account.cfg_group_visibility_sdesc = :cfg_group_visibility_sdesc ".
            "AND group_account.cfg_group_useracceptance_sdesc = :cfg_group_useracceptance_sdesc ".
            "AND university_account.uid = :university_account_uid";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":cfg_group_type_sdesc", strtoupper($cfg_group_type_sdesc));
        $dbcontrol->bindParam(":cfg_group_visibility_sdesc", strtoupper($cfg_group_visibility_sdesc));
        $dbcontrol->bindParam(":cfg_group_useracceptance_sdesc", strtoupper($cfg_group_useracceptance_sdesc));
        $dbcontrol->bindParam(":university_account_uid", $university_account_uid);
        $dbcontrol->execSelect();
        
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResults_Groups($dbcontrol->getStatement()->fetchAll(PDO::FETCH_ASSOC));
                $this->gdlog()->LogInfoDB($this->getResults_Groups());
                $fr = $this->gdlog()->LogInfoRETURN("GROUPS_FOUND");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("GROUPS_NOT_FOUND");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("findGroupsByUniversityByTypeByAcceptanceByVisibilitySdesc");
        return $fr;
    }

    /**
     * Find Groups by User that are based on
     * University
     * User Role
     * $user_account_uid = UID
     * $university_account_uid = UID
     * $user_role_sdesc = SDESC
     */
    function findGroupsByUserByUniversityByUserRolesSdesc($user_account_uid,
                                                $cfg_user_roles_sdesc,
                                                $university_account_uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findGroupsByUserByUniversityByUserRolesSdesc");
        $utk = $this->getGDConfig()->getSessUnivTblKey();
        $fr;
        $sqlstmnt = "select ".
            $this->dbfas("university_account.uid, ".
                        "university_account.sdesc, ".
                        "university_account.emailkey, ".
                        $utk."group_account.uid, ".
                        $utk."group_account.sdesc, ".
                        $utk."group_account.ldesc, ".
                        $utk."group_account.cfg_group_type_sdesc, ".
                        $utk."group_account.cfg_group_visibility_sdesc, ".
                        $utk."group_account.cfg_group_useracceptance_sdesc, ".
                        $utk."group_profile.uid, ".
                        $utk."group_profile.validtodate, ".
                        $utk."group_profile.content", $utk).
                        
            " from ".$utk."match_user_account_to_group_account_to_cfg_user_roles ".
            "join user_account ".
            " on ".$utk."match_user_account_to_group_account_to_cfg_user_roles.user_account_uid = user_account.uid ".
            
            "join ".$utk."group_account ".
            " on ".$utk."match_user_account_to_group_account_to_cfg_user_roles.group_account_uid = ".$utk."group_account.uid ".
            "join ".$utk."match_group_account_to_group_profile ".
            " on ".$utk."group_account.uid = ".$utk."match_group_account_to_group_profile.group_account_uid ".
            "join ".$utk."group_profile ".
            " on ".$utk."group_profile.uid = ".$utk."match_group_account_to_group_profile.group_profile_uid ".

            "join cfg_defaults AS cfg_group_type ".
            " on  cfg_group_type.uid = ".$utk."group_account.cfg_group_type_uid ".
            "join cfg_defaults AS cfg_group_useracceptance ".
            " on  cfg_group_useracceptance.uid = ".$utk."group_account.cfg_group_useracceptance_uid ".
            "join cfg_defaults AS cfg_group_visibility ".
            " on  cfg_group_visibility.uid = ".$utk."group_account.cfg_group_visibility_uid ".
            "join cfg_defaults AS cfg_user_roles ".
            " on  cfg_user_roles.uid = ".$utk."match_user_account_to_group_account_to_cfg_user_roles.cfg_user_roles_uid ".
            
            "join match_university_account_to_user_account_to_cfg_user_roles ".
            " on user_account.uid = match_university_account_to_user_account_to_cfg_user_roles.user_account_uid ".
            "join university_account ".
            " on university_account.uid = match_university_account_to_user_account_to_cfg_user_roles.university_account_uid ".
            
             "where user_account.uid = :user_account_uid ".
             "and university_account.uid = :university_account_uid ".
             "and ".$utk."match_university_account_to_user_account_to_cfg_user_roles.cfg_user_roles_sdesc = :cfg_user_roles_sdesc";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":user_account_uid", $user_account_uid);
        $dbcontrol->bindParam(":cfg_user_roles_sdesc", strtoupper($cfg_user_roles_sdesc));
        $dbcontrol->bindParam(":university_account_uid", $university_account_uid);
                $dbcontrol->execSelect();
        
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResults_Groups($dbcontrol->getStatement()->fetchAll(PDO::FETCH_ASSOC));
                $this->gdlog()->LogInfoDB($this->getResults_Groups());
                $fr = $this->gdlog()->LogInfoRETURN("GROUPS_FOUND");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("GROUPS_NOT_FOUND");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("findGroupsByUserByUniversityByUserRolesSdesc");
        return $fr;
    }
    
    /**
     * Find Groups by University that are based on
     * Group Type
     * Group User Acceptance
     * Group Visibility
     * $cfg_group_type_sdesc = SDESC
     * $cfg_group_useracceptance_sdesc = SDESC
     * $cfg_group_visibility_sdesc = SDESC
     * $university_account_uid = UID
     */
    function findGroupsforUserbyRoleExcludingExistingGroup($cfg_user_roles_sdesc)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findGroupsforUserbyOwnershipExcludingExistingGroup");
        $utk = $this->getGDConfig()->getSessUnivTblKey();
        $fr;
        $sqlstmnt = "SELECT ".
            $this->dbfas("university_account.uid, ".
                        "university_account.sdesc, ".
                        "university_account.emailkey, ".
                        $utk."group_account.uid, ".
                        $utk."group_account.sdesc, ".
                        $utk."group_account.ldesc, ".
                        $utk."group_account.cfg_group_type_sdesc, ".
                        $utk."group_account.cfg_group_visibility_sdesc, ".
                        $utk."group_account.cfg_group_useracceptance_sdesc, ".
                        $utk."group_profile.uid, ".
                        $utk."group_profile.validtodate, ".
                        $utk."group_profile.content", $utk).
            " FROM ".$utk."group_account ".
            "JOIN ".$utk."match_user_account_to_group_account_to_cfg_user_roles ".
            " on ".$utk."match_user_account_to_group_account_to_cfg_user_roles.group_account_uid = ".$utk."group_account.uid ".
            
            "JOIN ".$utk."match_university_account_to_group_account ".
            " on ".$utk."match_university_account_to_group_account.group_account_uid = ".$utk."group_account.uid ".
            "JOIN university_account ".
            " on university_account.uid = ".$utk."match_university_account_to_group_account.university_account_uid ".
            "JOIN ".$utk."match_group_account_to_group_profile ".
            " on ".$utk."match_group_account_to_group_profile.group_account_uid = ".$utk."group_account.uid ".
            "JOIN ".$utk."group_profile ".
            
            "WHERE ".$utk."match_user_account_to_group_account_to_cfg_user_roles.cfg_user_roles_sdesc = :cfg_user_roles_sdesc".
            " AND university_account.uid = :university_account_uid".
            " AND ".$utk."match_user_account_to_group_account_to_cfg_user_roles.user_account_uid = :user_account_uid".
            " AND ".$utk."match_user_account_to_group_account_to_cfg_user_roles.group_account_uid <> :group_account_uid";
                    
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":user_account_uid", $this->getGDConfig()->getSessAuthUserUid());
        $dbcontrol->bindParam(":cfg_user_roles_sdesc", strtoupper($cfg_user_roles_sdesc));
        $dbcontrol->bindParam(":university_account_uid", $this->getGDConfig()->getSessUnivUid());
        $dbcontrol->bindParam(":group_account_uid", $this->getGDConfig()->getSessGroupUid());
        $dbcontrol->execSelect();
        
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResults_Groups($dbcontrol->getStatement()->fetchAll(PDO::FETCH_ASSOC));
                $this->gdlog()->LogInfoDB($this->getResults_Groups());
                $fr = $this->gdlog()->LogInfoRETURN("GROUPS_FOUND");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("GROUPS_NOT_FOUND");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("findGroupsforUserbyOwnershipExcludingExistingGroup");
        return $fr;
    }
    
    /**
     * Find Groups by University that are based on
     * Group Type
     * Group User Acceptance
     * Group Visibility
     * $cfg_group_type_sdesc = SDESC
     * $cfg_group_useracceptance_sdesc = SDESC
     * $cfg_group_visibility_sdesc = SDESC
     * $university_account_uid = UID
     */
    function findGroupsforUserbyRole($cfg_user_roles_sdesc)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findGroupsforUserbyOwnershipExcludingExistingGroup");
        $utk = $this->getGDConfig()->getSessUnivTblKey();
        $fr;
        $sqlstmnt = "SELECT ".
            $this->dbfas("university_account.uid, ".
                        "university_account.sdesc, ".
                        "university_account.emailkey, ".
                        $utk."group_account.uid, ".
                        $utk."group_account.sdesc, ".
                        $utk."group_account.ldesc, ".
                        $utk."group_account.cfg_group_type_sdesc, ".
                        $utk."group_account.cfg_group_visibility_sdesc, ".
                        $utk."group_account.cfg_group_useracceptance_sdesc, ".
                        $utk."group_profile.uid, ".
                        $utk."group_profile.validtodate, ".
                        $utk."group_profile.content", $utk).
            " FROM ".$utk."group_account ".
            "JOIN ".$utk."match_user_account_to_group_account_to_cfg_user_roles ".
            " on ".$utk."match_user_account_to_group_account_to_cfg_user_roles.group_account_uid = ".$utk."group_account.uid ".
            
            "JOIN ".$utk."match_university_account_to_group_account ".
            " on ".$utk."match_university_account_to_group_account.group_account_uid = ".$utk."group_account.uid ".
            "JOIN university_account ".
            " on university_account.uid = ".$utk."match_university_account_to_group_account.university_account_uid ".
            "JOIN ".$utk."match_group_account_to_group_profile ".
            " on ".$utk."match_group_account_to_group_profile.group_account_uid = ".$utk."group_account.uid ".
            "JOIN ".$utk."group_profile ".
            " on ".$utk."group_profile.uid = ".$utk."match_group_account_to_group_profile.group_profile_uid ".
            
            "WHERE ".$utk."match_user_account_to_group_account_to_cfg_user_roles.cfg_user_roles_sdesc = :cfg_user_roles_sdesc".
            " AND university_account.uid = :university_account_uid".
            " AND ".$utk."match_user_account_to_group_account_to_cfg_user_roles.user_account_uid = :user_account_uid";
                    
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":user_account_uid", $this->getGDConfig()->getSessAuthUserUid());
        $dbcontrol->bindParam(":cfg_user_roles_sdesc", strtoupper($cfg_user_roles_sdesc));
        $dbcontrol->bindParam(":university_account_uid", $this->getGDConfig()->getSessUnivUid());
        $dbcontrol->execSelect();
        
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResults_Groups($dbcontrol->getStatement()->fetchAll(PDO::FETCH_ASSOC));
                $this->gdlog()->LogInfoDB($this->getResults_Groups());
                $fr = $this->gdlog()->LogInfoRETURN("GROUPS_FOUND");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("GROUPS_NOT_FOUND");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("findGroupsforUserbyOwnershipExcludingExistingGroup");
        return $fr;
    }

    private $Results_Groups = "NO_RECORDS";
    private $Result_Group = "NO_RECORD";
    function setResults_Groups($rows)
    {
        $this->Results_Groups = $rows;
    }
    
    function getResults_Groups()
    {
        return $this->Results_Groups;
    }
    
    function setResult_Group($row)
    {
        $this->Result_Group = $row;
    }
    
    function getResult_Group()
    {
        return $this->Result_Group;
    }
    
    function getUA_Uid(){return $this->Result_Group[$this->dbf("university_account.uid")];}
    function getUA_Sdesc(){return $this->Result_Group[$this->dbf("university_account.sdesc")];}
    function getUA_Emailkey(){return $this->Result_Group[$this->dbf("university_account.emailkey")];}

    function getGA_Uid(){return $this->Result_Group[$this->dbf("group_account.uid")];}
    function getGA_Sdesc(){return $this->Result_Group[$this->dbf("group_account.sdesc")];}
    function getGA_Ldesc(){return $this->Result_Group[$this->dbf("group_account.ldesc")];}
    function getGA_CfgGroupTypeUid(){return $this->findCfgUidFromSdesc($this->Result_Group[$this->dbf("group_account.cfg_group_type_sdesc")]);}
    function getGA_CfgGroupVisiUid(){return $this->findCfgUidFromSdesc($this->Result_Group[$this->dbf("group_account.cfg_group_visibility_sdesc")]);}
    function getGA_CfgGroupUAUid(){return $this->findCfgUidFromSdesc($this->Result_Group[$this->dbf("group_account.cfg_group_useracceptance_sdesc")]);}
    
    function getGP_Uid(){return $this->Result_Group[$this->dbf("group_profile.uid")];}
    function getGP_Validtodate(){return $this->Result_Group[$this->dbf("group_profile.validtodate")];}
    function getGP_Content(){return $this->Result_Group[$this->dbf("group_profile.content")];}
    
    function getCfgGroupTypeSdesc(){return $this->Result_Group[$this->dbf("group_account.cfg_group_type_sdesc")];}
    function getCfgGroupVisiSdesc(){return $this->Result_Group[$this->dbf("group_account.cfg_group_visibility_sdesc")];}
    function getCfgGroupUASdesc(){return $this->Result_Group[$this->dbf("group_account.cfg_group_useracceptance_sdesc")];}
    
    function findUserRoleofGroup($ga_uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("findUserRoleofGroup");
        $utk = $this->getGDConfig()->getSessUnivTblKey();
        $fr;
        $sqlstmnt = "SELECT ".
        $this->dbfas($utk."match_user_account_to_group_account_to_cfg_user_roles.uid, ".
                    $utk."match_user_account_to_group_account_to_cfg_user_roles.user_account_uid, ".
                    $utk."match_user_account_to_group_account_to_cfg_user_roles.group_account_uid, ".
                    $utk."match_user_account_to_group_account_to_cfg_user_roles.cfg_user_roles_sdesc", $utk).
        " FROM ".$utk."match_user_account_to_group_account_to_cfg_user_roles ".
        "WHERE ".$utk."match_user_account_to_group_account_to_cfg_user_roles.user_account_uid=:user_account_uid ".
        "AND ".$utk."match_user_account_to_group_account_to_cfg_user_roles.group_account_uid=:group_account_uid ";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":user_account_uid", $this->getGDConfig()->getSessAuthUserUid());
        $dbcontrol->bindParam(":group_account_uid", $ga_uid);
        $dbcontrol->execSelect();
        
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResult_UserRoleofGroup($dbcontrol->getStatement()->fetch(PDO::FETCH_ASSOC));
                $this->gdlog()->LogInfoDB($this->getResult_UserRoleofGroup());
                $fr = $this->saveActivityLog("USER_IS_MATCHED_TO_GROUP","User is Matched of Group:".json_encode($this->getResult_UserRoleofGroup()).":");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("USER_IS_NOT_MATCHED_TO_GROUP");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("findUserRoleofGroup");
        return $fr;
    }

    private $Result_UserRoleofGroup = "NO_RECORD";
    function setResult_UserRoleofGroup($row)
    {
        $this->Result_UserRoleofGroup = $row;
    }
    function cleanResult_UserRoleofGroup()
    {
        $this->Result_UserRoleofGroup = "NO_RECORD";
    }
    function getResult_UserRoleofGroup()
    {
        return $this->Result_UserRoleofGroup;
    }
    function getUserRoleofGroup_MatchUserGroupUserRole_Uid(){return $this->Result_UserRoleofGroup[$this->dbf("match_user_account_to_group_account_to_cfg_user_roles.uid")];}
    function getUserRoleofGroup_CfgGA_Uid(){return $this->Result_UserRoleofGroup[$this->dbf("match_user_account_to_group_account_to_cfg_user_roles.group_account_uid")];}
    function getUserRoleofGroup_CfgUA_Uid(){return $this->Result_UserRoleofGroup[$this->dbf("match_user_account_to_group_account_to_cfg_user_roles.user_account_uid")];}
    function getUserRoleofGroup_CfgUserRole_Sdesc(){return $this->Result_UserRoleofGroup[$this->dbf("match_user_account_to_group_account_to_cfg_user_roles.cfg_user_roles_sdesc")];}
    
}
?>