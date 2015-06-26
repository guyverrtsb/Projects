<!-- START - Bootstrap core JavaScript ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="/gd.trxn.com/mimes/jquery/1.11.3/jquery-1.11.3.min.js"></script>
<script src="/gd.trxn.com/mimes/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="/gd.trxn.com/mimes/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
<!-- Just to make our placeholder images work. Don't actually copy the next line! -->
<script src="/gd.trxn.com/mimes/bootstrap/layouts/js/holder.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="/gd.trxn.com/mimes/bootstrap/layouts/js/ie10-viewport-bug-workaround.js"></script>
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