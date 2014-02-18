<?php gdreqonce("/_controls/classes/authorize.php"); ?>
<?php
class zAllowed
    extends zAuthorize
{
    function isGroupUser()
    {
        $this->gdlog()->LogInfoStartFUNCTION("isGroupUser");
        if($this->getGDConfig()->getSessGroupUserRoleSdesc() != "")
        {
            if($this->getGDConfig()->getSessGroupUserRoleSdesc() == "USER_ROLE_GROUP_USER")
            {
                return true;
            }
            $this->gdlog()->LogInfoERROR("isGroupUser{UNIV_MEET_GROUP_ROLE does not Match USER_ROLE_GROUP_USER : ".$this->getGDConfig()->getSessGroupUserRoleSdesc()." }");
        }
        else
        {
            $this->gdlog()->LogInfoERROR("isGroupUser{UNIV_MEET_GROUP_ROLE NOT SET}");
        }
        $this->gdlog()->LogInfoEndFUNCTION("isGroupUser");
        return false;
    }
    
    function isGroupOwner()
    {
        if($this->getGDConfig()->getSessGroupUserRoleSdesc())
        {
            if($this->getGDConfig()->getSessGroupUserRoleSdesc() == "USER_ROLE_GROUP_OWNER")
            {
                return true;
            }
            $this->gdlog()->LogInfoERROR("isGroupOwner{UNIV_MEET_GROUP_ROLE does not Match USER_ROLE_GROUP_OWNER : ".$this->getGDConfig()->getSessGroupUserRoleSdesc()." }");
        }
        else
        {
            $this->gdlog()->LogInfoERROR("isGroupOwner{UNIV_MEET_GROUP_ROLE NOT SET}");
        }
        $this->gdlog()->LogInfoEndFUNCTION("isGroupOwner");
        return false;
    }
    
    function doesUserBelongtoGroupRole($cfg_user_roles_uid)
    {
        $this->gdlog()->LogInfoStartFUNCTION("doesUserBelongtoGroupRole");
        $this->getGDConfig()->clearResult_GroupUserRole();
        $utk = $this->getGDConfig()->getSessUnivTblKey();
        $fr;
        $sqlstmnt = "SELECT ".
            "uid,  cfg_user_roles_uid ".
            "FROM ".$utk."match_user_account_to_group_account_to_cfg_user_roles ".
            "WHERE user_account_uid=:user_account_uid ".
            "AND group_account_uid=:group_account_uid ".
            "AND cfg_user_roles_uid=:cfg_user_roles_uid";
        
        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("GROUPYOU");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":user_account_uid", $this->getGDConfig()->getSessAuthUserUid());
        $dbcontrol->bindParam(":group_account_uid", $this->getGDConfig()->getSessGroupUid());
        $dbcontrol->bindParam(":cfg_user_roles_uid", $cfg_user_roles_uid);
        $dbcontrol->execSelect();
        
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->setResult_GroupUserRole($dbcontrol->getStatement()->fetch(PDO::FETCH_ASSOC));
                $this->gdlog()->LogInfoDB($this->getResult_GroupUserRole());
                $fr = $this->saveActivityLog("USER_MATCHES_GROUP_ROLE", "User is Admin of Group:".json_encode($this->getResult_GroupUserRole()).":");
            }
            else
            {
                $fr = $this->gdlog()->LogInfoRETURN("USER_DOES_NOT_MATCH_GROUP_ROLE");
            }
        }
        else
        {
            $fr = $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        }
        $this->gdlog()->LogInfoEndFUNCTION("doesUserBelongtoGroupRole");
        return $fr;
    }
    

    private $Result_GroupUserRole = "NO_RECORD";
    function setResult_GroupUserRole($row)
    {
        $this->Result_GroupUserRole = $row;
    }
    function getResult_GroupUserRole()
    {
        return $this->Result_GroupUserRole;
    }
    function clearResult_GroupUserRole()
    {
        $this->Result_GroupUserRole = "NO_RECORD";
    }
    
    function getUid(){ return $this->Result_GroupUserRole["uid"]; }
    function getCfgUserRoleUid(){ return $this->Result_GroupUserRole["cfg_user_roles_uid"]; }
    function getCfgUserRoleSdesc(){ return $this->findCfgSdescfromUid($this->Result_GroupUserRole["cfg_user_roles_uid"]); }
}
?>