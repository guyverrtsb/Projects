<?php require_once("../../gd.trxn.com/_controls/classes/_core.php"); ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title zgd.bkgimg="/gd.trxn.com/mimes/images/backgrounds/scaled/02841_theroadtonowhere_1440x900.jpg">Large File Share - Upload</title>
<meta charset="UTF-8">
<?php gdinc("/_controls/ui/css/core.php") ?>
<style>
.FileUploadDescriptionContent { width:450px; }
#FileUploadMimeFile { display:none; }
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
    var output          = $("#TransactionErr");
    var completed       = "0%";
    var message         = "";

    $(myform).ajaxForm({
        data: { GD_CONTROLLER_KEY: "REGISTER_WALL_MESSAGE" },
        beforeSend: function() { //before sending form
            submitbutton.attr("disabled", ""); // disable upload button
            statustxt.empty();
            progressbox.show(); //show progress bar
            progressbar.width(completed); //initial value 0% of progress bar
            statustxt.html(completed); //set status text
            statustxt.css("color","#000"); //initial color of status text
            message = "";
            output.text(message);
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
        complete: function(data)
        { // on complete
            //output.html(response.responseText); //update element with received data
            submitbutton.removeAttr("disabled"); //enable submit button
            progressbox.hide(); // hide progress bar
            data = eval('(' + data.responseText + ')')
            if(buildContentBlocksReturnMessage(data, "SUCCESS", "WallMessageTransactionOutput"))
            {
                // gdLoadNewWallMessages();
            }
            myform.resetForm();  // reset form
        }
    });
});

function clearOutputResults()
{
    //$("#GDUploadImage").text("");
    //$("#GDUploadReturnMessage").text("");
}
</script>
</head>
<body>
<div id="ContentWrapper">
<ul id="CBHorizWorkArea">
<li><ul id="workarea_col_left">
    <li class="cbheader">Menu</li>
    </ul></li>
<li><form id="GDUploadImageFrm" class="form" action="/_controls/ajax/LARGE_FILE_SHARE.php" method="post" enctype="multipart/form-data" >
<ul id="CBWorkAreaCenter">
    <li class="cbheader">Upload Large File</li>
    <li id="WallMessageTransactionOutput">&nbsp;</li>
    <li id="CEMessageEntry"><table>
        <tr>
        <td><img src="/mimes/images/default_user_profile_image.gif"/></td>
        <td><textarea id="FileUploadDescriptionContent" name="FileUploadDescriptionContent" class="FileUploadDescriptionContent"></textarea></td>
        <td><a class="miniButtonBlue" name="navtop" onclick="$('#FileUploadMimeFile').click();">Add image</a>
<a class="miniButtonBlue" name="navtop" onclick="$('#GDUploadImageFrm').submit();">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td
        </tr>
        <tr>
        <td>&nbsp;</td>
        <td><input type="input" id="FileUploadUserId" name="FileUploadUserId" class="FileUploadUserId"/></td>
        </tr>
        </table></li>
    <li><div id="GDUploadProgressBox"><div id="GDUploadProgressBar"></div><div id="GDUploadProgressBarStatusTxt">0%</div ></div></li>
    <li id="TransactionOutput">&nbsp;</li>
    <li id="CEResultsTOP">&nbsp;</li>
    </ul>
<input type="file" id="FileUploadMimeFile" name="FileUploadMimeFile"/>
    </form></li>
<li><ul id="workarea_col_right">
    <li class="cbheader">Notifications</li>

    </ul></li>
</ul>
</div>
</body>
</html>