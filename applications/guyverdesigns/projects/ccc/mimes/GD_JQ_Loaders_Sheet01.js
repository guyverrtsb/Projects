$(document).ready(function()
{
	ZGD_Declare_Pricing_Function("ZGD_BASE_PRICE", "ZGD_CCC_BASE_PRICE");
	
	ZGD_Regional_Sales_Manager();
	ZGD_Engine();
})

function ZGD_Engine()
{
	ZGD_Declare_Pricing_Function("ZGD_Engine", "ZCGD_CCC_ADDITION");
	
	$("<select/>",
	{
		id:"ZGD_ELE_Engine",
		name:"ZGD_ELE_Engine"
		
	}).appendTo("#ZGD_CT_Engine");
	
	var opt = new Array();
	opt[0]="001|CUMMINS - ISC8.3-270|rpm=1300|price=STD|torque=800";
	opt[1]="002|CUMMINS - ISC8.3-300|rpm=1300|price=1200|torque=860";
	opt[2]="003|CUMMINS - ISC8.3-330|rpm=1400|price=2300|torque=1000";
	opt[3]="004|CUMMINS - ISC8.3-350|rpm=1400|price=2800|torque=1000";
	opt[4]="005|CUMMINS - ISL9-345|rpm=1300|price=7010|torque=1150";
	opt[5]="006|CUMMINS - ISL9-370|rpm=1400|price=10400|torque=1250";
	opt[6]="007|CUMMINS - ISL9-380|rpm=1400|price=10900|torque=1300";
	opt[7]="008|CUMMINS - ISX11.9-320|rpm=1200|price=17500|torque=1150";
	opt[8]="009|CUMMINS - ISX11.9-350|rpm=1200|price=19100|torque=1450";
	opt[9]="010|CUMMINS - ISX11.9-385|rpm=1200|price=20000|torque=1450";
	opt[10]="011|CUMMINS - ISLG-300|rpm=1300|price=2700|torque=860";
	opt[11]="012|CUMMINS - ISLG-320|rpm=1300|price=7300|torque=1000";

	for(var idx = 0; idx < opt.length; idx++)
	{
		$('<option />')
		.val(opt[idx].split("|")[0])
		.text(opt[idx].split("|")[1]) 
		.attr(opt[idx].split("|")[2].split("=")[0], opt[idx].split("|")[2].split("=")[1])
		.attr(opt[idx].split("|")[3].split("=")[0], opt[idx].split("|")[3].split("=")[1])
		.attr(opt[idx].split("|")[4].split("=")[0], opt[idx].split("|")[4].split("=")[1])
		.appendTo("#ZGD_ELE_Engine");
	}
	
	$("#ZGD_ELE_Engine").change(function () {
		$("#ZGD_ELE_Engine option:selected").each(function () {
			$("#ZGD_CT_Engine_Torque").html($(this).attr("torque") + " @");
			$("#ZGD_CT_Engine_RPM").html($(this).attr("rpm") + " RPM");
			
			ZGD_Display_CT_Price("ZGD_CT_Engine_", $(this).attr("price"))
			ZGD_Calculate_Pricing("ZGD_Engine", $(this).attr("price"));
		});
	}).change();
}

function ZGD_Regional_Sales_Manager()
{
	$("<select/>",
	{
		id:"ZGD_ELE_Regional_Sales_Manager",
		name:"ZGD_ELE_Regional_Sales_Manager"
	}).appendTo("#ZGD_CT_Regional_Sales_Manager");
	$("#ZGD_ELE_Regional_Sales_Manager").append( 
		$('<option />') 
			.text('Boyel') 
			.val('001'), 
		$('<option />') 
			.text('Butler') 
			.val('002'), 
		$('<option />') 
			.text('McCarthy') 
			.val('003'),
		$('<option />') 
			.text('Pochocki') 
			.val('004')
	); 
}

function ZGD_Display_CT_Price(id, price)
{
	if(price == "STD")
		$("#" + id + "Price").attr("align", "left");
	else
		$("#" + id + "Price").attr("align", "right");
	$("#" + id + "Price").html(price);
}
