var zgd_price_keyidx = new Array();		// Key to IDX
var zgd_price_keys = new Array();		// Pricing Keys
var zgd_price_ofitems = new Array();	// Pricing OfItem
var zgd_price_conditions = new Array();	// Pricing Condition
var zgd_price_counter = 0;

var zgd_subtotal = new Array();

/**
 * This method is designed to allow the developer to
 * define the condition with the function used to price
 * the object
 * @param cond
 * @param func
 */
function zgd_do_pricing_routine(obj)
{
	var sseleid = gd_getuser_interface_element_id($("#" + obj.attr("id")));
	var sselepc = $("#" + sseleid + " :selected").attr("zprice");
	var sselecd = $("#" + sseleid + " :selected").attr("zpricecondition");
	
	if(zgd_price_keyidx[obj.attr("id")] == null)
	{
		zgd_price_keyidx[obj.attr("id")] = zgd_price_counter;
		zgd_price_keys[zgd_price_counter] = obj.attr("id");
		zgd_price_ofitems[zgd_price_counter] = sselepc;
		zgd_price_conditions[zgd_price_counter] = sselecd;
		
		zgd_price_counter++;
	}
	else
	{
		var idx = zgd_price_keyidx[obj.attr("id")];
		zgd_price_ofitems[idx] = sselepc;
		zgd_price_conditions[idx] = sselecd;
	}
	var pidx = zgd_price_keyidx[obj.attr("id")];
	/*
	alert("obj.attr('id') - " + obj.attr("id")
	+ "\n" + "zgd_price_keyidx - " + zgd_price_keyidx[obj.attr("id")] 
	+ "\n" + "zgd_price_keys - " + zgd_price_keys[pidx]
	+ "\n" + "zgd_price_ofitems - " + zgd_price_ofitems[pidx]
	+ "\n" + "zgd_price_conditions - " + zgd_price_conditions[pidx]);
	*/
}

/**
 * Used to Calculate Pricing
 * @param key	= For Each Element a Price is Defined to be used
 * @param price	= This is price assigned to the Element
 */
function ZGD_Calculate_Pricing()
{
	zgd_subtotal["SUBTOTAL_1"] = 0;
	zgd_subtotal["SUBTOTAL_2"] = 0;
	zgd_subtotal["SUBTOTAL_3"] = 0;
	zgd_subtotal["SUBTOTAL_4"] = 0;
	zgd_subtotal["SUBTOTAL_5"] = 0;
	zgd_subtotal["SUBTOTAL_6"] = 0;
	//alert(zgd_price_keyidx.length);
	for(var idx = 0; idx < zgd_price_counter; idx++)
	{
		//alert(zgd_price_conditions[idx]);
		eval(zgd_price_conditions[idx] + "('" + idx + "')");
	}
	$("#gdVHPricingBlockSubTotal1").html(zgd_subtotal["SUBTOTAL_1"] + "&nbsp;").attr("align", "right");
	$("#gdVHPricingBlockSubTotal2").html(zgd_subtotal["SUBTOTAL_2"] + "&nbsp;").attr("align", "right");
	$("#gdVHPricingBlockSubTotal3").html(zgd_subtotal["SUBTOTAL_3"] + "&nbsp;").attr("align", "right");
}

/** Standard Pricing Functions **/
function GD_CCC_BASE_PRICE(idx)
{
	zgd_subtotal["SUBTOTAL_1"] = zgd_price_ofitems[idx];
	zgd_subtotal["SUBTOTAL_2"] = zgd_price_ofitems[idx];
}
function GD_CCC_ADDITION(idx)
{
	if(zgd_price_ofitems[idx] != "STD")
	{
		if(zgd_price_keys[idx] == "gdVCCabInteriorWindowsLHStyle")
		{
			if(zgd_price_keyidx["gdVCCabInteriorWindowsLHControl"] == null)	// has not been selected
			{
				zgd_subtotal["SUBTOTAL_2"] = parseInt(zgd_subtotal["SUBTOTAL_2"]) + parseInt(zgd_price_ofitems[idx]);
				zgd_subtotal["SUBTOTAL_3"] = parseInt(zgd_subtotal["SUBTOTAL_3"]) + parseInt(zgd_price_ofitems[idx]);

				$("#gdVCCabInteriorWindowsLHStylePriceDisplayBox").html(zgd_price_ofitems[idx] + "&nbsp;");
			}
			else
			{
				var ciwlhcidx = zgd_price_keyidx["gdVCCabInteriorWindowsLHControl"];
				var ltotal = parseInt(zgd_price_ofitems[idx]) + parseInt(zgd_price_ofitems[ciwlhcidx]);
	
				$("#gdVCCabInteriorWindowsLHStylePriceDisplayBox").html(ltotal + "&nbsp;");
			}
		}
		else if(zgd_price_keys[idx] == "gdVCCabInteriorWindowsRHStyle")
		{
			if(zgd_price_keyidx["gdVCCabInteriorWindowsRHControl"] == null)	// has not been selected
			{
				zgd_subtotal["SUBTOTAL_2"] = parseInt(zgd_subtotal["SUBTOTAL_2"]) + parseInt(zgd_price_ofitems[idx]);
				zgd_subtotal["SUBTOTAL_3"] = parseInt(zgd_subtotal["SUBTOTAL_3"]) + parseInt(zgd_price_ofitems[idx]);

				$("#gdVCCabInteriorWindowsRHStylePriceDisplayBox").html(zgd_price_ofitems[idx] + "&nbsp;");
			}
			else
			{
				var ciwrhcidx = zgd_price_keyidx["gdVCCabInteriorWindowsRHControl"];
				var ltotal = parseInt(zgd_price_ofitems[idx]) + parseInt(zgd_price_ofitems[ciwrhcidx]);
	
				$("#gdVCCabInteriorWindowsRHStylePriceDisplayBox").html(ltotal + "&nbsp;");
			}
		}
		else if(zgd_price_keys[idx] == "gdVCBatteryBoxMetal")
		{
			if(zgd_price_keyidx["gdVCBatteryCapabilities"] == null)	// has not been selected
			{
				zgd_subtotal["SUBTOTAL_2"] = parseInt(zgd_subtotal["SUBTOTAL_2"]) + parseInt(zgd_price_ofitems[idx]);
				zgd_subtotal["SUBTOTAL_3"] = parseInt(zgd_subtotal["SUBTOTAL_3"]) + parseInt(zgd_price_ofitems[idx]);

				$("#" + zgd_price_keys[idx] + "PriceDisplayBox").html(zgd_price_ofitems[idx] + "&nbsp;");
			}
			else
			{
				var bcidx = zgd_price_keyidx["gdVCBatteryCapabilities"];
				var ltotal = parseInt(zgd_price_ofitems[idx]) + parseInt(zgd_price_ofitems[bcidx]);
	
				$("#gdVCBatteryBoxMetalPriceDisplayBox").html(ltotal + "&nbsp;");
			}
		}
		else
		{
			zgd_subtotal["SUBTOTAL_2"] = parseInt(zgd_subtotal["SUBTOTAL_2"]) + parseInt(zgd_price_ofitems[idx]);
			zgd_subtotal["SUBTOTAL_3"] = parseInt(zgd_subtotal["SUBTOTAL_3"]) + parseInt(zgd_price_ofitems[idx]);

			$("#" + zgd_price_keys[idx] + "PriceDisplayBox").html(zgd_price_ofitems[idx] + "&nbsp;");
		}
		$("#" + zgd_price_keys[idx] + "PriceDisplayBox").attr("align", "right");
	}
	else
	{
		$("#" + zgd_price_keys[idx] + "PriceDisplayBox").html(zgd_price_ofitems[idx] + "&nbsp;");
		$("#" + zgd_price_keys[idx] + "PriceDisplayBox").attr("align", "left");
	}
}
