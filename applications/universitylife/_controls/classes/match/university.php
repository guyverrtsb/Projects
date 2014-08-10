<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/**
 * Author: Stephen Shellenberger
 * Copyright: 2013 Stephen Shellenberger
 * Date: 2013/01/05
 */

class zMatchUniversity
    extends zAppBaseObject
{
    /**
     * Match University to User to User Role.
     * $university_account_uid = UID;
     * $user_account_uid = UID;
     * $user_roles_desc = SDESC - Unique Search Field;
     */
    function matchUniversitytoUsertoRoleSdesc($university_account_uid, $user_account_uid, $cfg_user_roles_desc)
    {
        $this->gdlog()->LogInfoStartFUNCTION("matchUniversitytoUsertoRoleSdesc");
        $fr = $this->matchUniversitytoUsertoRole($university_account_uid,
                    $user_account_uid,
                    $this->findCfgUidfromSdesc($cfg_user_roles_desc));
        $this->gdlog()->LogInfoEndFUNCTION("matchUniversitytoUsertoRoleSdesc");
        return $fr;
    }
    
    /**
     * Match University to User to User Role.
     * $university_account_uid = UID;
     * $user_account_uid = UID;
     * $user_roles_uid = UID;
     */
    function matchUniversitytoUsertoRole($university_account_uid, $user_account_uid, $cfg_user_roles_uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("matchUniversitytoUsertoRole");
        $fr;
        $sqlstmnt = "INSERT INTO match_university_account_to_user_account_to_cfg_user_roles SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "university_account_uid=:university_account_uid, ".
            "user_account_uid=:user_account_uid, ".
            "cfg_user_roles_uid=:cfg_user_roles_uid";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":university_account_uid", $university_account_uid);
        $dbcontrol->bindParam(":user_account_uid", $user_account_uid);
        $dbcontrol->bindParam(":cfg_user_roles_uid", $cfg_user_roles_uid);
        $dbcontrol->execUpdate();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResult_UniversitytoUsertoRole($dbcontrol->getRowfromLastId($dbcontrol, "match_university_account_to_user_account_to_cfg_user_roles", $dbcontrol->getLastInsertID()));
                $this->gdlog()->LogInfoDB($this->getResult_UniversitytoUsertoRole());
                $fr = $this->saveActivityLog("MATCHED_UNIVERISTY_TO_USER_TO_ROLE", "University and User and Role has been matched:".json_encode($this->getResult_UniversitytoUsertoRole()).":");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("NOT_MATCHED_UNIVERISTY_TO_USER_TO_ROLE");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("matchUniversitytoUsertoRole");
        return $fr;
    }

    /**
     * Match University to Profile
     * $university_account_uid = UID
     * $university_profile_uid = UID
     */
    function matchUniversitytoProfile($university_account_uid, $university_profile_uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("matchUniversitytoProfile");
        $fr;
        $sqlstmnt = "INSERT INTO match_university_account_to_university_profile SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "university_account_uid=:university_account_uid, ".
            "university_profile_uid=:university_profile_uid";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":university_account_uid", $university_account_uid);
        $dbcontrol->bindParam(":university_profile_uid", $university_profile_uid);
        $dbcontrol->execUpdate();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResult_UniversitytoProfile($dbcontrol->getRowfromLastId($dbcontrol, "match_university_account_to_university_profile", $dbcontrol->getLastInsertID()));
                $this->gdlog()->LogInfoDB($this->getResult_UniversitytoProfile());
                $fr = $this->saveActivityLog("MATCHED_UNIVERISTY_TO_PROFILE", "University and Profile has been matched:".json_encode($this->getResult_UniversitytoProfile()).":");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("NOT_MATCHED_UNIVERISTY_TO_PROFILE");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("matchUniversitytoProfile");
        return $fr;
    }

    /**
     * Match University to Group
     * $university_account_uid = UID
     * $group_account_uid = UID
     */
    function matchUniversitytoGroup($university_account_uid, $group_account_uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("matchUniversitytoGroup");
        $utk = $this->getGDConfig()->getSessUnivTblKey();
        $fr;
        $sqlstmnt = "INSERT INTO ".$utk."match_university_account_to_group_account SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "university_account_uid=:university_account_uid, ".
            "group_account_uid=:group_account_uid";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":university_account_uid", $university_account_uid);
        $dbcontrol->bindParam(":group_account_uid", $group_account_uid);
        $dbcontrol->execUpdate();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResult_UniversitytoGroup($dbcontrol->getRowfromLastId($dbcontrol, $utk."match_university_account_to_group_account", $dbcontrol->getLastInsertID()));
                $this->gdlog()->LogInfoDB($this->getResult_UniversitytoGroup());
                $fr = $this->saveActivityLog("MATCHED_UNIVERISTY_TO_GROUP", "University and Group has been matched:".json_encode($this->getResult_UniversitytoGroup()).":");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("NOT_MATCHED_GROUP_TO_UNIVERISTY");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("matchUniversitytoGroup");
        return $fr;
    }

    private $Result_UniversitytoUsertoRole = "NO_RECORD";
    private $Result_UniversitytoProfile = "NO_RECORD";
    private $Result_UniversitytoGroup = "NO_RECORD";
    
    function setResult_UniversitytoUsertoRole($row)
    {
        $this->Result_UniversitytoUsertoRole = $row;
    }
    
    function getResult_UniversitytoUsertoRole()
    {
        return $this->Result_UniversitytoUsertoRole;
    }

    function setResult_UniversitytoProfile($row)
    {
        $this->Result_UniversitytoProfile = $row;
    }
    
    function getResult_UniversitytoProfile()
    {
        return $this->Result_UniversitytoProfile;
    }
    
    function setResult_UniversitytoGroup($row)
    {
        $this->Result_UniversitytoGroup = $row;
    }
    
    function getResult_UniversitytoGroup()
    {
        return $this->Result_UniversitytoGroup;
    }
    
    function getUniversitytoUsertoRole_Uid(){ return $this->Result_UniversitytoUsertoRole["uid"]; }
    function getUniversitytoUsertoRole_UnivAcctUid(){ return $this->Result_UniversitytoUsertoRole["university_accont_uid"]; }
    function getUniversitytoUsertoRole_UserAcctUid(){ return $this->Result_UniversitytoUsertoRole["user_account_uid"]; }
    function getUniversitytoUsertoRole_CfgUserRoleUid(){ return $this->Result_UniversitytoUsertoRole["cfg_user_roles_uid"]; }

    function getUniversitytoProfile_Uid(){ return $this->Result_UniversitytoProfile["uid"]; }
    function getUniversitytoProfile_UnivAcctUid(){ return $this->Result_UniversitytoProfile["university_accont_uid"]; }
    function getUniversitytoProfile_UnivProfileUid(){ return $this->Result_UniversitytoProfile["university_profile_uid"]; }
    
    function getUniversitytoGroup_Uid(){ return $this->Result_UniversitytoGroup["uid"]; }
    function getUniversitytoGroup_UnivAcctUid(){ return $this->Result_UniversitytoGroup["university_accont_uid"]; }
    function getUniversitytoGroup_GroupAcctUid(){ return $this->Result_UniversitytoGroup["group_account_uid"]; }
}
?>