<?php zReqOnce("/_controls/classes/dataobjects/base/gamer.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class CreateGamerAccount
    extends GamerBase
{
    function __construct()
    {
    }
    
    function full($gamertag,
                $configurations_sdesc_gamerrole)
    {
        zLog()->LogInfoStartDATAOBJECTFUNCTION("full");
        
        $sqlstmnt = "INSERT INTO gameraccount SET 
            uid=UUID(), createddt=NOW(), changeddt=NOW(),
            gamertag=:gamertag,
            isactive=:isactive,
            configurations_sdesc_gamerrole=:configurations_sdesc_gamerrole";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":gamertag", $gamertag);
        $appcon->bindParam(":isactive", "F");
        $appcon->bindParam(":configurations_sdesc_gamerrole", $configurations_sdesc_gamerrole);
        $appcon->execUpdate();
        
        $this->resultCreateRecord($appcon, "gameraccount");
        
        zLog()->LogInfoEndDATAOBJECTFUNCTION("full");
    }
}
?>