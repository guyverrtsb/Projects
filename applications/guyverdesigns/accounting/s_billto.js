function buildForm()
{
    var cb = getContentBlock("register");
    $("#workarea_col_left").append(getForm("register").append(cb));
    cb.append(getContentBlockHeader("Register Billto"));
    cb.append(getContentBlockMessage());
    cb.append(getContentBlockSubHeader("Company Information"));
    cb.append(getFormInputTextField("register", "companyname", "", "Company Name"));
    cb.append(getFormInputTextField("register", "address", "", "Street Address"));
    cb.append(getFormSelectConfiguration("register", "cfg_country_sdesc", "", "COUNTRIES|COUNTRY_US|registercfg_region_sdesc", "", "Choose Country"));
    cb.append(getFormSelectConfiguration("register", "cfg_region_sdesc", "", "COUNTRY_US|REGION_NC", "", "Choose Region"));
    cb.append(getFormInputTextField("register", "city", "", "City"));
    cb.append(getContentBlockSubHeader("Contact Information"));
    cb.append(getFormInputTextField("register", "accountingcontactname", "", "Accounting Contact Name"));
    cb.append(getFormInputTextField("register", "accountingcontactemail", "", "Accounting Contact Email"));
    cb.append(getFormInputTextField("register", "accountingcontactnumber", "", "Accounting Contact Number"));
    cb.append(getFormGDControlkey("REGISTER_BILLTO"));
    cb.append(getFormButton("gdFuncRegisterData();", "Register"));
    
    var cb = getContentBlock("update");
    $("#workarea_col_right").append(getForm("update").append(cb));
    cb.append(getContentBlockHeader("Update Billto"));
    cb.append(getContentBlockMessage());
    cb.append(getContentBlockSubHeader("Company Information"));
    cb.append(getFormSelectDynDropDown("update", "account_uid", "", "LIST_OF_BILLTOS", "loadFormData(this);", "Choose Billto"));
    cb.append(getFormInputTextField("update", "companyname", "", "Company Name"));
    cb.append(getFormInputTextField("update", "address", "", "Street Address"));
    cb.append(getFormSelectConfiguration("update", "cfg_country_sdesc", "", "COUNTRIES|COUNTRY_US|registercfg_region_sdesc", "", "Choose Country"));
    cb.append(getFormSelectConfiguration("update", "cfg_region_sdesc", "", "COUNTRY_US|REGION_NC", "", "Choose Region"));
    cb.append(getFormInputTextField("update", "city", "", "City"));
    cb.append(getContentBlockSubHeader("Contact Information"));
    cb.append(getFormInputTextField("update", "accountingcontactname", "", "Accounting Contact Name"));
    cb.append(getFormInputTextField("update", "accountingcontactemail", "", "Accounting Contact Email"));
    cb.append(getFormInputTextField("update", "accountingcontactnumber", "", "Accounting Contact Number"));
    cb.append(getFormGDControlkey("UPDATE_BILLTO"));
    cb.append(getFormButton("gdFuncUpdateData();", "Update"));

}