<?php gdreqonce("/gd.trxn.com/usersafety/_controls/classes/authenticate.php"); ?>
<?php
class zAllowed
    extends zAuthenticate
{
    
    function isUserAdminofGroupAuthorizedSdesc($user_account_uid,
                                            $global_group_account_uid,
                                            $cfg_user_roles_sdesc)
    {
        $this->findCfgUserRoleUid($cfg_user_roles_sdesc);
        $cfg_user_roles_uid = $this->getCfgUserRoleUid();
        $r = $this->isUserAdminofGroupAuthorized($user_account_uid,
                                        $global_group_account_uid,
                                        $cfg_user_roles_uid);
        return $r;
    }
    
    function isUserAdminofGroupAuthorized($user_account_uid,
                                        $global_group_account_uid,
                                        $cfg_user_roles_uid)
    {
        $this->gdlog()->LogInfo("****************: START :isUserAdminofGroupAuthorized()");
        $fr;

        $sqlstmnt = "SELECT ".
        "uid ".
        "FROM match_user_account_to_group_account_to_cfg_user_roles ".
        "WHERE user_account_uid=:user_account_uid ".
        "AND group_account_uid=:group_account_uid ".
        "AND cfg_user_roles_uid=:cfg_user_roles_uid";
        
        $appcon = new ZAppDatabase();
        $appcon->setUserSafetyConn("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":user_account_uid", $user_account_uid);
        $appcon->bindParam(":group_account_uid", $global_group_account_uid);
        $appcon->bindParam(":cfg_user_roles_uid", $cfg_user_roles_uid);
        $appcon->execSelect();
        
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $row = $appcon->getStatement()->fetch(PDO::FETCH_ASSOC);
    
                $appcon->saveActivityLog("USER_AUTHENITACTED","User is Admin of Group".
                    ":uid:".$row["uid"].":");
                $this->gdlog()->LogInfo("isUserAdminofGroupAuthorized():USER_IS_ADMIN_OF_GROUP");
                $fr = "USER_IS_ADMIN_OF_GROUP";
            }
            else
            {
                $this->gdlog()->LogInfo("isUserAdminofGroupAuthorized():USER_IS_NOT_ADMIN_OF_GROUP");
                $fr = "USER_IS_NOT_ADMIN_OF_GROUP";
            }
        }
        else
        {
            $this->gdlog()->LogError("isUserAdminofGroupAuthorized():TRANSACTION_FAIL");
            $fr = "TRANSACTION_FAIL";
        }
        $this->gdlog()->LogInfo("****************: END :isUserAdminofGroupAuthorized()");
        return $fr;
    }
}
?>