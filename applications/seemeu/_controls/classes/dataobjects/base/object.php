<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class ObjectBase
    extends AppSysBaseObject
{
    function __construct()
    {
    }
    
    function getUid() { return $this->getResult_RecordField("uid"); }
    
    function getSdesc() { return $this->getResult_RecordField("sdesc"); }
    function getLdesc() { return $this->getResult_RecordField("ldesc"); }
    function getNickname() { return $this->getResult_RecordField("nickname"); }
    function getIcon() { return $this->getResult_RecordField("icon"); }
    function getDetectionrange() { return $this->getResult_RecordField("detectionrange"); }
    function getEffectiverange() { return $this->getResult_RecordField("effectiverange"); }
    function getCfgSdescObjecttype() { return $this->getResult_RecordField("configurations_sdesc_objecttype"); }
    function getCfgSdescPaymenttype() { return $this->getResult_RecordField("configurations_sdesc_paymenttype"); }
}
?>