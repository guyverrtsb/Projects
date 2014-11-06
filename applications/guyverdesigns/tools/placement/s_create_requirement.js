function buildForm()
{
    var cb = getContentBlock("register");
    $("#workarea").append(getForm("register").append(cb));
    cb.append(getContentBlockHeader("Register Requirement"));
    cb.append(getContentBlockMessage());
    cb.append(getContentBlockSubHeader("Requirement Information"));
    cb.append(getFormInputTextField("register", "title", "", "Title"));
    $("#registertitle").css("width","90%");
    cb.append(getFormInputTextField("register", "role_desc", "", "Role Description"));
    $("#registerrole_desc").css("width","90%");
    cb.append(getContentBlockSubHeader("Commitment").css("clear", "both"));
    cb.append(getFormInputDateField("register", "start_date", "", "Start Date (Proposed)").css("clear","").css("float", "left"));
    cb.append(getFormInputDateField("register", "end_date", "", "End Date").css("clear","").css("float", "left"));
    cb.append(getFormInputTextField("register", "requested_days", "", "Days Requested").css("clear","").css("float", "left"));
    cb.append(getFormSelectDynDropDown("register", "days_per_week", "", "DAYS_PER_WEEK", "", "Choose Number of Days Per Week", null, "buildDaysperweek").css("clear","").css("float", "left"));
    cb.append(getContentBlockSubHeader("Location"));
    cb.append(getFormSelectConfiguration("register", "cfg_country_sdesc", "COUNTRIES|COUNTRY_US|registercfg_region_sdesc", "", "Choose Country").css("clear","").css("float", "left"));
    cb.append(getFormSelectConfiguration("register", "cfg_region_sdesc", "COUNTRY_US|REGION_NC", "", "Choose Region").css("clear","").css("float", "left"));
    cb.append(getFormInputTextField("register", "city", "", "City").css("clear","").css("float", "left"));
    cb.append(getFormSelectDynDropDown("register", "is_remote_possible", "", "IS_REMOTE_POSSIBLE", "", "Is Remote Possible", null, "buildIsremotepossible").css("clear","").css("float", "left"));
    cb.append(getFormtextareaField("register", "scope_of_tasks", "", "80", "7", "Scope of Tasks"));
    $("#registerscope_of_tasks").css("width","90%");
    cb.append(getFormtextareaField("register", "comments", "", "80", "2", "Comments"));
    $("#registercomments").css("width","90%");
    cb.append(getFormInputTextField("register", "company_name", "", "Company Name"));
    cb.append(getContentBlockSubHeader("Search Words"));

    var cb_searchwords = getContentBlock("search_words");
    cb.append(cb_searchwords);

	var li_addnew_searchword = getContentElementLI("entry", null, null);
	var a_addnewsearchword = $("<a/>").attr("href","javascript:void(0);").attr("onclick","gdFuncAddNewSearchWordInputField()")
							.addClass("menulink").html("Add New");
	li_addnew_searchword.append(a_addnewsearchword);
	cb_searchwords.append(li_addnew_searchword);

	var li_searchwords = getContentElementLI("entry", null, null);
	li_searchwords.append(getContentElementInput("text", "rounded", "registersearch_words_0", "search_words[0]", "", null));
	li_searchwords.css("clear","").css("float", "left");
	cb_searchwords.append(li_searchwords);
    
    cb.append(getFormButton("gdFuncRegisterData();", "Register"));
    cb.append(getFormGDControlkey("REGISTER_REQUIREMENT"));
}

var searchwordsfield_idx = 0;
function gdFuncAddNewSearchWordInputField()
{
	searchwordsfield_idx = searchwordsfield_idx + 1;
	var cb_searchwords = $("#CB_search_words");

	var li_searchwords = getContentElementLI("entry", null, null);
	li_searchwords.append(getContentElementInput("text", "rounded", "registersearch_words_" + searchwordsfield_idx, "search_words[" + searchwordsfield_idx + "]", "", null));
	li_searchwords.css("clear","").css("float", "left");
	cb_searchwords.append(li_searchwords);
}

function buildDynamicDropDownElements(jqobj, data, key, val, dckey)
{
	var dd_value = $("<option/>");
	dd_value.val(val.uid);
	dd_value.text(val.companyname);
    return dd_value;
}

function buildDaysperweek(jqobj, data, key, val, dckey)
{
	var dd_value = $("<option/>");
	dd_value.val(key);
	dd_value.text(val);
    return dd_value;
}

function buildIsremotepossible(jqobj, data, key, val, dckey)
{
	var dd_value = $("<option/>");
	dd_value.val(key);
	dd_value.text(val);
    return dd_value;
}