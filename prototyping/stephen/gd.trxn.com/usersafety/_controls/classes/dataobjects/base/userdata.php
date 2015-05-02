<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class UserDataBase
    extends AppSysBaseObject
{
    function __construct()
    {
    }
    
    function getUAUid() { return $this->getResult_RecordField($this->dbf("useraccount.uid")); }
    function getUPUid() { return $this->getResult_RecordField($this->dbf("userprofile.uid")); }
    
    function getEmail() { return $this->getResult_RecordField($this->dbf("useraccount_email")); }
    function getPassword() { return $this->getResult_RecordField($this->dbf("useraccount_password")); }
    function getNickname() { return $this->getResult_RecordField($this->dbf("useraccount_nickname")); }
    function getUsertablekey() { return $this->getResult_RecordField($this->dbf("useraccount_usertablekey")); }
    function getIsactive() { return $this->getResult_RecordField($this->dbf("useraccount_isactive")); }
    function getChangepassword() { return $this->getResult_RecordField($this->dbf("useraccount_changepassword")); }
    function getNumberoflogintries() { return $this->getResult_RecordField($this->dbf("useraccount_numberoflogintries")); }
    
    function getFirstname() { return $this->getResult_RecordField($this->dbf("userprofile_firstname")); }
    function getLastname() { return $this->getResult_RecordField($this->dbf("userprofile_lastname")); }
    function getCfgSdescCountry() { return $this->getResult_RecordField($this->dbf("userprofile_crossappl_configurations_sdesc_region")); }
    function getCfgSdescRegion() { return $this->getResult_RecordField($this->dbf("userprofile_crossappl_configurations_sdesc_country")); }
    function getCity() { return $this->getResult_RecordField($this->dbf("userprofile_city")); }
    
}
?>