/** Use this to override the Content Block Dynamic Content Tool.  make this specific to your application **/
function buildContentBlocksUserSupport(reskey, eleid)
{
	var cb = $("#" + eleid);
	cb.empty();
	if(reskey == "ACCOUNT_INACTIVE")
    {
		cb.append(getContentElementLI("header", "Activate Account"));
		cb.append(getContentElementLI("message", ""));
		cb.append(getContentBlockElementInput("activate_user_email", "Enter in Email"));
		cb.append(getContentBlockElementInputGDControlKey("ACTIVATE_ACCOUNT"));
		cb.append(getContentBlockElementButton("CBAcitvateButton", "buttonBlue", "navTop", "gdFuncSupportData", "Activate Account"));
    }
	if(reskey == "PASSWORD_CHANGE_REQUIRED")
    {
		cb.append(getContentElementBlockHeader("header", "Change Password"));
		cb.append(getContentElementLI("message", ""));
		cb.append(getContentBlockElementInput("password_change_user_email", "Enter in Email"));
		cb.append(getContentBlockElementInputGDControlKey("CHANGE_PASSWORD"));
		cb.append(getContentBlockElementButton("CBPasswordButton", "buttonBlue", "navTop", "gdFuncSupportData", "Change Password"));
    }
}