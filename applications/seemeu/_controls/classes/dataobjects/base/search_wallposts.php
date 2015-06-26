<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class SearchWallPostsBase
    extends AppSysBaseObject
{
    function __construct()
    {
    }
    
    function getUid() { return $this->getResult_RecordField("uid"); }
    
    function getGroupaccountUid() { return $this->getResult_RecordField("groupaccount_uid"); }
    function getRecordUid() { return $this->getResult_RecordField("record_uid"); }
    function getCfgSdescObjecttype() { return $this->getResult_RecordField("configurations_sdesc_objecttype"); }
    function getText() { return $this->getResult_RecordField("text"); }
}
?>