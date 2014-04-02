/** Generic Elements **/
function buildForm()
{

}

function getContentElementForm(clas, id, formpageid)
{
	// <form id="RegisterFrm" class="form" formpageid="billto">
	var obj = $("<form/>").attr("id", id);
    if(clas != null) {obj.attr("class", clas);}
    return obj;
}

function getContentBlockUL(clas, id)
{
	return ul = $("<ul/>").attr("class", clas).attr("id", id);
}

function getContentElementLI(clas, label, jqobj)
{
    var li = $("<li/>");
    if(clas != null)
    	li.attr("class", clas)
    if(label != null)
    	li.text(label);
    else if(jqobj != null)
    	li.append(jqobj);
    return li
    //.append($("<p/>")
}

function getContentElementAnchor(href, clas, id, name, onclick, label, jqobj)
{
    var obj = $("<a/>");
    if(href != null) {obj.attr("href", href);}
    if(clas != null) {obj.attr("class", clas);}
    if(id != null) {obj.attr("id", id);}
    if(name != null) {obj.attr("name", name);}
    if(onclick != null) {obj.attr("onclick", onclick);}
    if(label != null) {obj.text(label);}
    if(jqobj != null) {obj.append(jqobj);}
    if(href.indexOf("void") != -1)
	{
    	obj.attr("onmouseover", status="Click to Launch");
    	obj.attr("onmouseout", status="");
	}
    return obj;
}

function getContentElementSpan(clas, id, text)
{
	var obj = $("<span/>");
    if(clas != null) {obj.attr("class", clas);}
    if(id != null) {obj.attr("id", id);}
    obj.text(text);
    return obj;
}

function getContentElementDiv(clas, id, text, jqocj)
{
	var div = $("<div/>");
    if(clas != null) {obj.attr("class", clas);}
    if(id != null) {obj.attr("id", id);}
    if(text != null) {obj.text(text);}
    if(jqobj != null) {obj.append(jqobj);}
    return span;
}

function getContentElementInput(type, clas, id, name, value, placeholder)
{
	var obj = $("<input/>");
    if(type != null) {obj.attr("type", type);}
    if(clas != null) {obj.attr("class", clas);}
    if(id != null) {obj.attr("id", id);}
    if(name != null) {obj.attr("name", name);}
    if(value != null) {obj.attr("value", value);}
    if(placeholder != null) {obj.attr("placeholder", placeholder);}
	return obj;
}

function getContentElementSelect(clas, id, name, configuration, dyndropdownkey, onchange)
{
	var obj = $("<select/>");
    if(clas != null) {obj.attr("class", clas);}
    if(id != null) {obj.attr("id", id);}
    if(name != null) {obj.attr("name", name);}
    if(configuration != null && configuration != "") {obj.attr("configuration", configuration);}
    if(dyndropdownkey != null && dyndropdownkey != "") {obj.attr("dyndropdownkey", dyndropdownkey);}
    if(onchange != null && onchange != "") {obj.attr("onchange", onchange);}
	return obj;
}