<?php zReqOnce("/_controls/classes/dataobjects/base/gamerdata.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class RetrieveGamerData
    extends GamerDataBase
{
    function __construct()
    {
    }
    
    /**
     * By UserAccount Uid
     */
    function byUseraccountuid($match_useraccount_to_gameraccount_to_gamerprofile_useraccount_uid)
    {
        zLog()->LogInfoStartDATAOBJECTFUNCTION("byUseraccountuid");
        
        $sqlstmnt = "SELECT ".
            $this->dbfas("match_useraccount_to_gameraccount_to_gamerprofile.useraccount_uid,".
                        "gameraccount.uid,".
                        "gameraccount.configurations_sdesc_gamerrole,".
                        "gameraccount.gamertag,".
                        "gameraccount.isactive,".
                        "gamerprofile.uid,".
                        "gamerprofile.avatarmimeuid").
        "from match_useraccount_to_gameraccount_to_gamerprofile ".
        "join gameraccount ".
        "on match_useraccount_to_gameraccount_to_gamerprofile.gameraccount_uid = gameraccount.uid ".
        "join gamerprofile ".
        "on match_useraccount_to_gameraccount_to_gamerprofile.gamerprofile_uid = gamerprofile.uid ".
            
        "WHERE match_useraccount_to_gameraccount_to_gamerprofile.useraccount_uid=:match_useraccount_to_gameraccount_to_gamerprofile_useraccount_uid";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":match_useraccount_to_gameraccount_to_gamerprofile_useraccount_uid", $match_useraccount_to_gameraccount_to_gamerprofile_useraccount_uid);
        $appcon->execSelect();

        $this->resultRetrieveRecord($appcon);

        zLog()->LogInfoEndDATAOBJECTFUNCTION("byUseraccountuid");
    }
    
    /**
     * Gamer Tag
     */
    function byGamertag($gameraccount_gamertag)
    {
        zLog()->LogInfoStartDATAOBJECTFUNCTION("byGamertag");

        $sqlstmnt = "SELECT ".
            $this->dbfas("gameraccount.uid,".
                        "gameraccount.configurations_sdesc_gamerrole,".
                        "gameraccount.gamertag,".
                        "gameraccount.isactive,".
                        "gamerprofile.uid,".
                        "gamerprofile.avatarmimeuid").
        "from gameraccount ".
        "join match_useraccount_to_gameraccount_to_gamerprofile ".
        "on gameraccount.uid = match_useraccount_to_gameraccount_to_gamerprofile.gameraccount_uid ".
        "join gamerprofile ".
        "on match_useraccount_to_gameraccount_to_gamerprofile.gamerprofile_uid = gamerprofile.uid ".
            
        "WHERE gameraccount.gamertag=:gameraccount_gamertag";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":gameraccount_gamertag", $gameraccount_gamertag);
        $appcon->execSelect();

        $this->resultRetrieveRecord($appcon);

        zLog()->LogInfoEndDATAOBJECTFUNCTION("byGamertag");
    }
    
    /**
     * Gamer Tag
     */
    function byGameraccountuid($gameraccount_uid)
    {
        zLog()->LogInfoStartDATAOBJECTFUNCTION("byGameraccountuid");
        
        $sqlstmnt = "SELECT ".
            $this->dbfas("match_useraccount_to_gameraccount_to_gamerprofile.gameraccount_uid,".
                        "gameraccount.uid,".
                        "gameraccount.configurations_sdesc_gamerrole,".
                        "gameraccount.gamertag,".
                        "gameraccount.isactive,".
                        "gamerprofile.uid,".
                        "gamerprofile.avatarmimeuid").
        "from match_useraccount_to_gameraccount_to_gamerprofile ".
        "join gameraccount ".
        "on match_useraccount_to_gameraccount_to_gamerprofile.gameraccount_uid = gameraccount.uid ".
        "join gamerprofile ".
        "on match_useraccount_to_gameraccount_to_gamerprofile.gamerprofile_uid = gamerprofile.uid ".
            
        "WHERE match_useraccount_to_gameraccount_to_gamerprofile.gameraccount_uid=:match_useraccount_to_gameraccount_to_gamerprofile_gameraccount_uid";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":match_useraccount_to_gameraccount_to_gamerprofile_gameraccount_uid", $match_useraccount_to_gameraccount_to_gamerprofile_gameraccount_uid);
        $appcon->execSelect();

        $this->resultRetrieveRecord($appcon);

        zLog()->LogInfoEndDATAOBJECTFUNCTION("byGameraccountuid");
    }
}
?>