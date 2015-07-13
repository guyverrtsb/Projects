<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class UserBase
    extends AppSysBaseObject
{
    function __construct()
    {
    }
    
    function getMatchUserLid() { return $this->getResult_RecordField($this->dbf("match_user.lid")); }
    function getMatchUserUid() { return $this->getResult_RecordField($this->dbf("match_user.uid")); }
    function getMatchUserCreateddt() { return $this->getResult_RecordField($this->dbf("match_user.createddt")); }
    function getMatchUserChangeddt() { return $this->getResult_RecordField($this->dbf("match_user.changeddt")); }
    function getMatchUserUseraccountUid() { return $this->getResult_RecordField($this->dbf("match_user.useraccount_uid")); }
    function getMatchUserUserprofileUid() { return $this->getResult_RecordField($this->dbf("match_user.userprofile_uid")); }
    
    function getUseraccountLid() { return $this->getResult_RecordField($this->dbf("useraccount.lid")); }
    function getUseraccountUid() { return $this->getResult_RecordField($this->dbf("useraccount.uid")); }
    function getUseraccountCreateddt() { return $this->getResult_RecordField($this->dbf("useraccount.createddt")); }
    function getUseraccountChangeddt() { return $this->getResult_RecordField($this->dbf("useraccount.changeddt")); }
    function getUseraccountEmail() { return $this->getResult_RecordField($this->dbf("useraccount.email")); }
    function getUseraccountPassword() { return $this->getResult_RecordField($this->dbf("useraccount.password")); }
    function getUseraccountNickname() { return $this->getResult_RecordField($this->dbf("useraccount.nickname")); }
    function getUseraccountUsertablekey() { return $this->getResult_RecordField($this->dbf("useraccount.usertablekey")); }
    function getUseraccountIsactive() { return $this->getResult_RecordField($this->dbf("useraccount.isactive")); }
    function getUseraccountChangepassword() { return $this->getResult_RecordField($this->dbf("useraccount.changepassword")); }
    function getUseraccountNumberoflogintries() { return $this->getResult_RecordField($this->dbf("useraccount.numberoflogintries")); }
    
    function GetUserprofileLid() { return $this->getResult_RecordField($this->dbf("userprofile.lid")); }
    function GetUserprofileUid() { return $this->getResult_RecordField($this->dbf("userprofile.uid")); }
    function GetUserprofileCreateddt() { return $this->getResult_RecordField($this->dbf("userprofile.createddt")); }
    function GetUserprofileChangeddt() { return $this->getResult_RecordField($this->dbf("userprofile.changeddt")); }
    function GetUserprofileFirstname() { return $this->getResult_RecordField($this->dbf("userprofile.firstname")); }
    function GetUserprofileLastname() { return $this->getResult_RecordField($this->dbf("userprofile.lastname")); }
    function GetUserprofileCity() { return $this->getResult_RecordField($this->dbf("userprofile.city")); }
    function GetUserprofileCrossapplCfgSdescRegion() { return $this->getResult_RecordField($this->dbf("userprofile.crossappl_configurations_sdesc_region")); }
    function GetUserprofileCrossapplCfgSdescCountry() { return $this->getResult_RecordField($this->dbf("userprofile.crossappl_configurations_sdesc_country")); }
}
?>