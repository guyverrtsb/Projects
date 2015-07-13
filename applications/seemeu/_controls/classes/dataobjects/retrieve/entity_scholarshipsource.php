<?php zReqOnce("/_controls/classes/dataobjects/base/entity_scholarshipsource.php"); ?>
<?php
/*
* File: image.to.database.php
* Author: Stephen Shellenberger
* Copyright: 2013 Stephen Shellenberger
* Date: 2013/01/06
 * 1. 
*/
class RetrieveEntityScholarshipsource
    extends EntityScholarshipsourceBase
{
    function __construct()
    {
    }
    
    function getEntityScholarshipsource($startIdx = 1
                                    , $rowCount= 20)
    {
        zLog()->LogStart_DataObjectFunction("getEntityScholarshipsource");
        
        $sqlstmnt = "SELECT ".
            $this->dbfas("lid,
                uid,
                createddt,
                changeddt,
                url,
                idx,
                profile,
                screendata")
            ."FROM entity_scholarshipsource
            ORDER BY lid ASC LIMIT ".$startIdx.", ".$rowCount;
        
        $appcon = new SysConnections();
        $appcon->setApplicationDB("APPLICATION");
        $appcon->setStatement($sqlstmnt);
        $appcon->execSelect();
        
        $this->resultRetrieveRecords($appcon);
        
        zLog()->LogEnd_DataObjectFunction("getEntityScholarshipsource");
    }
}
?>