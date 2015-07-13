<?php zReqOnce("/gd.trxn.com/_controls/classes/dataobjects/base/table.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class EntityUniversitysourceBase
    extends TableBase
{
    function __construct()
    {
    }
    
    function getUrl() { return $this->getResult_RecordField("url"); }
    function getIdx() { return $this->getResult_RecordField("idx"); }
    function getProfilecreated() { return $this->getResult_RecordField("profilecreated"); }
    function getSnapshotEssentials() { return $this->getResult_RecordField("snapshot_essentials"); }
    function getSnapshotAbout() { return $this->getResult_RecordField("snapshot_about"); }
    function getSnapshotOverallratings() { return $this->getResult_RecordField("snapshot_overallratings"); }
    function getSnapshotStudentratings() { return $this->getResult_RecordField("snapshot_studentratings"); }
    function getSnapshotLocation() { return $this->getResult_RecordField("snapshot_location"); }
    function getSnapshotGettingaround() { return $this->getResult_RecordField("snapshot_gettingaround"); }
    function getSnapshotWalkability() { return $this->getResult_RecordField("snapshot_walkability"); }
    function getSnapshotTransit() { return $this->getResult_RecordField("snapshot_transit"); }
    function getSnapshotWeather() { return $this->getResult_RecordField("snapshot_weather"); }
    function getSnapshotStudents() { return $this->getResult_RecordField("snapshot_students"); }
    function getSnapshotSimilar() { return $this->getResult_RecordField("snapshot_similar"); }
    function getSnapshotOtherschoolsnear() { return $this->getResult_RecordField("snapshot_otherschoolsnear"); }
    function getSnapshotScreendata() { return $this->getResult_RecordField("snapshot_screendata"); }
    function getAcademicsScreendata() { return $this->getResult_RecordField("academics_screendata"); }
    function getCostsScreendata() { return $this->getResult_RecordField("costs_screendata"); }
    function getAdmissionsScreendata() { return $this->getResult_RecordField("admissions_screendata"); }
    function getCollegelifeScreendata() { return $this->getResult_RecordField("collegelife_screendata"); }
    function getPhotosvideosScreendata() { return $this->getResult_RecordField("photosvideos_screendata"); }
    function getReviewsScreendata() { return $this->getResult_RecordField("reviews_screendata"); }
}
?>