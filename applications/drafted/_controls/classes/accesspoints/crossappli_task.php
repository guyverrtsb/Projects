<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/update/gameraccount.php"); ?>
<?php zReqOnce("/_controls/classes/send/activation.php"); ?>
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
        zLog()->LogInfoStartFUNCTION("execute");
        $mr = "NA"; //Method Return;
        $tr = "NA"; //Transaction Return;
                
        if($taskkey == "ACTIVATE_GAMER_ACCOUNT")
        {
            $obj = json_decode($json, true);
            
            $ua = new UpdateGamerAccount();
            $tr = $ua->updateActivatebyUid($obj['Result']);

            $mr = zLog()->LogInfoRETURN("TASK_PERFORMED");
        }
        else if($taskkey == "DEACTIVATE_GAMER_ACCOUNT")
        {
            $ua = new UpdateGamerAccount();
            $tr = $ua->updateDeactivatebyUid($recorduid);

            /* Set Output Data Objects 
            $this->setOutputData("useraccount_email", $cua->getEmail());
            $this->setOutputData("useraccount_nickname", $cua->getNickname());
            $this->setOutputData("userprofile_firstname", $cup->getFirstname());
            $this->setOutputData("userprofile_lastname", $cup->getLastname());
            */

            $mr = zLog()->LogInfoRETURN("TASK_PERFORMED");
        }
        else
        {
            $mr = zLog()->LogInfoRETURN("TASK_KEY_NOT_ASSOCIATED_TO_LOGIC");
        }
        
        $this->setSysReturnCode($mr);
        zLog()->LogInfoEndFUNCTION("execute");
    }

    function send($args)
    {
        zLog()->LogInfoStartFUNCTION("execute");
        $mr = "NA"; //Method Return;
        $tr = "NA"; //Transaction Return;
                                
        if($args["taskcontrollink_appl_configurations_sdesc_taskkey"] == "ACTIVATE_GAMER_ACCOUNT")
        {
            $activation = new Activation();
            $activation->sendActivationofGamerAccount($args);

            $mr = zLog()->LogInfoRETURN("TASK_PERFORMED");
            $this->transferSysReturnAry($activation);
        }
        else
        {
            $mr = zLog()->LogInfoRETURN("TASK_KEY_NOT_ASSOCIATED_TO_LOGIC");
        }
        
        $this->setSysReturnCode($mr);
        zLog()->LogInfoEndFUNCTION("execute");
    }
}
?>