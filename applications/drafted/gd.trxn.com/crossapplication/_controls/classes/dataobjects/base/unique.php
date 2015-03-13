<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class UniqueBase
    extends AppSysBaseObject
{
    function __construct()
    {
    }
    
    function getNumofRecords() { return $this->getResult_RecordField("numofrecords"); }

}
?>