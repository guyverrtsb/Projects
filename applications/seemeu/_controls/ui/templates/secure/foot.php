<!-- START - Bootstrap core JavaScript ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="/gd.trxn.com/mimes/jquery/1.11.3/jquery-1.11.3.min.js"></script>
<script src="/gd.trxn.com/mimes/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="/gd.trxn.com/mimes/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
<!-- Just to make our placeholder images work. Don't actually copy the next line! -->
<script src="/gd.trxn.com/mimes/bootstrap/layouts/js/holder.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="/gd.trxn.com/mimes/bootstrap/layouts/js/ie10-viewport-bug-workaround.js"></script>
<!-- START _ UPLOAD -->
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="/gd.trxn.com/mimes/jquery-file-upload/9.10.1/js/vendor/jquery.ui.widget.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="/gd.trxn.com/mimes/jquery-file-upload/9.10.1/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="/gd.trxn.com/mimes/jquery-file-upload/9.10.1/js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="/gd.trxn.com/mimes/jquery-file-upload/9.10.1/js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="/gd.trxn.com/mimes/jquery-file-upload/9.10.1/js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="/gd.trxn.com/mimes/jquery-file-upload/9.10.1/js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="/gd.trxn.com/mimes/jquery-file-upload/9.10.1/js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="/gd.trxn.com/mimes/jquery-file-upload/9.10.1/js/jquery.fileupload-validate.js"></script>
<!-- END _ UPLOAD -->
<script src="/gd.trxn.com/mimes/gdtrxn/js/commons/utilities.js"></script>
<?php
$includedFiles = get_included_files();
$jsFile = preg_replace('/\.php$/', '.js', $includedFiles[0]);
if(file_exists ($jsFile))
{
    $jsFile = basename($jsFile, ".js");
    echo "<script src=\"$jsFile.js\"></script>\n";
}
?>
<!-- END - Bootstrap core JavaScript ================================================== -->
</body>
</html>