<?php require_once("../../gd.trxn.com/_controls/classes/_core.php"); ?>
<?php gdreqonce("/gd.trxn.com/gduploadmimes/_controls/classes/controls/standard.php"); ?>
<?php gdreqonce("/_controls/classes/location.php"); ?>
<?php gdreqonce("/_controls/classes/register/wallmessage.php"); ?>
<?php gdreqonce("/_controls/classes/find/wallmessage.php"); ?>
<?php gdreqonce("/_controls/classes/register/search.php"); ?>
<?php
if(isset($_POST["GD_CONTROLLER_KEY"]))
{
    $action = filter_var($_POST["GD_CONTROLLER_KEY"], FILTER_SANITIZE_STRING);
    gdlog()->LogInfo("GD_CONTROLLER_KEY{".$action."}");
    if($action == "REGISTER_WALL_MESSAGE")
    {
        // Do Image manipulation
        if(validateUploadWallMessageImageForm())
        {
            $r = "INVALID";
            if(isset($_FILES["WallMessageImageFile"]))
            {
                gdlog()->LogInfoTaskLabel("Register Image");
                $zsuc = new zStandardUploadControl("WallMessageImageFile", "mimes_appl_groupyou_wall_message", "500", "500");
                $r = $zsuc->executeControl();
                gdlog()->LogInfo("IMAGE_VALIDATION:".$r);
                if($r == "MIME_BLOB_REGISTERED")
                {
                    gdlog()->LogInfoTaskLabel("Register Wall Message");
                    $wall_message = filter_var($_POST["WallMessageContent"], FILTER_SANITIZE_STRING);
                    $zrwallmessage = new zRegisterWallMessage();
                    $zrwallmessage->registerWallMessage($global_group_account_uid,
                                                            $_SESSION["UNIV_MEET_AUTH_USER_UID"],
                                                            $wall_message,
                                                            $zsuc->getApplMimeUid());
                                                            
                    gdlog()->LogInfoTaskLabel("Add Search for Wall Message");
                    $zrsearch = new zRegisterSearchData();
                    $zrsearch->registerSearchSdesc($wall_message
                        , $zrwallmessage->getWM_Uid(), "SEARCH_OBJECT_WALL_MESSAGE");
                    $r = "VALID";
                }
            }
            else
            {
                gdlog()->LogInfoTaskLabel("Register Wall Message");
                // Save Wall Message
                $wall_message = filter_var($_POST["WallMessageContent"], FILTER_SANITIZE_STRING);
                $zrwallmessage = new zRegisterWallMessage();
                $zrwallmessage->registerWallMessage($global_group_account_uid,
                                                        $_SESSION["UNIV_MEET_AUTH_USER_UID"],
                                                        $wall_message,
                                                        "IMAGE_NOT_PROVIDED_FOR_UPLOADED");
                                                        
                gdlog()->LogInfoTaskLabel("Add Search for Wall Message");
                $zrsearch = new zRegisterSearchData();
                $zrsearch->registerSearchSdesc($wall_message
                    , $zrwallmessage->getWM_Uid(), "SEARCH_OBJECT_WALL_MESSAGE");
                $r = "VALID";
            }
            echo $r;
        }
        else
        {
            echo "FORM_FIELDS_NOT_VALID";
        }
    }
    else if($action == "REGISTER_WALL_MESSAGE_COMMENT")
    {
        if(validateSaveNewWallMessageCommentForm())
        {
            gdlog()->LogInfo($action.":REGISTER_WALL_MESSAGE_COMMENT");
            $wall_message_uid = filter_var($_POST["wall_message_uid"], FILTER_SANITIZE_STRING);
            // Save Wall Message
            $wall_message_comment = filter_var($_POST["wall_message_comment"], FILTER_SANITIZE_STRING);
            $zrwallmessage = new zRegisterWallMessage();
            $r = $zrwallmessage->registerWallMessageComment($global_group_account_uid,
                                                            $_SESSION["UNIV_MEET_AUTH_USER_UID"],
                                                            $wall_message_comment,
                                                            $wall_message_uid);
            echo $r;
        }
        else
        {
            echo "FORM_FIELDS_NOT_VALID";
        }
    }
    else if($action == "LOAD_EXISTING_WALL_MESSAGES")
    {
        if(validateLoadExistingWallMessageForm())
        {
            $wall_message_createddt_start = filter_var($_POST["WALL_MESSAGE_CREATEDDT_START"], FILTER_SANITIZE_STRING);
            $wall_message_lid_bypass = filter_var($_POST["WALL_MESSAGE_LID_BYPASS"], FILTER_SANITIZE_STRING);
            $zfmessage = new zFindWallMessage();
            $r = $zfmessage->findAllExistingWallMessages($global_group_account_uid,
                                                        $wall_message_createddt_start,
                                                        $wall_message_lid_bypass);
            if($r == "WALL_MESSAGES_FOUND")
            {
                $r = json_encode($zfmessage->getResults_AllWallMessages());
                $zfmessage->gdlog()->LogInfo("JSON_ENCODE:".$r);
            }
            echo $r;
        }
        else
        {
            echo "FORM_FIELDS_NOT_VALID";
        }
    }
    else if($action == "LOAD_NEW_WALL_MESSAGES")
    {
        if(validateNewLoadWallMessageForm())
        {
            $wall_message_createddt_start = filter_var($_POST["WALL_MESSAGE_CREATEDDT_START"], FILTER_SANITIZE_STRING);
            $wall_message_lid_bypass = filter_var($_POST["WALL_MESSAGE_LID_BYPASS"], FILTER_SANITIZE_STRING);
            $zfmessage = new zFindWallMessage();
            $r = $zfmessage->findAllNewWallMessages($global_group_account_uid,
                                                    $wall_message_createddt_start,
                                                    $wall_message_lid_bypass);
            if($r == "WALL_MESSAGES_FOUND")
            {
                $r = json_encode($zfmessage->getResults_AllWallMessages());
                $zfmessage->gdlog()->LogInfo("JSON_ENCODE:".$r);
            }
            echo $r;
        }
        else
        {
            echo "FORM_FIELDS_NOT_VALID";
        }
    }
    else if($action == "LOAD_ALL_WALL_MESSAGE_COMMENTS")
    {
        if(validateLoadWallMessageCommentForm())
        {
            $wall_message_uid = filter_var($_POST["wall_message_uid"], FILTER_SANITIZE_STRING);
            $zfmessage = new zFindWallMessage();
            $r = $zfmessage->findAllWallMessageComments($wall_message_uid);
            if($r == "WALL_MESSAGE_COMMENTS_FOUND")
            {
                $r = json_encode($zfmessage->getResults_AllWallMessageComments());
                $zfmessage->gdlog()->LogInfo("JSON_ENCODE:".$r);
            }
            echo $r;
        }
        else
        {
            echo "FORM_FIELDS_NOT_VALID";
        }
    }
}

function validateUploadWallMessageImageForm()
{
    $fv = true;  // Form is Valid Key T=Valid; anything else is invalid;
    if (!isset($_POST["WallMessageContent"]) || $_POST["WallMessageContent"] == "")
        $fv = false;
    return $fv;
}
function validateSaveNewWallMessageForm()
{
    $fv = "T";  // Form is Valid Key T=Valid; anything else is invalid;
    if (!isset($_POST["wall_message"]) || $_POST["wall_message"] == "")
        $fv = "F";
    else if (!isset($_POST["orig_file_path"]) || $_POST["orig_file_path"] == "")
        $fv = "F";
    return $fv;
}
function validateLoadExistingWallMessageForm()
{
    $fv = "T";  // Form is Valid Key T=Valid; anything else is invalid;
    if (!isset($_POST["START_POSITION"]) || $_POST["START_POSITION"] == "")
        $fv = "F";
    else if (!isset($_POST["COUNT_POSITION"]) || $_POST["COUNT_POSITION"] == "")
        $fv = "F";
    else if (!isset($_POST["DATE_TIME"]) || $_POST["DATE_TIME"] == "")
        $fv = "F";
    return $fv;
}
function validateNewLoadWallMessageForm()
{
    $fv = "T";  // Form is Valid Key T=Valid; anything else is invalid;
    if (!isset($_POST["DATE_TIME"]) || $_POST["DATE_TIME"] == "")
        $fv = "F";
    return $fv;
}
function validateSaveNewWallMessageCommentForm()
{
    $fv = "T";  // Form is Valid Key T=Valid; anything else is invalid;
    if (!isset($_POST["wall_message_uid"]) || $_POST["wall_message_uid"] == "")
        $fv = "F";
    else if (!isset($_POST["wall_message_comment"]) || $_POST["wall_message_comment"]== "")
        $fv = "F";
    return $fv;
}
function validateLoadWallMessageCommentForm()
{
    $fv = "T";  // Form is Valid Key T=Valid; anything else is invalid;
    if (!isset($_POST["wall_message_uid"]) || $_POST["wall_message_uid"] == "")
        $fv = "F";
    return $fv;
}
?>