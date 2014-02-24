function getWallMessageContentBlock(data, key, val)
{
	uid = eval("val.search_content_uid");
	var cb_li = $("<li/>")
		.attr("id", "sr_cb_" + uid)
		.attr("style", "border-bottom:2px solid red;")
		.attr("class", "sr_cb_even");
	var cb_li_cm = $("<ul/>");
		cb_li_cm.appendTo(cb_li);
	
	//getResultsContentBlockCount(val, "wall_message_uid", "wall_message_lid").appendTo(cb_li_cm);
	getResultsContentBlockMeta(val, "wall_message_uid", "wall_message_createddt", "user_profile_nickname").appendTo(cb_li_cm);
	getResultsContentBlockContent(val, "wall_message_uid", "wall_message_content").appendTo(cb_li_cm);
	getResultsContentBlockImage(val, "wall_message_uid", "wall_message_mimes_uid").appendTo(cb_li_cm);
    //getWallMessageContentBlockComment(wm_uid).appendTo(cb_li_cm);
    return cb_li;
}

function getSearchResultsContentBlock(data, key, val)
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
		getResultsContentBlockTest(val, "group_account_uid").appendTo(cb_li_cm);
		getResultsContentBlockGroupToolbarTop(val, "group_account_uid").appendTo(cb_li_cm);
		getResultsContentBlockMeta(val, "group_account_uid", "group_account_createddt").appendTo(cb_li_cm);
	    getResultsContentBlockContent(val, "group_account_uid", "group_profile_content").appendTo(cb_li_cm);
	    getResultsContentBlockGroupToolbarBotton(val, "group_account_uid").appendTo(cb_li_cm);
    }
	else if(cfg_so_sdesc == "SEARCH_OBJECT_WALL_MESSAGE")
    {
		getResultsContentBlockTest(val, "wall_message_uid").appendTo(cb_li_cm);
		getResultsContentBlockGroupToolbarTop(val, "group_account_uid").appendTo(cb_li_cm);
		getResultsContentBlockMeta(val, "wall_message_uid", "wall_message_createddt").appendTo(cb_li_cm);
       	getResultsContentBlockImage(val, "wall_message_uid", "wall_message_mimes_uid").appendTo(cb_li_cm);
	    getResultsContentBlockContent(val, "wall_message_uid", "wall_message_content").appendTo(cb_li_cm);
	    getResultsContentBlockGroupToolbarBotton(val, "group_account_uid").appendTo(cb_li_cm);
    }

    return cb_li;
}

function getMessageResultsContentBlock(data, key, val)
{
	uid = eval("val.messages_uid");
	var cb_li = $("<li/>")
		.attr("id", "sr_cb_" + uid)
		.attr("style", "border-bottom:2px solid red;")
		.attr("class", "sr_cb_even");
	var cb_li_cm = $("<ul/>");
		cb_li_cm.appendTo(cb_li);
	
	getMessageResultsContentBlockRow(val).appendTo(cb_li_cm);
    return cb_li;
}

function getDynamicResultsContentBlock(data, key, val, dckey, dcitm)
{
	var cb_li = $("<li/>").attr("contentblock", dcitm);
	if(dckey == "LIST_OF_UNIVERSITIES")
		cb_li.text(eval("val.university_account_sdesc"));
	if(dckey == "LIST_OF_JOIN_GROUP_REQUESTS")
		cb_li.text(eval("val.who_gets_approved_user_profile_fname"));
	
    return cb_li;
}

function getMessageResultsContentBlockRow(val)
{
    var cb_li = $("<li/>")
    	.attr("id", "r_cb_message_" + eval("val.messages_uid"));
    
    if(eval("val.messages_isread") == "F")
    	getCBTextSpan("*").appendTo(cb_li);
    else
    	getCBTextSpan(" ").appendTo(cb_li);
    
    var msgtype = eval("val.message_type_cfg_sdesc");
    if(msgtype == "MESSAGE_TYPE_GROUP_JOIN_REQUEST")
    	getCBTextSpan("J").appendTo(cb_li);
    else if(msgtype == "MESSAGE_TYPE_MESSAGE")
    	getCBTextSpan("M").appendTo(cb_li);
    
    getCBTextSpan(eval("val.from_user_account_nickname") + " {" + eval("val.from_user_profile_fname") + "}").appendTo(cb_li);
    
    var subject = eval("val.messages_subject");
    if(subject.length > 50)
    	subject = subject.substring(0, 50) + "...";
	getCBTextSpan(subject).appendTo(cb_li);
    getCBTextSpan("Sent {" + eval("val.messages_createddt") + "}").appendTo(cb_li);
    


    return cb_li;
}

function getResultsContentBlockTest(val, uid)
{
    var cb_li = $("<li/>")
    	.attr("id", "r_cb_test_" + eval("val." + uid));
    getCBTextSpan(eval("val.is_owner_of_group")).appendTo(cb_li);
    getCBTextSpan(eval("val.is_member_of_group")).appendTo(cb_li);
    getCBTextSpan(eval("val.group_account_ldesc")).appendTo(cb_li);
    return cb_li;
}

function getResultsContentBlockMeta(val, uid, createddt)
{
    var cb_li = $("<li/>")
    	.attr("id", "r_cb_meta_" + eval("val." + uid));
    getCBTextSpan(eval("val." + createddt)).appendTo(cb_li);
    getCBTextSpan(eval("val.user_account_nickname")).appendTo(cb_li);
    return cb_li;
}

function getResultsContentBlockCount(val, uid, lid)
{
    var cb_li = $("<li/>")
    	.attr("id", "r_cb_count_" + eval("val." + uid));
    getCBTextSpan("Count :" + eval("val." + lid) + ":").appendTo(cb_li);
    return cb_li;
}

function getResultsContentBlockImage(val, uid, mimesuid)
{
    mimesuid = eval("val." + mimesuid);
    var cb_li = $("<li/>")
		.attr("id", "r_cb_image_" + eval("val." + uid));
    if(mimesuid != "IMAGE_NOT_PROVIDED_FOR_UPLOADED")
	{
	    var cb_li_image = $("<img/>")
	    	.attr("id", "r_cb_li_image_object_" + uid)
	    	.attr("task", "CB_IMAGE")
	    	.attr("loaded", "false")
	    	.attr("loadurl", "/_controls/ajax/DOWNLOAD_MIME.php?MIMEKEY=" + mimesuid)
    		.attr("src", "/_controls/ajax/DOWNLOAD_MIME.php?MIMEKEY=" + mimesuid);
	    cb_li_image.appendTo(cb_li);
	}
    return cb_li;
}

function getResultsContentBlockContent(val, uid, content)
{
    var cb_li = $("<li/>")
		.attr("id", "r_cb_cntnt_" + eval("val." + uid));
    getCBTextSpan(eval("val." + content)).appendTo(cb_li);
	return cb_li;
}

function getWallMessageContentBlockComment(wm_uid)
{
    var wm_cb_li = $("<li/>")
		.attr("id", "wm_cb_comment_" + wm_uid);
	var cb_li_ul = $("<ul/>")
		.appendTo(wm_cb_li);
	
    var wm_cb_comment = $("<li/>")
		.attr("id", "wm_cb_comment" + wm_uid)
		.appendTo(cb_li_ul);
    getCBTextSpan("Comments Area").appendTo(wm_cb_comment);

	return wm_cb_li;
}

function getResultsContentBlockGroupToolbarTop(val, uid)
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
	    	.attr("href", "/_controls/ajax/PAGE_DIRECT.php?GD_CONTROLLER_KEY=GROUP_HOME&ga_uid=" + eval("val." + uid))
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
	        	.attr("href", "/_controls/ajax/PAGE_DIRECT.php?GD_CONTROLLER_KEY=GROUP_HOME&ga_uid=" + eval("val." + uid))
	    		.text("Goto Group")
	    		.appendTo(status);
		}
	}
   
    return cb_li;
}

function getResultsContentBlockGroupToolbarBotton(val, uid)
{
    var cb_li = $("<li/>")
    	.attr("id", "r_cb_toolbarbottom" + eval("val." + uid));
    getCBTextSpan("Number Comments").appendTo(cb_li);
    getCBTextSpan("Show Comments").appendTo(cb_li);
    getCBTextSpan("Write Comment").appendTo(cb_li);
    return cb_li;
}

function getCBTextSpan(text)
{
	return $("<span/>").attr("class", "cb_text").text(text);
}



function getResultsContentBlockRow(rowid)
{
    var cb_li = $("<li/>")
		.attr("id", rowid);
	for (var i = 1; i < arguments.length; i++)
	{
		var text = getCBTextSpan(eval("val." + arguments[i]))
		text.attr("class", arguments[i++])
		text.appendTo(cb_li)
	}
	return cb_li;
}

function clearContentBlocks(contentblock)
{
    $("li[contentblock=" + contentblock + "]").remove();
}
