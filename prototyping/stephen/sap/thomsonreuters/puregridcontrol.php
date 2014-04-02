<?php require_once("gd.trxn.com/_controls/classes/_core.php"); ?>
<!DOCTYPE HTML><!-- HTML 5 -->
</html>
<head>
<title>Guyver Designs - Solutions through Research and Imagination</title>
<link rel="stylesheet" href="/mimes/css/redmond/jquery-ui-1.10.4.custom.min.css" type="text/css" />
<link rel="stylesheet" href="/mimes/css/jquery.grid/ui.jqgrid.css" type="text/css" />
<link rel="stylesheet" href="/mimes/css/jquery.grid/ui.multiselect.css" type="text/css" />
<style>
* {
    margin: 0;
    padding: 0;
}
html, body, div, span, applet, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, font, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, dd, dl, dt, li, ol, ul, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td {
    border: 0 none;
    font-family: inherit;
    font-size: 100%;
    font-style: inherit;
    font-weight: inherit;
    line-height: 1em;
    margin: 0;
    outline: 0 none;
    padding: 0;
    text-align: left;
}
html    { font-family: Helvetica, Arial, sans-serif; color:#ffffff; }
body    { margin:0; }
ul li   { list-style-type:none;
        font-size:10px; font-weight:bold; color:#ffffff;  }
input, textarea, select { -webkit-border-radius: 0px; -moz-border-radius: 0px; border-radius: 0px;
                        padding:0px; border:#000000 0px solid; margin:0px;  }
#workarea_main { float:left; }
.CB_Header { height:25px; margin-bottom:0px; padding-top:10px; background: url("/gd.trxn.com/mimes/images/buttons/topnavtile_blue.jpg") repeat-x scroll 0 0 #0074B2 }
</style>
<style>
#CB_sapSscProdSearch { width:700px; height:450px; border:1px solid #FFFF00; }
#sapSscProductFilter { width: 300px; margin-bottom:10px; }
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
<script src="/mimes/js/jquery.grid/core.src.js" type="text/javascript"></script>
<script>
jQuery(document).ready(function()
{
    jQuery("#sapSscProductList").jqGrid({
        datatype: "local",
        colNames:['Product','Product Description', 'Practice Area', 'Jurisdication','Format','Approval Req.'],
        colModel:[
            {name:'matnr',index:'matnr', width:60, sorttype:"int"},
            {name:'proddesc',index:'proddesc', width:90, sorttype:"date"},
            {name:'pracarea',index:'pracarea', width:100},
            {name:'juris',index:'juris', width:80, align:"right",sorttype:"float"},
            {name:'format',index:'format', width:80, align:"right",sorttype:"float"},     
            {name:'appreq',index:'appreq', width:80,align:"right",sorttype:"float"}     
        ],
        rowNum:10,
        rowList:[10,20,30],
        pager: '#sapSscProductPager',
        sortname: 'id',
        viewrecords: true,
        sortorder: "desc",
        multiselect: true,
        caption:"Product Selection"
    });
    jQuery("#sapSscProductList").jqGrid('navGrid','#sapSscProductPager',{edit:false,add:false,del:false});
    
    
    var data = [
            {matnr:"1",proddesc:"2007-10-01",pracarea:"test3",juris:"juris",format:"200.00",appreq:"10.00"},
            {matnr:"2",proddesc:"2007-10-02",pracarea:"test2",juris:"juris2",format:"300.00",appreq:"20.00"},
            {matnr:"3",proddesc:"2007-09-01",pracarea:"test3",juris:"juris3",format:"400.00",appreq:"30.00"},
            {matnr:"4",proddesc:"2007-10-04",pracarea:"test",juris:"juris",format:"200.00",appreq:"10.00"},
            {matnr:"5",proddesc:"2007-10-05",pracarea:"test2",juris:"juris2",format:"300.00",appreq:"20.00"},
            {matnr:"6",proddesc:"2007-09-06",pracarea:"test3",juris:"juris3",format:"400.00",appreq:"30.00"},
            {matnr:"7",proddesc:"2007-10-04",pracarea:"test",juris:"juris",format:"200.00",appreq:"10.00"},
            {matnr:"8",proddesc:"2007-10-03",pracarea:"test2",juris:"juris2",format:"300.00",appreq:"20.00"},
            {matnr:"9",proddesc:"2007-09-01",pracarea:"test3",juris:"juris3",format:"400.00",appreq:"30.00"},
            {matnr:"10",proddesc:"2007-10-02",pracarea:"test2",juris:"juris2",format:"300.00",appreq:"20.00"},
            {matnr:"11",proddesc:"2007-09-01",pracarea:"test3",juris:"juris3",format:"400.00",appreq:"30.00"},
            {matnr:"12",proddesc:"2007-10-04",pracarea:"test",juris:"juris",format:"200.00",appreq:"10.00"},
            {matnr:"13",proddesc:"2007-10-05",pracarea:"test2",juris:"juris2",format:"300.00",appreq:"20.00"},
            {matnr:"14",proddesc:"2007-09-06",pracarea:"test3",juris:"juris3",format:"400.00",appreq:"30.00"},
            {matnr:"15",proddesc:"2007-10-04",pracarea:"test",juris:"juris",format:"200.00",appreq:"10.00"},
            {matnr:"16",proddesc:"2007-10-03",pracarea:"test2",juris:"juris2",format:"300.00",appreq:"20.00"},
            {matnr:"17",proddesc:"2007-09-01",pracarea:"test3",juris:"juris3",format:"400.00",appreq:"30.00"},
            {matnr:"18",proddesc:"2007-10-02",pracarea:"test2",juris:"juris2",format:"300.00",appreq:"20.00"},
            {matnr:"19",proddesc:"2007-09-01",pracarea:"test3",juris:"juris3",format:"400.00",appreq:"30.00"},
            {matnr:"20",proddesc:"2007-10-04",pracarea:"test",juris:"juris",format:"200.00",appreq:"10.00"},
            {matnr:"21",proddesc:"2007-10-05",pracarea:"test2",juris:"juris2",format:"300.00",appreq:"20.00"},
            {matnr:"22",proddesc:"2007-09-06",pracarea:"test3",juris:"juris3",format:"400.00",appreq:"30.00"},
            {matnr:"23",proddesc:"2007-10-04",pracarea:"test",juris:"juris",format:"200.00",appreq:"10.00"},
            {matnr:"24",proddesc:"2007-10-03",pracarea:"test2",juris:"juris2",format:"300.00",appreq:"20.00"},
            {matnr:"25",proddesc:"2007-09-01",pracarea:"test3",juris:"juris3",format:"400.00",appreq:"30.00"},
            {matnr:"26",proddesc:"2007-10-02",pracarea:"test2",juris:"juris2",format:"300.00",appreq:"20.00"},
            {matnr:"27",proddesc:"2007-09-01",pracarea:"test3",juris:"juris3",format:"400.00",appreq:"30.00"},
            {matnr:"28",proddesc:"2007-10-04",pracarea:"test",juris:"juris",format:"200.00",appreq:"10.00"},
            {matnr:"29",proddesc:"2007-10-05",pracarea:"test2",juris:"juris2",format:"300.00",appreq:"20.00"},
            {matnr:"30",proddesc:"2007-09-06",pracarea:"test3",juris:"juris3",format:"400.00",appreq:"30.00"},
            {matnr:"31",proddesc:"2007-10-04",pracarea:"test",juris:"juris",format:"200.00",appreq:"10.00"},
            {matnr:"32",proddesc:"2007-10-03",pracarea:"test2",juris:"juris2",format:"300.00",appreq:"20.00"},
            {matnr:"33",proddesc:"2007-09-01",pracarea:"test3",juris:"juris3",format:"400.00",appreq:"30.00"}
            ];

    jQuery("#sapSscProductList").jqGrid("zealconWidgetBuildProductSelect", "sapSscProductFilter", "sapSscProductList", data);
});
</script>
</head>
<body>
<div id="CB_sapSscProdSearch">
    <ul id="sapSscProductFilter"></ul>
    <table id="sapSscProductList"></table>
    <div id="sapSscProductPager"></div>
</div>
</body>
</html>