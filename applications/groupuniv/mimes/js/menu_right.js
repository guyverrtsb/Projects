// data, key, val, dckey, dcitm
function gdLoadGroupRequestList(jqobj, data)
{
    $.each(data.RESULT, function(key, val)
    {
    	var cb_li = $("<li/>");
		cb_li.text(eval("val.who_gets_approved_user_profile_fname"));
		cb_li.after(jqobj);
    });
}
