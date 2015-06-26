<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/accesspoints/emailsend.php"); ?>
<?php zReqOnce("/_controls/classes/accesspoints/emailsend.php"); ?>
<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/update/useraccount.php"); ?>
<?php
/*
* File: user.php
* Author: Stephen Shellenberger
* Copyright: 2015 Stephen Shellenberger
* Date: 2015/02/01
*/
class AppliTaskControl
    extends AppSysBaseObject
{
    function __construct()
    {
    }

    function send($args)
    {
        zLog()->LogStart_AccessPointFunction("execute");
                                
        if($args["taskcontrollink_appl_configurations_sdesc_taskkey"] == "ACTIVATE_USERACCOUNT")
        {
            $activation = new UsersafetyActivation();
            $activation->sendUseraccountActivation($args);

            $this->setSysReturnData("TASK_PERFORMED", "Task is Performed", "FALSE");
            $this->transferSysReturnAry($activation);
        }
        else if($args["taskcontrollink_appl_configurations_sdesc_taskkey"] == "RESET_USERACCOUNT_PASSWORD")
        {
            $activation = new UsersafetyActivation();
            $activation->sendUseraccountPasswordReset($args);

            $this->setSysReturnData("TASK_PERFORMED", "Task is Performed", "FALSE");
            $this->transferSysReturnAry($activation);
        }
        else if($args["taskcontrollink_appl_configurations_sdesc_taskkey"] == "SEEMEU_ACTIVATE_USERACCOUNT")
        {
            $activation = new ApplicationActivation();
            $activation->sendActivationofUseraccount($args);

            $this->setSysReturnData("TASK_PERFORMED", "Task is Performed", "FALSE");
            $this->transferSysReturnAry($activation);
        }
        else if($args["taskcontrollink_appl_configurations_sdesc_taskkey"] == "SEEMEU_RESET_USERACCOUNT_PASSWORD")
        {
            $activation = new ApplicationActivation();
            $activation->sendUseraccountPasswordReset($args);

            $this->setSysReturnData("TASK_PERFORMED", "Task is Performed", "FALSE");
            $this->transferSysReturnAry($activation);
        }
        else
        {
            $this->setSysReturnData("TASK_KEY_NOT_ASSOCIATED_TO_LOGIC", "Task key is not Associated to Logic", "FALSE");
        }
        
        zLog()->LogEnd_AccessPointFunction("execute");
    }
    
    /*
     * This Method is used when Creating
     * User Account and User Profile and Matching.
     * This account will be inactive.
     * the Task Control Unique QS will be generated.
     * You may access using the getTaskCountrolQS method
     */
    function execute($taskkey,
                    $json)
    {
        zLog()->LogStart_AccessPointFunction("execute");
               
        if($taskkey == "ACTIVATE_USERACCOUNT")
        {
            zLog()->LogDebug("JSON{".$json."}");
            $obj = json_decode($json, true);
            
            $uua = new UpdateUserAccount();
            $uua->updateActivatebyUid($obj['useraccount_uid']);
            
            $this->transferSysReturnAry($uua);
            
            $this->setSysReturnData("TASK_PERFORMED", "Task is Performed", "FALSE");
        }
        else if($taskkey == "SEEMEU_ACTIVATE_USERACCOUNT")
        {
            $ua = new UpdateGamerAccount();
            $ua->updateDeactivatebyUid($recorduid);

            $this->setSysReturnData("TASK_PERFORMED", "Task is Performed", "FALSE");
        }
        else
        {
            $this->setSysReturnData("TASK_KEY_NOT_ASSOCIATED_TO_LOGIC", "Task key is not Associated to Logic", "FALSE");
        }
        
        zLog()->LogEnd_AccessPointFunction("execute");
    }
}
?>