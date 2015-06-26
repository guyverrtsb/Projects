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
        zLog()->LogStart_AccessPointFunction("createTaskControl");
                
        $ct = new CreateTaskControl();
        $ct->basic($appl_configurations_sdesc_taskkey,
                $pathtoclass,
                json_encode($args));

        $this->setSysReturnitem("uid1", $ct->getUid1());
        $this->setSysReturnitem("uid2", $ct->getUid2());
        $this->setSysReturnitem("uid3", $ct->getUid3());
        $this->setSysReturnitem("appl_configurations_sdesc_taskkey", $ct->getApplConfigSdescTaskkey());

        $this->setSysReturnData("DATA_IS_CREATED", "DATA is Created", "FALSE");
        
        zLog()->LogEnd_AccessPointFunction("createTaskControl");
    }
    
    function sendTaskControl($args)
    {
        zLog()->LogStart_AccessPointFunction("sendTaskControl");

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
            
            $this->setSysReturnData("TASK_PERFORMED", "Task is Performed");
            $this->transferSysReturnAry($appliTaskControl);
        }
        else if($ra->getIsactive() == "F")
        {
            $this->setSysReturnData("TASKCONTROLLINK_IS_NOT_ACTIVE", "Task Control Link is not active.");
        }
        else if($ra->getSysReturnCode() == "RECORD_IS_NOT_FOUND")
        {
            $this->setSysReturnData("RECORD_IS_NOT_FOUND", "Record is not Found");
        }
        
        zLog()->LogEnd_AccessPointFunction("sendTaskControl");
    }
    
    /*
     * Run Task Control Link
     */
    function executeTaskControl($taskkey)
    {
        zLog()->LogStart_AccessPointFunction("executeTaskControl");
        
        $tkary = explode("{}", $taskkey);
        
        $ra = new RetrieveTaskControl();
        $ra->byUid123($tkary[0],
                    $tkary[1],
                    $tkary[2]);
                            
        if($ra->getSysReturnCode() == "RECORD_IS_FOUND" && $ra->getIsactive() == "T")
        {
            $pathtoclass = $ra->getPathtoclass();
            
            zReqOnce($pathtoclass);
            $appliTaskControl = new AppliTaskControl();
            $appliTaskControl->execute($ra->getApplConfigSdescTaskkey(),
                                    $ra->getjson());
            
            $this->transferSysReturnAry($appliTaskControl);

            $ut = new UpdateTaskControl();
            $ut->deactivateTasklink($ra->getUid());
            
            $ary = json_decode($ra->getjson());
            
            $this->setSysReturnAry($ary);
            
            $this->setSysReturnData("TASK_PERFORMED", "Task is Performed");
        }
        else if($ra->getIsactive() == "F")
        {
            $this->setSysReturnData("TASKCONTROLLINK_IS_NOT_ACTIVE", "Task Control Link is not active.");
        }
        else if($ra->getSysReturnCode() == "RECORD_IS_NOT_FOUND")
        {
            $this->setSysReturnData("RECORD_IS_NOT_FOUND", "Record is not Found");
        }
        
        zLog()->LogEnd_AccessPointFunction("executeTaskControl");
    }
}
?>