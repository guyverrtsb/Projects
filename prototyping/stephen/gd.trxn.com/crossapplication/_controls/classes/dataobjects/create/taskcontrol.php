<?php zReqOnce("/gd.trxn.com/crossapplication/_controls/classes/dataobjects/base/taskcontrol.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class CreateTaskControl
    extends TaskControlBase
{
    function __construct()
    {
    }
    
    function basic($appl_configurations_sdesc_taskkey,
                $pathtoclass,
                $json)
    {
        zLog()->LogInfoStartDATAOBJECTFUNCTION("basic");
        $mr = "NA"; //Method Return;
        
        $sqlstmnt = "INSERT INTO taskcontrollink SET 
            uid=UUID(), createddt=NOW(), changeddt=NOW(),
            appl_configurations_sdesc_taskkey=:appl_configurations_sdesc_taskkey,
            uid1=UUID(),
            uid2=UUID(),
            uid3=UUID(),
            pathtoclass=:pathtoclass,
            isactive=:isactive,
            json=:json";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("CROSSAPPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":appl_configurations_sdesc_taskkey", $appl_configurations_sdesc_taskkey);
        $appcon->bindParam(":pathtoclass", $pathtoclass);
        $appcon->bindParam(":isactive", "T");
        $appcon->bindParam(":json", $json);
        $appcon->execUpdate();
        
        $this->resultCreateRecord($appcon, "taskcontrollink");
        
        zLog()->LogInfoEndDATAOBJECTFUNCTION("basic");
    }
}
?>