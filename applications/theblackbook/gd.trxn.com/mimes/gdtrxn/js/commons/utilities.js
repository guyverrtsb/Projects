function gdSearializeControlKey(serviceControlKey)
{
	return gdSerialize(serviceControlKey);
}

function gdSerialize()
{
	var data = "";
	if(arguments.length == 1)	// two Arguments means that only doing SERVICE_CONTROL_KEY
	{
		data = arguments[0].serialize();
	}
	alert("serial data[" + data + "]");
	return data;
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
function gdIsType(obj, type)
{
	if(typeof(type) == "undefined")
		type = "undefined";
	if(typeof(obj) == type)
		return true;
	else
		return false;
}

function gdGetDay(idx)
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

function gdGetParentForm(obj)
{
	obj = $(obj);
	if(obj.prop("tagName") == "FORM")
		return obj;
	else
		return gdGetParentForm(obj.parent());
}

function isEven(n)
{
	  n = Number(n);
	  return n === 0 || !!(n && !(n%2));
}

function isOdd(n)
{
  return isEven(Number(n) + 1);
}