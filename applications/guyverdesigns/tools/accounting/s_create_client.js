function buildForm()
{
    var cb = getContentBlock("register");
    $("#workarea_col_left").append(getForm("register").append(cb));
    cb.append(getContentBlockHeader("Register Client"));
    cb.append(getContentBlockMessage());
    cb.append(getContentBlockSubHeader("Company Information"));
    cb.append(getFormInputTextField("register", "companyname", "", "Company Name"));
    cb.append(getFormInputTextField("register", "address", "", "Street Address"));
    cb.append(getFormSelectConfiguration("register", "cfg_country_sdesc", "COUNTRIES|COUNTRY_US|registercfg_region_sdesc", "", "Choose Country"));
    cb.append(getFormSelectConfiguration("register", "cfg_region_sdesc", "COUNTRY_US|REGION_NC", "", "Choose Region"));
    cb.append(getFormInputTextField("register", "city", "", "City"));
    cb.append(getContentBlockSubHeader("Contact Information"));
    cb.append(getFormInputTextField("register", "contactname", "", "Contact Name"));
    cb.append(getFormInputTextField("register", "contactemail", "", "Contact Email"));
    cb.append(getFormInputTextField("register", "contactnumber", "", "Contact Number"));
    cb.append(getFormGDControlkey("REGISTER_CLIENT"));
    cb.append(getFormButton("gdFuncRegisterData();", "Register"));
}

function buildDynamicDropDownElements(jqobj, data, key, val, dckey)
{
	var dd_value = $("<option/>");
	dd_value.val(val.uid);
	dd_value.text(val.companyname);
    return dd_value;
}