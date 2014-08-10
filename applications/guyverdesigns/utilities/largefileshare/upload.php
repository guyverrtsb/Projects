<?php require_once("../../gd.trxn.com/_controls/classes/_core.php"); ?>
<!DOCTYPE HTML><!-- HTML 5 -->
</html>
<head>
<title zgd.bkgimg="/gd.trxn.com/mimes/images/backgrounds/scaled/02841_theroadtonowhere_1440x900.jpg">Large File Share - Upload</title>
<?php gdinc("/_controls/ui/css/core.php") ?>
<style>
    div { border:0px solid red; }
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
        <div id="left_column">Left Column</div>
        <div id="workarea">
<form id="GDUploadImageFrm" class="form" action="/_controls/ajax/LARGE_FILE_SHARE.php" method="post" enctype="multipart/form-data" >
<ul id="CBWorkAreaCenter">
    <li class="cbheader">Upload Large File</li>
    <li id="GDTransactionOutput">&nbsp;</li>
    <li><div id="GDUploadProgressBox"><div id="GDUploadProgressBar"></div><div id="GDUploadProgressBarStatusTxt">0%</div></div></li>
    <li id="TransactionOutput">&nbsp;</li>
    </ul>
<input type="file" id="FileUploadMimeFile" name="FileUploadMimeFile"/>
</form>
    </div>
        <div id="right_column">Right Column</div>
    </div>
    <!-- FOOTER -->
    <div id="footer">Footer</div>
</div>
</body>
</html>