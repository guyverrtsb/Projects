<?php zReqOnce("/gd.trxn.com/_controls/classes/dataobjects/base/table.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class UserprofileBase
    extends TableBase
{
    function __construct()
    {
    }
    
    function getFirstname() { return $this->getResult_RecordField("firstname"); }
    function getLastname() { return $this->getResult_RecordField("lastname"); }
    function getCity() { return $this->getResult_RecordField("city"); }
    function getCrossapplCfgSdescRegion() { return $this->getResult_RecordField("crossappl_configurations_sdesc_region"); }
    function getCrossapplCfgSdescCountry() { return $this->getResult_RecordField("crossappl_configurations_sdesc_country"); }
}
?>