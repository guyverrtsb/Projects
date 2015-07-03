<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/base/userprofile.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class RetrieveUserProfile
    extends UserprofileBase
{
    function __construct()
    {
    }
    
    function byUid($userprofile_uid)
    {
        zLog()->LogStart_DataObjectFunction("byUid");
        
        $sqlstmnt = "SELECT 
                lid,
                uid,
                createddt,
                changeddt,
                firstname,
                lastname,
                city,
                crossappl_configurations_sdesc_region,
                crossappl_configurations_sdesc_country
            FROM userprofile 
            WHERE uid=:userprofile_uid";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("USERSAFETY");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":userprofile_uid", $userprofile_uid);
        $appcon->execSelect();
        
        $this->resultRetrieveRecord($appcon);
        
        zLog()->LogEnd_DataObjectFunction("byUid");
    }
}
?>