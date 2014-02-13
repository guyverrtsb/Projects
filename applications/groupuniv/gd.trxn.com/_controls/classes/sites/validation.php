<?php gdreqonce("/gd.trxn.com/_controls/classes/base/baseobject.php"); ?>
<?php
class ZGDSiteAlias
    extends zBaseObject
{ 
    private $sp;
    private $sa;
    
    function __construct()
    {
        $this->sp = $_SESSION["GUYVERDESIGNS_SITE"];
        $this->sa = $_SESSION["GUYVERDESIGNS_SITE_ALIAS"];
        $this->gdlog()->LogInfo($this->sp."-".$this->sa);
    }
    
    function isSiteandAliasValid()
    {
        $this->gdlog()->LogInfoStartFUNCTION("isSiteandAliasValid");
        $sqlstmnt = "SELECT ".$this->dbfas("usersafety_site.uid, usersafety_site.sdesc, usersafety_site_alias.uid, usersafety_site_alias.sdesc")." ".
            "FROM usersafety_site_alias ".
            "JOIN match_usersafety_site_to_site_alias ".
            "ON match_usersafety_site_to_site_alias.usersafety_site_alias_uid = usersafety_site_alias.uid ".
            "JOIN usersafety_site ".
            "ON usersafety_site.uid = match_usersafety_site_to_site_alias.usersafety_site_uid ".
            "WHERE usersafety_site_alias.sdesc=:alias";

        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("USERSAFETY");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":alias", $this->sa);
        $dbcontrol->execSelect();
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)   // Site and Alias has been Found
            {
                $row = $dbcontrol->getStatement()->fetch();
                $_SESSION["GUYVERDESIGNS_SITE_UID"] = $row[$this->dbf("usersafety_site.uid")];
                $_SESSION["GUYVERDESIGNS_SITE"] = $row[$this->dbf("usersafety_site.sdesc")];
                $_SESSION["GUYVERDESIGNS_SITE_ALIAS_UID"] = $row[$this->dbf("usersafety_site_alias.uid")];
                $_SESSION["GUYVERDESIGNS_SITE_ALIAS"] = $row[$this->dbf("usersafety_site_alias.sdesc")];
                $this->gdlog()->LogInfoDB($row);
                $this->gdlog()->LogInfoRETURN("TRUE");
                return true;
            }
            else
            {
                $this->gdlog()->LogInfoRETURN("FALSE");
                return false;
            }
        }
        $fr = $this->gdlog()->LogInfoRETURN("FALSE");
        $this->gdlog()->LogInfoEndFUNCTION("isSiteandAliasValid");
        return false;
    }
    
    function doesSiteExist()
    {
        $this->gdlog()->LogInfoStartFUNCTION("doesSiteExist");
        $sqlstmnt = "SELECT uid FROM usersafety_site ".
            "WHERE sdesc=:package";

        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("USERSAFETY");
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
                $this->gdlog()->LogInfoDB($row);
                $this->gdlog()->LogInfoRETURN("TRUE");
                return true;
            }
            else
            {
                $this->gdlog()->LogInfoRETURN("FALSE");
                return false;
            }
        }
        $this->gdlog()->LogInfoRETURN("FALSE");
        $this->gdlog()->LogInfoEndFUNCTION("doesSiteExist");
        return false;
    }

    function registerSite()
    {
        $this->gdlog()->LogInfoStartFUNCTION("registerSite");
        $sqlstmnt = "INSERT INTO usersafety_site SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "sdesc=:package";

        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("USERSAFETY");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":package", $this->sp);
        $dbcontrol->execUpdate();
        
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $row = $dbcontrol->getRowfromLastId($dbcontrol, "usersafety_site", $dbcontrol->getLastInsertID());
                
                $this->gdlog()->LogInfo("registerSite() - UID - ".$row["uid"]);
                $_SESSION["GUYVERDESIGNS_SITE_UID"] = $row["uid"];
                
                $this->gdlog()->LogInfo("registerSite() - PACKAGE - ".$row["sdesc"]);
                $_SESSION["GUYVERDESIGNS_SITE"] = $row["sdesc"];
                
                $this->saveActivityLog("TRUE", ":".json_encode($row).":");
                $this->gdlog()->LogInfoDB($row);
                return true;
            }
            else
            {
                $this->gdlog()->LogInfo("registerSite():false");
            	return false;
            }
        }
        $dbcontrol->rollbackcommit();
        $this->gdlog()->LogInfoEndFUNCTION("registerSite");
        return false;
    }
    
    function registerSiteAlias()
    {
        $this->gdlog()->LogInfoStartFUNCTION("registerSiteAlias");
        $sqlstmnt = "INSERT INTO usersafety_site_alias SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "sdesc=:fullyqualifieddomain";

        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("USERSAFETY");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":fullyqualifieddomain", $this->sa);
        $dbcontrol->execUpdate();
        
        $this->gdlog()->LogInfo("registerSiteAlias() - fullyqualifieddomain - this->sa - ".$this->sa);
        
        if($dbcontrol->getTransactionGood())
        {
            if($dbcontrol->getRowCount() > 0)
            {
                $lid = $dbcontrol->getLastInsertID();
                $this->saveActivityLog("REGISTER_SITE_ALIAS","Site Alias has been Registered.".
                    ":Last Id:".$lid.
                    ":Site Alias:".$this->sa.":");
                
                $row = $dbcontrol->getRowfromLastId($dbcontrol, "usersafety_site_alias", $lid);
                
                $this->gdlog()->LogInfo("registerSiteAlias() - UID - ".$row["uid"]);
                $_SESSION["GUYVERDESIGNS_SITE_ALIAS_UID"] = $row["uid"];
                
                $this->gdlog()->LogInfo("registerSiteAlias() - fullyqualifieddomain - ".$row["sdesc"]);
                $_SESSION["GUYVERDESIGNS_SITE_ALIAS"] = $row["sdesc"];
                
                $this->gdlog()->LogInfoRETURN("TRUE");
                return true;
            }
            else
            {
                $this->gdlog()->LogInfoRETURN("FALSE");
                return false;
            }
        }
        $dbcontrol->rollbackcommit();
        $this->gdlog()->LogInfoRETURN("FALSE");
        $this->gdlog()->LogInfoEndFUNCTION("registerSiteAlias");
        return false;
    }
    
    function matchSiteandSiteAlias()
    {
        $this->gdlog()->LogInfoStartFUNCTION("matchSiteandSiteAlias");
        $sqlstmnt = "INSERT INTO match_usersafety_site_to_site_alias SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "usersafety_site_uid=:usersafety_site_uid, ".
            "usersafety_site_alias_uid=:usersafety_site_alias_uid";

        $dbcontrol = new ZAppDatabase();
        $dbcontrol->setApplicationDB("USERSAFETY");
        $dbcontrol->setStatement($sqlstmnt);
        $dbcontrol->bindParam(":usersafety_site_uid", $_SESSION["GUYVERDESIGNS_SITE_UID"]);
        $dbcontrol->bindParam(":usersafety_site_alias_uid", $_SESSION["GUYVERDESIGNS_SITE_ALIAS_UID"]);
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
                $this->gdlog()->LogInfoRETURN("FALSE");
                return false;
            }
        }
        $dbcontrol->rollbackcommit();
        $this->gdlog()->LogInfoRETURN("FALSE");
        $this->gdlog()->LogInfoEndFUNCTION("matchSiteandSiteAlias");
        return false;
    }
}
?>