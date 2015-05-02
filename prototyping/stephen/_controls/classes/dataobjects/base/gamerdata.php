<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class GamerDataBase
    extends AppSysBaseObject
{
    function __construct()
    {
    }
    
    function getUserAccountUid() { return $this->getResult_RecordField($this->dbf("match_useraccount_to_gameraccount_to_gamerprofile.useraccount_uid")); }
    
    function getGamerAccountUid() { return $this->getResult_RecordField($this->dbf("gameraccount.uid")); }
    function getGamerAccountCfgSdescGamerRole() { return $this->getResult_RecordField($this->dbf("gameraccount.configurations_sdesc_gamerrole")); }
    function getGamerAccountGamertag() { return $this->getResult_RecordField($this->dbf("gameraccount.gamertag")); }
    function getGamerAccountIsactive() { return $this->getResult_RecordField($this->dbf("gameraccount.isactive")); }
    
    function getGamerProfileUid() { return $this->getResult_RecordField($this->dbf("gamerprofile.uid")); }
    function getGamerProfileAvatarmimeuid() { return $this->getResult_RecordField($this->dbf("gamerprofile.avatarmimeuid")); }

}
?>