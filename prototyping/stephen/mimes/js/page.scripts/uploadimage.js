$(document).ready(function()
{

});

function gdFuncSaveNewWallMessage(mimepath, wall_message)
{
	// alert("gdFuncSaveNewWallMessage:mimepath:" + mimepath);
	// alert("gdFuncSaveNewWallMessage:wall_message:" + wall_message);
    showMessage("#WallErr", "&nbsp;");
    var formdata = gdSerialzeControllerKey("#UploadWallFrm", "REGISTER_WALL_MESSAGE");
    formdata = gdAddQSNameValue(formdata, "orig_file_path", mimepath);
    formdata = gdAddQSNameValue(formdata, "wall_message", wall_message);
    $.post("/_controls/ajax/WALL_MESSAGE.php",
    formdata, function(data) {
        if(isDataMatch(data, "WALL_MESSAGES_NOT_FOUND"))
            showMessage("#WallErr", "&nbsp;");
        else if(isDataMatch(data, "TRANSACTION_FAIL"))
            showMessage("#WallErr", "Unknown Error:" + data);
        else
        {
        	gdFuncLoadNewWallMessages();
        }
    });
}

function gdFuncSaveNewWallMessageComment(wm_uid)
{
    showMessage("#WallErr", "&nbsp;");
    var content = $("#" + wm_uid + "_comment");
    var formdata = gdSerialzeControllerKey("#UploadWallFrm", "REGISTER_WALL_MESSAGE_COMMENT");
    formdata = gdAddQSNameValue(formdata, "wall_message_uid", wm_uid);
    formdata = gdAddQSNameValue(formdata, "wall_message_comment", content.val());
    $.post("/_controls/ajax/WALL_MESSAGE.php",
    formdata, function(data) {
        if(isDataMatch(data, "WALL_MESSAGES_NOT_FOUND"))
            showMessage("#WallErr", "&nbsp;");
        else if(isDataMatch(data, "TRANSACTION_FAIL"))
            showMessage("#WallErr", "Unknown Error:" + data);
        else
        {
        	$("#" + wm_uid + "_comment_block").remove();
        	gdFuncLoadWallMessageComments(wm_uid, $("#" + wm_uid + "message"));
        }
    });
}

function gdFuncLoadNewWallMessages()
{
    showMessage("#WallErr", "&nbsp;");
    var formdata = gdSerialzeControllerKey("#UploadWallFrm", "LOAD_NEW_WALL_MESSAGES");
    formdata = gdAddQSNameValue(formdata, "DATE_TIME", this.datetime_new);
    // alert("gdFuncLoadNewWallMessages:formdata:" + formdata);
    $.post("/_controls/ajax/WALL_MESSAGE.php",
    formdata, function(data) {
        if(isDataMatch(data, "WALL_MESSAGES_NOT_FOUND"))
            showMessage("#WallErr", "&nbsp;");
        else if(isDataMatch(data, "TRANSACTION_FAIL"))
            showMessage("#WallErr", "Unknown Error:" + data);
        else
        {
            data = eval("(" + data + ")");
            var wm_uid, wm_createddt, up_nickname, wm_content;
            $.each(data, function(key, val)
            {
                wm_uid = eval("val.uid");
                wm_createddt = eval("val.createddt");
                up_nickname = eval("val.nickname");
                wm_content = eval("val.content");
                wm_mimesuid = eval("val.mimes_uid");
                if(wm_uid != null && wm_content != null)
                {
                    var ce_wm_hdr = getWallMessageHeader(wm_uid, wm_createddt, up_nickname);
                        ce_wm_hdr.insertAfter("#CEMessageEntry");
                    
                    var ce_wm_msg = getWallMessage(wm_uid, wm_content);
                        ce_wm_msg.insertAfter(ce_wm_hdr);
                        
                    if(wm_mimesuid != "IMAGE_NOT_PROVIDED_FOR_UPLOADED")
                	{
                    	var ce_wm_image = getWallMessageImage(wm_uid, wm_mimesuid);
                    		ce_wm_image.insertBefore(ce_wm_hdr);
                	}
                    
                    gdFuncLoadWallMessageComments(wm_uid, ce_wm_msg);
                    
                    this.datetime_new = wm_createddt;
                    // alert("gdFuncLoadNewWallMessages:datetime_new:" + datetime_new);
                }
            });
        }
    });
}

function gdFuncLoadExistingWallMessages()
{
    showMessage("#WallErr", "&nbsp;");
    var formdata = gdSerialzeControllerKey("#UploadWallFrm", "LOAD_EXISTING_WALL_MESSAGES");
    formdata = gdAddQSNameValue(formdata, "START_POSITION", start_postion);
    formdata = gdAddQSNameValue(formdata, "COUNT_POSITION", count_postion);
    start_postion = start_postion + 10;
    if(datetime_new == "NO_DATE_SET")
        formdata = gdAddQSNameValue(formdata, "DATE_TIME", "NOW");
    else
        formdata = gdAddQSNameValue(formdata, "DATE_TIME", datetime_new);
    $.post("/_controls/ajax/WALL_MESSAGE.php",
    formdata, function(data) {
        if(isDataMatch(data, "WALL_MESSAGES_NOT_FOUND"))
            showMessage("#WallErr", "&nbsp;");
        else if(isDataMatch(data, "TRANSACTION_FAIL"))
            showMessage("#WallErr", "Unknown Error:" + data);
        else
        {
            data = eval("(" + data + ")");
            var wm_uid, wm_createddt, up_nickname, wm_content, wm_mimesuid;
            $.each(data, function(key, val)
            {
                wm_uid = eval("val.uid");
                wm_createddt = eval("val.createddt");
                up_nickname = eval("val.nickname");
                wm_content = eval("val.content");
                wm_mimesuid = eval("val.mimes_uid");
                if(datetime_existing == null) {
                    datetime_existing = wm_createddt;
                    datetime_new = wm_createddt;
                    // alert("gdFuncLoadExistingWallMessages:datetime_new:" + datetime_new);
                }
                if(wm_uid != null && wm_content != null)
                {
                    var ce_wm_hdr = getWallMessageHeader(wm_uid, wm_createddt, up_nickname);
                        ce_wm_hdr.appendTo("#CBGroupWorkArea");
                    
                    var ce_wm_msg = getWallMessage(wm_uid, wm_content);
                        ce_wm_msg.insertAfter(ce_wm_hdr);
                        
                    if(wm_mimesuid != "IMAGE_NOT_PROVIDED_FOR_UPLOADED")
                	{
                    	var ce_wm_image = getWallMessageImage(wm_uid, wm_mimesuid);
                    		ce_wm_image.insertBefore(ce_wm_hdr);
                	}

                    gdFuncLoadWallMessageComments(wm_uid, ce_wm_msg);
                }
            });
        }
    });
}

function gdFuncLoadWallMessageComments(wm_uid, ce_wm_msg)
{
    showMessage("#WallErr", "&nbsp;");
    var formdata = gdSerialzeControllerKey("#UploadWallFrm", "LOAD_ALL_WALL_MESSAGE_COMMENTS");
    formdata = gdAddQSNameValue(formdata, "wall_message_uid", wm_uid);
    $.post("/_controls/ajax/WALL_MESSAGE.php",
    formdata, function(data) {
        var cmntli = $("<li/>")
			.attr("id", wm_uid + "_comment_block");
	    var cmntul = $("<ul/>")
	    	.addClass("messagecomments");
	    cmntli.append(cmntul);

        if(isDataMatch(data, "WALL_MESSAGE_COMMENTS_NOT_FOUND"))
            showMessage("#WallErr", "&nbsp;");
        else if(isDataMatch(data, "TRANSACTION_FAIL"))
            showMessage("#WallErr", "Unknown Error:" + data);
        else
        {
            data = eval("(" + data + ")");
            var wmc_uid, wmc_createddt, up_nickname, wmc_content;
            $.each(data, function(key, val)
            {
                wmc_uid = eval("val.uid");
                wmc_createddt = eval("val.createddt");
                up_nickname = eval("val.nickname");
                wmc_content = eval("val.content");
                if(wmc_uid != null && wmc_content != null)
                {
                	var wmc_obj = getWallMessageComment(wmc_uid, wmc_createddt, wmc_content);
                	cmntul.append(wmc_obj);
                }
            });
        }

        var ce_wm_cmntentry = getWallMessageCommentEntry(wm_uid); 
        cmntul.append(ce_wm_cmntentry);
        
        cmntli.insertAfter(ce_wm_msg);
    });
}