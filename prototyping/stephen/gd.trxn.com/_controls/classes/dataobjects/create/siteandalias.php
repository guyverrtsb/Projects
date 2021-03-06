<?php zReqOnce("/gd.trxn.com/_controls/classes/dataobjects/base/siteandalias.php"); ?>
<?php
class CreateSiteandAlias
    extends SiteandAliasBase
{ 
    private $site;
    private $alias;
    
    function __construct()
    {
        $this->site = $_SESSION[SysIntegration::getKeySessSite()];
        $this->sitealias = $_SESSION[SysIntegration::getKeySessSiteAlias()];
        zLog()->LogDebug($this->site."-".$this->sitealias);
    }

    function registerSite()
    {
        zLog()->LogInfoStartDATAOBJECTFUNCTION("registerSite");
        
        $sqlstmnt = "INSERT INTO site SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "sdesc=:package";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("crossapplication");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":package", $this->site);
        $appcon->execUpdate();
        
        $this->resultCreateRecord($appcon, "site");

        zLog()->LogInfoEndDATAOBJECTFUNCTION("registerSite");
    }
    
    function registerSiteAlias()
    {
        zLog()->LogInfoStartDATAOBJECTFUNCTION("registerSiteAlias");
        
        $sqlstmnt = "INSERT INTO sitealias SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "sdesc=:fullyqualifieddomain";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("crossapplication");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":fullyqualifieddomain", $this->sitealias);
        $appcon->execUpdate();
        
         $this->resultCreateRecord($appcon, "sitealias");

        zLog()->LogInfoEndDATAOBJECTFUNCTION("registerSiteAlias");
    }
    
    function matchSiteandSiteAlias($site_uid, $sitealias_uid)
    {
        zLog()->LogInfoStartDATAOBJECTFUNCTION("matchSiteandSiteAlias");
        
        $sqlstmnt = "INSERT INTO match_site_to_sitealias SET ".
            "uid=UUID(), createddt=NOW(), changeddt=NOW(), ".
            "site_uid=:site_uid, ".
            "sitealias_uid=:sitealias_uid";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("crossapplication");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":site_uid", $site_uid);
        $appcon->bindParam(":sitealias_uid", $sitealias_uid);
        $appcon->execUpdate();

        $this->resultCreateRecord($appcon, "match_site_to_sitealias");
        
        zLog()->LogInfoEndDATAOBJECTFUNCTION("matchSiteandSiteAlias");
    }
}
?>