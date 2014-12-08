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
<?php printf("<title>%s</title>", $zfgroup->getGA_Ldesc()); ?>

<meta charset="UTF-8">
<?php gdinc("/_controls/ui/css/core.php") ?>
<link rel="stylesheet" href="/gd.trxn.com/mimes/css/upload.form.css">
<style>
.WallMessageContent { width:450px; }
.WallMessageCommentContent { width:350px; }
#WallMessageImageFile { display:none; }
</style>
<?php gdinc("/_controls/ui/js/core.php") ?>
<script src="s_group_home.js"></script>
<script>

$(document).ready(function()
{
    var $win = $(window);
    $win.scroll(function ()
    {
        if ($win.height() + $win.scrollTop() == ($(document).height() - 20))
            gdLoadExistingWallMessages();
    });
    gdLoadExistingWallMessages();
//elements
    var progressbox     = $("#GDUploadProgressBox");
    var progressbar     = $("#GDUploadProgressBar");
    var statustxt       = $("#GDUploadProgressBarStatusTxt");
    var submitbutton    = $("#GDUploadSubmitButton");
    var myform          = $("#GDUploadForm");
    var output          = $("#TransactionErr");
    var completed       = "0%";
    var message         = "";

    $(myform).ajaxForm({
        data: { GD_CONTROL_KEY: "REGISTER_WALL_MESSAGE" },
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
            if(buildContentBlockReturnMessage(data, "SUCCESS", "WallMessageTransactionOutput"))
            {
                gdLoadNewWallMessages();
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
<div id="zgdbkgimg" value="/mimes/images/backgrounds/scaled/02841_theroadtonowhere_1440x900.jpg"></div>
<div id="ContentWrapper">
<ul id="CBHorizWorkArea">
<li><ul id="CBWorkAreaLeft">
    <li class="cbheader">Menu</li>
    <?php gdinc("/_controls/ui/menu_left_siteuser.php") ?>
    </ul></li>
<li><form id="GDUploadForm" class="form" action="/_controls/ajax/WALL_MESSAGE.php" method="post" enctype="multipart/form-data" >
<ul id="CBWorkAreaCenter">
<?php printf("<li class=\"cbheader\">Wall for %s</li>", $zfgroup->getGA_Ldesc()); ?>
    <li id="WallMessageTransactionOutput">&nbsp;</li>
    <li id="CEMessageEntry"><table>
        <tr>
        <td><img src="/mimes/images/default_user_profile_image.gif"/></td>
        <td><textarea id="WallMessageContent" name="WallMessageContent" class="WallMessageContent"></textarea></td>
        <td><a class="miniButtonBlue" name="navtop" onclick="$('#WallMessageImageFile').click();">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;File&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<a class="miniButtonBlue" name="navtop" onclick="$('#GDUploadForm').submit();">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
        </tr>
        </table></li>
    <li><div id="GDUploadProgressBox"><div id="GDUploadProgressBar"></div><div id="GDUploadProgressBarStatusTxt">0%</div ></div></li>
    <li id="TransactionOutput">&nbsp;</li>
    <li id="CEResultsTOP">&nbsp;</li>
    <li id="CEResultsBOTTOM"><a href="javascript:gdLoadContentBlocksforExistingWallMessages();">Load new Messages</a>&nbsp;</li>
    <li><input type="file" id="WallMessageImageFile" name="WallMessageImageFile"/></li>
    </ul>
    </form></li>
<li><ul id="CBWorkAreaRight">
    <li class="cbheader">Notifications</li>
    <?php gdinc("/_controls/ui/menu_right_siteuser.php") ?>
    </ul></li>
</ul>
</div>
</body>
</html>
<?php } // Authentication End ?>