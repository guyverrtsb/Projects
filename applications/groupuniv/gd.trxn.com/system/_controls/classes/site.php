<?php gdreqonce("/gd.trxn.com/_controls/classes/base/baseobject.php"); ?>
<?php
class ZSiteAlias
    extends zBaseObject
{ 
    private $sp;
    private $sa;
    
    function __construct()
    {
        $f = explode("/", $_SERVER["DOCUMENT_ROOT"]);
        $this->sp = $f[sizeof($f) - 1];
        $this->sa = $_SERVER["SERVER_NAME"];
        $this->gdlog()->LogInfo($this->sp."-".$this->sa);
    }
    
    function isSiteandAliasValid()
    {
        $this->gdlog()->LogInfo("****************: START :isSiteandAliasValid()");
        $fr;
        $sqlstmnt = "SELECT ".
            "usersafety_site.uid, usersafety_site.sdesc, ".
            "usersafety_site_alias.uid, usersafety_site_alias.sdesc ".
            "FROM match_usersafety_site_to_site_alias ".
            "JOIN usersafety_site_alias ".
            " ON match_usersafety_site_to_site_alias.usersafety_site_alias_uid = usersafety_site_alias.uid ".
            "JOIN usersafety_site ".
            " ON match_usersafety_site_to_site_alias.usersafety_site_uid = usersafety_site.uid ".
            "WHERE usersafety_site.sdesc=:package ".
            "AND usersafety_site_alias.sdesc=:alias";

        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":package", $this->sp);
        $appcon->bindParam(":alias", $this->sa);
        $appcon->execSelect();
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)   // Site and Alias has been Found
            {
                $row = $appcon->getStatement()->fetch();
                $_SESSION["GUYVERDESIGNS_SITE_UID"] = $row[0];
                $_SESSION["GUYVERDESIGNS_SITE"] = $row[1];
                $_SESSION["GUYVERDESIGNS_SITE_ALIAS_UID"] = $row[2];
                $_SESSION["GUYVERDESIGNS_SITE_ALIAS"] = $row[3];
                $this->gdlog()->LogInfo("isSiteandAliasValid():true");
                $fr = "SITE_AND_ALIAS_VALID";
            }
            else
            {
                $this->gdlog()->LogInfo("isSiteandAliasValid():false");
                $fr = "SITE_AND_ALIAS_NOT_VALID";
            }
        }
        else
        {
            $this->gdlog()->LogError("isSiteandAliasValid():TRANSACTION_FAIL");
            $fr = "TRANSACTION_FAIL";
        }
        $this->gdlog()->LogInfo("****************: END :isSiteandAliasValid()");
        return $fr;
    }
    
    function doesSiteExist()
    {
        $this->gdlog()->LogInfo("****************: START :doesSiteExist()");
        $fr;
        $sqlstmnt = "SELECT uid FROM usersafety_site ".
            "WHERE sdesc=:package";

        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":package", $this->sp);
        $appcon->execSelect();
        
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)   // Site and Alias has been Found
            {
                $row = $appcon->getStatement()->fetch(PDO::FETCH_ASSOC);
                $_SESSION["GUYVERDESIGNS_SITE_UID"] = $row["uid"];
                $_SESSION["GUYVERDESIGNS_SITE"] = $this->sp;
                $this->gdlog()->LogInfo("doesSiteExist():true");
                $fr = "SITE_FOUND";
            }
            else
            {
                $this->gdlog()->LogInfo("doesSiteExist():false");
                $fr = "SITE_NOT_FOUND";
            }
        }
        else
        {
            $this->gdlog()->LogError("doesSiteExist():TRANSACTION_FAIL");
            $fr = "TRANSACTION_FAIL";
        }
        $this->gdlog()->LogInfo("****************: END :doesSiteExist()");
        return $fr;
    }

    function registerSite()
    {
        $this->gdlog()->LogInfo("****************: START :registerSite()");
        $fr;
        $sqlstmnt = "INSERT INTO usersafety_site SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "sdesc=:package";

        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":package", $this->sp);
        $appcon->execUpdate();
        
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $lid = $appcon->getLastInsertID();
                $appcon->saveActivityLog("REGISTER_SITE","Site has been Registered.".
                    ":Last Id:".$lid.":Site Package:".$this->sp.":");
                
                $row = $appcon->getRowfromLastId($this, "usersafety_site", $lid);
                $this->gdlog()->LogInfo("registerSite() - UID - ".$row["uid"]);
                $_SESSION["GUYVERDESIGNS_SITE_UID"] = $row["uid"];
                $this->gdlog()->LogInfo("registerSite() - PACKAGE - ".$row["sdesc"]);
                $_SESSION["GUYVERDESIGNS_SITE"] = $row["sdesc"];
                
                $this->gdlog()->LogInfo("registerSite():true");
                $fr = "SITE_REGISTERED";
            }
            else
            {
                $this->gdlog()->LogInfo("registerSite():false");
                $fr = "SITE_NOT_REGISTERED";
            }
        }
        else
        {
            $this->gdlog()->LogError("registerSite():TRANSACTION_FAIL");
            $fr = "TRANSACTION_FAIL";
        }
        $this->gdlog()->LogInfo("****************: END :registerSite()");
        return $fr;
    }
    
    function registerSiteAlias()
    {
        $this->gdlog()->LogInfo("****************: START :registerSiteAlias()");
        $fr;
        $sqlstmnt = "INSERT INTO usersafety_site_alias SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "sdesc=:fullyqualifieddomain";

        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":fullyqualifieddomain", $this->sa);
        $appcon->execUpdate();
        
        $this->gdlog()->LogInfo("registerSiteAlias() - fullyqualifieddomain - this->sa - ".$this->sa);
        
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $lid = $appcon->getLastInsertID();
                $appcon->saveActivityLog("REGISTER_SITE_ALIAS","Site Alias has been Registered.".
                    ":Last Id:".$lid.
                    ":Site Alias:".$this->sa.":");
                
                $row = $appcon->getRowfromLastId($this, "usersafety_site_alias", $lid);
                $this->gdlog()->LogInfo("registerSiteAlias() - UID - ".$row["uid"]);
                $_SESSION["GUYVERDESIGNS_SITE_ALIAS_UID"] = $row["uid"];
                $this->gdlog()->LogInfo("registerSiteAlias() - fullyqualifieddomain - ".$row["sdesc"]);
                $_SESSION["GUYVERDESIGNS_SITE_ALIAS"] = $row["sdesc"];
                
                $this->gdlog()->LogInfo("registerSiteAlias():true");
                $fr = "SITE_ALIAS_REGISTERED";
            }
            else
            {
                $this->gdlog()->LogInfo("registerSiteAlias():false");
                $fr = "SITE_ALIAS_NOT_REGISTERED";
            }
        }
        else
        {
            $this->gdlog()->LogError("registerSiteAlias():TRANSACTION_FAIL");
            $fr = "TRANSACTION_FAIL";
        }
        $this->gdlog()->LogInfo("****************: END :registerSiteAlias()");
        return $fr;
    }
    
    function matchSiteandSiteAlias()
    {
        $this->gdlog()->LogInfo("****************: START :matchSiteandSiteAlias()");
        $fr;
        $sqlstmnt = "INSERT INTO match_usersafety_site_to_site_alias SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "usersafety_site_uid=:usersafety_site_uid, ".
            "usersafety_site_alias_uid=:usersafety_site_alias_uid";

        $appcon = new ZAppDatabase();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":usersafety_site_uid", $_SESSION["GUYVERDESIGNS_SITE_UID"]);
        $appcon->bindParam(":usersafety_site_alias_uid", $_SESSION["GUYVERDESIGNS_SITE_ALIAS_UID"]);
        $appcon->execUpdate();
        
        if($appcon->getTransactionGood())
        {
            if($appcon->getRowCount() > 0)
            {
                $lid = $appcon->getLastInsertID();
                $appcon->saveActivityLog("REGISTER_SITE_ALIAS_MATCH","Site to Site Alias match.".
                    ":Last Id:".$lid.":".
                    "GUYVERDESIGNS_SITE_UID:".$_SESSION["GUYVERDESIGNS_SITE_UID"].":".
                    "GUYVERDESIGNS_SITE:".$_SESSION["GUYVERDESIGNS_SITE"]."-".
                    "GUYVERDESIGNS_SITE_ALIAS_UID:".$_SESSION["GUYVERDESIGNS_SITE_ALIAS_UID"].":".
                    "GUYVERDESIGNS_SITE_ALIAS:".$_SESSION["GUYVERDESIGNS_SITE_ALIAS"].":");
                
                $this->gdlog()->LogInfo("matchSiteandSiteAlias():true".
                    ":Last Id:".$lid.":".
                    "GUYVERDESIGNS_SITE_UID:".$_SESSION["GUYVERDESIGNS_SITE_UID"].":".
                    "GUYVERDESIGNS_SITE:".$_SESSION["GUYVERDESIGNS_SITE"]."-".
                    "GUYVERDESIGNS_SITE_ALIAS_UID:".$_SESSION["GUYVERDESIGNS_SITE_ALIAS_UID"].":".
                    "GUYVERDESIGNS_SITE_ALIAS:".$_SESSION["GUYVERDESIGNS_SITE_ALIAS"].":");
                $fr = "SITE_AND_ALIAS_MATCHED";
            }
            else
            {
                $this->gdlog()->LogInfo("matchSiteandSiteAlias():false");
                $fr = "SITE_AND_ALIAS_NOT_MATCHED";
            }
        }
        else
        {
            $this->gdlog()->LogError("matchSiteandSiteAlias():TRANSACTION_FAIL");
            $fr = "TRANSACTION_FAIL";
        }
        $this->gdlog()->LogInfo("****************: END :matchSiteandSiteAlias()");
        return $fr;
    }
}
?>