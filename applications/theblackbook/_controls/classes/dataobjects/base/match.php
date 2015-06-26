<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class MatchBase
    extends AppSysBaseObject
{
    function __construct()
    {
    }
    
    function getUid() { return $this->getResult_RecordField("uid"); }
    
    function getUsersafetyUseraccountUid() { return $this->getResult_RecordField("usersafety_useraccount_uid"); }
    function getCfgSdescUsertype() { return $this->getResult_RecordField("configurations_sdesc_usertype"); }
}
?>