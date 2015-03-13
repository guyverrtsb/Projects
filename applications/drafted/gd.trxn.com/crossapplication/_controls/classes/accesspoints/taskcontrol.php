<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php zReqOnce("/gd.trxn.com/crossapplication/_controls/classes/dataobjects/create/taskcontrol.php"); ?>
<?php zReqOnce("/gd.trxn.com/crossapplication/_controls/classes/dataobjects/retrieve/taskcontrol.php"); ?>
<?php zReqOnce("/gd.trxn.com/crossapplication/_controls/classes/dataobjects/update/taskcontrol.php"); ?>
<?php
/*
* File: user.php
* Author: Stephen Shellenberger
* Copyright: 2015 Stephen Shellenberger
* Date: 2015/02/01
*/
class TaskControl
    extends AppSysBaseObject
{
    function __construct()
    {
    }
    
    /*
     * Create Task Control Link
     */
    function createTaskControl($appl_configurations_sdesc_taskkey,
                            $pathtoclass,
                            $args)
    {
        zLog()->LogInfoStartFUNCTION("createTaskcontrollink");
                
        $ct = new CreateTaskControl();
        $ct->basic($appl_configurations_sdesc_taskkey,
                $pathtoclass,
                json_encode($args));

        $this->setOutputData("uid1", $ct->getUid1());
        $this->setOutputData("uid2", $ct->getUid2());
        $this->setOutputData("uid3", $ct->getUid3());
        $this->setOutputData("appl_configurations_sdesc_taskkey", $ct->getApplConfigSdescTaskkey());
                                        
        $mr = zLog()->LogInfoRETURN("DATA_IS_CREATED");
        
        $this->setSysReturnCode($mr);
        zLog()->LogInfoEndFUNCTION("createTaskcontrollink");
    }
    
    function sendTaskControl($args)
    {
        zLog()->LogInfoStartFUNCTION("sendTaskcontrollink");
        $mr = "NA"; //Method Return;

        $ra = new RetrieveTaskControl();
        $ra->byUid123($args["taskcontrollink_uid1"],
                            $args["taskcontrollink_uid2"],
                            $args["taskcontrollink_uid3"]);
                            
        if($ra->getSysReturnCode() == "RECORD_IS_FOUND"
            && $ra->getIsactive() == "T")
        {
            $pathtoclass = $ra->getPathtoclass();
            
            zReqOnce($pathtoclass);
            $appliTaskControl = new AppliTaskControl();
            $appliTaskControl->send($args);
            
            $mr = zLog()->LogInfoRETURN("TASK_PRFORMED");
            $this->transferSysReturnAry($appliTaskControl);
        }
        else if($ra->getIsactive() == "F")
        {
            $mr = zLog()->LogInfoRETURN("TASKCONTROLLINK_IS_NOT_ACTIVE");
        }
        else if($ra->getSysReturnCode() == "RECORD_IS_NOT_FOUND")
        {
            $mr = zLog()->LogInfoRETURN("RECORD_IS_NOT_FOUND");
        }
        
        $this->setSysReturnCode($mr);
        zLog()->LogInfoEndFUNCTION("sendTaskcontrollink");
    }
    
    /*
     * Run Task Control Link
     */
    function executeTaskControl($uid1,
                                $uid2,
                                $uid3)
    {
        zLog()->LogInfoStartFUNCTION("runTaskcontrollink");
        $mr = "NA"; //Method Return;
        
        $ra = new RetrieveTaskControl();
        $ra->byUid123($uid1,
                    $uid2,
                    $uid3);
                            
        if($ra->getSysReturnCode() == "RECORD_IS_FOUND"
            && $ra->getIsactive() == "T")
        {
            $pathtoclass = $ra->getPathtoclass();
            
            zReqOnce($pathtoclass);
            $appliTaskControl = new AppliTaskControl();
            $appliTaskControl->execute($ra->getApplConfigSdescTaskkey(),
                                    $ra->getjson());
                                        
            $ut = new UpdateTaskControl();
            $ut->deactivateTasklink($ra->getUid());
            
            $mr = zLog()->LogInfoRETURN("TASK_PRFORMED");
        }
        else if($ra->getIsactive() == "F")
        {
            $mr = zLog()->LogInfoRETURN("TASKCONTROLLINK_IS_NOT_ACTIVE");
        }
        else if($ra->getSysReturnCode() == "RECORD_IS_NOT_FOUND")
        {
            $mr = zLog()->LogInfoRETURN("RECORD_IS_NOT_FOUND");
        }
        
        $this->setSysReturnCode($mr);
        zLog()->LogInfoEndFUNCTION("runTaskcontrollink");
    }
}
?>