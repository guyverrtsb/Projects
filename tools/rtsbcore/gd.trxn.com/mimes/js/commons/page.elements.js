$(document).ready(function()
{
	$("select").each(function( index ) {
		if($(this).attr("cfgdefault") != undefined && $(this).attr("cfgdefault").length > 0 )
		{
			buildCfgDefaultsDropDown($(this));
		}
		if($(this).attr("cfg") != undefined && $(this).attr("cfg").length > 0 )
		{
			buildCfgDropDown($(this));
		}
	});
});

/* ************** MESSSAGING
 * Use these methods to 
 */
var GD_MESSAGE_CLASS = "GD_MESSAGE_NOTIFICATION";
function showMessage(message, className)
{
	if(className == null)
		className = GD_MESSAGE_CLASS;
	else
		GD_MESSAGE_CLASS = className;

	if(message == null)
		message = "&nbsp;";
	
	if(message == "&nbsp;" || message == "")
	{
		if ($("#GD_MESSAGE").length)
			$("#GD_MESSAGE").remove();
	}
	else
	{
		var err = null;
		var container = "ContentWrapper";
		if ($("#GD_MESSAGE").length)
			err = $("#GD_MESSAGE");
		else
			err = $("<div/>").attr("id","GD_MESSAGE");
		err.removeClass().addClass(className);
		err.html(message);
		err.prependTo($("#" + container));
		$("body").scrollTop(0);
	}
}