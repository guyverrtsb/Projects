function buildTileElements(jqobj, data)
{
	jqobj.empty();
    var isfirst = true;
    $.each(data.RESULT, function(key, val)
    {
    	// <div class=\"tile\">TILE : %s</div>
    	var tile = $("<div/>").attr("class", "tile");
    	var ul = getContentBlock("desktoptiles");
    	tile.append(ul);
    	ul.append(getFormText(eval("val.sdesc")));
    	ul.append(getFormText("Billto : " + val.accounting_billto_companyname));
    	ul.append(getFormText("Client : " + val.accounting_client_companyname));
    	ul.append(getFormText("Cycle  : " + val.cfg_defaults_label));
    	ul.append(getFormText("Rate  : " + val.rate_hourly));
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