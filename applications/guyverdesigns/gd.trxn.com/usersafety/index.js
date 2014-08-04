function buildForm()
{
    var cb = getContentBlock("login");
    var form = getForm("login");
    	form.attr("action", "_controls/ajax/USER_ACCESS.php");
    	form.attr("method", "POST");
    $("#workarea_col_left").append(form.append(cb));
    cb.append(getContentBlockHeader("Login - E-Mail"));
    cb.append(getFormInputTextField("login", "email", "", "E-Mail"));
    cb.append(getFormInputTextField("login", "password", "", "Password"));
    cb.append(getFormGDControlkey("LOGIN_USER"));
    cb.append(getFormButton("gdFuncLoginUser();", "Login"));

    var cb = getContentBlock("support");
    $("#workarea_col_left").append(getForm("support").append(cb));
    

    var cb = getContentBlock("register");
    $("#workarea_col_right").append(getForm("register").append(cb));
    cb.append(getContentBlockHeader("Register User Account"));
    cb.append(getContentBlockSubHeader("Account Information"));
    cb.append(getFormInputTextField("register", "email", "", "E-Mail"));
    cb.append(getFormInputTextField("register", "password", "", "Password"));
    cb.append(getContentBlockSubHeader("Profile Information"));
    cb.append(getFormInputTextField("register", "firstname", "", "First Name"));
    cb.append(getFormInputTextField("register", "lastname", "", "Last Name"));
    cb.append(getFormInputTextField("register", "nickname", "", "Nickname"));
    cb.append(getFormSelectConfiguration("register", "cfg_country_sdesc", "COUNTRIES|COUNTRY_US|registercfg_region_sdesc", "", "Choose Country"));
    cb.append(getFormSelectConfiguration("register", "cfg_region_sdesc", "COUNTRY_US|REGION_NC", "", "Choose Region"));
    cb.append(getFormInputTextField("register", "city", "", "City"));
    cb.append(getFormGDControlkey("REGISTER_USER"));
    cb.append(getFormButton("gdFuncRegisterData();", "Register"));
}

function buildContentBlocksUserSupport(reskey, eleid)
{
	var cb = $("#" + eleid);
	cb.empty();
	if(reskey == "ACCOUNT_INACTIVE")
    {
		cb.append(getContentElementLI("header", "Activate Account"));
		cb.append(getContentBlockElementInput("activate_user_email", "Enter in Email"));
		cb.append(getContentBlockElementInputGDControlKey("ACTIVATE_ACCOUNT"));
		cb.append(getContentBlockElementButton("CBAcitvateButton", "buttonBlue", "navTop", "gdFuncSupportData", "Activate Account"));
    }
	if(reskey == "PASSWORD_CHANGE_REQUIRED")
    {
		cb.append(getContentElementBlockHeader("header", "Change Password"));
		cb.append(getContentBlockElementInput("password_change_user_email", "Enter in Email"));
		cb.append(getContentBlockElementInputGDControlKey("CHANGE_PASSWORD"));
		cb.append(getContentBlockElementButton("CBPasswordButton", "buttonBlue", "navTop", "gdFuncSupportData", "Change Password"));
    }
}