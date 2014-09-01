<?php require_once("../../gd.trxn.com/_controls/classes/_core.php"); ?>
<!DOCTYPE HTML><!-- HTML 5 -->
</html>
<head>
<title zgd.bkgimg="/gd.trxn.com/mimes/images/backgrounds/scaled/02841_theroadtonowhere_1440x900.jpg">Large File Share - Upload</title>
<?php gdinc("/_controls/ui/css/core.php") ?>
<style>
div { border:0px solid red; }
#GDFileUploadMimeFile
        { display:none; }
</style>
<?php gdinc("/_controls/ui/js/core.php") ?>
<script src="upload.js"></script>
<script>

</script>
</head>
<body>
<div id="container">
    <!-- HEADER -->
    <div id="header">
        <div id="logo">Logo</div>
        <div id="top_info">Top Info</div>
        <div id="navbar">
            <ul>
                <li><a href="URL">Link 1</a></li>
                <li><a href="URL">Link 2</a></li>
                <li><a href="URL">Link 3</a></li>
                <li><a href="URL">Link 4</a></li>
            </ul>
        </div>
    </div>
    <!-- CONTENT_AREA -->
    <div id="content_area">
        <div id="banner">Banner</div>
<?php gdinc("/gd.trxn.com/_controls/ui/messageline.php") ?>
        <div id="left_column">Left Column</div>
        <div id="workarea">
            <div id="GDLargeFileUpoad"><form id="GDUploadMimeFrm" class="form" method="post" enctype="multipart/form-data">
    <ul id="CBGDUpload">
    <li class="cbheader">Upload Large File</li>
    <li id="GDTransactionOutput">&nbsp;</li>
    <li><a id="GDUploadChooseButton" class="miniButtonBlue" name="navtop" onclick="$('#GDFileUploadMimeFile').click();">Choose File</a></li>
    <li><textarea id="GDFileDescription" name="GDFileDescription" cols="50" rows="10">TEST TEST</textarea></li>
    <li><div id="GDUploadProgressBox"><div id="GDUploadProgressBar"></div><div id="GDUploadProgressBarStatusTxt">0%</div></div></li>
    <li><a id="GDUploadSubmitButton" class="miniButtonBlue" name="navtop" onclick="$('#GDUploadMimeFrm').submit();">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
    <li><input type="file" id="GDFileUploadMimeFile" name="GDFileUploadMimeFile"/></li>
    </ul>
</form></div>
    </div>
        <div id="right_column">Right Column</div>
    </div>
    <!-- FOOTER -->
    <div id="footer">Footer</div>
</div>
</body>
</html>