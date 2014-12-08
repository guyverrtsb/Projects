<?php gdreqonce("/_controls/classes/base/sqlbase.php"); ?>
<?php gdreqonce("/_controls/classes/find/user.php"); ?>
<?php gdreqonce("/_controls/classes/register/grouprequests.php"); ?>
<?php gdreqonce("/_controls/classes/register/message.php"); ?>
<?php gdreqonce("/_controls/classes/register/notification.php"); ?>
<?php gdreqonce("/_controls/classes/register/wallmessage.php"); ?>
<?php
class zRequestGroupMembership
    extends zSqlBaseObject
{
    function requestGroupMembershipAutoAccept($group, $zfuserLoggedIn, $zfuserGroupOwner)
    {
        $zrgr = new zRegisterGroupRequest();
        $zrgr->registerGroupRequest($zfuserLoggedIn->getUA_Uid(),
                                    $zfuserGroupOwner->getUA_Uid(),
                                    $zfuserLoggedIn->getUA_Uid(),
                                    $group_account_uid,
                                    "GROUP_REQUEST_STATUS_APPROVED");
    
        $zrmtoowner = new zRegisterMessage();
        $zrmtoowner->registerMessage("MESSAGE_TYPE_MESSAGE",
            "Member Auto Approved for ".$group->getGA_Ldesc(). " Group",
            $zfuserLoggedIn->getFName()." has been auto approved to join your ".$group->getGA_Ldesc(). " Group.",
            $zfuserGroupOwner->getUA_Uid(),
            $zfuserLoggedIn->getUA_Uid(),
            $zrgr->getUid(),
            "F",
            "TOP_LEVEL_MESSAGE");
            
        $zrntoowner = new zRegisterNotification();
        $zrntoowner->registerNotification("MESSAGE_TYPE_MESSAGE",
            $zrmtoowner->getUid());
        
        $zrmtorequestee = new zRegisterMessage();
        $zrmtorequestee->registerMessage("MESSAGE_TYPE_MESSAGE",
            "Approved for ".$group->getGA_Ldesc(). " Group",
            "You have been approved for ".$group->getGA_Ldesc()." Group.",
            $zfuserLoggedIn->getUA_Uid(),
            $zfuserGroupOwner->getUA_Uid(),
            $zrgr->getUid(),
            "F",
            "TOP_LEVEL_MESSAGE");
        
        $zrntorequestee = new zRegisterNotification();
        $zrntorequestee->registerNotification("MESSAGE_TYPE_MESSAGE",
            $zrmtorequestee->getUid());
            
        $zrwallmessage = new zRegisterWallMessage();
        $zrwallmessage->registerWallMessage($group_account_uid,
                                            $this->getGDConfig()->getSessAuthUserUid(),
                                            $zfuserLoggedIn->getFName()." has joined ".$group->getGA_Ldesc().".",
                                            "IMAGE_NOT_PROVIDED_FOR_UPLOADED");
                                            
        $this->setResult($zrgr->getResult_Request());
    }

    function requestGroupMembershipOwnerAccept($group, $zfuserLoggedIn, $zfuserGroupOwner)
    {
        $zrgr = new zRegisterGroupRequest();
        $zrgr->registerGroupRequest($zfuserLoggedIn->getUA_Uid(),
                                    $zfuserGroupOwner->getUA_Uid(),
                                    $zfuserLoggedIn->getUA_Uid(),
                                    $group->getGA_UID(),
                                    "GROUP_REQUEST_STATUS_SENTTOAPPROVER");
                                    
        $zrmtoowner = new zRegisterMessage();
        $zrmtoowner->registerMessage("MESSAGE_TYPE_GROUP_JOIN_REQUEST",
            "Group Request waiting for your Approval",
            $zfuserLoggedIn->getFName()." has requested approval to join ".$group->getGA_Ldesc(). " Group.",
            $zfuserGroupOwner->getUA_Uid(),
            $zfuserLoggedIn->getUA_Uid(),
            $zrgr->getUid(),
            "F",
            "TOP_LEVEL_MESSAGE");
            
        $zrntoowner = new zRegisterNotification();
        $zrntoowner->registerNotification("MESSAGE_TYPE_GROUP_JOIN_REQUEST",
            $zrmtoowner->getUid(),
            $zfuserGroupOwner->getUserTableKey());
        
        $zrmtorequestee = new zRegisterMessage();
        $zrmtorequestee->registerMessage("MESSAGE_TYPE_MESSAGE",
            "Group Request is Pending for ".$group->getGA_Ldesc()." Group.",
            "Your request is in process for approval to join ".$group->getGA_Ldesc()." Group.",
            $zfuserLoggedIn->getUA_Uid(),
            $zfuserGroupOwner->getUA_Uid(),
            $zrgr->getUid(),
            "F",
            "TOP_LEVEL_MESSAGE");
        
        $zrntorequestee = new zRegisterNotification();
        $zrntorequestee->registerNotification("MESSAGE_TYPE_MESSAGE",
            $zrmtorequestee->getUid());
            
        $this->setResult($zrgr->getResult_Request());
    }

    private $Result = "NO_RESULT";
    function setResult($row)
    {
        return $this->Result = $row;
    }
    function getResult()
    {
        return $this->Result;
    }
}
?>