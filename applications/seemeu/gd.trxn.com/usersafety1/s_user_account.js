function buildContent(jqobj, data)
{
	var val = data.RESULT;

    var cb = getContentBlock("update");
    $("#workarea").append(getForm("update").append(cb));
    cb.append(getContentBlockHeader("Update User"));
    cb.append(getContentBlockMessage());
    cb.append(getContentBlockSubHeader("User Data"));
    cb.append(getFormInputTextField("update", "email", val.usersafety_useraccount_email, "E-Mail"));
    cb.append(getFormInputTextField("update", "nickname", val.usersafety_useraccount_nickname, "Nickname"));
    cb.append(getFormInputTextField("update", "firstname", val.usersafety_userprofile_firstname, "First name"));
    cb.append(getFormInputTextField("update", "lastname", val.usersafety_userprofile_lastname, "Last name"));
    cb.append(getFormSelectConfiguration("update", "cfg_country_sdesc", "COUNTRIES|COUNTRY_US|updatecfg_region_sdesc", "", "Choose Country"));
    cb.append(getFormSelectConfiguration("update", "cfg_region_sdesc", "COUNTRY_US|REGION_NC", "", "Choose Region"));
    cb.append(getFormInputTextField("update", "city", val.usersafety_userprofile_city, "City"));
    cb.append(getFormGDControlkey("UPDATE_USERDATA"));
    
    cb.append(getFormSelectDynDropDown("update", "usersafety_role_uid", val.usersafety_role_sdesc, "LIST_OF_USERSAFETY_ROLES", "", "Choose Role", "/gd.trxn.com"));
    
    cb.append(getFormButton("gdFuncUpdateData();", "Update"));
    
    cb.append(getFormInputHiddenField("update", "usersafety_useraccount_uid", val.usersafety_useraccount_uid));
    cb.append(getFormInputHiddenField("update", "usersafety_userprofile_uid", val.usersafety_userprofile_uid));
    
    

    buildConfigurationsDropDown($("#updatecfg_country_sdesc"));
    buildConfigurationsDropDown($("#updatecfg_region_sdesc"));
    buildDynamicDropDown($("#updateusersafety_role_uid"));

}

function buildDynamicDropDownElements(jqobj, data, key, val, dckey)
{
	var dd_value = $("<option/>");
	dd_value.val(val.uid);
	dd_value.text(val.sdesc);
	
	if(jqobj.attr("origvalue") == val.sdesc)
		dd_value.prop("selected", true);
    return dd_value;
}

function gdFuncUpdateData()
{
    buildContentBlockReturnMessage();
    $.post("_controls/ajax/USER_ACCESS.php", gdSerialize("update"), function(data)
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