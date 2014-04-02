<?php require_once("gd.trxn.com/_controls/classes/_core.php"); ?>
<!DOCTYPE HTML><!-- HTML 5 -->
</html>
<head>
<title zgd.bkgimg="/gd.trxn.com/mimes/images/backgrounds/scaled/02841_theroadtonowhere_1440x900.jpg">Guyver Designs - Solutions through Research and Imagination</title>
<link rel="stylesheet" href="mimes/css/main.css">
<?php gdinc("/_controls/ui/css/core.php") ?>
<link rel="stylesheet" href="/mimes/css/redmond/jquery-ui-1.10.4.custom.min.css" type="text/css" />
<link rel="stylesheet" href="/mimes/css/jquery.grid/ui.jqgrid.css" type="text/css" />
<link rel="stylesheet" href="/mimes/css/jquery.grid/ui.multiselect.css" type="text/css" />
<style>
#workarea_main { float:left; border:#000000 0px solid; }
input, textarea, select { -webkit-border-radius: 0px; -moz-border-radius: 0px; border-radius: 0px;
                        padding:0px; border:#000000 0px solid; margin:0px;  }
#workarea_main { float:left; }
.CB_Header { height:25px; margin-bottom:0px; padding-top:10px; background: url("/gd.trxn.com/mimes/images/buttons/topnavtile_blue.jpg") repeat-x scroll 0 0 #0074B2 }
</style>
<style>
#CB_sapSscProductSelector { width:730px; height:450px; border:1px solid #FFFF00; display:block; }
#sapSscProductFilter { width: 300px; }
#sapSscProductFilter li { text-align:right; background: url("/gd.trxn.com/mimes/images/grey.png"); }
.sapsscformfieldlabel { margin: auto; }
.sapsscformfieldInput { -webkit-border-radius: 4px; -moz-border-radius: 40px; border-radius: 4px;
                        padding:2px; border:#000000 1px solid; margin:5px; width:150px;  }
.sapsscformfieldSelect { -webkit-border-radius: 4px; -moz-border-radius: 40px; border-radius: 4px;
                        padding:2px; border:#000000 1px solid; margin:5px; width:155px;  }
                        
#CB_sapSscSubcriptionSelector { width:730px; height:440px; border:1px solid #FFFF00; display:block; }
</style>
<?php gdinc("/_controls/ui/js/core.php") ?>
<script src="/mimes/js/jquery.grid/i18n/grid.locale-en.js" type="text/javascript"></script>
<script src="/mimes/js/jquery.grid/jquery.jqGrid.js" type="text/javascript"></script>
<script src="/mimes/js/jquery.grid/jqZCGD.widgets.src.js" type="text/javascript"></script>
<script>
jQuery(document).ready(function()
{
    var dataproductlist = [
            {matnr:"253623541",proddesc:"2007-10-01",pracarea:"test3",juris:"juris",format:"200",appreq:"Y"},
            {matnr:"145125434",proddesc:"2007-10-02",pracarea:"test2",juris:"juris2",format:"300.00",appreq:"N"},
            {matnr:"234345323",proddesc:"2007-09-01",pracarea:"test3",juris:"juris3",format:"400.00",appreq:"Y"},
            {matnr:"423452345",proddesc:"2007-10-04",pracarea:"test",juris:"juris",format:"200.00",appreq:"Y"},
            {matnr:"534523543",proddesc:"2007-10-05",pracarea:"test2",juris:"jur4ris2",format:"300.00",appreq:"N"},
            {matnr:"662535432",proddesc:"2007-09-06",pracarea:"test3",juris:"juris3",format:"400.00",appreq:"N"},
            {matnr:"723466342",proddesc:"2007-10-04",pracarea:"teseeet",juris:"juriws",format:"200.00",appreq:"Y"},
            {matnr:"823624523",proddesc:"2007-10-03",pracarea:"test2",juris:"juris5",format:"300.00",appreq:"N"},
            {matnr:"925625235",proddesc:"2007-09-01",pracarea:"test3",juris:"juris3",format:"400.00",appreq:"N"},
            {matnr:"102562353",proddesc:"2007-10-02",pracarea:"test2",juris:"juris2",format:"300.00",appreq:"N"},
            {matnr:"112354236",proddesc:"2007-09-01",pracarea:"test3",juris:"juris3",format:"400.00",appreq:"Y"},
            {matnr:"122345234",proddesc:"2007-10-04",pracarea:"test",juris:"juris",format:"200.00",appreq:"Y"},
            {matnr:"133452526",proddesc:"2007-10-05",pracarea:"test2",juris:"juris2",format:"300.00",appreq:"N"},
            {matnr:"145758689",proddesc:"2007-09-06",pracarea:"terest3",juris:"jurifs3",format:"400.00",appreq:"Y"},
            {matnr:"152452645",proddesc:"2007-10-04",pracarea:"test",juris:"juris",format:"300.00",appreq:"Y"},
            {matnr:"162356237",proddesc:"2007-10-03",pracarea:"test2",juris:"juris2",format:"300.00",appreq:"N"},
            {matnr:"175645627",proddesc:"2007-09-01",pracarea:"test3",juris:"juris3",format:"400.00",appreq:"Y"},
            {matnr:"182345132",proddesc:"2007-10-02",pracarea:"test2",juris:"jurfis2",format:"300.00",appreq:"N"},
            {matnr:"195688766",proddesc:"2007-09-01",pracarea:"twqest3",juris:"juris3",format:"400.00",appreq:"N"},
            {matnr:"202365236",proddesc:"2007-10-04",pracarea:"test",juris:"juris",format:"200.00",appreq:"Y"},
            {matnr:"212643756",proddesc:"2007-10-05",pracarea:"test2",juris:"juris2",format:"300.00",appreq:"N"},
            {matnr:"223245626",proddesc:"2007-09-06",pracarea:"test3",juris:"juris3",format:"400.00",appreq:"N"},
            {matnr:"238784433",proddesc:"2007-10-04",pracarea:"test",juris:"jurweris",format:"200.00",appreq:"Y"},
            {matnr:"242352646",proddesc:"2007-10-03",pracarea:"test2",juris:"juris2",format:"300.00",appreq:"N"},
            {matnr:"253467563",proddesc:"2007-09-01",pracarea:"test3",juris:"juris3",format:"400.00",appreq:"Y"},
            {matnr:"267646575",proddesc:"2007-10-02",pracarea:"tesdt2",juris:"juris2",format:"300.00",appreq:"N"},
            {matnr:"274643698",proddesc:"2007-09-01",pracarea:"test3",juris:"juris3",format:"400.00",appreq:"Y"},
            {matnr:"284634477",proddesc:"2007-10-04",pracarea:"test",juris:"juris",format:"200.00",appreq:"Y"},
            {matnr:"294567365",proddesc:"2007-10-05",pracarea:"test2",juris:"juris2",format:"300.00",appreq:"N"},
            {matnr:"302457568",proddesc:"2007-09-06",pracarea:"test3",juris:"juris3",format:"400.00",appreq:"N"},
            {matnr:"313252345",proddesc:"2007-10-04",pracarea:"test",juris:"juris",format:"200.00",appreq:"Y"},
            {matnr:"322234554",proddesc:"2007-10-03",pracarea:"test2",juris:"juris2",format:"300.00",appreq:"N"},
            {matnr:"332354235",proddesc:"2007-09-01",pracarea:"test3",juris:"juris3",format:"400.00",appreq:"N"}
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
            {matnr:"123453245",proddesc:"stuff",qty:"2",bundleid:"Cool Bundle",bundletype:"C_BUNDLE",soldtonum:"634523632",shiptoname:"Yellow Truck",appreq:"y"},
            {matnr:"265346898",proddesc:"stuff",qty:"2",bundleid:"Cool Bundle",bundletype:"C_BUNDLE",soldtonum:"134253245",shiptoname:"Yellow Truck",appreq:"y"},
            {matnr:"332145345",proddesc:"stuff",qty:"2",bundleid:"Cool Bundle",bundletype:"C_BUNDLE",soldtonum:"334523564",shiptoname:"Yellow Truck",appreq:"y"},
            {matnr:"478953467",proddesc:"stuff",qty:"2",bundleid:"Cool Bundle",bundletype:"C_BUNDLE",soldtonum:"545625235",shiptoname:"Yellow Truck",appreq:"y"},
            {matnr:"534525254",proddesc:"stuff",qty:"2",bundleid:"Cool Bundle",bundletype:"C_BUNDLE",soldtonum:"334523564",shiptoname:"Yellow Truck",appreq:"y"},
            {matnr:"634524533",proddesc:"stuff",qty:"2",bundleid:"Cool Bundle",bundletype:"C_BUNDLE",soldtonum:"545625235",shiptoname:"Yellow Truck",appreq:"y"},
            {matnr:"723214688",proddesc:"stuff",qty:"2",bundleid:"Cool Bundle",bundletype:"C_BUNDLE",soldtonum:"134253245",shiptoname:"Yellow Truck",appreq:"y"},
            {matnr:"828007068",proddesc:"stuff",qty:"2",bundleid:"Cool Bundle",bundletype:"C_BUNDLE",soldtonum:"545625235",shiptoname:"Yellow Truck",appreq:"y"},
            {matnr:"990976857",proddesc:"stuff",qty:"2",bundleid:"Cool Bundle",bundletype:"C_BUNDLE",soldtonum:"432515324",shiptoname:"Yellow Truck",appreq:"y"},
            {matnr:"104567982",proddesc:"stuff",qty:"2",bundleid:"Cool Bundle",bundletype:"C_BUNDLE",soldtonum:"545625235",shiptoname:"Yellow Truck",appreq:"y"}
            ];


    //jQuery("#CB_sapSscProductSelector").jqGrid("zcgdUtilFindChildObj", {type:"index", match:"0"});
    jQuery("#CB_sapSscProductSelector").jqGrid("zcgdWidgetBuildProductSelector", dataproductlist);
    jQuery("#CB_sapSscSubcriptionSelector").jqGrid("zcgdWidgetBuildSubscriptionSelector", datasoldtolist, datasoldtoproductlist);
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
                <li><a href="URL">Link 1</a></li>
                <li><a href="URL">Link 2</a></li>
                <li><a href="URL">Link 3</a></li>
                <li><a href="URL">Link 4</a></li>
            </ul>
        </div>
    </div>
    <!-- CONTENT_AREA -->
    <div id="content_area">
        <div id="banner">Banner</div>
        <div id="left_column">Left Column</div>
        <div id="workarea_main">
<div id="CB_sapSscProductSelector">
    <div class="CB_Header">Selection Filter</div>
    <ul id="sapSscProductFilter"></ul>
    <table id="sapSscProductList"></table>
    <div id="sapSscProductPager"></div>
    <div id="sapSscProductAction"></div>
</div>
<div id="CB_sapSscSubcriptionSelector" style="margin-top:50px;">
    <div class="CB_Header">Subcription Selector Filter</div>
    <table id="sapSscSoldToList"></table>
    <br/>
    <table id="sapSscSoldToProductList"></table>
    <div id="sapSscSoldToAction"></div>
</div>
    </div>
        <div id="right_column">Right Column</div>
    </div>
    <!-- FOOTER -->
    <div id="footer">Footer</div>
</div>
</body>
</html>