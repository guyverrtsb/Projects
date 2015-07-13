<?php zReqOnce("/gd.trxn.com/_controls/classes/dataobjects/base/table.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class UseraccountBase
    extends TableBase
{
    function __construct()
    {
    }
    
    function getEmail() { return $this->getResult_RecordField("email"); }
    function getPassword() { return $this->getResult_RecordField("password"); }
    function getNickname() { return $this->getResult_RecordField("nickname"); }
    function getUsertablekey() { return $this->getResult_RecordField("usertablekey"); }
    function getIsactive() { return $this->getResult_RecordField("isactive"); }
    function getChangepassword() { return $this->getResult_RecordField("changepassword"); }
    function getNumberoflogintries() { return $this->getResult_RecordField("numberoflogintries"); }
}
?>