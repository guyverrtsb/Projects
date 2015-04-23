<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class UserMatchBase
    extends AppSysBaseObject
{
    function __construct()
    {
    }

    function getMatchUserAccountUid() { return $this->getResult_RecordField("useraccount_uid"); }
    function getMatchUserProfileUid() { return $this->getResult_RecordField("userprofile_uid"); }
}
?>