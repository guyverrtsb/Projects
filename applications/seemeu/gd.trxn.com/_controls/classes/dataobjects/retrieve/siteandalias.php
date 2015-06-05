<?php zReqOnce("/gd.trxn.com/_controls/classes/dataobjects/base/siteandalias.php"); ?>
<?php
class RetrieveSiteandAlias
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
    
    function isSiteandAliasValid()
    {
        zLog()->LogStartDATAOBJECTFUNCTION("isSiteandAliasValid");
        
        $sqlstmnt = "SELECT ".$this->dbfas("site.uid, site.sdesc, sitealias.uid, sitealias.sdesc")." ".
            "FROM sitealias ".
            "JOIN match_site_to_sitealias ".
            "ON match_site_to_sitealias.sitealias_uid = sitealias.uid ".
            "JOIN site ".
            "ON match_site_to_sitealias.site_uid = site.uid ".
            "WHERE sitealias.sdesc=:alias";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("crossapplication");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":alias", $this->sitealias);
        $appcon->execSelect();
        
        $this->resultRetrieveRecord($appcon);

        zLog()->LogEndDATAOBJECTFUNCTION("isSiteandAliasValid");
    }
    
    function doesSiteExist()
    {
        zLog()->LogStartDATAOBJECTFUNCTION("doesSiteExist");
        $sqlstmnt = "SELECT uid, sdesc FROM site ".
            "WHERE sdesc=:package";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("crossapplication");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":package", $this->site);
        $appcon->execSelect();
        
        $this->resultRetrieveRecord($appcon);

        zLog()->LogEndDATAOBJECTFUNCTION("doesSiteExist");
    }
}
?>