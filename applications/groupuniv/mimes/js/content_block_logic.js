/*
 * THIS IS FOR PAGE LOGIC.  ON DEMAND CALLS ONLY that are page specific
 * If you want something to Load Automatically across all pages use the main.js
 */
var existing_cbwm_createddt_start = "NOW";
var existing_cbwm_lid_bypass = "";
var new_cbwm_createddt_start = "NOW";
var new_cbwm_lid_bypass = "";
var count_postion = 0;
function gdLoadContentBlocksforExistingWallMessages()
{
    showMessage("#TransactionErr", "&nbsp;");
    var formdata = gdSerialzeControllerKey("#UploadWallFrm", "LOAD_EXISTING_WALL_MESSAGES");
    formdata = gdAddQSNameValue(formdata, "WALL_MESSAGE_CREATEDDT_START", existing_cbwm_createddt_start);
    formdata = gdAddQSNameValue(formdata, "WALL_MESSAGE_LID_BYPASS", existing_cbwm_lid_bypass);
    $.post("/_controls/ajax/WALL_MESSAGE.php",
    formdata, function(data)
    {
        if(isDataMatch(data, "WALL_MESSAGES_NOT_FOUND"))
            showMessage("#TransactionErr", "&nbsp;");
        else if(isDataMatch(data, "TRANSACTION_FAIL"))
            showMessage("#TransactionErr", "Unknown Error:" + data);
        else
        {
            data = eval("(" + data + ")");
            $.each(data, function(key, val)
            {
            	if(new_cbwm_createddt_start == "NOW")
        		{
            		new_cbwm_createddt_start = eval("val.wall_message_createddt")
            		new_cbwm_lid_bypass = eval("val.wall_message_lid")
        		}
        		$("#CEWallMessagesContentBOTTOM").before(getWallMessageContentBlock(data, key, val));
            	existing_cbwm_createddt_start = eval("val.wall_message_createddt");
            	existing_cbwm_lid_bypass = eval("val.wall_message_lid");
            });
        }
    });
}

function gdLoadContentBlocksforNewWallMessages()
{
    showMessage("#TransactionErr", "&nbsp;");
    var formdata = gdSerialzeControllerKey("#UploadWallFrm", "LOAD_NEW_WALL_MESSAGES");
    formdata = gdAddQSNameValue(formdata, "WALL_MESSAGE_CREATEDDT_START", new_cbwm_createddt_start);
    formdata = gdAddQSNameValue(formdata, "WALL_MESSAGE_LID_BYPASS", new_cbwm_lid_bypass);
    $.post("/_controls/ajax/WALL_MESSAGE.php",
    formdata, function(data) {
        if(isDataMatch(data, "WALL_MESSAGES_NOT_FOUND"))
            showMessage("#TransactionErr", "&nbsp;");
        else if(isDataMatch(data, "TRANSACTION_FAIL"))
            showMessage("#TransactionErr", "Unknown Error:" + data);
        else
        {
            data = eval("(" + data + ")");
            $.each(data, function(key, val)
            {
            	$("#CEWallMessagesContentTOP").after(getWallMessageContentBlock(data, key, val));
            	new_cbwm_createddt_start = eval("val.wall_message_createddt");
            	new_cbwm_lid_bypass = eval("val.wall_message_lid");
            });
        }
    });
}

function gdLoadContentBlocksforSearch()
{
    var searchcfg = $("input[name=searchcfg]:checked").attr("id");
    clearContentBlocks("cb_search_result");
    showMessage("#TransactionErr", "&nbsp;");
    var formdata = gdSerialzeControllerKey("#SearchForm", "SEARCH_NON_UNIVERSITY");
    $.post("/_controls/ajax/SEARCH.php",
    formdata, function(data)
    {
        if(isDataMatch(data, "RECORDS_NOT_FOUND"))
            showMessage("#TransactionErr", "No Search Results");
        else if(isDataMatch(data, "FORM_FIELDS_NOT_VALID"))
            showMessage("#TransactionErr", "Fill in fields");
        else if(isDataMatch(data, "TRANSACTION_FAIL"))
            showMessage("#TransactionErr", "Unknown Error:" + data);
        else
        {
            data = eval("(" + data + ")");
            $.each(data, function(key, val)
            {
                $("#CESearchResultsContentBOTTOM").before(getSearchResultsContentBlock(data, key, val));
            });
        }
    });
}

function getSendRequestJoinGroup(group_account_uid, itemid)
{
    showMessage("#TransactionErr", "&nbsp;");
    var formdata = gdControllerKey("JOIN_GROUP_FROM_SEARCH");
    formdata = gdAddQSNameValue(formdata, "GROUP_ACCOUNT_UID", group_account_uid);
    $.post("/_controls/ajax/CONNECTION.php",
    formdata, function(data)
    {
        if(isDataMatch(data, "GROUP_NOT_ADDED"))
            showMessage("#TransactionErr", "No Search Results");
        else if(isDataMatch(data, "TRANSACTION_FAIL"))
            showMessage("#TransactionErr", "Unknown Error:" + data);
        else
        {
            data = eval("(" + data + ")");
        	if(data.status == "P")
        		$("#" + itemid).html("").text("Pending Request");
        }
    });
}

function callDynamicContentBuilder(dyncontentkey)
{
	buildDynamicContent($("li[dyncontentkey=" + dyncontentkey + "]"));	
}