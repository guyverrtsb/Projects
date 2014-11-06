function buildForm()
{
    var cb = getContentBlock("update");
    $("#workarea_col_right").append(getForm("update").append(cb));
    cb.append(getContentBlockHeader("Update Client"));
    cb.append(getContentBlockMessage());
    cb.append(getContentBlockSubHeader("Company Information"));
    cb.append(getFormSelectDynDropDown("update", "account_uid", "", "LIST_OF_CLIENTS", "loadFormData(this, 'LOAD_DATA_FOR_UPDATE_CLIENT');", "Choose Client"));
    cb.append(getFormInputTextField("update", "companyname", "", "Company Name"));
    cb.append(getFormInputTextField("update", "address", "", "Street Address"));
    cb.append(getFormSelectConfiguration("update", "cfg_country_sdesc", "COUNTRIES|COUNTRY_US|registercfg_region_sdesc", "", "Choose Country"));
    cb.append(getFormSelectConfiguration("update", "cfg_region_sdesc", "COUNTRY_US|REGION_NC", "", "Choose Region"));
    cb.append(getFormInputTextField("update", "city", "", "City"));
    cb.append(getContentBlockSubHeader("Contact Information"));
    cb.append(getFormInputTextField("update", "contactname", "", "Contact Name"));
    cb.append(getFormInputTextField("update", "contactemail", "", "Contact Email"));
    cb.append(getFormInputTextField("update", "contactnumber", "", "Contact Number"));
    cb.append(getFormGDControlkey("UPDATE_CLIENT"));
    cb.append(getFormButton("gdFuncUpdateData();", "Update"));
}

function buildDynamicDropDownElements(jqobj, data, key, val, dckey)
{
	var dd_value = $("<option/>");
	dd_value.val(val.uid);
	dd_value.text(val.companyname);
    return dd_value;
}