function buildContentBlocksWallMessage(data, key, val)
{
	uid = eval("val.search_content_uid");
	var cb_li = $("<li/>")
		.attr("id", "sr_cb_" + uid)
		.attr("style", "border-bottom:2px solid red;")
		.attr("class", "sr_cb_even");
	var cb_li_cm = $("<ul/>");
		cb_li_cm.appendTo(cb_li);
	
	getContentElementsMeta(val, "wall_message_uid", "wall_message_createddt", "user_profile_nickname").appendTo(cb_li_cm);
	getContentElementsContent(val, "wall_message_uid", "wall_message_content").appendTo(cb_li_cm);
	getContentElementsImageScaled(val, "wall_message_uid", "wall_message_mimes_uid").appendTo(cb_li_cm);
    return cb_li;
}

function buildContentBlocksSearch(data, key, val)
{
	cfg_so_sdesc = eval("val.cfg_search_objects_sdesc");
	uid = eval("val.search_content_uid");
	var cb_li = $("<li/>")
		.attr("id", "sr_cb_" + uid)
		.attr("style", "border-bottom:2px solid red;")
		.attr("class", "cb_even")
		.attr("contentblock", "cb_search_result");
	var cb_li_cm = $("<ul/>");
		cb_li_cm.appendTo(cb_li);
		
	if(cfg_so_sdesc == "SEARCH_OBJECT_GROUP")
    {
		getContentElementsTest(val, "group_account_uid").appendTo(cb_li_cm);
		getContentElementsToolbarTop(val, "group_account_uid").appendTo(cb_li_cm);
		getContentElementsMeta(val, "group_account_uid", "group_account_createddt").appendTo(cb_li_cm);
		getContentElementsContent(val, "group_account_uid", "group_profile_content").appendTo(cb_li_cm);
	    getContentElementsToolbarBotton(val, "group_account_uid").appendTo(cb_li_cm);
    }
	else if(cfg_so_sdesc == "SEARCH_OBJECT_WALL_MESSAGE")
    {
		getContentElementsTest(val, "wall_message_uid").appendTo(cb_li_cm);
		getContentElementsToolbarTop(val, "group_account_uid").appendTo(cb_li_cm);
		getContentElementsMeta(val, "wall_message_uid", "wall_message_createddt").appendTo(cb_li_cm);
		getContentElementsImageScaled(val, "wall_message_uid", "wall_message_mimes_uid").appendTo(cb_li_cm);
       	getContentElementsContent(val, "wall_message_uid", "wall_message_content").appendTo(cb_li_cm);
       	getContentElementsToolbarBotton(val, "group_account_uid").appendTo(cb_li_cm);
    }

    return cb_li;
}

function buildContentBlocksMessage(data, key, val)
{
	uid = eval("val.messages_uid");
	var cb_li = $("<li/>")
		.attr("id", "sr_cb_" + uid)
		.attr("style", "border-bottom:2px solid red;")
		.attr("class", "sr_cb_even");
	var cb_li_cm = $("<ul/>");
		cb_li_cm.appendTo(cb_li);
	
		getContentElementsMessageRow(val).appendTo(cb_li_cm);
    return cb_li;
}

/*
 * 1. Clear Transaction Output (data == null)
 * 2. 
 */
function buildContentBlocksReturnMessage(data, matchValue, eleid)
{
	if(eleid == null)
		eleid = "TransactionOutput";
	var cb_li = $("#" + eleid);
	cb_li.empty();
	cb_li.html("&nbsp;");
	cb_li.attr("style", "border:0px;")

	if(data != null)	// no data assume a clearing of the output
	{
		if(matchValue == true)
		{
			passKey = true;
		}
		else if(matchValue == false)
		{
			passKey = false;
		}
		else
		{
			if(matchValue.toUpperCase() == data.RETURN_KEY)	// return key matches the 
				passKey = true;
			else if(matchValue.toUpperCase() != data.RETURN_KEY)
				passKey = false;
		}

		// Show Message
		if(data.RETURN_SHOW_PASS_MSG == "TRUE")
		{
			cb_li.empty();
			cb_li.attr("style", "border:2px solid red;")
			cb_li.attr("class", "returnmsg");
			if(data.RETURN_MSG != null)
				getContentElementsTextSpan(data.RETURN_MSG).appendTo(cb_li);
			else
				getContentElementsTextSpan("No RETURN_MSG Associated.  RETURN_KEY{" + data.RETURN_KEY + "}").appendTo(cb_li);
		}
		return passKey;
	}
	return false;
}

function getContentElementsMessageRow(val)
{
    var cb_li = $("<li/>")
    	.attr("id", "r_cb_message_" + eval("val.messages_uid"));
    
    if(eval("val.messages_isread") == "F")
    	getContentElementsTextSpan("*").appendTo(cb_li);
    else
    	getContentElementsTextSpan(" ").appendTo(cb_li);
    
    var msgtype = eval("val.message_type_cfg_sdesc");
    if(msgtype == "MESSAGE_TYPE_GROUP_JOIN_REQUEST")
    	getContentElementsTextSpan("J").appendTo(cb_li);
    else if(msgtype == "MESSAGE_TYPE_MESSAGE")
    	getContentElementsTextSpan("M").appendTo(cb_li);
    
    getContentElementsTextSpan(eval("val.from_user_account_nickname") + " {" + eval("val.from_user_profile_fname") + "}").appendTo(cb_li);
    
    var subject = eval("val.messages_subject");
    if(subject.length > 50)
    	subject = subject.substring(0, 50) + "...";
	getContentElementsTextSpan(subject).appendTo(cb_li);
    getContentElementsTextSpan("Sent {" + eval("val.messages_createddt") + "}").appendTo(cb_li);
    return cb_li;
}

function getContentElementsMeta(val, uid, createddt)
{
    var cb_li = $("<li/>")
    	.attr("id", "r_cb_meta_" + eval("val." + uid));
    getContentElementsTextSpan(eval("val." + createddt)).appendTo(cb_li);
    getContentElementsTextSpan(eval("val.user_account_nickname")).appendTo(cb_li);
    return cb_li;
}

function getContentElementsContent(val, uid, content)
{
    var cb_li = $("<li/>")
		.attr("id", "r_cb_cntnt_" + eval("val." + uid));
    getContentElementsTextSpan(eval("val." + content)).appendTo(cb_li);
	return cb_li;
}

function getContentElementsImage(val, uid, mimesuid)
{
    mimesuid = eval("val." + mimesuid);
    var cb_li = $("<li/>")
		.attr("id", "r_cb_image_" + eval("val." + uid));
    if(mimesuid != "MIME_NOT_PROVIDED_FOR_UPLOADED")
	{
	    var cb_li_image = $("<img/>")
	    	.attr("id", "r_cb_li_image_object_" + uid)
	    	.attr("task", "CB_IMAGE")
	    	.attr("loaded", "false")
	    	.attr("loadurl", "/_controls/ajax/DOWNLOAD_MIME.php?TYPE=IMAGE&VERSION=ORIGINAL&MIMEKEY=" + mimesuid)
    		.attr("src", "/_controls/ajax/DOWNLOAD_MIME.php?TYPE=IMAGE&VERSION=ORIGINAL&MIMEKEY=" + mimesuid);
	    cb_li_image.appendTo(cb_li);
	}
    return cb_li;
}

function getContentElementsImageScaled(val, uid, mimesuid)
{
    mimesuid = eval("val." + mimesuid);
    var cb_li = $("<li/>")
		.attr("id", "r_cb_image_" + eval("val." + uid));
    if(mimesuid != "MIME_NOT_PROVIDED_FOR_UPLOADED")
	{
	    var cb_li_image = $("<img/>")
	    	.attr("id", "r_cb_li_image_object_" + uid)
	    	.attr("task", "CB_IMAGE")
	    	.attr("loaded", "false")
	    	.attr("loadurl", "/_controls/ajax/DOWNLOAD_MIME.php?TYPE=IMAGE&VERSION=SCALED&MIMEKEY=" + mimesuid)
    		.attr("src", "/_controls/ajax/DOWNLOAD_MIME.php?TYPE=IMAGE&VERSION=SCALED&MIMEKEY=" + mimesuid);
	    cb_li_image.appendTo(cb_li);
	}
    return cb_li;
}

function getContentElementsImageThumbnail(val, uid, mimesuid)
{
    mimesuid = eval("val." + mimesuid);
    var cb_li = $("<li/>")
		.attr("id", "r_cb_image_" + eval("val." + uid));
    if(mimesuid != "MIME_NOT_PROVIDED_FOR_UPLOADED")
	{
	    var cb_li_image = $("<img/>")
	    	.attr("id", "r_cb_li_image_object_" + uid)
	    	.attr("task", "CB_IMAGE")
	    	.attr("loaded", "false")
	    	.attr("loadurl", "/_controls/ajax/DOWNLOAD_MIME.php?TYPE=IMAGE&VERSION=THUMBNAIL&MIMEKEY=" + mimesuid)
    		.attr("src", "/_controls/ajax/DOWNLOAD_MIME.php?TYPE=IMAGE&VERSION=THUMBNAIL&MIMEKEY=" + mimesuid);
	    cb_li_image.appendTo(cb_li);
	}
    return cb_li;
}

function getContentElementsTest(val, uid)
{
    var cb_li = $("<li/>")
    	.attr("id", "r_cb_test_" + eval("val." + uid));
    getContentElementsTextSpan(eval("val.is_owner_of_group")).appendTo(cb_li);
    getContentElementsTextSpan(eval("val.is_member_of_group")).appendTo(cb_li);
    getContentElementsTextSpan(eval("val.group_account_ldesc")).appendTo(cb_li);
    return cb_li;
}

function getContentElementsToolbarTop(val, uid)
{
    var cb_li = $("<li/>")
    	.attr("id", "r_cb_status" + eval("val." + uid));
    var status = $("<span/>")
    	.attr("id", "r_cb_ce_status" + eval("val." + uid))
		.attr("class", "cb_text")
		.appendTo(cb_li);
    
    if(eval("val.is_member_of_group") == "USER_IS_MEMBER")
	{
    	$("<a/>")
	    	.attr("href", "/_controls/ajax/PAGE_DIRECT.php?GD_CONTROL_KEY=GROUP_HOME&ga_uid=" + eval("val." + uid))
			.text("Goto Group")
			.appendTo(status);
	}
    else
	{
    	var request_status = val.request_status;
    	if(request_status == null)	// No request has been made
		{
    		$("<a/>")
		    	.attr("href", "javascript:void(0);")
		    	.click(function() {
		    		getSendRequestJoinGroup(eval("val." + uid), "r_cb_ce_status" + eval("val." + uid));
		    	}).text("Join Group")
				.appendTo(status);
		}
    	else if(request_status == "D")	// Declined
		{
    		$("<a/>")
		    	.attr("href", "javascript:void(0);")
		    	.click(function() {
		    		getSendRequestJoinGroup(eval("val." + uid), "r_cb_ce_status" + eval("val." + uid));
		    	}).text("Join Group")
				.appendTo(status);
		}
    	else if(request_status == "P")	// Pending
		{
    		status
	    		.attr("class", "cb_text")
	    		.text("Pending Request")
	    		.appendTo(cb_li);
		}
    	else if(request_status == "A")	// Accepted
		{
    		$("<a/>")
	        	.attr("href", "/_controls/ajax/PAGE_DIRECT.php?GD_CONTROL_KEY=GROUP_HOME&ga_uid=" + eval("val." + uid))
	    		.text("Goto Group")
	    		.appendTo(status);
		}
	}
   
    return cb_li;
}

function getContentElementsToolbarBotton(val, uid)
{
    var cb_li = $("<li/>")
    	.attr("id", "r_cb_toolbarbottom" + eval("val." + uid));
    getContentElementsTextSpan("Number Comments").appendTo(cb_li);
    getContentElementsTextSpan("Show Comments").appendTo(cb_li);
    getContentElementsTextSpan("Write Comment").appendTo(cb_li);
    return cb_li;
}

function getContentElementsCount(val, uid, lid)
{
    var cb_li = $("<li/>")
    	.attr("id", "r_cb_count_" + eval("val." + uid));
    getContentElementsTextSpan("Count :" + eval("val." + lid) + ":").appendTo(cb_li);
    return cb_li;
}

function getContentElementsComment(wm_uid)
{
    var wm_cb_li = $("<li/>")
		.attr("id", "wm_cb_comment_" + wm_uid);
	var cb_li_ul = $("<ul/>")
		.appendTo(wm_cb_li);
	
    var wm_cb_comment = $("<li/>")
		.attr("id", "wm_cb_comment" + wm_uid)
		.appendTo(cb_li_ul);
    getContentElementsTextSpan("Comments Area").appendTo(wm_cb_comment);

	return wm_cb_li;
}

function getContentElementsTextSpan(text)
{
	return $("<span/>").attr("class", "cb_text").text(text);
}

function getContentElementsRow(rowid)
{
    var cb_li = $("<li/>")
		.attr("id", rowid);
	for (var i = 1; i < arguments.length; i++)
	{
		var text = getContentElementsTextSpan(eval("val." + arguments[i]))
		text.attr("class", arguments[i++])
		text.appendTo(cb_li)
	}
	return cb_li;
}

function clearContentBlocks(contentblock)
{
    $("li[contentblock=" + contentblock + "]").remove();
}