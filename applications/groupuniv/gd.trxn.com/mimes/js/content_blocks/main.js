/*
 * Use this page for auto loading calls that are used across any page
 */
$(document).ready( function()
{
	buildForm();
	loadDynamicPageElements();
});

function loadDynamicPageElements()
{
	$("select").each(function( index )
	{
		if($(this).attr("configuration") != undefined && $(this).attr("configuration").length > 0 )
			buildConfigurationsDropDown($(this));
		else if($(this).attr("dyndropdownkey") != undefined && $(this).attr("dyndropdownkey").length > 0 )
			buildDynamicDropDown($(this));
	});
	
	$("li, div").each(function( index )
	{
		if($(this).attr("dyncontentkey") != undefined && $(this).attr("dyncontentkey").length > 0 )
			buildDynamicContent($(this));
		else if($(this).attr("id") == "messageline")
			buildDynamicMessage($(this));
	});
}

function loadDynamicContent(dckey)
{
	$("li, div").each(function( index )
	{
		if($(this).attr("dyncontentkey") != undefined && $(this).attr("dyncontentkey").length > 0 && $(this).attr("dyncontentkey") == dckey)
			buildDynamicContent($(this));
	});
}

function buildDynamicDropDown(jqobj)
{
	var apppath = "";
	if(jqobj.attr("apppath"))
		apppath = jqobj.attr("apppath");
	
	var dckey = jqobj.attr("dyndropdownkey");
	jqobj.empty();
	
    $.post(apppath + "/_controls/ajax/SCREEN_CONTROL.php", gdSerialzeControlKey(dckey), function(data)
    {
        data = eval("(" + data + ")");
        if(data.RETURN_KEY == "SUCCESS")
    	{
        	if(jqobj.attr("funcname"))
    		{
            	jqobj.append($("<option/>").val("").text("Choose---"));
    	        $.each(data.RESULT, function(key, val)
    	        {
            		jqobj.append(eval(jqobj.attr("funcname") + "(jqobj, data, key, val, dckey)"));
    	        });
    		}
        	else
    		{
            	jqobj.append($("<option/>").val("").text("Choose---"));
    	        $.each(data.RESULT, function(key, val)
    	        {
            		jqobj.append(buildDynamicDropDownElements(jqobj, data, key, val, dckey));
    	        });
    		}
    	}
    });
}

function buildDynamicContent(jqobj)
{
	var apppath = "";
	if(jqobj.attr("apppath"))
		apppath = jqobj.attr("apppath");
	
	var passdata = gdSerialzeControlKey(jqobj.attr("dyncontentkey"));
	if(jqobj.attr("dyncontentqs"))
		passdata = passdata + "&" + jqobj.attr("dyncontentqs");
    $.post(apppath + "/_controls/ajax/SCREEN_CONTROL.php", passdata, function(data)
    {
        data = eval("(" + data + ")");
        if(data.RETURN_KEY == "SUCCESS")
    	{
        	if(jqobj.attr("funcname"))
        		eval(jqobj.attr("funcname") + "(jqobj, data)");
        	else
        		buildContent(jqobj, data);
    	}
    });
}

function designDynamicContent(eleid, dyncontentkey, funcname, dyncontentqs)
{
	var wcr = $("#" + eleid)
		.attr("dyncontentkey",dyncontentkey)
		.attr("funcname",funcname)
		.attr("dyncontentqs",dyncontentqs);
	buildDynamicContent(wcr);
}

function buildConfigurationsDropDown(jqobj)
{
	var apppath = "";
	if(jqobj.attr("apppath"))
		apppath = jqobj.attr("apppath");

	var configuration = jqobj.attr("configuration");
	var group_key = configuration.split("|")[0];
	var default_key = configuration.split("|")[1];
	var onchange_ele_id = null;
	if(configuration.split("|").length == 3)
		onchange_ele_id = configuration.split("|")[2];

	var data = gdSerialize("group_key", group_key, "GD_CONTROL_KEY", "GET_CONFIGURATION"); 
    $.post(apppath + "/_controls/ajax/CONFIGURATION.php", data, function(data)
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
				var value = eval("val.sdesc");
				var label = eval("val.label");
				if(value != null && label != null)
				{
					var option = $("<option/>")
						.val(value)
						.text(label);
					if(default_key == value)
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

function buildDynamicMessage(jqobj)
{
	var showmessageline = false;
	jqobj.children().each(function ()
	{
    	if($(this).attr("UIPAGERESKEY") != "" && $(this).attr("UIPAGERESSHOW") == "TRUE")
    	{
    		$(this).html($(this).attr("UIPAGERESMSG") + ": " + $(this).attr("UIPAGERESCODE") + ": " + $(this).attr("UIPAGERESKEY") + ": " + $(this).attr("UIPAGERESSHOW"));
    		$(this).css("display", "block");
    		showmessageline = true;
    	}
    	else
		{
    		$(this).css("display", "none");
		}
	});
	
	if(showmessageline)
	{
		jqobj.css("display", "block");
	}
	else
	{
		jqobj.css("display", "none");
	}
	
}

/*
 * 1. Clear Transaction Output (data == null)
 * 2. 
 */
function buildContentBlockReturnMessage(data, matchValue)
{
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
		
		var jqobj = $("#messageline");
		jqobj.empty();
		jqobj.css("display", "none");
		var p = $("<p/>");
	    	p.attr("UIPAGERESSHOW", data.RETURN_SHOW_MSG);
	    	p.attr("UIPAGERESCODE", "200");
	    	p.attr("UIPAGERESKEY", data.RETURN_KEY);
	    	p.attr("UIPAGERESMSG", data.RETURN_MSG);
    	jqobj.append(p);
    	buildDynamicMessage(jqobj);
		return passKey;
	}
	else
	{
		if(matchValue == null || matchValue.toUpperCase() == "RESET")
		{
			var jqobj = $("#messageline");
			jqobj.empty();
			jqobj.css("display", "none");
		}
	}
	return false;
}

function appendContentBlockReturnMessageObject(matchValue, jobj)
{
	var jqobj = $("#messageline");
	jqobj.children().each(function ()
	{
	    if($(this).attr("UIPAGERESKEY") == matchValue)
    	{
	    	$(this).append(jobj);
    	}
	});
}

function buildContentBlocksDynamic(data, key, val, dckey, dcitm)
{
	var cb_li = $("<li/>").attr("contentblock", dcitm);
    return cb_li;
}