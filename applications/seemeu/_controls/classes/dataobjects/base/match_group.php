<?php zReqOnce("/gd.trxn.com/_controls/classes/dataobjects/base/table.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class MatchGroupBase
    extends TableBase
{
    function __construct()
    {
    }
    
    function getGroupaccountUid() { return $this->getResult_RecordField("groupaccount_uid"); }
    function getGroupprofileUid() { return $this->getResult_RecordField("groupprofile_uid"); }
    function getMatchEntityUid() { return $this->getResult_RecordField("match_entity_uid"); }
    function getMatchUsersafetyUserUid() { return $this->getResult_RecordField("match_usersafety_user_uid"); }
    function getCfgSdescGrouprole() { return $this->getResult_RecordField("configurations_sdesc_grouprole"); }
}
?>