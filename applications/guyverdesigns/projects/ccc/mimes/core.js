$(document).ready(function()
{
	var divs = document.getElementsByTagName("td");
	for(var didx = 0; didx < divs.length; didx++)
	{
		if(divs[didx].id != "")
		{
			var did = divs[didx].id;
			if($("#" + did).attr("func") != "" && $("#" + did).attr("func") != null)
			{
				var func = $("#" + did).attr("func");
				var obj = $("#" + did);
				var dopreload = $("#" + did).attr("dopreload");
				if(dopreload != null && dopreload == "true")
					eval("gd_call_data_store(func, obj)");
				else
					eval(func + "(obj)");
			}
		}
	}
});

function gd_call_data_store(func, obj)
{
	var table = $("#" + obj.attr("id")).attr("table");
	$.getJSON("jsons/json_ordercreate.jsp?GD_REQ_KEY_JSON_TABLENAME=" + table, function(json) {
		gd_show_message("#" + obj.attr("id") + " table " + table + " jsond ");
		eval(func + "(obj, json)");
	});
}

/**
 * This builds a Select Option or DrpDown box using json data.
 * So please ensure you are getting the data from json.
 * Finally this element will take the did as the value of the option
 * and the dvl will be used for the display
 * @param obj
 * @param jsond
 * @param did
 * @param dvl
 */
function gd_build_selection_element(obj, jsond, did, dvl)
{
	gd_build_selection_element_directjsondata(obj, eval("jsond." + obj.attr("table")), did, dvl);
}
function gd_build_selection_element_directjsondata(obj, jsond, did, dvl)
{
	var elementId = gd_getuser_interface_element_id(obj);
	$("#" + obj.attr("id")).html("");
	$("<select/>", {
		id:elementId,
		name:elementId		
	}).css("width","100px").appendTo("#" + obj.attr("id"));

	$.each(jsond, function(key, val)
	{
		var id = eval("val." + did);
		var vl = eval("val." + dvl);
		var price = eval("val.price");
		var pcondition = eval("val.pcondition");
		if(pcondition == null)
			pcondition = "GD_CCC_ADDITION";
		$('<option />').val(id)
			.text(vl)
			.attr("zprice", price)
			.attr("zpricecondition", pcondition)
			.appendTo("#" + elementId);
	});
	
	var onChangeMethod = null;
	var onchange = obj.attr("onchange");
	if(onchange != null && onchange == "true")
	{
		onChangeMethod = obj.attr("id") + "OnChange";
	}
	else
	{
		onChangeMethod = "gd_add_to_data_holder_select";
	}
	
	try
	{
		if(typeof eval(onChangeMethod) == "function")
		{ 
			$("#" + elementId).change(function()
			{
				eval(onChangeMethod + "(obj)");
				if(typeof eval("zgd_do_pricing_routine") == "function")
				{
					zgd_do_pricing_routine(obj);
					ZGD_Calculate_Pricing();
				}
			});
		}
		else
		{
			gd_show_message("The Method " + onChangeMethod + "OnChange does not exist for Registration to onchange event.");
		}
		
	}
	catch(e)
	{
		gd_show_message("The Method " + onChangeMethod + "OnChange does not exist for Registration to onchange event.");
	}
}

/**
 * Build the Input Element
 * @param obj
 */
function gd_build_input_element(obj)
{
	var elementId = gd_getuser_interface_element_id(obj);
	$("<input/>", {
		id:elementId,
		name:elementId,
		type:"text"
	}).appendTo("#" + obj.attr("id"));

	var onKeyupMethod = null;
	var onkeyup = obj.attr("onkeyup");
	if(onkeyup != null && onkeyup == "true")
	{
		onKeyupMethod = obj.attr("id") + "OnKeyUp";
	}
	else
	{
		onKeyupMethod = "gd_add_to_data_holder_input";
	}
	
	try
	{
		if(typeof eval(onKeyupMethod) == "function")
		{ 
			$(elementId).keyup(function()
			{
				eval(onKeyupMethod + "(obj)");
			});
		}
		else
		{
			gd_show_message("The Method " + onKeyupMethod + "OnKeyup does not exist for Registration to onkeyup event.");
		}
	}
	catch(e)
	{
		gd_show_message("The Method " + onKeyupMethod + "OnKeyup does not exist for Registration to onkeyup event.");
	}
}

/**
 * default method for capturing the data the user has chosen using a select option
 * @param obj
 */
function gd_add_to_data_holder_select(obj)
{
	gd_data_holder.setItem(obj.attr("id"), $("#" + obj.attr("id") + " :selected").val());
}

/**
 * default method for capturing the data the user has chosen using a select option
 * @param obj
 */
function gd_add_to_data_holder_input(obj)
{
	gd_data_holder.setItem(obj.attr("id"), $("#" + obj.attr("id")).val());
}

/**
 * Get UIE Standard
 */
function gd_getuser_interface_element_id(obj)
{
	return ("CCCUIE" + obj.attr("id"));
}

/**
 * Method for building a HashTable
 */
var gd_data_holder = new HashTable();
function HashTable(obj)
{
    this.length = 0;
    this.items = {};
    for (var p in obj) {
        if (obj.hasOwnProperty(p)) {
            this.items[p] = obj[p];
            this.length++;
        }
    }

    this.setItem = function(key, value)
    {
        var previous = undefined;
        if (this.hasItem(key)) {
            previous = this.items[key];
        }
        else {
            this.length++;
        }
        this.items[key] = value;
        return previous;
    }

    this.getItem = function(key) {
        return this.hasItem(key) ? this.items[key] : undefined;
    }

    this.hasItem = function(key)
    {
        return this.items.hasOwnProperty(key);
    }
   
    this.removeItem = function(key)
    {
        if (this.hasItem(key)) {
            previous = this.items[key];
            this.length--;
            delete this.items[key];
            return previous;
        }
        else {
            return undefined;
        }
    }

    this.keys = function()
    {
        var keys = [];
        for (var k in this.items) {
            if (this.hasItem(k)) {
                keys.push(k);
            }
        }
        return keys;
    }

    this.values = function()
    {
        var values = [];
        for (var k in this.items) {
            if (this.hasItem(k)) {
                values.push(this.items[k]);
            }
        }
        return values;
    }

    this.each = function(fn) {
        for (var k in this.items) {
            if (this.hasItem(k)) {
                fn(k, this.items[k]);
            }
        }
    }

    this.clear = function()
    {
        this.items = {}
        this.length = 0;
    }
}

/**
 * Shows an error message for debugging
 * @param message
 */
function gd_show_message(message)
{
	try
	{
		message = $("#gd_debug_message").val() + "\n" + message;
		$("#gd_debug_message").val(message);
	}
	catch(e){}
}

function gd_onload_select_preload_json(obj, jsond)
{
	gd_build_selection_element(obj, jsond, "id", "val");
	try
	{
		eval(obj.attr("id") + "OnLoad(obj, jsond)");
	}
	catch(e)
	{
		gd_show_message("The Method " + obj.attr("id") + "OnLoad(obj, jsond) does not exist.");
	}
}

function gd_onload_select_preload_json_initvalued(obj, jsond)
{
	gd_build_selection_element(obj, jsond, "id", "val");
	var elementId = gd_getuser_interface_element_id(obj);
	$("#" + elementId).val(obj.attr("initvalue"));
	try
	{
		eval(obj.attr("id") + "OnLoad(obj, jsond)");
	}
	catch(e)
	{
		gd_show_message("The Method " + obj.attr("id") + "OnLoad(obj, jsond) does not exist.");
	}
}

/**
 * Extends the Input Element Build and adds the init value to the 
 * elelment for display
 * @param obj
 */
function gd_build_input_element_disabled_initvalued(obj)
{
	var elementId = gd_getuser_interface_element_id(obj);
	gd_build_input_element(obj);
	$("#" + elementId).val(obj.attr("initvalue"));
}

/**
 * Extends the Input Element Build and adds the init value to the 
 * elelment for display
 * @param obj
 */
function gd_build_input_element_initvalued(obj)
{
	var elementId = gd_getuser_interface_element_id(obj);
	gd_build_input_element(obj);
	$("#" + elementId).val(obj.attr("initvalue"));
}