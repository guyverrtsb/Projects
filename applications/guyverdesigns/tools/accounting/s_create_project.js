function buildForm()
{
    var cb = getContentBlock("register");
    $("#workarea_col_left").append(getForm("register").append(cb));
    cb.append(getContentBlockHeader("Register Project"));
    cb.append(getContentBlockMessage());
    cb.append(getContentBlockSubHeader("Project Information"));
    cb.append(getFormSelectDynDropDown("register", "accounting_billto_uid", "", "LIST_OF_BILLTOS", "", "Choose Billto"));
    cb.append(getFormSelectDynDropDown("register", "accounting_client_uid", "", "LIST_OF_CLIENTS", "", "Choose Client"));
    cb.append(getFormInputTextField("register", "sdesc", "", "Short Description"));
    cb.append(getFormInputTextField("register", "ldesc", "", "Long Description"));
    cb.append(getFormSelectConfiguration("register", "cfg_payoutcycle_sdesc", "ACCOUNTING_PAYOUT_CYCLE", "", "Choose Cycle"));
    cb.append(getFormSelectConfiguration("register", "cfg_ratetype_sdesc", "ACCOUNTING_RATETYPE", "showRateTypesFields(this, 'register');", "Choose Rate Type"));
    cb.append(getFormInputTextField("register", "rate_hourly_onsite", "", "On-Site Hourly Rate"));
    cb.append(getFormInputTextField("register", "rate_hourly_remote", "", "Remote Hourly Rate"));
    cb.append(getFormInputDateField("register", "start_date", "", "Start Date"));
    cb.append(getFormInputDateField("register", "end_date", "", "End Date"));
    cb.append(getContentBlockSubHeader("Contact Information"));
    cb.append(getFormInputTextField("register", "contactname", "", "Contact Name"));
    cb.append(getFormInputTextField("register", "contactemail", "", "Contact Email"));
    cb.append(getFormInputTextField("register", "contactnumber", "", "Contact Number"));
    cb.append(getContentBlockSubHeader("Project Location"));
    cb.append(getFormInputTextField("register", "address", "", "Street Address"));
    cb.append(getFormSelectConfiguration("register", "cfg_country_sdesc", "COUNTRIES|COUNTRY_US|registercfg_region_sdesc", "", "Choose Country"));
    cb.append(getFormSelectConfiguration("register", "cfg_region_sdesc", "COUNTRY_US|REGION_NC", "", "Choose Region"));
    cb.append(getFormInputTextField("register", "city", "", "City"));
    cb.append(getFormGDControlkey("REGISTER_PROJECT"));
    cb.append(getFormButton("gdFuncRegisterData();", "Register"));
}

function buildDynamicDropDownElements(jqobj, data, key, val, dckey)
{
	var dd_value = $("<option/>");
	dd_value.val(val.uid);
	dd_value.text(val.sdesc);
    return dd_value;
}

function showRateTypesFields(obj, task)
{
	var obj = $("#" + obj.id);
	$("#" + task + "rate_hourly_onsite").parent().remove();
	$("#" + task + "rate_hourly_remote").parent().remove();
	
	if(obj.val() == "ACCOUNTING_RATETYPE_COMBO")
	{
		obj.after(getFormInputTextField(task, "rate_hourly_onsite", "", "On-Site Hourly Rate"));
		obj.after(getFormInputTextField(task, "rate_hourly_remote", "", "Remote Hourly Rate"));
	}
	else if(obj.val() == "ACCOUNTING_RATETYPE_ONSITE")
	{
		obj.after(getFormInputTextField(task, "rate_hourly_onsite", "", "On-Site Hourly Rate"));
		obj.after(getFormInputHiddenField(task, "rate_hourly_remote", "0"));
	}
	else if(obj.val() == "ACCOUNTING_RATETYPE_REMOTE")
	{
		obj.after(getFormInputHiddenField(task, "rate_hourly_onsite", "0"));
		obj.after(getFormInputTextField(task, "rate_hourly_remote", "", "Remote Hourly Rate"));
	}
}