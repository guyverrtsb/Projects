<?php require_once("../_controls/classes/_core.php"); ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title zgd.bkgimg="/gd.trxn.com/mimes/images/backgrounds/scaled/02841_theroadtonowhere_1440x900.jpg">Guyver Designs - Solutions through Research and Imagination</title>
<meta charset="UTF-8">
<?php gdinc("/_controls/ui/css/core.php"); ?>
<style>
</style>
<?php gdinc("/_controls/ui/js/core.php"); ?>
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
<div id="ContentWrapper">
    <?php gdinc("/gd.trxn.com/_controls/ui/gdHeader.php"); ?>
    <div id="GDCBLinks"></div>
    <ul>
<li><?php echo $_SESSION["GUYVERDESIGNS_SITE_UID"]; ?></li>
<li><?php echo $_SESSION["GUYVERDESIGNS_SITE"]; ?></li>
<li><?php echo $_SESSION["GUYVERDESIGNS_SITE_ALIAS_UID"]; ?></li>
<li><?php echo $_SESSION["GUYVERDESIGNS_SITE_ALIAS"]; ?></li>
    </ul>
    <?php gdinc("/gd.trxn.com/_controls/ui/gdFooter.php"); ?>
</div>
</body>
</html>

