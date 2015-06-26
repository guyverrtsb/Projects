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
$(document).ready(function()
{ 
//elements
    var progressbox     = $("#GDUploadProgressBox");
    var progressbar     = $("#GDUploadProgressBar");
    var statustxt       = $("#GDUploadProgressBarStatusTxt");
    var submitbutton    = $("#GDUploadSubmitButton");
    var myform          = $("#GDUploadImageFrm");
    var output          = $("#GDUploadImageError");
    var completed       = "0%";
    var message         = "";

    $(myform).ajaxForm({
        data: { GD_CONTROLLER_KEY: "GD_UPLOAD_AND_SCALE_MIME" },
        beforeSend: function() { //before sending form
            submitbutton.attr("disabled", ""); // disable upload button
            statustxt.empty();
            progressbox.show(); //show progress bar
            progressbar.width(completed); //initial value 0% of progress bar
            statustxt.html(completed); //set status text
            statustxt.css("color","#000"); //initial color of status text
            message = "";
            clearOutputResults();
        },
        uploadProgress: function(event, position, total, percentComplete) { //on progress
            progressbar.width(percentComplete + "%") //update progress bar percent complete
            statustxt.html(percentComplete + "%"); //update status text
            if(percentComplete>50)
                {
                    statustxt.css("color","#fff"); //change status text to white after 50%
                }
            },
        complete: function(response) { // on complete
            //output.html(response.responseText); //update element with received data
            submitbutton.removeAttr("disabled"); //enable submit button
            progressbox.hide(); // hide progress bar
            if(response.responseText != "")
                showOutputResults(response.responseText);
            myform.resetForm();  // reset form
        }
    });
});
function clearOutputResults()
{
    $("#GDUploadImage").text("");
    $("#GDUploadReturnMessage").text("");
}
function showOutputResults(responseText)
{
    var rm = responseText.split(":");
    if(rm[0] == "MIME_BLOB_REGISTERED")
    {
        $("<img/>")
            .attr("src", "/_controls/ajax/DOWNLOAD_MIME.php?MIMEKEY=" + rm[6])
            .appendTo($("#GDUploadImage"));
    }
    $("#GDUploadReturnMessage").text(responseText);
}
</script>
</head>
<body>
<div id="ContentWrapper">
<?php gdinc("/_controls/ui/gdHeader.php") ?>
<form id="GDUploadImageFrm" class="form" action="/_controls/ajax/UPLOAD_SCALE_MIME.php" method="post" enctype="multipart/form-data" >
<ul>
    <li id="GDUploadImageError" class="error">&nbsp;</li>
    <li><textarea id="GDUploadImageDescription" name="GDUploadImageDescription" class="GDUploadImageDescription"></textarea></li>
    <li><input class="rounded" style="display:normal;" type="file" id="GDUploadImageFile" name="GDUploadImageFile"/></li>
    <li><a class="miniButtonBlue" name="navtop" onclick="$('#GDUploadImageFrm').submit();">Save</a></li>
    <li><div id="GDUploadProgressBox"><div id="GDUploadProgressBar"></div ><div id="GDUploadProgressBarStatusTxt">0%</div ></div></li>
    <li><div id="GDUploadImage"></div></li>
    <li><div id="GDUploadReturnMessage"></div></li>
</ul>
</form>
<?php gdinc("/_controls/ui/gdFooter.php") ?>
</div>
</body>
</html>