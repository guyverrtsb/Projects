/*
 * THIS IS FOR PAGE LOGIC.  ON DEMAND CALLS ONLY that are page specific
 * If you want something to Load Automatically across all pages use the main.js
 */
function gdLoadContentBlocksforSearch()
{
    var searchcfg = $("input[name=searchcfg]:checked").attr("id");
    clearContentBlocks("cb_search_result");
    showMessage("#TransactionOutput", "&nbsp;");
    var formdata = gdSerialzeControlKey("#SearchForm", "SEARCH_NON_UNIVERSITY");
    $.post("/_controls/ajax/SEARCH.php",
    formdata, function(data)
    {
        data = eval("(" + data + ")");
        if(buildContentBlockReturnMessage(data, "RESULTS_FOUND"))
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
	buildContentBlockReturnMessage();
    var formdata = gdSerialzeControlKey("JOIN_GROUP_FROM_SEARCH");
    formdata = gdAddQSNameValue(formdata, "GROUP_ACCOUNT_UID", group_account_uid);
    $.post("/_controls/ajax/CONNECTION.php",
    formdata, function(data)
    {
        data = eval("(" + data + ")");
        if(buildContentBlockReturnMessage(data, "SUCCESS"))
        {
        	if(data.RECORD.status == "P")
        		$("#" + itemid).html("").text("Pending Request");
        }
    });
}

function gdLoadContentBlocksforMessages()
{
	buildContentBlockReturnMessage();
    var formdata = gdSerialzeControlKey("GET_LIST_OF_MESSAGES");
    $.post("/_controls/ajax/MESSAGES.php",
    formdata, function(data)
    {
        data = eval("(" + data + ")");
        if(buildContentBlockReturnMessage(data, "SUCCESS"))
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