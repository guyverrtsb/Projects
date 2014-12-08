var existing_cbwm_createddt_start = "NOW";
var existing_cbwm_lid_bypass = "EMPTY";
var new_cbwm_createddt_start = "NOW";
var new_cbwm_lid_bypass = "EMPTY";
var count_postion = 0;
function gdLoadExistingWallMessages()
{
	buildContentBlockReturnMessage();
    var formdata = gdSerialzeControlKey("LOAD_EXISTING_WALL_MESSAGES");
    formdata = formdata + "&" + "WALL_MESSAGE_CREATEDDT_START" + "=" + existing_cbwm_createddt_start;
    formdata = formdata + "&" + "WALL_MESSAGE_LID_BYPASS" + "=" + existing_cbwm_lid_bypass;
    $.post("/_controls/ajax/WALL_MESSAGE.php",
    formdata, function(data)
    {
        data = eval("(" + data + ")");
        if(buildContentBlockReturnMessage(data, "WALL_MESSAGES_FOUND"))
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
    var formdata = gdSerialzeControlKey("#UploadWallFrm", "LOAD_NEW_WALL_MESSAGES");
    formdata = gdAddQSNameValue(formdata, "WALL_MESSAGE_CREATEDDT_START", new_cbwm_createddt_start);
    formdata = gdAddQSNameValue(formdata, "WALL_MESSAGE_LID_BYPASS", new_cbwm_lid_bypass);
    $.post("/_controls/ajax/WALL_MESSAGE.php",
    formdata, function(data)
    {
        data = eval("(" + data + ")");
        if(buildContentBlockReturnMessage(data, "WALL_MESSAGES_FOUND"))
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
