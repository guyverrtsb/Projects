<?php require_once("../../gd.trxn.com/includes/classes/_core.php"); ?>
<?php gdinc("/includes/classes/image.manipulation.php"); ?>
<?php gdinc("/includes/classes/image.to.database.php"); ?>
<?php
ini_set("memory_limit","100M");
$target_h_pxl = "500";
$target_w_pxl = "400";
$origimg = new ImageManipulation(); $origimg->setUploadedImage();
$scalimg = new ImageManipulation(); $scalimg->setUploadedImage();
$thmbimg = new ImageManipulation(); $thmbimg->setUploadedImage();

if($origimg->getWidth() > $origimg->getHeight())    // Landscape
{
    $scalimg->resizeToWidth($target_w_pxl);
    $thmbimg->resizeToWidth(100);
}
else    // Portrait or Square
{
    $scalimg->resizeToHeight($target_h_pxl);
    $thmbimg->resizeToHeight(100);
}

//header("Content-Type: image/png");
//$origimg->output();
//$scalimg->output();
//$thmbimg->output();
$origimg->save("original-".time()."-gdtmp.png");
$scalimg->save("scale-".time()."-gdtmp.png");
$thmbimg->save("thumb-".time()."-gdtmp.png");

$origimgdb = new ImageDatabase();
$origimgdb->setMime($origimg->getFileSize(), $origimg->getFileName(), $origimg->getFileType(), $origimg->getFileExt());

$scalimgdb = new ImageDatabase();
$scalimgdb->setMime($scalimg->getFileSize(), $scalimg->getFileName(), $scalimg->getFileType(), $scalimg->getFileExt());

$thmbimgdb = new ImageDatabase();
$thmbimgdb->setMime($thmbimg->getFileSize(), $thmbimg->getFileName(), $thmbimg->getFileType(), $thmbimg->getFileExt());

/*
echo ";path - ".$origimg->getFilePath()."<br/>";
echo ";name - ".$origimg->getFileName()."<br/>";
echo ";ext  - ".$origimg->getFileExt()."<br/>";
echo ";type - ".$origimg->getFileType()."<br/>";
echo ";wdth - ".$origimg->getFileWidth()."<br/>";
echo ";hiht - ".$origimg->getFileHeight()."<br/>";
echo ";size - ".$origimg->getFileSize()."<br/>";
echo ";time - ".time()."<br/>";
echo ";muid - ".$origimgdb->getMimeUid()."<br/>";
 * 
 */
echo "Good Upload"."<br/>";
echo "origimgdb Mime UID - ".$origimgdb->getMimeUid()."<br/>";
echo "scalimgdb Mime UID - ".$scalimgdb->getMimeUid()."<br/>";
echo "thmbimgdb Mime UID - ".$thmbimgdb->getMimeUid()."<br/>";
?>