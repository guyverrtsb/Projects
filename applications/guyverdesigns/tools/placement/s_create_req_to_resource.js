function buildRequirementEmail(jqobj, data)
{
    var cb = getContentBlock("register");
    $("#workarea").append(getForm("register").append(cb));
    cb.append(getContentBlockHeader("Send Email to Resource"));

    cb.append(getFormInputTextField("register", "firstname", "", "First Name").css("clear","").css("float", "left").css("width","40%"));
    $("#registerfirstname").css("width","90%");
    cb.append(getFormInputTextField("register", "lastname", "", "Last Name").css("clear","").css("float", "left").css("width","55%"));
    $("#registerlastname").css("width","90%");
    
    cb.append(getFormInputTextField("register", "email", "", "E-Mail"));
    $("#registeremail").css("width","90%");
    cb.append(getFormInputTextField("register", "profile_url", "", "Profile URL"));
    $("#registerprofile_url").css("width","90%");
    cb.append(getFormInputTextField("register", "profile_id", "", "Profile ID"));
    
    cb.append(getFormInputTextField("register", "subject", "REQ(" + data.RESULT.requirement_number + ")..." + data.RESULT.title, "Subject"));
    $("#registersubject").css("width","90%");
    
    var body = "";
    body += "Req Number     : " + data.RESULT.requirement_number + "\n";
    body += "Start Date     : " + data.RESULT.start_date + "\n";
    body += "End Date       : " + data.RESULT.end_date + "\n";
    body += "Requested Days : " + data.RESULT.requested_days + "\n";
    body += "Days per Week  : " + (parseInt(data.RESULT.days_per_week) + 1) + "\n";
    
    if(data.RESULT.role_location == "0")
    	body += "Work Type      : " + "On-Site Only" + "\n";
    else if(data.RESULT.role_location == "1")
    	body += "Work Type      : " + "Remote" + "\n";
    else if(data.RESULT.role_location == "2")
    	body += "Work Type      : " + "Remote and On-Site" + "\n";
    else if(data.RESULT.role_location == "3")
    	body += "Work Type      : " + "Possible Remote" + "\n";
    
    if(data.RESULT.city != "")
    {
	    body += "Location       : " + data.RESULT.city + "\n";
	    body += "               : " + data.RESULT.cfg_defaults_region + ", " + data.RESULT.cfg_defaults_country + "\n";
    }
    else
    {
	    body += "Location       : " + data.RESULT.cfg_defaults_region + ", " + data.RESULT.cfg_defaults_country + "\n";
    }
    body += "\n";
    body += "Scope of Tasks : " + "\n";
    body += "\n";
    body += data.RESULT.scope_of_tasks + "\n";
    body += "\n";
    body += "** Comments ** : " + data.RESULT.comments + "\n";
    
    cb.append(getFormtextareaField("register", "body", body, "40", "20", "Body"));
    $("#registerbody").css("width","90%");
    cb.append(getContentBlockMessage());
    
    cb.append(getFormButton("gdFuncSendEmailData();", "Send"));
    cb.append(getFormGDControlkey("SEND_REQUIREMENT_TO_EMAIL"));
}

function gdFuncSendEmailData()
{
    buildContentBlockReturnMessage(null, "RESET");
    $.post("/_controls/ajax/TOOLS.php", gdSerialize("register"), function(data)
    {
        data = eval("(" + data + ")");
        if(buildContentBlockReturnMessage(data, "DATA_IS_CREATED"))
        {
        	loadDynamicContent("RESOURCES_FOR_REQUIREMENT");
            buildContentBlockReturnMessage(data, true);
        }
        else
        {
            buildContentBlockReturnMessage(data, true);
        }
    });
}

var buildDynamicMenuElementsDoAfter = true;
function RightMenu_SEND_REQUIREMENT_TO_RESOURCE(jqobj, data)
{
	var dckey = jqobj.attr("dyncontentkey");
	var dcitm = dckey + "_TILEITEM";
    $("li[contentblock=" + dcitm + "]").remove();

    $.each(data.RESULT, function(key, val)
    {
    	var cb_li = $("<li/>").attr("contentblock", dcitm);
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
    	
		var href = "/_controls/ajax/PAGE_DIRECT.php?" +
			"GD_CONTROL_KEY=RECRUITER_VIEW_OF_RESOURCE&resource_account_uid=" + val.placement_resource_account_uid;
		var anchor = getContentElementAnchor(href, null, (eval("val.uid")), (eval("val.uid")), null, null, tile);
		cb_li.append(anchor);

    	var newjqobj = cb_li;
    	if(buildDynamicMenuElementsDoAfter)
    		jqobj.after(newjqobj);
    	else
    		jqobj.before(newjqobj);
    	jqobj = newjqobj;
    	
    	buildDynamicMenuElementsDoAfter = false;
    });
}