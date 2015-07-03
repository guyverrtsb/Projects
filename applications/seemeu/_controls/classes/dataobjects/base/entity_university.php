<?php zReqOnce("/gd.trxn.com/_controls/classes/dataobjects/base/table.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class EntityUniversityBase
    extends TableBase
{
    function __construct()
    {
    }
    
    function getMatchEntitytoUniversityLid() { return $this->getResult_RecordField("match_entity_to_university_lid"); }
    function getMatchEntitytoUniversityUid() { return $this->getResult_RecordField("match_entity_to_university_uid"); }
    function getMatchEntitytoUniversityCreateddt() { return $this->getResult_RecordField("match_entity_to_university_createddt"); }
    function getMatchEntitytoUniversityChangeddt() { return $this->getResult_RecordField("match_entity_to_university_changeddt"); }
    function getMatchEntitytoUniversityMatchEntityUid() { return $this->getResult_RecordField("match_entity_to_university_match_entity_uid"); }
    
    function getEntitUniversityaccountLid() { return $this->getResult_RecordField("entity_universityaccount_lid"); }
    function getEntityUniversityaccountUid() { return $this->getResult_RecordField("entity_universityaccount_uid"); }
    function getEntityUniversityaccountCreateddt() { return $this->getResult_RecordField("entity_universityaccount_createddt"); }
    function getEntityUniversityaccountChangeddt() { return $this->getResult_RecordField("entity_universityaccount_changeddt"); }
    function getEntityUniversityaccountEmaildomain() { return $this->getResult_RecordField("entity_universityaccount_emaildomain"); }
    function getEntityUniversityaccountIsactive() { return $this->getResult_RecordField("entity_universityaccount_isactive"); }
    function getEntityUniversityaccountIsalive() { return $this->getResult_RecordField("entity_universityaccount_islive"); }
    
    function getEntityUniversityprofileLid() { return $this->getResult_RecordField("entity_universityprofile_lid"); }
    function getEntityUniversityprofileUid() { return $this->getResult_RecordField("entity_universityprofile_uid"); }
    function getEntityUniversityprofileCreateddt() { return $this->getResult_RecordField("entity_universityprofile_createddt"); }
    function getEntityUniversityprofileChangeddt() { return $this->getResult_RecordField("entity_universityprofile_changeddt"); }
    function getEntityUniversityprofileWebaddress() { return $this->getResult_RecordField("entity_universityprofile_webaddress"); }
    function getEntityUniversityprofileCity() { return $this->getResult_RecordField("entity_universityprofile_city"); }
    function getEntityUniversityprofileCrossapplsconfigdescregion() { return $this->getResult_RecordField("entity_universityprofile_crossappl_configurations_sdesc_region"); }
    function getEntityUniversityprofileCrossapplsconfigdesccountry() { return $this->getResult_RecordField("entity_universityprofile_crossappl_configurations_sdesc_country"); }
    function getEntityUniversityprofileRegion() { return $this->getResult_RecordField("entity_universityprofile_region"); }
    function getEntityUniversityprofileFoundeddate() { return $this->getResult_RecordField("entity_universityprofile_foundeddate"); }
    function getEntityUniversityprofileLdesc() { return $this->getResult_RecordField("entity_universityprofile_ldesc"); }
    function getEntityUniversityprofileName() { return $this->getResult_RecordField("entity_universityprofile_name"); }
    function getEntityUniversityprofilePhonenumber() { return $this->getResult_RecordField("entity_universityprofile_phonenumber"); }
    function getEntityUniversityprofileConfigsdescshooltype() { return $this->getResult_RecordField("entity_universityprofile_configurations_sdesc_schooltype"); }
    function getEntityUniversityprofileSchooltype() { return $this->getResult_RecordField("entity_universityprofile_schooltype"); }
    function getEntityUniversityprofileLatitude() { return $this->getResult_RecordField("entity_universityprofile_latitude"); }
    function getEntityUniversityprofileLongitude() { return $this->getResult_RecordField("entity_universityprofile_longitude"); }
    function getEntityUniversityprofileEntityUniversitysourceUid() { return $this->getResult_RecordField("entity_universityprofile_entity_universitysource_uid"); }
    
}
?>