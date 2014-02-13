<?php gdreqonce("/_controls/classes/base/appbase.php"); ?>
<?php
/**
 * Author: Stephen Shellenberger
 * Copyright: 2013 Stephen Shellenberger
 * Date: 2013/01/05
 */

class zMatchUser
    extends zAppBaseObject
{
    /**
     * Match User to Group to User Role.
     * $user_account_uid = UID;
     * $user_roles_desc = SDESC - Unique Search Field;
     */
    function matchUsertoRoleSdesc($user_account_uid, $cfg_user_roles_desc)
    {
        $this->gdlog()->LogInfoStartFUNCTION("matchUsertoRoleSdesc");
        $fr = $this->matchUsertoCfgRole($user_account_uid,
                                        $this->findCfgUidfromSdesc($cfg_user_roles_desc));
        $this->gdlog()->LogInfoEndFUNCTION("matchUsertoRoleSdesc");
        return $fr;
    }

    /**
     * Match User to Group to User Role.
     * $user_account_uid = UID;
     * $user_roles_uid = UID;
     */
    function matchUsertoCfgRole($user_account_uid, $cfg_user_roles_uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("matchUsertoCfgRole");
        $fr;
        $sqlstmnt = "INSERT INTO match_user_account_to_cfg_user_roles SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "user_account_uid=:user_account_uid, ".
            "cfg_user_roles_uid=:cfg_user_roles_uid";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":user_account_uid", $user_account_uid);
        $dbcontrol->bindParam(":cfg_user_roles_uid", $cfg_user_roles_uid);
        $dbcontrol->execUpdate();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResult_UsertoRole($dbcontrol->getRowfromLastId($dbcontrol, "match_user_account_to_cfg_user_roles", $dbcontrol->getLastInsertID()));
                $this->gdlog()->LogInfoDB($this->getResult_UsertoRole());
                $fr = $this->saveActivityLog("MATCHED_TO_USER_TO_ROLE", "User to Role Matched:".json_encode($this->getResult_UsertoRole()).":");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("NOT_MATCHED_TO_USER_TO_ROLE");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("matchUsertoCfgRole");
        return $fr;
    }

    /**
     * Match User to Group to User Role.
     * $user_account_uid = UID;
     * $group_account_uid = UID;
     * $user_roles_desc = SDESC - Unique Search Field;
     */
    function matchUsertoGrouptoRoleSdesc($user_account_uid, $group_account_uid, $cfg_user_roles_desc)
    {
        $this->gdlog()->LogInfoStartFUNCTION("matchUsertoGrouptoRoleSdesc");
        $fr = $this->matchUsertoGrouptoRole($user_account_uid,
                                        $group_account_uid,
                                        $this->findCfgUidfromSdesc($cfg_user_roles_desc));
        $this->gdlog()->LogInfoEndFUNCTION("matchUsertoGrouptoRoleSdesc");
        return $fr;
    }
    
    /**
     * Match User to Group to User Role.
     * $user_account_uid = UID;
     * $group_account_uid = UID;
     * $user_roles_uid = UID;
     */
    function matchUsertoGrouptoRole($user_account_uid, $group_account_uid, $cfg_user_roles_uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("matchUsertoGrouptoRole");
        $utk = $_SESSION["UNIV_MEET_AUTH_UNIV_TBL_KEY"]."_";
        $fr;
        $sqlstmnt = "INSERT INTO ".$utk."match_user_account_to_group_account_to_cfg_user_roles SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "user_account_uid=:user_account_uid, ".
            "group_account_uid=:group_account_uid, ".
            "cfg_user_roles_uid=:cfg_user_roles_uid";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":user_account_uid", $user_account_uid);
        $dbcontrol->bindParam(":group_account_uid", $group_account_uid);
        $dbcontrol->bindParam(":cfg_user_roles_uid", $cfg_user_roles_uid);
        $dbcontrol->execUpdate();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResult_UsertoGrouptoRole($dbcontrol->getRowfromLastId($dbcontrol, $utk."match_user_account_to_group_account_to_cfg_user_roles", $dbcontrol->getLastInsertID()));
                $this->gdlog()->LogInfoDB($this->getResult_UsertoGrouptoRole());
                $fr = $this->saveActivityLog("MATCHED_TO_USER_TO_GROUP_TO_ROLE", "User to Group to Role Matched:".json_encode($this->getResult_UsertoGrouptoRole()).":");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("NOT_MATCHED_TO_USER_TO_GROUP_TO_ROLE");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("matchUsertoGrouptoRole");
        return $fr;
    }

    /**
     * Match User to Profile
     * $user_account_uid = UID
     * $user_profile_uid = UID
     */
    function matchUsertoProfile($user_account_uid, $user_profile_uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("matchUsertoProfile");
        $fr;
        $sqlstmnt = "INSERT INTO match_user_account_to_user_profile SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "user_account_uid=:user_account_uid, ".
            "user_profile_uid=:user_profile_uid";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":user_account_uid", $user_account_uid);
        $dbcontrol->bindParam(":user_profile_uid", $user_profile_uid);
        $dbcontrol->execUpdate();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResult_UsertoProfile($dbcontrol->getRowfromLastId($dbcontrol, "match_user_account_to_user_profile", $dbcontrol->getLastInsertID()));
                $this->gdlog()->LogInfoDB($this->getResult_UsertoProfile());
                $fr = $this->saveActivityLog("MATCHED_USER_TO_PROFILE", "User and Profile has been matched:".json_encode($this->getResult_UsertoProfile()).":");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("NOT_MATCHED_USER_TO_PROFILE");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("matchUsertoProfile");
        return $fr;
    }

    private $Result_UsertoRole = "NO_RECORD";
    private $Result_UsertoGrouptoRole = "NO_RECORD";
    private $Result_UsertoProfile = "NO_RECORD";
    
    function setResult_UsertoRole($row)
    {
        $this->Result_UsertoRole = $row;
    }
    
    function getResult_UsertoRole()
    {
        return $this->Result_UsertoRole;
    }

    function setResult_UsertoGrouptoRole($row)
    {
        $this->Result_UsertoGrouptoRole = $row;
    }
    
    function getResult_UsertoGrouptoRole()
    {
        return $this->Result_UsertoGrouptoRole;
    }
    
    function setResult_UsertoProfile($row)
    {
        $this->Result_UsertoProfile = $row;
    }
    
    function getResult_UsertoProfile()
    {
        return $this->Result_UsertoProfile;
    }
    
    function getUsertoRole_Uid(){ return $this->Result_UsertoRole["uid"]; }
    function getUsertoRole_UserAcctUid(){ return $this->Result_UsertoRole["user_account_uid"]; }
    function getUsertoRole_CfgUserRoleUid(){ return $this->Result_UsertoRole["cfg_user_roles_uid"]; }
    
    function getUsertoGrouptoRole_Uid(){ return $this->Result_UsertoGrouptoRole["uid"]; }
    function getUsertoGrouptoRole_UserAcctUid(){ return $this->Result_UsertoGrouptoRole["user_account_uid"]; }
    function getUsertoGrouptoRole_GroupAcctUid(){ return $this->Result_UsertoGrouptoRole["group_account_uid"]; }
    function getUsertoGrouptoRole_CfgUserRoleUid(){ return $this->Result_UsertoGrouptoRole["cfg_user_roles_uid"]; }
    
    function getUsertoProfile_Uid(){ return $this->Result_UsertoProfile["uid"]; }
    function getUsertoProfile_UserAcctUid(){ return $this->Result_UsertoProfile["user_account_uid"]; }
    function getUsertoProfile_UserProfUid(){ return $this->Result_UsertoProfile["user_profile_uid"]; }
}
?>