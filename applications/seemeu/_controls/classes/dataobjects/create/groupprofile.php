<?php zReqOnce("/_controls/classes/dataobjects/base/groupprofile.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class CreateGroupprofile
    extends GroupprofileBase
{
    function __construct()
    {
    }
    
    function basic($ldesc)
    {
        zLog()->LogStart_DataObjectFunction("basic");
        
        $sqlstmnt = "INSERT INTO groupprofile SET 
            uid=UUID(), createddt=NOW(), changeddt=NOW(),
            ldesc=:ldesc";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":ldesc", $ldesc);
        $appcon->execUpdate();
        
        $this->resultCreateRecord($appcon, "groupprofile");
        
        zLog()->LogEnd_DataObjectFunction("basic");
    }
}
?>