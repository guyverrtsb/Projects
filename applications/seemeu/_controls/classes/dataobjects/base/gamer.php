<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class GamerBase
    extends AppSysBaseObject
{
    function __construct()
    {
    }
    
    function getUid() { return $this->getResult_RecordField("uid"); }
    
    function getGamertag() { return $this->getResult_RecordField("gamertag"); }
    function getIsactive() { return $this->getResult_RecordField("isactive"); }
    function getCfgSdescGamerRole() { return $this->getResult_RecordField("configurations_sdesc_gamerrole"); }
    
    function getAvatarmimeuid() { return $this->getResult_RecordField("avatarmimeuid"); }
    
}
?>