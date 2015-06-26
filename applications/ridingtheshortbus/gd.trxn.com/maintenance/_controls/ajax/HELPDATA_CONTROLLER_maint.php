<?php require_once("../../../_controls/classes/_core.php"); ?>
<?php
if(isset($_GET["GD_CONTROLLER_KEY"]))
{
    $action = filter_var($_GET["GD_CONTROLLER_KEY"], FILTER_SANITIZE_STRING);
    if($action == "GET_DEPENDANT_LIST_DATA")
    {
        gdinc("/gd.trxn.com/_system/_controls/executors/HELPDATA_SELECT_allrecordsfordependant.php");
    }
    else if($action == "SAVE_DATA")
    {
        gdinc("/gd.trxn.com/_system/_controls/executors/HELPDATA_INSERT_new_record.php");
    }
    //else if()
    
    
    
    
}
?>