<?php require_once("../../gd.trxn.com/_controls/classes/_core.php"); ?>
<?php gdreqonce("/gd.trxn.com/upload/_controls/classes/upload.php"); ?>
<?php gdreqonce("/_controls/classes/register/wallmessage.php"); ?>
<?php gdreqonce("/_controls/classes/find/wallmessage.php"); ?>
<?php gdreqonce("/_controls/classes/register/search.php"); ?>
<?php
$echoret = "";
$action = getControlKey();
if($action != "INVALID")
{
    gdlog()->LogInfo("GD_CONTROLLER_KEY{".$action."}");
    if($action == "REGISTER_WALL_MESSAGE")
    {
        // Do Image manipulation
        if(validateUploadWallMessageImageForm())
        {
            if(isset($_FILES["WallMessageImageFile"]))
            {
                gdlog()->LogInfoTaskLabel("Register Image");
                $gdud = new gdUploadData();
                $gdud->uploadFile(array(
                    'image_versions' => array(
                        'original' => array('auto_orient' => true),
                        'medium' => array('max_width' => 500,'max_height' => 500),
                        'thumbnail' => array('max_width' => 100, 'max_height' => 100)
                    ),
                    'param_name' => "WallMessageImageFile"));
                $response = $gdud->getOutputData("UPLOAD_RESPONSE");
                gdlog()->LogInfo("FILES:NAME{".json_encode($response)."}");
                
                $r = $gdud->registerToDB(gdconfig()->getSessUnivTblKey()."mimes_standard"
                                    , "CROSSAPPDATA");
                
                gdlog()->LogInfo("IMAGE_VALIDATION:".$r);
                if($r == "UPLOAD_COMPLETED")
                {
                    gdlog()->LogInfoTaskLabel("Register Wall Message");
                    $wall_message = filter_var($_POST["WallMessageContent"], FILTER_SANITIZE_STRING);
                    $zrwallmessage = new zRegisterWallMessage();
                    $zrwallmessage->registerWallMessage(gdconfig()->getSessGroupUid(),
                                                            gdconfig()->getSessAuthUserUid(),
                                                            $wall_message,
                                                            $gdud->getOutputData("META_UID"),
                                                            $gdud->getOutputData("MIME_TYPE_GROUP"));
                                                            
                    gdlog()->LogInfoTaskLabel("Add Search for Wall Message");
                    $zrsearch = new zRegisterSearchData();
                    $zrsearch->registerSearchSdesc($wall_message
                        , $zrwallmessage->getWM_Uid(), "SEARCH_OBJECT_WALL_MESSAGE");
                    $echoret = json_encode(buildReturnArray("RETURN_KEY", "SUCCESS"
                                                ,"RETURN_SHOW_PASS_MSG", "FALSE"));
                }
                else
                {
                    $echoret = json_encode(buildReturnArray("RETURN_KEY", "IMAGE_FAILURE"
                                                ,"RETURN_SHOW_PASS_MSG", "TRUE"
                                                ,"RETURN_MSG", "The Image was not processed correctly.  Please try again."));
                }
            }
            else
            {
                gdlog()->LogInfoTaskLabel("Register Wall Message");
                // Save Wall Message
                $wall_message = filter_var($_POST["WallMessageContent"], FILTER_SANITIZE_STRING);
                $zrwallmessage = new zRegisterWallMessage();
                $zrwallmessage->registerWallMessage(gdconfig()->getSessGroupUid(),
                                                        gdconfig()->getSessAuthUserUid(),
                                                        $wall_message,
                                                        "MIME_NOT_PROVIDED_FOR_UPLOADED",
                                                        "MIME_NOT_PROVIDED_FOR_UPLOADED");
                                                        
                gdlog()->LogInfoTaskLabel("Add Search for Wall Message");
                $zrsearch = new zRegisterSearchData();
                $zrsearch->registerSearchSdesc($wall_message
                    , $zrwallmessage->getWM_Uid(), "SEARCH_OBJECT_WALL_MESSAGE");
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "SUCCESS"
                                                ,"RETURN_SHOW_PASS_MSG", "FALSE"));
            }
        }
        else
        {
            $echoret = json_encode(buildReturnArray("RETURN_KEY", "FORM_FIELDS_NOT_VALID"
                                                ,"RETURN_SHOW_PASS_MSG", "TRUE"
                                                ,"RETURN_MSG", "Please fill in all fields."));
        }
    }
    else if($action == "REGISTER_WALL_MESSAGE_COMMENT")
    {
        if(validateSaveNewWallMessageCommentForm())
        {
            $wall_message_uid = filter_var($_POST["wall_message_uid"], FILTER_SANITIZE_STRING);
            // Save Wall Message
            $wall_message_comment = filter_var($_POST["wall_message_comment"], FILTER_SANITIZE_STRING);
            $zrwallmessage = new zRegisterWallMessage();
            $r = $zrwallmessage->registerWallMessageComment(gdconfig()->getSessGroupUid(),
                                                            gdconfig()->getSessAuthUserUid(),
                                                            $wall_message_comment,
                                                            $wall_message_uid);
            $echoret = json_encode(buildReturnArray("RETURN_KEY", "SUCCESS"
                                                ,"RETURN_SHOW_PASS_MSG", "FALSE"));
        }
        else
        {
            $echoret = json_encode(buildReturnArray("RETURN_KEY", "FORM_FIELDS_NOT_VALID"
                                                ,"RETURN_SHOW_PASS_MSG", "TRUE"
                                                ,"RETURN_MSG", "Please fill in all fields."));
        }
    }
    else if($action == "LOAD_EXISTING_WALL_MESSAGES")
    {
        if(validateLoadExistingWallMessageForm())
        {
            $wall_message_createddt_start = filter_var($_POST["WALL_MESSAGE_CREATEDDT_START"], FILTER_SANITIZE_STRING);
            $wall_message_lid_bypass = filter_var($_POST["WALL_MESSAGE_LID_BYPASS"], FILTER_SANITIZE_STRING);
            $zfmessage = new zFindWallMessage();
            $r = $zfmessage->findAllExistingWallMessages(gdconfig()->getSessGroupUid(),
                                                        $wall_message_createddt_start,
                                                        $wall_message_lid_bypass);
            if($r == "WALL_MESSAGES_FOUND")
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "WALL_MESSAGES_FOUND"
                                                ,"RETURN_SHOW_PASS_MSG", "FALSE"
                                                , "LIST", $zfmessage->getResults_AllWallMessages()));
            }
            else
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "WALL_MESSAGES_NOT_FOUND"
                                                ,"RETURN_SHOW_PASS_MSG", "TRUE"
                                                ,"RETURN_MSG", "Nothing has posted to your wall yet.  Be the first."));
            }
        }
        else
        {
            $echoret = json_encode(buildReturnArray("RETURN_KEY", "FORM_FIELDS_NOT_VALID"
                                                ,"RETURN_SHOW_PASS_MSG", "TRUE"
                                                ,"RETURN_MSG", "Please fill in all fields."));
        }
    }
    else if($action == "LOAD_NEW_WALL_MESSAGES")
    {
        if(validateNewLoadWallMessageForm())
        {
            $wall_message_createddt_start = filter_var($_POST["WALL_MESSAGE_CREATEDDT_START"], FILTER_SANITIZE_STRING);
            $wall_message_lid_bypass = filter_var($_POST["WALL_MESSAGE_LID_BYPASS"], FILTER_SANITIZE_STRING);
            $zfmessage = new zFindWallMessage();
            $r = $zfmessage->findAllNewWallMessages(gdconfig()->getSessGroupUid(),
                                                    $wall_message_createddt_start,
                                                    $wall_message_lid_bypass);
            if($r == "WALL_MESSAGES_FOUND")
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "WALL_MESSAGES_FOUND"
                                                ,"RETURN_SHOW_PASS_MSG", "FALSE"
                                                , "LIST", $zfmessage->getResults_AllWallMessages()));
            }
            else
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "WALL_MESSAGES_NOT_FOUND"
                                                ,"RETURN_SHOW_PASS_MSG", "TRUE"
                                                ,"RETURN_MSG", "Nothing has posted to your wall yet.  Be the first."));
            }
        }
        else
        {
            $echoret = json_encode(buildReturnArray("RETURN_KEY", "FORM_FIELDS_NOT_VALID"
                                                ,"RETURN_SHOW_PASS_MSG", "TRUE"
                                                ,"RETURN_MSG", "Please fill in all fields."));
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
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "WALL_MESSAGES_COMMENTS_FOUND"
                                                ,"RETURN_SHOW_PASS_MSG", "FALSE"
                                                , "LIST", $zfmessage->getResults_AllWallMessageComments()));
            }
            else
            {
                $echoret = json_encode(buildReturnArray("RETURN_KEY", "WALL_MESSAGES_COMMENTS_NOT_FOUND"
                                                ,"RETURN_SHOW_PASS_MSG", "TRUE"
                                                ,"RETURN_MSG", "Nothing has posted to your wall yet.  Be the first."));
            }
        }
        else
        {
            $echoret = json_encode(buildReturnArray("RETURN_KEY", "FORM_FIELDS_NOT_VALID"
                                                ,"RETURN_SHOW_PASS_MSG", "TRUE"
                                                ,"RETURN_MSG", "Please fill in all fields."));
        }
    }
}
gdLogEchoReturn($echoret);
echo $echoret;

function validateUploadWallMessageImageForm()
{
    $fv = true;  // Form is Valid Key T=Valid; anything else is invalid;
    if (!isset($_POST["WallMessageContent"]) || $_POST["WallMessageContent"] == "")
        $fv = false;
    return $fv;
}
function validateSaveNewWallMessageForm()
{
    $fv = true;  // Form is Valid Key T=Valid; anything else is invalid;
    if (!isset($_POST["wall_message"]) || $_POST["wall_message"] == "")
        $fv = false;
    else if (!isset($_POST["orig_file_path"]) || $_POST["orig_file_path"] == "")
        $fv = false;
    return $fv;
}
function validateLoadExistingWallMessageForm()
{
    $fv = true;  // Form is Valid Key T=Valid; anything else is invalid;
    if (!isset($_POST["WALL_MESSAGE_CREATEDDT_START"]) || $_POST["WALL_MESSAGE_CREATEDDT_START"] == "")
    {
        $fv = false;
        gdlog()->LogInfo("WALL_MESSAGE_CREATEDDT_START");
    }
    else if (!isset($_POST["WALL_MESSAGE_LID_BYPASS"]) || $_POST["WALL_MESSAGE_LID_BYPASS"] == "")
    {
        $fv = false;
        gdlog()->LogInfo("WALL_MESSAGE_LID_BYPASS");
    }
    return $fv;
}
function validateNewLoadWallMessageForm()
{
    $fv = true;  // Form is Valid Key T=Valid; anything else is invalid;
    if (!isset($_POST["WALL_MESSAGE_CREATEDDT_START"]) || $_POST["WALL_MESSAGE_CREATEDDT_START"] == "")
        $fv = false;
    else if (!isset($_POST["WALL_MESSAGE_LID_BYPASS"]) || $_POST["WALL_MESSAGE_LID_BYPASS"] == "")
        $fv = false;
    return $fv;
}
function validateSaveNewWallMessageCommentForm()
{
    $fv = true;  // Form is Valid Key T=Valid; anything else is invalid;
    if (!isset($_POST["wall_message_uid"]) || $_POST["wall_message_uid"] == "")
        $fv = false;
    else if (!isset($_POST["wall_message_comment"]) || $_POST["wall_message_comment"]== "")
        $fv = false;
    return $fv;
}
function validateLoadWallMessageCommentForm()
{
    $fv = true;  // Form is Valid Key T=Valid; anything else is invalid;
    if (!isset($_POST["wall_message_uid"]) || $_POST["wall_message_uid"] == "")
        $fv = false;
    return $fv;
}
?>