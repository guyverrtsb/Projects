<?php require_once("../../gd.trxn.com/_controls/classes/_core.php"); ?>
<?php gdreqonce("/gd.trxn.com/gduploadmimes/_controls/classes/mimes/imagefromdatabase.php"); ?>
<?php
gdlog()->LogInfo("PAGE_LOADED:");
if(isset($_GET["MIMEKEY"]))
{
    $mimesobject = filter_var($_GET["MIMEKEY"], FILTER_SANITIZE_STRING);
    /*
     * 1. Get Mime Record from Mime Key
     * 2. See if file exists on OS
     * 2a. If File Exists use that file
     * 2b. If file does not exist use database
     * 3. Get the Table the Mime Exists from the Mime Record
     * 4. Use the Table and query the Mime Blob Record
     * 5. Print the Mime Blob for output.
     */
    $zifd = new zImagefromDatabase();
    $r = $zifd->findMimeRecord($mimesobject);
    gdlog()->LogInfo($r);
    if($r == "MIME_FOUND")
    {
        gdlog()->LogInfoTaskLabel("Mime is Found");
        gdlog()->LogInfo("MIME_FOUND:".$zifd->getFileType());
        header("Content-type: image/".$zifd->getFileType());
        if(file_exists($zifd->getFilePath()))
        {
            gdlog()->LogInfo("Use the File on the server.");
            print file_get_contents($zifd->getFilePath());
        }
        else
        {
            gdlog()->LogInfo("Use the File in Database.");
            $r = $zifd->findMimeBlobafterMimeSearch();
            print $zifd->getResult_MimesBlob();
       }
    }
}

function validateLoginForm()
{
    $fv = "T";  // Form is Valid Key T=Valid; anything else is invalid;
    if (!isset($_GET["mimesobject"]) || $_GET["mimesobject"] == "")
        $fv = "F";
    return $fv;
}
?>