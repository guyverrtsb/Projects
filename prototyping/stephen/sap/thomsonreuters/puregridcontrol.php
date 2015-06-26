<!DOCTYPE HTML><!-- HTML 5 -->
</html>
<head>
<title>Guyver Designs - Solutions through Research and Imagination</title>
<link rel="stylesheet" href="/mimes/css/redmond/jquery-ui-1.10.4.custom.min.css" type="text/css" />
<link rel="stylesheet" href="/mimes/css/jquery.grid/ui.jqgrid.css" type="text/css" />
<link rel="stylesheet" href="/mimes/css/jquery.grid/ui.multiselect.css" type="text/css" />
<style>
#CB_sapSscProdSearch { width:700px; height:450px; border:1px solid #FFFF00; }
#sapSscProductFilter { width: 300px; margin-bottom:10px; list-style-type:none; }
#sapSscProductFilter li { text-align:right; background: url("/gd.trxn.com/mimes/images/grey.png");  }
.sapsscformfieldlabel { margin: auto; }
.sapsscformfieldInput { -webkit-border-radius: 4px; -moz-border-radius: 40px; border-radius: 4px;
                        padding:2px; border:#000000 1px solid; margin:5px; width:150px;  }
.sapsscformfieldSelect { -webkit-border-radius: 4px; -moz-border-radius: 40px; border-radius: 4px;
                        padding:2px; border:#000000 1px solid; margin:5px; width:155px;  }
</style>
<script src="//code.jquery.com/jquery-1.9.1.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script src="/mimes/js/jquery.grid/i18n/grid.locale-en.js" type="text/javascript"></script>
<script src="/mimes/js/jquery.grid/jquery.jqGrid.js" type="text/javascript"></script>
<script src="/mimes/js/jquery.grid/jqZCGD.widgets.src.js" type="text/javascript"></script>
<script>
jQuery(document).ready(function()
{
    $.post("/json/existingsubssoldtolist.php", "TEST_TYPE=TEST", function(data)
    {
        data = eval("(" + data + ")");
        // alert(data.RETURN_KEY);
        if(data.RETURN_KEY == "SUCCESS")
        {
            jQuery("#widget_ExistingSubcriptionSelector").jqGrid("zcgdWidgetBuildSubscriptionSelector", data.SOLDTO_LIST, data.SOLDTO_PRODUCT_LIST);
        }
    });
    
    
    var dataproductlist = [
            {matnr:"10261147",proddesc:"MN STAT V42",pracarea:"General",juris:"MN",format:"Print",appreq:"No"},
            {matnr:"41463607",proddesc:"PROVIEW TEST 1",pracarea:"Bankruptcy",juris:"NY",format:"Print",appreq:"Yes"},
            {matnr:"41463609",proddesc:"PROVIEW TEST 2",pracarea:"Online",juris:"MN",format:"Digest",appreq:"Yes"},
            {matnr:"41464041",proddesc:"MN STAT SRV",pracarea:"Online",juris:"MN",format:"Digest",appreq:"No"},
            {matnr:"41464050",proddesc:"WI STAT SRV",pracarea:"Online",juris:"WI",format:"Digest",appreq:"Yes"},
            {matnr:"41464060",proddesc:"NY CODE RULES",pracarea:"Online",juris:"NY",format:"Digest",appreq:"No"},
            {matnr:"16225819",proddesc:"MN STAT V19",pracarea:"General",juris:"MN",format:"Print",appreq:"Yes"},
            {matnr:"30190001",proddesc:"PRT AP SUB KMAT",pracarea:"General",juris:"CT",format:"Print",appreq:"Yes"},
            {matnr:"13592144",proddesc:"MN STAT V23A",pracarea:"General",juris:"CT",format:"Print",appreq:"No"},
            {matnr:"30190016",proddesc:"PRT SA/2ALT SUB KMAT MODEL",pracarea:"General",juris:"NY",format:"Print",appreq:"Yes"}
            ];

    //jQuery("#CB_sapSscProductSelector").jqGrid("zcgdUtilFindChildObj", {type:"index", match:"0"});
    jQuery("#widget_ProductSelector").jqGrid("zcgdWidgetBuildProductSelector", dataproductlist);
});
</script>
</head>
<body>
<div id="CB_sapSscProductSelector">
    <div class="CB_Header">Selection Filter</div>
    <div id="widget_ProductSelector">
        <ul id="sapSscProductFilter"></ul>
        <table id="sapSscProductList"></table>
        <div id="sapSscProductPager"></div>
        <div id="sapSscProductAction"></div>
    </div>
</div>
<div id="CB_sapSscSubcriptionSelector" style="margin-top:50px;">
    <div class="CB_Header">Subcription Selector Filter</div>
    <div id="widget_ExistingSubcriptionSelector">
        <table id="sapSscSoldToList"></table>
        <br/>
        <table id="sapSscSoldToProductList"></table>
        <div id="sapSscSoldToAction"></div>
    </div>
</div>
</body>
</html>