<?php zReqOnce("/_controls/classes/dataobjects/base/group.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class CreateGroupProfile
    extends GroupBase
{
    function __construct()
    {
    }
    
    function full($validtodate,
                $description,
                $mantra,
                $objectives)
    {
        zLog()->LogStart_DataObjectFunction("full");
        
        $sqlstmnt = "INSERT INTO groupprofile SET 
            uid=UUID(), createddt=NOW(), changeddt=NOW(),
            validtodate=:validtodate,
            description=:description,
            mantra=:mantra,
            objectives=:objectives";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":validtodate", $validtodate);
        $appcon->bindParam(":description", $description);
        $appcon->bindParam(":mantra", $mantra);
        $appcon->bindParam(":objectives", $objectives);
        $appcon->execUpdate();
        
        $this->resultCreateRecord($appcon, "groupprofile");
        
        zLog()->LogEnd_DataObjectFunction("full");
    }
}
?>