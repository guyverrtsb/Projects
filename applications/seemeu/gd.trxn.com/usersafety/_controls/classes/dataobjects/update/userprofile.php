<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/base/userprofile.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class UpdateUserProfile
    extends UserprofileBase
{
    function __construct()
    {
    }
    
    function updateAllbyUid($uid,
                            $firstname,
                            $lastname,
                            $city,
                            $crossappl_configurations_sdesc_region,
                            $crossappl_configurations_sdesc_country)
    {
        zLog()->LogStart_DataObjectFunction("updateAllbyUid");
        
        $sqlstmnt = "UPDATE userprofile SET 
            changeddt=NOW(), 
            firstname=:firstname, 
            lastname=:lastname, 
            city=:city 
            crossappl_configurations_sdesc_region=:crossappl_configurations_sdesc_region, 
            crossappl_configurations_sdesc_country=:crossappl_configurations_sdesc_country 
            WHERE uid=:uid";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":uid", $uid);
        $appcon->bindParam(":firstname", $firstname);
        $appcon->bindParam(":lastname", $lastname);
        $appcon->bindParam(":city", $city);
        $appcon->bindParam(":crossappl_configurations_sdesc_region", $crossappl_configurations_sdesc_region);
        $appcon->bindParam(":crossappl_configurations_sdesc_country", $crossappl_configurations_sdesc_country);
        $appcon->execUpdate();

        $this->resultUpdateRecord($appcon, "userprofile");
        
        zLog()->LogEnd_DataObjectFunction("updateAllbyUid");
    }
}
?>