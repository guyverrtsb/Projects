<?php zReqOnce("/gd.trxn.com/_controls/classes/dataobjects/base/table.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class GroupBase
    extends TableBase
{
    function __construct()
    {
    }
    
    function getMatchGroupLid() { return $this->getResult_RecordField("match_group_lid"); }
    function getMatchGroupUid() { return $this->getResult_RecordField("match_group_uid"); }
    function getMatchGroupCreateddt() { return $this->getResult_RecordField("match_group_createddt"); }
    function getMatchGroupChangeddt() { return $this->getResult_RecordField("match_group_changeddt"); }
    function getMatchGroupGroupaccountUid() { return $this->getResult_RecordField("match_group_groupaccount_uid"); }
    function getMatchGroupGroupprofileUid() { return $this->getResult_RecordField("match_group_groupprofile_uid"); }
    function getMatchGroupMatchEntityUid() { return $this->getResult_RecordField("match_group_match_entity_uid"); }
    function getMatchGroupMatchUsersafetyUserUid() { return $this->getResult_RecordField("match_group_match_usersafety_user_uid"); }
    function getMatchGroupCfgSdescGrouprole() { return $this->getResult_RecordField("match_group_configurations_sdesc_grouprole"); }
    
    function getGroupaccountLid() { return $this->getResult_RecordField("groupaccount_lid"); }
    function getGroupaccountUid() { return $this->getResult_RecordField("groupaccount_uid"); }
    function getGroupaccountCreateddt() { return $this->getResult_RecordField("groupaccount_createddt"); }
    function getGroupaccountChangeddt() { return $this->getResult_RecordField("groupaccount_changeddt"); }
    function getGroupaccountEmaildomain() { return $this->getResult_RecordField("groupaccount_configurations_sdesc_grouptype"); }
    function getGroupaccountIsactive() { return $this->getResult_RecordField("groupaccount_configurations_sdesc_groupvisibility"); }
    function getGroupaccountIsalive() { return $this->getResult_RecordField("groupaccount_configurations_sdesc_groupaccept"); }
    function getGroupaccountSdesc() { return $this->getResult_RecordField("groupaccount_sdesc"); }
    function getGroupaccountLdesc() { return $this->getResult_RecordField("groupaccount_ldesc"); }
    
    function getGroupprofileLid() { return $this->getResult_RecordField("groupprofile_lid"); }
    function getGroupprofileUid() { return $this->getResult_RecordField("groupprofile_uid"); }
    function getGroupprofileCreateddt() { return $this->getResult_RecordField("groupprofile_createddt"); }
    function getGroupprofileChangeddt() { return $this->getResult_RecordField("groupprofile_changeddt"); }
    function getGroupprofileLdesc() { return $this->getResult_RecordField("groupprofile_ldesc"); }

}
?>