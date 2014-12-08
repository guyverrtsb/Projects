<?php require_once("../../gd.trxn.com/_controls/classes/_core.php"); ?>
<?php gdreqonce("/gd.trxn.com/gduploadmimes/_controls/classes/mimes/imagefromdatabase.php"); ?>
<?php
$echoret = "";
if(isset($_GET["MIMEKEY"]))
{
    $mimeuid = filter_var($_GET["MIMEKEY"], FILTER_SANITIZE_STRING);
    $version = filter_var($_GET["VERSION"], FILTER_SANITIZE_STRING);
    $type = filter_var($_GET["TYPE"], FILTER_SANITIZE_STRING);
    if($type == "IMAGE")
    {
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
        $r = $zifd->findMimeMetaRecord(gdconfig()->getSessUnivTblKey()."mimes_standard_meta_image"
                                    , $mimeuid
                                    , "CROSSAPPDATA");
        gdlog()->LogInfo("download mime{".$r."}");
        if($r == "MIME_FOUND")
        {
            $metaRecord = $zifd->getMetaRecord();
            header("Content-type: ".$metaRecord["type"]);
            
            $osFilePath;
            $mime_table;
            $mime_table_uid;
            $mime_table_size;
            if($r == "MIME_FOUND" && $version == "ORIGINAL")
            {
                $osFilePath = $metaRecord["ospath"];
                $mime_table = $metaRecord["appl_table"];
                $mime_table_uid = $metaRecord["appl_table_uid"];
                $mime_table_size = $metaRecord["size"];
            }
            else if($r == "MIME_FOUND" && $version == "SCALED")
            {
                $osFilePath = $metaRecord["appl_table_scaled_ospath"];
                $mime_table = $metaRecord["appl_table_scaled"];
                $mime_table_uid = $metaRecord["appl_table_scaled_uid"];
                $mime_table_size = $metaRecord["appl_table_scaled_size"];
                            }
            else if($r == "MIME_FOUND" && $version == "THUMBNAIL")
            {
                $osFilePath = $metaRecord["appl_table_thumbnail_ospath"];
                $mime_table = $metaRecord["appl_table_thumbnail"];
                $mime_table_uid = $metaRecord["appl_table_thumbnail_uid"];
                $mime_table_size = $metaRecord["appl_table_thumbnail_size"];
            }
            
            
            if(file_exists($osFilePath))
            {
                gdlog()->LogInfo("Use the File on the server.{".$osFilePath."}");
                print file_get_contents($osFilePath);
            }
            else
            {
                gdlog()->LogInfo("Use the File in Database.{".$mime_table.":".$mime_table_uid.":".$mime_table_size."}");
                $r = $zifd->findMimeBlob($mime_table
                                        , $mime_table_uid
                                        , $mime_table_size
                                        , "CROSSAPPDATA");
                print $zifd->getResult_MimesBlob();
            }
        }
    }
}
else
{
    gdlog()->LogInfo("Mime was not passed for download of image");
}

function validateLoginForm()
{
    $fv = true;  // Form is Valid Key T=Valid; anything else is invalid;
    if (!isset($_GET["mimesobject"]) || $_GET["mimesobject"] == "")
        $fv = false;
    return $fv;
}
?>