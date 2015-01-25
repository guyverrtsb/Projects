<?php sysinc("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php
class Roles
    extends AppSysBaseObject
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
        $this->gdlog()->LogInfoStartFUNCTION("registerRolestoNewSite");
        $sqlstmnt = "SELECT uid, sdesc FROM usersafety_role";

        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("crossapplication");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->execSelect();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)   // Site and Alias has been Found
            {
                $sqlstmnt = "INSERT INTO match_usersafety_site_to_role SET ".
                    "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
                    "usersafety_site_uid=:usersafety_site_uid, ".
                    "usersafety_role_uid=:usersafety_role_uid";
                    
                $dbcontrolIns = new ZAppDatabase();
                $dbcontrolIns->setApplicationDB("crossapplication");
                
                while($row = $dbcontrol->getStatement()->fetch(PDO::FETCH_ASSOC))
                {
                    $this->gdlog()->LogInfo("registerRolestoNewSite: Row Count : ".$dbcontrol->getRowCount());
                    $this->gdlog()->LogInfoDB($row);
                    $this->gdlog()->LogInfo("Roles Found");

                    $dbcontrolIns->setStatement($sqlstmnt);
                    $dbcontrolIns->bindParam(":usersafety_site_uid", $this->su);
                    $dbcontrolIns->bindParam(":usersafety_role_uid", $row["uid"]);
                    $dbcontrolIns->execUpdate();
                    if($dbcontrolIns->getTransactionGood())
                    {
                        if($dbcontrolIns->getRowCount() > 0)
                        {
                            $this->saveActivityLog("ROLE_ASSIGNED_TO_NEW_SITE", ":".json_encode($row).":");
                        }
                        else
                        {
                            $this->gdlog()->LogInfoRETURN("ROLE_ASSIGNED_TO_NEW_SITE_FAILED");
                        }
                    }
                    else
                    {
                        $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL_ROLE_ASSIGNED_TO_NEW_SITE");
                    }
                }

                $this->gdlog()->LogInfoRETURN("ALL_ROLES_ASSIGNED_TO_NEW_SITE");
                return true;
            }
            else
            {
                $this->gdlog()->LogInfoRETURN("TRANSACTION_FAIL_GETING_SITE_ROLES_TEMPLATE");
                return false;
            }
        }
        $dbcontrol->rollbackcommit();
        $this->gdlog()->LogInfoERROR("TRANSACTION_FAIL");
        $this->gdlog()->LogInfoEndFUNCTION("registerRolestoNewSite");
        return false;
    }
}
?>