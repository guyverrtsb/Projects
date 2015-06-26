<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class UniversityMatchBase
    extends AppSysBaseObject
{
    function __construct()
    {
    }
    
    function getUid() { return $this->getResult_RecordField("uid"); }
    
    function getUniversityaccountUid() { return $this->getResult_RecordField("universityaccount_uid"); }
    function getGroupaccountUid() { return $this->getResult_RecordField("groupaccount_uid"); }
}
?>