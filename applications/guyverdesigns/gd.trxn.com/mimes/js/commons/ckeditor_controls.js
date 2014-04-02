var ckEditorContentAry = new Array();
var ckEditorDefaultValAry = new Array();
var ckEditorControlObjAry = new Array();

function addCKPreControl(contentId, defaultVal, contentObj)
{
	ckEditorContentAry[ckEditorContentAry.length] = contentId;
	ckEditorDefaultValAry[contentId] = defaultVal;
	ckEditorControlObjAry[contentId] = contentObj;
	if($("#" + contentId).html() == "")
		$("#" + contentId).html(defaultVal);
}

function getCKContentData(contentId)
{
	var data = eval("ckEditorControlObjAry[contentId].instances." + contentId + ".getData()");
	return data;
}

function checkCKContentEntry()
{
	for(var idx = 0; idx < ckEditorContentAry.length; idx++)
	{		
		var id = ckEditorContentAry[idx];
		var cobj = ckEditorControlObjAry[id];
		var dval = ckEditorDefaultValAry[id];
		var data = getCKContentData(id);
	}
	return true;
}

function toggleCKContentArea(obj)
{
	var co = $("#" + obj.id);
	if(co.hasClass("showckeditable"))
		co.removeClass("showckeditable");
	else
		co.addClass("showckeditable");
}


