<?php require_once("gd.trxn.com/_controls/classes/_core.php"); ?>
<!DOCTYPE HTML><!-- HTML 5 -->
</html>
<head>
<title>Thomson Reuters Bundle Builder</title>
<?php gdinc("/_controls/ui/css/core.php") ?>
<link rel="stylesheet" href="/mimes/css/main.css" type="text/css" />
<link rel="stylesheet" href="/mimes/css/redmond/jquery-ui-1.10.4.custom.min.css" type="text/css" />
<link rel="stylesheet" href="/mimes/css/jquery.grid/ui.jqgrid.css" type="text/css" />
<link rel="stylesheet" href="/mimes/css/jquery.grid/ui.multiselect.css" type="text/css" />
<style>
#workarea_main { border:#000000 0px solid; margin-left:180px; }
input, textarea, select { -webkit-border-radius: 0px; -moz-border-radius: 0px; border-radius: 0px;
                        padding:0px; border:#000000 0px solid; margin:0px;  }
#workarea_main { float:left; }
.CB_Header { height:25px; margin-bottom:0px; padding-top:10px; background: url("/gd.trxn.com/mimes/images/buttons/topnavtile_blue.jpg") repeat-x scroll 0 0 #0074B2 }
</style>
<style>
#CB_sapSscProductSelector { width:730px; height:500px; border:1px solid #FFFF00; display:block; background: url("/gd.trxn.com/mimes/images/grey.png"); }
#sapSscProductFilter { width: 300px; }
#sapSscProductFilter li { text-align:right; background: url("/gd.trxn.com/mimes/images/grey.png"); }
.sapsscformfieldlabel { margin: auto; }
.sapsscformfieldInput { -webkit-border-radius: 4px; -moz-border-radius: 40px; border-radius: 4px;
                        padding:2px; border:#000000 1px solid; margin:5px; width:150px;  }
.sapsscformfieldSelect { -webkit-border-radius: 4px; -moz-border-radius: 40px; border-radius: 4px;
                        padding:2px; border:#000000 1px solid; margin:5px; width:155px;  }
                        
#CB_sapSscSubcriptionSelector { width:730px; height:480px; border:1px solid #FFFF00; display:block; background: url("/gd.trxn.com/mimes/images/grey.png"); }
#widget_ProductSelector { padding:10px; }
#widget_ExistingSubcriptionSelector { padding:10px; }
</style>
<?php gdinc("/_controls/ui/js/core.php") ?>
<script src="/mimes/js/jquery.grid/i18n/grid.locale-en.js" type="text/javascript"></script>
<script src="/mimes/js/jquery.grid/jquery.jqGrid.js" type="text/javascript"></script>
<script src="/mimes/js/jquery.grid/jqZCGD.widgets.src.js" type="text/javascript"></script>
<script>
jQuery(document).ready(function()
{
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

    var datasoldtolist = [
            {soldtonum:"134253245",name:"Kelly Inc",address:"123 Independance Way",city:"Philladelphia",region:"PA"},
            {soldtonum:"267356346",name:"Srini Corp",address:"4 Jacobi St.",city:"Chicago",region:"PA"},
            {soldtonum:"334523564",name:"Sridhar LLC",address:"120-32 Industrial Blvd",city:"Newtown Square",region:"PA"},
            {soldtonum:"432515324",name:"Shaggy Inc",address:"9 Swank Place",city:"Vegas Baby",region:"NV"},
            {soldtonum:"545625235",name:"Velma Services",address:"Glasses Way",city:"Lighthouse Haven",region:"MA"},
            {soldtonum:"634523632",name:"ScoobySoft",address:"Snack Road",city:"Dog City",region:"OH"},
            {soldtonum:"267356346",name:"Srini Corp",address:"4 Jacobi St.",city:"Chicago",region:"PA"},
            {soldtonum:"334523564",name:"Sridhar LLC",address:"120-32 Industrial Blvd",city:"Newtown Square",region:"PA"},
            {soldtonum:"432515324",name:"Shaggy Inc",address:"9 Swank Place",city:"Vegas Baby",region:"NV"},
            {soldtonum:"545625235",name:"Velma Services",address:"Glasses Way",city:"Lighthouse Haven",region:"MA"},
            {soldtonum:"634523632",name:"ScoobySoft",address:"Snack Road",city:"Dog City",region:"OH"}
            ];
    
    var datasoldtoproductlist = [
            {matnr:"123453245",proddesc:"monthly subscription",qty:"2",bundleid:"Cool Bundle",bundletype:"C_BUNDLE",soldtonum:"634523632",shiptoname:"Yellow Truck",appreq:"y"},
            {matnr:"265346898",proddesc:"daily subscription",qty:"2",bundleid:"West Bundle",bundletype:"C_BUNDLE",soldtonum:"134253245",shiptoname:"Yellow Truck",appreq:"y"},
            {matnr:"332145345",proddesc:"daily subscription",qty:"2",bundleid:"Library Bundle",bundletype:"C_BUNDLE",soldtonum:"334523564",shiptoname:"Yellow Truck",appreq:"y"},
            {matnr:"478953467",proddesc:"monthly subscription",qty:"2",bundleid:"West Bundle",bundletype:"C_BUNDLE",soldtonum:"545625235",shiptoname:"Yellow Truck",appreq:"y"},
            {matnr:"534525254",proddesc:"cool subscription",qty:"2",bundleid:"West Bundle",bundletype:"C_BUNDLE",soldtonum:"334523564",shiptoname:"Yellow Truck",appreq:"y"},
            {matnr:"634524533",proddesc:"cool subscription",qty:"2",bundleid:"Library Bundle",bundletype:"C_BUNDLE",soldtonum:"545625235",shiptoname:"Yellow Truck",appreq:"y"},
            {matnr:"723214688",proddesc:"cool subscription",qty:"2",bundleid:"Cool Bundle",bundletype:"C_BUNDLE",soldtonum:"134253245",shiptoname:"Yellow Truck",appreq:"y"},
            {matnr:"828007068",proddesc:"monthly subscription",qty:"2",bundleid:"West Bundle",bundletype:"C_BUNDLE",soldtonum:"545625235",shiptoname:"Yellow Truck",appreq:"y"},
            {matnr:"990976857",proddesc:"monthly subscription",qty:"2",bundleid:"Library Bundle",bundletype:"C_BUNDLE",soldtonum:"432515324",shiptoname:"Yellow Truck",appreq:"y"},
            {matnr:"104567982",proddesc:"daily subscription",qty:"2",bundleid:"West Bundle",bundletype:"C_BUNDLE",soldtonum:"545625235",shiptoname:"Yellow Truck",appreq:"y"}
            ];


    //jQuery("#CB_sapSscProductSelector").jqGrid("zcgdUtilFindChildObj", {type:"index", match:"0"});
    jQuery("#widget_ProductSelector").jqGrid("zcgdWidgetBuildProductSelector", dataproductlist);
    jQuery("#widget_ExistingSubcriptionSelector").jqGrid("zcgdWidgetBuildSubscriptionSelector", datasoldtolist, datasoldtoproductlist);
});
</script>
</head>
<body>
<div id="container">
    <!-- HEADER -->
    <div id="header">
        <div id="logo">Logo</div>
        <div id="top_info">Top Info</div>
        <div id="navbar">
            <ul>
                <li><img src="/mimes/images/logos/logo_thomsonreuters.png"/></li>
                <li><a href="URL">Check</a></li>
                <li><a href="URL">Accept</a></li>
                <li><a href="URL">Reset</a></li>
                <li><a href="URL">add non Part Instance</a></li>
            </ul>
        </div>
    </div>
    <!-- CONTENT_AREA -->
    <div id="content_area">
        <div id="banner"></div>
        <div id="left_column">Left Column</div>
        <div id="workarea_main">
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
    </div>
        <div id="right_column">Right Column</div>
    </div>
    <!-- FOOTER -->
    <div id="footer">
        <div id="supportbar">
            <ul>
                <li><img src="/mimes/images/logos/logo_thomsonreuters.png"/></li>
                <li><a href="URL">Check</a></li>
                <li><a href="URL">Accept</a></li>
                <li><a href="URL">Reset</a></li>
                <li><a href="URL">add non Part Instance</a></li>
            </ul>
        </div>
    </div>
</div>
</body>
</html>