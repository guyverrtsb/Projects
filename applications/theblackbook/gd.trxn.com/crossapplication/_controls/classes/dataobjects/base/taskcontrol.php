<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class TaskControlBase
    extends AppSysBaseObject
{
    function __construct()
    {
    }
    
    function getUid() { return $this->getResult_RecordField("uid"); }
    
    function getApplConfigSdescTaskkey() { return $this->getResult_RecordField("appl_configurations_sdesc_taskkey"); }
    function getUid1() { return $this->getResult_RecordField("uid1"); }
    function getUid2() { return $this->getResult_RecordField("uid2"); }
    function getUid3() { return $this->getResult_RecordField("uid3"); }
    function getPathtoclass() { return $this->getResult_RecordField("pathtoclass"); }
    function getIsactive() { return $this->getResult_RecordField("isactive"); }
    function getjson() { return $this->getResult_RecordField("json"); }
}
?>