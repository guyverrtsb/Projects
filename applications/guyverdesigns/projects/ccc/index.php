<?php
require_once("../../gd.trxn.com/_controls/classes/_core.php");
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>CCC - Order Create</title>
<link rel="stylesheet" type="text/css" href="/ccc/com.gd.core.mimes/css/cleanbasic.css"/>
<script src="/ccc/com.gd.core.mimes/js/jquery-1.7.1.js"></script>
<script src="/ccc/com.gd.core.mimes/js/jquery.metadata.js"></script>
<script src="/ccc/com.gd.core.mimes/js/jquery.tablesorter.js"></script>
<script src="/ccc/com.gd.core.mimes/js/jquery.tmpl.1.1.1.js"></script>
<script src="/ccc/com.gd.core.mimes/js/jquery.guyverdesigns-0.0.1.js.jsp"></script>
<script src="/ccc/mimes/js/core.js"></script>
<script src="/ccc/mimes/js/GD_JQ_Pricing_Engine.js"></script>
</head>
 <style id="home">
body    {
     background-color:#ffffff; color:#000000;   }
div { position:relative;float:left;}
table   {
    border-collapse: collapse;
    padding:0px 0px 0px 0px;
    margin-bottom:0px;
    background-color:#ffffff;   }
td  {
    padding:0;
    padding-top:1px; padding-bottom:1px;
    border-spacing:0px 0px; 
    border:0px red solid;
    font-size:12px; font-weight:bold; }
input, select   {
    font-size:10px; }
input   {
    background-color:#ffffff; border:1px solid #cecece; }
textarea    {
    font-size:10px;}
#ContentWrapper {
    margin:0px auto; background-color:#ffffff;
    width:1000px; height:1500px; float:none; }
#PageHeader div {
     height:65px;
    color:red;  }
#DOC_TITLE  {
    width:350px; padding-left:55px; }
// ********************* Start - Form Header
.gdFHLbl    { padding-left:5px; padding-right:5px; white-space:nowrap; }
.gdFH01 { width:200px;}
.gdFH02 { width:150px;}
//.gdFH03   { width:50px; }
.gdFH04 { width:100px;}
//.gdFH05   { width:75px;}
.gdFH06 { width:300px;}
.gdFH07 { width:50px;}
//.gdFH08   { width:50px;}
.gdFH09 { width:100px;}
// ********************* End - Form Header
// ********************* Start - Order Header
.gdOHFLbl   { padding-left:5px; padding-right:5px; white-space:nowrap; }
//.gdOHF01  { width:110px;}
.gdOHF02    { width:300px; border-right:1px solid #000000;}
//.gdOHF03  { width:110px; }
.gdOHF04    { width:300px; border-right:1px solid #000000;  }
//.gdOHF05  { width:50px; }
.gdOHF06    { width:50px;}
//.gdOHF07  { width:50px;}
.gdOHF08    { width:100px;}
// ********************* End - Order Header
// ********************* Start - Vehical Header
.gdVHLbl    { padding-left:5px; padding-right:5px; white-space:nowrap; }
//.gdVH01   { width:110px;}
.gdVH02 { width:200px;}
//.gdVH03   { width:110px;}
.gdVH04 { width:200px;}
//.gdVH05   { width:110px;}
.gdVH06 { width:200px;}
//.gdVH07   { width:110px;}
.gdVH08 { width:200px;}
// ********************* End - Vehical Header
// ********************* Start - Vehical Configurator
.gdVHLbl01  { padding-left:5px; padding-right:5px; white-space:nowrap; }
.gdVHLbl02b { padding-left:10px; padding-right:5px; white-space:nowrap; color:#000000; }
.gdVHLbl02r { padding-left:10px; padding-right:5px; white-space:nowrap; color:red; }
.gdVHLbl03  { padding-left:15px; padding-right:5px; white-space:nowrap; }
.gdVHConfigBlock    { width:200px; }
.gdVHPricingBlock   { width:150px; border-left:1px solid #000000; border-right:1px solid #000000;   }
.gdVHLPntbl01   { width:100px; }
// ********************* End - Vehical Configurator
</style>
<!-- **************************** SCRIPT CORE Engine -->
<script>
function gd_call_data_store_on_demand(func, table)
{
    $.getJSON("jsons/json.php?GD_REQ_KEY_JSON_TABLENAME=" + table, function(json) {
        eval(func + "(json)");
    });
}
//** OnLoad
// ** OnClick
function gdSubmitOrderOnClick(obj)
{
    document.gdOrderDataForm.action = "paintchart.jsp";
    document.gdOrderDataForm.submit();
}

function gdChangeOrderOnClick(obj)
{
    document.gdOrderDataForm.action = "orderchange.jsp";
    document.gdOrderDataForm.submit();
}
//** OnChange
function gdOrderHeaderModelOnChange(obj)
{
    gd_call_data_store_on_demand("gdShowModelComponents", "model_to_engine_to_more");
}
function gdShowModelComponents(jsond)
{
    var sseleid = gd_getuser_interface_element_id($("#gdOrderHeaderModel"));
    var sseleval = $("#" + sseleid + " :selected").val();
    
    var subele = new Array(
        "gdVCEngine|2"
        ,"gdVCFrontAxel|2"
        ,"gdVCRearAxel|2"
        ,"gdVCRearSuspension|2"
        ,"gdVCFrameType|2"
        ,"gdVCCabInteriorWindowsLHStyle|2"
        ,"gdVCCabInteriorWindowsRHStyle|2"
        ,"gdVCFrontSuspension|2"
        );
    
    for(var subeleidx = 0; subeleidx < subele.length; subeleidx++)
    {
        var eleid = subele[subeleidx].split("|")[0];
        var type = subele[subeleidx].split("|")[1];
        if(type == "1")
        {
            $("#" + eleid).html(eval("jsond['" + sseleval + "'][0]['" + eleid + "'][0].val" ));
        }
        else if(type == "2")
        {
            if(eleid == "gdVCEngine"
                    || eleid == "gdVCCabInteriorWindowsLHStyle"
                    || eleid == "gdVCCabInteriorWindowsRHStyle")
                $("#" + eleid).attr("onchange", "true");
            
            var jo = eval("jsond['" + sseleval + "'][0]['" + eleid + "']" );
            gd_build_selection_element_directjsondata(
                $("#" + eleid),
                jo,
                "id",
                "val");
        }
    }
}
function gdVCEngineOnChange(obj)
{
    gd_call_data_store_on_demand("gdShowEngineComponents", "engine_to_other_items");
}
function gdShowEngineComponents(jsond)
{
    var sseleid = gd_getuser_interface_element_id($("#gdVCEngine"));
    var sseleval = $("#" + sseleid + " :selected").val();

    var subele = new Array(
        "gdVCEngineTorque|1"
        ,"gdVCEngineRPM|1"
        ,"gdVCAirCompressor|1"
        ,"gdVCBatteryBoxMetal|2"
        ,"gdVCBatteryCapabilities|2"
        ,"gdVCStarter|2"
        ,"gdVCAlternator|2"
        ,"gdVCFilterSeperator|2"
        ,"gdVCFuelTank|2"
        ,"gdVCFuelTankLocation|2"
        ,"gdVCFuelTankAccess01|2"
        ,"gdVCTransRetarderSpeed|2"
        );
    
    for(var subeleidx = 0; subeleidx < subele.length; subeleidx++)
    {
        var eleid = subele[subeleidx].split("|")[0];
        var type = subele[subeleidx].split("|")[1];
        if(type == "1")
        {
            $("#" + eleid).html(eval("jsond['" + sseleval + "'][0]['" + eleid + "'][0].val" ));
        }
        else if(type == "2")
        {
            var jo = eval("jsond['" + sseleval + "'][0]['" + eleid + "']" );
            gd_build_selection_element_directjsondata(
                $("#" + eleid),
                jo,
                "id",
                "val");
        }
    }
}
function gdVCCabInteriorWindowsLHStyleOnChange(obj)
{
    gd_call_data_store_on_demand("gdVCCabInteriorWindowsLHStyleComponents", "lh_controls_mirrors");
}
function gdVCCabInteriorWindowsLHStyleComponents(jsond)
{
    var sseleid = gd_getuser_interface_element_id($("#gdVCCabInteriorWindowsLHStyle"));
    var sseleval = $("#" + sseleid + " :selected").val();
    
    var subele = new Array(
        "gdVCCabInteriorWindowsLHControl|2"
        ,"gdVCCabInteriorMirrorLH|2"
        );
    
    for(var subeleidx = 0; subeleidx < subele.length; subeleidx++)
    {
        var eleid = subele[subeleidx].split("|")[0];
        var type = subele[subeleidx].split("|")[1];
        if(type == "1")
        {
            $("#" + eleid).html(eval("jsond['" + sseleval + "'][0]['" + eleid + "'][0].val" ));
        }
        else if(type == "2")
        {
            var jo = eval("jsond['" + sseleval + "'][0]['" + eleid + "']" );
            gd_build_selection_element_directjsondata(
                $("#" + eleid),
                jo,
                "id",
                "val");
        }
    }
}
function gdVCCabInteriorWindowsRHStyleOnChange(obj)
{
    gd_call_data_store_on_demand("gdVCCabInteriorWindowsRHStyleComponents", "rh_controls_mirrors");
}
function gdVCCabInteriorWindowsRHStyleComponents(jsond)
{
    var sseleid = gd_getuser_interface_element_id($("#gdVCCabInteriorWindowsRHStyle"));
    var sseleval = $("#" + sseleid + " :selected").val();
    
    var subele = new Array(
        "gdVCCabInteriorWindowsRHControl|2"
        ,"gdVCCabInteriorMirrorRH|2"
        );
    
    for(var subeleidx = 0; subeleidx < subele.length; subeleidx++)
    {
        var eleid = subele[subeleidx].split("|")[0];
        var type = subele[subeleidx].split("|")[1];
        if(type == "1")
        {
            $("#" + eleid).html(eval("jsond['" + sseleval + "'][0]['" + eleid + "'][0].val" ));
        }
        else if(type == "2")
        {
            var jo = eval("jsond['" + sseleval + "'][0]['" + eleid + "']" );
            gd_build_selection_element_directjsondata(
                $("#" + eleid),
                jo,
                "id",
                "val");
        }
    }
}
</script>
<script>
function gd_select_load_json(obj, jsond)
{
    gd_build_selection_element(obj, jsond, "id", "val");
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
function gd_build_selection_element_from_multivalue(obj, jsond, did, dvl)
{
    var elementId = gd_getuser_interface_element_id(obj);
    $("<select/>", {
        id:elementId,
        name:elementId      
    }).css("width","100px").appendTo("#" + obj.attr("id"));
    
    $.each(eval("jsond['" + obj.attr("table") + "']"), function(key, val)
    {
        var id = eval("val." + did);
        var vl = eval("val." + dvl);
        //alert(jsond + "\n" + obj.attr("table") + "\n" + elementId + "\nid" + id + "\nvl" + vl);
        $('<option />').val(id)
            .text(vl)
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
 * Extends the Input Element Build and adds the init value to the 
 * elelment for display
 * @param obj
 */
function gd_build_input_element_initvalued_styled(obj)
{
    var elementId = gd_getuser_interface_element_id(obj);
    gd_build_input_element(obj);
    $("#" + elementId).val(obj.attr("initvalue"));
    $("#" + elementId).attr("style", obj.attr("elestyle"));
}
</script>
<body>
<div id="ContentWrapper">
<form id="gdOrderDataForm" name="gdOrderDataForm" action="" method="post">
<!-- ********************* Start - Page Header -->
<div id="PageHeader">
<div id="CCC_LOGO"><img src="/ccc/mimes/images/ccc_logo.png"/></div>
<div id="CCC_TITLE">The Heavy Truck Specialists</div>
<div id="DOC_TITLE">Order Entry</div>
<div id="DOC_BUTTONS"><input type="button" id="" name="" value="Open PDFs"/><br/>
<input type="button" id="" name="" value="MPH <> KPH"/></div>
<div id="DOC_LABEL">Pricing 2012</div>
</div>
<!-- ********************* End - Page Header -->
<!-- ********************* Start - Form Header -->
<div id="FormHeader">
<table style="border:1px solid #000000;">
<tr>
<td class="gdFHLbl">Regional Sales Manager</td>
<td class="gdFH02" id="gdRegionalSalesMgr" func="gd_onload_select_preload_json_initvalued" table="reg_sales_mgr" dopreload="true" initvalue="<%= dp.getGDData("gdRegionalSalesMgr") %>"></td>
<td class="gdFHLbl">P.O.#</td>
<td class="gdFH04" id="gdRegionalSalesPO" func="gd_build_input_element_initvalued_styled" elestyle="width:100px" initvalue="<%= dp.getGDData("gdRegionalSalesPO") %>"></td>
<td class="gdFHLbl">Email:</td>
<td class="gdFH06" id="gdRegionalSalesEmail" func="gd_build_input_element_initvalued_styled" elestyle="width:200px" initvalue="<%= dp.getGDData("gdRegionalSalesEmail") %>"></td>
<td class="gdFH07" id="gdRegionalSalesCountry" func="gd_onload_select_preload_json_initvalued" table="reg_sales_country" dopreload="true" initvalue="<%= dp.getGDData("gdRegionalSalesCountry") %>"></td>
<td class="gdFHLbl">Date:</td>
<td class="gdFH09" id="gdRegionalSalesDate" func="gd_build_input_element_initvalued" initvalue="<%= dp.getGDData("gdRegionalSalesDate") %>"></td>
</tr>
</table>
</div>
<!-- ********************* End - Form Header -->
<!-- ********************* Start - Order Header -->
<div id="OrderHeaderForm">
<table style="border:1px solid #000000;">
<tr>
<td class="gdOHFLbl">Purchaser:</td>
<td class="gdOHF02" id="gdOHFPurchaser" func="gd_build_input_element_initvalued_styled" elestyle="width:250px" initvalue="<%= dp.getGDData("gdOHFPurchaser") %>"></td>
<td class="gdOHFLbl">For Sale To:</td>
<td class="gdOHF04" id="gdOHFForSaleTo" func="gd_build_input_element_initvalued_styled" elestyle="width:250px" initvalue="<%= dp.getGDData("gdOHFForSaleTo") %>"></td>
<td class="gdOHFLbl">OEF:</td>
<td id="gdOHFOEF" colspan="3" func="gd_build_input_element_initvalued" initvalue="<%= dp.getGDData("gdOHFOEF") %>"></td>
</tr>
<tr>
<td class="gdOHFLbl">Address:</td>
<td class="gdOHF02" id="gdOHFAddress01" func="gd_build_input_element_initvalued_styled" elestyle="width:250px" initvalue="<%= dp.getGDData("gdOHFAddress01") %>"></td>
<td class="gdOHFLbl">Address:</td>
<td class="gdOHF04" id="gdOHFAddress02" func="gd_build_input_element_initvalued_styled" elestyle="width:250px" initvalue="<%= dp.getGDData("gdOHFAddress02") %>"></td>
<td class="gdOHFLbl">Rev:</td>
<td class="gdOHF06" id="gdOHFRev" func="gd_build_input_element_initvalued" initvalue="<%= dp.getGDData("gdOHFRev") %>"></td>
<td class="gdOHFLbl">Date:</td>
<td class="gdOHF08" id="gdOHFDate" func="gd_build_input_element_initvalued" initvalue="<%= dp.getGDData("gdOHFDate") %>"></td>
</tr>
<tr>
<td class="gdOHFLbl">City/State/ZIP:</td>
<td class="gdOHF02" id="gdOHFCityStateZip01" func="gd_build_input_element_initvalued_styled" elestyle="width:250px" initvalue="<%= dp.getGDData("gdOHFCityStateZip01") %>"></td>
<td class="gdOHFLbl">City/State/ZIP:</td>
<td class="gdOHF04" id="gdOHFCityStateZip02" func="gd_build_input_element_initvalued_styled" elestyle="width:250px" initvalue="<%= dp.getGDData("gdOHFCityStateZip02") %>"></td>
<td class="gdOHFLbl">S/N:</td>
<td class="gdOHF06" id="gdOHFSN02" colspan="3" func="gd_build_input_element_initvalued" initvalue="<%= dp.getGDData("gdOHFSN02") %>"></td>
</tr>
<tr>
<td class="gdOHFLbl">ATTN:</td>
<td class="gdOHF02" id="gdOHFATTN01" func="gd_build_input_element_initvalued_styled" elestyle="width:250px" initvalue="<%= dp.getGDData("gdOHFATTN01") %>"></td>
<td class="gdOHFLbl">ATTN:</td>
<td class="gdOHF04" id="gdOHFATTN02" func="gd_build_input_element_initvalued_styled" elestyle="width:250px" initvalue="<%= dp.getGDData("gdOHFATTN02") %>"></td>
<td class="gdOHFLbl">QTY:</td>
<td id="gdOrderHeaderQuantity" func="gd_onload_select_preload_json_initvalued" table="order_header_qty" dopreload="true" initvalue="<%= dp.getGDData("gdOrderHeaderQuantity") %>"></td>
<td id="gdOHFSN" id="gdOHFQTY" colspan="2"></td>
</tr>
<tr>
<td class="gdOHFLbl">Telephone:</td>
<td class="gdOHF02" id="gdOHFTel01" func="gd_build_input_element_initvalued_styled" elestyle="width:250px" initvalue="<%= dp.getGDData("gdOHFTel01") %>"></td>
<td class="gdOHFLbl">Telephone:</td>
<td class="gdOHF04" id="gdOHFTel02" func="gd_build_input_element_initvalued_styled" elestyle="width:250px" initvalue="<%= dp.getGDData("gdOHFTel02") %>"></td>
<td class="gdOHFLbl" >Model:</td>
<td id="gdOrderHeaderModel" func="gd_onload_select_preload_json_initvalued" table="order_header_model" dopreload="true" initvalue="<%= dp.getGDData("gdOrderHeaderModel") %>" onchange="true"></td>
<td id="gdOrderHeaderCab" func="gd_onload_select_preload_json_initvalued" table="order_header_cab_type" dopreload="true" colspan="2" initvalue="<%= dp.getGDData("gdOrderHeaderCab") %>"></td>
</tr>
<tr>
<td class="gdOHFLbl">Fax:</td>
<td class="gdOHF02" id="gdOHFFax01" func="gd_build_input_element_initvalued_styled" elestyle="width:250px" initvalue="<%= dp.getGDData("gdOHFFax01") %>"></td>
<td class="gdOHFLbl">For Sale To:</td>
<td class="gdOHF04" id="gdOHFFax02" func="gd_build_input_element_initvalued_styled" elestyle="width:250px" initvalue="<%= dp.getGDData("gdOHFFax02") %>"></td>
<td class="gdOHFLbl">Spec#:</td>
<td class="gdOHF06" id="gdOHFSpec" colspan="3" func="gd_build_input_element_initvalued" initvalue="<%= dp.getGDData("gdOHFSpec") %>"></td>
</tr>
</table>
</div>
<!-- ********************* End - Order Header -->
<!-- ********************* Start - Vehical Header -->
<div id="VehicalHeader">
<table style="border:1px solid #000000;">
<tr>
<td class="gdVHLbl">Vocation (ie. FL, RL, ASL, MSL, RO):</td>
<td class="gdVH02" id="gdVHVocation" func="gd_build_input_element_initvalued_styled" elestyle="width:223px" initvalue="<%= dp.getGDData("gdVHVocation") %>"></td>
<td class="gdVHLbl">Body Make:</td>
<td class="gdVH04" id="gdVHBodyMake" func="gd_build_input_element_initvalued_styled" elestyle="width:220px" initvalue="<%= dp.getGDData("gdVHBodyMake") %>"></td>
<td class="gdVHLbl">Body Model:</td>
<td class="gdVH08" id="gdVHBodyModel" func="gd_build_input_element_initvalued_styled" elestyle="width:150px" initvalue="<%= dp.getGDData("gdVHBodyModel") %>"></td>
</tr>
</table>
</div>
<!-- ********************* End - Vehical Header -->
<!-- ********************* Start - Vehical Configurator -->
<div id="VehicalConfigurator">
<table style="border:1px solid #000000;">
<tr xcelrodid="20">
<td class="gdVHLbl01">Engine/Torque @ RPM:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCEngine"></td>
    <td id="gdVCEngineTorque"></td>
    <td id="gdVCEngineRPM"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock" id="gdVCEnginePriceDisplayBox"></td>
<td class="gdVHLbl01" colspan="2">Cab Construction:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCCabConstructionSide"></td>
    <td id="gdVCCabConstructionType"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock" style="width:100px;"></td>
</tr>
<tr xcelrodid="21">
<td class="gdVHLbl02r">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCEngineAccess01" func="gd_build_input_element_initvalued_styled" elestyle="width:225px" initvalue="<%= dp.getGDData("gdVCEngineAccess01") %>"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02b" colspan="2">Cab/Tilt Pump:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCCabConstructionCab"></td>
    <td id="gdVCCabConstructionTiltPump"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="22">
<td class="gdVHLbl02r">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCEngineAccess02" func="gd_build_input_element_initvalued_styled" elestyle="width:225px" initvalue="<%= dp.getGDData("gdVCEngineAccess02") %>"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02r" colspan="2">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCCabConstructionAccess02" func="gd_build_input_element_initvalued_styled" elestyle="width:225px" initvalue="<%= dp.getGDData("gdVCCabConstructionAccess02") %>"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="23">
<td class="gdVHLbl02r">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCEngineAccess03" func="gd_build_input_element_initvalued_styled" elestyle="width:225px" initvalue="<%= dp.getGDData("gdVCEngineAccess03") %>"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl01" colspan="2">Cab Exterior:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCCabExterior"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="24">
<td class="gdVHLbl02b">Block Heater:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCBlockHeater"></td>
    <td id="gdVCBlockHeaterVoltage"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02r" colspan="2">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCCabExteriorAccess01" func="gd_build_input_element_initvalued_styled" elestyle="width:225px" initvalue="<%= dp.getGDData("gdVCCabExteriorAccess01") %>"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="25">
<td class="gdVHLbl01">Air Compressor:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCAirCompressor" func="gd_build_input_element_initvalued_styled" elestyle="width:225px"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock" id="gdVCAirCompressorPriceDisplayBox"></td>
<td class="gdVHLbl02r" colspan="2">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCCabExteriorAccess02" func="gd_build_input_element_initvalued_styled" elestyle="width:225px" initvalue="<%= dp.getGDData("gdVCCabExteriorAccess02") %>"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="26">
<td class="gdVHLbl01">Cooling System:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCCoolingSystem"></td>
    <td id="gdVCCoolingSystemTemp"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02r" colspan="2">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCCabExteriorAccess03" func="gd_build_input_element_initvalued_styled" elestyle="width:225px" initvalue="<%= dp.getGDData("gdVCCabExteriorAccess03") %>"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="27">
<td class="gdVHLbl02b">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCCoolingSystemAccess01"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl01" colspan="2">Cab Interior:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCCabInterior"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="28">
<td class="gdVHLbl02r">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCCoolingSystemAccess02" func="gd_build_input_element_initvalued_styled" elestyle="width:225px" initvalue="<%= dp.getGDData("gdVCCoolingSystemAccess02") %>"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02b" colspan="2">Air Conditioning:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCCabInteriorAirConditioning"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="29">
<td class="gdVHLbl02r">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCCoolingSystemAccess03" func="gd_build_input_element_initvalued_styled" elestyle="width:225px" initvalue="<%= dp.getGDData("gdVCCoolingSystemAccess03") %>"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02b" colspan="2">Stereo:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCCabInteriorStereo"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="30">
<td class="gdVHLbl01">Air Intake:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCAirIntake"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02r" colspan="2">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCCabInteriorAccess01" func="gd_build_input_element_initvalued_styled" elestyle="width:225px" initvalue="<%= dp.getGDData("gdVCCabInteriorAccess01") %>"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="31">
<td class="gdVHLbl02b">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCAirIntakeAccess01"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02b">Doors / Windows:</td>
<td class="gdVHLbl02b">LH:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCCabInteriorWindowsLHStyle"></td>
    <td id="gdVCCabInteriorWindowsLHControl"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock" id="gdVCCabInteriorWindowsLHStylePriceDisplayBox"></td>
</tr>
<tr xcelrodid="32">
<td class="gdVHLbl02b">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCAirIntakeAccess02"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02b">&nbsp;</td>
<td class="gdVHLbl02b">RH:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCCabInteriorWindowsRHStyle"></td>
    <td id="gdVCCabInteriorWindowsRHControl"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock" id="gdVCCabInteriorWindowsRHStylePriceDisplayBox"></td>
</tr>
<tr xcelrodid="33">
<td class="gdVHLbl01">Exhaust:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCExhaust"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02b">Mirrors:</td>
<td class="gdVHLbl02b">LH:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCCabInteriorMirrorLH"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock" id="gdVCCabInteriorMirrorLHPriceDisplayBox"></td>
</tr>
<tr xcelrodid="34">
<td class="gdVHLbl02r">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCExhaustAccess01" func="gd_build_input_element_initvalued_styled" elestyle="width:225px" initvalue="<%= dp.getGDData("gdVCExhaustAccess01") %>"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02b"></td>
<td class="gdVHLbl02b">RH:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCCabInteriorMirrorRH"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock" id="gdVCCabInteriorMirrorRHPriceDisplayBox"></td>
</tr>
<tr xcelrodid="35">
<td class="gdVHLbl02r">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCExhaustAccess02" func="gd_build_input_element_initvalued_styled" elestyle="width:225px" initvalue="<%= dp.getGDData("gdVCExhaustAccess02") %>"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02b">Spot Mirrors:</td>
<td class="gdVHLbl02b">LH & RH</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCCabInteriorSpotMirrorsLHRH"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="36">
<td class="gdVHLbl01">Battery Box/Batteries:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCBatteryBoxMetal"></td>
    <td id="gdVCBatteryCapabilities"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock" id="gdVCBatteryBoxMetalPriceDisplayBox"></td>
<td class="gdVHLbl02b" colspan="2">Seats:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCCabInteriorSeats"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="37">
<td class="gdVHLbl02b">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCBatteryBoxLocation"></td>
    <td id="gdVCBatteryBoxSide"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02b">&nbsp;</td>
<td class="gdVHLbl02b">LH</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCCabInteriorSeatsLHFabric"></td>
    <td id="gdVCCabInteriorSeatsLHStyle"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="38">
<td class="gdVHLbl02b">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCBatteryBoxAccess02"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02b">&nbsp;</td>
<td class="gdVHLbl02b">RH Forward</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCCabInteriorSeatsRHFabric"></td>
    <td id="gdVCCabInteriorSeatsRHStyle"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="39">
<td class="gdVHLbl02b">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCBatteryBoxAccess03"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02b" colspan="2">&nbsp;</td>
<td class="gdVHConfigBlock"><table>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="40">
<td class="gdVHLbl01">Starter:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCStarter"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock" id="gdVCStarterPriceDisplayBox"></td>
<td class="gdVHLbl02b" colspan="2">&nbsp;</td>
<td class="gdVHConfigBlock"><table>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="41">
<td class="gdVHLbl01">Alternator:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCAlternator"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock" id="gdVCAlternatorPriceDisplayBox"></td>
<td class="gdVHLbl01" colspan="2">Instrumentation:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCInstrumentation"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="42">
<td class="gdVHLbl01">Fuel Tank:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCFuelTank"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock" id="gdVCFuelTankPriceDisplayBox"></td>
<td class="gdVHLbl02b" colspan="2">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCInstrumentationAccess01"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="43">
<td class="gdVHLbl02b">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCFuelTankLocation"></td>
    <td id="gdVCFuelTankSide"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock" id="gdVCFuelTankLocationPriceDisplayBox"></td>
<td class="gdVHLbl02b" colspan="2">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCInstrumentationAccess02"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="44">
<td class="gdVHLbl02b">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCFuelTankAccess01"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock" id="gdVCFuelTankAccess01PriceDisplayBox"></td>
<td class="gdVHLbl02r" colspan="2">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCInstrumentationAccess03" func="gd_build_input_element_initvalued_styled" elestyle="width:225px" initvalue="<%= dp.getGDData("gdVCInstrumentationAccess03") %>"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="45">
<td class="gdVHLbl02b">Filter/Seperator:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCFilterSeperator"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock" id="gdVCFilterSeperatorPriceDisplayBox"></td>
<td class="gdVHLbl02r" colspan="2">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCInstrumentationAccess04" func="gd_build_input_element_initvalued_styled" elestyle="width:225px" initvalue="<%= dp.getGDData("gdVCInstrumentationAccess04") %>"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="46">
<td class="gdVHLbl01">Trans / Retarder:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCTransRetarderSpeed"></td>
    <td id="gdVCTransRetarderRetard"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"id="gdVCTransRetarderSpeedPriceDisplayBox"></td>
<td class="gdVHLbl02b" colspan="2">Windshield Wiper(s):</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCInstrumentationWindshieldWipers" func="gd_build_input_element_initvalued_styled" elestyle="width:225px" initvalue="<%= dp.getGDData("gdVCInstrumentationWindshieldWipers") %>"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="47">
<td class="gdVHLbl02b">Controls:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCTransRetarderControls"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02b" colspan="2">Cab Elec./Lighting:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCInstrumentationCabElecLighting" func="gd_build_input_element_initvalued_styled" elestyle="width:225px" initvalue="<%= dp.getGDData("gdVCInstrumentationCabElecLighting") %>"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="48">
<td class="gdVHLbl02b">NIS/Auto Neutral:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCTransRetarderNIS"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02b" colspan="2">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCInstrumentationAccess05"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="49">
<td class="gdVHLbl02r">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCNISAccess01" func="gd_build_input_element_initvalued_styled" elestyle="width:225px" initvalue="<%= dp.getGDData("gdVCNISAccess01") %>"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02b" colspan="2">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCInstrumentationAccess06"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="50">
<td class="gdVHLbl02r">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCNISAccess02" func="gd_build_input_element_initvalued_styled" elestyle="width:225px" initvalue="<%= dp.getGDData("gdVCNISAccess02") %>"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02b" colspan="2">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCInstrumentationAccess07"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="51">
<td class="gdVHLbl02b">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCNISAccess03" func="gd_build_input_element_initvalued_styled" elestyle="width:225px" initvalue="<%= dp.getGDData("gdVCNISAccess03") %>"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02r" colspan="2">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCInstrumentationAccess08" func="gd_build_input_element_initvalued_styled" elestyle="width:225px" initvalue="<%= dp.getGDData("gdVCInstrumentationAccess08") %>"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="52">
<td class="gdVHLbl01">Propshafts:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCPropShafts"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02r" colspan="2">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCInstrumentationAccess09" func="gd_build_input_element_initvalued_styled" elestyle="width:225px" initvalue="<%= dp.getGDData("gdVCInstrumentationAccess09") %>"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="53">
<td class="gdVHLbl01">Front Axel:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCFrontAxel"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock" id="gdVCFrontAxelPriceDisplayBox"></td>
<td class="gdVHLbl02b" colspan="2">Back-Up Alarm:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCInstrumentationBackUpAlarm"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="54">
<td class="gdVHLbl02b">Wheel Seals:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCFrontAxelWheelSeals"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl01" colspan="2">Misc. Equipment:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCInstrumentationMiscEquipment"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="55">
<td class="gdVHLbl02b">Brakes:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCFrontAxelBrakes"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02b" colspan="2">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCInstrumentationMiscEquipmentAccess01"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="56">
<td class="gdVHLbl02b">Slack Adjusters:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCFrontAxelSlackAdjusters"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02b" colspan="2">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCInstrumentationMiscEquipmentAccess02"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="57">
<td class="gdVHLbl02r">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCFrontAxelAccess01" func="gd_build_input_element_initvalued_styled" elestyle="width:225px" initvalue="<%= dp.getGDData("gdVCFrontAxelAccess01") %>"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02b" colspan="2">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCInstrumentationMiscEquipmentAccess03"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="58">
<td class="gdVHLbl02b">Wheels:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCFrontAxelWheels"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02r" colspan="2">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCMiscEquipAccess04" func="gd_build_input_element_initvalued_styled" elestyle="width:225px" initvalue="<%= dp.getGDData("gdVCMiscEquipAccess04") %>"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="59">
<td class="gdVHLbl02b">Tires:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCFrontAxelTires"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02r" colspan="2">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCMiscEquipAccess05" func="gd_build_input_element_initvalued_styled" elestyle="width:225px" initvalue="<%= dp.getGDData("gdVCMiscEquipAccess05") %>"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="60">
<td class="gdVHLbl02b">Spare Wheel:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCFrontAxelSpareWheel"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02r" colspan="2">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCMiscEquipAccess06" func="gd_build_input_element_initvalued_styled" elestyle="width:225px" initvalue="<%= dp.getGDData("gdVCMiscEquipAccess06") %>"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="61">
<td class="gdVHLbl02b">Spare Tire:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCFrontAxelSpareTire"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02r" colspan="2">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCMiscEquipAccess07" func="gd_build_input_element_initvalued_styled" elestyle="width:225px" initvalue="<%= dp.getGDData("gdVCMiscEquipAccess07") %>"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="62">
<td class="gdVHLbl01">Front Suspension:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCFrontSuspension"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock" id="gdVCFrontSuspensionPriceDisplayBox"></td>
<td class="gdVHLbl02r" colspan="2">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCMiscEquipAccess08" func="gd_build_input_element_initvalued_styled" elestyle="width:225px" initvalue="<%= dp.getGDData("gdVCMiscEquipAccess08") %>"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="63">
<td class="gdVHLbl01">Steering Position:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCSteeringPosition"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02r" colspan="2">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCMiscEquipAccess09" func="gd_build_input_element_initvalued_styled" elestyle="width:225px" initvalue="<%= dp.getGDData("gdVCMiscEquipAccess09") %>"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="64">
<td class="gdVHLbl02r">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCSteeringPositionAccess01" func="gd_build_input_element_initvalued_styled" elestyle="width:225px" initvalue="<%= dp.getGDData("gdVCSteeringPositionAccess01") %>"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02r" colspan="2">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCMiscEquipAccess10" func="gd_build_input_element_initvalued_styled" elestyle="width:225px" initvalue="<%= dp.getGDData("gdVCMiscEquipAccess10") %>"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="65">
<td class="gdVHLbl01">Rear Axel:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCRearAxel"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock" id="gdVCRearAxelPriceDisplayBox"></td>
<td class="gdVHLbl01" colspan="2">Finish Paint:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td class="gdVHLPntbl01">Color:</td>
    <td class="gdVHLPntbl01">Color/Code:</td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="66">
<td class="gdVHLbl02b">Wheel Seals:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCRearAxelWheelSeals"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02b" colspan="2">Cab:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td class="gdVHLPntbl01" id="gdPaintCabColor" func="gd_onload_select_preload_json_initvalued" table="paint_cab_colors" dopreload="true" initvalue="<%= dp.getGDData("gdPaintCabColor") %>"></td>
    <td class="gdVHLPntbl01"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="67">
<td class="gdVHLbl02b">Brakes:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCRearAxelBrakes"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl03">Stripe:</td>
<td class="gdVHLbl2" id="gdPaintCabStrip" func="gd_onload_select_preload_json_initvalued" table="paint_cab_stripe" dopreload="true" initvalue="<%= dp.getGDData("gdPaintCabStrip") %>"></td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td class="gdVHLPntbl01" id="gdPaintCabStripColor" func="gd_onload_select_preload_json_initvalued" table="paint_cab_colors" dopreload="true" initvalue="<%= dp.getGDData("gdPaintCabStripColor") %>"></td>
    <td class="gdVHLPntbl01"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="68">
<td class="gdVHLbl02b">Wheels:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCRearAxelWheels"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02b" colspan="2">Bumper:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td class="gdVHLPntbl01" id="gdPaintBumperColor" func="gd_onload_select_preload_json_initvalued" table="paint_cab_colors" dopreload="true" initvalue="<%= dp.getGDData("gdPaintBumperColor") %>"></td>
    <td class="gdVHLPntbl01"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="69">
<td class="gdVHLbl02b">Tires:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCRearAxelTires"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl03">Stripe:</td>
<td class="gdVHLbl2" id="gdPaintBumperStrip" func="gd_onload_select_preload_json_initvalued" table="paint_bumper_stripe" dopreload="true" initvalue="<%= dp.getGDData("gdPaintBumperStrip") %>"></td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td class="gdVHLPntbl01" id="gdPaintBumperStripColor" func="gd_onload_select_preload_json_initvalued" table="paint_cab_colors" dopreload="true" initvalue="<%= dp.getGDData("gdPaintBumperStripColor") %>"></td>
    <td class="gdVHLPntbl01"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="70">
<td class="gdVHLbl02b">Ratio/Max. Speed:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCRearAxelRatioMaxSpeedRatio"></td>
    <td id="gdVCRearAxelRatioMaxSpeedMaxSpeed"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02b" colspan="2">Frame:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td class="gdVHLPntbl01" id="gdPaintFrameColor" func="gd_onload_select_preload_json_initvalued" table="paint_cab_colors" dopreload="true" initvalue="<%= dp.getGDData("gdPaintFrameColor") %>"></td>
    <td class="gdVHLPntbl01"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="71">
<td class="gdVHLbl02b">Slack Adjusters:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCRearAxelSlackAdjusters"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02b" colspan="2">Battery Box:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td class="gdVHLPntbl01" id="gdPaintBatteryBoxColor" func="gd_onload_select_preload_json_initvalued" table="paint_cab_colors" dopreload="true" initvalue="<%= dp.getGDData("gdPaintBatteryBoxColor") %>"></td>
    <td class="gdVHLPntbl01"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="72">
<td class="gdVHLbl02r">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCRearAxelAccess01" func="gd_build_input_element_initvalued_styled" elestyle="width:225px" initvalue="<%= dp.getGDData("gdVCRearAxelAccess01") %>"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02b" colspan="2">Fuel Tank:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td class="gdVHLPntbl01" id="gdPaintFuelTankColor" func="gd_onload_select_preload_json_initvalued" table="paint_cab_colors" dopreload="true" initvalue="<%= dp.getGDData("gdPaintFuelTankColor") %>"></td>
    <td class="gdVHLPntbl01"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="73">
<td class="gdVHLbl02b">Spare Wheel:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCRearAxelSpareWheel"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02b">Front Weels:</td>
<td class="gdVHLbl2" id="gdPaintFrontWheels" func="gd_onload_select_preload_json_initvalued" table="paint_front_wheels" dopreload="true" initvalue="<%= dp.getGDData("gdPaintFrontWheels") %>"></td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td class="gdVHLPntbl01" id="gdPaintFrontWheelsColor" func="gd_onload_select_preload_json_initvalued" table="paint_cab_colors" dopreload="true" initvalue="<%= dp.getGDData("gdPaintFrontWheelsColor") %>"></td>
    <td class="gdVHLPntbl01"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="74">
<td class="gdVHLbl02b">Spare Tire:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCRearAxelSpareTire"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02b">Rear Weels:</td>
<td class="gdVHLbl2" id="gdPaintRearWheels" func="gd_onload_select_preload_json_initvalued" table="paint_rear_wheels" dopreload="true" initvalue="<%= dp.getGDData("gdPaintRearWheels") %>"></td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td class="gdVHLPntbl01" id="gdPaintRearWheelsColor" func="gd_onload_select_preload_json_initvalued" table="paint_cab_colors" dopreload="true" initvalue="<%= dp.getGDData("gdPaintRearWheelsColor") %>"></td>
    <td class="gdVHLPntbl01"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="75">
<td class="gdVHLbl02b">Telma Retarder:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCRearAxelTelmaRetarder"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02b" colspan="2">&nbsp</td>
<td class="gdVHConfigBlock"><table>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="76">
<td class="gdVHLbl02r">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCRearAxelAccess02" func="gd_build_input_element_initvalued_styled" elestyle="width:225px" initvalue="<%= dp.getGDData("gdVCRearAxelAccess02") %>"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl01" colspan="3" style="border-top:1px solid #000000;">Additional Charges / Warranties (Non-Discounted):</td>
<td class="gdVHPricingBlock" style="border-top:1px solid #000000;"></td>
</tr>
<tr xcelrodid="77">
<td class="gdVHLbl01">Rear Suspension:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCRearSuspension"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock" id="gdVCRearSuspensionPriceDisplayBox"></td>
<td class="gdVHLbl02r" colspan="3">Standard Chassis Warranty - 12,000 Miles / 12 Months</td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="78">
<td class="gdVHLbl01">Tag/Pusher:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCTagPusher"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02r" colspan="3">Standard - 2 Year Cummins Engine Warranty</td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="79">
<td class="gdVHLbl02b">Wheels:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCTagPusherWheelsYN"></td>
    <td id="gdVCTagPusherWheelsType"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02r" colspan="3">Standard - 3 Year Allsion Edge II Partner Warranty</td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="80">
<td class="gdVHLbl02b">Tires:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCTagPusherTires"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02r" colspan="3">Standard - 2 Year Dana Axle Warranty</td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="81">
<td class="gdVHLbl02r">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCTagPusherAccess01" func="gd_build_input_element_initvalued_styled" elestyle="width:225px" initvalue="<%= dp.getGDData("gdVCTagPusherAccess01") %>"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02r" colspan="2">&nbsp;</td>
<td class="gdVHConfigBlock"><table>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="82">
<td class="gdVHLbl01">Frame:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCFrameType"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock" id="gdVCFrameTypePriceDisplayBox"></td>
<td class="gdVHLbl02r" colspan="2">&nbsp;</td>
<td class="gdVHConfigBlock"><table>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="83">
<td class="gdVHLbl02b">Bumper:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCFrameBumper"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02b" colspan="3" style="border-top:1px solid #000000;">LIST PRICE OF OPTIONS</td>
<td class="gdVHPricingBlock" style="border-top:1px solid #000000;" id="gdVHPricingBlockSubTotal3"></td>
</tr>
<tr xcelrodid="84">
<td class="gdVHLbl02r">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCFrameAccess01" func="gd_build_input_element_initvalued_styled" elestyle="width:225px" initvalue="<%= dp.getGDData("gdVCFrameAccess01") %>"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02b" colspan="3">LIST PRICE OF CHASSIS</td>
<td class="gdVHPricingBlock" id="gdVHPricingBlockSubTotal1"></td>
</tr>
<tr xcelrodid="85">
<td class="gdVHLbl02r">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCFrameAccess02" func="gd_build_input_element_initvalued_styled" elestyle="width:225px" initvalue="<%= dp.getGDData("gdVCFrameAccess02") %>"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02b" colspan="3">TOTAL LIST OF CHASSIS AND OPTIONS</td>
<td class="gdVHPricingBlock" id="gdVHPricingBlockSubTotal2"></td>
</tr>
<tr xcelrodid="86">
<td class="gdVHLbl01">Wheel Base:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCWheelBase"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHConfigBlock" colspan="3"><table>
    <tr>
    <td class="gdVHLbl02b">DEALER DISCOUNT</td>
    <td class="gdVHLbl02b">30%</td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="87">
<td class="gdVHLbl01">ABS Systems:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCABSSystems"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02b" colspan="3">DEALER NET</td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="88">
<td class="gdVHLbl01">Air Tanks:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCAirTanks"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHConfigBlock" colspan="3"><table>
    <tr>
    <td class="gdVHLbl02b">ADJUSTMENT</td>
    <td class="gdVHLbl02b">10%</td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="89">
<td class="gdVHLbl02b">Drain Valves:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCAirTanksDrainValves"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02b" colspan="3">NET PRICE CHASSIS & OPTIONS FOB TULSA, OK</td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="90">
<td class="gdVHLbl02b">Pull Cords:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCAirTanksPullCords"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHConfigBlock" colspan="3"><table>
    <tr>
    <td class="gdVHLbl02b">DRIVE_AWAY CHARGES, Each</td>
    <td class="gdVHLbl02b" id="gdDriveAwayCharges" func="gd_onload_select_preload_json_initvalued" table="drive_away_charges" dopreload="true" initvalue="<%= dp.getGDData("gdDriveAwayCharges") %>"></td>
    <td class="gdVHLbl02b" id="gdDriveAwayLocations" func="gd_onload_select_preload_json_initvalued" table="drive_away_locations" dopreload="true" initvalue="<%= dp.getGDData("gdDriveAwayLocations") %>"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="91">
<td class="gdVHLbl01">Air Dryer:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCAirDryer"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02b" colspan="3">ADDITIONAL CHARGES / WARRANTY (Non-Discounted)</td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="92">
<td class="gdVHLbl02b">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCAirDryerAccess01"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02b" colspan="3">TOTAL PRICE PER VEHICLE</td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="93">
<td class="gdVHLbl02r">Accessories:</td>
<td class="gdVHConfigBlock"><table>
    <tr>
    <td id="gdVCAirDryerAccess02" func="gd_build_input_element_initvalued_styled" elestyle="width:225px" initvalue="<%= dp.getGDData("gdVCAirDryerAccess02") %>"></td>
    </tr>
    </table></td>
<td class="gdVHPricingBlock"></td>
<td class="gdVHLbl02b">TAXABLE TRANSACTION</td>
<td class="gdVHLbl02b">NO</td>
<td class="gdVHLbl02b">YES</td>
<td class="gdVHPricingBlock"></td>
</tr>
<tr xcelrodid="96">
<td class="gdVHLbl01" colspan="7" style="border-top:1px solid #000000; text-align:right;"><table>
    <tr>
    <td width="100%"><input type="button" id="gdSubmitOrder" name="gdSubmitOrder" value="Submit" onclick="gdSubmitOrderOnClick(this);"/></td>
    <td><input type="button" id="gdChangeOrder" name="gdChangeOrder" value="Change Order" onclick="gdChangeOrderOnClick(this);"/></td>
    </tr>
    </table></td>
</tr>
<tr xcelrodid="95">
<td class="gdVHLbl01" colspan="3" style="border-top:1px solid #000000; border-right:1px solid #000000;">Notes:</td>
<td class="gdVHLbl01" colspan="4" style="border-top:1px solid #000000;">Notes:</td>
</tr>
<tr xcelrodid="94">
<td class="gdVHLbl01" colspan="3" style="border-right:1px solid #000000;"><textarea cols="60" rows="5"></textarea></td>
<td class="gdVHLbl01" colspan="4"><textarea cols="80" rows="5">Freight Rates Subject to Fuel Surcharge and / or a price increase at time of delivery.  Terms: Net C.O.D Net Cash Prior to Delivery</textarea></td>
</table>
</div>
<!-- ********************* End - Vehical Configurator -->
</form>
</div>
</body>
</html>