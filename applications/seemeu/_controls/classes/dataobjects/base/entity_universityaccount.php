<?php zReqOnce("/gd.trxn.com/_controls/classes/dataobjects/base/table.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class EntityUniversityaccountBase
    extends TableBase
{
    function __construct()
    {
    }
    
    function getWebaddress() { return $this->getResult_RecordField("webaddress"); }
    function getEmaildomain() { return $this->getResult_RecordField("emaildomain"); }
    function getIsactive() { return $this->getResult_RecordField("isactive"); }
    function getIslive() { return $this->getResult_RecordField("islive"); }
    function getEntityaccountUid() { return $this->getResult_RecordField("entityaccount_uid"); }
}
?>