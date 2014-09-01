<?php require "../../_controls/classes/_core.php"; ?>
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

});

function gdFuncSaveData()
{
    var formdata = $("#gdSaveDataFrm").serializeArray();
    $.get("/gd.trxn.com/_system/_controls.classes/INSERT_site_new_record.php",
    formdata,
        function(data)
        {
            alert(formdata + "\n" + data);
        });
}
</script>
</head>
<body>
<div id="ContentWrapper">
    <?php gdinc("/gd.trxn.com/_controls/ui/gdHeader.php"); ?>
    <div id="gdContent"><table>
        <tr>
        <td width="50%"><ul>
        </ul></td>
        <td width="50%"><form id="gdSaveDataFrm" name="gdSaveDataFrm"><ul class="gdForm">
            <li><input class="gdSaveFormDataInputText" style="width:400px;" id="searchkey" name="searchkey" value="<?php echo $_SERVER['GUYVERDESIGNS_SITE_PACKAGE']; ?>"/></li>
            <li><input class="gdSaveFormDataInputText" style="width:400px;" id="display" name="display" value="<?php echo $_SERVER['GUYVERDESIGNS_SITE_ALIAS']; ?>"/></li>
            <li><input class="gdSaveFormDataInputText" style="width:400px;" id="dependentuid" name="dependentuid" value="dependentuid"/></li>
            <li><textarea class="gdSaveFormDataTextArea" style="width:400px;" id="ldesc" name="ldesc" col="30" row="5">ldesc</textarea></li>
            <li><input type="button" class="gdSaveFormDataButton" id="SaveConfigData" name="SaveConfigData" value="Save Config Data" onclick="gdFuncSaveData();"/></li>
        </ul></form></td>
        </tr>
    </table></div>
    <?php gdinc("/gd.trxn.com/_controls/ui/gdFooter.php"); ?>
</div>
</body>
</html>

