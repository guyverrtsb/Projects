<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class BattleBase
    extends AppSysBaseObject
{
    function __construct()
    {
    }
    
    function getUid() { return $this->getResult_RecordField("uid"); }
    
    function getConnectionkey() { return $this->getResult_RecordField("connectionkey"); }
    function getTablekey() { return $this->getResult_RecordField("tablekey"); }
    function getGroupaccountUid() { return $this->getResult_RecordField("groupaccount_uid"); }

}
?>