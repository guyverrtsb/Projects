function gdSearializeControlKey(val)
{
	return gdSerialize("GD_CONTROL_KEY", val);
}

function gdSerialize()
{
	var data = "";
	if(arguments.length == 1)
	{
		data = $("#FORM_" + arguments[0]).serialize();
	}
	else if(arguments.length == 2)
	{
		data = arguments[0] + "=" + arguments[1];
	}
	else
	{
		for (var idx = 0; idx < arguments.length; idx++)
		{
			if(idx == 0 && $("#FORM_" + arguments[idx]).is("form"))
				data = $("#FORM_" + arguments[idx]).serialize();
			else
			{
				data = data + "&" + arguments[idx];
				idx++;
				data = data + "=" + arguments[idx];
			}
		}
	}
	// alert("serial data-" + data + "-");
	return data;
}

function getGDControlKey(id)
{
	var qsary = gdSerialize(id).split("&");
	for(var idx = 0; idx < qsary.length; idx++)
	{
		var n = qsary[idx].split("=")[0];
		var v = qsary[idx].split("=")[1];
		if(n == "GD_CONTROL_KEY")
			return v;
	}
	return null;
}

function gdShowJSONRawtoOutput(data)
{
	if($("#GD_SHOWJSON").length != 0)
		$("<div/>").attr("id", "GD_SHOWJSON").appendTo("<body/>");
	alert(data);
	$("#GD_SHOWJSON").text(data);
}

function trim(stringToTrim) {
	return stringToTrim.replace(/^\s+|\s+$/g,"");
}
function ltrim(stringToTrim) {
	return stringToTrim.replace(/^\s+/,"");
}
function rtrim(stringToTrim) {
	return stringToTrim.replace(/\s+$/,"");
}
function isType(obj, type)
{
	if(typeof(type) == "undefined")
		type = "undefined";
	if(typeof(obj) == type)
		return true;
	else
		return false;
}

function getDay(idx)
{
	var day = new Array();
	day[0] = "Sunday";
	day[1] = "Monday";
	day[2] = "Tuesday";
	day[3] = "Wednesday";
	day[4] = "Thursday";
	day[5] = "Friday";
	day[6] = "Saturday";
	
	return day[idx];
}