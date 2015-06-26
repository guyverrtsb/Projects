<?php zReqOnce("/_controls/classes/dataobjects/base/wallpost.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class CreateWallPost
    extends WallPostBase
{
    function __construct()
    {
    }
    
    function firstPost($groupaccount_uid,
                    $usersafety_useraccount_uid,
                    $header,
                    $text,
                    $crossappl_mimes_uid)
    {
        zLog()->LogStart_DataObjectFunction("firstPost");
        
        $sqlstmnt = "INSERT INTO wallpost SET 
            uid=UUID(), createddt=NOW(), changeddt=NOW(),
            groupaccount_uid=:groupaccount_uid,
            usersafety_useraccount_uid=:usersafety_useraccount_uid,
            header=:header,
            text=:text,
            crossappl_mimes_uid=:crossappl_mimes_uid";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":groupaccount_uid", $groupaccount_uid);
        $appcon->bindParam(":usersafety_useraccount_uid", $usersafety_useraccount_uid);
        $appcon->bindParam(":header", $header);
        $appcon->bindParam(":text", $text);
        $appcon->bindParam(":crossappl_mimes_uid", $crossappl_mimes_uid);
        $appcon->execUpdate();
        
        $this->resultCreateRecord($appcon, "wallpost");
        
        zLog()->LogEnd_DataObjectFunction("firstPost");
    }
    
    function replyPost($groupaccount_uid,
                    $usersafety_useraccount_uid,
                    $text,
                    $referenced_wallpost_uid)
    {
        zLog()->LogStart_DataObjectFunction("replyPost");
        
        $sqlstmnt = "INSERT INTO wallpost SET 
            uid=UUID(), createddt=NOW(), changeddt=NOW(),
            groupaccount_uid=:groupaccount_uid,
            usersafety_useraccount_uid=:usersafety_useraccount_uid,
            text=:text,
            referenced_wallpost_uid=:referenced_wallpost_uid";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":groupaccount_uid", $groupaccount_uid);
        $appcon->bindParam(":usersafety_useraccount_uid", $usersafety_useraccount_uid);
        $appcon->bindParam(":text", $text);
        $appcon->bindParam(":referenced_wallpost_uid", $referenced_wallpost_uid);
        $appcon->execUpdate();
        
        $this->resultCreateRecord($appcon, "wallpost");
        
        zLog()->LogEnd_DataObjectFunction("replyPost");
    }
}
?>