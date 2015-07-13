<?php zReqOnce("/gd.trxn.com/_controls/classes/dataobjects/base/table.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class MatchUserBase
    extends TableBase
{
    function __construct()
    {
    }
    
    function getUseraccountUid() { return $this->getResult_RecordField("useraccount_uid"); }
    function getUserprofileUid() { return $this->getResult_RecordField("userprofile_uid"); }
}
?>