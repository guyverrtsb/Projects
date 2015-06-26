/** Use this to override the Content Block Dynamic Content Tool.  make this specific to your application **/
function buildDynamicContentBlockElements(data, key, val, dckey, dcitm)
{
	var cb_li = $("<li/>").attr("contentblock", dcitm);
	if(dckey == "LIST_OF_BILLTOS")
		cb_li.text(eval("val.companyname"));
	else if(dckey == "LIST_OF_CLIENTS")
		cb_li.text(eval("val.companyname"));
	else if(dckey == "LIST_OF_PROJECTS")
		cb_li.text(eval("val.sdesc"));

    return cb_li;
}

function buildDynamicDropDownElements(data, key, val, dckey)
{
	var dd_value = $("<option/>");
	if(dckey == "LIST_OF_BILLTOS")
	{
		dd_value.val(val.uid);
		dd_value.text(val.companyname);
	}
	else if(dckey == "LIST_OF_CLIENTS")
	{
		dd_value.val(val.uid);
		dd_value.text(val.companyname);
	}
	else if(dckey == "LIST_OF_PROJECTS")
	{
		dd_value.val(val.uid);
		dd_value.text(val.sdesc);
	}
    return dd_value;
}

function buildDynamicMenuElements(jqobj, data, key, val)
{
	var dckey = jqobj.attr("dyncontentkey");
	var dcitm = dckey + "_MENUITEM";
    $("li[contentblock=" + dcitm + "]").remove();
    
    $.each(data.RESULT, function(key, val)
    {

    	var cb_li = $("<li/>").attr("contentblock", dcitm);
    	
    	if(dckey == "LIST_OF_BILLTOS")
    		cb_li.text(eval("val.companyname"));
    	else if(dckey == "LIST_OF_CLIENTS")
    		cb_li.text(eval("val.companyname"));
    	else if(dckey == "LIST_OF_PROJECTS")
    		cb_li.text(eval("val.sdesc"));

    	var newjqobj = cb_li;
    	jqobj.after(newjqobj);
    	jqobj = newjqobj;
    	
    });
}

function loadList(obj, funcname)
{
	var jqobj = $("#" + obj.id);
    $.post("/_controls/ajax/SCREEN_CONTROL.php", gdSearializeControlKey(jqobj.attr()), function(data)
    {
        data = eval("(" + data + ")");
        if(data.RETURN_KEY == "SUCCESS")
    	{
	        $.each(data.RESULTS, function(key, val)
	        {
	        	eval(funcname + "(key, val)");
	        });
    	}
    });
}

function loadFormData(obj, funcname)
{
	$.each($("input, select ,textarea", "#FORM_update"),function(k)
	{
		var name = $(this).attr("name");
		if(name != "GD_CONTROL_KEY" && name != obj.name)
			$(this).attr("value", "");
	});
	var jqobj = $("#" + obj.id);
    $.post("/_controls/ajax/SCREEN_CONTROL.php", gdSerialize("account_uid", jqobj.val(), "GD_CONTROL_KEY", "LOAD_DATA_FOR_" + getGDControlKey("update")), function(data)
    {
        data = eval("(" + data + ")");
        if(data.RETURN_KEY == "SUCCESS")
    	{
	        $.each(data.RESULT, function(key, val)
	        {
	        	// alert("key:{" + key + "}\nval:{" + val + "}");
	        	$("#update" + key).val(val);
        	});
    	}
    });
}

function gdFuncRegisterData()
{
    buildContentBlockReturnMessage();
    $.post("/_controls/ajax/ACCOUNTING.php", gdSerialize("register"), function(data)
    {
        data = eval("(" + data + ")");
        if(buildContentBlockReturnMessage(data, "DATA_IS_CREATED", "register"))
        {
        	loadDynamicPageElements();
        }
        else
        {
            buildContentBlockReturnMessage(data, true, "register");
        }
    });
}

function gdFuncUpdateData()
{
    buildContentBlockReturnMessage();
    $.post("/_controls/ajax/ACCOUNTING.php", gdSerialize("update"), function(data)
    {
        data = eval("(" + data + ")");
        if(buildContentBlockReturnMessage(data, "RECORD_IS_UPDATED", "update"))
        {
        	loadDynamicPageElements();
        }
        else
        {
            buildContentBlockReturnMessage(data, true, "update");
        }
    });
}