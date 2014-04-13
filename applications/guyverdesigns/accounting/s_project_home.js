function buildTileElements(jqobj, data, key, val)
{
	jqobj.empty();
    var isfirst = true;
    $.each(data.RESULT, function(key, val)
    {
    	// <div class=\"tile\">TILE : %s</div>
    	var tile = $("<div/>").attr("class", "tile");
    	var ul = getContentBlock("desktoptiles");
    	tile.append(ul);
    	ul.append(getFormText(val.sdesc));
    	ul.append(getFormText("Billto : " + val.accounting_billto_companyname));
    	ul.append(getFormText("Client : " + val.accounting_client_companyname));
    	ul.append(getFormText("Cycle  : " + val.cfg_defaults_label));
    	ul.append(getFormText("Rate  : " + val.rate_hourly));
    	ul.append(getFormText("Start Date  : " + val.start_date));
    	ul.append(getFormText("End Date  : " + val.end_date));
    	
    	var li = getContentElementLI("text", null, null);
    	var button1 = getFormMiniButton("window.location='/_controls/ajax/PAGE_DIRECT.php?" +
    			"GD_CONTROL_KEY=TIMESHEETS_BY_PROJECT&accounting_project_uid=" + val.uid + "';", "Create", false);
    	var button2 = getFormMiniButton("alert('Invoice : " + val.uid + "');", "Pending", false);
    	li.append($("<p/>").text("Invoice : ").removeAttr("style").attr("style","float:left; padding-top:5px;"));
    	li.append(button1);
    	li.append(button2);
    	ul.append(li);
    	
    	if(isfirst)
    	{
    		jqobj.append(tile);
    		jqobj = tile;
    	}
    	else
		{
        	var newjqobj = tile;
        	jqobj.after(newjqobj);
        	jqobj = newjqobj;
		}
    	isfirst = false;
    });
}