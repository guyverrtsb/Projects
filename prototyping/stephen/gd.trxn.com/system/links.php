<?php require_once("../_controls/classes/_core.php"); ?>
<!DOCTYPE HTML><!-- HTML 5 -->
</html>
<head>
<title zgd.bkgimg="/gd.trxn.com/mimes/images/backgrounds/scaled/02841_theroadtonowhere_1440x900.jpg">Site Access</title>
<?php gdinc("/gd.trxn.com/_controls/ui/css/core.php") ?>
<?php gdinc("/gd.trxn.com/_controls/ui/js/core.php") ?>
<script>
$(document).ready(function()
{
    $.post("/json/links.php", function(json)
    {
        json = eval("(" + json + ")");
        var ul = $("<ul/>");
        $.each(json.URLINKS, function(key, val)
        {
            var d = json.URLINKS[key].display;
            var u = json.URLINKS[key].url;
            var li = $("</li>");
            var gdlink = $("<a/>", {
                href:u,
                class:"gdLink"
            }).text(d);
 
            ul.append($("<li/>").append(gdlink));
        });
        $("#GDCBLinks").append(ul);
    });
});
</script>
</head>
<body>
<div id="container">
<?php gdinc("/gd.trxn.com/_controls/ui/header.php") ?>
    <!-- CONTENT_AREA -->
    <div id="content_area">
        <div id="banner">Banner</div>
        <div id="left_column">Left Column</div>
        <div id="workarea">
            <div id="workarea_col_01">
<div id="GDCBLinks"></div>
<div id="Site Data">
<ul>
<li><?php echo $_SESSION["GUYVERDESIGNS_SITE_UID"]; ?></li>
<li><?php echo $_SESSION["GUYVERDESIGNS_SITE"]; ?></li>
<li><?php echo $_SESSION["GUYVERDESIGNS_SITE_ALIAS_UID"]; ?></li>
<li><?php echo $_SESSION["GUYVERDESIGNS_SITE_ALIAS"]; ?></li>
</ul>
</div>
            </div>
        </div>
        <div id="right_column">Right Column</div>
    </div>
<?php gdinc("/gd.trxn.com/_controls/ui/footer.php") ?>
</div>
</body>
</html>