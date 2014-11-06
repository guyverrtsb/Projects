<?php require_once("../../gd.trxn.com/_controls/classes/_core.php"); ?>
<!DOCTYPE HTML><!-- HTML 5 -->
<html lang="en">
<head>
<!-- Force latest IE rendering engine or ChromeFrame if installed -->
<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
<meta charset="utf-8">
<title>jQuery File Upload Demo - Basic version</title>
<meta name="description" content="File Upload widget with multiple file selection, drag&amp;drop support and progress bar for jQuery. Supports cross-domain, chunked and resumable file uploads. Works with any server-side platform (PHP, Python, Ruby on Rails, Java, Node.js, Go etc.) that supports standard HTML form file uploads.">
<meta name="viewport" content="width=device-width, initial-scale=1.0"><!-- Bootstrap styles -->
<?php gdinc("/gd.trxn.com/_controls/ui/css/core.php") ?>
<?php gdinc("/gd.trxn.com/_controls/ui/css/upload.php") ?>
<?php gdinc("/gd.trxn.com/_controls/ui/js/core.php") ?>
<?php gdinc("/gd.trxn.com/_controls/ui/js/upload.php") ?>
</head>
<body>
<div class="gdupload_container">
    <div class="gdupload_area">
    <div class="gdupload_area_text">Drag Files to this box</div>
    <!-- The fileinput-button span is used to style the file input field as button -->
    <span class="btn btn-success fileinput-button">
        <i class="glyphicon glyphicon-plus"></i>
        <span>Select files...</span>
        <!-- The file input field used as target for the file upload widget -->
        <input id="fileupload" type="file" name="files[]" multiple>
    </span>
    </div>
    <br>
    <br>
    <!-- The global progress bar -->
    <div id="progress" class="progress">
        <div class="progress-bar progress-bar-success"></div>
    </div>
    <div id="gdupload_progress"></div>
    <!-- The container for the uploaded files -->
    <div id="gdupload_files" class="files"></div>
</div>

<script>
/*jslint unparam: true */
/*global window, $ */

</script>
</body> 
</html>