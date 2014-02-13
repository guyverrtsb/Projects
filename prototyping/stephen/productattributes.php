<?php require_once("gd.trxn.com/_controls/classes/_core.php"); ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title zgd.bkgimg="/gd.trxn.com/mimes/images/backgrounds/scaled/02841_theroadtonowhere_1440x900.jpg">Guyver Designs - Solutions through Research and Imagination</title>
<meta charset="UTF-8">
<?php gdinc("/_controls/ui/css/core.php") ?>
<style>
</style>
<?php gdinc("/_controls/ui/js/core.php") ?>
<script>
var hdProductAttribDD = new Array();
$(document).ready(function()
{
    var reqdata = "";
    $.get("/json/productattributes.php", reqdata, function(json)
    {
        var jd = eval("(" + json + ")");
        hdProductAttribDD["attr1"] = new Array();
        hdProductAttribDD["attr2"] = new Array();
        hdProductAttribDD["attr3"] = new Array();
        hdProductAttribDD["attr4"] = new Array();
        hdProductAttribDD["attr5"] = new Array();
        hdProductAttribDD["attr6"] = new Array();
        jd = jd.PRODUCT_ATTRIB;
        $.each(jd, function(key, val)
        {
            for(idx = 1; idx <= 6; idx++)
            {
                var av = eval("val.attr" + idx);
                if(av != null)
                {
                    if(hdProductAttribDD["attr" + idx].indexOf(av) == -1)
                    {
                        $("<option/>").val(av).text(av).appendTo("#ddattr" + idx);
                        hdProductAttribDD["attr" + idx] += av + ",";
                    }
                }
           }
       });
    });
});
</script>
</head>
<body>
<div id="ContentWrapper">
    <div id="gdHeadlines"><ul>
        <li><select id="ddattr1"></select></li>
        <li><select id="ddattr2"></select></li>
        <li><select id="ddattr3"></select></li>
    </ul></div>
</div>
</body>
</html>