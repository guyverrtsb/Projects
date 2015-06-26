<?php zReqOnce("/_controls/classes/dataobjects/base/groupmatch.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class UpdateMatchUsersafetyUseraccounttoUsertype
    extends GroupMatchBase
{
    function __construct()
    {
    }
    
    /*
     * Update Match to Prospect by using the uid
     */
    function updateUsertypebyUidtoProspect($uid)
    {
        zLog()->LogStart_DataObjectFunction("updateUsertypebyUidtoProspect");
        
        $sqlstmnt = "UPDATE match_usersafety_useraccount_to_usertype SET ".
            "changeddt=NOW(), ".
            "configurations_sdesc_usertype=:configurations_sdesc_usertype ".
            "WHERE uid=:uid";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":uid", $uid);
        $appcon->bindParam(":configurations_sdesc_usertype", "USER_TYPE-PROSPECT");
        $appcon->execUpdate();

        $this->resultUpdateRecord($appcon, "match_usersafety_useraccount_to_usertype");
        
        zLog()->LogEnd_DataObjectFunction("updateUsertypebyUidtoProspect");
    }
    
    /*
     * Update Match to Student by using the uid
     */
    function updateUsertypebyUidtoStudent($uid)
    {
        zLog()->LogStart_DataObjectFunction("updateUsertypebyUidtoStudent");
        
        $sqlstmnt = "UPDATE match_usersafety_useraccount_to_usertype SET ".
            "changeddt=NOW(), ".
            "configurations_sdesc_usertype=:configurations_sdesc_usertype ".
            "WHERE uid=:uid";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":uid", $uid);
        $appcon->bindParam(":configurations_sdesc_usertype", "USER_TYPE-STUDENT");
        $appcon->execUpdate();

        $this->resultUpdateRecord($appcon, "match_usersafety_useraccount_to_usertype");
        
        zLog()->LogEnd_DataObjectFunction("updateUsertypebyUidtoStudent");
    }
    
    /*
     * Update Match to Alumni by using the uid
     */
    function updateUsertypebyUidtoAlumni($uid)
    {
        zLog()->LogStart_DataObjectFunction("updateUsertypebyUidtoAlumni");
        
        $sqlstmnt = "UPDATE match_usersafety_useraccount_to_usertype SET ".
            "changeddt=NOW(), ".
            "configurations_sdesc_usertype=:configurations_sdesc_usertype ".
            "WHERE uid=:uid";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":uid", $uid);
        $appcon->bindParam(":configurations_sdesc_usertype", "USER_TYPE-ALUMNI");
        $appcon->execUpdate();

        $this->resultUpdateRecord($appcon, "match_usersafety_useraccount_to_usertype");
        
        zLog()->LogEnd_DataObjectFunction("updateUsertypebyUidtoAlumni");
    }
    
    /*
     * Update Match to Faculty by using the uid
     */
    function updateUsertypebyUidtoFaculty($uid)
    {
        zLog()->LogStart_DataObjectFunction("updateUsertypebyUidtoFaculty");
        
        $sqlstmnt = "UPDATE match_usersafety_useraccount_to_usertype SET ".
            "changeddt=NOW(), ".
            "configurations_sdesc_usertype=:configurations_sdesc_usertype ".
            "WHERE uid=:uid";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":uid", $uid);
        $appcon->bindParam(":configurations_sdesc_usertype", "USER_TYPE-FACULTY");
        $appcon->execUpdate();

        $this->resultUpdateRecord($appcon, "match_usersafety_useraccount_to_usertype");
        
        zLog()->LogEnd_DataObjectFunction("updateUsertypebyUidtoFaculty");
    }
}
?>