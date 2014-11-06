function buildForm()
{
    var cb = getContentBlock("update");
    $("#workarea_row_01").append(getForm("update").append(cb));
    cb.append(getContentBlockHeader("Update Resource"));
    cb.append(getContentBlockMessage());
    cb.append(getContentBlockSubHeader("Resource Account"));
    
    cb.append(getFormInputTextField("update", "firstname", "", "First Name").css("clear","").css("float", "left").css("width","40%"));
    $("#updatefirstname").css("width","90%");
    cb.append(getFormInputTextField("update", "lastname", "", "Last Name").css("clear","").css("float", "left").css("width","56%"));
    $("#updatelastname").css("width","90%");
    
    cb.append(getFormInputTextField("update", "email", "", "E-Mail"));
    $("#updateemail").css("width","90%");
    cb.append(getFormInputTextField("update", "profile_url", "", "Profile URL"));
    $("#updateprofile_url").css("width","90%");
    cb.append(getFormInputTextField("update", "profile_id", "", "Profile ID"));
    cb.append(getFormButton("gdFuncUpdateData();", "Update"));
    cb.append(getFormGDControlkey("UDPATE_RECRUITER_VIEW_OF_RESOURCE"));
    loadFormData(this, "LOAD_DATA_FOR_UPDATE_RECUITMENT_VIEW_OF_RESOURCE");
}

function buildRequirementsTiles(jqobj, data)
{
	jqobj.empty();
	var dckey = jqobj.attr("dyncontentkey");
	var dcitm = dckey + "_TILEITEM";
    
    $.each(data.RESULT, function(key, val)
    {
    	var tile = $("<div/>").attr("class", "tile-menu");
    	var ul = getContentBlock("menutiles");
    	tile.append(ul);
    	if(val.cfg_placement_status_sdesc == "PLACEMENT_STATUS_REQSENT")
    	{
    		tile.css("background-color","#009E4A");
        	ul.append(getFormHTML("Intro E-Mail has been sent."));
    	}
    	ul.append(getFormHTML(val.requirement_number));
    	ul.append(getFormHTML(val.title));
    	
		var href = "/_controls/ajax/PAGE_DIRECT.php?" +
			"GD_CONTROL_KEY=REQUIREMENT_TO_RESOURCE&placement_requirement_uid=" + val.placement_requirement_uid;
		var anchor = getContentElementAnchor(href, null, (eval("val.uid")), (eval("val.uid")), null, null, tile);
		
    	var newjqobj = anchor;
    	if(true)
    		jqobj.append(newjqobj);
    	else
    		jqobj.preppend(newjqobj);
    });
}