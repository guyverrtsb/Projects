/** Use this to override the Content Block Dynamic Content Tool.  make this specific to your application **/
function buildDynamicMenuElements(jqobj, data)
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
    	else if(dckey == "LIST_OF_REQUIREMENTS")
    	{
    		var href = "/_controls/ajax/PAGE_DIRECT.php?" +
					"GD_CONTROL_KEY=REQUIREMENT_TO_RESOURCE&placement_requirement_uid=" + val.uid;
    		var obj = getContentElementAnchor(href, null, (eval("val.uid")), (eval("val.uid")), null, eval("val.role_desc"), null);
    		cb_li.append(obj);
    	}
    	else if(dckey == "RESOURCES_FOR_REQUIREMENT")
    	{
        	var tile = $("<div/>").attr("class", "tile-menu");
        	var ul = getContentBlock("menutiles");
        	tile.append(ul);
        	if(val.cfg_placement_status_sdesc == "PLACEMENT_STATUS_REQSENT")
        	{
        		tile.css("background-color","#009E4A");
            	ul.append(getFormHTML("Intro E-Mail has been sent."));
        	}
        	ul.append(getFormHTML(val.firstname + "&nbsp;" + val.lastname));
        	ul.append(getFormHTML(val.email));
        	
        	// getContentElementAnchor(href, clas, id, name, onclick, label, jqobj)
    		var href = "javascript:alert('" + val.cfg_placement_status_sdesc + "');";
    		var obj = getContentElementAnchor(href, null, (eval("val.uid")), (eval("val.uid")), null, null, tile);
    		cb_li.append(obj);
    	}

    	var newjqobj = cb_li;
    	jqobj.after(newjqobj);
    	jqobj = newjqobj;
    	
    });
}

function loadFormData(obj, gdControlKey)
{
	var jqobj = $("#" + obj.id);
    $.post("/_controls/ajax/SCREEN_CONTROL.php", gdSerialize("account_uid", jqobj.val(), "GD_CONTROL_KEY", gdControlKey), function(data)
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
    buildContentBlockReturnMessage(null, "RESET");
    $.post("/_controls/ajax/TOOLS.php", gdSerialize("register"), function(data)
    {
        data = eval("(" + data + ")");
        if(buildContentBlockReturnMessage(data, "DATA_IS_CREATED"))
        {
            buildContentBlockReturnMessage(data, true);
        	loadDynamicPageElements();
        }
        else
        {
            buildContentBlockReturnMessage(data, true);
        }
    });
}

function gdFuncUpdateData()
{
    buildContentBlockReturnMessage();
    $.post("/_controls/ajax/TOOLS.php", gdSerialize("update"), function(data)
    {
        data = eval("(" + data + ")");
        if(buildContentBlockReturnMessage(data, "RECORD_IS_UPDATED"))
        {
        	loadDynamicPageElements();
        }
        else
        {
            buildContentBlockReturnMessage(data, true);
        }
    });
}

/* ************************** */
/* throw away */
/*
function buildUpdateForms(obj, funcname)
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
*/
/* ************************** */
