<?php require_once("../../gd.trxn.com/_controls/classes/_core.php"); ?>
<?php gdreqonce("/gd.trxn.com/gduploadmimes/_controls/classes/controls/image.php"); ?>
<?php
ini_set("memory_limit","100M");
if(isset($_POST["GD_CONTROLLER_KEY"]))
{
    $action = filter_var($_POST["GD_CONTROLLER_KEY"], FILTER_SANITIZE_STRING);
    gdlog()->LogInfo($action.":START");
    if($action == "GD_UPLOAD_AND_SCALE_MIME")
    {
        if(validateMimeandContent())
        {
            $zsuc = new zImageUploadControl("WallMessageImageFile", "mimes_standard", "mimes_standard_image", "500", "500");
            $r = $zsuc->executeControl();
            echo $r;
        }
        else
        {
            echo "FORM_FIELDS_NOT_VALID";
        }
    }
}

function validateMimeandContent()
{
    $fv = true;  // Form is Valid Key T=Valid; anything else is invalid;
    if (!isset($_GET["group_key"]) || $_GET["group_key"] == "")
        $fv = false;
    return true;
}
?>