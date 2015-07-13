<?php zReqOnce("/_controls/classes/dataobjects/base/entity_universitysource.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class RetrieveEntityUniversitysource
    extends EntityUniversitysourceBase
{
    function __construct()
    {
    }
    
    function getEntityUniversitysource($startIdx = 1
                                    , $rowCount= 20)
    {
        zLog()->LogStart_DataObjectFunction("getEntityUniversitysource");
        
        $sqlstmnt = "SELECT ".
            $this->dbfas("lid,
                uid,
                createddt,
                changeddt,
                url,
                idx,
                profilecreated,
                snapshot_essentials,
                snapshot_about,
                snapshot_overallratings,
                snapshot_studentratings,
                snapshot_location,
                snapshot_gettingaround,
                snapshot_walkability,
                snapshot_transit,
                snapshot_weather,
                snapshot_students,
                snapshot_similar,
                snapshot_otherschoolsnear,
                snapshot_screendata,
                academics_screendata,
                costs_screendata,
                admissions_screendata,
                collegelife_screendata,
                photosvideos_screendata,
                reviews_screendata")
            ."FROM entity_universitysource
            ORDER BY lid ASC LIMIT ".$startIdx.", ".$rowCount;
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->execSelect();
        
        $this->resultRetrieveRecords($appcon);
        
        zLog()->LogEnd_DataObjectFunction("getEntityUniversitysource");
    }
}
?>