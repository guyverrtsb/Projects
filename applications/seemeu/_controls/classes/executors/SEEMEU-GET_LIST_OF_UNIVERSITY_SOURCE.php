<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/retrieve/entity_universitysource.php"); ?>
<?php
class Executor
    extends AppSysBaseObject
{
    function execute()
    {
        zLog()->LogStart_ExecutorFunction("SEEMEU-GET_LIST_OF_UNIVERSITY_SOURCE");
        
        $reus = new RetrieveEntityUniversitysource();
        if(isset($_POST["START_IDX"]) && isset($_POST["ROW_COUNT"]))
        {
            $reus->getEntityUniversitysource($_POST["START_IDX"]
                                            , $_POST["ROW_COUNT"]);
        }
        else
        {
            $reus->getEntityUniversitysource();
        }

        $this->transferSysReturnAry($reus);
        $this->setSysReturnData("SUCCESS", "FOUND");

        zLog()->LogEnd_ExecutorFunction("SEEMEU-GET_LIST_OF_UNIVERSITY_SOURCE");
    }
}