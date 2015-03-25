<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class DraftedMatchBase
    extends AppSysBaseObject
{
    function __construct()
    {
    }
    
    function getUid() { return $this->getResult_RecordField("uid"); }
    
    function getGameraccountUid() { return $this->getResult_RecordField("gameraccount_uid"); }
    function getGroupaccountUid() { return $this->getResult_RecordField("groupaccount_uid"); }
    function getCfgSdescGrouprole() { return $this->getResult_RecordField("configurations_sdesc_grouprole"); }
    
    function getUserraccountUid() { return $this->getResult_RecordField("useraccount_uid"); }
    function getGamerprofileUid() { return $this->getResult_RecordField("gamerprofile_uid"); }
    
    function getMerchantaccountUid() { return $this->getResult_RecordField("merchantaccount_uid"); }
    
    function getMerchantprofileUid() { return $this->getResult_RecordField("merchantprofile_uid"); }
    
    
    function getObjectUid() { return $this->getResult_RecordField("object_uid"); }
    
    function getGroupprofileUid() { return $this->getResult_RecordField("groupprofile_uid"); }
    
    function getCfgSdescMerchantrole() { return $this->getResult_RecordField("configurations_sdesc_merchantrole"); }
    
}
?>