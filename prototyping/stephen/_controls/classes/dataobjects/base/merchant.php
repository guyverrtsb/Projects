<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class MerchantBase
    extends AppSysBaseObject
{
    function __construct()
    {
    }
    
    function getUid() { return $this->getResult_RecordField("uid"); }
    
    function getSdesc() { return $this->getResult_RecordField("sdesc"); }
    function getCompanyname() { return $this->getResult_RecordField("companyname"); }

    function getOfficename() { return $this->getResult_RecordField("officename"); }
    function getEmail() { return $this->getResult_RecordField("email"); }
    function getAddress1() { return $this->getResult_RecordField("address1"); }
    function getAddress2() { return $this->getResult_RecordField("address2"); }
    function getAddress3() { return $this->getResult_RecordField("address3"); }
    function getCity() { return $this->getResult_RecordField("company"); }
    function getCfgSdescRegion() { return $this->getResult_RecordField("crossappl_configurations_sdesc_region"); }
    function getCfgSdescCountry() { return $this->getResult_RecordField("crossappl_configurations_sdesc_country"); }
    function getIntldialingcode() { return $this->getResult_RecordField("intldialingcode"); }
    function getAreacode() { return $this->getResult_RecordField("areacode"); }
    function getPrefix() { return $this->getResult_RecordField("prefix"); }
    function getNumber() { return $this->getResult_RecordField("number"); }

}
?>