<?php zReqOnce("/gd.trxn.com/_controls/classes/dataobjects/base/siteandalias.php"); ?>
<?php
class RetrieveSiteandAlias
    extends SiteandAliasBase
{ 
    private $site;
    private $alias;
    
    function __construct()
    {
        $this->site = $_SESSION[AppSysIntegration::getKeySessSite()];
        $this->sitealias = $_SESSION[AppSysIntegration::getKeySessSiteAlias()];
        zLog()->LogDebug("RetrieveSiteandAlias[".$this->site."-".$this->sitealias."]");
    }
    
    function isSiteandAliasValid()
    {
        zLog()->LogStart_DataObjectFunction("isSiteandAliasValid");
        
        $sqlstmnt = "SELECT ".$this->dbfas("site.uid, site.sdesc, sitealias.uid, sitealias.sdesc")." ".
            "FROM sitealias ".
            "JOIN match_site ".
            "ON match_site.sitealias_uid = sitealias.uid ".
            "JOIN site ".
            "ON match_site.site_uid = site.uid ".
            "WHERE sitealias.sdesc=:alias";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("crossapplication");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":alias", strtolower($this->sitealias));
        $appcon->execSelect();
        
        $this->resultRetrieveRecord($appcon);

        zLog()->LogEnd_DataObjectFunction("isSiteandAliasValid");
    }
    
    function doesSiteExist()
    {
        zLog()->LogStart_DataObjectFunction("doesSiteExist");
        $sqlstmnt = "SELECT uid, sdesc FROM site ".
            "WHERE sdesc=:package";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("crossapplication");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":package", strtolower($this->site));
        $appcon->execSelect();
        
        $this->resultRetrieveRecord($appcon);

        zLog()->LogEnd_DataObjectFunction("doesSiteExist");
    }
}
?>