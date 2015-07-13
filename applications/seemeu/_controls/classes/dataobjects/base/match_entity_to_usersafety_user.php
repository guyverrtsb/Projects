<?php zReqOnce("/gd.trxn.com/_controls/classes/dataobjects/base/table.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class MatchEntitytoUsersafetyUserBase
    extends TableBase
{
    function __construct()
    {
    }
    
    function getMatchEntityUid() { return $this->getResult_RecordField("match_entity_uid"); }
    function getUsersafetyUserUid() { return $this->getResult_RecordField("match_usersafety_user_uid"); }
    function getCfgsdescUsertype() { return $this->getResult_RecordField("configurations_sdesc_usertype"); }
    function getCfgSdescEntityrole() { return $this->getResult_RecordField("configurations_sdesc_entityrole"); }
}
?>