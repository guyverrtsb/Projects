<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/retrieve/entity_scholarshipsource.php"); ?>
<?php
class Executor
    extends AppSysBaseObject
{
    function execute()
    {
        zLog()->LogStart_ExecutorFunction("SEEMEU-GET_LIST_OF_SCHOLARSHIP_SOURCE");
        
        $reus = new RetrieveEntityScholarshipsource();
        if(isset($_POST["START_IDX"]) && isset($_POST["ROW_COUNT"]))
        {
            $reus->getEntityScholarshipsource($_POST["START_IDX"]
                                            , $_POST["ROW_COUNT"]);
        }
        else
        {
            $reus->getEntityScholarshipsource();
        }

        $this->transferSysReturnAry($reus);
        $this->setSysReturnData("SUCCESS", "FOUND");

        zLog()->LogEnd_ExecutorFunction("SEEMEU-GET_LIST_OF_SCHOLARSHIP_SOURCE");
    }
}