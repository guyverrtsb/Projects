<?php zReqOnce("/gd.trxn.com/_controls/classes/dataobjects/base/siteandalias.php"); ?>
<?php
class CreateSiteandAlias
    extends SiteandAliasBase
{ 
    private $site;
    private $alias;
    
    function __construct()
    {
        $this->site = $_SESSION[AppSysIntegration::getKeySessSite()];
        $this->sitealias = $_SESSION[AppSysIntegration::getKeySessSiteAlias()];
        zLog()->LogDebug("CreateSiteandAlias[".$this->site."-".$this->sitealias."]");
    }

    function registerSite()
    {
        zLog()->LogStart_DataObjectFunction("registerSite");
        
        $sqlstmnt = "INSERT INTO site SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "sdesc=:package";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("crossapplication");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":package", strtolower($this->site));
        $appcon->execUpdate();
        
        $this->resultCreateRecord($appcon, "site");

        zLog()->LogEnd_DataObjectFunction("registerSite");
    }
    
    function registerSiteAlias()
    {
        zLog()->LogStart_DataObjectFunction("registerSiteAlias");
        
        $sqlstmnt = "INSERT INTO sitealias SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "sdesc=:fullyqualifieddomain";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("crossapplication");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":fullyqualifieddomain", strtolower($this->sitealias));
        $appcon->execUpdate();
        
         $this->resultCreateRecord($appcon, "sitealias");

        zLog()->LogEnd_DataObjectFunction("registerSiteAlias");
    }
    
    function matchSite($site_uid, $sitealias_uid)
    {
        zLog()->LogStart_DataObjectFunction("matchSiteandSiteAlias");
        
        $sqlstmnt = "INSERT INTO match_site SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "site_uid=:site_uid, ".
            "sitealias_uid=:sitealias_uid";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("crossapplication");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":site_uid", $site_uid);
        $appcon->bindParam(":sitealias_uid", $sitealias_uid);
        $appcon->execUpdate();

        $this->resultCreateRecord($appcon, "match_site");
        
        zLog()->LogEnd_DataObjectFunction("matchSiteandSiteAlias");
    }
}
?>