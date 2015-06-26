<?php zReqOnce("/_controls/classes/dataobjects/base/search_wallposts.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class CreateSearchWallPost
    extends SearchWallPostsBase
{
    function __construct()
    {
    }
    
    function createHeader($groupaccount_uid,
                        $record_uid,
                        $text)
    {
        zLog()->LogStart_DataObjectFunction("createHeader");
        
        $sqlstmnt = "INSERT INTO search_wallposts SET 
            uid=UUID(), createddt=NOW(), changeddt=NOW(),
            groupaccount_uid=:groupaccount_uid,
            record_uid=:record_uid,
            configurations_sdesc_objecttype=:configurations_sdesc_objecttype,
            text=:text";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":groupaccount_uid", $groupaccount_uid);
        $appcon->bindParam(":record_uid", $record_uid);
        $appcon->bindParam(":configurations_sdesc_objecttype", "OBJECT_TYPE-WALL_POST_HEADER");
        $appcon->bindParam(":text", $text);
        $appcon->execUpdate();
        
        $this->resultCreateRecord($appcon, "search_wallposts");
        
        zLog()->LogEnd_DataObjectFunction("createHeader");
    }
    
    function createText($groupaccount_uid,
                        $record_uid,
                        $text)
    {
        zLog()->LogStart_DataObjectFunction("createText");
        
        $sqlstmnt = "INSERT INTO search_wallposts SET 
            uid=UUID(), createddt=NOW(), changeddt=NOW(),
            groupaccount_uid=:groupaccount_uid,
            record_uid=:record_uid,
            configurations_sdesc_objecttype=:configurations_sdesc_objecttype,
            text=:text";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":groupaccount_uid", $groupaccount_uid);
        $appcon->bindParam(":record_uid", $record_uid);
        $appcon->bindParam(":configurations_sdesc_objecttype", "OBJECT_TYPE-WALL_POST_TEXT");
        $appcon->bindParam(":text", $text);
        $appcon->execUpdate();
        
        $this->resultCreateRecord($appcon, "search_wallposts");
        
        zLog()->LogEnd_DataObjectFunction("createText");
    }
    
    function createComment($groupaccount_uid,
                        $record_uid,
                        $text)
    {
        zLog()->LogStart_DataObjectFunction("createComment");
        
        $sqlstmnt = "INSERT INTO search_wallposts SET 
            uid=UUID(), createddt=NOW(), changeddt=NOW(),
            groupaccount_uid=:groupaccount_uid,
            record_uid=:record_uid,
            configurations_sdesc_objecttype=:configurations_sdesc_objecttype,
            text=:text";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":groupaccount_uid", $groupaccount_uid);
        $appcon->bindParam(":record_uid", $record_uid);
        $appcon->bindParam(":configurations_sdesc_objecttype", "OBJECT_TYPE-WALL_POST_COMENT");
        $appcon->bindParam(":text", $text);
        $appcon->execUpdate();
        
        $this->resultCreateRecord($appcon, "search_wallposts");
        
        zLog()->LogEnd_DataObjectFunction("createComment");
    }
}
?>