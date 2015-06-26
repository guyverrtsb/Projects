<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class WallPostBase
    extends AppSysBaseObject
{
    function __construct()
    {
    }
    
    function getUid() { return $this->getResult_RecordField("uid"); }
    
    function getGroupaccountUid() { return $this->getResult_RecordField("groupaccount_uid"); }
    function getUsersafetyUseraccountUid() { return $this->getResult_RecordField("usersafety_useraccount_uid"); }
    function getHeader() { return $this->getResult_RecordField("header"); }
    function getText() { return $this->getResult_RecordField("text"); }
    function getCrossapplMimesUid() { return $this->getResult_RecordField("crossappl_mimes_uid"); }
    function getReferencedWallpostUid() { return $this->getResult_RecordField("referenced_wallpost_uid"); }
}
?>