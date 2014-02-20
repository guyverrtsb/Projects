<?php require_once("../gd.trxn.com/_controls/classes/_core.php"); ?>
<?php gdreqonce("/_controls/classes/authorize.php"); ?>
<?php
$zauth = new zAuthorize();
if($zauth->isSiteUser())
{?>
<?php gdreqonce("/_controls/ui/header.php") ?>
<?php gdreqonce("/_controls/classes/allowed.php"); ?>
<?php gdreqonce("/_controls/classes/find/group.php"); ?>
<?php gdreqonce("/_controls/classes/find/wallmessage.php"); ?>
<?php
    $zfgroup = new zFindGroup();
    $zfgroup->findAccountandProfileByUid(gdconfig()->getSessGroupUid());
?>
<?php gdreqonce("/_controls/classes/find/group.php"); ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title zgd.bkgimg="/gd.trxn.com/mimes/images/backgrounds/scaled/02841_theroadtonowhere_1440x900.jpg">
<?php printf("%s</title>", $zfgroup->getGA_Ldesc()); ?>

<meta charset="UTF-8">
<?php gdinc("/_controls/ui/css/core.php") ?>
<style>
.WallMessageContent { width:450px; }
.WallMessageCommentContent { width:350px; }
#WallMessageImageFile { display:none; }
</style>
<?php gdinc("/_controls/ui/js/core.php") ?>
<script>
$(document).ready(function()
{
    getListofGroupRequests();
    var $win = $(window);
    $win.scroll(function ()
    {
        if ($win.height() + $win.scrollTop() == ($(document).height() - 20))
            gdLoadContentBlocksforExistingWallMessages();
    });
    gdLoadContentBlocksforExistingWallMessages();
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
        complete: function(response) { // on complete
            //output.html(response.responseText); //update element with received data
            submitbutton.removeAttr("disabled"); //enable submit button
            progressbox.hide(); // hide progress bar
            if(response.responseText != "VALID")
                showMessage("#TransactionErr", "Image File size is too big.  Please scale image to a smaller size.");
            else if(response.responseText == "VALID")
               showOutputResults(response.responseText);
            myform.resetForm();  // reset form
        }
    });
});

function clearOutputResults()
{
    //$("#GDUploadImage").text("");
    //$("#GDUploadReturnMessage").text("");
}
function showOutputResults(responseText)
{
    if(isDataMatch(responseText, "VALID"))
        gdLoadContentBlocksforNewWallMessages();
    else if(isDataMatch(responseText, "FORM_FIELDS_NOT_VALID"))
        alert("Fields cannot be empty");
    else if(isDataMatch(responseText, "TRANSACTION_FAIL"))
        showMessage("#TransactionErr", "Unknown Error:" + data);
}
</script>
</head>
<body>
<div id="ContentWrapper">
<ul id="CBHorizWorkArea">
<li><ul id="CBWorkAreaLeft">
    <li class="cbheader">Menu</li>
<?php gdinc("/_controls/ui/siteuser_left_menu.php") ?>
    </ul></li>
<li><form id="GDUploadImageFrm" class="form" action="/_controls/ajax/WALL_MESSAGE.php" method="post" enctype="multipart/form-data" >
<ul id="CBWorkAreaCenter">
<?php printf("<li class=\"cbheader\">Wall for %s</li>", $zfgroup->getGA_Ldesc()); ?>
    <li id="TransactionErr" class="error">&nbsp;</li>
    <li id="CEMessageEntry"><table>
        <tr>
        <td><img src="/mimes/images/default_user_profile_image.gif"/></td>
        <td><textarea id="WallMessageContent" name="WallMessageContent" class="WallMessageContent"></textarea></td>
        <td><a class="miniButtonBlue" name="navtop" onclick="$('#WallMessageImageFile').click();">Add image</a>
<a class="miniButtonBlue" name="navtop" onclick="$('#GDUploadImageFrm').submit();">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td
        </tr>
        </table></li>
    <li><div id="GDUploadProgressBox"><div id="GDUploadProgressBar"></div><div id="GDUploadProgressBarStatusTxt">0%</div ></div></li>
    <li id="CEWallMessagesContentTOP">&nbsp;</li>
    <li id="CEWallMessagesContentBOTTOM"><a href="javascript:gdLoadContentBlocksforExistingWallMessages();">Load new Messages</a>&nbsp;</li>
    </ul>
<input type="file" id="WallMessageImageFile" name="WallMessageImageFile"/>
    </form></li>
<li><ul id="CBWorkAreaRight">
    <li class="cbheader">Notifications</li>
    <?php gdinc("/_controls/ui/siteuser_right_menu.php") ?>
    </ul></li>
</ul>
</div>
</body>
</html>
<?php } // Authentication End ?>