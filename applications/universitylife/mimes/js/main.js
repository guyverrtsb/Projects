/*
 * Use this page for auto loading calls that are used across any page
 */
$(document).ready( function()
{
	$("select").each(function( index )
	{
		if($(this).attr("configuration") != undefined && $(this).attr("configuration").length > 0 )
		{
			buildConfigurationsDropDown($(this));
		}
	});
	
	$("li").each(function( index )
	{
		if($(this).attr("dyncontentkey") != undefined && $(this).attr("dyncontentkey").length > 0 )
		{
			buildDynamicContent($(this));
		}
	});
});

function buildDynamicContent(jqobj)
{
	var dckey = jqobj.attr("dyncontentkey");	// LIST_OF_UNIVERSITIES
	var dcblk = dckey + "_BLOCK";	// LIST_OF_UNIVERSITIES_BLOCK
	clearContentBlocks(dcblk);
    var formdata = gdControllerKey(dckey);
    $.post("/_controls/ajax/SCREEN_CONTROL.php",
    formdata, function(data)
    {
        data = eval("(" + data + ")");
        if(data.RETURN_KEY == "SUCCESS")
    	{
	        $.each(data.RESULT, function(key, val)
	        {
	        	jqobj.after(buildContentBlocksDynamic(data, key, val, dckey, dcblk));
	        });
    	}
    });
}


function buildConfigurationsDropDown(jqobj)
{
	var configuration = jqobj.attr("configuration");
	var group_key = configuration.split("|")[0];
	var default_key = configuration.split("|")[1];
	var onchange_ele_id = null;
	if(configuration.split("|").length == 3)
		onchange_ele_id = configuration.split("|")[2];

	var formdata = gdAddQSNameValue("", "GD_CONTROLLER_KEY", "GET_CONFIGURATION"); 
	formdata = gdAddQSNameValue(formdata, "group_key", group_key); 
    $.post("/_controls/ajax/CONFIGURATION.php",
	formdata, function(data)
	{
    	data = eval("(" + data + ")");
	    if(data.RETURN_KEY == "SUCCESS")
		{
	    	jdata = data.LIST;
	    	jqobj.empty();
	    	$("<option/>").val("")
				.text("Choose---")
				.appendTo(jqobj);
			$.each(jdata, function(key, val)
			{
				var sdesc = eval("val.sdesc");
				var label = eval("val.label");
				if(sdesc != null && label != null)
				{
					var option = $("<option/>")
						.val(sdesc)
						.text(label);
					if(default_key == sdesc)
						option.attr("selected", "selected")
						option.appendTo(jqobj);
				}
				
				if(onchange_ele_id != null)
				{
					jqobj.change(function()
					{
						if(jqobj.val() != "")
						{
							var dobj = $("#" + onchange_ele_id)
							dobj.removeAttr("configuration");
							dobj.attr("configuration", jqobj.val());
							dobj.empty();
							buildConfigurationsDropDown(dobj);
						}
					});
				}
			});
		}
	});
}