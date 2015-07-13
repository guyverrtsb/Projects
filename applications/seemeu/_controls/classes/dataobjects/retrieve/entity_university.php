<?php zReqOnce("/_controls/classes/dataobjects/base/entity_university.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class RetrieveEntityUniversity
    extends EntityUniversityBase
{
    function __construct()
    {
    }
    
    function byMatchEntitytoUniversityUid($uid)
    {
        zLog()->LogStart_DataObjectFunction("byMatchEntitytoUniversityUid");
        
        $sqlstmnt = "select ".
            $this->dbfas("match_entity_to_university.lid,
                match_entity_to_university.uid,
                match_entity_to_university.createddt,
                match_entity_to_university.changeddt,
                match_entity_to_university.entity_universityaccount_uid,
                match_entity_to_university.entity_universityprofile_uid,
                match_entity_to_university.match_entity_uid,
                entity_universityaccount.lid,
                entity_universityaccount.uid,
                entity_universityaccount.createddt,
                entity_universityaccount.changeddt,
                entity_universityaccount.emaildomain,
                entity_universityaccount.isactive,
                entity_universityaccount.islive,
                entity_universityprofile.lid,
                entity_universityprofile.uid,
                entity_universityprofile.createddt,
                entity_universityprofile.changeddt,
                entity_universityprofile.webaddress,
                entity_universityprofile.city,
                entity_universityprofile.crossappl_configurations_sdesc_region,
                entity_universityprofile.crossappl_configurations_sdesc_country,
                entity_universityprofile.region,
                entity_universityprofile.foundeddate,
                entity_universityprofile.ldesc,
                entity_universityprofile.name,
                entity_universityprofile.phonenumber,
                entity_universityprofile.configurations_sdesc_schooltype,
                entity_universityprofile.schooltype,
                entity_universityprofile.latitude,
                entity_universityprofile.longitude,
                entity_universityprofile.entity_universitysource_uid")
            ."from match_entity_to_university
            join entity_universityaccount
            on match_entity_to_university.entity_universityaccount_uid = entity_universityaccount.uid
            join entity_universityprofile
            on match_entity_to_university.entity_universityprofile_uid = entity_universityprofile.uid
            where match_entity_to_university.uid = :uid";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":uid", $uid);
        $appcon->execSelect();
        
        $this->resultRetrieveRecord($appcon);
        
        zLog()->LogEnd_DataObjectFunction("byMatchEntitytoUniversityUid");
    }
    
    function byEntityUid($uid)
    {
        zLog()->LogStart_DataObjectFunction("byEntityUid");
        
        $sqlstmnt = "select ".
            $this->dbfas("match_entity_to_university.lid,
                match_entity_to_university.uid,
                match_entity_to_university.createddt,
                match_entity_to_university.changeddt,
                match_entity_to_university.entity_universityaccount_uid,
                match_entity_to_university.entity_universityprofile_uid,
                match_entity_to_university.match_entity_uid,
                entity_universityaccount.lid,
                entity_universityaccount.uid,
                entity_universityaccount.createddt,
                entity_universityaccount.changeddt,
                entity_universityaccount.emaildomain,
                entity_universityaccount.isactive,
                entity_universityaccount.islive,
                entity_universityprofile.lid,
                entity_universityprofile.uid,
                entity_universityprofile.createddt,
                entity_universityprofile.changeddt,
                entity_universityprofile.webaddress,
                entity_universityprofile.city,
                entity_universityprofile.crossappl_configurations_sdesc_region,
                entity_universityprofile.crossappl_configurations_sdesc_country,
                entity_universityprofile.region,
                entity_universityprofile.foundeddate,
                entity_universityprofile.ldesc,
                entity_universityprofile.name,
                entity_universityprofile.phonenumber,
                entity_universityprofile.configurations_sdesc_schooltype,
                entity_universityprofile.schooltype,
                entity_universityprofile.latitude,
                entity_universityprofile.longitude,
                entity_universityprofile.entity_universitysource_uid")
            ."from match_entity_to_university
            join entity_universityaccount
            on match_entity_to_university.entity_universityaccount_uid = entity_universityaccount.uid
            join entity_universityprofile
            on match_entity_to_university.entity_universityprofile_uid = entity_universityprofile.uid
            where match_entity_to_university.match_entity_uid = :match_entity_uid";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":match_entity_uid", $match_entity_uid);
        $appcon->execSelect();
        
        $this->resultRetrieveRecord($appcon);
        
        zLog()->LogEnd_DataObjectFunction("byEntityUid");
    }
    
    function byEmaildomain($emaildomain)
    {
        zLog()->LogStart_DataObjectFunction("byEmaildomain");
        
        $sqlstmnt = "select ".
            $this->dbfas("match_entity_to_university.lid,
                match_entity_to_university.uid,
                match_entity_to_university.createddt,
                match_entity_to_university.changeddt,
                match_entity_to_university.entity_universityaccount_uid,
                match_entity_to_university.entity_universityprofile_uid,
                match_entity_to_university.match_entity_uid,
                entity_universityaccount.lid,
                entity_universityaccount.uid,
                entity_universityaccount.createddt,
                entity_universityaccount.changeddt,
                entity_universityaccount.emaildomain,
                entity_universityaccount.isactive,
                entity_universityaccount.islive,
                entity_universityprofile.lid,
                entity_universityprofile.uid,
                entity_universityprofile.createddt,
                entity_universityprofile.changeddt,
                entity_universityprofile.webaddress,
                entity_universityprofile.city,
                entity_universityprofile.crossappl_configurations_sdesc_region,
                entity_universityprofile.crossappl_configurations_sdesc_country,
                entity_universityprofile.region,
                entity_universityprofile.foundeddate,
                entity_universityprofile.ldesc,
                entity_universityprofile.name,
                entity_universityprofile.phonenumber,
                entity_universityprofile.configurations_sdesc_schooltype,
                entity_universityprofile.schooltype,
                entity_universityprofile.latitude,
                entity_universityprofile.longitude,
                entity_universityprofile.entity_universitysource_uid")
            ."from match_entity_to_university
            join entity_universityaccount
            on match_entity_to_university.entity_universityaccount_uid = entity_universityaccount.uid
            join entity_universityprofile
            on match_entity_to_university.entity_universityprofile_uid = entity_universityprofile.uid
            where entity_universityaccount.emaildomain = :emaildomain";
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->bindParam(":emaildomain", $emaildomain);
        $appcon->execSelect();
        
        $this->resultRetrieveRecord($appcon);
        
        zLog()->LogEnd_DataObjectFunction("byEmaildomain");
    }
}
?>