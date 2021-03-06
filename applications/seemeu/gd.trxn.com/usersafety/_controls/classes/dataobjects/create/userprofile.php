<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/base/userprofile.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class CreateUserprofile
    extends UserprofileBase
{
    function __construct()
    {
    }
    
    function basic($firstname,
                $lastname,
                $city,
                $crossappl_configurations_sdesc_region,
                $crossappl_configurations_sdesc_country)
    {
        zLog()->LogStart_DataObjectFunction("basic");
        
        $sqlstmnt = "INSERT INTO userprofile SET 
            uid=UUID(), createddt=NOW(), changeddt=NOW(),
            firstname=:firstname,
            lastname=:lastname,
            city=:city,
            crossappl_configurations_sdesc_region=:crossappl_configurations_sdesc_region,
            crossappl_configurations_sdesc_country=:crossappl_configurations_sdesc_country";

        $appcon = new SysConnections();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":firstname", $firstname);
        $appcon->bindParam(":lastname", $lastname);
        $appcon->bindParam(":city", $city);
        $appcon->bindParam(":crossappl_configurations_sdesc_region", $crossappl_configurations_sdesc_region);
        $appcon->bindParam(":crossappl_configurations_sdesc_country", $crossappl_configurations_sdesc_country);
        $appcon->execUpdate();
        
        $this->resultCreateRecord($appcon, "userprofile");
        
        zLog()->LogEnd_DataObjectFunction("basic");
    }
}
?>