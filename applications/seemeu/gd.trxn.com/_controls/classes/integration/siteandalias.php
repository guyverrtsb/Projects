<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php
class SiteandAlias
    extends AppSysBaseObject
{ 
    private $sp;
    private $sa;
    
    function __construct()
    {
        $this->sp = $_SESSION["GUYVERDESIGNS_SITE"];
        $this->sa = $_SESSION["GUYVERDESIGNS_SITE_ALIAS"];
        zLog()->LogInfo($this->sp."-".$this->sa);
    }
    
    function isSiteandAliasValid()
    {
        zLog()->LogInfoStartFUNCTION("isSiteandAliasValid");
        $sqlstmnt = "SELECT ".$this->dbfas("site.uid, site.sdesc, sitealias.uid, sitealias.sdesc")." ".
            "FROM sitealias ".
            "JOIN match_site_to_sitealias ".
            "ON match_site_to_sitealias.sitealias_uid = sitealias.uid ".
            "JOIN site ".
            "ON site.uid = match_site_to_sitealias.site_uid ".
            "WHERE sitealias.sdesc=:alias";

        $dbcontrol = new SysConnections();
        $dbcontrol->setApplicationDB("crossapplication");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":alias", $this->sa);
        $dbcontrol->execSelect();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)   // Site and Alias has been Found
            {
                $row = $dbcontrol->getStatement()->fetch();
                $_SESSION["GUYVERDESIGNS_SITE_UID"] = $row[$this->dbf("site.uid")];
                $_SESSION["GUYVERDESIGNS_SITE"] = $row[$this->dbf("site.sdesc")];
                $_SESSION["GUYVERDESIGNS_SITE_ALIAS_UID"] = $row[$this->dbf("sitealias.uid")];
                $_SESSION["GUYVERDESIGNS_SITE_ALIAS"] = $row[$this->dbf("sitealias.sdesc")];
                zLog()->LogInfoDB($row);
                zLog()->LogInfoRETURN("TRUE");
                return true;
            }
            else
            {
                zLog()->LogInfoRETURN("FALSE");
                return false;
            }
        }
        $fr = zLog()->LogInfoRETURN("FALSE");
        zLog()->LogInfoEndFUNCTION("isSiteandAliasValid");
        return false;
    }
    
    function doesSiteExist()
    {
        zLog()->LogInfoStartFUNCTION("doesSiteExist");
        $sqlstmnt = "SELECT uid FROM site ".
            "WHERE sdesc=:package";

        $dbcontrol = new SysConnections();
        $dbcontrol->setApplicationDB("crossapplication");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":package", $this->sp);
        $dbcontrol->execSelect();
        
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)   // Site and Alias has been Found
            {
                $row = $dbcontrol->getStatement()->fetch(PDO::FETCH_ASSOC);
                $_SESSION["GUYVERDESIGNS_SITE_UID"] = $row["uid"];
                $_SESSION["GUYVERDESIGNS_SITE"] = $this->sp;
                zLog()->LogInfoDB($row);
                zLog()->LogInfoRETURN("TRUE");
                return true;
            }
            else
            {
                zLog()->LogInfoRETURN("FALSE");
                return false;
            }
        }
        zLog()->LogInfoRETURN("FALSE");
        zLog()->LogInfoEndFUNCTION("doesSiteExist");
        return false;
    }

    function registerSite()
    {
        zLog()->LogInfoStartFUNCTION("registerSite");
        $sqlstmnt = "INSERT INTO site SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "sdesc=:package";

        $dbcontrol = new SysConnections();
        $dbcontrol->setApplicationDB("crossapplication");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":package", $this->sp);
        $dbcontrol->execUpdate();
        
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $row = $dbcontrol->getRowfromLastId($dbcontrol, "site", $dbcontrol->getLastInsertID());
                
                zLog()->LogInfo("registerSite() - UID - ".$row["uid"]);
                $_SESSION["GUYVERDESIGNS_SITE_UID"] = $row["uid"];
                
                zLog()->LogInfo("registerSite() - PACKAGE - ".$row["sdesc"]);
                $_SESSION["GUYVERDESIGNS_SITE"] = $row["sdesc"];
                
                $this->saveActivityLog("TRUE", ":".json_encode($row).":");
                zLog()->LogInfoDB($row);
                return true;
            }
            else
            {
                zLog()->LogInfo("registerSite():false");
            	return false;
            }
        }
        $dbcontrol->rollbackcommit();
        zLog()->LogInfoEndFUNCTION("registerSite");
        return false;
    }
    
    function registerSiteAlias()
    {
        zLog()->LogInfoStartFUNCTION("registerSiteAlias");
        $sqlstmnt = "INSERT INTO sitealias SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "sdesc=:fullyqualifieddomain";

        $dbcontrol = new SysConnections();
        $dbcontrol->setApplicationDB("crossapplication");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":fullyqualifieddomain", $this->sa);
        $dbcontrol->execUpdate();
        
        zLog()->LogInfo("registerSiteAlias() - fullyqualifieddomain - this->sa - ".$this->sa);
        
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $lid = $dbcontrol->getLastInsertID();
                $this->saveActivityLog("REGISTER_SITE_ALIAS","Site Alias has been Registered.".
                    ":Last Id:".$lid.
                    ":Site Alias:".$this->sa.":");
                
                $row = $dbcontrol->getRowfromLastId($dbcontrol, "sitealias", $lid);
                
                zLog()->LogInfo("registerSiteAlias() - UID - ".$row["uid"]);
                $_SESSION["GUYVERDESIGNS_SITE_ALIAS_UID"] = $row["uid"];
                
                zLog()->LogInfo("registerSiteAlias() - fullyqualifieddomain - ".$row["sdesc"]);
                $_SESSION["GUYVERDESIGNS_SITE_ALIAS"] = $row["sdesc"];
                
                zLog()->LogInfoRETURN("TRUE");
                return true;
            }
            else
            {
                zLog()->LogInfoRETURN("FALSE");
                return false;
            }
        }
        $dbcontrol->rollbackcommit();
        zLog()->LogInfoRETURN("FALSE");
        zLog()->LogInfoEndFUNCTION("registerSiteAlias");
        return false;
    }
    
    function matchSiteandSiteAlias()
    {
        zLog()->LogInfoStartFUNCTION("matchSiteandSiteAlias");
        $sqlstmnt = "INSERT INTO match_site_to_sitealias SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "site_uid=:site_uid, ".
            "sitealias_uid=:sitealias_uid";

        $dbcontrol = new SysConnections();
        $dbcontrol->setApplicationDB("crossapplication");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":site_uid", $_SESSION["GUYVERDESIGNS_SITE_UID"]);
        $dbcontrol->bindParam(":sitealias_uid", $_SESSION["GUYVERDESIGNS_SITE_ALIAS_UID"]);
        $dbcontrol->execUpdate();
        
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $this->saveActivityLog("TRUE","Site to Site Alias match.".
                    "GUYVERDESIGNS_SITE_UID:".$_SESSION["GUYVERDESIGNS_SITE_UID"].":".
                    "GUYVERDESIGNS_SITE:".$_SESSION["GUYVERDESIGNS_SITE"]."-".
                    "GUYVERDESIGNS_SITE_ALIAS_UID:".$_SESSION["GUYVERDESIGNS_SITE_ALIAS_UID"].":".
                    "GUYVERDESIGNS_SITE_ALIAS:".$_SESSION["GUYVERDESIGNS_SITE_ALIAS"].":");
                return true;
            }
            else
            {
                zLog()->LogInfoRETURN("FALSE");
                return false;
            }
        }
        $dbcontrol->rollbackcommit();
        zLog()->LogInfoRETURN("FALSE");
        zLog()->LogInfoEndFUNCTION("matchSiteandSiteAlias");
        return false;
    }
}
?>