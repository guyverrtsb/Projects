<?php zReqOnce("/gd.trxn.com/_controls/classes/dataobjects/base/table.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class MatchEntityBase
    extends TableBase
{
    function __construct()
    {
    }
    
    function getEntityaccountUid() { return $this->getResult_RecordField("entityaccount_uid"); }
    function getEntityprofileUid() { return $this->getResult_RecordField("entityprofile_uid"); }
}
?>