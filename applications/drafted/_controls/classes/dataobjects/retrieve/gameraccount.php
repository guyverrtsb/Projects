<?php zReqOnce("/_controls/classes/dataobjects/base/gamer.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class RetrieveGamerAccount
    extends GamerBase
{
    function __construct()
    {
    }
    
    /**
     * Retrieve Record by Email
     */
    function byGamertag($gamertag)
    {
        zLog()->LogStart_DataObjectFunction("byGamertag");
        
        $sqlstmnt = "SELECT * FROM gameraccount ".
            "WHERE gamertag=:gamertag";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":gamertag", $gamertag);
        $appcon->execSelect();

        $this->resultRetrieveRecord($appcon);

        zLog()->LogEnd_DataObjectFunction("byGamertag");
    }
    
    /**
     * Retrieve Record by Nickname
     */
    function byUid($uid)
    {
        zLog()->LogStart_DataObjectFunction("byUid");
        
        $sqlstmnt = "SELECT * FROM gameraccount ".
            "WHERE uid=:uid";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":uid", $uid);
        $appcon->execSelect();

        $this->resultRetrieveRecord($appcon);

        zLog()->LogEnd_DataObjectFunction("byUid");
    }
}
?>