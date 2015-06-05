<?php zReqOnce("/_controls/classes/_sys/_appsysbaseobject.php"); ?>
<?php zReqOnce("/gd.trxn.com/usersafety/_controls/classes/dataobjects/update/useraccount.php"); ?>
<?php zReqOnce("/_controls/classes/dataobjects/update/gameraccount.php"); ?>
<?php zReqOnce("/_controls/classes/accesspoints/gamer.php"); ?>
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

    function send($args)
    {
        zLog()->LogStartFUNCTION("execute");
        $mr = "NA"; //Method Return;
                                
        if($args["taskcontrollink_appl_configurations_sdesc_taskkey"] == "ACTIVATE_GAMER_ACCOUNT")
        {
            $activation = new Activation();
            $activation->sendActivationofGamerAccount($args);

            $mr = zLog()->LogReturn("TASK_PERFORMED");
            $this->transferSysReturnAry($activation);
        }
        else if($args["taskcontrollink_appl_configurations_sdesc_taskkey"] == "RESET_GAMER_PASSWORD")
        {
            $activation = new Activation();
            $activation->sendResetofGamerPassword($args);

            $mr = zLog()->LogReturn("TASK_PERFORMED");
            $this->transferSysReturnAry($activation);
        }
        else
        {
            $mr = zLog()->LogReturn("TASK_KEY_NOT_ASSOCIATED_TO_LOGIC");
        }
        
        $this->setSysReturnCode($mr);
        zLog()->LogEndFUNCTION("execute");
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
        zLog()->LogStartFUNCTION("execute");
        $mr = "NA"; //Method Return;
               
        if($taskkey == "ACTIVATE_GAMER_ACCOUNT")
        {
            zLog()->LogDebug("JSON{".$json."}");
            $obj = json_decode($json, true);
            
            $uga = new UpdateGamerAccount();
            $uga->updateActivatebyUid($obj['gameraccount_uid']);
            
            $uua = new UpdateUserAccount();
            $uua->updateActivatebyUid($obj['useraccount_uid']);
            
            $gamer = new Gamer();
            $gamer->retrieveGamer("useraccount_uid", $obj['gameraccount_uid']);
            
            $this->transferSysReturnAry($gamer);
            
            $mr = zLog()->LogReturn("TASK_PERFORMED");
        }
        else if($taskkey == "DEACTIVATE_GAMER_ACCOUNT")
        {
            $ua = new UpdateGamerAccount();
            $ua->updateDeactivatebyUid($recorduid);

            /* Set Output Data Objects 
            $this->setOutputData("useraccount_email", $cua->getEmail());
            $this->setOutputData("useraccount_nickname", $cua->getNickname());
            $this->setOutputData("userprofile_firstname", $cup->getFirstname());
            $this->setOutputData("userprofile_lastname", $cup->getLastname());
            */

            $mr = zLog()->LogReturn("TASK_PERFORMED");
        }
        else if($taskkey == "RESET_GAMER_PASSWORD")
        {
            SysIntegration::redirectToUIPage("0", "RESET_GAMER_PASSWORD", "Reset Gamer Password", "FALSE", SysIntegration::getRedirectAuthChangePasswordPage());
            $mr = zLog()->LogReturn("RESET_GAMER_PASSWORD");
        }
        else
        {
            $mr = zLog()->LogReturn("TASK_KEY_NOT_ASSOCIATED_TO_LOGIC");
        }
        
        $this->setSysReturnCode($mr);
        zLog()->LogEndFUNCTION("execute");
    }
}
?>