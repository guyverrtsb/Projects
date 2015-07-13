<?php zReqOnce("/gd.trxn.com/_controls/classes/dataobjects/base/table.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class MatchEntitytoUniversityBase
    extends TableBase
{
    function __construct()
    {
    }
    
    function getUniversityaccountUid() { return $this->getResult_RecordField("entity_universityaccount_uid"); }
    function getUniversityprofileUid() { return $this->getResult_RecordField("entity_universityprofile_uid"); }
    function getMatchEntityUid() { return $this->getResult_RecordField("match_entity_uid"); }
}
?>