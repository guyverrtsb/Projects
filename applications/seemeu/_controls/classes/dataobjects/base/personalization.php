<?php zReqOnce("/gd.trxn.com/_controls/classes/dataobjects/base/table.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class PersonalizationBase
    extends TableBase
{
    function __construct()
    {
    }
    
    function getUniversityActiveMatchEntityUid() { return $this->getResult_RecordField("university_active_match_entity_uid"); }
    function getUsersafetyUserUid() { return $this->getResult_RecordField("match_usersafety_user_uid"); }
}
?>