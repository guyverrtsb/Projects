/*
 * THIS IS FOR PAGE LOGIC.  ON DEMAND CALLS ONLY that are page specific
 * If you want something to Load Automatically across all pages use the main.js
 */
var existing_cbwm_createddt_start = "NOW";
var existing_cbwm_lid_bypass = "EMPTY";
var new_cbwm_createddt_start = "NOW";
var new_cbwm_lid_bypass = "EMPTY";
var count_postion = 0;
function gdLoadExistingWallMessages()
{
	buildContentBlocksReturnMessage();
    var formdata = gdSerialzeControllerKey("#UploadWallFrm", "LOAD_EXISTING_WALL_MESSAGES");
    formdata = gdAddQSNameValue(formdata, "WALL_MESSAGE_CREATEDDT_START", existing_cbwm_createddt_start);
    formdata = gdAddQSNameValue(formdata, "WALL_MESSAGE_LID_BYPASS", existing_cbwm_lid_bypass);
    $.post("/_controls/ajax/WALL_MESSAGE.php",
    formdata, function(data)
    {
        data = eval("(" + data + ")");
        if(buildContentBlocksReturnMessage(data, "WALL_MESSAGES_FOUND"))
        {
            $.each(data.LIST, function(key, val)
            {
            	if(new_cbwm_createddt_start == "NOW")
        		{
            		new_cbwm_createddt_start = eval("val.wall_message_createddt")
            		new_cbwm_lid_bypass = eval("val.wall_message_lid")
        		}
        		$("#CEResultsBOTTOM").before(buildContentBlocksWallMessage(data, key, val));
            	existing_cbwm_createddt_start = eval("val.wall_message_createddt");
            	existing_cbwm_lid_bypass = eval("val.wall_message_lid");
            });
        }
    });
}

function gdLoadNewWallMessages()
{
    showMessage("#TransactionOutput", "&nbsp;");
    var formdata = gdSerialzeControllerKey("#UploadWallFrm", "LOAD_NEW_WALL_MESSAGES");
    formdata = gdAddQSNameValue(formdata, "WALL_MESSAGE_CREATEDDT_START", new_cbwm_createddt_start);
    formdata = gdAddQSNameValue(formdata, "WALL_MESSAGE_LID_BYPASS", new_cbwm_lid_bypass);
    $.post("/_controls/ajax/WALL_MESSAGE.php",
    formdata, function(data)
    {
        data = eval("(" + data + ")");
        if(buildContentBlocksReturnMessage(data, "WALL_MESSAGES_FOUND"))
        {
            $.each(data.LIST, function(key, val)
            {
            	$("#CEResultsTOP").after(buildContentBlocksWallMessage(data, key, val));
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
    showMessage("#TransactionOutput", "&nbsp;");
    var formdata = gdSerialzeControllerKey("#SearchForm", "SEARCH_NON_UNIVERSITY");
    $.post("/_controls/ajax/SEARCH.php",
    formdata, function(data)
    {
        data = eval("(" + data + ")");
        if(buildContentBlocksReturnMessage(data, "RESULTS_FOUND"))
        {
            $.each(data.LIST, function(key, val)
            {
                $("#CEResultsBOTTOM").before(buildContentBlocksSearch(data, key, val));
            });
        }
    });
}

function getSendRequestJoinGroup(group_account_uid, itemid)
{
	buildContentBlocksReturnMessage();
    var formdata = gdControllerKey("JOIN_GROUP_FROM_SEARCH");
    formdata = gdAddQSNameValue(formdata, "GROUP_ACCOUNT_UID", group_account_uid);
    $.post("/_controls/ajax/CONNECTION.php",
    formdata, function(data)
    {
        data = eval("(" + data + ")");
        if(buildContentBlocksReturnMessage(data, "SUCCESS"))
        {
        	if(data.RECORD.status == "P")
        		$("#" + itemid).html("").text("Pending Request");
        }
    });
}

function gdLoadContentBlocksforMessages()
{
	buildContentBlocksReturnMessage();
    var formdata = gdControllerKey("GET_LIST_OF_MESSAGES");
    $.post("/_controls/ajax/MESSAGES.php",
    formdata, function(data)
    {
        data = eval("(" + data + ")");
        if(buildContentBlocksReturnMessage(data, "SUCCESS"))
        {
            $.each(data.LIST, function(key, val)
            {
                $("#CEResultsBOTTOM").before(buildContentBlocksMessage(data, key, val));
            });
        }
    });
}

function callDynamicContentBuilder(dyncontentkey)
{
	buildDynamicContent($("li[dyncontentkey=" + dyncontentkey + "]"));	
}