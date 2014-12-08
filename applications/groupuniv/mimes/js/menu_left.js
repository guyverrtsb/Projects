// data, key, val, dckey, dcitm
function gdLoadUnivertsityList(jqobj, data)
{
	$("li").each(function( index )
	{
		if($(this).attr("dyncontentitem") != undefined && $(this).attr("dyncontentitem") == (jqobj.attr("dyncontentkey") + "_ITEM"))
		{
			$(this).remove();
		}
	});
	
    $.each(data.RESULT, function(key, val)
    {
    	var cb_li = $("<li/>");
		cb_li.attr("class","menuitem").attr("dyncontentitem",jqobj.attr("dyncontentkey") + "_ITEM").text(val.university_account_sdesc);
		jqobj.after(cb_li);
    });
}