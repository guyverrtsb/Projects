<?php zReqOnce("/gd.trxn.com/_controls/classes/dataobjects/base/table.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class OpenauthBase
    extends TableBase
{
    function __construct()
    {
    }
    
    function getOpenauthkey() { return $this->getResult_RecordField("openauthkey"); }
    function getExpiredt() { return $this->getResult_RecordField("expiredt"); }
    function getIsvalid() { return $this->getResult_RecordField("isvalid"); }
    function getCfgSdescOpenauthprovider() { return $this->getResult_RecordField("configurations_sdesc_openauthprovider"); }
}
?>