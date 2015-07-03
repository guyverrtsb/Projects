<?php zReqOnce("/gd.trxn.com/_controls/classes/dataobjects/base/table.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class SearchWallPostsBase
    extends TableBase
{
    function __construct()
    {
    }
    
    function getGroupaccountUid() { return $this->getResult_RecordField("groupaccount_uid"); }
    function getRecordUid() { return $this->getResult_RecordField("record_uid"); }
    function getCfgSdescObjecttype() { return $this->getResult_RecordField("configurations_sdesc_objecttype"); }
    function getText() { return $this->getResult_RecordField("text"); }
}
?>