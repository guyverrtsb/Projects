<?php gdreqonce("/gd.trxn.com/usersafety/_controls/classes/_user.php"); ?>
<?php
class ZRoles
    extends Z_User_Base
{ 
    private $su;
    private $sp;
    
    function __construct()
    {
        $this->su = $_SESSION["GUYVERDESIGNS_SITE_UID"];
        $this->sp = $_SESSION["GUYVERDESIGNS_SITE"];
        $this->gdlog()->LogInfo($this->su."-".$this->sp);
    }
    
    function registerRolestoNewSite()
    {
        $this->gdlog()->LogInfo("****************: START :registerRolestoNewSite()");
        $fr;
        $sqlstmnt = "SELECT uid, sdesc FROM usersafety_role";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->execSelect();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)   // Site and Alias has been Found
            {
                $sqlstmnt = "INSERT INTO match_usersafety_site_to_role SET ".
                    "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
                    "usersafety_site_uid=:usersafety_site_uid, ".
                    "usersafety_role_uid=:usersafety_role_uid";
                    
                $appconIns = new ZAppDatabase();
                $appconIns->setApplicationDB();
                
                while($row = $appcon->getStatement()->fetch(PDO::FETCH_ASSOC))
                {
                    $this->gdlog()->LogInfo("matchSiteandRoles: Row Count : ".$appcon->getRowCount());

                    $appconIns->setStatement($sqlstmnt);
                    $appconIns->bindParam(":usersafety_site_uid", $this->su);
                    $appconIns->bindParam(":usersafety_role_uid", $row["uid"]);
                    $appconIns->execUpdate();
                    if($appconIns->getTransactionGood())
                    {
                        if($appconIns->getRowCount() > 0)
                        {
                            $lid = $appconIns->getLastInsertID();
                            $appconIns->saveActivityLog("REGISTER_SITE_TO_ROLES_MATCH","Site to Roles match.".
                                ":Last Id:".$lid.
                                ":".$this->su.":".
                                ":".$this->sp.":".
                                ":".$row["uid"].":".
                                ":".$row["sdesc"].":");

                            $this->gdlog()->LogInfo("matchSiteandRoles:true:".$row["uid"].":".$row["sdesc"].":");
                        }
                        else
                        {
                            $this->gdlog()->LogInfo("matchSiteandRoles:false");
                        }
                    }
                    else
                    {
                        $this->gdlog()->LogInfo("matchSiteandRoles():getTransactionGood():false");
                    }
                }

                $this->gdlog()->LogInfo("registerRolestoNewSite():true");
                $fr = "ROLE_TO_SITE_REGISTERED";
            }
            else
            {
                $this->gdlog()->LogInfo("registerRolestoNewSite():false");
                $fr = "ROLE_TO_SITE_NOT_REGISTERED";
            }
        }
        else
        {
            $this->gdlog()->LogError("registerRolestoNewSite():TRANSACTION_FAIL");
            $fr = "TRANSACTION_FAIL";
        }
        $this->gdlog()->LogInfo("****************: END :registerRolestoNewSite()");
        return $fr;
    }

        function registerUserAccounttoRole($email, $rolesdesc)
    {
        $sqlstmnt = "INSERT INTO match_usersafety_useraccount_to_role ".
                    "(uid,createddt,changeddt,usersafety_useraccount_uid,usersafety_role_uid) ".
                    "VALUES (UUID(),NOW(),NOW(),".
                     "(SELECT uid FROM usersafety_useraccount WHERE email=:email),".
                     "(SELECT uid FROM usersafety_role where sdesc=:rolesdesc));";
        
        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":email", $email);
        $appcon->bindParam(":rolesdesc", $rolesdesc);
        $appcon->execUpdate();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $lid = $appcon->getLastInsertID();
                $appcon->saveActivityLog("REGISTER_USER_ACCOUNT_TO_ROLE","User has been registered to role".
                    ":Last Id:".$lid.":".$email.":".$rolesdesc);

                $row = $appcon->getRowfromLastId($appcon, "match_usersafety_useraccount_to_role", $lid);
                $this->gdlog()->LogInfo("registerUserAccount():USER_ACCOUNT_ASSIGNED_TO_ROLE");
                return "USER_ACCOUNT_ASSIGNED_TO_ROLE";
            }
            else
            {
                $this->gdlog()->LogInfo("registerUserAccounttoRole():USER_ACCOUNT_NOT_ASSIGNED_TO_ROLE");
                return "USER_ACCOUNT_NOT_ASSIGNED_TO_ROLE";
            }
        }
        else
        {
            $this->gdlog()->LogInfo("registerUserAccounttoRole():TRANSACTION_FAIL");
            return "TRANSACTION_FAIL";
        }
    }
}
?>