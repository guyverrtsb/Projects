<?php zReqOnce("/_controls/classes/dataobjects/base/gamer.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class CreateGamerProfile
    extends GamerBase
{
    function __construct()
    {
    }
    
    function basic()
    {
        zLog()->LogStartDATAOBJECTFUNCTION("basic");
        $this->full("");
        zLog()->LogEndDATAOBJECTFUNCTION("basic");
    }
    
    function full($avatarmimeuid)
    {
        zLog()->LogStartDATAOBJECTFUNCTION("full");
        
        $sqlstmnt = "INSERT INTO gamerprofile SET 
            uid=UUID(), createddt=NOW(), changeddt=NOW(),
            avatarmimeuid=:avatarmimeuid";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":avatarmimeuid", $avatarmimeuid);
        $appcon->execUpdate();
        
        $this->resultCreateRecord($appcon, "gamerprofile");
        
        zLog()->LogEndDATAOBJECTFUNCTION("full");
    }
}
?>