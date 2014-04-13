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
		else if($(this).attr("dyncontentkey_gdtrxncom") != undefined && $(this).attr("dyncontentkey_gdtrxncom").length > 0 )
			buildDynamicGdtrxnComContent($(this));
		else if($(this).attr("class") == "message")
			buildDynamicMessage($(this).parent());
	});
}

function buildDynamicDropDown(jqobj)
{
	var dckey = jqobj.attr("dyndropdownkey");
	jqobj.empty();
    $.post("/_controls/ajax/SCREEN_CONTROL.php", gdSearializeControlKey(dckey), function(data)
    {
        data = eval("(" + data + ")");
        if(data.RETURN_KEY == "SUCCESS")
    	{
        	jqobj.append($("<option/>").val("").text("Choose---"));
	        $.each(data.RESULT, function(key, val)
	        {
        		jqobj.append(buildDynamicDropDownElements(data, key, val, dckey));
	        });
    	}
    });
}

function buildDynamicContent(jqobj)
{
	var passdata = gdSearializeControlKey(jqobj.attr("dyncontentkey"));
	if(jqobj.attr("dyncontentqs"))
		passdata = passdata + "&" + jqobj.attr("dyncontentqs");
    $.post("/_controls/ajax/SCREEN_CONTROL.php", passdata, function(data)
    {
        data = eval("(" + data + ")");
        if(data.RETURN_KEY == "SUCCESS")
    	{
        	if(jqobj.attr("funcname") != null && jqobj.attr("funcname").length > 0)
        		eval(jqobj.attr("funcname") + "(jqobj, data)");
        	else
        		buildContent(jqobj, data);    	}
    });
}

function buildDynamicGdtrxnComContent(jqobj)
{
	var passdata = gdSearializeControlKey(jqobj.attr("dyncontentkey_gdtrxncom"));
	if(jqobj.attr("dyncontentqs"))
		passdata = passdata + "&" + jqobj.attr("dyncontentqs");
    $.post("/gd.trxn.com/_controls/ajax/SCREEN_CONTROL.php", passdata, function(data)
    {
        data = eval("(" + data + ")");
        if(data.RETURN_KEY == "SUCCESS")
    	{
        	if(jqobj.attr("funcname") != null && jqobj.attr("funcname").length > 0)
        		eval(jqobj.attr("funcname") + "(jqobj, data)");
        	else
        		buildContent(jqobj, data);
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

	var data = gdSerialize("group_key", group_key, "GD_CONTROL_KEY", "GET_CONFIGURATION"); 
    $.post("/_controls/ajax/CONFIGURATION.php", data, function(data)
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
	jqobj.children().each(function ()
	{
	    if($(this).attr("class") == "message")
	    	if($(this).attr("UIPAGERESKEY") != "" && $(this).attr("UIPAGERESSHOW") == "TRUE")
	    		$(this).html($(this).attr("UIPAGERESMSG") + ": " + $(this).attr("UIPAGERESCODE") + ": " + $(this).attr("UIPAGERESKEY"));
	});
}

/*
 * 1. Clear Transaction Output (data == null)
 * 2. 
 */
function buildContentBlockReturnMessage(data, matchValue, peleid)
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
		var jqobj = $("#CB_" + peleid);
		jqobj.children().each(function ()
		{
		    if($(this).attr("class") == "message")
	    	{
		    	$(this).attr("UIPAGERESSHOW", data.RETURN_SHOW_MSG);
		    	$(this).attr("UIPAGERESCODE", "200");
		    	$(this).attr("UIPAGERESKEY", data.RETURN_KEY);
		    	$(this).attr("UIPAGERESMSG", data.RETURN_MSG);
		    	buildDynamicMessage(jqobj);
	    	}
		});
		return passKey;
	}
	return false;
}

function appendContentBlockReturnMessageObject(peleid, jobj)
{
	var jqobj = $("#CB_" + peleid);
	jqobj.children().each(function ()
	{
	    if($(this).attr("class") == "message")
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