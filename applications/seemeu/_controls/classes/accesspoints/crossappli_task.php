<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php zReqOnce("/_controls/classes/accesspoints/emailsend.php"); ?>
<?php zReqOnce("/_controls/classes/accesspoints/activation.php"); ?>
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
        zLog()->LogStart_AccessPointFunction("send");
                                
        if($args["taskcontrollink_appl_configurations_sdesc_taskkey"] == "SEEMEU_ACTIVATE_USERACCOUNT_PROSPECT")
        {
            $emailsend = new EmailSend();
            $emailsend->sendUseraccountActivation($args);

            $this->setSysReturnData("TASK_PERFORMED", "Task is Performed", "FALSE");
            $this->transferSysReturnAry($emailsend);
        }
        else if($args["taskcontrollink_appl_configurations_sdesc_taskkey"] == "SEEMEU_RESET_USERACCOUNT_PASSWORD")
        {
            $emailsend = new EmailSend();
            $emailsend->sendUseraccountPasswordReset($args);

            $this->setSysReturnData("TASK_PERFORMED", "Task is Performed", "FALSE");
            $this->transferSysReturnAry($emailsend);
        }
        else
        {
            $this->setSysReturnData("TASK_KEY_NOT_ASSOCIATED_TO_LOGIC", "Task key is not Associated to Logic", "FALSE");
        }
        
        zLog()->LogEnd_AccessPointFunction("send");
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
               
        if($taskkey == "SEEMEU_ACTIVATE_USERACCOUNT_PROSPECT")
        {
            zLog()->LogDebug("JSON{".$json."}");
            $obj = json_decode($json, true);
            
            $uua = new UpdateUserAccount();
            $uua->updateActivatebyUid($obj['useraccount_uid']);
            
            $activation = new Activation();
            $activation->prospect($obj);
            
            $this->transferSysReturnAry($uua);
            
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