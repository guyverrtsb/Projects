<?php zReqOnce("/_controls/classes/dataobjects/base/group.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class RetrieveGroup
    extends GroupBase
{
    function __construct()
    {
    }
    
    /*
     * use this to get the Groups by Entity
     * that are of a particular Group Type
     */
    function getGroupsbyRole($match_group_configurations_sdesc_grouprole)
    {
        zLog()->LogStart_DataObjectFunction("getGroupsbyRole");
        
        $sqlstmnt = "SELECT ".
            $this->dbfas("match_group.lid,
                match_group.uid,
                match_group.createddt,
                match_group.changeddt,
                match_group.groupaccount_uid,
                match_group.groupprofile_uid,
                match_group.match_entity_uid,
                match_group.match_usersafety_user_uid,
                match_group.configurations_sdesc_grouprole,
                groupaccount.lid,
                groupaccount.uid,
                groupaccount.createddt,
                groupaccount.changeddt,
                groupaccount.configurations_sdesc_grouptype,
                groupaccount.configurations_sdesc_groupvisibility,
                groupaccount.configurations_sdesc_groupaccept,
                groupaccount.sdesc,
                groupaccount.ldesc,
                groupprofile.lid,
                groupprofile.uid,
                groupprofile.createddt,
                groupprofile.changeddt,
                groupprofile.ldesc")
            ."FROM personalization
            JOIN match_group
            ON personalization.university_active_match_entity_uid = match_group.match_entity_uid
            JOIN groupaccount
            ON match_group.groupaccount_uid = groupaccount.uid
            JOIN groupprofile
            ON match_group.groupprofile_uid = groupprofile.uid
            WHERE personalization.match_usersafety_user_uid = :personalization_match_usersafety_user_uid
            AND match_group.configurations_sdesc_grouprole = :match_group_configurations_sdesc_grouprole
            AND match_group.match_usersafety_user_uid = :match_group_match_usersafety_user_uid";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":personalization_match_usersafety_user_uid", zAppSysIntegration()->getAuthUserUid());
        $appcon->bindParam(":match_group_configurations_sdesc_grouprole", $match_group_configurations_sdesc_grouprole);
        $appcon->bindParam(":match_group_match_usersafety_user_uid", zAppSysIntegration()->getAuthUserUid());
        $appcon->execSelect();
        
        $this->resultRetrieveRecords($appcon);
        
        zLog()->LogEnd_DataObjectFunction("getGroupsbyRole");
    }
    
    /*
     * use this to get the Groups by Entity
     * that are of a particular Group Type
     */
    function getGroupsbyEntityUid_Grouptype($match_group_match_entity_uid,
                                            $groupaccount_configurations_sdesc_grouptype)
    {
        zLog()->LogStart_DataObjectFunction("getGroupsbyEntityUid_Grouptype");
        
        $sqlstmnt = "SELECT ".
            $this->dbfas("match_group.lid,
                match_group.uid,
                match_group.createddt,
                match_group.changeddt,
                match_group.groupaccount_uid,
                match_group.groupprofile_uid,
                match_group.match_entity_uid,
                match_group.match_usersafety_user_uid,
                match_group.configurations_sdesc_grouprole,
                groupaccount.lid,
                groupaccount.uid,
                groupaccount.createddt,
                groupaccount.changeddt,
                groupaccount.configurations_sdesc_grouptype,
                groupaccount.configurations_sdesc_groupvisibility,
                groupaccount.configurations_sdesc_groupaccept,
                groupaccount.sdesc,
                groupaccount.ldesc,
                groupprofile.lid,
                groupprofile.uid,
                groupprofile.createddt,
                groupprofile.changeddt,
                groupprofile.ldesc")
            ."FROM match_group
            JOIN groupaccount
            ON match_group.groupaccount_uid = groupaccount.uid
            JOIN groupprofile
            ON match_group.groupprofile_uid = groupprofile.uid
            WHERE match_group.match_entity_uid = :match_group_match_entity_uid
            AND groupaccount.configurations_sdesc_grouptype = :groupaccount_configurations_sdesc_grouptype";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":match_group_match_entity_uid", $match_group_match_entity_uid);
        $appcon->bindParam(":groupaccount_configurations_sdesc_grouptype", $groupaccount_configurations_sdesc_grouptype);
        $appcon->execSelect();
        
        $this->resultRetrieveRecords($appcon);
        
        zLog()->LogEnd_DataObjectFunction("getGroupsbyEntityUid_Grouptype");
    }
}
?>