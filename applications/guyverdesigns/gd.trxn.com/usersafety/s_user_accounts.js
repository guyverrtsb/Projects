function buildContent(jqobj, data)
{
	jqobj.empty();
    var isfirst = true;
    $.each(data.RESULT, function(key, val)
    {
    	// <div class=\"tile\">TILE : %s</div>
    	var tile = $("<div/>").attr("class", "tile");
    	var ul = getContentBlock("desktoptiles");
    	tile.append(ul);
    	ul.append(getFormText(val.usersafety_useraccount_createddt));
    	ul.append(getFormText("E-Mail : " + val.usersafety_useraccount_email));
    	ul.append(getFormText("Nickname : " + val.usersafety_useraccount_nickname));
    	ul.append(getFormText("TableKey  : " + val.usersafety_useraccount_usertablekey));
    	ul.append(getFormText("Active  : " + val.usersafety_useraccount_isactive));
    	ul.append(getFormText("Login Tries  : " + val.usersafety_useraccount_numberoflogintries));
    	ul.append(getFormText("First Name  : " + val.usersafety_userprofile_firstname));
    	ul.append(getFormText("Last Name  : " + val.usersafety_userprofile_lastname));

    	var li = getContentElementLI("text", null, null);
    	var button1 = getFormMiniButton("window.location='/gd.trxn.com/_controls/ajax/PAGE_DIRECT.php?" +
    			"GD_CONTROL_KEY=MAINT_USERACOUNT&usersafety_useraccount_uid=" + val.usersafety_useraccount_uid + "';", "Maintain", false);
    	var button2 = getFormMiniButton("alert('Invoice : " + val.uid + "');", "Pending", false);
    	li.append(button1);
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