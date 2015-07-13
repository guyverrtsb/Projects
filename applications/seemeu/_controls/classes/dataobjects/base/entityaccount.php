<?php zReqOnce("/gd.trxn.com/_controls/classes/dataobjects/base/table.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class EntityaccountBase
    extends TableBase
{
    function __construct()
    {
    }
    
    function getSdesc() { return $this->getResult_RecordField("sdesc"); }
    function getLdesc() { return $this->getResult_RecordField("ldesc"); }
    function getCfgSdescEntitytype() { return $this->getResult_RecordField("configurations_sdesc_entitytype"); }
    function getCfgSdescEntityaccept() { return $this->getResult_RecordField("configurations_sdesc_entityaccept"); }
}
?>