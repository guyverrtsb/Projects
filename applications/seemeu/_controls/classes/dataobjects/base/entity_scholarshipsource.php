<?php zReqOnce("/gd.trxn.com/_controls/classes/dataobjects/base/table.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class EntityScholarshipsourceBase
    extends TableBase
{
    function __construct()
    {
    }
    
    function getUrl() { return $this->getResult_RecordField("url"); }
    function getIdx() { return $this->getResult_RecordField("idx"); }
    function getProfile() { return $this->getResult_RecordField("profile"); }
    function getScreendata() { return $this->getResult_RecordField("screendata"); }
}
?>