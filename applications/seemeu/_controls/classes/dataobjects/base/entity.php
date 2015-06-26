<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class EntityBase
    extends AppSysBaseObject
{
    function __construct()
    {
    }
    
    function getUid() { return $this->getResult_RecordField("uid"); }
    
    function getWebaddress() { return $this->getResult_RecordField("webaddress"); }
    function getEmaildomain() { return $this->getResult_RecordField("emaildomain"); }
    function getIsactive() { return $this->getResult_RecordField("isactive"); }
    function getIslive() { return $this->getResult_RecordField("islive"); }
}
?>