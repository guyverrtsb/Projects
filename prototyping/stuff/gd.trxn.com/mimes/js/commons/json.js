function returnNumber(jd, key)
{
	return eval("jd.RETURN_STRUCTURE[0]." + key + "[0].number");
}
function returnMessage(jd, key)
{
	return eval("jd.RETURN_STRUCTURE[0]." + key + "[0].message");
}
function returnNumber(jd)
{
	return eval("jd.RETURN_STRUCTURE[0].PRIMARY[0].number");
}
function returnMessage(jd)
{
	return eval("jd.RETURN_STRUCTURE[0].PRIMARY[0].message");
}

function showMessage(id, data)
{
	$(id).html(data);
}

function gdControllerKey( value)
{
    return "GD_CONTROLLER_KEY=" + value;
}

function gdSerialzeControllerKey(formid, value)
{
	var formdata = $(formid).serialize();
    if(formdata.length > 0)
    {
    	formdata = formdata + "&";
    }
    return formdata = formdata + "GD_CONTROLLER_KEY=" + value;
}

function gdAddQSNameValue(formdata, name, value)
{
    if(formdata.length > 0)
    {
    	formdata = formdata + "&";
    }
    return formdata = formdata + name + "=" + value;
}

function isDataMatch(data, match)
{
	if(trim(data) == trim(match))
		return true;
	return false;
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