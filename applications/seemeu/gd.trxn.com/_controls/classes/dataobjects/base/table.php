<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class TableBase
    extends AppSysBaseObject
{
    function __construct()
    {
    }
    
    function getLid() { return $this->getResult_RecordField("lid"); }
    function getUid() { return $this->getResult_RecordField("uid"); }
    function getCreateddt() { return $this->getResult_RecordField("createddt"); }
    function getChangeddt() { return $this->getResult_RecordField("changeddt"); }
}
?>