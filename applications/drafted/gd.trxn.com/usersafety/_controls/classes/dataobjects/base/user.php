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
    
    function getUid() { return $this->getResult_RecordField("uid"); }
    
    function getEmail() { return $this->getResult_RecordField("email"); }
    function getPassword() { return $this->getResult_RecordField("password"); }
    function getNickname() { return $this->getResult_RecordField("nickname"); }
    function getUsertablekey() { return $this->getResult_RecordField("usertablekey"); }
    function getIsactive() { return $this->getResult_RecordField("isactive"); }
    function getChangepassword() { return $this->getResult_RecordField("changepassword"); }
    function getNumberoflogintries() { return $this->getResult_RecordField("numberoflogintries"); }
    
    function getFirstname() { return $this->getResult_RecordField("firstname"); }
    function getLastname() { return $this->getResult_RecordField("lastname"); }
    function getCfgSdescCountry() { return $this->getResult_RecordField("crossappl_configurations_sdesc_region"); }
    function getCfgSdescRegion() { return $this->getResult_RecordField("crossappl_configurations_sdesc_country"); }
    function getCity() { return $this->getResult_RecordField("city"); }
    
    function getMatchUserAccountUid() { return $this->getResult_RecordField("useraccount_uid"); }
    function getMatchUserProfileUid() { return $this->getResult_RecordField("userprofile_uid"); }
}
?>