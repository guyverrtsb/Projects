<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class GroupBase
    extends AppSysBaseObject
{
    function __construct()
    {
    }
    
    function getUid() { return $this->getResult_RecordField("uid"); }
    
    function getSdesc() { return $this->getResult_RecordField("sdesc"); }
    function getCfgSdescGrouptype() { return $this->getResult_RecordField("configurations_sdesc_grouptype"); }
    function getCfgSdescGroupvisibility() { return $this->getResult_RecordField("configurations_sdesc_groupvisibility"); }
    function getCfgSdescGroupaccept() { return $this->getResult_RecordField("configurations_sdesc_groupaccept"); }
}
?>