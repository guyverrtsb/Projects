<?php
require_once("../gd.trxn.com/_controls/classes/_core.php");
gdreqonce("/gd.trxn.com/usersafety/_controls/classes/accesscontrol.php");
$gdac = new GDAccessControl();
if($gdac->isAdministrator())
{
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title zgd.bkgimg="/gd.trxn.com/mimes/images/backgrounds/scaled/02841_theroadtonowhere_1440x900.jpg">Admin Articles -- Guyver Designs - Solutions through Research and Imagination</title>
<meta charset="UTF-8">
<?php gdinc("/_controls/ui/css/core.php"); ?>
<link rel="stylesheet" href="/mimes/css/guyverdesigns.css">
<style></style>
<?php gdinc("/_controls/ui/js/core.php"); ?>
<?php gdinc("/_controls/ui/js/ckeditor.php"); ?>
<?php gdinc("/_controls/ui/js/createarticle.php"); ?>
<script>
function gdFuncSuccess(data)
{
    $("#gdArticleButtonsView").remove();
    var json = eval("(" + data + ")");
    showMessage("Document Added.", "gd_message_notification");
    var view = $("<a/>",{
        id: "gdArticleButtonsView",
        class: "buttonOrange",
        title: "View Project",
        href: "/jobs.php?aid=" + json.object_uid
    }).text("View Project").appendTo($("#gdArticleButtons"));

}
</script>
</head>
<body>
<div id="ContentWrapper">
<?php gdinc("/_controls/ui/gdHeader.php"); ?>
    <div id="gdHeadlines">
        <ul>
        <li class="headline"><div id="gdHeadlineContent" contenteditable="true" onmouseover="toggleCKContentArea(this);" onmouseout="toggleCKContentArea(this);"></div></li>
        <li class="documentpoint"><div id="gdHeadlinePoint0Content" contenteditable="true" onmouseover="toggleCKContentArea(this);" onmouseout="toggleCKContentArea(this);"></div></li>
        <li class="documentpoint"><div id="gdHeadlinePoint1Content" contenteditable="true" onmouseover="toggleCKContentArea(this);" onmouseout="toggleCKContentArea(this);"></div></li>
        <li class="documentpoint"><div id="gdHeadlinePoint2Content" contenteditable="true" onmouseover="toggleCKContentArea(this);" onmouseout="toggleCKContentArea(this);"></div></li>
        <li class="documentpoint"><div id="gdHeadlinePoint3Content" contenteditable="true" onmouseover="toggleCKContentArea(this);" onmouseout="toggleCKContentArea(this);"></div></li>
        <li class="documentpoint"><div id="gdHeadlinePoint4Content" contenteditable="true" onmouseover="toggleCKContentArea(this);" onmouseout="toggleCKContentArea(this);"></div></li>
        </ul>
    </div>
    <div id="gdArticleArea">
        <div id="gdArticleContent" contenteditable="true" onmouseover="toggleCKContentArea(this);" onmouseout="toggleCKContentArea(this);"></div>
    </div>
    <div id="gdArticleButtons">
    <a id="gdArticleButtonsSave" class="buttonOrange" title="Save Project" href="javascript:gdFuncRegisterDocument();">Save Project</a>
    </div>
<?php gdinc("/_controls/ui/gdFooter.php"); ?>
</div>
</body>
</html>
<?php
}
?>