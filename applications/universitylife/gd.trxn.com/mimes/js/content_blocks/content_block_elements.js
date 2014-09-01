/** FORM ELEMENTS **/
function getForm(id)
{
	// <form id="RegisterFrm" class="form" formpageid="billto">
	var form = getContentElementForm("form_content_block", "FORM_" + id);
	return form;
}

function getFormText(label)
{
	// <li class="message">&nbsp;</li>
	return getContentElementLI("text", label, null);
}

function getFormInputTextField(id, name, value, label, placeholder)
{
	// <li class="entry"><input class="rounded" type="text" id="registercompanyname" name="companyname" value="" placeholder=""/></li>
	var li = getContentElementLI("entry", null, null);
	li.css("clear","both");
	if(isType(label, "string"))
	{
		var label =  $("<label/>").attr("id", id+name+"formlabel").attr("class", "formlabel").text(label);
		var input = getContentElementInput("text", "rounded", id+name, name, value, null);
		input.attr("class", "forminput");
		li.append(label);
		li.append($("<br/>"));
		li.append(input);
		return li;
	}
	else
	{
		var input = getContentElementInput("text", "rounded", id+name, name, value, placeholder);
		li.append(input);
		return li;
	}
}

function getFormInputDateField(id, name, value, label, placeholder)
{
	// <li class="entry"><input class="rounded" type="text" id="registercompanyname" name="companyname" value="" placeholder=""/></li>
	var li = getContentElementLI("entry", null, null);
	li.css("clear","both");
	if(isType(label, "string"))
	{
		var label = $("<label/>").attr("id", id+name+"formlabel").attr("class", "formlabel").text(label);
		var input = getContentElementInput("text", "rounded", id+name, name, value, null);
		input.attr("class", "forminput");
		$(function() {
			$( "#" + id+name ).datepicker();
		});
		
		li.append(label);
		li.append($("<br/>"));
		li.append(input);
		return li;
	}
	else
	{
		var input = getContentElementInput("text", "rounded", id+name, name, value, placeholder);
		$(function() {
			$( "#" + id+name ).datepicker();
		});
		
		li.append(input);
		return li;
	}
}

function getFormInputHiddenField(id, name, value)
{
	// <li class="entry"><input class="rounded" type="text" id="registercompanyname" name="companyname" value="" placeholder=""/></li>
	var li = getContentElementLI("entry", null, null);
	li.css("clear","both");
	var input = getContentElementInput("hidden", null, id+name, name, value);
	
	li.append(input);
	return li;
}

function getFormSelectConfiguration(id, name, configuration, onchange, label, apppath)
{
	// <li class="entry"><select class="rounded" id="registercfg_country_sdesc" name="cfg_country_sdesc" configuration="COUNTRIES|COUNTRY_US|registercfg_region_sdesc"></select></li>
	var li = getContentElementLI("entry", null, null);
	li.css("clear","both");
	if(isType(label, "string"))
	{
		var label = $("<label/>").attr("id", id+name+"formlabel").attr("class", "formlabel").text(label);
		var select = getContentElementSelect("rounded", id+name, name, null, configuration, null, onchange, apppath);
		select.attr("class", "formselect");
		
		li.append(label);
		li.append($("<br/>"));
		li.append(select);
		return li;
	}
	else
	{
		var select = getContentElementSelect("rounded", id+name, name, null, configuration, null, onchange, apppath);
		li.append(select);
		return li;
	}
}

function getFormSelectDynDropDown(id, name, origvalue, dyndropdownkey, onchange, label, apppath)
{
	// <li class="entry"><select class="rounded" id="registercfg_country_sdesc" name="cfg_country_sdesc" configuration="COUNTRIES|COUNTRY_US|registercfg_region_sdesc"></select></li>
	var li = getContentElementLI("entry", null, null);
	li.css("clear","both");
	if(isType(label, "string"))
	{
		var label = $("<label/>").attr("id", id+name+"formlabel").attr("class", "formlabel").text(label);
		var select = getContentElementSelect("rounded", id+name, name, origvalue, null, dyndropdownkey, onchange, apppath);
		select.attr("class", "formselect");
		
		li.append(label);
		li.append($("<br/>"));
		li.append(select);
		return li;
	}
	else
	{
		var select = getContentElementSelect("rounded", id+name, name, origvalue, null, dyndropdownkey, onchange, apppath);
		li.append(select);
		return li;
	}
}

function getFormGDControlkey(value)
{
	// <li class="hidden"><input type="hidden" id="registerGD_CONTROLLER_KEY" name="GD_CONTROLLER_KEY" value="REGISTER_BILLTO"/></li>
	var li = getContentElementLI("hidden", null, null);
	var input = getContentElementInput("hidden", "rounded", "GD_CONTROL_KEY", "GD_CONTROL_KEY", value);
	return li.append(input);
}

function getFormButton(onclick, label, getli)
{
	// <li class="button"><a class="buttonBlue" name="navtop" onclick="gdFuncRegisterData();">Register</a></li>
	var a = getContentElementAnchor("javascript:void(0);", "buttonBlue", null, "navtop", onclick, label, null);
	var div = $("<div/>").css("clear","both");
	div.append(a);
	if(isType(getli))
	{
		var li = getContentElementLI("button", null, null);
		return li.append(div);
	}
	return div;
}

function getFormMiniButton(onclick, label, getli)
{
	// <li class="button"><a class="buttonBlue" name="navtop" onclick="gdFuncRegisterData();">Register</a></li>
	var a = getContentElementAnchor("javascript:void(0);", "miniButtonBlue", null, "navtop", onclick, label, null);
	var div = $("<div/>");
	div.append(a);
	if(isType(getli))
	{
		var li = getContentElementLI("button", null, null);
		return li.append(div);
	}
	return div;
}

/** CONTENT BLOCK ELEMENTS **/
function getContentBlock(id)
{
	// <ul id="CBBilltoRegister" class="content_block">
	var cb = getContentBlockUL("content_block", "CB_" + id);
	return cb;
}

function getContentBlockHeader(label)
{
	// <li class="header">Register Bill To</li>
	return getContentElementLI("header", label, null);
}

function getContentBlockMessage()
{
	// <li class="message">&nbsp;</li>
	return getContentElementLI("message", null, null);
}

function getContentBlockSubHeader(label)
{
	// <li class="subheader">Company Information</li>
	return getContentElementLI("subheader", label, null);
}

function getContentBlockText(id, labeltxt, spantxt)
{
	// <li class="entry"><select class="rounded" id="registercfg_country_sdesc" name="cfg_country_sdesc" configuration="COUNTRIES|COUNTRY_US|registercfg_region_sdesc"></select></li>
	var li = getContentElementLI("text", null, null);
	li.css("clear","both");
	var label = $("<label/>").attr("class", "formlabel").text(labeltxt);
	var span = $("<span/>").attr("id", id).css("float","right").text(spantxt);
	
	li.append(label);
	li.append(span);
	return li;
}

function getContentBlockElementImage(val, uid, mimesuid)
{
    mimesuid = eval("val." + mimesuid);
    var cb_li = $("<li/>")
		.attr("id", "r_cb_image_" + eval("val." + uid));
    if(mimesuid != "IMAGE_NOT_PROVIDED_FOR_UPLOADED")
	{
	    var cb_li_image = $("<img/>")
	    	.attr("id", "r_cb_li_image_object_" + uid)
	    	.attr("task", "CB_IMAGE")
	    	.attr("loaded", "false")
	    	.attr("loadurl", "/_controls/ajax/DOWNLOAD_MIME.php?MIMEKEY=" + mimesuid)
    		.attr("src", "/_controls/ajax/DOWNLOAD_MIME.php?MIMEKEY=" + mimesuid);
	    cb_li_image.appendTo(cb_li);
	}
    return cb_li;
}